<?php
define('_IN_JOHNCMS', 1);
$headmod = 'nhabep';
require_once('../../incfiles/core.php'); 
$textl = 'Nhà bếp';
require_once('../../incfiles/head.php');
 
if (!$user_id){
header("location:$home/login.php");
}

echo'<div class="out-tab"><div class="phdr">Nhà bếp  <a href="/farm/"><span class="small">[ <b>Nông trại</b> ]</span></a></div>';
$id = intval(abs($_GET['id']));
if ($id) {
$post = mysql_fetch_array(mysql_query("select * from `farm_nhabep` WHERE  `id` = '$id'  LIMIT 1"));
$thongtin = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '".$post[loainguyenlieu]."'  LIMIT 1"));
$thongtin2 = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '".$post[loainguyenlieu2]."'  LIMIT 1"));
$thongtinnguyenlieu = mysql_fetch_array(mysql_query("select * from `fermer_sclad` WHERE `semen` = '".$post[loainguyenlieu]."' AND `id_user` = '".$user_id."' LIMIT 1"));
$thongtinnguyenlieu2 = mysql_fetch_array(mysql_query("select * from `fermer_sclad` WHERE `semen` = '".$post[loainguyenlieu2]."' AND `id_user` = '".$user_id."' LIMIT 1"));
$thongtinbanh = mysql_fetch_array(mysql_query("select * from `farm_nhabep_naubanh` WHERE `user_id` = '".$user_id."' AND `loaibanh` = '" .$post['id']. "'"));
echo'<div class="'.$chiatop.'">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;">';
echo'<img src="/farm/nhabep/icon/'.$post['id'].'.png" alt="icon" />';
echo'&#160;</td><td>';
echo''.htmlspecialchars($post['tenvatlieu']).'<br/>';
echo'Nấu mất: '.$post['timenau'].' phút<br/>';
echo'</td></tr></table></div>';
$banhchinroi = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_nhabep_naubanh` WHERE `user_id` = '".$user_id."' AND `loaibanh` = '" .$post['id']. "' AND `type` = '1'"),0);

$neptune = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[soxu]'  LIMIT 1"));


if ($banhchinroi > 0) {
if (isset($_POST['nhandiem']) && $thongtinbanh[type] == 1) {
echo'<div class="danhsach phancach"><b style="color:green">Bạn đã nhận '.$neptune['name'].' vào kho !</b></div>';
echo'<div class="danhsach phancach"><a href="/farm/nhabep/?id='.$id.'"><input type="button" value="Làm mới" /></a></div>';

if($post['type']=='event'){
mysql_query("UPDATE `users` SET `diemtichluy` = `diemtichluy` + '".$post['diem']."' WHERE `id` = $user_id LIMIT 1");
} else {
#Nếu không phải event thì sẽ cộng
$remils = mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '".$post['soxu']."'"),0);
if($remils > 0) {
mysql_query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '1' WHERE `id_user` = $user_id AND `semen` = '".$post['soxu']."' LIMIT 1");
} else {
mysql_query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('1', '".$post['soxu']."', '".$user_id."') ");
}
}



mysql_query("DELETE FROM `farm_nhabep_naubanh` WHERE `loaibanh`='".$post['id']."' AND `user_id` = '".$user_id."'");
} else {
echo'<div class="danhsach phancach">'.htmlspecialchars($post['tenvatlieu']).' đã chín bạn có thể nhận <b>'.$neptune['name'].'</b> vào kho</div>';
echo'<div class="danhsach phancach"><form method="post"><input type="submit" name="nhandiem" value="Nhận" /></form></div>';
}
echo'</div>';
require_once('../../incfiles/end.php'); 
exit;
}

$lambanh = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_nhabep_naubanh` WHERE `user_id` = '".$user_id."' AND `loaibanh` = '" .$post['id']. "'"),0);
if ($lambanh > 0) {
$banhchin = $thongtinbanh['time']+$thongtinbanh[timexong];
echo'<div class="'.$chiatop.'">'.htmlspecialchars($post['tenvatlieu']).' còn '.thoigiantinh($banhchin).' nữa mới chín hãy kiên nhẫn chờ nhé !</div>';
} else {

$ass = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_nhabep_naubanh` WHERE `type` = '0' AND `user_id` = '$user_id'"),0);

if($ass>=1){
echo'<div class="'.$chiatop.' red">Bạn đã nấu một vật phẩm rồi</div></div>';
require_once('../../incfiles/end.php'); 
exit;
}

echo'<div class="'.$chiatop.'">Bạn có muốn nấu '.htmlspecialchars($post['tenvatlieu']).' bằng <b class="green">'.$post['songuyenlieu'].'</b> <img src="/farm/icon/item/'.$post['loainguyenlieu'].'.png" alt="icon" style="vertical-align: -8px;"/>'.($post['loainguyenlieu2'] == 0 ? '':' và   <b class="green">'.$post['songuyenlieu2'].'</b> <img src="/farm/icon/item/'.$post['loainguyenlieu2'].'.png" alt="icon" style="vertical-align: -8px;"/>').'</div>';
if (isset($_POST['submit'])) {
if ($thongtinnguyenlieu[kol] < $post['songuyenlieu']) {
echo'<div class="'.$chiatop.'" style="color:red">Bạn không đủ số "'.$thongtin[name].'"'.($post['loainguyenlieu2'] > 0 ? ''.($thongtinnguyenlieu2[kol] < $post['songuyenlieu2'] ? ' và số "'.$thongtin2[name].'"':'').'':'').' để làm bánh nhé !</div>';
echo'</div>';
require_once('../../incfiles/end.php'); 
exit;
}
if (!empty($post['loainguyenlieu2'])) {
if ($thongtinnguyenlieu2[kol] < $post['songuyenlieu2']) {
echo'<div class="'.$chiatop.'" style="color:red">Bạn không đủ số '.$thongtin2[name].' để làm bánh nhé !</div>';
echo'</div>';
require_once('../../incfiles/end.php'); 
exit;
}
}
mysql_query("UPDATE `fermer_sclad` SET `kol` = `kol`-'".$post['songuyenlieu']."' WHERE `id_user` = '".$user_id."' AND `semen` = '".$post['loainguyenlieu']."'");
if (!empty($post['loainguyenlieu2'])) {
mysql_query("UPDATE `fermer_sclad` SET `kol` = `kol`-'".$post['songuyenlieu2']."' WHERE `id_user` = '".$user_id."' AND `semen` = '".$post['loainguyenlieu2']."'");
}
               $timenau = $post['timenau']*60;
                mysql_query("INSERT INTO `farm_nhabep_naubanh` SET 
               `user_id`='" . $user_id. "',
               `loaibanh`='" .$post['id']. "',
               `nhandiem`='" .$post['diem']. "',
               `timexong`='" .$timenau. "',
               `time`='" .time(). "'
               ");


header("Location: $home/farm/nhabep/?id=$id");
}
echo'<div class="'.$chiatop.'"><form method="post"><input type="submit" name="submit" value="Nấu bánh" /></form></div>';
}

} else {
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_nhabep`"),0);
if($tong == 0) {
echo "<div class='ymenu space'>Hiện tại nhà bếp chưa có nguyên liệu nào !</div>";
} else {


$res = mysql_query("select * from `farm_nhabep`");
echo '<style>.test12 { opacity:0; margin-top:-61px; } .test11:hover .test12 { opacity: 1; margin-top:0px;} .test11 a { font-weight: bold; }</style>';
while ($post = mysql_fetch_array($res)){
$thongtin = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[loainguyenlieu]'  LIMIT 1"));
$neptune = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[soxu]'  LIMIT 1"));
echo '<div class="bg-trang phancach ovf-hide test11">'.
     '<a href="/farm/nhabep/?id='.$post[id].'"><img src="/farm/nhabep/icon/'.$post['id'].'.png" alt="'.$post['tenvatlieu'].'" class="left padding-5"/></a>'.
     '<div class="dis-table padding-5" style="border-left:1px dashed #ddd"><a href="/farm/nhabep/?id='.$post[id].'">'.htmlspecialchars($post['tenvatlieu']).'</a><div class="margin-l-5 test12 transf">'.
     '<img src="/images/clock.png" class="icon-m-o3" /> <b>'.$post['timenau'].'</b> phút<br/>';
if($post['type']!=event){
     echo'<img src="/icon/xu.png" class="icon-m-o3" /> <b style="color:green">'.$neptune['dohod'].'</b> Xu';
}else {
     echo'<img src="/images/money-coin.png" class="icon-m-o3" /> <b style="color:green">'.$post['diem'].'</b> Tích lũy';
}
     echo'<div>'.
     '<img src="/farm/icon/item/'.$post['loainguyenlieu'].'.png" alt="icon" style="vertical-align:middle;"/> <b style="color:green">'.$post['songuyenlieu'].'</b> '.($post['loainguyenlieu2'] == 0 ? '':' <img src="/farm/icon/item/'.$post['loainguyenlieu2'].'.png" alt="icon" style="vertical-align: middle"/> <b style="color:green">'.$post['songuyenlieu2'].'</b>').
     '</div></div></div></div>';


}

}
}
echo'</div>';
require_once('../../incfiles/end.php'); 