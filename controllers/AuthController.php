<?php
class AuthController {
    private $db;
    private $student;
    
    public function __construct() {
        // Kết nối database
        require_once 'config/database.php';
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Khởi tạo model
        require_once 'models/Student.php';
        $this->student = new Student($this->db);
    }
    
    // Hiển thị form đăng nhập
    public function login() {
        include 'views/layout/header.php';
        include 'views/auth/login.php';
        include 'views/layout/footer.php';
    }
    
    // Xử lý đăng nhập
    public function authenticate() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->student->MaSV = $_POST['MaSV'];
            
            if($this->student->login()) {
                // Lấy thông tin sinh viên
                $this->student->getOne();
                
                // Lưu phiên đăng nhập
                $_SESSION['MaSV'] = $this->student->MaSV;
                $_SESSION['HoTen'] = $this->student->HoTen;
                
                header("Location: index.php?controller=registration&action=register");
            } else {
                header("Location: index.php?controller=auth&action=login&error=1");
            }
        }
    }
    
    // Đăng xuất
    public function logout() {
        // Xóa dữ liệu phiên
        session_unset();
        session_destroy();
        
        header("Location: index.php?controller=auth&action=login");
    }
}
?>