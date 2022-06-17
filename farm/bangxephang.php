<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
require_once('../incfiles/func.php');
$textl = 'Bảng xếp hạng';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo'<div class="phdr"><a href="index.php">Nông trại vui vẻ</a> | Phú nông Tuần </a></div>';
echo'<div class="da">';
if($user_id){
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `fermer_oput`"), 0);
$req = mysql_query("SELECT * FROM `users` WHERE `fermer_oput`>'0' ORDER BY `fermer_oput` DESC LIMIT $start, $kmess");
while ($danhsach = mysql_fetch_assoc($req)){
echo'<div class="lucifer"><div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr class="menu_top_baiviet"><td style="vertical-align: top;">';
echo'<img src="'.$home.'/avatar/'.$danhsach[id].'.png" alt="'. $user['name']. '"/>';
echo'&#160;</td><td>';
echo'<a href="/account/'.$danhsach[id].'"><b>'.nick($danhsach[id]).'</b></a><br/>';
echo'Xu: '.$danhsach[xu].'<br/>';
if ($danhsach[id] == $user_id) {
} else {
echo'<a href="/farm/account.php?id='.$danhsach[id].'">Ăn trộm</div>';
}
echo'</td></tr></table></div></div>';
}
}else{
header('Location: '.$home.'');
}
if ($tong > $kmess){
echo '<div><div><div><div class="topmenu">' . functions::display_pagination('/farm/bangxephang.php?', $start, $tong, $kmess) . '</div>';
}
echo'</div></div>';











require('../incfiles/end.php');
?>
                            
                            