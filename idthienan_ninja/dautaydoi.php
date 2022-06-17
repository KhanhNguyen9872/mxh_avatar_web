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
$id = intval($_GET['id']);
$nhanvat= mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm` WHERE `user_id`='".$id."'"));
$ktui = mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm` WHERE `user_id`='".$user_id."'"));
$nv = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'"));
if(empty($nv['id'])){
echo'<div class="omenu">Thành Viên Không Tồn Tại</div>';
include'../incfiles/end.php';
exit;
}

if(empty($nhanvat['id'])){
echo'<div class="omenu">Thành Viên Ko Có PET</div>';
include'../incfiles/end.php';
exit;
}
if($id==$datauser['id']){
echo'<div class="omenu">Bạn Có Bị Điên Không Khi Tự Mình Đánh Mình</div>';
include'../incfiles/end.php';
exit;
}
if($ktui['hp']<0){
mysql_query("update `tuipkm` set `hp` = '0' where `user_id` = '".$user_id."'");
}
echo'<div class="phdr">Đấu Tay Đôi Với '.$nv['name'].' </div>';
$kiemtra = mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm` WHERE `user_id`='".$user_id."'"));
if(empty($kiemtra)){
echo'Ngay cả pokémon còn không có mà còn bà đặt';
include'../incfiles/end.php';
exit;
}
$ktui['name'] = addslashes($ktui['name']);
$ktui['hp'] = intval($ktui['hp']);
$ktui['sm']=intval($ktui['sm']);
$ktui['img']=addslashes($ktui['img']);
///Nhân vật đấu khác///
$nhanvat['name'] = addslashes($nhanvat['name']);
$nhanvat['hp'] = intval($nhanvat['hp']);
$nhanvat['sm']=intval($nhanvat['sm']);
$nhanvat['img']=addslashes($nhanvat['img']);

if($nhanvat['hp']<=0){
echo'<div class="omenu">PoKeMon Đối Thú Đã Hy Sinh Rồi</div>';
include'../incfiles/end.php';
exit;
}
if($ktui['hp']<=0){
echo'<div class="omenu">PokeMon Bạn Đã Hy Sinh Rồi</div>';
include'../incfiles/end.php';
exit;
}


echo'<div class="nenpkm">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
	
	<td width="45%"><center><img src="'.$ktui['img'].'"></br><b><font color="green">
	HP: '.$ktui['hp'].'/'.$ktui['hpfull'].' | SM: '.$ktui['sm'].' </font></b></center></td>
	<td width="10%"><center><img src="http://i.imgur.com/KZNWZWP.png"></center></td>
	<td width="45%"><center><img src="'.$nhanvat['img'].'">
	</br><b><font color="green">
	HP: '.$nhanvat['hp'].'/'.$nhanvat['hpfull'].' | SM: '.$nhanvat['sm'].' </font></b>
	</td>
	</tr></tbody></table><form action=""method="post"><input type="submit"class="chat"name="submit"value="Đánh Tiếp"></form></center>
	';
if(isset($_POST['submit'])){
$timepkmtd = time();
if ($datauser['timepkmtd']+120 > $timepkmtd ) {
$timepkmtd= $datauser['timepkmtd']+120 - time();
echo'<div class="news">Lượt Của '.$nv['name'].' Còn '.date('i:s', $timepkmtd).' Mới Tới Lượt Đánh Của Bạn.</div></div>';
require('../incfiles/end.php');
exit;
}
$randsd = rand(1,5);
$chau =10;
$chau1=12;
$chau2=14;
$chau3=16;
$chau4=20;
if($randsd==1){
$sucdanh = $ktui['sm']/$chau;
}
if($randsd==2){
$sucdanh = $ktui['sm']/$chau1;
}
if($randsd==3){
$sucdanh = $ktui['sm']/$chau2;
}
if($randsd==4){
$sucdanh = $ktui['sm']/$chau3;
}
if($randsd==5){
$sucdanh = $ktui['sm']/$chau4;
}
$randpkm = rand(1,5);
$chauit =10;
$chauit1=12;
$chauit2=14;
$chauit3=16;
$chauit4=20;
if($randpkm==1){
$sdpkm = $nhanvat['sm']/$chauit;
}
if($randpkm==2){
$sdpkm= $nhanvat['sm']/$chauit1;
}
if($randpkm==3){
$sdpkm = $nhanvat['sm']/$chauit2;
}
if($randpkm==4){
$sdpkm = $nhanvat['sm']/$chauit3;
}
if($randpkm==5){
$sdpkm = $nhanvat['sm']/$chauit4;
}
$expbm = 10;
$expnd = $sucdanh/$expbm;
$expnd = intval($expnd);
$sucdanh = intval($sucdanh);
$sdpkm = intval($sdpkm);
mysql_query("update `users` set `timepkmtd` = '0' where `id` = '".$user_id."'");

mysql_query("update `tuipkm` set `hp` = `hp`-'".$sdpkm."' where `user_id` = '".$user_id."'");
mysql_query("update `tuipkm` set `exp` = `exp`+'".$expnd."' where `user_id` = '".$user_id."'");
mysql_query("update `tuipkm` set `hp` = `hp`-'".$sucdanh."' where `id_user` = '".$id."'");
mysql_query("update `users` set `timepkmtd` = '".time()."' where `id` = '".$user_id."'");

echo'<div class="news"><center>
	PoKeMon '.$nhanvat['name'].' của bạn '.$nv['name'].' bị mất <font color="red">'.$sucdanh.' HP</font></br>
	Pokemon của bạn bị phản công mất <font color="red">'.$sdpkm.' HP</font>
	</br>Nhận được <b><font color="green">'.$expnd.' EXP!</font></b>
	</br>
	</center>
	</div>';
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
.chat{font-size:12px;background-color:#3688c7;border:#e5e5e5 1px solid;color:#fff;;width:auto;;height:25px;padding-left:5px;padding-bottom:2px;padding-right:5px;padding-top:2px;font-weight:bold;margin-left:2px;text-decoration:bold;-moz-border-radius:5px;-webkit-border-radius:5px;font-weight:bold}

</style>