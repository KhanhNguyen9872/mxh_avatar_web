<?php

define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Tạo phòng boss';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Tạo phòng mới</div>';
if(!$user_id) {
header("Location: /boss/");
require('../incfiles/end.php');
exit;
}
if (($datauser[timetaoboss] + 120 ) > $time) {
echo '<div class="menu">Bạn tạo phòng quá nhanh, phải đợi 2 phút tạo phòng một lần nhé !</div>';
echo'<a href="/boss/"><input type="button" value="Trở về"/></a>';
echo '</div>';
require('../incfiles/end.php');
exit;
}
$vkt = mysql_result(mysql_query("SELECT COUNT(*) FROM `boss` WHERE `post`='$user_id'"),0);
if($vkt == $user_id) {
echo '<div class="menu">Bạn đã tạo 1 phòng rồi nếu muốn tạo phòng mới bạn hãy rời bàn cũ, nếu đã vào trận thì phải chơi hết trận nhé !</div>';
echo'<a href="/boss/"><input type="button" value="Trở về"/></a>';
echo '</div>';
require('../incfiles/end.php');
exit;
}
if ($datauser[hp] <= 0) {
echo '<div class="menu">Bạn đã hết HP nên không thể tạo phòng hãy chờ hồi phục sức mạnh nhé !</div>';
echo'<a href="/boss/"><input type="button" value="Trở về"/></a>';
echo '</div>';
require('../incfiles/end.php');
exit;
}
if(isset($_POST['sub'])) {
$tenboss = functions::checkout($_POST['idboss']);
$tenphong = functions::checkout($_POST['tenphong']);
$mucdo = functions::checkout($_POST['mucdo']);
$time = functions::checkout($_POST['time']);
mysql_query("update `users` set `timetaoboss` = '".time()."' where `id` = '".$user_id."'");
mysql_query("INSERT INTO `boss` SET `user_id`='".$user_id."', 
`time`='".time()."', 
`luotdi`='$user_id', 
`post`='".$user_id."', 
`boss`='".$tenboss."',
`cuaai`='1',
`mucdo`='".$mucdo."'
");
$rd = mysql_insert_id();
header("Location: /boss/$rd");
$thongtinboss = mysql_fetch_array(mysql_query("SELECT * FROM `boss_chien` WHERE `idboss`='".$tenboss."'"));
mysql_query("INSERT INTO `boss_chien_arena` SET 
`hp`='".$thongtinboss[hp]."', 
`hpfull`='".$thongtinboss[hpfull]."', 
`sucmanh`='".$thongtinboss[sucmanh]."', 
`yeucaulevel`='".$thongtinboss[yeucaulevel]."', 
`tenboss`='".$thongtinboss[tenboss]."',
`idboss`='".$thongtinboss[idboss]."',
`phong`='".$rd."'
");
}
echo'<form method="post">';
$req = mysql_query("SELECT *FROM `boss_chien` ORDER BY `idboss` ASC");
while ($res = mysql_fetch_assoc($req)) {
echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td width="40px;" class="list_post" style="text-align: center;">';
echo'<img src="/boss/icon/1/'.$res['idboss'].'.png" alt="icon"/><br/><input type="radio" name="idboss" value="'.$res['idboss'].'"/>';
echo'</td><td>';
echo'[<b style="color:green">' . $res['tenboss']. ']</b><br/>';
echo'HP ' . $res['hpfull']. '<br/>';
echo'SM ' . $res['sucmanh']. '';
echo'</td></tr></tbody></table>';
echo '</div>';
++$i;
}
echo'<div class="menu list-bottom hot">';
echo'<form method="post">';
echo'<select name="mucdo">';
echo'<option value="1">Dễ</option>';
echo'<option value="2">Thường</option>';
echo'<option value="3">Khó</option>';
echo'</select>';
echo '</div>';
echo'<div class="menu">';
echo'<input type="submit" name="sub" value="Tiếp tục" /></form></div>';
echo '</div>';
require('../incfiles/end.php');
?>