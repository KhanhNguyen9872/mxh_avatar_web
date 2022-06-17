<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
if (!$rights == 9) {
require('../incfiles/head.php');
header("Location: $home");
require('../incfiles/end.php');
exit;
}
$textl = 'Thêm đồ';
require('../incfiles/head.php');
require('../incfiles/lib/class.upload.php');
echo'<div class="main-xmenu">';
echo'<div class="phdr">Thêm đồ</div>';
if ($rights >= 9) {
if(isset($_POST['submit'])){
$loai = $_POST['loai'];
$loai = trim($_POST['loai']);
$chedo = $_POST['chedo'];
$chedo = trim($_POST['chedo']);
$id_loai = $_POST['id_loai'];
$gioitinh = $_POST['gioitinh'];
$gia = $_POST['gia'];
$loaitien = $_POST['loaitien'];
$hienthi = isset($_POST['hienthi']) ? 1 : 0;
$clan = isset($_POST['clan']) ? 1 : 0;
$tenvatpham = $_POST['tenvatpham'];
$total = count(array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/images/'.$loai.'-rip'), array('..', '.')));
$insertid = $total;
mysql_query("INSERT INTO `shopdo` SET
`loai`='".$loai."',
`id_loai`='".$insertid."',
`gia`='".$gia."',
`loaitien`='".$loaitien."',
`gioitinh`='".$gioitinh."',
`tenvatpham`='".$tenvatpham."',
`clan`='".$clan."',
`hienthi`='".$hienthi."'
");
if ($hienthi==0&&$clan==0) {
$bot='[b]'.$login.' vừa thêm [red]'.$tenvatpham.' [/red] vào shop![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
}
$file =  $_FILES['imagefile']['tmp_name'];
list($w, $h) = getimagesize($file);
$handle = new upload($_FILES['imagefile']);
if ($handle->uploaded) {
// Обрабатываем фото
$handle->file_new_name_body = $insertid;
//$handle->mime_check = false;
$handle->allowed = array(
'image/jpeg',
'image/gif',
'image/png'
);
$handle->file_max_size = 1024 * $set['flsz'];
$handle->file_overwrite = true;
if($w > 1000) {
$handle->image_resize = true;
$handle->image_x = 800;
$handle->image_y = false;
} else {
$handle->image_resize = false;
}
$handle->image_ratio_y = true;
$handle->image_convert = 'png';
$handle->process('../images/'.$loai.'-rip/'.$chedo.'');
$handle->clean();
}

$file =  $_FILES['imagefile2']['tmp_name'];
list($w, $h) = getimagesize($file);
$handle = new upload($_FILES['imagefile2']);
if ($handle->uploaded) {
// Обрабатываем фото
$handle->file_new_name_body = $insertid;
//$handle->mime_check = false;
$handle->allowed = array(
'image/jpeg',
'image/gif',
'image/png'
);
$handle->file_max_size = 1024 * $set['flsz'];
$handle->file_overwrite = true;
if($w > 1000) {
$handle->image_resize = true;
$handle->image_x = 800;
$handle->image_y = false;
} else {
$handle->image_resize = false;
}
$handle->image_ratio_y = true;
$handle->image_convert = 'png';
$handle->process('../images/'.$loai.'-rip/load');
$handle->clean();
}
header("Location: add.php");
}else{
echo'<form enctype="multipart/form-data" method="post">';
echo'<div class="omenu">';
echo'Loại: <select name="loai">
<option value = "toc">Tóc</option>
<option value = "ao">Áo</option>
<option value = "quan">Quần</option>
<option value = "non">Mũ</option>
<option value = "kinh">Kính</option>
<option value = "mat">Mắt</option>
<option value = "matna">Mặt Nạ</option>
<option value = "khuonmat">Khuôn Mặt</option>
<option value = "canh">Cánh</option>
<option value = "thucung">Thú Cưng</option>
<option value = "docamtay">Đồ Cầm Tay</option>
<option value = "haoquang">Hào Quang</option>
</select>';
echo'</div>';
echo'<div class="news">';
echo'<input type="hidden" name="MAX_FILE_SIZE" value="' . (1024 * $set['flsz']) . '" />';
echo'Item: <input type="file" name="imagefile" value="" />';
echo'</div>';
echo'<div class="news">';
echo'Item động: <input type="file" name="imagefile2" value="" />';
echo'</div>';
echo'<div class="news">';
echo'Tên item: <input type="text" name="tenvatpham" /><br/>';
echo'Giới tính: <select name="gioitinh">
<option value =""> All</option>
<option value ="nam"> Nam</option>
<option value ="nu"> Nữ</option>
</select><br/>';
echo'Loại tiền: <select name="loaitien">
<option value = "xu"> Xu</option>
<option value = "vnd"> Lượng</option>
</select><br/>';
echo'Giá: <input type="text" name="gia" /><br/>';
echo'</div>';
echo '<div class="omenu"><input type="checkbox" value="1" name="hienthi"> Ko cho hiển thị trong shop<br/><input type="checkbox" value="1" name="clan"> Shop clan</div>';
echo'<input type="submit" value="Lưu lại" name="submit" />';
echo'</form>';
}
}
echo'</div>';
require_once('../incfiles/end.php');
?>
                            