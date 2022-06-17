<?php
Define('_IN_JOHNCMS', 1);
require('../../incfiles/core.php');
$textl = 'Kho đồ của bạn';
require('../../incfiles/head.php');
if($user_id){
Echo '<div class="phdr">Kho nội thất</div>';
$h = mysql_fetch_array(mysql_query("SELECT * FROM gamemini_house WHERE user_id = $user_id"),0);
If($h[level] ==1){$level = 'nenbetong';}
If($h[level] ==2){$level = 'nengach';}
if($h[level] ==3){$level = 'nengo'; }
$trangtri = mysql_query("SELECT * FROM gamemini_house_vpcb WHERE (theloai2 = 'trangtri' OR name_pic = 'dieuhoa') AND user_id = '$user_id' AND hienthi = '1' ORDER BY time ASC");
While($ott = mysql_fetch_array($trangtri)){
Echo '<span style="padding-left: '.$ott['css'].'%;"><img src="dodung/'.$ott[name_pic].'.png"></span>';
}
echo '<div class="'.$level.'" style="min-height:100px; margin:0">';
$other = mysql_query("SELECT * FROM gamemini_house_vpcb WHERE theloai2 != 'trangtri' AND user_id = '$user_id' AND hienthi = '1' AND name_pic != 'dieuhoa' ORDER BY time ASC");
While($ott1 = mysql_fetch_array($other)){
if($ott1[xuongdong] ==1){echo '<br>';}
if($ott1[xuongdong] ==2){echo '<br><br>';}
If($ott1[xuongdong] ==3){echo '<br><br><br>';}
If($ott1[xuongdong] ==4){echo '<br><br><br><br>';}
If($ott1[xuongdong] ==5){echo '<br><br><br><br><br>';}
Echo '<span style="padding-left: '.$ott1['css'].'%;"><img src="dodung/'.$ott1[name_pic].'.png"></span>';
}

echo'</div>';
$id = intval($_GET[id]);
if(isset($_GET[id])){
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM gamemini_house_vpcb WHERE id = $id"),0);
$vp = mysql_fetch_array(mysql_query("SELECT * FROM gamemini_house_vpcb WHERE id = $id"),0);
If($dem ==0 OR $vp[user_id] != $user_id){
Header("Location: $home/sanbay/dancu/kho.php");
}
If(isset($_GET[ban])){
if($vp[donvi] == 'xu'){$dv = 'xu';}else{$dv = 'vnd';}
@mysql_query("UPDATE users SET ".$dv." = ".$dv." +$vp[gia] WHERE id = $user_id");
@mysql_query("DELETE FROM gamemini_house_vpcb WHERE id = $id");
echo '<div class="bgmenu">Bán thành công!</div>';
}
if(isset($_GET[thao])){
@mysql_query("UPDATE gamemini_house_vpcb SET hienthi =0, time = '' WHERE id = $id");
header("Location: $home/sanbay/dancu/kho.php?id=$id&dung");
}
If(isset($_GET[dung])){
If(isset($_POST[ok])){
if($vp['theloai2'] == 'trangtri' OR $vp['name_pic'] == 'dieuhoa'){
if($_POST['ht'] >95 OR $_POST['ht'] < 0){
Echo '<div class="rmenu">Các giá trị nhập vào không hợp lệ!</div>';
} else {
if(empty($vp['time'])){$time1 = $time;} else {$time1 = $vp['time'];}
@mysql_query("UPDATE gamemini_house_vpcb SET `hienthi` =1, `css` ='".intval($_POST['ht'])."', time = '".$time1."' WHERE `id` = $id") OR die(mysql_error());
header("Location: $home/sanbay/dancu/kho.php?id=$id&dung");
}
} else {
if($_POST['ht'] >95 OR $_POST['ht'] < 0 OR $_POST['xuongdong'] >5 OR $_POST['xuongdong'] <0){
Echo '<div class="rmenu">Các giá trị nhập vào không hợp lệ!</div>';
} else {
if(empty($vp['time'])){$time1 = $time;} else {$time1 = $vp['time'];}
@mysql_query("UPDATE gamemini_house_vpcb SET `hienthi` =1, `css` ='".intval($_POST['ht'])."', `xuongdong` = '".intval($_POST['xuongdong'])."', time = '".$time1."' WHERE `id` = $id") OR die(mysql_error());
header("Location: $home/sanbay/dancu/kho.php?id=$id&dung");
}
}
}
Echo '<div class="gmenu"><form method="post">';
if($vp['name_pic'] != 'dieuhoa' AND $vp['theloai2'] != 'trangtri'){
If($vp['xuongdong'] ==1){$selected1 = 'selected';}
If($vp['xuongdong'] ==2){$selected2 = 'selected';}
If($vp['xuongdong'] ==3){$selected3 = 'selected';}
If($vp['xuongdong'] ==4){$selected4 = 'selected';}
If($vp['xuongdong'] ==0){$selected = 'selected';}
If($vp['xuongdong'] ==5){$selected5 = 'selected';}
Echo' <select name="xuongdong"><option value="0" '.$selected.'>Không xuống dòng</option><option value="1" '.$selected1.'>Xuống 1 dòng</option><option value="2" '.$selected2.'>Xuống 2 dòng</option><option value="3" '.$selected3.'>Xuống 3 dòng</option><option value="4" '.$selected4.'>Xuống 4 dòng</option><option value="5" '.$selected5.'>Xuống 5 dòng</option></select><br>';
}
echo 'Nhập khoảng cách đặt đồ (%) căn từ bên trái. Chiều rộng căn nhà là 100% có thể đặt là 0 và tối đa là 95. <green><b>Sẽ xảy ra hiệu ứng xô đẩy. Ví dụ: bạn đặt tivi và máy giặt cùng 1 hàng. Tivi 30% máy giặt cũng 30% mà tivi đặt trước máy giặt đặt sau => máy giặt bị tivi đẩy xuống thành 60% trường hợp tivi 30% mà máy giặt 90% (30% + 90% = 120%) => máy giặt bị đẩy xuống 1 dòng mới. Vì vậy các bạn phải tính toán chính xác vị trí của món đồ (làm nhiều rồi sẽ quen)</green><br></b><input type="number" name="ht" value="'.$vp['css'].'"> ';
Echo '<input type="submit" name="ok" value="Đặt"></form></div>';
}
}
$qr = mysql_query("SELECT * FROM gamemini_house_vpcb WHERE user_id = $user_id ORDER BY id DESC LIMIT $start, $kmess");
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM gamemini_house_vpcb WHERE user_id = $user_id"),0);
While($out = mysql_fetch_array($qr)){
if($id != $out[id]){
echo '<div class="gmenu">';
} else {
Echo '<div class="rmenu">';
}
Echo'<table><tbody><tr><td width="10"><img src="dodung/'.$out[name_pic].'.png"></td><td>'.$out[name].'<br>Giá bán: '.$out[gia]; if($out[donvi] == 'xu'){echo ' Xu';} else {echo ' VNĐ';}
echo '<br><a href="?id='.$out[id].'&ban">[Bán]</a>';
if($out[hienthi] ==0){
Echo '<a href="?id='.$out[id].'&dung">[Dùng]</a>';
} else {
Echo '<a href="?id='.$out[id].'&dung">[Sửa]</a>';
echo '<a href="?id='.$out[id].'&thao">[Tháo]</a>';
}
Echo '</td></tr></tbody></table></div>';
}
if($tong ==0){
Echo 'Chưa có món đồ nào <a href="shop.php">[Vào shop]</a>';
}
if ($tong > $kmess) {
echo '<div class="menu">' . functions::display_pagination('kho.php?', $start, $tong, $kmess) . '</div>';
}
} else {
Echo '<div class="rmenu">Vui lòng đăng nhập</div>';
}
require('../../incfiles/end.php');
?>