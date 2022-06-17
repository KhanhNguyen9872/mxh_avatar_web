<?php
define('_IN_JOHNCMS', 1);
$headmod = 'khusinhthai';

$textl = 'Bảng xếp hạng câu cá';

echo'<div class="main-xmenu">';
echo '<div class="login"></font><div class="lucifer">';
echo'<div class="danhmuc">Top câu cá</div>';
echo'<div class="menu list-bottom congdong"><img src="'.$home.'/icon/user.png" alt="icon" style="vertical-align: -3px;"/> Xu: '.$datauser[xu].' - Câu được: '.$datauser[soca].' con cá </div>'; 
$tongso = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `soca` > '0'"), 0);
$req = mysql_query("SELECT * FROM `users` WHERE `soca` > '0' ORDER BY `soca` DESC LIMIT $start, $kmess");
while ($res = mysql_fetch_array($req)) {
echo '<div class="menu list-bottom"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/member/'.$res['id'].'.html"><b>'.nick($res['id']).'</b></a><br/>
Câu được: '.$res['soca'].' con cá<br/><br/></div>';
}
if ($tongso > $kmess) {

}
echo'</div>';

?>