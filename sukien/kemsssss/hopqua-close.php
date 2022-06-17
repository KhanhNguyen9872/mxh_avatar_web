<?php
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
if (!$user_id) {
	header('Location: /login.php');
	exit;
}
$textl = 'Nhận hộp quà ánh sáng';
require_once('../../incfiles/head.php');
echo '<div class="phdr">'.$textl.'</div>';
if (isset($_POST['submit'])) {
	if ($datauser['nhanhopqua'] == 1) {
		echo '<div class="rmenu"><center>Hôm nay bạn đã nhận hộp quà rồi nhé!</center></div>';
	} else {
		mysql_query("UPDATE `users` SET `nhanhopqua` = '1' WHERE `id` = '".$user_id."'");
		$time = time() + 30 * 24 * 3600;
		mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1', `timesudung` = '".$time."' WHERE `id_shop` = '41' AND `user_id` = '".$user_id."'");
		echo '<div class="menu"><center>Nhận hộp quà thành công!</center></div>';
	}
}
echo '<center><div class="omenu"><font color="green"><b><img src="http://i.imgur.com/guN5osY.png"> mỗi ngày bạn sẽ nhận được 1 hộp quà ánh sáng</font></b></div><form method="post"><input type="submit" name="submit" value="Nhận" class="nut"></form></center><div><div>';
require_once('../../incfiles/end.php');
?>