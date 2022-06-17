<?php
/*///////////////////////
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Thông tin nhóm';
require('../incfiles/head.php');
include_once('func.php');
$id= intval(abs($_GET['id']));
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'"),0);
if(!isset($id) || $dem == 0) {
echo '<br/><div class="menu">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$nhom = nhom($id);
$user = user_nick($nhom['user_id']);
$t = $nhom['time'];
echo '<div class="mainblok"><div class="phdr"><b>Thông tin nhóm</b></div><div class="menu"><b>Người lập: </b>'.$user['name'].'<br/><b>Ngày lập: </b>'.date("d/m/Y",$t+7*3600).'<br/><b>Khâu hiệu: </b>'.$nhom['gt'].'</div></div>';
require('../incfiles/end.php');
?>
