<?php
//--Thêm data vật phẩm by cRosSOver--//
$count=mysql_num_rows(mysql_query("SELECT * FROM `shopvatpham`"));
$i=1;
while ($i<=$count) {
$check=mysql_num_rows(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='".$i."'"));
if ($check<1) {
mysql_query("INSERT INTO `vatpham` SET `user_id`='".$user_id."', `id_shop`='".$i."'");
}
$i++;
}
//End
//--Thêm data đang mặc--//
//áo
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='ao'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='ao'");
}
//quần
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='quan'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='quan'");
}
//cánh
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='canh'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='canh'");
}
//đồ cầm tay
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='docamtay'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='docamtay'");
}
//thú cưng
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='thucung'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='thucung'");
}
//hào quang
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='haoquang'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='haoquang'");
}
//mặt nạ
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='matna'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='matna'");
}
//kính
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='kinh'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='kinh'");
}
//khuôn mặt
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='khuonmat'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='khuonmat'");
}
//tóc
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='toc'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='toc'");
}
//tóc
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='mat'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='mat'");
}
//nón
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='non'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='non'");
}
//cần câu
$checkdangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='cancau'"));
if ($checkdangmac<1) {
mysql_query("INSERT INTO `dangmac` SET `user_id`='".$user_id."', `loai`='cancau'");
}
//--Update HP AND SM--//
$tongsm = $datauser['smthem'];
$tonghp = $datauser['hpthem'];
$uphpsm=mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."'");
while($crossover=mysql_fetch_array($uphpsm)) {
$ruong=mysql_fetch_array(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `id`='".$crossover['id_ruong']."'"));
$tongsm+=$ruong['sucmanh'];
$tonghp+=$ruong['hp'];
}
if ($datauser['hp']>$datauser['hpfull']) {
mysql_query("UPDATE `users` SET `hp`='".$datauser['hpfull']."' WHERE `id`='".$user_id."'");
}
mysql_query("UPDATE `users` SET `sucmanh`='".$tongsm."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `users` SET `hpfull`='".$tonghp."' WHERE `id`='".$user_id."'");
if ($datauser[hp]<0) {
mysql_query("UPDATE `users` SET `hp`='0' WHERE `id`='".$user_id."'");
}
//--Update đồ--//
$querydo=mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."'");
while($updo=mysql_fetch_array($querydo)) {
$checkruong=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `id`='".$updo['id_ruong']."' AND `user_id`='".$user_id."'"));
if ($checkruong<1) {
mysql_query("UPDATE `dangmac` SET `id_loai`='',`id_ruong`='',`timesudung`='' WHERE `user_id`='".$user_id."' AND `loai`='".$updo['loai']."'");
}
if (!isset($_GET['xem_ok'])) {
mysql_query("UPDATE `users` SET `".$updo['loai']."`='".$updo['id_loai']."' WHERE `id`='".$user_id."'");
}
}
//--Khu sinh thái--//
//rương cá
$checkca1=mysql_num_rows(mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `id_ca`='1'"));
if ($checkca1<1) {
mysql_query("INSERT INTO `fish_ruong` SET `user_id`='".$user_id."', `id_ca`='1'");
}
$checkca2=mysql_num_rows(mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `id_ca`='2'"));
if ($checkca2<1) {
mysql_query("INSERT INTO `fish_ruong` SET `user_id`='".$user_id."', `id_ca`='2'");
}
$checkca3=mysql_num_rows(mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `id_ca`='3'"));
if ($checkca3<1) {
mysql_query("INSERT INTO `fish_ruong` SET `user_id`='".$user_id."', `id_ca`='3'");
}
?>