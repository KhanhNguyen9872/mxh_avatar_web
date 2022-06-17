<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Shop icon';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="mainblok">';
switch($act) {
default:
if (isset($_GET[buy_ok])) {
	echo '<div class="gmenu">Mua thành công!</div>';
}
if (isset($_GET[buy_no])) {
	echo '<div class="rmenu">Mua thất bại!</div>';
}
echo '<div class="phdr"><center>'.$textl.'</center></div>';
$req=mysql_query("SELECT * FROM `shopicon` WHERE `loai`='icon'");
echo '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">';
while($res=mysql_fetch_array($req)) {
echo '<tr><td class="left-info"><center><img src="'.$res[linkicon].'"></center></td><td class="right-info"><b><font color="blue">['.$res[tenvatpham].']</font></b><br>
<b>Giá: <font color="green">'.$res[gia].'</font> '.($res[loaitien]==xu?'Xu':'Lượng').'</b><br>
<a href="?act=mua&id='.$res[id].'"><input type="submit" value="Mua"></a>
</td></tr>';
}
echo '</table>';
break;
case 'add':
if ($rights==9) {
echo '<div class="phdr">Thêm Icon</div>';
if (isset($_POST[add])) {
mysql_query("INSERT INTO `shopicon` SET
`gia` ='".$_POST[gia]."',
`loaitien`='".$_POST[loaitien]."',
`linkicon` ='".$_POST[link]."',
`loai` = 'icon'
");
$bot='[b]'.$login.' vừa thêm [red] icon [/red] vào chợ trời ![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
echo '<div class="rmenu">Thêm thành công!</div>';
}
echo '<form method="post">';
echo 'Link icon: <input type="text" name="link" value="http://"><br/>';
echo 'Giá: <input type="text" name="gia"><br/>';
echo 'Loại: <select name="loaitien">
<option value="xu"> Xu</option>
<option value="vnd"> Lượng</option>
</select><br/>';
echo '<input type="submit" name="add" value="Thêm">';
echo '</form>';
}
break;
case 'mua':
$id=(int)$_GET[id];
$check=mysql_num_rows(mysql_query("SELECT * FROM `shopicon` WHERE `id`='".$id."'"));
$icon=mysql_fetch_array(mysql_query("SELECT * FROM `shopicon` WHERE `id`='".$id."'"));
$numicon=mysql_num_rows(mysql_query("SELECT * FROM `ruongicon` WHERE `id_shop` ='".$icon[id]."' AND `user_id`='".$user_id."'"));
if ($check<1) {
	header('Location: icon.php');
} else if($numicon>0) {
	header('Location: icon.php?buy_no');
} else {
if ($icon[loaitien]==xu) {
	if($datauser[xu]<$icon[gia]) {
	header('Location: icon.php?buy_no');
	} else {
	mysql_query("UPDATE `users` SET `xu`=`xu`-'".$icon[gia]."' WHERE `id`='".$user_id."'");
	mysql_query("INSERT INTO `ruongicon` SET
	`id_shop`='".$icon[id]."',
	`user_id`='".$user_id."'
	");
	header('Location: icon.php?buy_ok');
	}
} else if ($icon[loaitien]==vnd) {
	if($datauser[vnd]<$icon[gia]) {
	header('Location: icon.php?buy_no');
	} else {
	mysql_query("UPDATE `users` SET `vnd`=`vnd`-'".$icon[gia]."' WHERE `id`='".$user_id."'");
	mysql_query("INSERT INTO `ruongicon` SET
	`id_shop`='".$icon[id]."',
	`user_id`='".$user_id."'
	");
	header('Location: icon.php?buy_ok');
	}
}
}
break;
}
echo '</div>';
require('../incfiles/end.php');
?>