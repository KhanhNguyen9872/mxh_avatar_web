<?php
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
$textl = 'Ước rồng thần';
require_once('../../incfiles/head.php');
if (!$user_id) {
	header('Location: /index.php');
	exit;
}
$nro1 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '13' AND `user_id` = '".$user_id."'"));
$nro2 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '14' AND `user_id` = '".$user_id."'"));
$nro3 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '15' AND `user_id` = '".$user_id."'"));
$nro4 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '16' AND `user_id` = '".$user_id."'"));
$nro5 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '17' AND `user_id` = '".$user_id."'"));
$nro6 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '18' AND `user_id` = '".$user_id."'"));
$nro7 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '19' AND `user_id` = '".$user_id."'"));
if ($nro1['soluong'] < 1 || $nro2['soluong'] < 1 || $nro3['soluong'] < 1 || $nro4['soluong'] < 1 || $nro5['soluong'] < 1 || $nro6['soluong'] < 1 || $nro7['soluong'] < 1) {
	echo '<div class="phdr">Rồng thần</div>';
	echo '<div class="rmenu">Hãy tìm đủ ngọc rồng rồi đến đây gặp ta!<div>';
	require_once('../../incfiles/end.php');
	exit;
}
switch($act) {
case 'HP':
echo '<div class="phdr">Ước HP</div>';
if (isset($_POST['submit'])) {
	for ($i = 13; $i <= 19; $i++) {
		mysql_query("UPDATE `vatpham` SET `soluong`= `soluong` - '1' WHERE `id_shop` = '".$i."' AND `user_id` = '".$user_id."'");
	}
$bot='[img]http://8vui.top/images/rongthan.png[/img][b]Chúc mừng [blue]'.$login.'[/blue] đã ước được 5,000 HP từ rồng thần![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
	mysql_query("UPDATE `users` SET `hpthem` = `hpthem` + '5000' WHERE `id` = '".$user_id."'");
	echo '<div class="rmenu">Ngươi đã được tăng thêm <b>5,000 HP</b></div>';
}
echo '<div class="login"><center><b>Ta sẽ tăng thêm cho ngươi <font color="red">5,000 HP</font></b><br/><form method="post"><input type="submit" name="submit" value="Ước luôn"> <a href="uocngocrong.php"><input type="button" value="Suy nghĩ lại"></a></form></center></div>';
break;
case 'sucmanh':
echo '<div class="phdr">Ước sức mạnh</div>';
if (isset($_POST['submit'])) {
	for ($i = 13; $i <= 19; $i++) {
		mysql_query("UPDATE `vatpham` SET `soluong`= `soluong` - '1' WHERE `id_shop` = '".$i."' AND `user_id` = '".$user_id."'");
	}
$bot='[img]http://8vui.top/images/rongthan.png[/img][b]Chúc mừng [blue]'.$login.'[/blue] đã ước được [red]5,000 sức mạnh [/red] từ rồng thần![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
	mysql_query("UPDATE `users` SET `smthem` = `smthem` + '5000' WHERE `id` = '".$user_id."'");
	echo '<div class="rmenu">Ngươi đã được tăng thêm <b>5,000 sức mạnh</b></div>';
}
echo '<div class="login"><center><b>Ta sẽ tăng thêm cho ngươi <font color="red">5,000 sức mạnh</font></b><br/><form method="post"><input type="submit" name="submit" value="Ước luôn"> <a href="uocngocrong.php"><input type="button" value="Suy nghĩ lại"></a></form></center></div>';
break;
case 'item':
echo '<div class="phdr">Ước vật phẩm</div>';
echo '<div class="login"><center><b>Hãy chọn 1 <font color="red">món đồ</font> mà ngươi yêu thích?</b></center></div>';
if (isset($_POST['submit'])) {
	$vp = intval($_POST['vatpham']);
	$num = mysql_num_rows(mysql_query("SELECT * FROM `item_nro` WHERE `id` = '".$vp."'"));
	if ($num < 1) {
		header('Location: /index.php');
		exit;
	}
	$post = mysql_fetch_array(mysql_query("SELECT * FROM `item_nro` WHERE `id` = '".$vp."'"));
	$res = mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id` = '".$post['vatpham']."'"));
	mysql_query("INSERT INTO `khodo` SET `user_id` = '".$user_id."', `id_shop` = '".$res['id']."', `loai` = '".$res['loai']."', `id_loai`= '".$res['id_loai']."', `tenvatpham` = '".$res['tenvatpham']."'");
	for ($i = 13; $i <= 19; $i++) {
		mysql_query("UPDATE `vatpham` SET `soluong`= `soluong` - '1' WHERE `id_shop` = '".$i."' AND `user_id` = '".$user_id."'");
	}
$bot='[img]http://8vui.top/images/rongthan.png[/img][b]Chúc mừng [blue]'.$login.'[/blue] đã ước được item từ rồng thần![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
	echo '<div class="menu">Ta đã thức hiện xong điều ước của con rồi đó</div>';
}
echo '<form method="post">';
$req = mysql_query("SELECT * FROM `item_nro`");
while ($res = mysql_fetch_array($req)) {
	$shop = mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id` = '".$res['vatpham']."'"));
	echo '<div class="menu"><table>
	<tr>
		<td><img src="/images/shop/'.$shop['id'].'.png"></td>
		<td><input type="radio" name="vatpham" value="'.$res['id'].'"><br/> <font color="green"><b>['.$shop['tenvatpham'].']</b></font></td>
	</tr>
	</table></div>';	
}
echo '<div class="gmenu"><input type="submit" value="Ước luôn" name="submit"> <a href="uocngocrong.php"><input type="button" value="Suy nghĩ lại"></a></div>';
echo '</form><div><div>';
break;
default:
header('Location: uocngocrong.php');
exit;
break;
}
require_once('../../incfiles/end.php');
?>