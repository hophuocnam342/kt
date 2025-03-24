<h1>LỊCH SỬ ĐĂNG KÝ HỌC PHẦN</h1>

<table>
    <thead>
        <tr>
            <th>Mã ĐK</th>
            <th>Ngày ĐK</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $registrations->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['MaDK']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($row['NgayDK'])); ?></td>
                <td></td>
                <td>
                    <a href="index.php?controller=registration&action=detail&id=<?php echo $row['MaDK']; ?>" class="btn btn-info">Chi tiết</a>
                    <a href="index.php?controller=registration&action=delete&id=<?php echo $row['MaDK']; ?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="index.php" class="btn">Quay lại</a>