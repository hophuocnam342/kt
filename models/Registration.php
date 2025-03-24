<?php
class Registration {
    private $conn;
    private $table_name = "DangKy";
    
    public $MaDK;
    public $NgayDK;
    public $MaSV;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Tạo đăng ký mới
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (NgayDK, MaSV) VALUES (?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NgayDK);
        $stmt->bindParam(2, $this->MaSV);
        
        if($stmt->execute()) {
            $this->MaDK = $this->conn->lastInsertId();
            return true;
        }
        
        return false;
    }
    
    // Lấy đăng ký của sinh viên
    public function getByStudent() {
        $query = "SELECT d.*, s.HoTen FROM " . $this->table_name . " d
                  JOIN SinhVien s ON d.MaSV = s.MaSV
                  WHERE d.MaSV = ?
                  ORDER BY d.NgayDK DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaSV);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Xóa đăng ký
    public function delete() {
        // Xóa chi tiết đăng ký trước
        $query = "DELETE FROM ChiTietDangKy WHERE MaDK = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaDK);
        $stmt->execute();
        
        // Sau đó xóa đăng ký
        $query = "DELETE FROM " . $this->table_name . " WHERE MaDK = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaDK);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>
