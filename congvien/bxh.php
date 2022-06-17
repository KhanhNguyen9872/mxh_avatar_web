<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Bảng xếp hạng';
require('../incfiles/head.php');
echo '<div class="mainblok">';
echo '<div class="login"><details><summary><font color="red"><b>Thông tin chi tiết về BXH Lượng</b></font></summary> <b><center><font color="red">top 1:<img src="/images/shopicon/xephang1.gif"><br/><font color="red">top 2:</font><img src="/images/shopicon/xephang2.gif"><br/><font color="red">top 3:<img src="/images/shopicon/xephang3.gif"></font></b></center></br></details></font></div>';
echo '<div class="phdr">Bảng xếp hạng lượng</div>';
$req=mysql_query("SELECT * FROM `users` WHERE `vnd`>=0 AND `rights`!=9 ORDER BY `vnd` DESC LIMIT 0,5");
while ($res = mysql_fetch_array($req)) {
echo '<div class="danhsach phancach"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/member/'.$res['id'].'.html"><b>'.nick($res['id']).'</b></a><br/>
Tiền: '.$res['vnd'].' Lượng<br/><br/></div>';
}
echo '<div class="phdr">Bảng xếp hạng xu</div>';
$req=mysql_query("SELECT * FROM `users` WHERE `xu`>=0 AND `rights`!=9 ORDER BY `xu` DESC LIMIT 0,5");
while ($res = mysql_fetch_array($req)) {
echo '<div class="danhsach phancach"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/member/'.$res['id'].'.html"><b>'.nick($res['id']).'</b></a><br/>
Tiền: '.$res['xu'].' xu<br/><br/></div>';
}
echo '<div class="phdr">Bảng xếp hạng HP</div>';
$req=mysql_query("SELECT *, (hpfull+hpthem) as fullhp FROM `users` WHERE `rights`!=9 ORDER BY `fullhp` DESC LIMIT 0,5");
while ($res = mysql_fetch_array($req)) {
echo '<div class="danhsach phancach"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/member/'.$res['id'].'.html"><b>'.nick($res['id']).'</b></a><br/>
Máu: '.$res['fullhp'].' HP<br/><br/></div>';
}
echo '<div class="phdr">Bảng xếp hạng sức mạnh</div>';
$req=mysql_query("SELECT *, (sucmanh+smthem) as fullsm FROM `users` WHERE `rights`!=9 ORDER BY `fullsm` DESC LIMIT 0,5");
while ($res = mysql_fetch_array($req)) {
echo '<div class="danhsach phancach"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/member/'.$res['id'].'.html"><b>'.nick($res['id']).'</b></a><br/>
Sức mạnh: '.$res['fullsm'].' SM<br/><br/></div>';
}
echo '</div>';
require('../incfiles/end.php');
?>