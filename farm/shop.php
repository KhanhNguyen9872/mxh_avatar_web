<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
require_once('../incfiles/func.php');
$textl = 'Cửa hàng';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="phdr">Mua vật nuôi</div><div class="da"><div class="lucifer">';
echo'<div class="menu"><table cellpadding="0" cellspacing="0"><tr><td style="width: 40px;"><img id="raucu" src="icon/thunuoi/cho.png" alt="*"/>&#160;</td><td style="width: 500px;"><a href="/farm/dog.php">[ <b>Chó</b> ]</a><br/>Giá: 50 lượng hoặc 100000 xu<br/></td></tr></table></div>';
$res = mysql_query("select * from `farm_vatnuoi` LIMIT 10");
while ($post = mysql_fetch_array($res)) {
echo '<div class="menu list-top">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="width: 40px;">';
echo'<img src="/farm/vatnuoi/shop/'.$post['id'].'.png" alt="icon"/>&#160;';
echo'</td><td style="width: 500px;">';
echo'<a href="/farm/vatnuoi.php?id='.$post['id'].'">[ <b>'.htmlspecialchars($post['tenvatnuoi']).'</b> ]</a><br/>';
if ($post[loaixu] == 'Xu') {
echo'Giá: '.$post['sotien'].' xu';
} else {
echo'Giá: <span style="color:green">'.$post['sotien'].' lượng';
}
echo'</td></tr></table></div>';
}
echo'</div>';
echo'';
echo'<div class="main-xmenu">';
echo'<div class="phdr">Mua rau củ</div><div class="da"><div class="lucifer">';
echo'<div class="menu list-bottom congdong">'.nick($user_id).' bạn có '.$datauser['xu'].' xu</div>';
if($user_id){
if(isset($_GET['buy_ok'])) {
echo'<div style="background-color: #DFF0D8;padding: 5px;margin-top: 5px;margin-bottom: 3px;">Mua thành công</div>';
}
if(isset($_GET['buy_no'])) {
echo'<div style="background-color: #DFF0D8;padding: 5px;margin-top: 5px;margin-bottom: 3px;">Không đủ tiền mua</div>';
}
if(isset($_GET['id'])){
include 'cay_info.php';
}else{
include 'cay_index.php';
}

if(isset($_GET['id'])){
include 'shop_udobr_info.php';
}else{
include 'shop_udobr_index.php';
}
echo "<div class='menu'>";
echo "&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a>";
if(isset($_GET['id']))echo " &laquo; <a href='shop.php'>[ <b>Cửa hàng</b> ]</a>";
echo "</div></div>";
}else{
header('Location: /dangnhap.php');
}
echo'</div></div>';
require('../incfiles/end.php');
?>
