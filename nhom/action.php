<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Hành động';
require('../incfiles/head.php');
include_once('func.php');
$id= intval(abs($_GET['id']));
switch($act) {
default:
header('Location: index.php');
break;
case 'like':
$req = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_bd` WHERE `id`='$id'"));
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `id`='".$id."'"),0);
if($dem == 0) {
echo '<br/><div class="omenu">Bài đăng không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$req['sid']."'AND `user_id`='".$user_id."' AND `duyet`='1'") ,0);
if($kt == 0) {
echo '<div class="omenu">Phải là thành viên của nhóm!</div>';
require('../incfiles/end.php');
exit;
}
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='$id' AND `user_id`='$user_id'"),0);
if($dem == 1) {
echo '<br/><div class="omenu">Bạn đã thích bài viết rồi!</div>';
require('../incfiles/end.php');
exit;
}
mysql_query("INSERT INTO `nhom_like` SET `id`='".$id."', `user_id`='".$user_id."', `type`='".$req['type']."', `time`='".$time."'");

if($req['type']==0 || $req['type']==1) {
$type = 0; }
if($req['type']==2) {
$type = 1; }

$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_tb` WHERE `sid`='".$id."' AND `id`='".$req['id']."' AND `user_id`='".$user_id."' AND `fr_user`='".$req['user_id']."' AND `type`='".$type."'"),0);
if($req['user_id']!=$user_id) {
if($dem==0) {
mysql_query("INSERT INTO `nhom_tb` SET `sid`='".$id."', `id`='".$req['id']."', `user_id`='".$user_id."', `fr_user`='".$req['user_id']."', `type`='".$type."', `time`='".$time."'");
} else {
mysql_query("UPDATE `nhom_tb` SET `time`='".$time."', `read`='0' WHERE `sid`='".$id."' AND `id`='".$req['id']."' AND `user_id`='".$user_id."' AND `fr_user`='".$req['user_id']."' AND `type`='".$type."'");
}
}
$ref = $_SERVER['HTTP_REFERER'];
if(isset($ref)) {
header("Location: $ref"); } else {
$ur = 'page.php?id='.$req['sid'].'';
header("Location: $ur");
}
break;
case 'dislike':
$req = mysql_fetch_array(mysql_query("SELECT `sid`, `type` FROM `nhom_bd` WHERE `id`='$id'"));
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `id`='".$id."'"),0);
if($dem == 0) {
echo '<br/><div class="omenu">Bài đăng không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$req['sid']."'AND `user_id`='".$user_id."' AND `duyet`='1'") ,0);
if($kt == 0) {
echo '<div class="omenu">Phải là thành viên của nhóm!</div>';
require('../incfiles/end.php');
exit;
}
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='$id' AND `user_id`='$user_id'"),0);
if($dem == 0) {
echo '<br/><div class="omenu">Bạn chưa thích bài viết nên không thể bỏ thích!</div>';
require('../incfiles/end.php');
exit;
}
mysql_query("DELETE FROM `nhom_like` WHERE `id`='".$id."' AND `user_id`='".$user_id."'");
$ref = $_SERVER['HTTP_REFERER'];
if(isset($ref)) {
header("Location: $ref"); } else {
$ur = 'page.php?id='.$req['sid'].'';
header("Location: $ur");
}
break;
case 'del':
$req = mysql_fetch_array(mysql_query("SELECT `sid`,`user_id` FROM `nhom_bd` WHERE `id`='$id'"));
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `id`='".$id."'"),0);
if($dem == 0) {
echo '<br/><div class="omenu">Bài đăng không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$xoa = mysql_fetch_array(mysql_query("SELECT `rights` FROM `nhom_user` WHERE `id`='".$req['sid']."' AND `user_id`='".$req['user_id']."'"));
$xoa2 = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_user` WHERE `id`='".$req['sid']."' AND `user_id`='".$user_id."'"));
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$req['sid']."'AND `user_id`='".$user_id."' AND `duyet`='1'") ,0);
if($xoa2['rights']<$xoa['rights']) {
echo '<br/><div class="omenu">Bạn không đủ quyền để thực hiện điều này! </div>';
require('../incfiles/end.php');
exit;
}
$bv = mysql_fetch_array(mysql_query("SELECT `time` FROM `nhom_bd` WHERE `id`='$id'"));
if(isset($_POST['sub'])) {
mysql_query("DELETE FROM `nhom_bd` WHERE `id`='$id'");
mysql_query("DELETE FROM `nhom_bd` WHERE `cid`='$id'");
mysql_query("DELETE FROM `nhom_like` WHERE `id`='$id'");
mysql_query("DELETE FROM `nhom_like` WHERE `nhom_bd`.`cid`=`nhom_like`.`id`");
$img = @getimagesize('files/anh_'.$bv['time'].'.jpg');
if(is_array($img)) {
@unlink('files/anh_'.$bv['time'].'.jpg'); }

$ur = 'page.php?id='.$req['sid'].'';
header("Location: $ur");
} else {
echo '<div class="phdr"><b>Xoá bài đăng</b></div><div class="omenu"><form method="post">Bạn muốn xoá bài viết?<br/><input type="submit" name="sub" value="Xoá" />&#160;&#160;&#160;<a href="page.php?id='.$req['sid'].'"><input type="button" value="Hủy" /></a></form></div>';
}
break;
case 'post':
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `id`='".$id."'"),0);
if($dem == 0) {
echo '<br/><div class="omenu">Bài đăng không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$req = mysql_fetch_array(mysql_query("SELECT `sid`,`text`,`user_id` FROM `nhom_bd` WHERE `id`='$id'"));
$text =functions::checkout($req['text'], 1, 1);
$text = functions::smileys(tags($text));
echo '<div class="mainblok"><div class="phdr"><b>Chi tiết bài đăng</b></div><div class="rtb">'.ten_nick($req['user_id'],1,$req['sid']).'</div><div class="omenu">'.$text.'</div></div>';
break;
case 'xoanhom':
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'"),0);
if($dem == 0) {
echo '<br/><div class="omenu">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}

$req = mysql_fetch_array(mysql_query("SELECT `user_id` FROM `nhom` WHERE `id`='$id'"));
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$id."'AND `user_id`='".$user_id."' AND `duyet`='1'") ,0);


if(isset($_POST['sub'])) {
if($datauser['rights'] < 9) {
echo '<div class="omenu">Bạn không đủ quyền!</div>';
} else {
mysql_query("DELETE FROM `nhom` WHERE `id`='$id'");
mysql_query("DELETE FROM `nhom_user` WHERE `id`='$id'");
mysql_query("DELETE FROM `nhom_bd`,`nhom_like` WHERE `nhom_bd`.`sid`='$id' AND `nhom_bd`.`id`=`nhom_like`.`id`");
header("Location: index.php");
}
} else {
if($datauser['rights'] < 9) {
echo '<div class="omenu">Bạn không đủ quyền!</div>';
} else {
echo '<div class="phdr"><b>Xoá nhóm</b></div>
<div class="omenu"><form method="post">Bạn thực sự muốn xoá nhóm?<br/><input type="submit" name="sub" value="Xoá"/>&#160;&#160;&#160;&#160;&#160;<a href="index.php"><input type="button" value="Hủy"/></a></form></div>';
}
}


break;
}
require('../incfiles/end.php');
?>
