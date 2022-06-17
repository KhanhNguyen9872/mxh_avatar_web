<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Biến hình Vẹt';
require('../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="phdr"><center>'.$textl.' - (10 lượng)</center></div>';
$check1=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='46' AND `timesudung`='0'"));
$check2=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='47' AND `timesudung`='0'"));
$check3=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='48' AND `timesudung`='0'"));
$check4=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='49' AND `timesudung`='0'"));
$check5=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='54' AND `timesudung`='0'"));
$check6=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='55' AND `timesudung`='0'"));
$check7=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='16' AND `timesudung`='0'"));
if ($check1<1&&$check2<1&&$check3<1&&$check4<1&&$check5<1&&$check6<1&&$check7<1) {
echo '<div class="rmenu">Bạn không có vẹt hoặc vẹt của bạn không vĩnh viễn...</div>';
} else {
$vet=array(46,47,48,49,54,55,16);
if (isset($_POST['submit'])) {
if ($datauser['vnd']<10) {
echo '<div class="rmenu">Bạn không đủ tiền để biến hình vẹt</div>';
} else {
$randbien=rand(0,6);
$bienhinh=$vet[$randbien];
$name=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `loai`='thucung' AND `id_loai`='".$bienhinh."'"));
//Xóa vật phẩm củ
if ($check1>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='46'");
} else if ($check2>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='47'");
} else if ($check3>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='48'");
} else if ($check4>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='49'");
} else if ($check5>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='54'");
} else if ($check6>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='55'");
} else if ($check7>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='16'");
}
//Trừ tiền
mysql_query("UPDATE `users` SET `vnd`=`vnd`-'10' WHERE `id`='".$user_id."'");
//Add kirby mới
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`tenvatpham`='".$name['tenvatpham']."',
`loai`='thucung',
`id_loai`='".$bienhinh."',
`id_shop`='".$name[id]."'
");
echo '<div class="rmenu">Vẹt bạn đã biến thành <b>'.$name['tenvatpham'].'</b></div>';
}
}
echo '<center>';
for ($i=0; $i<count($vet);$i++) {
$xxx=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `loai`='thucung' AND `id_loai`='".$vet[$i]."'"));
echo '<img src="/images/shop/'.$xxx[id].'.png">';
}
echo '</center>';
echo '<form method="post"><center><input type="submit" name="submit" value="Biến hình"></center></form>';
}
echo '</div>';
require('../incfiles/end.php');
?>