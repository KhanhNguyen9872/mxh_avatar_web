<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Dr.Doom';
require('../../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
switch($act) {
default:
echo '<div class="phdr">'.$textl.'</div>';
echo '<div class="forumtext">
<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tbody><tr><td width="45px;" class="blog-avatar"><img src="/sanbay/hawaii/drdoom.gif" class="xavt"></td>
<td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0">
<tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left"><img src="/giaodien/images/left-blog.png"></div><img style="vertical-align:middle;" title=" is online" src="/images/on.png" alt="online"> <font color="red"><b>Dr.Doom</b></font><div class="text">
<div class="omenu"><a href="?act=nlb">Đổi ngọc lục bảo <img src="/images/vatpham/32.png"></a></div>
<div class="omenu"><a href="?act=dmt">Đổi đá mặt trăng <img src="/images/vatpham/33.png"></a></div>
<div class="omenu"><a href="?act=dsh">Đổi Đá Sao Hỏa <img src="/images/vatpham/34.png"></a></div>
<div class="omenu"><a href="?act=kcvt">Đổi Kim Cương Vũ Trụ <img src="/images/vatpham/35.png"></a></div>
</div></td></tr></tbody></table></td></tr></tbody></table></div>';
break;
case 'nlb':
echo '<div class="phdr">Đổi ngọc lục bảo [<a href="npc.php">Quay lại</a>]</div>';
echo '<div class="list1">Điểm chuyên cần <b>'.$datauser[chuyencan].'</b></div>';
if (isset($_POST[doi])) {
if ($datauser[chuyencan]<20) {
echo '<div class="rmenu">Bạn không đủ điểm chuyên cần để đổi ngọc lục bảo</div>';
} else {
mysql_query("UPDATE `users` SET `chuyencan`=`chuyencan`-'20' WHERE `id`='".$user_id."' ");
mysql_query("UPDATE `vatpham`SET `soluong`=`soluong`+'1' WHERE `id_shop`='32' AND `user_id`='".$user_id."'");
echo '<div class="menu">Đổi thành công</div>';
}
}
echo '<form method="post">
<div class="gmenu">Bạn có muốn đổi 20 điểm chuyên cần lấy 1 viên ngọc lục bảo không?<br/>
<input type="submit" name="doi" value="Đổi luôn"></div>
</form>';
break;
case 'dmt':
echo '<div class="phdr">Đổi đá mặt trăng [<a href="npc.php">Quay lại</a>]</div>';
$cc=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop`='32' AND `user_id`='".$user_id."'"));
echo '<div class="list1"><img src="/images/vatpham/'.$cc[id_shop].'.png"> Ngọc lục bảo <b>'.$cc[soluong].' viên</b></div>';
if (isset($_POST[doi])) {
if ($cc[soluong]<2) {
echo '<div class="rmenu">Bạn không có đủ ngọc lục bảo để đổi</div>';
} else {
mysql_query("UPDATE `vatpham`SET `soluong`=`soluong`-'2' WHERE `id_shop`='32' AND `user_id`='".$user_id."'");
mysql_query("UPDATE `vatpham`SET `soluong`=`soluong`+'1' WHERE `id_shop`='33' AND `user_id`='".$user_id."'");
echo '<div class="menu">Đổi thành công</div>';
}
}
echo '<form method="post">
<div class="gmenu">Bạn có muốn đổi 2 ngọc lục bảo lấy 1 viên đá mặt trăng không?<br/>
<input type="submit" name="doi" value="Đổi luôn"></div>
</form>';
break;
case 'dsh':
echo '<div class="phdr">Đổi đá sao hỏa [<a href="npc.php">Quay lại</a>]</div>';
$cc=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop`='33' AND `user_id`='".$user_id."'"));
echo '<div class="list1"><img src="/images/vatpham/'.$cc[id_shop].'.png"> Đá mặt trăng <b>'.$cc[soluong].' viên</b></div>';
if (isset($_POST[doi])) {
if ($cc[soluong]<2) {
echo '<div class="rmenu">Bạn không có đủ đá mặt trăng bảo để đổi</div>';
} else {
mysql_query("UPDATE `vatpham`SET `soluong`=`soluong`-'2' WHERE `id_shop`='33' AND `user_id`='".$user_id."'");
mysql_query("UPDATE `vatpham`SET `soluong`=`soluong`+'1' WHERE `id_shop`='34' AND `user_id`='".$user_id."'");
echo '<div class="menu">Đổi thành công</div>';
}
}
echo '<form method="post">
<div class="gmenu">Bạn có muốn đổi 2 đá mặt trăng lấy 1 viên đá sao hỏa không?<br/>
<input type="submit" name="doi" value="Đổi luôn"></div>
</form>';
break;
case 'kcvt':
echo '<div class="phdr">Đổi kim cương vũ trụ [<a href="npc.php">Quay lại</a>]</div>';
$cc=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop`='34' AND `user_id`='".$user_id."'"));
echo '<div class="list1"><img src="/images/vatpham/'.$cc[id_shop].'.png"> Đá sao hỏa <b>'.$cc[soluong].' viên</b></div>';
if (isset($_POST[doi])) {
if ($cc[soluong]<2) {
echo '<div class="rmenu">Bạn không có đá sao hỏa bảo để đổi</div>';
} else {
mysql_query("UPDATE `vatpham`SET `soluong`=`soluong`-'2' WHERE `id_shop`='34' AND `user_id`='".$user_id."'");
mysql_query("UPDATE `vatpham`SET `soluong`=`soluong`+'1' WHERE `id_shop`='35' AND `user_id`='".$user_id."'");
echo '<div class="menu">Đổi thành công</div>';
}
}
echo '<form method="post">
<div class="gmenu">Bạn có muốn đổi 2 đá sao hỏa lấy 1 viên kim cương vũ trụ không?<br/>
<input type="submit" name="doi" value="Đổi luôn"></div>
</form>';
}
/*
break;
case 'buydmt':
echo '<div class="phdr">Mua đá mặt trăng [<a href="npc.php">Quay lại</a>]</div>';
if (isset($_POST[buy])) {
if ($datauser[xu]<1500000) {
echo '<div class="rmenu">Bạn không có đủ tiền để mua</div>';
} else {
mysql_query("UPDATE `users` SET `xu`=`xu`-'1500000' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `vatpham`SET `soluong`=`soluong`+'1' WHERE `id_shop`='33' AND `user_id`='".$user_id."'");
echo '<div class="menu">Mua thành công</div>';
}
}
echo '<form method="post">
<div class="gmenu">Bạn có muốn mua 1 viên đá mặt trăng giá 1.500.000 xu hay không?<br/>
<input type="submit" name="buy" value="Mua luôn"></div>
</form>';
break;
}
*/
echo'<div><div>';
require('../../incfiles/end.php');
?>                                
                            
                            