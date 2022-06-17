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
if(!$user_id){
echo'Đăng Nhập Đi';
include'../incfiles/end.php';
exit;
}
echo'<div class="phdr">Hồi Mục HP  |<a href="/idthienan_5ltb"> Trở Về Làng</a></div>';
$check = mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm` WHERE `user_id`='".$user_id."'"));
$hoihp=intval($check['hpfull']);
if(empty($check['user_id'])){
echo'Ko có pokémon hồi phục cho ass bạn à';
include'../incfiles/end.php';
exit;
}
echo'<div class="lucifer">Hệ Thống Phát Hiện Pokémon Của Bạn Là <b>'.$check['name'].'</b><br>
Mỗi Lần Hồi Phục Cho <b>'.$check['name'].'</b> Sẽ Tốn 20.000 Xu
<form action=""method="post">
<input type="submit"name="submit"value="Hồi Phục"></form>';
if(isset($_POST['submit'])){
if($datauser['xu']<20000){
echo'<br>Bạn không đủ xu để hồi phục máu cho pokémon';
}else
if($datauser['xu']>=20000){
mysql_query("UPDATE `users` SET `xu`=`xu`-'20000' WHERE `id`='{$user_id}'");
mysql_query("UPDATE `tuipkm` SET `hp`='".$hoihp."' WHERE `user_id`='{$user_id}'");
echo'<br>Hồi Máu Thành Công';
}
}
echo'<div>';
include'../incfiles/end.php';