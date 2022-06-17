<?php
//Code by cRoSsOver
//Facebook: https://web.facebook.com/duyloc.2001
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Tài xỉu';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="mainblok">';
$kq=mysql_fetch_array(mysql_query("SELECT * FROM `taixiu` ORDER BY `id` DESC LIMIT 1"));
$xxx=$kq[1]+$kq[2]+$kq[3];
$lan=$kq[id]+1;
if ($xxx<11) {
$hero='xiu';
$xxx='Xỉu';
} else {
$hero='tai';
$xxx='Tài';
}
echo '<div class="phdr">Kết quả đợt trước <b>['.$xxx.']</b></div>';
echo '<div class="da"><div class="lucifer"><img src="img/taixiu/'.$kq[1].'.jpg"> <img src="img/taixiu/'.$kq[2].'.jpg"> <img src="img/taixiu/'.$kq[3].'.jpg"></div>';
$q=mysql_query("SELECT * FROM `cuoctaixiu` WHERE `lan`='".$lan."' ORDER BY `time` LIMIT $start,$kmess");
$num=mysql_num_rows($q);
if ($num>0) {
echo '<div class="phdr">Người chơi đặt cược</div>';
while($post=mysql_fetch_array($q)) {
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$post[user_id]."'"));
echo '<div class="list1"><b>'.$name[name].'</b> đã đặt <font color="red">'.($post[taixiu]=='tai'?'Tài':'Xỉu').'</font> <b>'.$post[tien].'</b> xu</div>';
}
if ($num>$kmess) {
echo '' . functions::pages_team('taixiu.php?page=', $start, $num, $kmess) . '';
}
}
echo '<div class="phdr">Đặt cược</div>';
if (isset($_POST[dat])) {
$tien=(int)$_POST[sotien];
$taixiu=$_POST[taixiu];
if ($datauser[xu]<$tien||empty($tien)||$tien<=0) {
echo '<div class="rmenu">Tiền cược không hợp lệ</div>';
} else if($taixiu!='tai'&&$taixiu!='xiu') {
echo '<div class="rmenu">ERROR...</div>';
} else if ($tien > 200000) {
echo '<div class="rmenu">Số tiền đặt không quá 200.000</div>';
} else {
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$tien."' WHERE `id`='".$user_id."'");
mysql_query("INSERT INTO `cuoctaixiu` SET `user_id`='".$user_id."', `lan`='".$lan."',`time`='".time()."',`taixiu`='".mysql_real_escape_string($taixiu)."',`tien`='".$tien."'");
header('Location: taixiu.php');
}
}
echo '<div class="lucifer"><form method="post">Bạn đặt gì?<br/>
<select name="taixiu"><option value="xiu"> Đặt xỉu [Từ 3 - 10 nút xúc xắc]</option><option value="tai"> Đặt tài [Từ 11 - 18 nút xúc xắc]</option></select><br/>
Số tiền đặt:<br/>
<input type="text" name="sotien"><br/>
<input type="submit" name="dat" value="Đặt" class="nut">
</div></form>';
$qe=mysql_query("SELECT * FROM `cuoctaixiu` WHERE `lan`='".$kq[id]."' ORDER BY `time` LIMIT $start,$kmess");
$num=mysql_num_rows($qe);
if ($num>0) {
echo '<div class="phdr">Lịch sử cược</div>';
while($post=mysql_fetch_array($qe)) {
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$post[user_id]."'"));
echo '<div class="list1"><b>'.$name[name].'</b> đã đặt <font color="red">'.($post[taixiu]=='tai'?'Tài':'Xỉu').'</font> và <b>'.($post[taixiu]==$hero?'Ăn':'Thua').'</b> <b>'.$post[tien].'</b> xu</div>';
}
if ($num>$kmess) {
echo '' . functions::pages_team('taixiu.php?page=', $start, $num, $kmess) . '';
}
}
echo '';
require('../incfiles/end.php');
?>