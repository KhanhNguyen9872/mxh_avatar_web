<?php
/* 
Code pokemon được viết bởi Châu Huỳnh
Vui Lòng Để Bản Quyền Nếu Bạn Là Người Có Học
Site : DanChoiViet.Me
*/
define('_IN_JOHNCMS',1);
$rootpath='../../';
include'../incfiles/core.php';
include'../incfiles/head.php';
echo'<div class="phdr">Nhập Mã Coupon Nhận Ngay Exp</div><div class="da"><div class="lucifer">';
$check = mysql_fetch_array(mysql_query("SELECT * FROM `shoppkm` WHERE `id`='1'"));
$check1 = mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm` WHERE `user_id`='{$user_id}'"));
if($check['check']>0){
Echo'<div class="list2">Mã : ID Thiên Ân</div>';
}
/* echo'<div class="list2">Chỉ Còn '.$check['check'].' Mã Coupon Thôi</div>'; */
$ma = 'CHAUDAIK';
echo'<b><font color="#FF99FF">Nhập Gift Code!</b></font><br><form method="post"><input type="text"name="ma"><input type="submit"name="submit"value="Nhận Quà"></form><br><br><b><font color="red">Gợi ý: Gift code cho bạn tăng  lượng exp lớn cho nhân vật!</b></font>';
if(isset($_POST['submit'])){
$_POST['ma'] = functions::checkout($_POST['ma']);
if($check['check']<=0){
echo'Mã Hết Rồi';
}else
if($check1['checklv']>0){
echo'1 Lần Thôi';
}else
if($_POST['ma']!=$ma){
echo'Sai Mã Rồi Mày';
}
else
if($_POST['ma']=$ma && $check['check']>0){
mysql_query("UPDATE `tuipkm` SET `exp`=`exp`+'5000',`checklv`='1' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `shoppkm` SET `check`=`check`-'1' WHERE `id`='1'");
echo'<div class="news">Nhập Mã Thành Công.Pokemon Bạn Nhận 5000EXP</div>';
}
}
include'../incfiles/end.php';