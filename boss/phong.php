<?php

define('_IN_JOHNCMS', 1);
$noionline = 'boss';
require('../incfiles/core.php'); 
$textl= 'Phòng Boss'; 
$id= intval(abs($_GET['id']));
$areanonline = mysql_fetch_array(mysql_query("SELECT * FROM `boss` WHERE `id`='".$id."'"));
$hienluotboss3 = 2;
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Phòng Đấu Trường</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
$xoatb = mysql_fetch_array(mysql_query("SELECT * FROM `boss_notice` WHERE `phong`='".$id."'"));
if($xoatb['type'] == a) {
if($xoatb['view'] == 0) {
mysql_query("UPDATE `boss_notice` SET `view`='1' WHERE `id`='".$xoatb[id]."'");
}
}
$ktcr = mysql_result(mysql_query("SELECT COUNT(*) FROM `boss` WHERE `id`='".$id."'"),0);
if($ktcr==0 || empty($id)) {
echo '<div class="menu">Bàn chơi không tồn tại hoặc đã bị xoá!</div>';
echo'<a href="/boss/"><input type="button" value="Trở về"/></a>';
echo '</div>';
require('../incfiles/end.php');
exit;
}
$tuser = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$boss = mysql_fetch_array(mysql_query("SELECT `tenboss` FROM `boss_chien` WHERE `idboss`='".$areanonline['boss']."'"));
$ttboss = mysql_fetch_array(mysql_query("SELECT * FROM `boss_chien_arena` WHERE `phong`='".$id."'"));
include'sys/chuyennick.php';
$danh = array("Các ngươi chưa có tuổi gì để đấu với ta, ta sẽ dẫm chết tất cả các ngươi",
"tát vào má",
"cùi vào trym",
"xiết cổ",
"nắm tóc",
"bấu má");


echo'<div class="menu list-bottom congdong">Phòng '.$id.' <span style="font-size:11px;color:#e2e2e2;">|</span> Boss: '.$boss[tenboss].'';
if($areanonline['wait'] == 3) {
if($areanonline['cuaai'] == 1) {
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> <b style="color:red">Cửa ải 1</b>';
}
if($areanonline['cuaai'] == 2) {
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> <b style="color:red">Cửa ải 2</b>';
}
if($areanonline['cuaai'] == 3) {
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> <b style="color:red">Cửa ải 3</b>';
}
}
echo'</div>';
include'sys/chiso.php';
include'sys/insertplay.php';
include'sys/errorarena.php';
if ($areanonline['win'] == '3') {
echo'<div class="menu hot">';
echo'<img src="/boss/icon/1/'.$areanonline['boss'].'.png" alt="icon"/><br/>';
echo'Boss <span style="color:green;"><b>'.$boss[tenboss].'</b></span> đã đánh bại '.nick($areanonline['user_id']).''.(!empty($areanonline['nguoichoi']) ? ', '.nick($areanonline['nguoichoi']).''.(!empty($areanonline['nguoichoi2']) ? ', '.nick($areanonline['nguoichoi2']).'':'').''.(!empty($areanonline['nguoichoi3']) ? ', '.nick($res['nguoichoi3']).'':'').'':'').'';
echo '</div>';
} else if ($areanonline['win'] == '1') {
echo'<div class="menu">';
echo'<img src="/boss/icon/die/'.$areanonline['boss'].'.png" alt="icon"/><br/>';
echo'Boss "'.$boss[tenboss].'" đã bị <span style="color:green;"><b>đánh bại</b></span> xin chúc mừng !';
echo '</div>';
} else {
echo'<div class="menu">';

if($areanonline['wait'] == 0) {
echo'[ <b>'.$boss[tenboss].'</b> ]<br/>';
echo'<div class="menu">';
echo'Mức độ: ';
if ($areanonline['mucdo'] == 1) {echo'<b style="color:#b3c253">Dễ</b>';}
if ($areanonline['mucdo'] == 2) {echo'<b style="color:#e89038">Thường</b>';}
if ($areanonline['mucdo'] == 3) {echo'<b style="color:red">Khó</b>';}
echo '</div>';
}
if($areanonline['wait'] == 3) {
echo'[ <b>'.$boss[tenboss].'';
if($areanonline['cuaai'] == 1) {echo'</b> ] ';}
if($areanonline['cuaai'] == 2) {echo' phẫn nộ</b> ] ';}
if($areanonline['cuaai'] == 3) {echo' cuồng nộ</b> ] ';}
if ($areanonline['mucdo'] == 1) {echo'<b>Dễ</b>';}
if ($areanonline['mucdo'] == 2) {echo'<b>Thường</b>';}
if ($areanonline['mucdo'] == 3) {echo'<b style="color:red">Khó</b>';}
echo'<br/>SM: '.$ttboss['sucmanh'].'<br/>';
echo'HP: '.$ttboss['hp'].'';
}
echo '</div>';
if($areanonline['wait'] == 3) {
echo'<img src="/boss/hp/'.$id.'.png" alt="icon"/>';
}
}

if($areanonline['wait'] == 3) {
include'sys/thongbaobossdanh.php';
include'sys/thongbaotrongtran.php';
include'sys/timeluotdi.php';
include'sys/menuarena.php';
include'sys/avatardanhnhau.php';
include'sys/danh.php';
}
if($areanonline['wait'] == 0) {
include'sys/avatarchuabatdau.php';
include'sys/thongbaosansang.php';
include'sys/button.php';
}
echo '</div>';
include 'cmt.php';
Echo'<div><div>';
require('../incfiles/end.php');
?>