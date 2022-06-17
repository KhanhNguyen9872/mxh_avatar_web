<?php
define('_IN_JOHNCMS', 1);
require('../../incfiles/core.php');
$textl = 'Bảng xếp hạng Level Ninja';
require('../../incfiles/head.php');
echo '<div class="phdr">Bảng xếp hạng Level Ninja</div>';
$req=mysql_query("SELECT * FROM `users` WHERE `naruto`>=0 AND `rights`!=9 ORDER BY `naruto` DESC LIMIT 0,10");
while ($res = mysql_fetch_array($req)) {
echo '<div class="danhsach phancach"><img src="'.$home.'/avatar/'.$res['id'].'.png" alt="'. $user['name'] . '" class="avatar_vina"/>
<a href="/member/'.$res['id'].'.html"><b>'.nick($res['id']).'</b></a><br/>
Level: '.$res['naruto'].' Exp<br/><br/></div>';
}
require('../../incfiles/end.php');
?>