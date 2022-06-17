<?php
//Nguồn cRosSOver
//Code by cRoSsOver
//Facebook: https://web.facebook.com/duyloc.2001
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Khu Mỹ Viện';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}


//Loại

// phan chon so luong hien thi bai trang
$loaido = functions::checkout($_GET['loai']);
// phan nay se load ve trang chu neu chon xong
if (isset($_GET['loai'])) {
header ("location: myvien.php");
}

switch ($loaido) {
case toc:
$_SESSION['LOAIDO'] = toc;
break;
case mat:
$_SESSION['LOAIDO'] = mat;
break;
case khuonmat:
$_SESSION['LOAIDO'] = khuonmat;
break;
default:
if (isset($_SESSION['LOAIDO']) == FALSE) {
$_SESSION['LOAIDO'] = toc;
}
break;
}


//



//Sex


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
header ("location: myvien.php");
}

// phan nay sẽ luu gia tri moi cua bien
$kmess = $_SESSION['KMESS'];
if ($pages == 1 || $pages == 0) {
$start = 0;
} else {
$start = intval((($_SESSION['KMESS']*($pages-1))));
}

////////////////


//
// phan chon so luong hien thi bai trang
$gioitinh = functions::checkout($_GET['gioitinh']);
// phan nay se load ve trang chu neu chon xong
if (isset($_GET['gioitinh'])) {
header ("location: myvien.php");
}

switch ($gioitinh) {
case nu:
$_SESSION['SEX'] = nu;
break;
case nam:
$_SESSION['SEX'] = nam;
break;
///
}

////////////////
echo '<div class="mainblok">';
echo '<div class="phdr">Khu mỹ viện </div>';
?>
<div class="lucifer"><b>Chọn loại đồ muốn mua : </b><select class="btn btn-dark" name="url"size="1"onChange="window.open(this.options [this.selectedIndex].value,'_top')" style="border: 0;">
<?php
echo '<option>-- Chọn --</option>';
echo '<option value="?loai=mat"> Mắt</option>';
echo '<option value="?loai=toc"> Tóc</option>';
echo '<option value="?loai=khuonmat"> Khuôn mặt</option>';
?>
</select>
<div style="float:right;">
<select class="btn btn-dark" name="url"size="1"onChange="window.open(this.options [this.selectedIndex].value,'_top')" style="border: 0;">
<?php for ($i = 1; $i < 6; $i++) { 
$count = $i*10;
echo '<option value="?list='.$count.'" '.($count == $kmess ? 'selected' : '').'>'.$count.'</option>';
}
?>
</select>

