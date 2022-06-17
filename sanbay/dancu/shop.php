<?php
define('_IN_JOHNCMS', 1);
require('../../incfiles/core.php');
$textl = 'Cửa hàng vật phẩm';
require('../../incfiles/head.php');
echo '<div class="phdr">'.$textl.'</div>';
if($user_id){
@mysql_query("DELETE FROM gamemini_house_vatpham WHERE theloai2 = 'cottru'");
if(isset($_GET['act'])){
if(isset($_POST['mua'])){
$id = intval($_POST[id]);
$chektien = mysql_fetch_array(mysql_query("SELECT * FROM gamemini_house_vatpham WHERE id = '".intval($_POST[id])."'"),0);
If($chektien[donvi] == 'xu'){$donvi = 'xu';} else {$donvi = 'vnd';}
If($datauser[$donvi] >= $chektien[giatien]){
$chk = mysql_result(mysql_query("SELECT COUNT(*) FROM gamemini_house_vpcb WHERE user_id = '".$user_id."' AND name_pic = '".$chektien[name_pic]."'"),0);
@mysql_query("UPDATE users SET ".$donvi." = ".$donvi." -$chektien[giatien] WHERE id = $user_id");
@mysql_query("INSERT INTO
gamemini_house_vpcb (`user_id`, `gia`, `donvi`, `theloai2`, `name`, `name_pic`) VALUES ('".$user_id."', '".($chektien[giatien]/2)."', '".$chektien[donvi]."', '".$chektien[theloai2]."', '".$chektien[name]."', '".$chektien[name_pic]."')") OR die(mysql_error());
Echo '<div class="gmenu">Mua thành công! <a href="kho.php">[về kho]</a></div>';
} else {
Echo '<div class="rmenu">Không đủ tiền!</div>';
}
}
$qr = mysql_query("SELECT * FROM gamemini_house_vatpham WHERE `theloai2` = '".mysql_real_escape_string($_GET['act'])."' LIMIT $start, $kmess");
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM gamemini_house_vatpham WHERE theloai2 = '$_GET[act]'"),0);
While($out = mysql_fetch_array($qr)){
Echo '<div class="gmenu"><table><tbody><tr><td width="10"><img src="dodung/'.$out['name_pic'].'.png"></td><td>'.$out['name'].'<br>Giá: '.$out[giatien]; if($out[donvi] == 'xu'){echo ' Xu';} else {echo ' VNĐ';}
Echo '<form method="post"><input type="hidden" name="id" value="'.$out[id].'"><input type="submit" name="mua" value="Mua"></form></td></tr></tbody></table></div>';
}
if($tong ==0){echo 'Chưa có món đồ nào cả!';}
if ($tong > $kmess) {
echo '<div class="topmenu">' . functions::display_pagination("shop.php?act=$_GET[act]&", $start, $tong, $kmess) . '</div>';
}
}
Echo '<div class="menu"><a href="?act=giuong">Giường</a><br>';
Echo '<a href="?act=tu">Tủ</a><br>';
Echo '<a href="?act=dodien">Đồ điện</a><br>';
Echo '<a href="?act=banghe">Bàn Ghế</a><br>';
Echo '<a href="?act=trangtri">Trang trí</a><br>';
Echo '<a href="?act=linhtinh">Linh tinh</a><br>';
Echo '<a href="?act=caycanh">Cây Cảnh</a><br>';
} else {
Echo '<div class="rmenu">Vui lòng đăng nhập</div>';
}
echo '</div>';
require('../../incfiles/end.php');
?>