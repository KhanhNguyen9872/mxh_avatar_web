<?php
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
$textl = 'Ước rồng thần';
require_once('../../incfiles/head.php');
if (!$user_id) {
	header('Location: /index.php');
	exit;
}
$nro2 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '14' AND `user_id` = '".$user_id."'"));
$nro3 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '15' AND `user_id` = '".$user_id."'"));
$nro4 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '16' AND `user_id` = '".$user_id."'"));
$nro5 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '17' AND `user_id` = '".$user_id."'"));
$nro6 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '18' AND `user_id` = '".$user_id."'"));
$nro7 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '19' AND `user_id` = '".$user_id."'"));
if ($nro2['soluong'] < 1 || $nro3['soluong'] < 1 || $nro4['soluong'] < 1 || $nro5['soluong'] < 1 || $nro6['soluong'] < 1 || $nro7['soluong'] < 1) {
	echo '<div class="phdr">Rồng thần</div>';
	echo '<div class="rmenu">Hãy tìm đủ ngọc rồng rồi đến đây gặp ta!<div>';
	require_once('../../incfiles/end.php');
	exit;
}
switch($act) {
case 'HP':
echo '<div class="phdr">Ước HP</div>';
if (isset($_POST['submit'])) {
	for ($i = 14; $i <= 19; $i++) {
		mysql_query("UPDATE `vatpham` SET `soluong`= `soluong` - '1' WHERE `id_shop` = '".$i."' AND `user_id` = '".$user_id."'");
	}
$bot='[img]http://8vui.top/images/rongthan.png[/img][b]Chúc mừng [blue]'.$login.'[/blue] đã ước được 2,000HP từ rồng thần![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
	mysql_query("UPDATE `users` SET `hpthem` = `hpthem` + '2000' WHERE `id` = '".$user_id."'");
	echo '<div class="rmenu">Ngươi đã được tăng thêm <b>2,000 HP</b></div>';
}
echo '<div class="login"><center><b>Ta sẽ tăng thêm cho ngươi <font color="red">2,000 HP</font></b><br/><form method="post"><input type="submit" name="submit" value="Ước luôn"> <a href="uocngocrong.php"><input type="button" value="Suy nghĩ lại"></a></form></center></div>';
break;
case 'sucmanh':
echo '<div class="phdr">Ước sức mạnh</div>';
if (isset($_POST['submit'])) {
	for ($i = 14; $i <= 19; $i++) {
		mysql_query("UPDATE `vatpham` SET `soluong`= `soluong` - '1' WHERE `id_shop` = '".$i."' AND `user_id` = '".$user_id."'");
	}
$bot='[img]http://8vui.top/images/rongthan.png[/img][b]Chúc mừng [blue]'.$login.'[/blue] đã ước được 2,000 sức mạnh từ rồng thần![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
	mysql_query("UPDATE `users` SET `smthem` = `smthem` + '2000' WHERE `id` = '".$user_id."'");
	echo '<div class="rmenu">Ngươi đã được tăng thêm <b>2,000 sức mạnh</b></div>';
}
echo '<div class="login"><center><b>Ta sẽ tăng thêm cho ngươi <font color="red">2,000 sức mạnh</font></b><br/><form method="post"><input type="submit" name="submit" value="Ước luôn"> <a href="uocngocrong.php"><input type="button" value="Suy nghĩ lại"></a></form></center></div><div><div>';
break;
default:
header('Location: uocngocrong.php');
exit;
break;
}
require_once('../../incfiles/end.php');
?>