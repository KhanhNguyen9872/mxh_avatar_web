<?php
$numicon=mysql_num_rows(mysql_query("SELECT * FROM `ruongicon` WHERE `user_id`='".$user_id."'"));
if ($numicon>0) {
switch($act) {
default:
echo '<div class="lucifer">';
if (isset($_GET['icon_no'])) {
echo 'Thay icon thất bại!';
}
if (isset($_GET['icon_ok'])) {
echo 'Thay icon thành công!';
}
$icon=mysql_query("SELECT * FROM `ruongicon` WHERE `user_id`='".$user_id."'");
echo '<table>';
while($showicon=mysql_fetch_array($icon)) {
$itemicon=mysql_fetch_array(mysql_query("SELECT * FROM `shopicon` WHERE `id`='".$showicon['id_shop']."'"));
$nhandan='nhan_'.$itemicon['id'].'';
echo '<tr class="gmenu">
<td class="left-info"><center><img src="'.$itemicon['linkicon'].'"></center></td><td>';
if ($datauser['id']==$user_id) {
if ($itemicon['loai']==icon) {
if ($datauser['icon']!=$itemicon['linkicon']) {
echo '<a href="?act=macicon&macicon='.$showicon['id_shop'].'"><input type="button" value="Mặc" class="nut"></a>';
} else {
echo '<a href="?act=thaoicon&thaoicon='.$showicon['id_shop'].'"><input type="button" value="Tháo" class="nut"></a>';
}
}
if ($itemicon['loai']==nhan) {
if ($datauser['nhandan']!=$nhandan) {
echo '<a href="?act=macicon&macicon='.$showicon['id_shop'].'"><input type="button" value="Mặc"></a>';
} else {
echo '<a href="?act=thaoicon&thaoicon='.$showicon['id_shop'].'"><input type="button" value="Tháo"></a>';
}
}
}
echo'</td></tr>';
}
//--MOD THÁO MẶC ICON TOP--//
$config = explode('|', $datauser['iconset']);
if (isset($_GET['top']))
{
	if ($_GET['top'] == 'mac')
	{
		$data = 'on|'.$config[1];
	}
	else
	{
		$data = 'off|'.$config[1];
	}
	mysql_query("UPDATE `users` SET `iconset` = '".$data."' WHERE `id` = '".$user_id."'");
	header('Location: /ruong');
	exit;
}

if (isset($_GET['cauca']))
{
	if ($_GET['cauca'] == 'mac')
	{
		$data = $config[0].'|on';
	}
	else
	{
		$data = $config[0].'|off';
	}
	mysql_query("UPDATE `users` SET `iconset` = '".$data."' WHERE `id` = '".$user_id."'");
	header('Location: /ruong');
	exit;
}
$req = mysql_query("SELECT * FROM `users` WHERE `rights`!='9' ORDER BY `vnd` DESC");
while($res=mysql_fetch_array($req)) {
if ($i==1&&$res['id']==$user_id) {
echo '<tr class="gmenu">
<td class="left-info"><center><img src="/images/shopicon/xephang1.gif"></center></td><td>';
if ($config[0] == 'on')
{
	echo '<a href="?top=thao"><input type="button" value="Tháo" class="nut"></a>';
}
else
{
	echo '<a href="?top=mac"><input type="button" value="Mặc" class="nut"></a>';
}
echo'</td></tr>';
} else if ($i==2&&$res['id']==$user_id) {
echo '<tr class="gmenu">
<td class="left-info"><center><img src="/images/shopicon/xephang2.gif"></center></td><td>';
if ($config[0] == 'on')
{
	echo '<a href="?top=thao"><input type="button" value="Tháo" class="nut"></a>';
}
else
{
	echo '<a href="?top=mac"><input type="button" value="Mặc" class="nut"></a>';
}
echo'</td></tr>';
} else if ($i==3&&$res['id']==$user_id) {
echo '<tr class="gmenu">
<td class="left-info"><center><img src="/images/shopicon/xephang3.gif"></center></td><td>';
if ($config[0] == 'on')
{
	echo '<a href="?top=thao"><input type="button" value="Tháo" class="nut"></a>';
}
else
{
	echo '<a href="?top=mac"><input type="button" value="Mặc" class="nut"></a>';
}
echo'</td></tr>';
}
$i++;
}

$i=1;
$req = mysql_query("SELECT * FROM `users` ORDER BY `soca` DESC");
while($res=mysql_fetch_array($req)) {
if ($i==1&&$res['id']==$user_id) {
echo '<tr class="gmenu">
<td class="left-info"><center><img src="/images/shopicon/cauca1.gif"></center></td><td>';
if ($config[1] == 'on')
{
	echo '<a href="?cauca=thao"><input type="button" value="Tháo" class="nut"></a>';
}
else
{
	echo '<a href="?cauca=mac"><input type="button" value="Mặc" class="nut"></a>';
}
echo'</td></tr>';
} else if ($i==2&&$res['id']==$user_id) {
echo '<tr class="gmenu">
<td class="left-info"><center><img src="/images/shopicon/cauca2.gif"></center></td><td>';
if ($config[1] == 'on')
{
	echo '<a href="?cauca=thao"><input type="button" value="Tháo" class="nut"></a>';
}
else
{
	echo '<a href="?cauca=mac"><input type="button" value="Mặc" class="nut"></a>';
}
echo'</td></tr>';
} else if ($i==3&&$res['id']==$user_id) {
echo '<tr class="gmenu">
<td class="left-info"><center><img src="/images/shopicon/cauca3.gif"></center></td><td>';
if ($config[1] == 'on')
{
	echo '<a href="?cauca=thao"><input type="button" value="Tháo" class="nut"></a>';
}
else
{
	echo '<a href="?cauca=mac"><input type="button" value="Mặc" class="nut"></a>';
}
echo'</td></tr>';
}
$i++;
}
//--END MOD--//
echo '</table>';
break;
case 'macicon':
$macicon=(int)$_GET['macicon'];
$checkicon=mysql_num_rows(mysql_query("SELECT * FROM `shopicon` WHERE `id`='".$macicon."'"));
$checkruongicon=mysql_num_rows(mysql_query("SELECT * FROM `ruongicon` WHERE `id_shop`='".$macicon."' AND `user_id`='".$user_id."'"));
$posticon=mysql_fetch_array(mysql_query("SELECT * FROM `shopicon` WHERE `id`='".$macicon."'"));
if ($checkicon<1) {
header('Location: ?icon_no');
} else if ($checkruongicon<1) {
header('Location: ?icon_no');
} else {
if ($posticon['loai']=='icon') {
mysql_query("UPDATE `users` SET `icon`='".$posticon['linkicon']."' WHERE `id`='".$user_id."'");
} else if ($posticon['loai']=='nhan') {
mysql_query("UPDATE `users` SET `nhandan`='nhan_".$posticon['id']."' WHERE `id`='".$user_id."'");
}
header('Location: ?icon_ok');
}
break;
case 'thaoicon':
$thaoicon=(int)$_GET['thaoicon'];
$checkicon=mysql_num_rows(mysql_query("SELECT * FROM `shopicon` WHERE `id`='".$thaoicon."'"));
$checkruongicon=mysql_num_rows(mysql_query("SELECT * FROM `ruongicon` WHERE `id_shop`='".$thaoicon."' AND `user_id`='".$user_id."'"));
$posticon=mysql_fetch_array(mysql_query("SELECT * FROM `shopicon` WHERE `id`='".$thaoicon."'"));
if ($checkicon<1) {
header('Location: ?icon_no');
} else if ($checkruongicon<1) {
header('Location: ?icon_no');
} else {
if ($posticon['loai']=='icon') {
mysql_query("UPDATE `users` SET `icon`='' WHERE `id`='".$user_id."'");
} else if ($posticon['loai']=='nhan') {
mysql_query("UPDATE `users` SET `nhandan`='' WHERE `id`='".$user_id."'");
}
header('Location: ?icon_ok');
}
break;
}
echo '</div>';
}
echo '</div>';
?>