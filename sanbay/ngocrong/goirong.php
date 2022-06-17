<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Gọi rồng thần';
require('../../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
$nro1=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='13'");
$nro2=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='14'");
$nro3=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='15'");
$nro4=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='16'");
$nro5=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='17'");
$nro6=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='18'");
$nro7=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='19'");
$num1=mysql_num_rows($nro1);
$num2=mysql_num_rows($nro2);
$num3=mysql_num_rows($nro3);
$num4=mysql_num_rows($nro4);
$num5=mysql_num_rows($nro5);
$num6=mysql_num_rows($nro6);
$num7=mysql_num_rows($nro7);
$sao1=mysql_fetch_array($nro1);
$sao2=mysql_fetch_array($nro2);
$sao3=mysql_fetch_array($nro3);
$sao4=mysql_fetch_array($nro4);
$sao5=mysql_fetch_array($nro5);
$sao6=mysql_fetch_array($nro6);
$sao7=mysql_fetch_array($nro7);
echo '<div class="phdr">Gọi rồng thần</div>';
switch($act) {
default:
echo '<center>
<img src="/images/rongthan.png"><br/>
<div class="list1"><a href="?act=uoc&id=1"> Ước vật phẩm</a></div>
<div class="list1"><a href="?act=uoc&id=2"> Ước sức mạnh (500 ~ 5000 SM)</a></div>
<div class="list1"><a href="?act=uoc&id=3"> Ước HP (300 ~ 3000 HP)</a></div>
</center>';
break;
case 'uoc':
$id=(int)$_GET['id'];
if ($id!=1&&$id!=2&&$id!=3) {
echo '<div class="rmenu">Lỗi!</div>';
} else if($sao1[soluong]<1||$sao2[soluong]<1||$sao3[soluong]<1||$sao4[soluong]<1||$sao5[soluong]<1||$sao6[soluong]<1||$sao7[soluong]<1) {
echo '<div class="rmenu">Bạn không có đủ ngọc rồng để ước!</div>';
} else {
if ($id==1) {
$req=mysql_query("SELECT * FROM `ngocrong`");
if (isset($_POST[doi])) {
$vp=(int)$_POST[vp];
$xxx=mysql_fetch_array(mysql_query("SELECT * FROM `ngocrong` WHERE `id`='".$vp."'"));
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$xxx[vatpham]."'"));
mysql_query("
INSERT INTO `khodo` SET `user_id`='".$user_id."',
`id_shop`='".$shop[id]."',
`tenvatpham`='".$shop[tenvatpham]."',
`loai`='".$shop[loai]."',
`id_loai`='".$shop[id_loai]."'
");
for ($i=13;$i<=19;$i++) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `id_shop`='".$i."' AND `user_id`='".$user_id."'");
}
echo '<div class="news">Đổi vật phẩm thành công</div>';
}
echo '<form method="post">';
while ($res=mysql_fetch_array($req)) {
$item=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$res[vatpham]."'"));
echo '<input type="radio" name="vp" value="'.$res[id].'"><img src="/images/'.$item[loai].'/'.$item[id_loai].'.png" class="avatar_vina"><b><font color="green">['.$item[tenvatpham].']</font></b><br/><br/><br/><br/>';
}
echo '<input type="submit" name="doi" value="Đổi">';
echo '</form>';
} else if($id==2) {
$sm=rand(500,5000);
if (isset($_POST[uoc])) {
mysql_query("UPDATE `users` set `smthem`=`smthem`+'".$sm."' WHERE `id`='".$user_id."'");
for ($i=13;$i<=19;$i++) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `id_shop`='".$i."' AND `user_id`='".$user_id."'");
}
echo '<div class="news">Sức mạnh của ngươi đã được gia tăng thêm <b>'.$sm.'</b> SM</div>';
}
echo '<form method="post">Ngươi có chắc chắn?<br/><input type="submit" name="uoc" value="Ước"> <a href="goirong.php"><input type="button" value="Hủy"</a></form>';
} else if($id==3) {
$hp=rand(300,3000);
if (isset($_POST[uoc])) {
mysql_query("UPDATE `users` set `hpthem`=`hpthem`+'".$hp."' WHERE `id`='".$user_id."'");
for ($i=13;$i<=19;$i++) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `id_shop`='".$i."' AND `user_id`='".$user_id."'");
}
echo '<div class="news">HP của ngươi đã được gia tăng thêm <b>'.$sm.'</b> HP</div>';
}
echo '<form method="post">Ngươi có chắc chắn?<br/><input type="submit" name="uoc" value="Ước"> <a href="goirong.php"><input type="button" value="Hủy"</a></form>';
}
}
break;
}
echo '</div>';
require('../../incfiles/end.php');
?>