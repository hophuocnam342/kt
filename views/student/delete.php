<h1>XÓA THÔNG TIN</h1>

<p>Bạn có chắc chắn muốn xóa thông tin này?</p>

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
        <td>Ngày Sinh:</td>
        <td><?php echo date('d/m/Y', strtotime($this->student->NgaySinh)); ?></td>
    </tr>
    <tr>
        <td>Hình:</td>
        <td>
            <?php if(!empty($this->student->Hinh) && file_exists($this->student->Hinh)): ?>
                <img src="<?php echo $this->student->Hinh; ?>" width="100">
            <?php else: ?>
                <p>Không có hình</p>
            <?php endif; ?>
        </td>
    </tr>
</table>

<form action="index.php?controller=student&action=destroy" method="post">
    <input type="hidden" name="MaSV" value="<?php echo $this->student->MaSV; ?>">
    <button type="submit" class="btn btn-danger">Xóa</button>
    <a href="index.php?controller=student&action=index" class="btn">Hủy</a>
</form>
