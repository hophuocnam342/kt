<?php
class Course {
    private $conn;
    private $table_name = "HocPhan";
    
    public $MaHP;
    public $TenHP;
    public $SoTinChi;
    public $SoLuongDuKien;
    public $SoLuongDaDangKy;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Lấy tất cả học phần
    public function getAll() {
        $query = "SELECT h.*, 
                 (SELECT COUNT(*) FROM ChiTietDangKy c WHERE c.MaHP = h.MaHP) as SoLuongDaDangKy 
                 FROM " . $this->table_name . " h ORDER BY h.MaHP";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Lấy thông tin chi tiết học phần
    public function getOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaHP = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaHP);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->MaHP = $row['MaHP'];
        $this->TenHP = $row['TenHP'];
        $this->SoTinChi = $row['SoTinChi'];
        
        return $row;
    }
    
    // Cập nhật số lượng dự kiến sinh viên
    public function updateExpectedNumber() {
        // Kiểm tra xem cột SoLuongDuKien đã tồn tại trong bảng chưa
        $checkQuery = "SHOW COLUMNS FROM " . $this->table_name . " LIKE 'SoLuongDuKien'";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->execute();
        
        if($checkStmt->rowCount() == 0) {
            // Nếu cột chưa tồn tại, thêm cột vào bảng
            $alterQuery = "ALTER TABLE " . $this->table_name . " ADD COLUMN SoLuongDuKien INT DEFAULT 0";
            $alterStmt = $this->conn->prepare($alterQuery);
            $alterStmt->execute();
        }
        
        $query = "UPDATE " . $this->table_name . " SET SoLuongDuKien = ? WHERE MaHP = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->SoLuongDuKien, PDO::PARAM_INT);
        $stmt->bindParam(2, $this->MaHP);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Lấy số lượng học phần đã đăng ký
    public function getRegisteredCount() {
        $query = "SELECT COUNT(*) as count FROM ChiTietDangKy WHERE MaHP = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaHP);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row['count'];
    }
}
?>
