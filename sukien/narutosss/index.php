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
echo'</br><center><b><font color="red">Kakashi</font></b></center><center><img src="/avatar/3.png"></center>';
echo '<div class="login"><center><font color="brown"><b>Mọi người hãy cùng nhau cố gắng để đạt được danh hiệu KAGE</font></b></center></div>';
/*echo'</br><center><img src="/icon/npc.png"></center>';*/
/*echo '<div class="login"><center><font color="brown"><b> Nơi đây tổ chức các sự kiện của 8vui.Top , cùng nhau vui chơi sự kiện và kiếm thật nhiều quà nhé   <img src="/icon/iconxoan/nhaymat.gif"></font></b></center></div>';*/
echo '<div class="menu"><img src="/icon/next.png"><a href="nhiemvu.php"><font color="red"><b> Làm nhiệm vụ Kakashi</b></a></font></div>';
echo '<div class="menu"><img src="/icon/next.png"><a href="doiexp.php"><font color="red"><b> Đổi Shuriken + Kunai</b></a></font></div>';
echo '<div class="menu"><img src="/icon/next.png"><a href="doiqua.php"><font color="red"><b> Đổi quà </b></font></a></div>';
echo '<div class="menu"><img src="/icon/next.png"><a href="boss.php"><font color="red"><b> Đánh nhau với Vĩ thú</b></font></a></div>';
echo '<div class="menu"><img src="/icon/next.png"><a href="bxh.php"><b> Bảng xếp hạng </b></a></div>';
echo '</div>';
require('../../incfiles/end.php');
?>