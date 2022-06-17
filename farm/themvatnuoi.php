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
$tenvatnuoi = $_POST['tenvatnuoi'];
$loai = $_POST['loai'];
$loaixu = $_POST['loaixu'];
$sotien = $_POST['sotien'];
$timelon = $_POST['timelon']*60*60*24;
$timesong = $_POST['timesong']*60*60*24;
$sansinh = $_POST['sansinh'];
if(isset($_POST['submit'])){
mysql_query("INSERT INTO `farm_vatnuoi` SET 
`tenvatnuoi`='".$tenvatnuoi."',
`loai`= '".$loai."',
`loaixu`= '".$loaixu."',
`sotien`= '".$sotien."',
`timelon`= '".$timelon."',
`timesong`= '".$timesong."',
`sansinh`= '".$sansinh ."',
`timechoan`= '".time()."'
");

$insertid = mysql_insert_id();
header("Location: $home/farm/");
} else {
echo'<form enctype="multipart/form-data" method="post">';
echo'<div class="menu">';
echo'Tên vật nuôi: <input type="text" name="tenvatnuoi" /><br/>';
echo'Loại: <input type="text" name="loai" /><br/>';
echo'Loại xu: <select name="loaixu">
<option value = "Xu">Xu</option>
<option value = "Vinaxu">Vinaxu</option>
</select><br/>';
echo'Giá: <input type="text" name="sotien"/>';
echo'</div>';
echo'Thời gian lớn: <input type="text" name="timelon" /> ngày<br/>';
echo'Thời gian sống: <input type="text" name="timesong" /> ngày<br/>';
echo'Sản sinh: <input type="text" name="sansinh" /><br/>';
echo'<input type="submit" name="submit" value="Lưu lại" name="submit" />';
echo'</form>';
}
echo'</div>';
require_once('../incfiles/end.php');
?>