<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Phòng Boss';
require('../../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
$id=(int)$_GET[id];
$ktp=mysql_num_rows(mysql_query("SELECT * FROM `boss_phong` WHERE `id`='".$id."'"));
$phong=mysql_fetch_array(mysql_query("SELECT * FROM `boss_phong` WHERE `id`='".$id."'"));
$info=mysql_fetch_array(mysql_query("SELECT * FROM `boss` WHERE `id`='".$phong[id_boss]."'"));
if ($ktp<1) {
echo '<div class="rmenu">Bàn chơi không tồn tại hoặc đã bị xóa</div>';
} else {
mysql_query("UPDATE `users` SET `phongbossdangchoi`='".$id."' WHERE `id`='".$user_id."'");
echo '<div class="phdr">Phòng đánh boss</div>';
echo '<div class="menu list-bottom congdong">Phòng '.$id.' <span style="font-size:11px;color:#e2e2e2;">|</span> Boss: '.$info[name].'</div>';
echo '<div class="menu"><br><div class="menu">Mức độ: ';
if ($phong[mucdo]==1) {
echo'<b style="color:#b3c253">Dễ</b>';
}
if ($phong[mucdo]==2) {
echo'<b style="color:#e89038">Thường</b>';
}
if ($phong[mucdo]==3) {
echo'<b style="color:red">Khó</b>';
}
echo '</div></div>';
}
$m=mysql_query("SELECT * FROM `users` WHERE `phongbossdangchoi`='".$id."'");
while($timkiem=mysql_fetch_array($m)) {
echo '<div class="menu">';
echo '<img src="/avatar/'.$timkiem[id].'.png" class="avatar_vina">';
$ss=mysql_num_rows(mysql_query("SELECT * FROM `boss_phong` WHERE (`play_1`='".$timkiem[id]."' OR `play_2`='".$timkiem[id]."' OR `play_3`='".$timkiem[id]."') AND (`wait_1`='1' OR `wait_1`='2' OR `wait_3`='1') "));
echo '<b>'.nick($timkiem[id]).'</b> <span style="font-size:12px;color:green;">'.($timkiem[id]==$phong[user_id]?'Chủ phòng':''.($ss>0?'Sẵn sàng':'').'').'</span><br>';
echo '</div>';
}
echo '</div>';
require('../../incfiles/end.php');
?>