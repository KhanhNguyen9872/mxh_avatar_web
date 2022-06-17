<?php
/*///////////////////////
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
require('../incfiles/lib/class.upload.php');
$textl= 'Chia sẻ ảnh';
require('../incfiles/head.php');
include_once('func.php');
$id= intval(abs($_GET['id']));
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'"),0);
if(!isset($id) || $dem == 0) {
echo '<br/><div class="menu">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$id."'AND `user_id`='".$user_id."' AND `duyet`='1'") ,0);
if($kt == 0) {
echo '<div class="menu">Phải là thành viên của nhóm!</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="mainblok"><div class="phdr"><b>Chia sẻ hình ảnh</b></div><div class="menu">';
if(isset($_POST['submit'])) {
$handle = new upload($_FILES['imagefile']);
if($handle->uploaded) {
$handle->file_new_name_body = 'anh_'.$time.'';
//$handle->mime_check = false;
$handle->allowed = array('image/jpeg','image/gif','image/png');
$handle->file_max_size = 1024*$set['flsz'];
$handle->file_overwrite = true;
$handle->image_resize = true;
$handle->image_x = 640;
$handle->image_y = 480;
$handle->image_ratio_no_zoom_in = true;
$handle->image_convert ='jpg';
$handle->process('files/');
if($handle->processed) {
$mota = $_POST['mota'];
@mysql_query("INSERT INTO `nhom_bd` SET `sid`='$id', `user_id`='$user_id', `time`='$time', `stime`='$time', `text`='$mota', `type`='2'");
echo '<div class="menu">Tải lên ảnh thành công! <a href="page.php?id='.$id.'">Trở về nhóm >></a></div>';
} else {
echo functions::display_error($handle->error);
}
$handle->clean();
echo '</div>';
}
} else {
echo'<form enctype="multipart/form-data" method="post"><b>Chọn hình ảnh:</b><br/><input type="file" name="imagefile" value=""/><input type="hidden" name="MAX_FILE_SIZE" value="'. (1024 * $set['flsz']) .'"/><br/><b>Mô tả ảnh:</b><br/><textarea name="mota" cols="3"></textarea><div style="margin-top:4px;"><input type="submit" name="submit" value="Tải lên" /></div></div></form>';
}
echo '</div>';
require('../incfiles/end.php');
?>
