<?php
define('_IN_JOHNCMS',1);
require_once('../incfiles/core.php');
$textl='VI PHẠM';
require_once('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Vi phạm của bạn</div>';
$vipham = mysql_fetch_array(mysql_query("SELECT * FROM `cms_ban_users` WHERE `user_id`='" . $user_id. "'"));
$remain = $vipham['ban_time'] - time();
$period = $vipham['ban_time'] - $vipham['ban_while'];
$draan = $vipham['ban_while'] - time();
echo'<div class="list1">Đăng nhập không thành công !<br/>• Bạn bị khóa bởi : <b>'.$vipham['ban_who'].'</b><br/>• lý do bị khóa : '.$vipham['ban_reason'].'<br/>• Liên hệ Admin để biết thêm chi tiết<br/><center><a href="/exit.php">Trở lại đăng nhập</a></center></div>';
echo'</div>';
require_once('../incfiles/end.php');
?>