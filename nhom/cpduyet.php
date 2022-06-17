<?php
/*///////////////////////
//@Tac gia: Nguyen Ary
//@Site: gochep.net
//@Facebook: facebook.com/tia.chophht
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Quản lí duyệt đơn';
require('../incfiles/head.php');
include_once('func.php');
$id = intval($_GET['id']);
$sid = intval($_GET['sid']);
if(isset($_GET['duyet']) || isset($_GET['huy'])) {
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'"),0);
if(!isset($id) || $dem == 0) {
echo '<br/><div class="tb">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$nhom = nhom($id);
if($nhom['user_id'] != $user_id) {
echo '<br/><div class="tb">Bạn không đủ quyền!</div>';
require('../incfiles/end.php');
exit;
}
if($sid == $user_id) {
echo '<br/><div class="tb">Không thể thực hiện!</div>';
require('../incfiles/end.php');
exit;
}
}
echo '<div class="tb">Quản lí tất cả đơn xin gia nhập vào các nhóm của bạn</div>';
if(isset($_GET['duyet']) && isset($_GET['sid'])) {
$kt =mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='$id' AND `user_id`='$sid' AND `duyet`='0'"),0);
if($kt > 0) {
mysql_query("UPDATE `nhom_user` SET `duyet`='1' WHERE `id`='$id' AND `user_id`='$sid'");
$tdem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_tb` WHERE `id`='".$id."' AND `user_id`='".$user_id."' AND `fr_user`='".$sid."' AND `type`='4'"),0);
if($sid!=$user_id) {
if($tdem==0) {
mysql_query("INSERT INTO `nhom_tb` SET `id`='".$id."', `user_id`='".$user_id."', `fr_user`='".$sid."', `type`='4', `time`='".$time."'");
} else {
mysql_query("UPDATE `nhom_tb` SET `time`='".$time."', `read`='0' WHERE `id`='".$id."' AND `user_id`='".$user_id."' AND `fr_user`='".$sid."' AND `type`='4'");}
}
}
}
if(isset($_GET['huy']) && isset($_GET['sid'])) {
$kt =mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='$id' AND `user_id`='$sid' AND `duyet`='1'"),0);
if($kt > 0) {
mysql_query("DELETE FROM `nhom_user` WHERE `id`='$id' AND `user_id`='$sid'");
}
}
echo '<div class="mainblok"><div class="phdr"><b>Đơn xin gia nhập</b></div>';
$tong = mysql_num_rows(mysql_query("SELECT `nhom`.`id`, `nhom`.`user_id`, `nhom`.`name`, `nhom_user`.* FROM `nhom` RIGHT JOIN `nhom_user` ON `nhom`.`id`=`nhom_user`.`id` WHERE `nhom`.`user_id`='".$user_id."' AND `nhom_user`.`duyet`='0'"));
if($tong){
$req = mysql_query("SELECT `nhom`.`id`, `nhom`.`user_id`, `nhom`.`name`, `nhom_user`.* FROM `nhom` RIGHT JOIN `nhom_user` ON `nhom`.`id`=`nhom_user`.`id` WHERE `nhom`.`user_id`='".$user_id."' AND `nhom_user`.`duyet`='0' ORDER BY `nhom_user`.`id` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
echo '<div class="list1">'.ten_nick($res['user_id'],1,$res['id']).'<div class="rtb"><b>Nhóm: </b><span class="xam">'.$res['name'].'</span></div><form method="post" action="cpduyet.php?duyet&id='.$res['id'].'&sid='.$res['user_id'].'"><input type="submit" value="Duyệt" />&#160;&#160;&#160;&#160;<a href="cpduyet.php?huy&id='.$res['id'].'&sid='.$res['user_id'].'"><input type="button" value="Hủy" /></a></form></div>';
}
if ($tong > $kmess){echo '<div class="topmenu">' . functions::display_pagination('duyet.php?id='.$id.'&', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="tb">Không có đơn nào!</div>';
}
echo '</div>';
require('../incfiles/end.php');
?>
