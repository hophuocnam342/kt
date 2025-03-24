<h1>THÔNG TIN HỌC PHẦN ĐÃ LƯU</h1>
<p>Đã đăng ký thành công!</p>

<h2>Thông tin đăng ký:</h2>
<table>
    <tr>
        <td>Mã đăng ký:</td>
        <td><?php echo $registration['MaDK']; ?></td>
    </tr>
    <tr>
        <td>Ngày đăng ký:</td>
        <td><?php echo date('d/m/Y', strtotime($registration['NgayDK'])); ?></td>
    </tr>
    <tr>
        <td>Mã sinh viên:</td>
        <td><?php echo $registration['MaSV']; ?></td>
    </tr>
    <tr>
        <td>Họ tên:</td>
        <td><?php echo $registration['HoTen']; ?></td>
    </tr>
</table>

<h2>Danh sách học phần đã đăng ký:</h2>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã HP</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $totalCredits = 0;
        while($row = $courses->fetch(PDO::FETCH_ASSOC)): 
            $totalCredits += $row['SoTinChi'];
        ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['MaHP']; ?></td>
                <td><?php echo $row['TenHP']; ?></td>
                <td><?php echo $row['SoTinChi']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Tổng số tín chỉ:</td>
            <td><?php echo $totalCredits; ?></td>
        </tr>
    </tfoot>
</table>

<p>
    <a href="index.php?controller=registration&action=register" class="btn">Quay lại đăng ký</a>
    <a href="index.php" class="btn">Về trang chủ</a>
</p>
