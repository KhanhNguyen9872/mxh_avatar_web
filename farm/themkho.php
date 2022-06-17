<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
if (!$rights == 9) {
header("Location: $home");
}
$textl = 'Thêm vật nuôi';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thêm vật nuôi</div>';
$ten = $_POST['ten'];
if(isset($_POST['submit'])){
mysql_query("INSERT INTO `fermer_name` SET 
`name`='".$ten."'
");

$insertid = mysql_insert_id();
header("Location: $home/farm/");
} else {
echo'<form enctype="multipart/form-data" method="post">';
echo'<div class="menu">';
echo'Tên : <input type="text" name="ten" /><br/>';
echo'<input type="submit" name="submit" value="Lưu lại" name="submit" />';
echo'</form>';
echo'</div>';
}
echo'</div>';
require_once('../incfiles/end.php');
?>