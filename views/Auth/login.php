<h1>ĐĂNG NHẬP</h1>

<?php if(isset($_GET['error']) && $_GET['error'] == 1): ?>
    <div style="color: red; margin-bottom: 10px;">Mã sinh viên không tồn tại!</div>
<?php endif; ?>

<form action="index.php?controller=auth&action=authenticate" method="post">
    <div class="form-group">
        <label for="MaSV">Mã SV:</label>
        <input type="text" id="MaSV" name="MaSV" required>
    </div>
    
    <button type="submit" class="btn">Đăng Nhập</button>
</form>

<a href="index.php" class="btn">Quay lại trang chủ</a>
