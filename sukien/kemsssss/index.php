<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Khu sự kiện';
require('../../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="phdr"><center>Khu Sự Kiện</center></div>';
echo'</br><center><img src="http://4rumvn.net/avatar/2.png"></center>';
echo '<div class="login"><center><font color="brown"><b>Mùa hè là mùa để ăn kem :3 <img src="/images/vatpham/45.png"><img src="http://i.imgur.com/vCGprNG.png"></font></b></center></div>';
/*echo'</br><center><img src="/icon/npc.png"></center>';*/
/*echo '<div class="login"><center><font color="brown"><b> Nơi đây tổ chức các sự kiện của 8vui.Top , cùng nhau vui chơi sự kiện và kiếm thật nhiều quà nhé   <img src="/icon/iconxoan/nhaymat.gif"></font></b></center></div>';*/
echo '<div class="menu"><img src="/icon/next.png"><a href="/sukien/kemsssss/hopqua-close.php"><font color="red"><b> Nhận quà </b></font></a></div>';
echo '<div class="menu"><img src="/icon/next.png"><a href="/sukien/kemsssss/sieuanhhung.php"><font color="red"><b> Đánh nhau với Boss</b></font></a></div>';
echo '<div class="menu"><img src="/icon/next.png"><a href="/farm/bangxephang.php"><b> Bảng xếp hạng </b></a></div>';
echo '</div><div><div>';
require('../../incfiles/end.php');
?>