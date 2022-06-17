<?php
/*///////////////////////
//Hoàng Anh
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Bình luận bài đăng';
require('../incfiles/head.php');
include_once('func.php');
$id= intval(abs($_GET['id']));
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `id`='".$id."'"),0);
if($dem == 0) {
echo '<br/><div class="menu">Bài đăng không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$req = mysql_fetch_array(mysql_query("SELECT `sid` FROM `nhom_bd` WHERE `id`='$id'"));
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$req['sid']."'AND `user_id`='".$user_id."' AND `duyet`='1'") ,0);
$bl = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_bd` WHERE `id`='$id'"));
$nhom = nhom($bl['sid']);
if($kt == 0 && $nhom['set'] > 0) {
echo '<div class="list1">Phải là thành viên của nhóm!</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="phdr"><b>BÀI VIẾT</b></div>';
echo '<div class="list1"><a href="page.php?id='.$bl['sid'].'"><i class="fa fa-reply" aria-hidden="true"></i> Trở về nhóm</a></div>';
$text = $bl['text'];
echo '<div class="login" id="'.$bl['id'].'">'.ten_nick($bl['user_id'],1,$bl['sid']).'';

if($bl['type']==2) {
echo '<div class="nhom_img" align="center"><img src="files/anh_'.$bl['time'].'.jpg" alt="image" /></div>';
}
echo '<div style="margin-top:4px;"></div>' .bbcode::tags(functions::smileys($text)) . '';
echo '<br/><span style="font-size:11px;color:#777;"> (' . functions::thoigian($bl['time']) . ')</br>';
//Phan menu bai dang
$like = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='".$id."' AND `type`!='1'"),0);
$klike = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='".$id."' AND `user_id`='".$user_id."' AND `type`!='1'"),0);
$xoa = mysql_fetch_array(mysql_query("SELECT `rights` FROM `nhom_user` WHERE `id`='".$bl['sid']."' AND `user_id`='".$bl['user_id']."'"));
$xoa2 = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_user` WHERE `id`='".$bl['sid']."' AND `user_id`='".$user_id."'"));
echo''.($like> 0 ? '<a href="more.php?act=like&id='.$id.'"><img src="l.png" alt="l" />'.$like.'</a> · ':'').''.($klike == 0 ? '<a href="action.php?act=like&id='.$id.'"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Thích</a>':'<a href="action.php?act=dislike&id='.$id.'"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Bỏ thích</a>').''.($xoa2['rights']> $xoa['rights'] || $res['user_id'] == $user_id || $rights == 9 ? ' · <a href="action.php?act=del&id='.$id.'"><i class="fa fa-times-circle"></i> Xoá</a>':'').'<br/></span></div>';
//phan dang bai
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$bl['sid']."'AND `user_id`='".$user_id."' AND `duyet`='1'"),0);

echo '<div class="phdr"><b>Bình luận</b></div>';
if($kt>=1) {
$text = $_POST['text'];
if(isset($_POST['submit'])) {
if(empty($text)) {
echo 'Chưa nhập nội dung!';
} else if(strlen($text) > 5000) {
echo 'Nội dung quá dài. Tối đa 5000 kí tự!';
} else if(($datauser['lastpost'] + 10) > time()) {
echo '<div class="list1">Đợi <b>'.(($datauser['lastpost']+10) - time()).'s</b> nữa để đăng tiếp!</div>';
} else {
mysql_query("INSERT INTO `nhom_bd` SET `sid`='".$bl['sid']."', `cid`='".$id."', `user_id`='".$user_id."', `time`='".$time."', `stime`='".$time."', `text`='".mysql_real_escape_string($text)."', `type`='1'");
$rid = mysql_insert_id();
mysql_query("UPDATE `users` SET `lastpost`='$time' WHERE `id`='$user_id'");
mysql_query("UPDATE `nhom_bd` SET `stime`='$time' WHERE `id`='$id'");
echo '<div class="list1">Đăng thành công!</div>';
//gui thong bao
if($bl['type']==0)
$type= 2;
if($bl['type']==2)
$type= 3;

$dau = mysql_query("SELECT COUNT(*) `nhom_bd` WHERE `sid`='".$bl['sid']."' AND `cid`='".$id."' AND `user_id`='".$bl['user_id']."' AND `type`='1'");
//khi theard chua cmt
if($bl['user_id']!=$user_id && $dau==0) {
$kbd = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_tb` WHERE `id`='".$id."' AND `user_id`='".$user_id."' AND `fr_user`='".$bl['user_id']."' AND `type`='".$type."'"),0);
if($kbd==0) {
mysql_query("INSERT INTO `nhom_tb` SET `sid`='".$rid."', `id`='".$id."', `user_id`='".$user_id."', `time`='".$time."', `fr_user`='".$bl['user_id']."', `type`='".$type."'");
} else {
mysql_query("UPDATE `nhom_tb` SET `sid`='".$rid."', `time`='".$time."', `read`='0' WHERE `id`='".$id."' AND `user_id`='".$user_id."' AND `fr_user`='".$bl['user_id']."' AND `type`='".$type."'");
} }
//all nguoi comment
$list = mysql_query("SELECT DISTINCT `user_id` FROM `nhom_bd` WHERE `cid`='$id' AND `type`='1'");
while($tb=mysql_fetch_array($list)) {
if($tb['user_id']!=$user_id) {
$ktb = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_tb` WHERE `id`='".$id."' AND `user_id`='".$user_id."' AND `fr_user`='".$tb['user_id']."' AND `type`='".$type."'"),0);
if($ktb==0) {
mysql_query("INSERT INTO `nhom_tb` SET `sid`='".$rid."', `id`='".$id."', `user_id`='".$user_id."', `time`='".$time."', `fr_user`='".$tb['user_id']."', `type`='".$type."'");
} else {
mysql_query("UPDATE `nhom_tb` SET `sid`='".$rid."', `time`='".$time."', `read`='0' WHERE `id`='".$id."' AND `user_id`='".$user_id."' AND `fr_user`='".$tb['user_id']."' AND `type`='".$type."'");
}
}
} //het vong lap
}
}
echo '<form method="post"><div class="list1"><form name="shoutbox" id="shoutbox" action="/guestbook/index.php?act=say" method="post">'.bbcode::auto_bb('shoutbox', 'msg').'<div class="list1"><textarea name="text" cols="3" placeholder="Vui lòng viết tiếng việt có dấu để tôn trọng người đọc" class="form-control" style="border-left:2px solid #44B6AE !important;"></textarea></br><button name="submit"><i class="fa fa-pencil" aria-hidden="true"></i> Đăng</button></div></form>';
}
$tong =mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `cid`='$id' AND `type`='1'"),0);
if($tong) {
$req =mysql_query("SELECT * FROM `nhom_bd` WHERE `cid`='$id' AND `type`='1' ORDER BY `time` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
echo '<div class="omenu" id="'.$res['id'].'"><img src="/avatar/'.$res['user_id'].'.png" class="avatar_vina"/> '.ten_nick($res['user_id'],0,$bl['sid']).'';
echo '<div style="padding:4px 3px"> ' .bbcode::tags(functions::smileys($res['text'])) . '</div><br/>';
//Phan menu bai dang
$like = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='".$res['id']."' AND `type`='1'"),0);
$klike = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='".$res['id']."' AND `user_id`='".$user_id."' AND `type`='1'"),0);
$xoa = mysql_fetch_array(mysql_query("SELECT `rights` FROM `nhom_user` WHERE `id`='".$bl['sid']."' AND `user_id`='".$res['user_id']."'"));
$xoa2 = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_user` WHERE `id`='".$bl['sid']."' AND `user_id`='".$user_id."'"));
echo''.($like> 0 ? '<a href="more.php?act=like&id='.$res['id'].'"><img src="l.png" alt="l"/>'.$like.'</a> · ':'').''.($klike == 0 ? '<a href="action.php?act=like&id='.$res['id'].'">Thích</a>':'<a href="action.php?act=dislike&id='.$res['id'].'">Bỏ thích</a>').''.($xoa2['rights']> $xoa['rights'] || $res['user_id'] == $user_id || $rights == 9 ? ' · <a href="action.php?act=del&id='.$res['id'].'">Xoá</a>':'').'<br/><span style="font-size:11px;color:#777;"> (' . functions::thoigian($res['time']) . ')</span>';
echo '</div>';
}
if ($tong> $kmess){echo '<div class="list1">' . functions::display_pagination('cmt.php?id='.$id.'&page=', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Chưa có bình luận!</div>';
}

require('../incfiles/end.php');
?>