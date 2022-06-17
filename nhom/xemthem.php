<?php
/*///////////////////////
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Bài đăng nhóm';
require('../incfiles/head.php');
include_once('func.php');
echo '<div class="mainblok"><div class="phdr"><b>Bài đăng nhóm</b></div><div class="menunhom">';
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `type`!='1'"),0);
if($dem) {
$req = mysql_query("SELECT * FROM `nhom_bd` WHERE `type`!='1' ORDER BY `time` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
$ten_nhom = mysql_fetch_array(mysql_query("SELECT * FROM `nhom` WHERE `id`='".$res['sid']."'"));
echo '<div class="omenu">'.ten_nick($res['user_id'],$res['sid']).' <span class="xam">đã đăng tại</span> <a href="/nhom/page.php?id='.$res['sid'].'">'.$ten_nhom['name'].'</a><br/>';
if($res['type'] == 2) {
echo '<div class="nhom_img" align="center"><a href="/nhom/cmt.php?id='.$res['id'].'"><img src="/nhom/files/anh_'.$res['time'].'.jpg" alt="image" /></a></div>';
}
echo thugon($res['text'],$res['id']);
echo '<br/><span class="xam">'.thoigian($res['time']).'</span><br/>';
//Phan menu bai dang
$like = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='".$res['id']."' AND `type`!='1'"),0);
$klike = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='".$res['id']."' AND `user_id`='".$user_id."' AND `type`!='1'"),0);
$bl = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `cid`='".$res['id']."' AND `type`='1'"),0);
$xoa = mysql_fetch_array(mysql_query("SELECT `rights` FROM `nhom_user` WHERE `id`='".$id."' AND `user_id`='".$res['user_id']."'"));
$xoa2 = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_user` WHERE `id`='".$id."' AND `user_id`='".$user_id."'"));
echo''.($user_id ? ''.($like> 0 ? '<a href="/nhom/more.php?act=like&id='.$res['id'].'"><img src="/nhom/img/l.png" alt="l"/>'.$like.'</a>·':'').''.($klike == 0 ? '<a href="/nhom/action.php?act=like&id='.$res['id'].'">Thích</a>':'<a href="/nhom/action.php?act=dislike&id='.$res['id'].'">Bỏ thích</a>').' · <a href="/nhom/cmt.php?id='.$res['id'].'">Bình luận ('.$bl.')</a>':'').'';
echo '</div>';
}
} else {
echo '<div class="ts2q" align="center">Chưa có bài đăng!</div>';
}
if ($dem> $kmess){echo '<div class="phantrang">' . functions::display_pagination('xemthem.php?', $start, $dem, $kmess) . '</div>';
}
echo '</div></div>';
require('../incfiles/end.php');
?>
