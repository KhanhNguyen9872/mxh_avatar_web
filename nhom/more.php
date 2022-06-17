<?php
/*///////////////////////
//@Diendanvn.me
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Thành viên';
require('../incfiles/head.php');
include_once('func.php');
$id = intval(abs($_GET['id']));

switch($act) {
default:
echo '<div class="mainblok"><div class="phdr"><b>Nhóm tham gia</b></div>';
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `user_id`='$user_id'"),0);
if($dem) {
$req = mysql_query("SELECT * FROM `nhom_user` WHERE `user_id`='$user_id' ORDER BY `time` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
$nhom = nhom($res['id']);
echo '<div class="omenu"><img src="nhom.png"/> <a href="page.php?id='.$res['id'].'"><b><font color="2c5170">'.$nhom['name'].'</font></b></a><br/ >'.catchu($nhom['gt'],0,10).' ...</div>';
}
if ($dem > $kmess){echo '<div class="phantrang">' . functions::display_pagination('more.php?', $start, $dem, $kmess) . '</div>';
}
} else {
echo '<div class="menu" align="center">Chưa tham gia nhóm nào!</div>';
}
echo '</div>';
break;

case 'nhom':
echo '<div class="mainblok"><div class="phdr"><b>Danh sách nhóm</b></div><div><div class="da">';
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom`"),0);
if($dem) {
$req = mysql_query("SELECT * FROM `nhom` WHERE `user_id`!='$user_id' ORDER BY `time` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
$nhom = nhom($res['id']);
echo '<div class="lucifer"><img src="'.$home.'/images/clan/'.$nhom['icon'].'.png"> <a href="page.php?id='.$res['id'].'"><b><font color="2c5170">'.$nhom['name'].'</font></b></a><br/ >'.catchu($nhom['gt'],0,10).' ...</div>';
}
if ($dem > $kmess){echo '<div class="phantrang">' . functions::display_pagination('more.php?act=nhom&', $start, $dem, $kmess) . '</div>';
}
} else {
echo '<div class="menu" align="center">Chưa có nhóm nào!</div>';
}
echo '</div>';
break;
case 'mem':
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'"),0);
if(isset($id) && $dem == 0) {
echo '<br/><div class="omenu">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'"),0);
if(!isset($id) || $dem == 0) {
echo '<br/><div class="omenu">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$nhom = nhom($id);
echo '<div class="phdr"><b>Thành viên</b></div><div class="da"><div >';
$tong =mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='$id' AND `duyet`='1'"),0);
$req =mysql_query("SELECT * FROM `nhom_user` WHERE `id`='$id' AND `duyet`='1' ORDER BY `time` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
echo '<div class="lucifer">'.ten_nick($res['user_id'],1,$res['id']).'<br/>'.($res['user_id']!=$user_id && $nhom['user_id']==$user_id ? '<a href="set.php?id='.$id.'&sid='.$res['user_id'].'"><b><font color="2c5170">Chức vụ</font></b></a> - <a href="set.php?act=duoi&id='.$id.'&sid='.$res['user_id'].'" style="color:red;"><b>Đuổi</b></a>':'').'</div>';
}
if ($tong > $kmess){echo '<div class="phantrang">' . functions::display_pagination('more.php?act=mem&id='.$id.'&', $start, $tong, $kmess) . '</div>';
}
echo '<div class="list1"><a href="page.php?id='.$id.'"><i class="fa fa-reply" aria-hidden="true"></i> Trở về nhóm</a></div>';
break;
case 'like':
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `id`='".$id."'"),0);
if($dem == 0) {
echo '<br/><div class="list1">Bài đăng không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}

echo '<div class="mainblok"><div class="phdr"><b>Người thích bài đăng</b></div>';
$tong =mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='$id'"),0);
$req =mysql_query("SELECT * FROM `nhom_like` WHERE `id`='$id' ORDER BY `time` DESC LIMIT $start,$kmess");
while($red=mysql_fetch_array($req)) {
$res = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_bd` WHERE `id`='".$red['id']."'"));
echo '<div class="omenu">'.ten_nick($red['user_id'],1,$res['id']).'</div>';
}
if ($tong > $kmess){echo '<div class="topmenu">' . functions::display_pagination('more.php?act=like&id='.$id.'&', $start, $tong, $kmess) . '</div>';
}
echo '</div>';

break;

echo '</div>';
}

require('../incfiles/end.php');
?>