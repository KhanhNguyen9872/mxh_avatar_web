<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Chặn chat';
if (!$user_id || $rights == 0)
{
	header('Location: /login.php');
	exit;
}
require('../incfiles/head.php');
$id = (int)$_GET['id'];
$check  = mysql_num_rows(mysql_query("SELECT * FROM users WHERE id = '$id'"));
$row = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id = '$id'"));
if ($check < 1)
{
	echo '<div class="rmenu">Lỗi...</div>';
}
else
{
	if ($row['chanchat'] == 0)
	{
		mysql_query("UPDATE users SET chanchat = '1' WHERE id = '$id'");
		header('Location: /member/'.$id.'.html');
	}
	else
	{
		mysql_query("UPDATE users SET chanchat = '0' WHERE id = '$id'");
		header('Location: /member/'.$id.'.html');
	}
}
require('../incfiles/end.php');
?>