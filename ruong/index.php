<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$id=(int)$_GET[id];
$checku=mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'"));
if ($checku>0) {
$ru=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'"));
}
if ($checku<1) {
$textl='Rương đồ';
} else {
$textl='Rương đồ của '.$ru[name].'';
}
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /index.php');
exit;
}
if ($checku>0) {
$user_id=$ru[id];
}
echo '<div class="mainblok">';
////
// phan chon so luong hien thi bai trang
$count_list = intval($_GET['list']);
$pages = intval($_GET['page']);

// phan nay dung de chay session de luu lai gia tri $kmess moi.
switch ($count_list) {
case 10:
$_SESSION['KMESS'] = 10;
break;
case 20:
$_SESSION['KMESS'] = 20;
break;
case 30:
$_SESSION['KMESS'] = 30;
break;
case 40:
$_SESSION['KMESS'] = 40;
break;
case 50:
$_SESSION['KMESS'] = 50;
break;
default:
if (isset($_SESSION['KMESS']) == FALSE) {
$_SESSION['KMESS'] = 10;
}
break;
}

// phan nay se load ve trang chu neu chon xong
if (isset($_GET['list'])) {
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : core::$system_set['homeurl'];
header ("location: $referer");
}

// phan nay sẽ luu gia tri moi cua bien
$kmess = $_SESSION['KMESS'];
if ($pages == 1 || $pages == 0) {
$start = 0;
} else {
$start = intval((($_SESSION['KMESS']*($pages-1))));
}
//
// phan chon so luong hien thi bai trang
$loaido = functions::checkout($_GET['loai']);
// phan nay se load ve trang chu neu chon xong
if (isset($_GET['loai'])) {
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : core::$system_set['homeurl'];
header ("location: $referer");
}

