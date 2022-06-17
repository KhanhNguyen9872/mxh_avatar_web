<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$u = $user_id;
if(!$u){
header('location: /index.php');
}
$headmod = 'Làng cổ';
$textl = 'Cửa hàng';
require('../incfiles/head.php');
echo '<div class="box_forums"><div class="homeforum"><div class="icon-home"><div class="home">Nông trại vui vẻ</div></div></div></div>';
echo'<div class="phdr"><a href="index.php">Nông trại vui vẻ</a> | '.$textl.'</div>';
switch($act){
case 'mua':
if($id){
$i = mysql_fetch_assoc(mysql_query("SELECT `tenvatpham`, `gia`, `loaitien` FROM `langtruyenthuyet_shop` WHERE `id`='".$id."'"));
echo'<div class="omenu"><form method="post">1 <b>'.$i['tenvatpham'].'</b> <img src="img/vatpham/'.$i['tenvatpham'].'.png">  = '.$i['gia'].' '.$i['loaitien'].'<br> <input type="number" name="s" placeholder="Nhập số lượng 00 - 99"><br> <input type="submit" name="mua" value="Mua"></form></div>';
if(isset($_POST['mua'])){
$s = (int)$_POST['s'];
$t = $s * $i['gia'];
if($s < 1 || $t > $datauser['xu'] || $s > 99){
echo'<div class="menu red">Giao dịch thất bại !! <a href="index.php">Trở về nông trại</a></div>';
}else{
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$t."' WHERE `id`='".$u."'");
$c = mysql_result(mysql_query("SELECT COUNT(*) FROM `langtruyenthuyet_kho` WHERE `user_id`='".$u."' AND `tenvatpham`=''.$i['tenvatpham'].'', `tanghp`=''.$i['tanghp'].'', `tanghp`=''.$i['tanghp'].''"), 0);
if($c){
mysql_query("UPDATE `langtruyenthuyet_kho` SET `soluong`=`soluong`+'".$s."' WHERE `user_id`='".$u."'");
}else{
mysql_query("INSERT INTO `nongtrai_kho` SET `user_id`='".$u."', `cay`='".$id."', `soluong`='".$s."'");
}
echo'<div class="menu blue">Giao dịch thành công !! <a href="index.php">Trở về nông trại</a></div>';
}
}
}
break;
default:
$req = mysql_query("SELECT * FROM `langtruyenthuyet_shop`");
while($res = mysql_fetch_assoc($req)){
echo'<div class="omenu"> <b><font color="ff3399">'.$res['tenvatpham'].'</font></b> <img src="img/vatpham/'.$res['tenvatpham'].'.png"><br> Giá 1 đơn vị: <b>'.$res['gia'].' '.$res['loaitien'].' / 1 '.$res['tenvatpham'].'</b><center><a href="?act=mua&id='.$res['id'].'"><font color="003366">[ Mua ]</font></a></center></div>';
}
break;
}
$req = mysql_query("SELECT * FROM `langtruyenthuyet_boss`");
while($res = mysql_fetch_assoc($req)){
mysql_query("UPDATE `langtruyenthuyet_boss` SET `hpfull`='50000'");
} 
require('../incfiles/end.php');
