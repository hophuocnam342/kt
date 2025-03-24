<h1>HIỆU CHỈNH THÔNG TIN SINH VIÊN</h1>

<form action="index.php?controller=student&action=update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MaSV" value="<?php echo $this->student->MaSV; ?>">
    <input type="hidden" name="HinhCu" value="<?php echo $this->student->Hinh; ?>">
    
    <div class="form-group">
        <label for="HoTen">Họ Tên:</label>
        <input type="text" id="HoTen" name="HoTen" value="<?php echo $this->student->HoTen; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="GioiTinh">Giới Tính:</label>
        <select id="GioiTinh" name="GioiTinh">
            <option value="Nam" <?php echo ($this->student->GioiTinh == 'Nam') ? 'selected' : ''; ?>>Nam</option>
            <option value="Nữ" <?php echo ($this->student->GioiTinh == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="NgaySinh">Ngày Sinh:</label>
        <input type="date" id="NgaySinh" name="NgaySinh" value="<?php echo $this->student->NgaySinh; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="Hinh">Hình hiện tại:</label>
        <?php if(!empty($this->student->Hinh) && file_exists($this->student->Hinh)): ?>
            <img src="<?php echo $this->student->Hinh; ?>" width="100">
        <?php else: ?>
            <p>Không có hình</p>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="Hinh">Cập nhật hình mới:</label>
        <input type="file" id="Hinh" name="Hinh">
    </div>
    
    <div class="form-group">
        <label for="MaNganh">Ngành Học:</label>
        <select id="MaNganh" name="MaNganh" required>
            <?php while($row = $majors->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row['MaNganh']; ?>" <?php echo ($this->student->MaNganh == $row['MaNganh']) ? 'selected' : ''; ?>>
                    <?php echo $row['TenNganh']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    
    <button type="submit" class="btn">Lưu</button>
</form>

<a href="index.php?controller=student&action=index" class="btn">Quay lại danh sách</a>
