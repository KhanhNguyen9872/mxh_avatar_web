<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Rùa Kame';
require('../../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="phdr"><center>Rùa Kame</center></div>';
echo'</br><center><img src="/icon/npc4.png"></center>';
echo '<div class="login"><center><font color="brown"><b> Ta rất thích những cô gái mặc bikini nóng bỏng   <img src="http://l.yimg.com/us.yimg.com/i/mesg/emoticons7/8.gif"></font></b></center></div>';
if (isset($_POST['submit'])) {
if (!in_array($_POST['type'], array(1,2))) {
	echo '<div class="rmenu">Bug clgt</div>';
} else {
$soluong = intval($_POST['soluong']);
$type = intval($_POST['type']);
if ($type == 1) {
$tien = 20000;
$loaitien = 'xu';
$tong = $tien * $soluong;
$idshop = 43;
}
if ($type == 2) {
$tien = 1;
$loaitien = 'vnd';
$tong = $tien * $soluong;
$idshop = 44;
}
if ($soluong <= 0) {
	echo '<div class="rmenu">Số lượng không hợp lệ</div>';
} else if ($datauser[$loaitien] < $tong) {
	echo '<div class="rmenu">Bạn không đủ tiền</div>';
} else {
	mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '$soluong' WHERE `id_shop` = '$idshop' AND `user_id` = '$user_id'");
	mysql_query("UPDATE `users` SET `$loaitien` = `$loaitien` - '$tong' WHERE `id` = '$user_id'");
	echo '<div class="menu">Bạn đã mua thành công rada. Vào rương để sử dụng</div>';
}
}
}
//rada thường
echo '<a id="ps"><div class="menu"><img src="/icon/next.png"><b> Mua rada cấp 1</b></div></a><div id="pps" style="display: none;">';
echo'<form method="post"><div class="omenu">
<input type="hidden" value="1" name="type">
<table>
<tr>
<td><img src="http://i.imgur.com/NIGH4tL.png"></td>
<td><b><font color="blue">Rada cấp 1</font></b><br/><b>Mua với giá: 20.000 xu / 1 rada</b><br/><input type="number" name="soluong" placeholder="Nhập số lượng..."></br>
<input type="submit" name="submit" value="mua" class="nut"></td>
</tr>
</table>
</div></form>
</div>';
//rada vip
echo '<a id="bs"><div class="menu"><img src="/icon/next.png"><b> Mua rada cấp 2</b></div></a><div id="bbs" style="display: none;">
<form method="post"><div class="omenu">
<input type="hidden" value="2" name="type">
<table>
<tr>
<td><img src="http://i.imgur.com/Eyk2wBt.png"></td>
<td><b><font color="blue">Rada cấp 2</font></b><br/><b>Mua với giá: 1 lượng / 1 rada</b><br/><input type="number" name="soluong" placeholder="Nhập số lượng..."></br>
<input type="submit" name="submit" value="mua" class="nut"></td>
</tr>
</table>
</div></form>
</div>';
echo '</div>';
include 'xuli.php';
require('../../incfiles/end.php');
?>