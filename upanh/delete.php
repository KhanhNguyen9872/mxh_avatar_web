<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl = 'Upload ảnh';
require('../incfiles/head.php');

if($style == "web") echo '<div class="bodyf"><div class="container">';
$id = intval($_GET['id']);

$reg = mysql_fetch_assoc(mysql_query("SELECT * FROM `imgupload` WHERE `id` = '$id'"));
$kt = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = {$reg['user']}"));
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `imgupload` WHERE `id` = '$id'"),0);

if($datauser['name'] == $kt['name']){
if($check >0){
if(isset($_POST['submit'])){
mysql_query("DELETE FROM `imgupload` WHERE `id` = '$id'");
echo '<div class="list1">Bạn đã xóa file ảnh thành công</div>';
} else {
echo '<div class="phdr">Xóa file</div><div class="list1">Bạn muốn xóa file ảnh đã chọn<br /><form method="POST"><input type="submit" name="submit" value="Xóa">&#160;&#160;<a href="index.php"><input type="button" value="Hủy" /></a></form>';
}
} else {
echo '<div class="rmenu">File ảnh không tồn tại</div>';
} 
} else {
if($rights >=3 && $rights >= $kt['rights']){
if($check >0){
if(isset($_POST['submit'])){
mysql_query("DELETE FROM `imgupload` WHERE `id` = '$id'");
echo '<div class="list1">Bạn đã xóa file ảnh thành công</div>';
} else {
echo '<div class="phdr">Xóa file</div><div class="list1">Bạn muốn xóa file ảnh đã chọn<br /><form method="POST"><input type="submit" name="submit" value="Xóa">&#160;&#160;<a href="index.php"><input type="button" value="Hủy" /></a></form>';
}
} else {
echo '<div class="rmenu">File ảnh không tồn tại</div>';
}
} else {
echo '<div class="rmenu">Bạn không đủ quyền để xóa ảnh này</div>';
}



}
require('../incfiles/end.php');
?>
