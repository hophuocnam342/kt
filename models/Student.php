<?php
class Student {
    private $conn;
    private $table_name = "SinhVien";
    
    public $MaSV;
    public $HoTen;
    public $GioiTinh;
    public $NgaySinh;
    public $Hinh;
    public $MaNganh;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Lấy danh sách sinh viên
    public function getAll() {
        $query = "SELECT s.*, n.TenNganh FROM " . $this->table_name . " s
                  JOIN NganhHoc n ON s.MaNganh = n.MaNganh
                  ORDER BY s.MaSV";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    // Lấy thông tin chi tiết sinh viên
    public function getOne() {
        $query = "SELECT s.*, n.TenNganh FROM " . $this->table_name . " s
                  JOIN NganhHoc n ON s.MaNganh = n.MaNganh
                  WHERE s.MaSV = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaSV);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->MaSV = $row['MaSV'];
        $this->HoTen = $row['HoTen'];
        $this->GioiTinh = $row['GioiTinh'];
        $this->NgaySinh = $row['NgaySinh'];
        $this->Hinh = $row['Hinh'];
        $this->MaNganh = $row['MaNganh'];
        
        return $row;
    }
    
    // Thêm sinh viên mới
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                SET MaSV=:MaSV, HoTen=:HoTen, GioiTinh=:GioiTinh, 
                    NgaySinh=:NgaySinh, Hinh=:Hinh, MaNganh=:MaNganh";
        
        $stmt = $this->conn->prepare($query);
        
        // Làm sạch dữ liệu
        $this->MaSV = htmlspecialchars(strip_tags($this->MaSV));
        $this->HoTen = htmlspecialchars(strip_tags($this->HoTen));
        $this->GioiTinh = htmlspecialchars(strip_tags($this->GioiTinh));
        $this->MaNganh = htmlspecialchars(strip_tags($this->MaNganh));
        
        // Bind parameters
        $stmt->bindParam(":MaSV", $this->MaSV);
        $stmt->bindParam(":HoTen", $this->HoTen);
        $stmt->bindParam(":GioiTinh", $this->GioiTinh);
        $stmt->bindParam(":NgaySinh", $this->NgaySinh);
        $stmt->bindParam(":Hinh", $this->Hinh);
        $stmt->bindParam(":MaNganh", $this->MaNganh);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Cập nhật sinh viên
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                SET HoTen=:HoTen, GioiTinh=:GioiTinh, 
                    NgaySinh=:NgaySinh, Hinh=:Hinh, MaNganh=:MaNganh
                WHERE MaSV=:MaSV";
        
        $stmt = $this->conn->prepare($query);
        
        // Làm sạch dữ liệu
        $this->MaSV = htmlspecialchars(strip_tags($this->MaSV));
        $this->HoTen = htmlspecialchars(strip_tags($this->HoTen));
        $this->GioiTinh = htmlspecialchars(strip_tags($this->GioiTinh));
        $this->MaNganh = htmlspecialchars(strip_tags($this->MaNganh));
        
        // Bind parameters
        $stmt->bindParam(":MaSV", $this->MaSV);
        $stmt->bindParam(":HoTen", $this->HoTen);
        $stmt->bindParam(":GioiTinh", $this->GioiTinh);
        $stmt->bindParam(":NgaySinh", $this->NgaySinh);
        $stmt->bindParam(":Hinh", $this->Hinh);
        $stmt->bindParam(":MaNganh", $this->MaNganh);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Xóa sinh viên
    public function delete() {
        // Trước tiên xóa các đăng ký của sinh viên
        $query = "DELETE FROM ChiTietDangKy WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaSV);
        $stmt->execute();
        
        $query = "DELETE FROM DangKy WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaSV);
        $stmt->execute();
        
        // Sau đó xóa sinh viên
        $query = "DELETE FROM " . $this->table_name . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaSV);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    // Kiểm tra đăng nhập
    public function login() {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " 
                 WHERE MaSV = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->MaSV);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row['count'] > 0) {
            return true;
        }
        
        return false;
    }
}
?>
