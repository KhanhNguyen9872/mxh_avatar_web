<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Tạo phòng BOSS';
require('../../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../../incfiles/end.php');
exit;
}
echo '<div class="danhmuc">'.$textl.'</div>';
if (isset($_POST[sub])) {
$mucdo=(int)$_POST[mucdo];
$boss=(int)$_POST[idboss];
$check=mysql_num_rows(mysql_query("SELECT * FROM `boss` WHERE `id`='".$boss."'"));
if ($mucdo!=1&&$mucdo!=2&&$mucdo!=3) {
echo '<div class="rmenu">Lỗi!!!</div>';
} else if($check<1) {
echo '<div class="rmenu">Boss không tồn tại!</div>';
} else {
$info=mysql_fetch_array(mysql_query("SELECT * FROM `boss` WHERE `id`='".$boss."'"));
@mysql_query("INSERT INTO `boss_phong` SET
`user_id` ='".$user_id."',
`id_boss`='".$boss."',
`mucdo`='".$mucdo."',
`hp`='".$info[hp]."'
");
$rd = mysql_insert_id();
header('Location: phong.php?id='.$rd.'');
}
}
echo'<form method="post">';
$req = mysql_query("SELECT *FROM `boss` ");
while ($res = mysql_fetch_assoc($req)) {
echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td width="40px;"  style="text-align: center;">';
echo'<img src="img/'.$res['id'].'.png" alt="icon"/><br/><input type="radio" name="idboss" value="'.$res['id'].'"/>';
echo'</td><td>';
echo'<b style="color:green">[' . $res['name']. ']</b><br/>';
echo'HP ' . $res['hp']. '<br/>';
echo'SM ' . $res['sm']. '';
echo'</td></tr></tbody></table>';
echo '</div>';
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
require('../../incfiles/end.php');
?>