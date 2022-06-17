<?php

define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
require('../incfiles/lib/class.upload.php');

$textl= 'Up ảnh avatar nhóm';
require('../incfiles/head.php');
include_once('func.php');
$id= intval(abs($_GET['id']));
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'"),0);
if(!isset($id) || $dem == 0) {
echo '<br/><div class="omenu">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$nhom = nhom($id);

if($nhom['user_id'] != $user_id) {
echo '<br/><div class="omenu">Không đủ quyền!</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="mainblok"><div class="phdr"><b>Up avatar nhóm</b></div>
<div class="omenu">';
if(isset($_POST['submit'])) {
$handle = new upload($_FILES['imagefile']);
if($handle->uploaded) {
$handle->file_new_name_body = $id;
//$handle->mime_check = false;
$handle->allowed = array('image/jpeg',
'image/gif',
'image/png');
$handle->file_max_size = 1024 * $set['flsz'];
$handle->file_overwrite = true;
$handle->image_resize = true;
$handle->image_x = 34;
$handle->image_y = 34;
$handle->image_convert ='png';
$handle->process('avatar/');
if ($handle->processed) {
echo '<div class="omenu">Tải lên avatar thành công! <a href="page.php?id='.$id.'">Trở về nhóm >></a></div></div>';
} else {
echo functions::display_error($handle->error);
}
$handle->clean();
}
} else {
echo'<form method="post" enctype="multipart/form-data">Chọn avatar nhóm:<br/><input type="file" name="imagefile" value=""/><input type="hidden" name="MAX_FILE_SIZE" value="'. (1024 * $set['flsz']) .'"/><br/><input type="submit" name="submit" value="Tải lên" /></div></form>';
}
echo '</div>';
require('../incfiles/end.php');
?>
