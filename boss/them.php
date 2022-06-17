<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
if (!$rights == 9) {
require('../incfiles/head.php');
header("Location: $home");
require('../incfiles/end.php');
exit;
}
$textl = 'Thêm Boss';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thêm đồ</div>';
if(isset($_POST['submit'])){
$tenboss = $_POST['tenboss'];
$hpboss = trim($_POST['hpboss']);
$sucmanhboss = $_POST['sucmanhboss'];
$yeucaulevel = $_POST['yeucaulevel'];
$idboss = $_POST['idboss'];
mysql_query("INSERT INTO `boss_chien` SET 
`tenboss`='".$tenboss."',
`hp`='".$hpboss."',
`hpfull`='".$hpboss."',
`sucmanh`='".$sucmanhboss."',
`yeucaulevel`='".$yeucaulevel."',
`idboss`='".$idboss."'
");

header("Location: $home/boss/");
}else{
echo'<form method="post">';
echo'Tên Boss: <input type="text" name="tenboss" /><br/>';
echo'HP Boss: <input type="text" name="hpboss" /><br/>';
echo'SM Boss: <input type="text" name="sucmanhboss" /><br/>';
echo'Level chơi: <input type="text" name="yeucaulevel" /><br/>';
echo'ID Boss: <input type="text" name="idboss" /><br/>';
echo'<input type="submit" value="Lưu lại" name="submit" />';
echo'</form>';
}
echo'</div>';
require_once('../incfiles/end.php');
?>
