<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
include_once('funfarm.php');
$textl = 'Mua chó!';
require('../incfiles/head.php');
$loaixu = $_POST['loaixu'];
if($user_id){
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Mua chó</div>';
if(isset($_POST['submit'])) {
if($loaixu == 'xu'){
if ($datauser['xu']<100000) {
echo'<div class="menu">Bạn không đủ tiền</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
} else {
mysql_query("UPDATE `users` SET `xu` = `xu` - '100000' WHERE `id` = $user_id LIMIT 1");
mysql_query("INSERT INTO `fermer_dog` (`id_user`,`time`) VALUES  ($user_id,$time) ");
header('Location: '.$home.'/farm/');
}
} 
if($loaixu == 'vnd'){
if ($datauser['vnd']<50) {
echo'<div class="menu">Bạn không đủ tiền</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
} else {
mysql_query("UPDATE `users` SET `vnd` = `vnd` - '50' WHERE `id` = $user_id LIMIT 1");
mysql_query("INSERT INTO `fermer_dog` (`id_user`,`time`) VALUES  ($user_id,$time) ");
header('Location: '.$home.'/farm/');
}
} 
}
$muacho = mysql_fetch_array(mysql_query("SELECT * FROM `fermer_dog` WHERE `id_user`='{$user_id}'"));
if(empty($muacho[id_user])) {
echo'<div class="menu list-bottom"><table cellpadding="0" cellspacing="0"><tr><td><img id="raucu" src="icon/thunuoi/cho.png" alt="*"/>&#160;</td><td><b>Chó</b><br/>Giá: <b>50 VNĐ</b> hoặc <b>100000xu</b><br/></td></tr></table></div>';
echo '<div class="menu">Con chó sẽ bảo vệ trang trại của bạn chống bị ăn cắp một tháng !</div>';
echo '<div class="menu">';
echo "<form method='post' action='dog.php'>\n";
echo'<select name="loaixu">
<option value = "xu">100000 Xu</option>
<option value = "vnd">50 VNĐ</option>
</select><br/>';
echo '<input type="submit" name="submit" value="Mua chó" />';
echo "</form>\n";
echo '</div>';
} else {
echo '<div class="menu">Bạn đã mua chó rồi nhé !</div>';
}
echo '</div>';
} else {
header('Location: '.$home.'');
}
require('../incfiles/end.php');
?>