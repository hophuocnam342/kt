<h1>TRANG SINH VIÊN</h1>
<a href="index.php?controller=student&action=create" class="btn">Thêm Sinh Viên</a>

<table>
    <thead>
        <tr>
            <th>MaSV</th>
            <th>HoTen</th>
            <th>GioiTinh</th>
            <th>NgaySinh</th>
            <th>Hinh</th>
            <th>MaNganh</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php if(isset($students) && $students->rowCount() > 0): ?>
            <?php while($row = $students->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['MaSV']; ?></td>
                    <td><?php echo $row['HoTen']; ?></td>
                    <td><?php echo $row['GioiTinh']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['NgaySinh'])); ?></td>
                    <td>
                        <?php if(!empty($row['Hinh']) && file_exists($row['Hinh'])): ?>
                            <img src="<?php echo $row['Hinh']; ?>" width="50" height="50">
                        <?php else: ?>
                            <img src="assets/images/no-image.jpg" width="50" height="50">
                        <?php endif; ?>
                    </td>
                    <td><?php echo isset($row['TenNganh']) ? $row['TenNganh'] : $row['MaNganh']; ?></td>
                    <td>
                        <a href="index.php?controller=student&action=edit&id=<?php echo $row['MaSV']; ?>" class="btn btn-info">Sửa</a>
                        <a href="index.php?controller=student&action=delete&id=<?php echo $row['MaSV']; ?>" class="btn btn-danger">Xóa</a>
                        <a href="index.php?controller=student&action=detail&id=<?php echo $row['MaSV']; ?>" class="btn">Chi tiết</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Không có dữ liệu sinh viên.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="index.php" class="btn">Quay lại</a>