switch ($loaido) {
case ao:
$_SESSION['LOAIDO'] = ao;
break;
case toc:
$_SESSION['LOAIDO'] = toc;
break;
case mat:
$_SESSION['LOAIDO'] = mat;
break;
case khuonmat:
$_SESSION['LOAIDO'] = khuonmat;
break;
case all;
$_SESSION['LOAIDO'] = all;
break;
case quan:
$_SESSION['LOAIDO'] = quan;
break;
case cancau:
$_SESSION['LOAIDO'] = cancau;
break;
case non:
$_SESSION['LOAIDO'] = non;
break;
case nensau:
$_SESSION['LOAIDO'] = nensau;
break;
case matna:
$_SESSION['LOAIDO'] = matna;
break;
case thucung:
$_SESSION['LOAIDO'] = thucung;
break;
case docamtay:
$_SESSION['LOAIDO'] = docamtay;
break;
case haoquang:
$_SESSION['LOAIDO'] = haoquang;
break;
case canh:
$_SESSION['LOAIDO'] = canh;
break;
case bua:
$_SESSION['LOAIDO'] = mat;
break;
default:
if (isset($_SESSION['LOAIDO']) == FALSE) {
$_SESSION['LOAIDO'] = all;
}
break;
}
////
echo '<div class="phdr">Rương đồ </div>';
?>
<div class="list1"><b>Chọn loại đồ :</b> <select name="url"size="1"onChange="window.open(this.options [this.selectedIndex].value,'_top')" style="border: 0;">
<?php
echo '<option>-- Chọn --</option>';
echo '<option value="?loai=all"> Tất cả</option>';
echo '<option value="?loai=ao"> Áo</option>';
echo '<option value="?loai=quan"> Quần</option>';
echo '<option value="?loai=canh"> Cánh</option>';
echo '<option value="?loai=matna"> Mặt nạ</option>';
echo '<option value="?loai=haoquang"> Hào quang</option>';
echo '<option value="?loai=non"> Mũ</option>';
echo '<option value="?loai=kinh"> Kính</option>';
echo '<option value="?loai=thucung"> Thú cưng</option>';
echo '<option value="?loai=docamtay"> Đồ cầm tay</option>';
echo '<option value="?loai=toc"> Tóc</option>';
echo '<option value="?loai=mat"> Mắt</option>';
echo '<option value="?loai=khuonmat"> Khuôn mặt</option>';
echo '<option value="?loai=mat"> Mắt</option>';
echo '<option value="?loai=cancau"> Cần câu</option>';
?>
</select>
<div style="float:right;">
<select name="url"size="1"onChange="window.open(this.options [this.selectedIndex].value,'_top')" style="border: 0;">
<?php for ($i = 1; $i < 6; $i++) { 
$count = $i*10;
echo '<option value="?list='.$count.'" '.($count == $kmess ? 'selected' : '').'>'.$count.'</option>';
}
?>
</select>
</div>
</div><div class="lucifer">
<?php
//Cường hóa
if (isset($_POST[cuonghoa])) {
$vatpham=(int)$_POST[vatpham];
header('Location: cuonghoa.php?id='.$vatpham.'');
exit;
}
//Vứt đồ
if (isset($_POST['vut']))
{
$vatpham=(int)$_POST[vatpham];
header('Location: del.php?id='.$vatpham.'');
exit;
}
//Chuyển hóa
if (isset($_POST['chuyenhoa'])) {
$vatpham=(int)$_POST[vatpham];
header('Location: chuyenhoa.php?act=add&id='.$vatpham.'');
exit;
}
//Mặc
include 'mac.php';
//Tháo
include 'thao.php';
echo '<form method="post">';
if ($_SESSION['LOAIDO']=='all') {
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `khodo` WHERE `user_id`='".$user_id."'"),0);
$req=mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' limit $start, $kmess");
} else {
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='".$_SESSION['LOAIDO']."' "),0);
$req=mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='".$_SESSION['LOAIDO']."' limit $start, $kmess");
}
while ($res=mysql_fetch_array($req)) {
$pro=mysql_fetch_array(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='".$res[loai]."'"));
echo '<div class="omenu"><input type="radio" name="vatpham" value="'.$res[id].'" '.($_SESSION['LOAIDO']=='all'?'':''.($pro[id_ruong]==$res[id]?'checked="checked"':'').'').'><img src="/images/shop/'.$res[id_shop].'.png" class="avatar_vina">
<b><font color="green">'.$res[tenvatpham].'</font></b> '.($pro[id_ruong]==$res[id]?'<font color="red"> (Đang mặc)</font>':'').''.($res[timesudung]!=0?' - <font color="blue">Còn: '.thoigiantinh(floor($res[timesudung])).'</font>':'').'<br/>'.($res[conghp]>0?'<font color="red">Tăng HP: <b>'.$res[hp].' [ +'.$res[conghp].' ]</b></font>':'').'<br/>'.($res[cong]>0?'<font color="blue">Tăng SM: <b>'.$res[sucmanh].' [ +'.$res[cong].' ]</b></font>':'').'<br/>
</div>';
} if ($tong == 0) {
echo '<div class="rmenu">Bạn chưa có món đồ nào!</div>';
} else {
if ($datauser[id]==$user_id) {
echo '';
echo '<input type="submit" name="mac" value="Mặc" class="nut"> - <input type="submit" name="thao" value="Tháo" class="nut"> - <input type="submit" name="cuonghoa" value="Cường hóa" class="nut"> - <input type="submit" class="nut" name="chuyenhoa" value="Chuyển hóa"> - <input type="submit" name="vut" value="Xóa" class="nut">';
echo '';
}
}
if ($tong>$kmess) {
if ($datauser[id]!=$user_id) {
echo '' . functions::display_pagination('index.php?id='.$_GET[id].'&',$start,$tong,$kmess).'';
} else {
echo '' . functions::display_pagination('index.php?',$start,$tong,$kmess).'';
}
}
echo '</form></div>';
echo'';
include 'vatpham.php';
echo'';
include 'icon.php';
include 'xuli.php';
echo'<div><div>';
require('../incfiles/end.php');
?>