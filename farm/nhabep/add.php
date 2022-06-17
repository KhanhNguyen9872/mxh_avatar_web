<?php
define('_IN_JOHNCMS', 1);
require('../../incfiles/core.php');
if (!$rights == 9) {
header("Location: $home");
}
$textl = 'Thêm nguyên liệu nhà bếp';
require('../../incfiles/head.php');
require('../../incfiles/lib/class.upload.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thêm nguyên liệu nhà bếp</div>';
if(isset($_POST['submit'])){
$tenvatlieu = $_POST['tenvatlieu'];
$loainguyenlieu = $_POST['loainguyenlieu'];
$loainguyenlieu2 = $_POST['loainguyenlieu2'];
$songuyenlieu = $_POST['songuyenlieu'];
$songuyenlieu2 = $_POST['songuyenlieu2'];
$diem = $_POST['diem'];
$soxu = $_POST['soxu'];
$timenau = $_POST['timenau'];

mysql_query("INSERT INTO `farm_nhabep` SET 
`tenvatlieu`='".$tenvatlieu."',
`loainguyenlieu`='".$loainguyenlieu."',
`loainguyenlieu2`='".$loainguyenlieu2."',
`songuyenlieu`='".$songuyenlieu."',
`songuyenlieu2`='".$songuyenlieu2."',
`timenau`='".$timenau."',
`timenguyenlieu`='".time()."',
`soxu`='".$soxu."',
`diem`='".$diem."'
");
$insertid = mysql_insert_id();
header("Location: $home/farm/nhabep/");
} else {
echo'<form enctype="multipart/form-data" method="post">';
echo'<div class="menu list-bottom congdong">';
echo'Loại: <select name="loainguyenlieu">
<option value = "1">Lúa</option>
<option value = "2">Cà chua</option>
<option value = "3">Cà rốt</option>
<option value = "4">Dứa</option>
<option value = "5">Dưa hấu</option>
<option value = "6">Nho</option>
<option value = "7">Hoa hồng</option>
<option value = "8">Xoài</option>
<option value = "9">Thanh long</option>
<option value = "10">Hoa hướng dương</option>
<option value = "11">Hoa tulip</option>
<option value = "31">Khế</option>
</select>';
echo'</div>';
echo'<div class="menu list-bottom">';
echo'Loại 2: <select name="loainguyenlieu2">
<option value = "0">Không có</option>
<option value = "1">Lúa</option>
<option value = "2">Cà chua</option>
<option value = "3">Cà rốt</option>
<option value = "4">Dứa</option>
<option value = "5">Dưa hấu</option>
<option value = "6">Nho</option>
<option value = "7">Hoa hồng</option>
<option value = "8">Xoài</option>
<option value = "9">Thanh long</option>
<option value = "10">Hoa hướng dương</option>
<option value = "11">Hoa tulip</option>
<option value = "28">Trứng</option>
<option value = "29">Sữa bò</option>
</select>';
echo'</div>';
echo'<div class="menu">';
echo'Tên vật liệu: <input type="text" name="tenvatlieu" /><br/>';
echo'Số nguyên liệu: <input type="text" name="songuyenlieu" /><br/>';
echo'Số nguyên liệu 2: <input type="text" name="songuyenlieu2" /><br/>';
echo'Số xu: <input type="text" name="soxu" /><br/>';
echo'Điểm nhận: <input type="text" name="diem" /><br/>';
echo'Time nấu: <input type="text" name="timenau" /><br/>';
echo'<input type="submit" value="Lưu lại" name="submit" />';
echo'</form>';
echo "</div>";
}
echo'</div>';
require_once('../../incfiles/end.php');
?>