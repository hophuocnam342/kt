<?php
class CourseController {
    private $db;
    private $course;
    
    public function __construct() {
        // Kết nối database
        require_once 'config/database.php';
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Khởi tạo model
        require_once 'models/Course.php';
        $this->course = new Course($this->db);
    }
    
    // Hiển thị danh sách học phần
    public function index() {
        $courses = $this->course->getAll();
        
        include 'views/layout/header.php';
        include 'views/course/index.php';
        include 'views/layout/footer.php';
    }
    
    // Cập nhật số lượng dự kiến
    public function updateExpectedNumber() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['MaHP']) && isset($_POST['SoLuongDuKien'])) {
                $this->course->MaHP = $_POST['MaHP'];
                $this->course->SoLuongDuKien = $_POST['SoLuongDuKien'];
                
                if($this->course->updateExpectedNumber()) {
                    header("Location: index.php?controller=course&action=index");
                } else {
                    echo "Cập nhật số lượng dự kiến thất bại";
                }
            }
        }
    }
}
?>
