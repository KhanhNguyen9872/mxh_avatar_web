<?php
define('_IN_JOHNCMS', 1);
$headmod = 'users';
require ('../incfiles/core.php');
$textl = 'Bảng xếp hạng đấu trường';
require ('../incfiles/head.php');

echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Top đấu trường</div>';
echo'<div class="menu list-bottom congdong"><img src="'.$home.'/icon/user.png" alt="icon" style="vertical-align: -3px;"/> - Thắng: '.$thongtinnhanvat[win].' trận/Thua: '.$thongtinnhanvat[lose].' trận</div>'; 
$tongso = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhanvat` WHERE `win` > '0'"), 0);
$req = mysql_query("SELECT * FROM `nhanvat` WHERE `win` > '0' ORDER BY `win` DESC LIMIT $start, $kmess");
while ($res = mysql_fetch_array($req)) {
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$res['user_id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/account/'.$res['id'].'"><b>'.nick($res['id']).'</b></a><br/>
Thắng: '.$res['win'].' trận<br> Thua: '.$res['lose'].' trận</div>';
}
if ($tongso > $kmess) {
echo '<div class="menu">' . functions::display_pagination('/boss/bxh.php?', $start, $tongso, $kmess) . '</div>';
}
echo'</div>';
require ('../incfiles/end.php');