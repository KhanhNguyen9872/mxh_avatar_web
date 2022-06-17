<?php
//Nguồn cRosSOver
//Code by cRoSsOver
//Facebook: https://web.facebook.com/duyloc.2001
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Cửa hàng Pet';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}



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
header ("location: pet.php");
}

// phan nay sẽ luu gia tri moi cua bien
$kmess = $_SESSION['KMESS'];
if ($pages == 1 || $pages == 0) {
$start = 0;
} else {
$start = intval((($_SESSION['KMESS']*($pages-1))));
}
echo '<div class="mainblok">';
echo '<div class="phdr">Cửa hàng PET ';
?>
<select class="btn btn-info" name="url"size="1"onChange="window.open(this.options [this.selectedIndex].value,'_top')" style="border: 0;">
<?php for ($i = 1; $i < 6; $i++) { 
$count = $i*10;
echo '<option value="?list='.$count.'" '.($count == $kmess ? 'selected' : '').'>'.$count.'</option>';
}
?>
</select>
</div>
<?php
if (!isset($_GET[page])&&!isset($_POST[tim])) {
echo '<div class="list1"><form method="post"><input type="text" name="tendotim" placeholder="Tìm kiếm..."> <input type="submit" value="Tìm" class="nut" name="tim"></form></div>';
}
//Mua đồ
if(isset($_POST['submit'])) {
if (empty($_POST['vatpham'])) {
header("Location: pet.php");
} 
        foreach ($_POST['vatpham'] as $delid) {
$check=mysql_num_rows(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$delid."' AND `hienthi`='0'"));
if ($check<1) {
header("Location: pet.php");
} else {
$post=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$delid."' AND `hienthi`='0'"));
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
 //nhiệm vụ naruto
$check_nv = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `user_id` = '".$user_id."' AND `id_nv` = '3'"));
if ($check_nv > 0) {
mysql_query("UPDATE `naruto_nhiemvu` SET `tiendo` = `tiendo` + '1' WHERE `id_nv` = '3' AND `user_id` = '".$user_id."'");
}
//end nhiệm vụ naruto
echo '<div class="omenu"><font color="green">Mua thành công vật phẩm: <b>'.$post[tenvatpham].'</b></font></div>';
} else {
header('Location: pet.php');
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
//nhiệm vụ naruto
$check_nv = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `user_id` = '".$user_id."' AND `id_nv` = '3'"));
if ($check_nv > 0) {
mysql_query("UPDATE `naruto_nhiemvu` SET `tiendo` = `tiendo` + '1' WHERE `id_nv` = '3' AND `user_id` = '".$user_id."'");
}
//end nhiệm vụ naruto
echo '<div class="omenu"><font color="green">Mua thành công vật phẩm: <b>'.$post[tenvatpham].'</b></font></div>';
} else {
header('Location: pet.php');
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
$dulieu_loai = '`loai` = "thucung"'; 
$hide=' and `hienthi` = "0"'; 
}
if(isset($_POST['tim'])){
$comma2 = ' and '; 
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
$req = mysql_query("SELECT * FROM `shopdo` WHERE `loai`='thucung' AND `hienthi`='0'  LIMIT $start,$kmess");
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `shopdo` WHERE `loai`='thucung' AND `hienthi`='0'"), 0);
}
echo '<form method="post">';
while ($res=mysql_fetch_array($req)) {
echo '<div class="omenu"><input type="checkbox" name="vatpham[]" value="'.$res['id'].'"> '.($rights==9?'<a href="edit.php?id='.$res[id].'"><b><font color="red">[Edit]</font></b></a>':'').'';
echo '<div class="lucifer"><img src="/images/shop/'.$res['id'].'.png" class="avatar_vina"><br/><b><font color="blue">'.$res[tenvatpham].'</font></b><br/><b>Giá: '.$res[gia].' '.($res['loaitien']==xu?'Xu':'Lượng').'</b><br/></div></div>';
}
if ($total == 0) {
echo '<div class="omenu">Hệ thống chưa cập nhật món đồ này</div>';
} else {
echo '<div class="list1"><button class="btn btn-danger" name="submit"><i class="fa fa-usd" aria-hidden="true"></i> Mua <i class="fa fa-usd" aria-hidden="true"></i></button></div>';
}
echo '</form>';
if ($total > $kmess) {
echo '<div class="topmenu">' . functions::display_pagination('/shop/pet.php?', $start, $total, $kmess) . '</div>';
}
echo '<div>';
require('../incfiles/end.php');
?>