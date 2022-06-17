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
$id =$_SERVER['QUERY_STRING'];
$id =  str_replace('id=','',$id);
$id = intval($id);
echo'<div class="phdr">Tạo Nhân Vật</div>';
$check = mysql_fetch_array(mysql_query("SELECT * FROM `shoppkm` WHERE `id`='".$id."'"));
$check['gia']= intval($check['gia']);
$check['name'] = addslashes($check['name']);
$check['hp'] = intval($check['hp']);
$check['sm']=intval($check['sm']);
$check['img']=addslashes($check['img']);
if(empty($check['id'])){
echo'PokéMon không tồn tại';
}else
if($datauser['vnd']<$check['gia']){
echo'Ko đủ lượng để tạo nhân vật này<br><div><div>';
}else

if($datauser['vnd']>=$check['gia']){
$time2 = time();
$tuipkmi = mysql_result(mysql_query("SELECT COUNT(*) FROM `tuipkm` WHERE `user_id`='{$user_id}'"), 0);
if($tuipkmi == 0) {
mysql_query("INSERT INTO `tuipkm` SET `user_id`='" . $user_id. "',`hp`='" . $check['hp'] . "',`sm`='" . $check['sm']. "',`time`='".$time2."',`img`='" . $check['img'] . "',`name`='" . $check['name'] . "',`hpfull`='" . $check['hp'] . "',`idpkm`='{$id}'");
}
if($tuipkmi > 0) {
@mysql_query("update `tuipkm` set `hp`='".$check['hp']."',`sm`='".$check['sm']."',`hpfull`='".$check['hp']."',`img`='".$check['img']."',`name`='".$check['name']."' where `id` = '" . $user_id . "',`idpkm`='{$id}'");
}
@mysql_query("update `users` set `vnd` = `vnd`-'" . $check['gia']. "' where `id` = '" . $user_id . "'");
$time = time();
$bot = ' @'.$login.' Vừa Mua Thành Công '.$check['name'].' [img]'.$check['img'].'[/img]';
mysql_query("INSERT INTO `guest` SET
`adm` = '0',
`time` = '$time',
`user_id` = '2',
`name` = 'BOT',
`text` = '" . mysql_real_escape_string($bot) . "',
`ip` = '0000',
`browser` = 'IPHONE'
");
echo'<div class="da"><div class="lucifer">Bạn Vừa Mua Thành Công '.$check['name'].' <img src="'.$check ['img'].'">';
}

echo'<a href="/idthienan_ninja"><button type="button" class="btn btn-light">Vào Làng Ninja!</button></a>';

include'../incfiles/end.php';