<?php
echo '<button class="btn btn-dark"><a href="?gioitinh=nam"><i class="fa fa-mars" aria-hidden="true"></i> Shop Nam</a></button> ------ <button class="btn btn-dark"><a href="?gioitinh=nu"><i class="fa fa-venus" aria-hidden="true"></i> Shop Nữ</a></button></div>';
if (!isset($_GET[page])&&!isset($_POST[tim])) {
echo '<form method="post"><input type="text" name="tendotim" placeholder="Tìm kiếm..."> <input type="submit" value="Tìm" class="nut" name="tim"></form>';
}
//Mua đồ
if(isset($_POST['submit'])) {
if (empty($_POST['vatpham'])) {
header("Location: myvien.php");
} 
        foreach ($_POST['vatpham'] as $delid) {
$check=mysql_num_rows(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$delid."' AND `hienthi`='0'"));
if ($check<1) {
header("Location: myvien.php");
} else {
$post=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$delid."'"));
if ($post['loaitien']==xu) {
if ($datauser[xu]>=$post[gia]) {
//Thực hiện query
//Trừ tiền Member
@mysql_query("UPDATE `users` SET `xu`=`xu`-'".$post[gia]."' WHERE `id`='".$user_id."'");
//Add vào kho cho member
@mysql_query("INSERT INTO `khodo` SET
 `id_shop`='".$post['id']."',
 `user_id`='".$user_id."',
 `id_loai`='".$post['id_loai']."',
 `tenvatpham` ='".$post['tenvatpham']."',
 `loai`='".$post['loai']."'");
echo '<div class="omenu"><font color="green">Mua thành công vật phẩm: <b>'.$post[tenvatpham].'</b></font></div>';
} else {
header('Location: myvien.php');
}
} else {
if ($datauser[vnd]>=$post[gia]) {
///Thực hiện query
//Trừ tiền Member
@mysql_query("UPDATE `users` SET `vnd`=`vnd`-'".$post[gia]."' WHERE `id`='".$user_id."'");
//Add vào kho cho member
@mysql_query("INSERT INTO `khodo` SET
 `id_shop`='".$post['id']."',
 `user_id`='".$user_id."',
 `id_loai`='".$post['id_loai']."',
 `tenvatpham` ='".$post['tenvatpham']."',
 `loai`='".$post['loai']."'");
echo '<div class="omenu"><font color="green">Mua thành công vật phẩm: <b>'.$post[tenvatpham].'</b></font></div>';
} else {
header('Location: myvien.php');
}
}
}
///
//
}

}
//Mod tìm kiếm
if(!empty($_SESSION['LOAIDO'])) { 
$comma1 = ' where ';
$hide=' and `hienthi` = "0"'; 
$dulieu_loai = '`loai` = "'.$_SESSION['LOAIDO'].'"'; 
}
if(isset($_POST['tim'])){
if(empty($_SESSION['LOAIDO'])){
$comma3 = ' where ';
}
if((!empty($_SESSION['LOAIDO'])) && isset($_POST['tim'])){
$comma2 = ' and '; 
}
$tentim = functions::check($_POST['tendotim']);
$dulieu_loai2 = '`tenvatpham` like "%'.htmlent($tentim).'%"';
}
$dulieu = mysql_query("select * from `shopdo`".$comma1.$comma3.$dulieu_loai.$comma2.$dulieu_loai2.$hide." order by `id` desc limit $start, $kmess");
$tongit = mysql_result(mysql_query("SELECT COUNT(*) from `shopdo`".$comma1.$comma3.$dulieu_loai.$comma2.$dulieu_loai2.$hide.""), 0);
$kiemdo = mysql_num_rows($dulieu);
if (isset($_POST[tim])) {
$req=$dulieu;
$total=$tongit;
} else {
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `shopdo` WHERE `loai`='".$_SESSION['LOAIDO']."' AND `hienthi`='0' AND (`gioitinh` ='".$_SESSION['SEX']."' OR `gioitinh`='')"), 0);
$req = mysql_query("SELECT * FROM `shopdo` WHERE `loai`='".$_SESSION['LOAIDO']."' AND (`gioitinh` ='".$_SESSION['SEX']."' OR `gioitinh`='') AND `hienthi`='0' LIMIT $start,$kmess");
}
echo '<form method="post">';
while ($res=mysql_fetch_array($req)) {
echo '<div class="omenu"><input type="checkbox" name="vatpham[]" value="'.$res['id'].'"> '.($rights==9?'<a href="edit.php?id='.$res[id].'"><b><font color="red">[Edit]</font></b></a>':'').'';
echo '<img src="/images/shop/'.$res['id'].'.png" class="avatar_vina"><br/><b><font color="blue">'.$res[tenvatpham].'</font></b><br/><b>Giá: '.$res[gia].' '.($res['loaitien']==xu?'Xu':'Lượng').'</b><br/></div>';
}
if ($total == 0) {
echo '<div class="omenu">Hệ thống chưa cập nhật món đồ này</div>';
} else {
echo '<br><button name="submit" class="btn btn-info"><i class="fa fa-usd" aria-hidden="true"></i> Mua <i class="fa fa-usd" aria-hidden="true"></i></button><br><br>';
}
echo '</form>';
if ($total > $kmess) {
echo '<div class="topmenu">' . functions::display_pagination('/shop/myvien.php?', $start, $total, $kmess) . '</div>';
}
echo '';
require('../incfiles/end.php');
?>