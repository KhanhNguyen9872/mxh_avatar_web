<?php
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
$textl = 'Đổi quà sự kiện Naruto';
require_once('../../incfiles/head.php');
switch ($act)
{
case 'add':
if ($rights < 9) {
header('Location: doiqua.php');
exit;
}
echo '<div class="phdr">Thêm vật phẩm</div>';
if (isset($_POST['add']))
{
	if (empty($_POST['vp']) || empty($_POST['shuriken']) || empty($_POST['kunai']))
	{
		echo '<div class="rmenu">Không được để trống</div>';
	}
	else
	{
		mysql_query("INSERT INTO `item_sukien` SET `vatpham` = '".$_POST['vp']."', `shuriken` = '".$_POST['shuriken']."', `kunai` = '".$_POST['kunai']."'");
		echo '<div class="menu">Thêm thành công</div>';
	}
}
echo '<form method="post">
ID đồ: <input type="text" size="3" name="vp"><br/>
Kem cây: <input type="text" size="5" name="shuriken" style="background: #fff url(http://i.imgur.com/yhOvLv6.png) no-repeat right; padding-right:50px;"><br/>
Kem ly: <input type="text" size="5" name="kunai" style="background: #fff url(http://i.imgur.com/KScfqF4.png) no-repeat right; padding-right: 50px;"><br/>
<input type="submit" value="Thêm" name="add">
</form>';
break;

default:
echo '<div class="phdr">Đổi quà sự kiện '.($rights>=9 ? '[<a href="?act=add">ADD</a>]' : '').'</div>';
$req = mysql_query("SELECT * FROM `item_sukien`");
$sl45 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '47' AND `user_id` = '".$user_id."'"));
$sl46 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'"));
if (isset($_POST['doi'])) {
$vp = intval($_POST['vatpham']);
$check = mysql_num_rows(mysql_query("SELECT * FROM `item_sukien` WHERE `id` = '".$vp."'"));
if ($check < 1) {
echo '<div class="rmenu">Vật phẩm không tồn tại</div>';
} else {
$post = mysql_fetch_array(mysql_query("SELECT * FROM `item_sukien` WHERE `id` = '".$vp."'"));
if ($sl45['soluong'] < $post['shuriken'] || $sl46['soluong'] < $post['kunai']) {
echo '<div class="menu">Bạn không đủ kem để đổi</div>';
} else {
$info = mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id` = '".$post['vatpham']."'"));
mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$post['shuriken']."' WHERE `id_shop` = '47' AND `user_id` = '".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` - '".$post['kunai']."' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
mysql_query("INSERT INTO `khodo` SET `user_id` = '".$user_id."', `id_shop` = '".$info['id']."', `tenvatpham` = '".$info['tenvatpham']."', `loai` = '".$info['loai']."', `id_loai` = '".$info['id_loai']."'");
echo '<div class="menu">Đổi vật phẩm thành công</div>';
}
}
}
echo '<form method="post">';
while ($res = mysql_fetch_array($req)) {
$shop = mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id` = '".$res['vatpham']."'"));
echo '<div class="menu">
<table>
	<tr>
		<td><img src="/images/shop/'.$res['vatpham'].'.png"></td>
		<td>
			<label>
				<input type="radio" name="vatpham" value="'.$res['id'].'">
				<b><font color="green">['.$shop['tenvatpham'].']</font></b>
			</label><br/>
			<img src="http://i.imgur.com/yhOvLv6.png"> <b>'.$sl45['soluong'].'/'.$res['shuriken'].'</b> '.($sl45['soluong'] < $res['shuriken'] ? '<font color="red">(Chưa đủ)</font>' : '<font color="green">(Đã đủ)</font>').'
			<img src="http://i.imgur.com/KScfqF4.png"> <b>'.$sl46['soluong'].'/'.$res['kunai'].'</b> '.($sl46['soluong'] < $res['kunai'] ? '<font color="red">(Chưa đủ)</font>' : '<font color="green">(Đã đủ)</font>').'
		</td>
	</tr>
</table>
</div>';
}
echo '<div class="gmenu" style="margin-left: 10px;"><input type="submit" name="doi" value="Đổi quà" class="nut"></div>';
echo '</form>';
break;
}
require_once('../../incfiles/end.php');
?>