<?php
/*
Code pokemon được viết bởi Châu Huỳnh
Site : Kenh10s.Com
Demo : DanChoiViet.Xyz
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
mysql_query("UPDATE `users` SET `place`='chauitpkm' WHERE `id` ='".$user_id."'");
$id =$_SERVER['QUERY_STRING'];
$id =  str_replace('id=','',$id);
$id = intval($id);
$ktui = mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm1` WHERE `user_id`='".$user_id."'"));
if($ktui['hp']<0){
mysql_query("update `tuipkm1` set `hp` = '0' where `user_id` = '".$user_id."'");
}
echo'<div class="phdr">Khu Luyện Tập | <a href="/idthienan_5ltb">Trở Về Làng</a></div><div class="da"><div class="lucifer">';
$kiemtra = mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm1` WHERE `user_id`='".$user_id."'"));
if(empty($kiemtra)){
echo'Ngay cả nhân vật còn không có mà còn bà đặt đi rừng! - <a href="/idthienan_5ltb/shop.php">Mua Nhân Vật</a> ';
include'../incfiles/end.php';
exit;
}
$check = mysql_fetch_array(mysql_query("SELECT * FROM `pkmchien1` WHERE `id`='".$id."'"));
$check['name'] = addslashes($check['name']);
$check['hp'] = intval($check['hp']);
$check['sm']=intval($check['sm']);
$check['img']=addslashes($check['img']);
if(empty($check['id'])){
echo'Quái hiện không tồn tại! <a href="/idthienan_5ltb">Trở về</a>';
include'../incfiles/end.php';
exit;
}
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `pkmn1` WHERE `id_user`='{$user_id}'"), 0);
if($kt==0){
mysql_query("INSERT INTO `pkmn1` SET 
`id_user`='".$user_id."',
`name`='".$check['name']."',
`img`='".$check['img']."',
`hp` = '".$check['hp']."',
`hpfull` = '".$check['hpfull']."',
`sm` = '".$check['sm']."',
`idpk`='".$id."',
`time` ='" . time() . "'
");
}
$id = $_GET['id'];
$pkmcd = mysql_fetch_array(mysql_query("SELECT * FROM `pkmn1` WHERE `id_user`='".$user_id."'"));
$timepk =time();
if($kt==0){
echo'Đánh Hụt. Vui Lòng ';
?>
<a href="/idthienan_5ltb/tc.php?id=<?php echo"$id"; ?>">Loading Lại Trang</a>
<?php

include'../incfiles/end.php';
exit;
}

if ($datauser['timepkm']+3600 >= $timepk) {
echo '<div class="menu">Quái Ở Bìa Rừng Cần 1 Tiếng Để Hồi Phục Máu Nhé Bạn. Sau 1 Tiếng Bạn Vào Bìa Rừng Để Hồi Phục Cho Quái Nhé.</div>';
echo'<a href="/idthienan_5ltb"><input type="button" value="Trở về Làng"/></a>';
require('../incfiles/end.php');
exit;
}

if($pkmcd['hp']<=0){
echo'Nhân vật kiệt sức <a href="/idthienan_5ltb">quay về</a> hồi sức rồi đánh tiếp nhé!';
mysql_query("update `users` set `timepkm` = '".time()."' where `id` = '".$user_id."'");
include'../incfiles/end.php';
exit;
}

if($ktui['hp']<=0){
echo'Nhân Vật Của Bạn Đã Chết Rồi. Bạn Đã Để Quái Chạy Thoát. 1 Tiếng Sau Quay Lại Giết Nó Nhé! <a href="/idthienan_5ltb">Oki^^</a>';
mysql_query("update `users` set `timepkm` = '".time()."' where `id` = '".$user_id."'");
include'../incfiles/end.php';
exit;
}
$checkpa = mysql_fetch_array(mysql_query("SELECT * FROM `pkmn1` WHERE `id_user`='".$user_id."'"));
if($id != $checkpa['idpk']){
echo'Đang Đánh Con '.$checkpa['name'].' Sao Nhảy Qua Con Khác Bạn <a href="/idthienan_5ltb">Trở Lại!</a>';
include'../incfiles/end.php';
exit;
}
echo'
	<div><table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
	
	<td width="45%"><center><img src="'.$ktui['img'].'"></br><b><font color="green">
	HP: '.$ktui['hp'].'/'.$ktui['hpfull'].' | SM: '.$ktui['sm'].' </font></b></center></td>
	<td width="10%"><center><img src="http://i.imgur.com/KZNWZWP.png"></center></td>
	<td width="45%"><center><img src="'.$pkmcd['img'].'">
	</br><b><font color="green">
	HP: '.$pkmcd['hp'].'/'.$pkmcd['hpfull'].' | SM: '.$pkmcd['sm'].' </font></b>
	</td>
	</tr></tbody></table><center><form action=""method="post"><input type="submit"class="chat"name="submit"value="Đánh Tiếp"></form></center>
	';
if(isset($_POST['submit'])){
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
$sdpkm = $pkmcd['sm']/$chauit;
}
if($randpkm==2){
$sdpkm= $pkmcd['sm']/$chauit1;
}
if($randpkm==3){
$sdpkm = $pkmcd['sm']/$chauit2;
}
if($randpkm==4){
$sdpkm = $pkmcd['sm']/$chauit3;
}
if($randpkm==5){
$sdpkm = $pkmcd['sm']/$chauit4;
}
$expbm = 10;
$expnd = $sucdanh/$expbm;
$expnd = intval($expnd);
$sucdanh = intval($sucdanh);
$sdpkm = intval($sdpkm);
mysql_query("update `tuipkm1` set `hp` = `hp`-'".$sdpkm."' where `user_id` = '".$user_id."'");
mysql_query("update `tuipkm1` set `exp` = `exp`+'".$expnd."' where `user_id` = '".$user_id."'");
mysql_query("update `pkmn1` set `hp` = `hp`-'".$sucdanh."' where `id_user` = '".$user_id."'");
echo'<br><div class="lucifer"><center>
	'.$pkmcd['name'].' bị mất <font color="red">'.$sucdanh.' HP</font></br>
	Quái của bạn bị phản công mất <font color="red">'.$sdpkm.' HP</font>
	</br>Nhận được <b><font color="green">'.$expnd.' EXP!</font></b>
	</br>
	</center>
	</div>';
}
echo'</div>';
include'../incfiles/end.php';
/*
Code pokemon được viết bởi Châu Huỳnh
Site : Kenh10s.Com
Demo : DanChoiViet.Xyz
*/
?>
<style>
.nenpkm{
background-color:#f5f5f5;
border-bottom:1px solid #EBEBEB;
padding:5px
}
.chat{font-size:12px;background-color:#3688c7;border:#e5e5e5 1px solid;color:#fff;;width:auto;;height:25px;padding-left:5px;padding-bottom:2px;padding-right:5px;padding-top:2px;font-weight:bold;margin-left:2px;text-decoration:bold;-moz-border-radius:5px;-webkit-border-radius:5px;font-weight:bold}

</style>