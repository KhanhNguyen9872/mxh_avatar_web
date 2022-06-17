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
echo'<div class="phdr">Hồi Mục Quái</div>';

$check = mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm1` WHERE `user_id`='".$user_id."'"));
$hoihp=intval($check['hpfull']);
if(empty($check['user_id'])){
echo'Ko có pokémon hồi phục cho ass bạn à';
echo'<a href="/minigame/pokemon"><input type="button" value="Trở về"/></a>';
include'../incfiles/end.php';
exit;
}
$timepk = time();
if ($datauser['timepkm']+3600 >= $timepk) {
$timelol = time();
$timelol= $datauser['timepkm'] + 3600 - time();
echo'<div class="news">Sau '.date('H:i', $timelol).' Bạn Mới Có Thể Phục Hồi</div>';
echo'<a href="/minigame/pokemon"><input type="button" value="Trở về"/></a>';
require('../incfiles/end.php');
exit;
}
$pkmcd = mysql_fetch_array(mysql_query("SELECT * FROM `pkmn` WHERE `id_user`='".$user_id."'"));
$hp = intval($pkmcd['hpfull']);
echo'
<div class="lucifer">Bây Giờ Bạn Có 2 Lựa Chọn : <br/>
1 : Khi Bạn Chiến Thắng Tức Là Quái Rừng Bị Chết Bạn Có Thể Xoá Trận Đấu Để Có Thể Đấu Với Con Quái Khác<br/>
2 : Khi Quái Rừng Chết Bạn Có Thể Phục Hồi Máu Lại Cho Nó Và Đánh Tiếp
';
if($pkmcd['hp']>0){
echo'Quái Rừng Bạn Đang Đấu Còn Sống Nên Bạn Không Có Lựa Chọn Nào Hết';
}else{
echo'<form action=""method="post">
<input type="radio"name="chaupkm"value="1">Xoá Trận Đang Đấu Với Quái Ở Rừng
<input type="radio"name="chaupkm"value="2">Hồi Phục Máu Cho Quái Đang Đấu Ở Rừng<input type="submit"name="submit"value="Chọn"></form><br/>';

}
if(isset($_POST['submit'])){
$luachon = intval($_POST['chaupkm']);
if(empty($luachon)){
echo'Lựa Chọn Nào Bạn';
}
if($luachon==1){
mysql_query("DELETE FROM `pkmn`  where `id_user`='{$user_id}' limit 1");
echo'<div class="news">Xoá Trận Đấu Thành Công</div>';
}
if($luachon==2){
mysql_query("UPDATE `pkmn` SET `hp`='".$hp."' WHERE `id_user`='{$user_id}'");
echo'<div class="news">Phục Hồi Máu Cho Nhân Vật Rừng Thành Công</div>';
}
}
echo'<div>';
include'../incfiles/end.php';