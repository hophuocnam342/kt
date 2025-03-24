<h1>THÔNG TIN CHI TIẾT</h1>

<table>
    <tr>
        <td>Mã SV:</td>
        <td><?php echo $this->student->MaSV; ?></td>
    </tr>
    <tr>
        <td>Họ Tên:</td>
        <td><?php echo $this->student->HoTen; ?></td>
    </tr>
    <tr>
        <td>Giới Tính:</td>
        <td><?php echo $this->student->GioiTinh; ?></td>
    </tr>
    <tr>
        <td>Ngày Sinh:</td>
        <td><?php echo date('d/m/Y', strtotime($this->student->NgaySinh)); ?></td>
    </tr>
    <tr>
        <td>Ngành:</td>
        <td><?php echo $this->student->MaNganh; ?></td>
    </tr>
    <tr>
        <td>Hình:</td>
        <td>
            <?php if(!empty($this->student->Hinh) && file_exists($this->student->Hinh)): ?>
                <img src="<?php echo $this->student->Hinh; ?>" width="150">
            <?php else: ?>
                <p>Không có hình</p>
            <?php endif; ?>
        </td>
    </tr>
</table>

<a href="index.php?controller=student&action=index" class="btn">Quay lại danh sách</a>
