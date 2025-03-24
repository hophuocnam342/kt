<h1>ĐĂNG KÝ HỌC PHẦN</h1>

<?php if(isset($_SESSION['MaSV'])): ?>
    <p>Sinh viên: <?php echo $_SESSION['HoTen']; ?> (<?php echo $_SESSION['MaSV']; ?>)</p>
    
    <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <h2>Các học phần đã chọn:</h2>
        <table>
            <thead>
                <tr>
                    <th>Mã HP</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalCredits = 0;
                foreach($_SESSION['cart'] as $course): 
                    $totalCredits += $course['SoTinChi'];
                ?>
                    <tr>
                        <td><?php echo $course['MaHP']; ?></td>
                        <td><?php echo $course['TenHP']; ?></td>
                        <td><?php echo $course['SoTinChi']; ?></td>
                        <td>
                            <a href="index.php?controller=registration&action=removeFromCart&id=<?php echo $course['MaHP']; ?>" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Tổng số tín chỉ:</td>
                    <td><?php echo $totalCredits; ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        
        <p>
            <a href="index.php?controller=registration&action=clearCart" class="btn btn-danger">Xóa Đăng Ký</a>
            <a href="index.php?controller=registration&action=saveRegistration" class="btn">Lưu Đăng Ký</a>
        </p>
    <?php endif; ?>
    
    <h2>Danh sách học phần có thể đăng ký:</h2>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Số lượng dự kiến</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $courses->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['MaHP']; ?></td>
                <td><?php echo $row['TenHP']; ?></td>
                <td><?php echo $row['SoTinChi']; ?></td>
                <td><?php echo isset($row['SoLuongDuKien']) ? $row['SoLuongDuKien'] : 0; ?></td>
                <td>
                    <?php if(isset($_SESSION['MaSV']) && (!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$row['MaHP']]))): ?>
                        <a href="index.php?controller=registration&action=addToCart&id=<?php echo $row['MaHP']; ?>" class="btn">Đăng ký</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="index.php" class="btn">Quay lại</a>
