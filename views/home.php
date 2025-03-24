<div class="hero">
    <h1>QUẢN LÝ SINH VIÊN VÀ ĐĂNG KÝ HỌC PHẦN</h1>
    <p style="font-size: 18px; margin-bottom: 30px; color: #666;">Hệ thống quản lý sinh viên và đăng ký học phần trực tuyến</p>
</div>

<div class="card-container">
    <div class="feature-card">
        <h2>Quản lý Sinh viên</h2>
        <p>Xem danh sách, thêm, sửa, xóa và xem chi tiết thông tin sinh viên trong hệ thống.</p>
        <a href="index.php?controller=student&action=index" class="btn">Truy cập</a>
    </div>
    
    <div class="feature-card">
        <h2>Danh sách Học Phần</h2>
        <p>Xem danh sách các học phần được mở và cập nhật số lượng dự kiến sinh viên.</p>
        <a href="index.php?controller=course&action=index" class="btn">Truy cập</a>
    </div>
    
    <?php if(isset($_SESSION['MaSV'])): ?>
        <div class="feature-card">
            <h2>Đăng ký Học Phần</h2>
            <p>Sinh viên đăng ký các học phần trong học kỳ hiện tại.</p>
            <a href="index.php?controller=registration&action=register" class="btn">Đăng ký ngay</a>
        </div>
        
        <div class="feature-card">
            <h2>Lịch sử Đăng ký</h2>
            <p>Xem lịch sử đăng ký học phần của bạn.</p>
            <a href="index.php?controller=registration&action=history" class="btn">Xem lịch sử</a>
        </div>
    <?php else: ?>
        <div class="feature-card">
            <h2>Đăng nhập</h2>
            <p>Sinh viên đăng nhập vào hệ thống để đăng ký học phần.</p>
            <a href="index.php?controller=auth&action=login" class="btn">Đăng nhập</a>
        </div>
    <?php endif; ?>
</div>

<div class="card" style="margin-top: 40px;">
    <h2>Hướng dẫn sử dụng:</h2>
    <ol style="line-height: 1.6;">
        <li>Quản lý Sinh viên: Xem danh sách, thêm, sửa, xóa và xem chi tiết sinh viên</li>
        <li>Danh sách Học Phần: Xem danh sách học phần và cập nhật số lượng dự kiến</li>
        <li>Đăng ký Học Phần: Sinh viên đăng ký các học phần</li>
        <li>Đăng nhập: Sinh viên đăng nhập vào hệ thống để đăng ký học phần</li>
        <li>Lịch sử Đăng ký: Xem lịch sử đăng ký học phần</li>
    </ol>
</div>
