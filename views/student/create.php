<h1>THÊM SINH VIÊN</h1>

<form action="index.php?controller=student&action=store" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="MaSV">Mã SV:</label>
        <input type="text" id="MaSV" name="MaSV" required>
    </div>
    
    <div class="form-group">
        <label for="HoTen">Họ Tên:</label>
        <input type="text" id="HoTen" name="HoTen" required>
    </div>
    
    <div class="form-group">
        <label for="GioiTinh">Giới Tính:</label>
        <select id="GioiTinh" name="GioiTinh">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="NgaySinh">Ngày Sinh:</label>
        <input type="date" id="NgaySinh" name="NgaySinh" required>
    </div>
    
    <div class="form-group">
        <label for="Hinh">Hình:</label>
        <input type="file" id="Hinh" name="Hinh">
    </div>
    
    <div class="form-group">
        <label for="MaNganh">Ngành Học:</label>
        <select id="MaNganh" name="MaNganh" required>
            <?php while($row = $majors->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row['MaNganh']; ?>"><?php echo $row['TenNganh']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    
    <button type="submit" class="btn">Thêm</button>
</form>

<a href="index.php?controller=student&action=index" class="btn">Quay lại danh sách</a>
