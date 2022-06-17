<?php
//Code by cRoSsOver
//Facebook: https://web.facebook.com/duyloc.2001
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Chợ trời';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
if (empty($datauser['mibile'])) {
echo '<div class="phdr">Vui lòng kích hoạt</div>';
echo '<div class="list1">Vui lòng kích hoạt tài khoản để nhắn tin ( chỉ có 500đ ) </br> Soạn : <b>ON 8VUI ACTIVE '.$user_id.'</b> gửi <b>8085</b></br> sau đó làm theo hướng dẫn khi tin nhắn gửi về </br> kích hoạt xong nhận được 5,000,000 xu và 5 lượng</div>';
exit;
}
echo '<div class="mainblok">';
switch($act) {
default:
echo '<div class="phdr">Danh mục</div>';
echo '<div class="list1"><img src="/icon/next.png"><a href="/shop/icon.php"><font color="red"><b> Shop Icon</b></a></font></div>';
echo '<div class="list1"><img src="/icon/next.png"><a href="?act=raoban"><b> Rao bán</b></a></div>';
echo '<div class="list1"><img src="/icon/next.png"><a href="?act=my"><b> Đơn hàng của tôi</b></a></div>';
echo '<div class="list1"><img src="/icon/next.png"><a href="?act=lichsu"><b> Lịch sử chợ trời</b></a></div>';
echo '<div class="list1"><img src="/icon/next.png"><a href="?act=duyet"><b> Đơn hàng chờ duyệt</b></a></div>';
echo '<div class="phdr">Đơn hàng</div>';

if (isset($_GET[ok])) {
echo '<div class="menu">Mua hàng thành công</div>';
}
if (isset($_GET[xem_ok])) {
echo '<div class="menu"><center><img src="/avatar/'.$user_id.'.png"></center></div>';
}
if (isset($_GET[xem_err])) {
echo '<div class="rmenu">Không thể dùng vật phẩm này</div>';
}
$req=mysql_query("SELECT * FROM `chotroi` WHERE `duyet`='1' ORDER BY `time` DESC LIMIT $start,$kmess");
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `chotroi` WHERE `duyet`='1'"),0);
if (isset($_POST[mua])) {
$vp=(int)$_POST[vp];
$info=mysql_fetch_array(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."'"));
$num=mysql_num_rows(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."' AND `duyet`='1'"));
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$info[id_shop]."'"));
if (!$num) {
echo '<div class="rmenu">Vật phẩm chưa được duyệt, không tồn tại hoặc đã bị mua mất</div>';
} else {
if ($info[loaitien]==xu) {
if ($datauser[xu]>=$info[gia]) {
if ($info[loaivp]=='do') {
$text='[red][b]'.$login.'[/b][/red] đã mua vật phẩm [b]'.$info[tenvatpham].'[/b] của bạn. Bạn được cộng [b]'.$info[gia].' '.($info[loaitien]==xu?'Xu':'Lượng').'[/b] vào tài khoản';
mysql_query("INSERT INTO `cms_mail` SET
			    `user_id` = '0',
			    `from_id` = '" . $info[user_id] . "',
			    `text` = '" . mysql_real_escape_string($text) . "',
			    `time` = '" . time() . "',
			    `sys` = '1',
			    `them` = 'Đơn hàng'
");
mysql_query("UPDATE `users` SET `xu`=`xu`+'".$info[gia]."' WHERE `id`='".$info[user_id]."'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$info[gia]."' WHERE `id`='".$user_id."'");
mysql_query("
INSERT INTO `lichsu_chotroi` SET
`user_id`='".$info[user_id]."',
`tenvatpham`='".$info[tenvatpham]."',
`id_loai`='".$info[id_loai]."',
`cong`='".$info[cong]."',
`soluong`='".$info[soluong]."',
`loaivp`='".$info[loaivp]."',
`conghp`='".$info[conghp]."',
`loaitien`='".$info[loaitien]."',
`sucmanh`='".$info[sucmanh]."',
`gia`='".$info[gia]."',
`hp`='".$info[hp]."',
`time`='".time()."',
`id_shop`='".$shop[id]."',
`loai`='".$info[loai]."',
`nguoi_mua`='".$user_id."',
`nguoi_duyet`='".$info[nguoi_duyet]."'
");
mysql_query("
INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`tenvatpham`='".$info[tenvatpham]."',
`id_loai`='".$shop[id_loai]."',
`cong`='".$info[cong]."',
`conghp`='".$info[conghp]."',
`sucmanh`='".$info[sucmanh]."',
`hp`='".$info[hp]."',
`id_shop`='".$shop[id]."',
`loai`='".$shop[loai]."'
");
mysql_query("DELETE FROM `chotroi` WHERE `id`='".$vp."'");
echo '<div class="menu">Mua hàng thành công</div>';
} else if($info[loaivp]=='vatpham') {
$text='[red][b]'.$login.'[/b][/red] đã mua vật phẩm [b]'.$info[tenvatpham].'[/b] của bạn. Bạn được cộng [b]'.$info[gia].' '.($info[loaitien]==xu?'Xu':'Lượng').'[/b] vào tài khoản';
mysql_query("INSERT INTO `cms_mail` SET
			    `user_id` = '0',
			    `from_id` = '" . $info[user_id] . "',
			    `text` = '" . mysql_real_escape_string($text) . "',
			    `time` = '" . time() . "',
			    `sys` = '1',
			    `them` = 'Đơn hàng'
");
mysql_query("UPDATE `users` SET `xu`=`xu`+'".$info[gia]."' WHERE `id`='".$info[user_id]."'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$info[gia]."' WHERE `id`='".$user_id."'");
mysql_query("
INSERT INTO `lichsu_chotroi` SET
`user_id`='".$info[user_id]."',
`tenvatpham`='".$info[tenvatpham]."',
`id_loai`='".$info[id_loai]."',
`cong`='".$info[cong]."',
`soluong`='".$info[soluong]."',
`loaivp`='".$info[loaivp]."',
`gia`='".$info[gia]."',
`conghp`='".$info[conghp]."',
`sucmanh`='".$info[sucmanh]."',
`loaitien`='".$info[loaitien]."',
`hp`='".$info[hp]."',
`time`='".time()."',
`id_shop`='".$shop[id]."',
`loai`='".$info[loai]."',
`nguoi_mua`='".$user_id."', 
`nguoi_duyet`='".$info[nguoi_duyet]."'
");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$info[soluong]."' WHERE `user_id`='".$user_id."' AND `id_shop`='".$info[id_shop]."'");
mysql_query("DELETE FROM `chotroi` WHERE `id`='".$vp."'");
header('Location: chotroi.php?ok');
}
} else {
echo '<div class="rmenu">Bạn không có đủ tiền để mua</div>';
}
} else if ($info[loaitien]==vnd) {
if ($datauser[vnd]>=$info[gia]) {
if ($info[loaivp]=='do') {
$text='[red][b]'.$login.'[/b][/red] đã mua vật phẩm [b]'.$info[tenvatpham].'[/b] của bạn. Bạn được cộng [b]'.$info[gia].' '.($info[loaitien]==xu?'Xu':'Lượng').'[/b] vào tài khoản';
mysql_query("INSERT INTO `cms_mail` SET
			    `user_id` = '0',
			    `from_id` = '" . $info[user_id] . "',
			    `text` = '" . mysql_real_escape_string($text) . "',
			    `time` = '" . time() . "',
			    `sys` = '1',
			    `them` = 'Đơn hàng'
");
mysql_query("UPDATE `users` SET `vnd`=`vnd`+'".$info[gia]."' WHERE `id`='".$info[user_id]."'");
mysql_query("UPDATE `users` SET `vnd`=`vnd`-'".$info[gia]."' WHERE `id`='".$user_id."'");
mysql_query("
INSERT INTO `lichsu_chotroi` SET
`user_id`='".$info[user_id]."',
`tenvatpham`='".$info[tenvatpham]."',
`loaitien`='".$info[loaitien]."',
`id_loai`='".$info[id_loai]."',
`gia`='".$info[gia]."',
`cong`='".$info[cong]."',
`soluong`='".$info[soluong]."',
`loaivp`='".$info[loaivp]."',
`conghp`='".$info[conghp]."',
`sucmanh`='".$info[sucmanh]."',
`hp`='".$info[hp]."',
`time`='".time()."',
`id_shop`='".$shop[id]."',
`loai`='".$info[loai]."',
`nguoi_mua`='".$user_id."', 
`nguoi_duyet`='".$info[nguoi_duyet]."'
");
mysql_query("
INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`tenvatpham`='".$info[tenvatpham]."',
`id_loai`='".$shop[id_loai]."',
`cong`='".$info[cong]."',
`conghp`='".$info[conghp]."',
`sucmanh`='".$info[sucmanh]."',
`hp`='".$info[hp]."',
`id_shop`='".$shop[id]."',
`loai`='".$shop[loai]."'
");
mysql_query("DELETE FROM `chotroi` WHERE `id`='".$vp."'");
header('Location: chotroi.php?ok');
} else if($info[loaivp]=='vatpham') {
$text='[red][b]'.$login.'[/b][/red] đã mua vật phẩm [b]'.$info[tenvatpham].'[/b] của bạn. Bạn được cộng [b]'.$info[gia].' '.($info[loaitien]==xu?'Xu':'Lượng').'[/b] vào tài khoản';
mysql_query("INSERT INTO `cms_mail` SET
			    `user_id` = '0',
			    `from_id` = '" . $info[user_id] . "',
			    `text` = '" . mysql_real_escape_string($text) . "',
			    `time` = '" . time() . "',
			    `sys` = '1',
			    `them` = 'Đơn hàng'
");
mysql_query("UPDATE `users` SET `vnd`=`vnd`+'".$info[gia]."' WHERE `id`='".$info[user_id]."'");
mysql_query("UPDATE `users` SET `vnd`=`vnd`-'".$info[gia]."' WHERE `id`='".$user_id."'");
mysql_query("
INSERT INTO `lichsu_chotroi` SET
`user_id`='".$info[user_id]."',
`loaitien`='".$info[loaitien]."',
`tenvatpham`='".$info[tenvatpham]."',
`gia`='".$info[gia]."',
`id_loai`='".$info[id_loai]."',
`cong`='".$info[cong]."',
`soluong`='".$info[soluong]."',
`loaivp`='".$info[loaivp]."',
`conghp`='".$info[conghp]."',
`sucmanh`='".$info[sucmanh]."',
`hp`='".$info[hp]."',
`time`='".time()."',
`id_shop`='".$shop[id]."',
`loai`='".$info[loai]."',
`nguoi_mua`='".$user_id."', 
`nguoi_duyet`='".$info[nguoi_duyet]."'
");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$info[soluong]."' WHERE `user_id`='".$user_id."' AND `id_shop`='".$info[id_shop]."'");
mysql_query("DELETE FROM `chotroi` WHERE `id`='".$vp."'");
echo '<div class="menu">Mua hàng thành công</div>';
}
} else {
echo '<div class="rmenu">Bạn không có đủ tiền để mua</div>';
}
}

}
}
//Dùng thử
if (isset($_POST[xem])) {
$vp=(int)$_POST[vp];
$info=mysql_fetch_array(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."'"));
$num=mysql_num_rows(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."'"));
if (!$num) {
header('Location: chotroi.php');
exit;
}
if ($info[loaivp]=='vatpham') {
header('Location: chotroi.php?xem_err');
} else if ($info[loaivp]=='do') {
mysql_query("UPDATE `users` SET `".$info[loai]."`='".$info[id_loai]."' WHERE `id`='".$user_id."'");
header('Location: chotroi.php?xem_ok');
}
}
//End
//Gỡ hàng cho slv
if ($rights>=6) {
if (isset($_POST[del])) {
$vp=(int)$_POST[vp];
$bug=mysql_num_rows(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."'"));
if (!$bug) {
header('Location: chotroi.php');
} else {
$info=mysql_fetch_array(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."'"));
if ($info[loaivp]=='do') {
mysql_query("
INSERT INTO `khodo` SET
`user_id`='".$info[user_id]."',
`tenvatpham`='".$info[tenvatpham]."',
`id_loai`='".$info[id_loai]."',
`cong`='".$info[cong]."',
`conghp`='".$info[conghp]."',
`sucmanh`='".$info[sucmanh]."',
`hp`='".$info[hp]."',
`id_shop`='".$info[id_shop]."',
`loai`='".$info[loai]."'
");
} else if($info[loaivp]=='vatpham') {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$info[soluong]."' WHERE `user_id`='".$info[user_id]."' AND `id_shop`='".$info[id_shop]."'");
}
mysql_query("DELETE FROM `chotroi` WHERE `id`='".$vp."'");
header('Location: chotroi.php');
}
}
}
//End
echo '<form method="post">';
echo '<div class="list1"><table>';
while($res=mysql_fetch_array($req)) {
echo '<tr>';
echo '<td>';
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$res[id_shop]."'"));
if ($res[loaivp]=='do') {
echo '<img src="/images/shop/'.$res[id_shop].'.png" >';
}
if ($res[loaivp]=='vatpham') {
echo '<img src="/images/vatpham/'.$res[id_shop].'.png" >';
}
echo '</td>';
echo '<td>';
echo '<input type="radio" name="vp" value="'.$res[id].'"> <b><font color="green">['.$res[tenvatpham].']</font>'.($res[loaivp]==vatpham?''.($res[soluong]>1?'<font color="red"> x '.$res[soluong].'</font>':'').'':'').'</b><br/>';
echo 'Giá: <b><font color="black">'.$res[gia].'</font> '.($res[loaitien]==xu?'Xu':'Lượng').'</b>';
if ($res[loaivp]=='do') {
if ($res[cong]!=0) {
echo '<br/><font color="blue">Tăng <b>'.$res[sucmanh].'</b> SM (+'.$res[cong].')</font>';
}
if ($res[cong]!=0) {
echo '<br/><font color="red">Tăng <b>'.$res[hp].'</b> HP (+'.$res[conghp].')</font>';
}
}
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$res[user_id]."'"));
echo '<br/>Người bán: <a href="/member/'.$res[user_id].'">'.$name[name].'</a>';
echo '</td>';
echo '</tr>';
}
echo '</table></div>';
if ($tong==0) {
echo '<div class="rmenu">Không có vật phẩm nào được rao bán!</div>';
} else {
echo '<div class="list1">'.($rights>=6?'<button name="del"><i class="fa fa-times" aria-hidden="true"></i> Gỡ</button> --- ':'').'<button name="mua"><i class="fa fa-usd" aria-hidden="true"></i> Mua</button> --- <button name="xem"><i class="fa fa-check-square-o" aria-hidden="true"></i> Dùng thử</button> '.(isset($_GET[xem_ok])?' --- <button><a href="chotroi.php"><i class="fa fa-reply" aria-hidden="true"></i> Trở lại</a></button>':'').'</div>';
}
echo '</form>';
if ($tong>$kmess) {
echo '<div class="phantrang">' . functions::display_pagination('/shop/chotroi.php?', $start, $tong, $kmess) . '</div>';
}
break;
case 'raoban':
echo '<div class="phdr">Rao bán </div>';
?>
<div class="list1"><b>Chọn loại hàng muốn bán :</b> <select name="url"size="1"onChange="window.open(this.options [this.selectedIndex].value,'_top')" style="border: 0;">
<?php
echo '<option value="">---Chọn---</option>';
echo '<option value="?act=raoban&loai=vatpham"> Vật phẩm</option>';
echo '<option value="?act=raoban&loai=do"> Đồ</option>';
echo '</select>';
echo '</div>';

if (!isset($_GET[loai])) {
echo '<div class="rmenu">Vui lòng chọn loại hàng muốn bán</div>';
}
$loai=functions::checkout($_GET[loai]);
if ($loai=='vatpham') {
$req=mysql_query("SELECT * FROM  `vatpham` WHERE `soluong`>'0' AND `timesudung`='0' AND `user_id`='".$user_id."' LIMIT $start,$kmess");
if (isset($_POST[chon])) {
$vatpham=(int)$_POST[vp];
$error=mysql_num_rows(mysql_query("SELECT * FROM `vatpham` WHERE `id`='".$vatpham."' AND `timesudung`='0' AND `user_id`='".$user_id."'"));
if (!$error) {
header('Location: ?act=raoban&loai=vatpham&error');
exit;
}
header('Location: ?act=ban&loai=vatpham&id='.$vatpham.'');
} else {
if (isset($_GET[error])) {
echo '<div class="rmenu">Lỗi! vui lòng xem lại</div>';
}
echo '<form method="post">';
echo '<div class="list1"><table>';
while($res=mysql_fetch_array($req)) {
$item=mysql_fetch_array(mysql_query("SELECT * FROM `shopvatpham` WHERE `id`='".$res[id_shop]."'"));
echo '<tr><td><img src="/images/vatpham/'.$res[id_shop].'.png"></td><td><input type="radio" value="'.$res[id].'" name="vp"> <b><font color="green">['.$item[tenvatpham].']</font></b><br/>Số lượng: <b>'.$res[soluong].'</b></td></tr>';
}
$tong=mysql_num_rows(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `soluong`>'0'"));
echo '</table></div>';
if ($tong==0) {
echo '<div class="rmenu">Không có món đồ nào!</div>';
} else {
echo '<div class="list1"><button name="chon">Chọn</button></div>';
}
if ($tong>$kmess) {
echo '<div class="phantrang">' . functions::display_pagination('/shop/chotroi.php?act=raoban&loai=vatpham&', $start, $tong, $kmess) . '</div>';
}
echo '</form>';
}
}
if ($loai=='do') {
if (isset($_POST[chon])) {
if (isset($_GET[error])) {
echo '<div class="rmenu">Lỗi! vui lòng xem lại</div>';
}
$vatpham=(int)$_POST[vp];
$error=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `id`='".$vatpham."' AND `timesudung`='0' AND `user_id`='".$user_id."'"));
if (!$error) {
header('Location: ?act=raoban&loai=do&error');
exit;
}
header('Location: ?act=ban&loai=do&id='.$vatpham.'');
if (isset($_GET[error])) {
echo '<div class="rmenu">Lỗi! vui lòng xem lại</div>';
}
}
$tong=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `timesudung`='0'"));
$req=mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `timesudung`='0' LIMIT $start,$kmess");
echo '<form method="post">';
echo '<div class="list1"><table>';
while($res=mysql_fetch_array($req)) {
$item=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$res[id_shop]."'"));
echo '<tr><td><img src="/images/shop/'.$res[id_shop].'.png"></td><td><input type="radio" value="'.$res[id].'" name="vp"> <b><font color="green">['.$item[tenvatpham].']</font></b><br/>'.($res[conghp]!=0?'<font color="red">Tăng: <b>'.$res[hp].'</b> HP (+'.$res[conghp].')</b></font><br/>':'').''.($res[cong]!=0?'<font color="blue">Tăng: <b>'.$res[sucmanh].'</b> SM (+'.$res[cong].')</font>':'').'</td></tr>';
}
echo '</table></div>';
if ($tong==0) {
echo '<div class="rmenu">Không có món đồ nào</div>';
} else {
echo '<div class="list1"><button name="chon"><i class="fa fa-check-square-o" aria-hidden="true"></i> Chọn</button></div>';
}
if ($tong>$kmess) {
echo '<div class="phantrang">' . functions::display_pagination('/shop/chotroi.php?act=raoban&loai=do&', $start, $tong, $kmess) . '</div>';
}
echo '</form>';
}
break;
case 'ban':
echo '<div class="phdr">Bán vật phẩm</div>';
$tbh=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop`='31' AND `user_id`='".$user_id."'"));
$loai=functions::checkout($_GET[loai]);
if ($loai=='vatpham') {
$q=mysql_query("SELECT * FROM `vatpham` WHERE `id`='".$id."' AND `soluong`>'0' AND `user_id`='".$user_id."'");
$num=mysql_num_rows($q);
if (!$num) {
echo '<div class="rmenu">ERROR</div>';
echo '</div>';
require('../incfiles/end.php');
exit;
}
$xxx=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id`='".$id."' AND `user_id`='".$user_id."'"));
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopvatpham` WHERE `id`='".$xxx[id_shop]."'"));
if (isset($_POST[ban])) {
$gia=intval($_POST[gia]);
$loaitien=functions::checkout($_POST[loaitien]);
$soluong=(int)$_POST[soluong];
if ($gia<0||empty($gia)) {
echo '<div class="rmenu">Giá tiền không hợp lệ!</div>';
} else if($xxx[soluong]<$soluong||$soluong<0||empty($soluong)) {
echo '<div class="rmenu">Số lượng không hợp lệ!</div>';
} else if($loaitien!='vnd'&&$loaitien!='xu') {
echo '<div class="rmenu">Loại tiền không hợp lệ!</div>';

echo '<div class="rmenu">Bạn phải đủ 10 bài viết trên diễn đàn để sử dụng chức năng này!</div>';
} else if($xxx[hansudung]!=0) {
echo '<div class="rmenu">Không thể bán đồ có hạn sử dụng!</div>';
} else if($tbh[soluong]<1) {
echo '<div class="rmenu">Bạn không có <a href="/shop/vatpham.php?act=mua&id=31"><img src="/images/vatpham/31.png"><b> thẻ bán hàng<b/></a></div>';
} else {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='31'");
mysql_query("INSERT INTO `chotroi` SET
`user_id`='".$user_id."',
`loai`='vatpham',
`id_shop`='".$shop[id]."',
`loaivp`='vatpham',
`loaitien`='".$loaitien."',
`gia`='".$gia."',
`soluong`='".$soluong."',
`id_loai`='".$shop[id]."',
`time` = '".time()."',
`tenvatpham`='".$shop[tenvatpham]."'
");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$soluong."' WHERE `user_id`='".$user_id."' AND `id_shop`='".$shop[id]."'");
echo '<div class="menu">Bán hàng thành công <a href="chotroi.php?act=raoban&loai=vatpham"><input type="button" value="Quay lại"></a></div>';
}
}
echo '<form method="post"><table><tr><td><img src="/images/vatpham/'.$xxx[id_shop].'.png"></td><td><b><font color="blue">['.$shop[tenvatpham].']</font></b><br/>Số lượng: <input type="text" name="soluong" size="1" value="1"> (Max: <b>'.$xxx[soluong].'</b>)<br/>Giá: <input type="text" name="gia" size="4"> <select name="loaitien"><option value="xu"> Xu</option><option value="vnd"> Lượng</option></select><br/><input type="submit" name="ban" value="Bán" class="nut"></td></tr></table></form>';
} else if($loai=='do') {
$tong=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `timesudung`='0'"));
$q=mysql_query("SELECT * FROM `khodo` WHERE `id`='".$id."' AND `timesudung`='0' AND `user_id`='".$user_id."'");
$num=mysql_num_rows($q);
if (!$num) {
echo '<div class="rmenu">ERROR</div>';
echo '</div>';
require('../incfiles/end.php');
exit;
}
$xxx=mysql_fetch_array(mysql_query("SELECT * FROM `khodo` WHERE `id`='".$id."' AND `user_id`='".$user_id."'"));
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$xxx[id_shop]."'"));
if (isset($_POST[ban])) {
$gia=intval($_POST[gia]);
$loaitien=functions::checkout($_POST[loaitien]);
$soluong=(int)$_POST[soluong];
if ($gia<0||empty($gia)) {
echo '<div class="rmenu">Giá tiền không hợp lệ!</div>';
} else if($loaitien!='vnd'&&$loaitien!='xu') {
echo '<div class="rmenu">Loại tiền không hợp lệ!</div>';
} else if($datauser['postforum'] < 10) {
echo '<div class="rmenu">Bạn phải đủ 10 bài viết trên diễn đàn để sử dụng chức năng này!</div>';
} else if($xxx[hansudung]!=0) {
echo '<div class="rmenu">Không thể bán đồ có hạn sử dụng!</div>';
} else if($tbh[soluong]<1) {
echo '<div class="rmenu">Bạn không có <a href="/shop/vatpham.php?act=mua&id=31"><img src="/images/vatpham/31.png"><b> thẻ bán hàng<b/></a></div>';
} else {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='31'");
mysql_query("INSERT INTO `chotroi` SET
`user_id`='".$user_id."',
`loai`='".$shop[loai]."',
`id_shop`='".$shop[id]."',
`loaivp`='do',
`loaitien`='".$loaitien."',
`gia`='".$gia."',
`sucmanh`='".$xxx[sucmanh]."',
`hp`='".$xxx[hp]."',
`id_loai`='".$shop[id_loai]."',
`cong`='".$xxx[cong]."',
`conghp`='".$xxx[conghp]."',
`time`='".time()."',
`tenvatpham`='".$shop[tenvatpham]."'
");
mysql_query("DELETE FROM `khodo` WHERE `id`='".$id."'");
echo '<div class="menu">Bán hàng thành công <a href="chotroi.php?act=raoban&loai=do"><input type="button" value="Quay lại"></a></div>';
}
}
echo '<form method="post"><table><tr><td><img src="/images/shop/'.$xxx[id_shop].'.png"></td><td><b><font color="green">['.$shop[tenvatpham].']</font></b><br/>'.($xxx[conghp]!=0?'<font color="red">Tăng: <b>'.$xxx[hp].'</b> HP (+'.$xxx[conghp].')</b></font><br/>':'').''.($xxx[cong]!=0?'<font color="blue">Tăng: <b>'.$xxx[sucmanh].'</b> SM (+'.$xxx[cong].')</font><br/>':'').'Giá: <input type="text" name="gia" size="4"> <select name="loaitien"><option value="xu"> Xu</option><option value="vnd"> Lượng</option></select><br/><input type="submit" name="ban" value="Bán" class="nut"></td></tr></table></form>';
}
break;
case 'my':
echo '<div class="phdr">Đơn hàng của tôi</div>';
if (isset($_GET[err])) {
echo '<div class="rmenu">Có lỗi xảy ra!</div>';
}
if (isset($_GET[ok])) {
echo '<div class="menu">Gỡ đơn hàng thành công</div>';
}
$req=mysql_query("SELECT * FROM `chotroi` WHERE `user_id`='".$user_id."' LIMIT $start,$kmess");
if (isset($_POST[del])) {
$vp=(int)$_POST[vp];
$bug=mysql_num_rows(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."' AND `user_id`='".$user_id."'"));
if (!$bug) {
header('Location: chotroi.php?act=my&err');
} else {
$info=mysql_fetch_array(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."'"));
if ($info[loaivp]=='do') {
mysql_query("
INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`tenvatpham`='".$info[tenvatpham]."',
`id_loai`='".$info[id_loai]."',
`cong`='".$info[cong]."',
`conghp`='".$info[conghp]."',
`sucmanh`='".$info[sucmanh]."',
`hp`='".$info[hp]."',
`id_shop`='".$info[id_shop]."',
`loai`='".$info[loai]."'
");
} else if($info[loaivp]=='vatpham') {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$info[soluong]."' WHERE `user_id`='".$user_id."' AND `id_shop`='".$info[id_shop]."'");
}
mysql_query("DELETE FROM `chotroi` WHERE `id`='".$vp."'");
header('Location: chotroi.php?act=my&ok');
}
}
if (isset($_POST[edit])) {
$vp=intval($_POST[vp]);
$bug=mysql_num_rows(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."' AND `user_id`='".$user_id."'"));
if (!$bug) {
header('Location: chotroi.php?act=my&err');
} else {
header('Location: chotroi.php?act=edit&id='.$vp.'');
}
}
echo '<form method="post">';
echo '<table>';
while($res=mysql_fetch_array($req)) {
if ($res[loaivp]=='do') {
echo '<tr>
<td><img src="/images/shop/'.$res[id_shop].'.png"></td>
<td>
	<input type="radio" name="vp" value="'.$res[id].'">
	<b><font color="green">['.$res[tenvatpham].']</font></b>
	'.($res[conghp]!=0?'<font color="red"><br/>Tăng: <b>'.$res[hp].'</b> HP (+'.$res[conghp].')</b></font>':'').''.($res[cong]!=0?'<br/><font color="blue">Tăng: 			<b>'.$res[sucmanh].'</b> SM (+'.$res[cong].')</font>':'').'
	<br/>Giá: <b>'.$res[gia].' '.($res[loaitien]==xu?'Xu':'Lượng').'</b>
</td>
</tr>';
}
if ($res[loaivp]=='vatpham') {
echo '<tr>
<td><img src="/images/vatpham/'.$res[id_loai].'.png"></td>
<td>
	<input type="radio" name="vp" value="'.$res[id].'">
	<b><font color="green">['.$res[tenvatpham].']</font></b> '.($res[soluong]>1?'<b><font color="red"> x '.$res[soluong].'</font></b>':'').'
	<br/>Giá: <b>'.$res[gia].' '.($res[loaitien]==xu?'Xu':'Lượng').'</b>
</td>
</tr>';
}
}
echo '</table>';
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `chotroi` WHERE `user_id`='".$user_id."'"),0);
if ($tong==0) {
echo '<div class="menu">Bạn chưa bán món hàng nào!</div>';
} else {
echo '<input type="submit" value="Gỡ xuống" name="del" class="nut"> - <input type="submit" value="Edit" name="edit" class="nut">';
}
echo '</form>';
if ($tong>$kmess) {
echo '<div class="phantrang">' . functions::display_pagination('/shop/chotroi.php?act=my&', $start, $tong, $kmess) . '</div>';
}
break;
case 'edit':
echo '<div class="phdr">Edit vật phẩm - <a href="chotroi.php">[Quay lại]</a></div>';
if (isset($_GET[ok])) {
echo '<div class="menu">Edit thành công</div>';
}
if (isset($_GET[err])) {
echo '<div class="rmenu">Có lỗi xảy ra</div>';
}
$err=mysql_num_rows(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$id."' AND `user_id`='".$user_id."'"));
if (!$err) {
echo '<div class="rmenu">Có lỗi xảy ra <a href="chotroi.php">Quay lại</a></div>';
} else {
$res=mysql_fetch_array(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$id."'"));
if ($res[loaivp]=='do') {
if (isset($_POST[edit])) {
$gia=intval($_POST[gia]);
$loaitien=functions::checkout($_POST[loaitien]);
if (empty($gia)||$gia<0||($loaitien!='vnd'&&$loaitien!='xu')) {
header('Location: ?act=edit&id='.$id.'&err');
} else {
mysql_query("UPDATE `chotroi` SET `gia`='".$gia."',`loaitien`='".$loaitien."' WHERE `id`='".$id."'");
header('Location: ?act=edit&id='.$id.'&ok');
}
}
echo '<form method="post"><table><tr><td><img src="/images/shop/'.$res[id_shop].'.png"></td><td><b><font color="green">['.$res[tenvatpham].']</font></b><br/>'.($res[conghp]!=0?'<font color="red">Tăng: <b>'.$res[hp].'</b> HP (+'.$res[conghp].')</b></font><br/>':'').''.($res[cong]!=0?'<font color="blue">Tăng: <b>'.$res[sucmanh].'</b> SM (+'.$res[cong].')</font><br/>':'').'Giá: <input type="text" name="gia" value="'.$res[gia].'" size="4"> <select name="loaitien"><option value="xu" '.($res[loaitien]=='xu'?'selected="selected"':'').'> Xu</option><option value="vnd" '.($res[loaitien]=='vnd'?'selected="selected"':'').'> Lượng</option></select><br/><input type="submit" name="edit" value="Edit" class="nut"></td></tr></table></form>';
} else if($res[loaivp]=='vatpham') {
if (isset($_POST[edit])) {
$gia=intval($_POST[gia]);
$soluong=intval($_POST[soluong]);
$xx=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop`='".$res[id_loai]."' AND `user_id`='".$user_id."'"));
$cc=$xx[soluong]+$res[soluong];
$loaitien=functions::checkout($_POST[loaitien]);
if (empty($gia)||empty($soluong)||$soluong<1||$gia<0||($loaitien!='vnd'&&$loaitien!='xu')||$cc<$soluong) {
header('Location: ?act=edit&id='.$id.'&err');
} else {
if ($soluong>$res[soluong]) {
$tru=$soluong-$res[soluong];
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$tru."' WHERE `id_shop`='".$res[id_loai]."' AND `user_id`='".$user_id."'");
}
if ($soluong<$res[soluong]) {
$cong=$res[soluong]-$soluong;
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$cong."' WHERE `id_shop`='".$res[id_shop]."' AND `user_id`='".$user_id."'");
}
mysql_query("UPDATE `chotroi` SET `gia`='".$gia."', `soluong`='".$soluong."',`loaitien`='".$loaitien."' WHERE `id`='".$id."'");
header('Location: ?act=edit&id='.$id.'&ok');
}
}
echo '<form method="post"><table><tr><td><img src="/images/vatpham/'.$res[id_shop].'.png"></td><td><b><font color="blue">['.$res[tenvatpham].']</font></b><br/>Số lượng: <input type="text" name="soluong" size="1" value="'.$res[soluong].'"><br/>Giá: <input type="text" name="gia" value="'.$res[gia].'" size="4"> <select name="loaitien"><option value="xu" '.($res[loaitien]=='xu'?'selected="selected"':'').'> Xu</option><option value="vnd" '.($res[loaitien]=='vnd'?'selected="selected"':'').'> Lượng</option></select><br/><input type="submit" name="edit" value="Edit" class="nut"></td></tr></table></form>';
}
}
break;
case 'lichsu':
echo '<div class="phdr">Lịch sử chợ trời ';
?>
<select name="url"size="1"onChange="window.open(this.options [this.selectedIndex].value,'_top')" style="border: 0;">
<?php
echo '<option value="">---Chọn---</option>';
echo '<option value="?act=lichsu&type=all"> Tất cả</option>';
echo '<option value="?act=lichsu&type=tim"> Tìm theo thành viên</option>';
echo '</select>';
echo '</div>';
$type=functions::checkout($_GET[type]);
if ($type=='tim') {
echo '<form method="post"><input type="text" name="tim" placeholder="Nhập ID thành viên"> <input type="submit" name="do" value="Dò" class="nut"></form>';
if (isset($_POST['do'])) {
$tim=intval($_POST[tim]);
$pro=mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `id`='".$tim."'"));
if (!$pro) {
	echo '<div class="rmenu">Thành viên không tồn tại</div>';
} else {
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `lichsu_chotroi` WHERE `user_id`='".$tim."' OR `nguoi_mua`='".$tim."'"),0);
if ($tong==0) {
	echo '<div class="rmenu">Người này chưa thực hiện giao dịch nào trong chợ trời</div>';
}
$req=mysql_query("SELECT * FROM `lichsu_chotroi` WHERE `user_id`='".$tim."' OR `nguoi_mua`='".$tim."'");
echo '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">';
while($res=mysql_fetch_array($req)) {
echo '<tr>
<td class="left-info">'.($res[loaivp]=='vatpham'?'<img src="/images/vatpham/'.$res[id_loai].'.png">':'<img src="/images/shop/'.$res[id_shop].'.png">').'</td>
<td class="right-info">
	<b><font color="green">['.$res[tenvatpham].']</font></b>
	'.($res[loaivp]=='do'?''.($res[conghp]!=0?'<font color="red"><br/>Tăng: <b>'.$res[hp].'</b> HP (+'.$res[conghp].')</b></font>':'').''.($res[cong]!=0?'<br/><font color="blue">Tăng: 			<b>'.$res[sucmanh].'</b> SM (+'.$res[cong].')</font>':'').'':'<br/>Số lượng: '.$res[soluong].'').'
	<br/>Giá: <b>'.$res[gia].' '.($res[loaitien]==xu?'Xu':'Lượng').'</b>
	<br/>Thòi gian: '.functions::display_date($res[time]).'
	<br/>Người mua: '.nick($res[nguoi_mua]).'
	<br/>Người bán: '.nick($res[user_id]).'
</td>
</tr>';
}
echo '</table>';
if ($tong>$kmess) {
echo '<div class="topmenu">' . functions::display_pagination('/shop/chotroi.php?act=lichsu&type=tim&', $start, $tong, $kmess) . '</div>';
}
}
}
} else {
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `lichsu_chotroi`"),0);
$req=mysql_query("SELECT * FROM `lichsu_chotroi` ORDER BY `time` DESC LIMIT $start,$kmess");
echo '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">';
while($res=mysql_fetch_array($req)) {
echo '<tr>
<td class="left-info">'.($res[loaivp]=='vatpham'?'<img src="/images/vatpham/'.$res[id_loai].'.png">':'<img src="/images/shop/'.$res[id_shop].'.png">').'</td>
<td class="right-info">
	<b><font color="green">['.$res[tenvatpham].']</font></b>
	'.($res[loaivp]=='do'?''.($res[conghp]!=0?'<font color="red"><br/>Tăng: <b>'.$res[hp].'</b> HP (+'.$res[conghp].')</b></font>':'').''.($res[cong]!=0?'<br/><font color="blue">Tăng: 			<b>'.$res[sucmanh].'</b> SM (+'.$res[cong].')</font>':'').'':'<br/>Số lượng: '.$res[soluong].'').'
	<br/>Giá: <b>'.$res[gia].' '.($res[loaitien]==xu?'Xu':'Lượng').'</b>
	<br/>Thòi gian: '.functions::display_date($res[time]).'
	'.(!empty($res[nguoi_duyet])?'<br/>Người duyệt hàng: '.nick($res[nguoi_duyet]).'':'').'
	<br/>Người mua: '.nick($res[nguoi_mua]).'
	<br/>Người bán: '.nick($res[user_id]).'
</td>
</tr>';
}
echo '</table>';
if ($tong>$kmess) {
echo '<div class="topmenu">' . functions::display_pagination('/shop/chotroi.php?act=lichsu&type=all&', $start, $tong, $kmess) . '</div>';
}
}
break;
case 'duyet':
$donhang=mysql_num_rows(mysql_query("SELECT * FROM `chotroi` WHERE `duyet`='0'"));
$req=mysql_query("SELECT * FROM `chotroi` WHERE `duyet`='0'");
echo '<div class="phdr">Duyệt đơn hàng</div>';
if ($donhang) {
	if ($rights>=6) {
if (isset($_POST[chapthuan])) {
	$vp=intval($_POST[vp]);
	$ccc=mysql_num_rows(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."'"));
	if (!$ccc) {
		echo '<div class="rmenu">Vật phẩm không tồn tại</div>';
	} else {
	mysql_query("UPDATE `chotroi` SET `duyet`='1',`nguoi_duyet`='".$user_id."' WHERE `id`='".$vp."'");
	header('Location: chotroi.php?act=duyet');
	}
}
if (isset($_POST[huybo])) {
	$vp=intval($_POST[vp]);
	$ccc=mysql_num_rows(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."'"));
		$info=mysql_fetch_array(mysql_query("SELECT * FROM `chotroi` WHERE `id`='".$vp."'"));
	if (!$ccc) {
		echo '<div class="rmenu">Vật phẩm không tồn tại</div>';
	} else {
	if ($info[duyet]==1) {
		echo '<div class="rmenu">Đơn hàng này đã được duyệt rồi!</div>';
	} else {
	mysql_query("DELETE FROM `chotroi` WHERE `id`='".$vp."'");
	if ($info[loaivp]=='do') {
mysql_query("
INSERT INTO `khodo` SET
`user_id`='".$info[user_id]."',
`tenvatpham`='".$info[tenvatpham]."',
`id_loai`='".$info[id_loai]."',
`cong`='".$info[cong]."',
`conghp`='".$info[conghp]."',
`sucmanh`='".$info[sucmanh]."',
`hp`='".$info[hp]."',
`id_shop`='".$info[id_shop]."',
`loai`='".$info[loai]."'
");
} else if($info[loaivp]=='vatpham') {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$info[soluong]."' WHERE `user_id`='".$info[user_id]."' AND `id_shop`='".$info[id_shop]."'");
}
	header('Location: chotroi.php?act=duyet');
	}
	}
}
}
}
echo '<form method="post">';
echo '<table>';
while($res=mysql_fetch_array($req)) {
if ($res[loaivp]=='do') {
echo '<tr>
<td><img src="/images/shop/'.$res[id_shop].'.png"></td>
<td>
	<input type="radio" name="vp" value="'.$res[id].'">
	<b><font color="green">['.$res[tenvatpham].']</font></b>
	'.($res[conghp]!=0?'<font color="red"><br/>Tăng: <b>'.$res[hp].'</b> HP (+'.$res[conghp].')</b></font>':'').''.($res[cong]!=0?'<br/><font color="blue">Tăng: 			<b>'.$res[sucmanh].'</b> SM (+'.$res[cong].')</font>':'').'
	<br/>Người bán: <a href="/member/'.$res[user_id].'.html"><b>'.nick($res[user_id]).'</b></a>
	<br/>Giá: <b>'.$res[gia].' '.($res[loaitien]==xu?'Xu':'Lượng').'</b>
</td>
</tr>';
}
if ($res[loaivp]=='vatpham') {
echo '<tr>
<td><img src="/images/vatpham/'.$res[id_loai].'.png"></td>
<td>
	<input type="radio" name="vp" value="'.$res[id].'">
	<b><font color="green">['.$res[tenvatpham].']</font></b> '.($res[soluong]>1?'<b><font color="red"> x '.$res[soluong].'</font></b>':'').'
	<br/>Người bán: <a href="/member/'.$res[user_id].'.html"><b>'.nick($res[user_id]).'</b></a>
	<br/>Giá: <b>'.$res[gia].' '.($res[loaitien]==xu?'Xu':'Lượng').'</b>
</td>
</tr>';
}
}
echo '</table>';
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `chotroi` WHERE `duyet`='0'"),0);
	if ($tong==0) {
		echo '<div class="menu">Không có đơn hàng nào chờ duyệt</div>';
	} else {
		if ($rights>=6) {
		echo '<input type="submit" value="Chấp thuận" name="chapthuan" class="nut"> - <input type="submit" value="Hủy bỏ" name="huybo" class="nut">';
		}
	}
echo '</form>';
if ($tong>$kmess) {
echo '<div class="phantrang">' . functions::display_pagination('/shop/chotroi.php?act=duyet&', $start, $tong, $kmess) . '</div>';
}
break;
}

echo '<div>';

require('../incfiles/end.php');
?>