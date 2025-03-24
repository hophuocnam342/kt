<h1>CHI TIẾT ĐĂNG KÝ</h1>

<table>
    <thead>
        <tr>
            <th>Mã HP</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $totalCredits = 0;
        while($row = $courses->fetch(PDO::FETCH_ASSOC)): 
            $totalCredits += $row['SoTinChi'];
        ?>
            <tr>
                <td><?php echo $row['MaHP']; ?></td>
                <td><?php echo $row['TenHP']; ?></td>
                <td><?php echo $row['SoTinChi']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">Tổng số tín chỉ:</td>
            <td><?php echo $totalCredits; ?></td>
        </tr>
    </tfoot>
</table>

<a href="index.php?controller=registration&action=history" class="btn">Quay lại danh sách</a>
