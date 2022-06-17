<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl='Lái buôn';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '';
switch($act) {
default:
echo'<div class="da"><div><div class="phdr">Lái Buôn</div><table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tr><td width="50px;" class="blog-avatar"><img src="//4rumvn.net/nongtrai/images/laibuon.gif"/></td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0"><tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left"><img src="//4rumvn.net/giaodien/images/left-blog.png"></div><img src="//4rumvn.net/images/on.png" alt="online"/><font color="red"> <b> Lái Buôn </b></font><div class="text"><div class="omenu"><a href="bangxephang.php"><b><font color="blue"> Bảng Xếp Hạng </b></font></a></div><div class="omenu"><a href="?act=baodanh"> Báo danh hằng ngày</a></div><div class="omenu"><a href="'.$home.'/farm/nangcap.php"> Nâng Cấp Đất</a></div><div class="omenu"><a href="?act=shuriken"> Đổi Shuriken<a/></div>

<div class="omenu"><a href="?act=kunai"> Đổi Kunai</a></div><div class="omenu"><a href="idthienan_antrom.php"> Ăn Trộm Farm<a/></div>

</div></div></td></tr></tbody></table></td></tr></tbody></table>';

break;
case 'baodanh';
echo '<div class="phdr">Báo danh</div>';
if (isset($_POST['baodanh'])) {
if ($datauser['baodanh']==1) {
echo '<div class="lucifer"><div class="rmenu">Hôm nay bạn đã báo danh rồi!</div></div>';
} else {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `user_id`='".$user_id."' AND `id_shop`='12'");
mysql_query("UPDATE `users` SET `chuyencan`=`chuyencan`+'5',`baodanh`='1' WHERE `id`='".$user_id."'");
echo '<div class="lucifer"><div class="menu congdong">Báo danh thành công!</div></div>';
}
}
echo '<div><div class="lucifer"><form method="post">';
echo 'Nhận 5 điểm chuyên cần và 1 thẻ quay số free<br/>';
echo '<input type="submit" name="baodanh" value="Báo danh">';
echo '</form>';
break;
case 'shuriken':
$i_3=mysql_fetch_array(mysql_query("SELECT * FROM `fermer_sclad` WHERE `id_user`='".$user_id."' AND `semen`='3'"));
$i_28=mysql_fetch_array(mysql_query("SELECT * FROM `fermer_sclad` WHERE `id_user`='".$user_id."' AND `semen`='28'"));
$i_31=mysql_fetch_array(mysql_query("SELECT * FROM `fermer_sclad` WHERE `id_user`='".$user_id."' AND `semen`='31'"));
echo '<div class="phdr">Đổi Shuriken [<a href="/farm">Nông trại</a>]</div></div>';

if (isset($_POST['doi'])) {

if ($i_28['kol']>=15&&$i_31['kol']>=15&&$i_3['kol']>=20) {
mysql_query("UPDATE `fermer_sclad` SET `kol`=`kol`-'20' WHERE `semen`='3' AND `id_user`='".$user_id."'");
mysql_query("UPDATE `fermer_sclad` SET `kol`=`kol`-'15' WHERE `semen`='28' AND `id_user`='".$user_id."'");
mysql_query("UPDATE `fermer_sclad` SET `kol`=`kol`-'15' WHERE `semen`='31' AND `id_user`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='47' AND `user_id`='".$user_id."'");
echo '<div class="menu">Đổi thành công</div>';
} else {
echo '<div class="rmenu">Không đủ nguyên liệu</div>';
}
}
echo '<div class="lucifer"><form method="post" action="">';

echo '<b>x15</b><img src="/farm/icon/shop/28.png"><br/>
<b>x20</b><img src="/farm/icon/shop/3.png"><br/>
<b>x15</b><img src="/farm/icon/shop/31.png"><br/>
<br/><input type="submit" name="doi" value="Đổi" style="width:80px; text-align:left; background-position: right;   background-image:url(/images/vatpham/47.png); background-repeat: no-repeat;"></div>';
echo '</form>';
echo'</div><div><div><div><div>';
break;

case 'kunai':
$i_3=mysql_fetch_array(mysql_query("SELECT * FROM `fermer_sclad` WHERE `id_user`='".$user_id."' AND `semen`='3'"));
$i_28=mysql_fetch_array(mysql_query("SELECT * FROM `fermer_sclad` WHERE `id_user`='".$user_id."' AND `semen`='28'"));
$i_31=mysql_fetch_array(mysql_query("SELECT * FROM `fermer_sclad` WHERE `id_user`='".$user_id."' AND `semen`='31'"));
echo '<div class="phdr">Đổi Kunai [<a href="/farm">Nông trại</a>]</div>';
if (isset($_POST['doi'])) {
if ($i_28['kol']>=10&&$i_31['kol']>=10&&$i_3['kol']>=15) {
mysql_query("UPDATE `fermer_sclad` SET `kol`=`kol`-'15' WHERE `semen`='3' AND `id_user`='".$user_id."'");
mysql_query("UPDATE `fermer_sclad` SET `kol`=`kol`-'10' WHERE `semen`='28' AND `id_user`='".$user_id."'");
mysql_query("UPDATE `fermer_sclad` SET `kol`=`kol`-'10' WHERE `semen`='31' AND `id_user`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='48' AND `user_id`='".$user_id."'");
echo '<div class="menu">Đổi thành công</div>';
} else {
echo '<div class="rmenu">Không đủ nguyên liệu</div>';
}

}
echo '<form method="post" action="">
<div class="lucifer"><b>x10</b><img src="/farm/icon/shop/28.png"><br/>
<b>x15</b><img src="/farm/icon/shop/3.png"><br/>
<b>x10</b><img src="/farm/icon/shop/31.png"><br/>
<br/><input type="submit" name="doi" value="Đổi" style="width:80px; text-align:left; background-position: right;   background-image:url(/images/vatpham/48.png); background-repeat: no-repeat;"></div>';
echo'
</form>';

echo'</div><div><div><div>';

break;
//--huy hiệu ánh sáng--//
/*
case 'event':
$i_2=mysql_fetch_array(mysql_query("SELECT * FROM `fermer_sclad` WHERE `id_user`='".$user_id."' AND `semen`='2'"));
$i_28=mysql_fetch_array(mysql_query("SELECT * FROM `fermer_sclad` WHERE `id_user`='".$user_id."' AND `semen`='28'"));
echo '<div class="phdr">Đổi Kem ly [<a href="/farm">Nông trại</a>]</div>';
if (isset($_POST['doi'])) {
if ($i_28['kol']>=10 && $i_2['kol']>=20) {
$time = time() + 30 * 24 * 3600;
mysql_query("UPDATE `fermer_sclad` SET `kol`=`kol`-'20' WHERE `semen`='2' AND `id_user`='".$user_id."'");
mysql_query("UPDATE `fermer_sclad` SET `kol`=`kol`-'10' WHERE `semen`='28' AND `id_user`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1', `timesudung` = '".$time."' WHERE `id_shop`='46' AND `user_id`='".$user_id."'");
echo '<div class="menu">Đổi thành công</div>';
} else {
echo '<div class="rmenu">Không đủ nguyên liệu</div>';
}
}
echo '<form method="post">';
echo '<div class="list1"><b>x10</b><img src="/farm/icon/shop/28.png"><br/>
<b>x20</b><img src="/farm/icon/shop/2.png"><br/>
<br/><input type="submit" name="doi" value="Đổi" style="width:80px;height:60px;text-align:left; background-position: right;background-image:url(http://i.imgur.com/vCGprNG.png); background-repeat: no-repeat;"></div>';
echo '</form>';
break;

}
*/
}

require('../incfiles/end.php');
?>
                            
                            
                            
                            