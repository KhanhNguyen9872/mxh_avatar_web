<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl = 'Upload ảnh - 8vui.top';
require('../incfiles/head.php');
if($style == "web") echo '<div class="bodyf"><div class="container">';
$id = isset($_GET['id']) ? intval($_GET['id']):'2';
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `imgupload` WHERE `id` = '$id'"),0);
if($check >0){
$reg = mysql_query("SELECT * FROM `imgupload` WHERE `id` = '$id'");
while($arr=mysql_fetch_assoc($reg)){
$res = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = {$arr['user']} LIMIT 1"));

echo '<div class="phdr">Thông tin</div><div class="lucifer"><img style="padding:2px;border:1px solid #CECECE;" src="'.$arr['url'].'" alt="hình ảnh ID Thiên Ân" width="100" height="75"><br /><a href="'.$arr['url'].'">
<br>
<button type="button" class="btn btn-dark">Download ảnh ('.$arr['size'].'KB)</button>
</a>
<br>
';

if($user_id == $res['id'] || $rights > $res['rights']){
echo '<br /><a href="delete.php?id='.$arr['id'].'"><b>Xóa</b></a>';
}
echo '<b>• Người  Upload: '.nick($res['id']).'<br />• Lúc: '.functions::display_date($arr['time']).'<br />• Kích thước:'.$arr['size'].' KB</b>Chia sẽ:<br /><textarea>[img]'.$arr['url'].'[/img]</textarea></div>';
}
} else {
echo '<div class="rmenu">File ảnh không tồn tại hoặc đã bị xóa</div>';
}
echo'<div><div>';
require('../incfiles/end.php');
?>