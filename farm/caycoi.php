<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
require_once('../incfiles/func.php');
$textl = 'Cửa hàng';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Mua rau củ</div>';
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
echo "<div class='menu'>";
echo "&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a>";
if(isset($_GET['id']))echo " &laquo; <a href='shop.php'>[ <b>Cửa hàng</b> ]</a>";
echo "</div></div>";
}else{
msg('Vui lòng đăng nhập!');
}
require('../incfiles/end.php');
?>