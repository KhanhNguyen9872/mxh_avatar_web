<?php
define('_IN_JOHNCMS',1);
require_once('../incfiles/core.php');
if (!$user_id) {
	header('Location: /login.php');
	exit;
}
if (empty($datauser['password_2'])) {
	$textl = 'Cập nhập mật khẩu cấp 2';
	require_once('../incfiles/head.php');
	echo '<div class="phdr">'.$textl.'</div>';
	if (isset($_POST['submit'])) {
		$old = trim(functions::checkout($_POST['old']));
		if (md5(md5($old)) != $datauser['password']) {
			echo '<div class="rmenu">Mật khẩu hiện tại không đúng</div>';
		} else {
			$new = trim(functions::checkout($_POST['new']));
			if (strlen($new) > 12) {
				echo '<div class="rmenu">Mật khẩu cấp 2 không vượt quá 12 kí tự</div>';
			} else if (empty($new)) {
				echo '<div class="rmenu">Không được để trống mật khẩu cấp 2</div>';
			} else if ($new == $old) {
				echo '<div class="rmenu">Không được để mật khẩu trùng với mật khẩu cấp 2 để tránh bị hack</div>';
			} else {
				$new = md5(md5($new));
				mysql_query("UPDATE `users` SET `password_2` = '".$new."' WHERE `id` = '".$user_id."'");
				$_SESSION['password_2'] = $new;
				echo '<div class="gmenu">Cập nhập thành công <a href="/index.php"><input type="button" value="Quay lại"></a></div>';
			}
		}
	}
	echo '<form method="post"><table align="center" width="98%" class="menu">
		<tr>
			<td>Mật khẩu cũ:</td>
			<td><input type="password" name="old" placeholder="Nhập mật khẩu hiện tại..."></td>
		</tr>
		<tr>
			<td>Mật khẩu cấp 2:</td>
			<td><input type="text" name="new" placeholder="Nhập mật khẩu cấp 2..."></td>
		</tr>
		<tr><td></td><td><input type="submit" value="Cập nhập" name="submit"></td></tr>
	</table></form>';
	require_once('../incfiles/end.php');
} else {
	header('Location: /index.php');
	exit;
}
?>