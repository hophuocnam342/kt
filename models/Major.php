<?php
class Major {
    private $conn;
    private $table_name = "NganhHoc";
    
    public $MaNganh;
    public $TenNganh;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Lấy tất cả ngành học
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY MaNganh";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
}
?>
