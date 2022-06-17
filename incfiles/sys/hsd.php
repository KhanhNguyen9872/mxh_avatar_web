<?php
// Mod hạn sử dụng đồ
mysql_query("DELETE FROM `khodo` WHERE `timesudung`<'".$time."' AND `timesudung`!='0'");
mysql_query("UPDATE `vatpham` SET `soluong` = '0' WHERE `timesudung`<'".$time."' AND `timesudung`!='0'");
$checkao=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='ao' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checkquan=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='quan' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checknon=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='non' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checkdocamtay=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='docamtay' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checkthucung=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='thucung' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checkhaoquang=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='haoquang' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checkmat=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='mat' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checkmatna=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='matna' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checkkinh=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='kinh' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checktoc=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='toc' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checkkhuonmat=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='khuonmat' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checkcanh=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='canh' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
$checkcancau=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `loai`='cancau' AND `timesudung`<'".$time."' AND `timesudung`!='0' AND `user_id`='".$user_id."'"));
if ($checkao>0) {
mysql_query("UPDATE `users` SET `ao`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='ao'");
}
if ($checkquan>0) {
mysql_query("UPDATE `users` SET `quan`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='quan'");
}
if ($checknon>0) {
mysql_query("UPDATE `users` SET `non`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='non'");
}
if ($checkdocamtay>0) {
mysql_query("UPDATE `users` SET `docamtay`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='docamtay'");
}
if ($checkthucung>0) {
mysql_query("UPDATE `users` SET `thucung`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='thucung'");
}
if ($checkhaoquang>0) {
mysql_query("UPDATE `users` SET `haoquang`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='haoquang'");
}
if ($checkmat>0) {
mysql_query("UPDATE `users` SET `mat`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='mat'");
}
if ($checkmatna>0) {
mysql_query("UPDATE `users` SET `matna`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='matna'");
}
if ($checkkinh>0) {
mysql_query("UPDATE `users` SET `kinh`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='kinh'");
}
if ($checktoc>0) {
mysql_query("UPDATE `users` SET `toc`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='toc'");
}
if ($checkkhuonmat>0) {
mysql_query("UPDATE `users` SET `khuonmat`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='khuonmat'");
}
if ($checkcanh>0) {
mysql_query("UPDATE `users` SET `canh`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='canh'");
}
if ($checkcancau>0) {
mysql_query("UPDATE `users` SET `cancau`='' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `dangmac` SET `timesudung`='0',`id_loai`='',`id_ruong`='' WHERE `user_id`='".$user_id."' AND `loai`='cancau'");
}
//End sử dụng đồ
?>