<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
$textl='Đổi quà';
require('../../incfiles/head.php');
echo '<div class="mainblok">';
switch($act) {
case 'add':
if ($rights>=9) {
echo '<div class="phdr">Thêm đồ hwaii</div>';
if (isset($_POST[add])) {
$vatpham=(int)$_POST[vatpham];
$dsh=(int)$_POST[dsh];
$nlb=(int)$_POST[nlb];
$kcvt=(int)$_POST[kcvt];
$dmt=(int)$_POST[dmt];
if (empty($vatpham)) {
echo '<div class="news">Không được bỏ trống</div>';
} else {
mysql_query("INSERT INTO `shop_hawaii` SET
`id_shop`='".$vatpham."',
`nlb`='".$nlb."',
`dmt`='".$dmt."',
`kcvt`='".$kcvt."',
`dsh`='".$dsh."'");
$bot='[b]'.$login.' vừa thêm [red]item [/red] vào hawaii ![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
echo '<div class="rmenu">Thêm thành công</div>';
}
}
echo '<form method="post">';
echo 'ID vật phẩm: <input type="text" name="vatpham" size="2"><br/>';
echo 'Ngọc lục bảo: <input type="text" name="nlb" size="1"> viên<br/>';
echo 'Đá mặt trăng: <input type="text" name="dmt" size="1"> viên<br/>';
echo 'Đá sao hỏa: <input type="text" name="dsh" size="1"> viên<br/>';
echo 'Kim cương vũ trụ: <input type="text" name="kcvt" size="1"> viên<br/>';
echo '<input type="submit" name="add" value="Thêm">';
echo '</form>';
}
break;
default:
$vp32=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='32'"));
$vp33=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='33'"));
$vp34=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='34'"));
$vp35=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='35'"));
echo '<div class="phdr">Đổi quà</div><div class="lucifer">';
if (isset($_POST[doi])) {
$vp=intval($_POST[vatpham]);
$check=mysql_num_rows(mysql_query("SELECT * FROM `shop_hawaii` WHERE `id`='".$vp."'"));
if (!$check) {
echo '<div class="rmenu">Vật phẩm ko tồn tại!</div>';
} else {
$kotex=mysql_fetch_array(mysql_query("SELECT * FROM `shop_hawaii` WHERE `id`='".$vp."'"));
if ($vp32[soluong]<$kotex[nlb]||$vp33[soluong]<$kotex[dmt]||$vp34[soluong]<$kotex[dsh]||$vp35[soluong]<$kotex[kcvt]) {
echo '<div class="rmenu">Không đủ đá để đổi</div>';
} else {
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$kotex[id_shop]."'"));
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$kotex[nlb]."' WHERE `id_shop`='32' AND `user_id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$kotex[dmt]."' WHERE `id_shop`='33' AND `user_id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$kotex[dsh]."' WHERE `id_shop`='34' AND `user_id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$kotex[kcvt]."' WHERE `id_shop`='35' AND `user_id`='".$user_id."'");
mysql_query("
INSERT INTO `khodo` SET
`id_shop`='".$kotex[id_shop]."',
`user_id`='".$user_id."',
`tenvatpham`='".$shop[tenvatpham]."',
`id_loai`='".$shop[id_loai]."',
`loai`='".$shop[loai]."'
");
echo '<div class="menu">Đổi vật phẩm <b>'.$shop[tenvatpham].'</b> thành công</div>';
}
}
}
echo '<form method="post">';
echo '<table>';
$q=mysql_query("SELECT * FROM `shop_hawaii` LIMIT $start,$kmess");
$tong=mysql_num_rows(mysql_query("SELECT * FROM `shop_hawaii`"));
while($qua=mysql_fetch_array($q)) {
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$qua[id_shop]."'"));
echo '<tr>';
echo '<td><img src="/images/shop/'.$shop[id].'.png"></td>';
echo '<td>
<input type="radio" name="vatpham" value="'.$qua[id].'"> <b><font color="blue">['.$shop[tenvatpham].']</font></b>
'.($qua[nlb]>0?'<br/><img src="/images/vatpham/32.png"> <b>'.$vp32[soluong].'/'.$qua[nlb].'</b> '.($vp32[soluong]>=$qua[nlb]?'<font color="green">(Đã đủ)':'<font color="red">(Chưa đủ)</font>').'':'').'
'.($qua[dmt]>0?'<br/><img src="/images/vatpham/33.png"> <b>'.$vp33[soluong].'/'.$qua[dmt].'</b> '.($vp33[soluong]>=$qua[dmt]?'<font color="green">(Đã đủ)':'<font color="red">(Chưa đủ)</font>').'':'').'
'.($qua[dsh]>0?'<br/><img src="/images/vatpham/34.png"> <b>'.$vp34[soluong].'/'.$qua[dsh].'</b> '.($vp34[soluong]>=$qua[dsh]?'<font color="green">(Đã đủ)':'<font color="red">(Chưa đủ)</font>').'':'').'
'.($qua[kcvt]>0?'<br/><img src="/images/vatpham/35.png"> <b>'.$vp35[soluong].'/'.$qua[kcvt].'</b> '.($vp35[soluong]>=$qua[kcvt]?'<font color="green">(Đã đủ)':'<font color="red">(Chưa đủ)</font>').'':'').'
</td>';
echo '</tr>';
}
echo '</table>';
echo '<br><input type="submit" name="doi" class="nut" value="Đổi Quà Ngay!">';
echo '</form></div>';
if ($tong>$kmess) {
echo '<div class="phantrang">'.functions::display_pagination('/sanbay/hawaii/shop.php?',$start,$tong,$kmess).'';
}
break;
}
echo '';
require('../../incfiles/end.php');
?>
                            
                            
                            
                            
                            