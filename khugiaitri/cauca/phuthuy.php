<?php
define('_IN_JOHNCMS', 1);
require('../../incfiles/core.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
$textl = 'Tạo hiệu ứng cho nick';
require('../../incfiles/head.php');
if (mysql_num_rows(mysql_query("SELECT * FROM `shadow` WHERE `user_id` = '".$user_id."'")) < 1) {
mysql_query("INSERT INTO `shadow` SET `user_id` = '".$user_id."', `class` = '', `config` = 'off'");
}
$post = mysql_fetch_assoc(mysql_query("SELECT * FROM `shadow` WHERE `user_id` = '".$user_id."'"));
if (!empty($post['class'])) {
	if (isset($_POST['config'])) {
		if ($post['config'] == 'on') {
			mysql_query("UPDATE `shadow` SET `config` = 'off' WHERE `user_id` = '".$user_id."'");
			header('Location: phuthuy.php');
			exit;
		} else {
			mysql_query("UPDATE `shadow` SET `config` = 'on' WHERE `user_id` = '".$user_id."'");
			header('Location: phuthuy.php');
			exit;
		}
	}
	
	if (isset($_POST['del'])) {
		mysql_query("UPDATE `shadow` SET `config` = 'off', `time` = '', `class` = '' WHERE `user_id` = '".$user_id."'");
		header('Location: phuthuy.php');
		exit;
	}
	
	if (isset($_POST['giahan'])) {
		if ($datauser['vnd'] < 15) {
			echo '<div class="rmenu">Lỗi... Bạn không đủ tiền</div>';
		} else {
			$time = $post['time'] + 7 * 24 * 3600;
			mysql_query("UPDATE `users` SET `vnd` = `vnd` - '15' WHERE `id` = '".$user_id."'");
			mysql_query("UPDATE `shadow` SET `time` = '".$time."' WHERE `user_id` = '".$user_id."'");
			header('Location: phuthuy.php');
			exit;
		}
	}
	echo '<div class="phdr">Hiệu ứng '.strtoupper($post['class']).' của bạn</div>';
	echo '<div class="rmenu">';
	echo '<div class="list1">Hiệu ứng của bạn còn: '.($post['time'] < time() ? '<font color="red">Đã hết hạn</font>' : '<b>'.thoigiantinh($post['time']).'</b>').'</div>';
	echo '<form method="post">
	'.($post['config'] == 'on' ? '<input type="submit" name="config" value="Tắt">' : '<input type="submit" name="config" value="Bật">').' 
	<input type="submit" name="giahan" value="Gia hạn thêm"> 
	<input type="submit" name="del" value="Xóa">
	</form>';
	echo '</div>';
}


echo '<div class="phdr">'.$textl.' (7 ngày = 15 lượng)</div>';
echo '<div><div class="lucifer"><div class="menu">';
if (isset($_POST['hoaphep'])) {
	$shadow = $_POST['shadow'];
	if (!in_array($shadow, array('legend', 'friendly', 'rich', 'darkness', 'hero'))) {
		echo '<div class="rmenu">Lỗi...</div>';
	} else if ($post['class'] != '') {
		echo '<div class="rmenu">Vui lòng xóa hiệu ứng cũ trước khi mua hiệu ứng mới</div>';
	} else {
		if ($datauser['vnd'] < 15) {
			echo '<div class="rmenu">Bạn không đủ tiền</div>';
		} else {
			$time = time() + 7 * 24 * 3600;
			mysql_query("UPDATE `shadow` SET `time` = '".$time."', `class` = '".$shadow."', `config` = 'on' WHERE `user_id` = '".$user_id."'");
			mysql_query("UPDATE `users` SET `vnd` = `vnd` - '15' WHERE `id` = '".$user_id."'");
			header('Location: phuthuy.php');
			exit;
		}
	}
}
echo '<form method="post">
<b>Chọn hiệu ứng nick ngươi muốn đổi</b> (1 số máy không hỗ trợ)<br/>
<input type="radio" name="shadow" value="legend" id="legend"><label for="legend"> <span class="legend">Legend</span></label><br/>
<input type="radio" name="shadow" value="friendly" id="friendly"><label for="friendly"> <span class="friendly">Friendly</span></label><br/>
<input type="radio" name="shadow" value="rich" id="rich"><label for="rich"> <span class="rich">Rich</span></label><br/>
<input type="radio" name="shadow" value="darkness" id="darkness"><label for="darkness"> <span class="darkness">Darkness</span></label><br/>
<input type="radio" name="shadow" value="hero" id="hero"><label for="hero"> <span class="hero">Hero</span></label><br/>
<input type="submit" value="Hóa phép" name="hoaphep">
</form>';
echo '</div>';
require('../../incfiles/end.php');
?>