<h1>GIỎ ĐĂNG KÝ HỌC PHẦN</h1>

<?php if(count($cart) > 0): ?>
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
            <?php foreach($cart as $course): ?>
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
        <a href="index.php?controller=registration&action=clearCart" class="btn btn-danger">Xóa tất cả</a>
        <a href="index.php?controller=registration&action=saveRegistration" class="btn">Lưu đăng ký</a>
    </p>
<?php else: ?>
    <p>Không có học phần nào trong giỏ.</p>
<?php endif; ?>

<a href="index.php?controller=registration&action=register" class="btn">Quay lại đăng ký</a>
