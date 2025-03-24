<?php
class RegistrationController {
    private $db;
    private $registration;
    private $registrationDetail;
    private $course;
    private $student;
    
    public function __construct() {
        // Kết nối database
        require_once 'config/database.php';
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Khởi tạo models
        require_once 'models/Registration.php';
        require_once 'models/RegistrationDetail.php';
        require_once 'models/Course.php';
        require_once 'models/Student.php';
        
        $this->registration = new Registration($this->db);
        $this->registrationDetail = new RegistrationDetail($this->db);
        $this->course = new Course($this->db);
        $this->student = new Student($this->db);
    }
    
    // Hiển thị trang đăng ký học phần
    public function register() {
        // Lấy danh sách học phần
        $courses = $this->course->getAll();
        
        // Nếu đã đăng nhập
        if(isset($_SESSION['MaSV'])) {
            // Lấy thông tin sinh viên
            $this->student->MaSV = $_SESSION['MaSV'];
            $student = $this->student->getOne();
            
            // Danh sách học phần trong giỏ hàng
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
            
            include 'views/layout/header.php';
            include 'views/registration/register.php';
            include 'views/layout/footer.php';
        } else {
            header("Location: index.php?controller=auth&action=login");
        }
    }
    
    // Thêm học phần vào giỏ
    public function addToCart() {
        if(isset($_GET['id'])) {
            $MaHP = $_GET['id'];
            
            // Khởi tạo giỏ hàng nếu chưa có
            if(!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            // Thêm vào giỏ nếu chưa có
            if(!isset($_SESSION['cart'][$MaHP])) {
                // Lấy thông tin học phần
                $this->course->MaHP = $MaHP;
                $course = $this->course->getOne();
                
                $_SESSION['cart'][$MaHP] = [
                    'MaHP' => $course['MaHP'],
                    'TenHP' => $course['TenHP'],
                    'SoTinChi' => $course['SoTinChi']
                ];
            }
            
            header("Location: index.php?controller=registration&action=register");
        }
    }
    
    // Xóa học phần khỏi giỏ
    public function removeFromCart() {
        if(isset($_GET['id'])) {
            $MaHP = $_GET['id'];
            
            if(isset($_SESSION['cart']) && isset($_SESSION['cart'][$MaHP])) {
                unset($_SESSION['cart'][$MaHP]);
            }
            
            header("Location: index.php?controller=registration&action=register");
        }
    }
    
    // Xóa toàn bộ giỏ hàng
    public function clearCart() {
        if(isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        
        header("Location: index.php?controller=registration&action=register");
    }
    
    // Lưu đăng ký học phần
    public function saveRegistration() {
        if(isset($_SESSION['MaSV']) && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            // Tạo đăng ký mới
            $this->registration->NgayDK = date('Y-m-d');
            $this->registration->MaSV = $_SESSION['MaSV'];
            
            if($this->registration->create()) {
                $MaDK = $this->registration->MaDK;
                
                // Thêm từng học phần vào chi tiết đăng ký
                                // Thêm từng học phần vào chi tiết đăng ký
                                foreach($_SESSION['cart'] as $course) {
                                    $this->registrationDetail->MaDK = $MaDK;
                                    $this->registrationDetail->MaHP = $course['MaHP'];
                                    
                                    $this->registrationDetail->create();
                                }
                                
                                // Xóa giỏ hàng sau khi đăng ký thành công
                                unset($_SESSION['cart']);
                                
                                // Hiển thị trang thành công
                                $this->registration->MaDK = $MaDK;
                                $this->registrationDetail->MaDK = $MaDK;
                                
                                $registration = $this->registration->getByStudent()->fetch(PDO::FETCH_ASSOC);
                                $courses = $this->registrationDetail->getByRegistration();
                                
                                include 'views/layout/header.php';
                                include 'views/registration/success.php';
                                include 'views/layout/footer.php';
                            } else {
                                echo "Đăng ký học phần thất bại";
                            }
                        } else {
                            header("Location: index.php?controller=registration&action=register");
                        }
                    }
                    
                    // Hiển thị trang giỏ hàng
                    public function cart() {
                        // Danh sách học phần trong giỏ hàng
                        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
                        $totalCredits = 0;
                        
                        foreach($cart as $course) {
                            $totalCredits += $course['SoTinChi'];
                        }
                        
                        include 'views/layout/header.php';
                        include 'views/registration/cart.php';
                        include 'views/layout/footer.php';
                    }
                    
                    // Xem lịch sử đăng ký
                    public function history() {
                        if(isset($_SESSION['MaSV'])) {
                            $this->registration->MaSV = $_SESSION['MaSV'];
                            $registrations = $this->registration->getByStudent();
                            
                            include 'views/layout/header.php';
                            include 'views/registration/history.php';
                            include 'views/layout/footer.php';
                        } else {
                            header("Location: index.php?controller=auth&action=login");
                        }
                    }
                    
                    // Xem chi tiết đăng ký
                    public function detail() {
                        if(isset($_GET['id'])) {
                            $this->registrationDetail->MaDK = $_GET['id'];
                            $courses = $this->registrationDetail->getByRegistration();
                            
                            include 'views/layout/header.php';
                            include 'views/registration/detail.php';
                            include 'views/layout/footer.php';
                        }
                    }
                    
                    // Xóa đăng ký
                    public function delete() {
                        if(isset($_GET['id'])) {
                            $this->registration->MaDK = $_GET['id'];
                            
                            if($this->registration->delete()) {
                                header("Location: index.php?controller=registration&action=history");
                            } else {
                                echo "Xóa đăng ký thất bại";
                            }
                        }
                    }
                }
                ?>