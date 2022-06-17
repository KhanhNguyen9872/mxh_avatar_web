<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
$textl='Shop clan';
require('../incfiles/head.php');
$neptune=mysql_num_rows(mysql_query("SELECT * FROM `nhom_user` WHERE `user_id`='".$user_id."' AND `duyet`='1'"));
if (!$neptune) {
echo '<div class="rmenu">Bạn không thuộc clan nào</div>';
require('../incfiles/end.php');
exit;
}
$dango=mysql_fetch_array(mysql_query("SELECT * FROM `nhom_user` WHERE `user_id`='".$user_id."' AND `duyet`='1'"));
switch($act) {
default:
echo '<div class="phdr">Mua item clan</div><div><div class="da">';
$req=mysql_query("SELECT * FROM `clan_kho` WHERE `clan`='".$dango[id]."'");
$tong=mysql_num_rows(mysql_query("SELECT * FROM `clan_kho` WHERE `clan`='".$dango[id]."'"));
if ($tong==0) {
echo '<div class="menu">Nhóm này chưa mua item nào!</div>';
}
while($res=mysql_fetch_array($req)) {
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$res[vp]."'"));
echo '<div class="lucifer"><img src="/images/shop/'.$res[vp].'.png" class="avatar_vina">
<b><font color="green">['.$shop[tenvatpham].']</font></b><br/>
Giá: <b><font color="black">'.$shop[gia].'</font></b> '.($shop[loaitien]==xu?'Xu':'Lượng').'<br/>
<a href="?act=mua&id='.$res[id].'"><input type="button" class="nut" value="Mua"></a></div>';
}
break;
case 'mua':
$query=mysql_query("SELECT * FROM `clan_kho` WHERE `id`='".$id."'");
$checktontai=mysql_num_rows($query);
if (!$checktontai) {
echo '<div><div class="da"><div class="phdr">Lỗi!</div>';
echo '<div class="lucifer">Vật phầm này không tồn tại</div>';
require('../incfiles/end.php');
exit;
}
$post=mysql_fetch_array($query);
if ($post[clan]!=$dango[id]) {
echo '<div><div class="da"><div class="phdr">Lỗi!</div>';
echo '<div class="lucifer">Clan của bạn chưa mua item này</div>';
} else {
echo '<div class="phdr">Mua item clan</div><div><div class="da">';
$item=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$post[vp]."'"));
if ($item[loaitien]==xu) {
if ($datauser[xu]<$item[gia]) {
echo '<div class="lucifer">Bạn không đủ tiền</div>';
} else {
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$item[gia]."' WHERE `id`='".$user_id."'");
mysql_query("INSERT INTO `khodo` SET `user_id`='".$user_id."',`tenvatpham`='".$item[tenvatpham]."',`loai`='".$item[loai]."',`id_loai`='".$item[id_loai]."',`id_shop`='".$item[id]."'");
echo '<div class="lucifer">Mua thành công <b>'.$item[tenvatpham].'</b></div>';
}
} else {
if ($datauser[vnd]<$item[gia]) {
echo '<div class="lucifer">Bạn không đủ tiền</div>';
} else {
mysql_query("UPDATE `users` SET `vnd`=`vnd`-'".$item[gia]."' WHERE `id`='".$user_id."'");
mysql_query("INSERT INTO `khodo` SET `user_id`='".$user_id."',`tenvatpham`='".$item[tenvatpham]."',`loai`='".$item[loai]."',`id_loai`='".$item[id_loai]."',`id_shop`='".$item[id]."'");
echo '<div class="lucifer">Mua thành công <b>'.$item[tenvatpham].'</b></div>';
}
}
}
break;
}
require('../incfiles/end.php');
?>