<?php
/*
Copy để nguồn cRoSsover
*/
$rootpath = '';
define('_IN_JOHNCMS', 1);
if (isset($_GET['add']))
{
	require_once('incfiles/core.php');
	if ($rights < 7) { exit(); }
	$textl = 'Cài đặt quicklink';
	require_once('incfiles/head.php');
	if (isset($_POST['submit']))
	{
		$text = strtolower($_POST['text']);
		$url = addslashes($_POST['url']);
		$sql = "SELECT * FROM `quick_link` WHERE `text` = '{$text}'";
		if (mysql_num_rows(mysql_query($sql)) > 0)
		{
			echo 'Text đã tồn tại';
		}
		else if (empty($text) || empty($url))
		{
			echo 'Không được bỏ trống';
		}
		else
		{
			$sql = "INSERT INTO quick_link (text, url) VALUES ('{$text}', '{$url}')";
			if (mysql_query($sql))
			{
				echo 'Thêm thành công';
			}
			else
			{
				echo 'Thất bại';
			}
		}
		
	}
	?>
	<div class="phdr">Add quick link [<a href="quicklink.php?panel">Quay lại</a>]</div>
	<form action="" method="post">
		<input type="text" name="text"><br/>
		<input type="text" name="url" placeholder="http://"><br/>
		<input type="submit" name="submit" value="Add">
	</form>
	<div class="phdr">Nguồn: cRoSsOver</div>
	<?php
	
	require_once('incfiles/end.php');
}
else if (isset($_GET['install']))
{
	$rootpath = '';
	$textl = 'Cài đặt quick link';
	require_once('incfiles/core.php');
	if ($rights < 7) { exit(); }
	require_once('incfiles/head.php');
	if (isset($_POST['submit']))
	{
		$sql = "create table if not exists `quick_link` (
							`id` int(11) not null auto_increment,
							`text` text not null,
							`url` text not null,
							PRIMARY KEY (`id`)
		)";
		
		if (mysql_query($sql))
		{
			echo '<div class="omenu">Cài đặt thành công. <a href="quicklink.php?panel"><input type="button" value="Tiếp tục"></a></div>';
		}
		else
		{
			echo '<span style="color: red;">Cài đặt thất bại!</span>';
		}
	}
	?>
	<div class="phdr">Cài đặt quick link</div>
	<form method="post">
		<div class="list1"><strong>Install quick link</strong></div>
		<input type="submit" name="submit" value="Cài đặt">
	</form>
	<div class="phdr">Nguồn: cRoSsOver</div>
	<?php
	require_once('incfiles/end.php');
}
else if (isset($_GET['panel']))
{
	require_once('incfiles/core.php');
	if ($rights < 7) { exit(); }
	$textl = 'Quản lí Quick link';
	require_once('incfiles/head.php');
	?>
	<div class="phdr">Quản lý Quick link</div>
	<div class="list1">
		<a href="quicklink.php?install"><input type="button" value="Install quick link"></a>
		<a href="quicklink.php?add"><input type="button" value="Add quick link"></a>
		<a href="quicklink.php?edit"><input type="button" value="Edit quick link"></a>
	</div>
	<div class="phdr">By cRoSsOver</div>
	<?php
	require_once('incfiles/end.php');
}
else if (isset($_GET['edit']))
{
	require_once('incfiles/core.php');
	if ($rights < 7) { exit(); }
	$textl = 'Edit liên kết nhanh';
	require_once('incfiles/head.php');
	switch ($_GET['edit'])
	{
	default:
	?>
	<div class="phdr">Danh sách liên kết [<a href="quicklink.php?panel">Quay lại</a>]</div>
	<table border="1" cellspacing="0" width="98%" style="margin: 0 auto; text-align: center;">
		<?php
		$result = mysql_query("SELECT * FROM quick_link LIMIT $start,$kmess");
		while ($row = mysql_fetch_assoc($result))
		{
		?>
		<tr>
			<td><b>#<?php echo $row['text']; ?></b></td>
			<td><?php echo $row['url']; ?></td>
			<td><a href="quicklink.php?edit=change&id=<?php echo $row['id']; ?>"><input type="button" value="Edit"></a> <a href="quicklink.php?edit=del&id=<?php echo $row['id']; ?>"><input type="button" value="Delete"></a></td>
		</tr>
		<?php
		}
		?>
	</table>
	<?php
		$num = mysql_num_rows(mysql_query("SELECT * FROM quick_link"));
		if ($num > $kmess)
		{
			echo '<div class="phantrang">' . functions::display_pagination('quicklink.php?edit&'.$int, $start, $num, $kmess) . '</div>';
		}
	break;

	case 'change':
	echo '<div class="phdr">Edit liên kết</div>';
	$id = intval($_GET['id']);
	if (mysql_num_rows(mysql_query("SELECT * FROM quick_link WHERE id = '$id'")) < 1)
	{
		header('Location: quicklink.php?edit');
		exit;
}
	else
	{
		$info = mysql_fetch_assoc(mysql_query("SELECT * FROM quick_link WHERE id = '$id'"));
		if (isset($_POST['change']))
		{
			$text = strtolower($_POST['text']);
			$url = addslashes($_POST['url']);
			if (empty($text) || empty($url))
			{
				echo '<div class="menu"><strong>Không được bỏ trống</strong></div>';
			}
			else
			{
				mysql_query("UPDATE quick_link SET
					text = '$text',
					url = '$url'
					WHERE id = '$id'");
				header('Location: quicklink.php?edit');
				exit;
}
		}
		?>
		<form method="post">
			<input type="text" name="text" value="<?php echo $info['text']; ?>"><br/>
			<input type="text" name="url" value="<?php echo $info['url']; ?>"><br/>
			<input type="submit" value="Change" name="change">
		</form>
		<?php
	}
	?>
	<?php
	break;

	case 'del':
	$id = intval($_GET['id']);
	if (mysql_num_rows(mysql_query("SELECT * FROM quick_link WHERE id = '$id'")) < 1)
	{
		header('Location: quicklink.php?edit');
		exit;
}
	else
	{
		mysql_query("DELETE FROM quick_link WHERE id = '$id'");
		header('Location: quicklink.php?edit');
exit;
}
	break;
	}
	require_once('incfiles/end.php');
}
else
{
	require_once('incfiles/core.php');
	$sql = "SELECT COUNT(id) as counter FROM quick_link";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	if ($row['counter'] > 0)
	{
		$txt = strtolower($msg);
		$req = mysql_query("SELECT * FROM quick_link");
		while ($res = mysql_fetch_assoc($req))
		{
			if (preg_match('|#'.$res['text'].'|', $txt))
			{
				?>
				<script language="javascript">window.location = "<?php echo $res['url']; ?>";</script>
				<?php
				exit();
			}
		}	
	}
}
?>