<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Khu kết hôn';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
switch($act) {
default:
echo '<div class="phdr">NPC Hôn Ước</div><div class="lucifer">';
echo '<center><img src="/images/on.png"><font color="FF0000"> NPC Chủ Hôn </font><img src="/icon/Admin.png"></center>';
echo '<center><img src="/icon/chuhon.png"></center>';
echo '<div class="menu"><a href="?act=kethon">Đăng kí kết hôn</a></div>';
echo '<div class="menu"><a href="?act=tim">Tìm bạn tình</a></div>';
echo '<div class="menu"><a href="?act=lydi">Ly dị</a></div>';
break;
case 'tim':
echo '<div class="phdr">10 thanh niên FA ngẫu nhiên  <a href="honnhan.php">[Quay lại]</a></div>';
$req=mysql_query("SELECT * FROM `users` WHERE `nguoiyeu`='0' ORDER BY RAND() LIMIT 10");
while($res=mysql_fetch_array($req)) {
echo '<div class="lucifer"><img src="/avatar/'.$res[id].'.png" class="avatar_vina">'.nick($res[id]).'<br/><a href="honnhan.php?act=kethon&id='.$res[id].'"><img src="/images/clan/21.png"> Cầu hôn</a><br/><br/><br/></div>';
}
echo'<div>';
break;
case 'lydi':
echo '<div class="phdr">Ly hôn</div><div class="lucifer">';
if ($datauser[nguoiyeu]==0) {
echo '<div class="rmenu">Vần còn ế mà!</div>';
} else {
$xxx=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$datauser[nguoiyeu]."'"));
if (isset($_POST[lydi])) {
mysql_query("UPDATE `users` SET `nguoiyeu`='0' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `users` SET `nguoiyeu`='0' WHERE `id`='".$xxx[id]."'");
echo '<div class="menu">Bạn đã trở thành người tự do</div>';
}
echo '<form method="post"><center><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png" class="xavt"></label> <img src="/icon/tinhyeu.png"> <label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$xxx[name].'</b><br><img src="/avatar/'.$datauser[nguoiyeu].'.png"></label><br/><font color="blue">Hãy suy nghĩ trước khi quyết định bạn nhé....!</font><br/><input type="submit" class="nut" name="lydi" value="Ly hôn"></center></form>';
}
break;
case 'kethon':
echo '<div class="mainblok">';
echo '<div class="phdr">Đăng kí kết hôn</div>';
if (!$id) {
if (isset($_POST[cauhon])) {
$ten=trim($_POST[ten]);
$num=mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE LCASE(`name`)='".mysql_real_escape_string(strtolower($ten))."'"));
$xxx=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE LCASE(`name`)='".mysql_real_escape_string(strtolower($ten))."'"));
if (!$num) {
echo '<div class="rmenu">Nhân vật không tồn tại!</div>';
} else {
header('Location: ?act=kethon&id='.$xxx[id].'');
}
}
echo '<div class="lucifer"><form method="post">
<input type="text" placeholder="Tên người ấy..." name="ten"> <input type="submit" value="Cầu hôn" name="cauhon"> </form>';
} else {
$xxx=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'"));
if ($xxx[nguoiyeu]!=0) {
echo '<center>Hoa đã có chủ...!!!</center>';
} else {
if (isset($_POST[cauhon])) {
if ($datauser[xu]<100000) {
echo '<center>Bạn không đủ tiền để mua nhẫn!!</div></center>';
} else {
mysql_query("UPDATE `users` SET `xu`=`xu`-'100000' WHERE `id`='".$user_id."'");
mysql_query("INSERT INTO `kethon` SET `user_id`='".$user_id."',`dongy`='0',`nguoi_ay`='".$id."',`time`='".time()."'");
echo '<div class="lucifer"><center><font color="red">Đã gửi lời câu hôn, hãy đợi câu trả lời từ người ấy</font></center></div>';
}
}
echo '<div class="lucifer"><form method="post"><center><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label> <img src="/icon/tinhyeu.png"> <label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$xxx[name].'</b><br><img src="/avatar/'.$id.'.png" class="xavt"></label><br/><font color="blue">Lệ phí mua <img src="/icon/nhan.png"> là 100.000 xu, bạn có chắc chắn muốn cầu hôn?</font><br/><input type="submit" class="nut" name="cauhon" value="Cầu hôn"></center></form>';
}
}
echo '</div>';
break;
}
echo'<div>';
require('../incfiles/end.php');
?>