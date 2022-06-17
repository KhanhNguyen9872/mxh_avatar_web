<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Khu sân bay';
require('../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="phdr"><center>Sân bay</center></div>';
echo'</br><div class="lucifer"><center><img src="/icon/npc1.png"></center>';
echo '<div class="login"><center><font color="brown"><b> Xin chào quý khách đến với chuyến bay 1 đi không trở lại  <img src="/images/smileys/simply/3.png"></font></b></center></div>';
echo '<div class="menu"><img src="/icon/next.png">  <a href="/sanbay/hawaii/index.php"><b> Hawaii</b></a></div>';
echo '<div class="menu"><img src="/icon/next.png">  <a href="/sanbay/ngocrong/index.php"><b> Ngọc rồng</b></a></div>';
echo '<div class="menu"><img src="/icon/next.png"> <a href="/sanbay/khaithac.php?act=index">  <b> Khu khai thác</b></a> </div>';

require('../incfiles/end.php');
?>
                            