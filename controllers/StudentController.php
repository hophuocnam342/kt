<?php
class StudentController {
    private $db;
    private $student;
    private $major;
    
    public function __construct() {
        // Kết nối database
        require_once 'config/database.php';
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Khởi tạo models
        require_once 'models/Student.php';
        require_once 'models/Major.php';
        $this->student = new Student($this->db);
        $this->major = new Major($this->db);
    }
    
    // Hiển thị danh sách sinh viên
    public function index() {
        $students = $this->student->getAll();
        
        include 'views/layout/header.php';
        include 'views/student/index.php';
        include 'views/layout/footer.php';
    }
    
    // Hiển thị form thêm sinh viên
    public function create() {
        $majors = $this->major->getAll();
        
        include 'views/layout/header.php';
        include 'views/student/create.php';
        include 'views/layout/footer.php';
    }
    
    // Xử lý thêm sinh viên
    public function store() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $this->student->MaSV = $_POST['MaSV'];
            $this->student->HoTen = $_POST['HoTen'];
            $this->student->GioiTinh = $_POST['GioiTinh'];
            $this->student->NgaySinh = $_POST['NgaySinh'];
            $this->student->MaNganh = $_POST['MaNganh'];
            
            // Xử lý upload hình
            if(isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
                $target_dir = "assets/images/";
                $target_file = $target_dir . basename($_FILES["Hinh"]["name"]);
                
                if(move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
                    $this->student->Hinh = $target_file;
                }
            }
            
            // Thêm sinh viên
            if($this->student->create()) {
                header("Location: index.php?controller=student&action=index");
            } else {
                echo "Thêm sinh viên thất bại";
            }
        }
    }
    
    // Hiển thị form sửa sinh viên
    public function edit() {
        if(isset($_GET['id'])) {
            $this->student->MaSV = $_GET['id'];
            $this->student->getOne();
            
            $majors = $this->major->getAll();
            
            include 'views/layout/header.php';
            include 'views/student/edit.php';
            include 'views/layout/footer.php';
        }
    }
    
    // Xử lý cập nhật sinh viên
    public function update() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu từ form
            $this->student->MaSV = $_POST['MaSV'];
            $this->student->HoTen = $_POST['HoTen'];
            $this->student->GioiTinh = $_POST['GioiTinh'];
            $this->student->NgaySinh = $_POST['NgaySinh'];
            $this->student->MaNganh = $_POST['MaNganh'];
            
            // Xử lý upload hình (nếu có)
            if(isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
                $target_dir = "assets/images/";
                $target_file = $target_dir . basename($_FILES["Hinh"]["name"]);
                
                if(move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
                    $this->student->Hinh = $target_file;
                }
            } else {
                // Nếu không upload hình mới, giữ nguyên hình cũ
                $this->student->Hinh = $_POST['HinhCu'];
            }
            
            // Cập nhật sinh viên
            if($this->student->update()) {
                header("Location: index.php?controller=student&action=index");
            } else {
                echo "Cập nhật sinh viên thất bại";
            }
        }
    }
    
    // Hiển thị form xóa sinh viên
    public function delete() {
        if(isset($_GET['id'])) {
            $this->student->MaSV = $_GET['id'];
            $this->student->getOne();
            
            include 'views/layout/header.php';
            include 'views/student/delete.php';
            include 'views/layout/footer.php';
        }
    }
    
    // Xử lý xóa sinh viên
    public function destroy() {
        if(isset($_POST['MaSV'])) {
            $this->student->MaSV = $_POST['MaSV'];
            
            if($this->student->delete()) {
                header("Location: index.php?controller=student&action=index");
            } else {
                echo "Xóa sinh viên thất bại";
            }
        }
    }
    
    // Hiển thị thông tin chi tiết sinh viên
    public function detail() {
        if(isset($_GET['id'])) {
            $this->student->MaSV = $_GET['id'];
            $this->student->getOne();
            
            include 'views/layout/header.php';
            include 'views/student/detail.php';
            include 'views/layout/footer.php';
        }
    }
}
?>
