<?php
define('_IN_JOHNCMS',1);
include('../incfiles/core.php');
$textl='Quỹ bang hội';
include('../incfiles/head.php');
$check=mysql_query("select `id` from `nhom_user` where `user_id`='$user_id' and `duyet`='1' limit 1")or die(mysql_error());
if(!mysql_num_rows($check)){
	echo functions::display_error('Bạn chưa có bang hội');
	include('../incfiles/end.php');
	exit;
}
$c=mysql_fetch_array($check);
$clan=mysql_fetch_array(mysql_query("select * from `nhom` where `id`='".$c['id']."' limit 1"));
echo'<div class="phdr"> Đóng góp quỹ bang</div>';
if( isset($_POST['sub'])){
	$xu=intval($_POST['xu']);
	$luong=intval($_POST['luong']);
	if(($xu>$datauser['xu'])or ($luong>$datauser['vnd'])){
		echo functions::display_error('Bạn không có đủ xu hoặc lượng');
		include('../incfiles/end.php');
		exit;
	}
	else if ($xu < 0 || $luong < 0)
	{
		echo functions::display_error('Bug clgt???');
		include('../incfiles/end.php');
		exit;
	}
	$quyxu=$clan['xu']+$xu;
	$quyluong=$clan['luong']+$luong;
	mysql_query("update `nhom` set `xu`='".$quyxu."',`luong`='".$quyluong."' where `id`='".$c['id']."' limit 1")or die( mysql_error());
	$xu=$datauser['xu']-$xu;
	$luong=$datauser['vnd']-$luong;
	mysql_query("update `users` set `xu`='".$xu."' , `vnd`='".$luong."' where `id`='".$user_id."' limit 1")or die( mysql_error());
	echo'<div class="news">bạn đã đóng góp thành công</div>';
}
echo'<div class="menu"><form method="post">Nhập số xu bạn muốn đóng góp cho bang hội:<br/>';
echo'<input type="number" name="xu" value="1"><br/>';
echo'Nhập số lượng bạn muốn đóng góp cho bang hội:<br/>';
echo'<input type="number" name="luong" value="1">';
echo'<br/><input type="submit" name="sub" value="Đóng góp"></form></div>';
require('../incfiles/end.php');
?>