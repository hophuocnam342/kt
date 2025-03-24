<?php
class RegistrationDetail {
    private $conn;
    private $table_name = "ChiTietDangKy";
    
    public $MaDK;
    public $MaHP;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Thêm chi tiết đăng ký
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (MaDK, MaHP) VALUES (?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaDK);
        $stmt->bindParam(2, $this->MaHP);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Lấy chi tiết đăng ký theo mã đăng ký
    public function getByRegistration() {
        $query = "SELECT c.*, h.TenHP, h.SoTinChi FROM " . $this->table_name . " c
                  JOIN HocPhan h ON c.MaHP = h.MaHP
                  WHERE c.MaDK = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaDK);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Xóa chi tiết đăng ký
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE MaDK = ? AND MaHP = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaDK);
        $stmt->bindParam(2, $this->MaHP);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>
