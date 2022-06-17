<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Mua vật nuôi';
require('../incfiles/func.php');
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="phdr">Mua vật nuôi</div>';
echo'<div class="menu list-bottom congdong">'.nick($user_id).' bạn có '.$datauser['xu'].' xu - '.$datauser['vnd'].' VNĐ</div>';
if($user_id){
if(isset($_GET['id'])) {
$id = intval($_GET['id']);
$post = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi` WHERE  `id` = '".$id."'  LIMIT 1"));




echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr><td>';
echo'<img src="/farm/vatnuoi/shop/'.$post['id'].'.png" alt="icon"/>&#160;';
echo'</td><td>';
echo'[ <b>'.htmlspecialchars($post['tenvatnuoi']).'</b> ]<br/>';
if ($post[loaixu] == 'Xu') {
echo'Giá: '.$post['sotien'].' xu';
} else {
echo'Giá: <span style="color:green">'.$post['sotien'].' VNĐ';
}
echo'</td></tr></table>';
echo'</div>';
echo'<div class="menu">';
$timesinhtruong = $post['timelon']/60/60/24;
$timesong = $post['timesong']/60/60/24;
echo 'Thời Gian Sinh truởng: [ <b>'.$timesinhtruong.' ngày</b> ]<br/>
Thời gian sống: [ <b>'.$timesong.' ngày</b> ]<br/>';
if ($post[sansinh] == 0) {
echo 'Bán ~ <b>'.$post[banfull].' xu</b><br/>';
} else {
echo 'Sản lượng ~ <b>'.$post[sansinh].'</b><br/>';
}
echo'"24 giờ mà bạn không cho ăn sẽ chết queo"';
echo'</div>';
$tongsovatnuoi = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '".$post['id']."'"),0);
$tongsovatnuoimua = $tongsovatnuoi+1;
if (isset($_POST['submit'])) {
if ($post[loaixu] == 'Xu') {
if ($datauser['xu'] < $post['sotien']) {
echo'<div class="menu list-top"><b style="color:red">Bạn không đủ xu để mua '.htmlspecialchars($post['tenvatnuoi']).' nhé !</b></div>';
echo "<div class='menu list-top congdong'>";
echo "&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a>";
if(isset($_GET['id']))echo " &laquo; <a href='shop.php'>[ <b>Cửa hàng</b> ]</a>";
echo "</div>";
echo'</div>';
require('../incfiles/end.php');
exit;
} 
} else {
if ($datauser['vnd'] < $post['sotien']) {
echo'<div class="menu list-top"><b style="color:red">Bạn không đủ VNĐ để mua '.htmlspecialchars($post['tenvatnuoi']).' nhé !</b></div>';
echo "<div class='menu list-top congdong'>";
echo "&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a>";
if(isset($_GET['id']))echo " &laquo; <a href='shop.php'>[ <b>Cửa hàng</b> ]</a>";
echo "</div>";
echo'</div>';
require('../incfiles/end.php');
exit;
} 
}


if ($tongsovatnuoi >= $post[nuoitoida]) {
echo'<div class="menu list-top"><b style="color:red">Số '.htmlspecialchars($post['tenvatnuoi']).' trong nông trại đã đầy rồi nhé !</b></div>';
} else {
if ($post[loaixu] == 'Xu' && $datauser['xu'] > $post['sotien']) {
mysql_query("UPDATE users SET `xu` = `xu`-'{$post[sotien]}' WHERE `id` = '{$user_id}'");
} 
if ($post[loaixu] == 'VNĐ' && $datauser['vnd'] > $post['sotien']) {
mysql_query("UPDATE users SET `vnd` = `vnd`-'{$post[sotien]}' WHERE `id` = '{$user_id}'");
}
                mysql_query("INSERT INTO `farm_vatnuoi_cuaban` SET 
               `user_id`='" . $user_id. "',
               `id_vatnuoi`='" .$post['id']. "',
               `tienhoa`='1',
               `timetienhoa`='" .time(). "',
               `timesong`='" .time(). "',
               `timechoan`='" .time(). "'
               "); 
               $rid = mysql_insert_id();
                mysql_query("INSERT INTO `farm_vatnuoi_choan` SET 
               `sid`='" . $rid. "',
               `user_id`='" . $user_id. "',
               `vatnuoi`='" .$post['id']. "',
               `timean`='" .time(). "',
               `xem`='0',
               `tinhtrang`='2'
               ");
echo'<div class="menu"><b style="color:green">Bạn đã mua thành công 1 con '.htmlspecialchars($post['tenvatnuoi']).' hãy vào nông trại xem nhé !</b></div>';
echo '<div class="menu list-top"><form method="post"><input type="submit" name="submit" value="Mua thêm '.htmlspecialchars($post['tenvatnuoi']).' ('.$tongsovatnuoimua.'/'.$post[nuoitoida].' con)" /></form></div>';
}
} else {
if ($tongsovatnuoi >= $post[nuoitoida]) {
echo'<div class="menu list-top"><b style="color:red">Số '.htmlspecialchars($post['tenvatnuoi']).' trong nông trại đã đầy rồi nhé !</b></div>';
} else {
echo '<div class="menu list-top"><form method="post"><input type="submit" name="submit" value="Mua '.htmlspecialchars($post['tenvatnuoi']).' ('.$tongsovatnuoi.'/'.$post[nuoitoida].' con)" /></form></div>';
}
}
} else {
$res = mysql_query("select * from `farm_vatnuoi`");
while ($post = mysql_fetch_array($res)){
echo '<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr><td width="30" style="vertical-align: top;">';
echo'<img src="/farm/vatnuoi/shop/'.$post['id'].'.png" alt="icon"/>&#160;';
echo'</td><td>';
echo'<a href="/farm/vatnuoi.php?id='.$post['id'].'">[ <b>'.htmlspecialchars($post['tenvatnuoi']).'</b> ]</a><br/>';
if ($post[loaixu] == 'Xu') {
echo'Giá: '.$post['sotien'].' xu';
} else {
echo'Giá: <span style="color:green">'.$post['sotien'].' VNĐ';
}
echo'</td></tr></table></div>';
}















}
echo "<div class='menu list-top congdong'>";
echo "&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a>";
if(isset($_GET['id']))echo " &laquo; <a href='shop.php'>[ <b>Cửa hàng</b> ]</a>";
echo "</div></div>";
}else{
msg('Vui lòng đăng nhập!');
}
require('../incfiles/end.php');
?>