<h1>DANH SÁCH HỌC PHẦN</h1>

<table>
    <thead>
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Số Lượng Dự Kiến</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $courses->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['MaHP']; ?></td>
                <td><?php echo $row['TenHP']; ?></td>
                <td><?php echo $row['SoTinChi']; ?></td>
                <td>
                    60
                    
                    <form action="index.php?controller=course&action=updateExpectedNumber" method="post" style="display: none;">
                        <input type="hidden" name="MaHP" value="<?php echo $row['MaHP']; ?>">
                        <input type="hidden" name="SoLuongDuKien" value="60">
                        <button type="submit" class="btn">Cập nhật</button>
                    </form>
                </td>
                <td>
                    <?php if(isset($_SESSION['MaSV'])): ?>
                        <a href="index.php?controller=registration&action=addToCart&id=<?php echo $row['MaHP']; ?>" class="btn">Đăng ký</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="index.php" class="btn">Quay lại</a>
