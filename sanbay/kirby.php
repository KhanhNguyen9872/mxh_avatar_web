<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Biến hình Kirby';
require('../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="phdr"><center>'.$textl.' - (10 lượng)</center></div>';
$check1=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='31' AND `timesudung`='0'"));
$check2=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='32' AND `timesudung`='0'"));
$check3=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='33' AND `timesudung`='0'"));
$check4=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='34' AND `timesudung`='0'"));
$check5=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='35' AND `timesudung`='0'"));
$check6=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='36' AND `timesudung`='0'"));
$check7=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='37' AND `timesudung`='0'"));
$check8=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='38' AND `timesudung`='0'"));
$check9=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='39' AND `timesudung`='0'"));
$check10=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='27' AND `timesudung`='0'"));
if ($check1<1&&$check2<1&&$check3<1&&$check4<1&&$check5<1&&$check6<1&&$check7<1&&$check8<1&&$check9<1&&$check10<1) {
echo '<div class="rmenu">Bạn không có Kirby hoặc kirby của bạn không vĩnh viễn...</div>';
} else {
$vet=array(31,32,33,34,35,36,37,38,39,27);
if (isset($_POST['submit'])) {
if ($datauser['vnd']<10) {
echo '<div class="rmenu">Bạn không đủ tiền để biến hình Kirby</div>';
} else {
$randbien=rand(0,9);
$bienhinh=$vet[$randbien];
$name=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `loai`='thucung' AND `id_loai`='".$bienhinh."'"));
//Xóa vật phẩm củ
if ($check1>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='31'");
} else if ($check2>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='32'");
} else if ($check3>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='33'");
} else if ($check4>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='34'");
} else if ($check5>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='35'");
} else if ($check6>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='36'");
} else if ($check7>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='37'");
} else if ($check8>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='38'");
}else if ($check9>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='39'");
}else if ($check10>=1) {
mysql_query("DELETE FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='thucung' AND `id_loai`='27'");
}
//Trừ tiền
mysql_query("UPDATE `users` SET `vnd`=`vnd`-'10' WHERE `id`='".$user_id."'");
//Add kirby mới
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`tenvatpham`='".$name['tenvatpham']."',
`loai`='thucung',
`id_loai`='".$bienhinh."',
`id_shop`='".$name['id']."'
");
echo '<div class="rmenu">Kirby bạn đã biến thành <b>'.$name['tenvatpham'].'</b></div>';
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