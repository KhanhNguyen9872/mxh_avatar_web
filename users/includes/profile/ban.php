<?php

/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 2008-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

$headmod = 'userban';
$lng_ban = core::load_lng('ban');
require('../incfiles/head.php');
$ban = isset($_GET['ban']) ? intval($_GET['ban']) : 0;
switch ($mod) {
case 'do':
/*
-----------------------------------------------------------------
Hoang Anh
-----------------------------------------------------------------
*/
if ($rights < 1 || ($rights < 6 && $user['rights']) || ($rights <= $user['rights'])) {
echo functions::display_error($lng_ban['ban_rights']);
echo'<div class="list1">';
} else {
echo '<div class="phdr">Khóa Nick</div>';
echo '<div class="menu"><p>' . functions::display_user($user) . '</p>';
if (isset($_POST['submit'])) {
$error = false;
$term = isset($_POST['term']) ? intval($_POST['term']) : false;
$timeval = isset($_POST['timeval']) ? intval($_POST['timeval']) : false;
$time = isset($_POST['time']) ? intval($_POST['time']) : false;
$reason = !empty($_POST['reason']) ? trim($_POST['reason']) : '';
$banref = isset($_POST['banref']) ? intval($_POST['banref']) : false;
if (empty($reason) && empty($banref))
$reason = $lng_ban['reason_not_specified'];
if (empty($term) || empty($timeval) || empty($time) || $timeval < 1)
$error = $lng_ban['error_data'];
if ($rights == 1 && $term != 14 || $rights == 2 && $term != 12)
$error = $lng_ban['error_rights_section'];
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" . $user['id'] . "' AND `ban_time` > '" . time() . "' AND `ban_type` = '$term'"), 0))
$error = $lng_ban['error_ban_exist'];
switch ($time) {
case 2:
// Hoang Anh
if ($timeval > 24)
$timeval = 24;
$timeval = $timeval * 3600;
break;

case 3:
// Hoang Anh
if ($timeval > 30)
$timeval = 30;
$timeval = $timeval * 86400;
break;

case 4:
// Hoang Anh
$timeval = 315360000000;
break;

default:
// Hoang Anh
if ($timeval > 60)
$timeval = 60;
$timeval = $timeval * 60;
}
if ($datauser['rights'] < 6 && $timeval > 86400)
$timeval = 86400;
if ($datauser['rights'] < 7 && $timeval > 2592000)
$timeval = 2592000;
if (!$error) {
// Hoang Anh
$botban=''.$login.' vừa cho '.$user['name'].' ra Hawaii nghỉ mát với lý do '.$reason.'
Thời gian nghỉ mát là: '.($timeval/3600).' giờ';
$idtop='13931';
mysql_query("INSERT INTO `forum` SET
`refid` = '$idtop',
`type` = 'm' ,
`time` = '".time() ."',
`user_id` = '3',
`from` = 'BOT',
`ip` = '00000',
`browser` = '  johncmsvn.com',
`ip_via_proxy` = '".core::$ip_via_proxy."',
`soft` = '".mysql_real_escape_string($agn1) ."',
`text` = '".mysql_real_escape_string($botban) ."'
");
$fadd=mysql_insert_id();
mysql_query("UPDATE `forum` SET
`time` = '".time() ."'
WHERE `id` = '$idtop'
");
mysql_query("INSERT INTO `cms_ban_users` SET
`user_id` = '" . $user['id'] . "',
`ban_time` = '" . (time() + $timeval) . "',
`ban_while` = '" . time() . "',
`ban_type` = '$term',
`ban_who` = '$login',
`ban_reason` = '" . mysql_real_escape_string($reason) . "'
");
echo '<div class="menu"><center><b><font color="red">Khóa nick thành công ,thành viên bị khóa sẽ không thể vào lại diễn đàn khi chưa hết thời gian khóa !</font></a><br><a href="/"><font color="003366">Trở về diễn đàn</font></center></div>';
} else {
echo functions::display_error($error);
}
} else {
// Hoang Anh
echo '<form action="profile.php?act=ban&amp;mod=do&amp;user=' . $user['id'] . '" method="post">';
echo '<b><font color="red">Thời gian khóa nick</font></b><br>' .
'<input name="term" type="radio" value="1" checked="checked" />Khóa vào diễn đàn<br/>' .
'<input type="text" name="timeval" size="3" maxlength="2" value=""/> Thời gian<br/>' .
'<input name="time" type="radio" value="1" /> Phút<br />' .
'<input name="time" type="radio" value="2" checked="checked" /> Giờ<br />';
if ($rights >= 6)
echo '<input name="time" type="radio" value="3" /> Ngày<br />';
if ($rights >= 9)
echo '<input name="time" type="radio" value="4" /><b><span class="red"> Vô thời hạn</span></b>';
if (isset($_GET['fid'])) {
// Hoang Anh
$fid = intval($_GET['fid']);
echo '&#160;' . $lng_ban['infringement'] . ' <a href="' . $set['homeurl'] . '/forum/index.php?act=post&amp;id=' . $fid . '">' . $lng_ban['in_forum'] . '</a><br />' .
'<input type="hidden" value="' . $fid . '" name="banref" />';
}
echo '<textarea rows="' . $set_user['field_h'] . '" name="reason"></textarea><br/>' .
'<input type="submit" value="Khóa" name="submit" />' .
'</p></form>';
}
}
break;

case 'cancel':
/*
-----------------------------------------------------------------
Hoang Anh
-----------------------------------------------------------------
*/
if (!$ban || $user['id'] == $user_id || $rights < 7)
echo functions::display_error($lng['error_wrong_data']);
else {
$req = mysql_query("SELECT * FROM `cms_ban_users` WHERE `id` = '$ban' AND `user_id` = '" . $user['id'] . "'");
if (mysql_num_rows($req)) {
$res = mysql_fetch_assoc($req);
$error = false;
if ($res['ban_time'] < time())
$error = $lng_ban['error_ban_not_active'];
if (!$error) {
echo '<div class="phdr"><b>' . $lng_ban['ban_cancel'] . '</b></div>';
echo '<div class="menu"><p>' . functions::display_user($user) . '</p></div>';
if (isset($_POST['submit'])) {
mysql_query("UPDATE `cms_ban_users` SET `ban_time` = '" . time() . "' WHERE `id` = '$ban'");
echo '<div class="menu"><p><h3>' . $lng_ban['ban_cancel_confirmation'] . '</h3></p></div>';
} else {
echo '<form action="profile.php?act=ban&amp;mod=cancel&amp;user=' . $user['id'] . '&amp;ban=' . $ban . '" method="POST">' .
'<div class="menu"><p>' . $lng_ban['ban_cancel_help'] . '</p>' .
'<p><input type="submit" name="submit" value="' . $lng_ban['ban_cancel_do'] . '" /></p>' .
'</div></form>' .
'<div class="phdr"><a href="profile.php?act=ban&amp;user=' . $user['id'] . '">' . $lng['back'] . '</a></div>';
}
} else {
echo functions::display_error($error);
}
} else {
echo functions::display_error($lng['error_wrong_data']);
}
}
break;

case 'delete':
/*
-----------------------------------------------------------------
Hoang Anh
-----------------------------------------------------------------
*/
if (!$ban || $rights < 9)
echo functions::display_error($lng['error_wrong_data']);
else {
$req = mysql_query("SELECT * FROM `cms_ban_users` WHERE `id` = '$ban' AND `user_id` = '" . $user['id'] . "'");
if (mysql_num_rows($req)) {
$res = mysql_fetch_assoc($req);
echo '<div class="phdr"><b>' . $lng_ban['ban_delete'] . '</b></div>' .
'<div class="menu"><p>' . functions::display_user($user) . '</p></div>';
if (isset($_POST['submit'])) {
mysql_query("DELETE FROM `karma_users` WHERE `karma_user` = '" . $user['id'] . "' AND `user_id` = '0' AND `time` = '" . $res['ban_while'] . "' LIMIT 1");
$points = $set_karma['karma_points'] * 2;
mysql_query("UPDATE `users` SET
`karma_minus` = '" . ($user['karma_minus'] > $points ? $user['karma_minus'] - $points : 0) . "'
WHERE `id` = '" . $user['id'] . "'
");
mysql_query("DELETE FROM `cms_ban_users` WHERE `id` = '$ban'");
echo '<div class="menu"><p><h3>' . $lng_ban['ban_deleted'] . '</h3><a href="profile.php?act=ban&amp;user=' . $user['id'] . '">' . $lng['continue'] . '</a></p></div>';
} else {
echo '<form action="profile.php?act=ban&amp;mod=delete&amp;user=' . $user['id'] . '&amp;ban=' . $ban . '" method="POST">' .
'<div class="menu"><p>' . $lng_ban['ban_delete_help'] . '</p>' .
'<p><input type="submit" name="submit" value="' . $lng['delete'] . '" /></p>' .
'</div></form>' .
'<div class="phdr"><a href="profile.php?act=ban&amp;user=' . $user['id'] . '">' . $lng['back'] . '</a></div>';
}
} else {
echo functions::display_error($lng['error_wrong_data']);
}
}
break;

case 'delhist':
/*
-----------------------------------------------------------------
Hoang Anh
-----------------------------------------------------------------
*/
if ($rights == 9) {
echo '<div class="phdr"><b>' . $lng_ban['infringements_history'] . '</b></div>' .
'<div class="menu"><p>' . functions::display_user($user) . '</p></div>';
if (isset($_POST['submit'])) {
mysql_query("DELETE FROM `cms_ban_users` WHERE `user_id` = '" . $user['id'] . "'");
echo '<div class="menu"><center><b><font color="red">Thành viên đã được mở khóa, bạn nên cân nhắc thành viên về việc sai trái dẫn đến bị band !<font></b><br><a href="/">Trở về diễn đàn</a></center>';
} else {
echo '<form action="profile.php?act=ban&amp;mod=delhist&amp;user=' . $user['id'] . '" method="post">' .
'<div class="menu"><center><b><font color="red">Bạn chắc chắn bạn muốn mở khóa cho tài khoản này chứ , để tránh nhầm lẫn hãy kiểm tra xem đúng tài khoản muốn mở chưa rồi hẵng mở nhé</font></b></center>' .
'<center><input type="submit" value="Mở khóa" name="submit" /></center>' .
'</form>';
}
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" . $user['id'] . "'"), 0);
} else {
echo functions::display_error($lng_ban['error_rights_clear']);
}
break;

default:
/*
-----------------------------------------------------------------
Hoang Anh
-----------------------------------------------------------------
*/
echo '<div class="phdr"><a href="profile.php?user=' . $user['id'] . '"><b>' . $lng['profile'] . '</b></a> | ' . $lng_ban['infringements_history'] . '</div>';
// Hoang Anh
$menu = array();
if ($rights >= 6)
$menu[] = '<a href="../' . $set['admp'] . '/index.php?act=ban_panel">' . $lng_ban['ban_panel'] . '</a>';
if ($rights == 9)
$menu[] = '<a href="profile.php?act=ban&amp;mod=delhist&amp;user=' . $user['id'] . '">Mở tài khoản</a>';
if (!empty($menu))
echo '<div class="topmenu">' . functions::display_menu($menu) . '</div>';
if ($user['id'] != $user_id)
echo '<div class="menu"><p>' . functions::display_user($user) . '</p></div>';
else
echo '<div class="menu"><p>' . $lng_ban['my_infringements'] . '</p></div>';
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" . $user['id'] . "'"), 0);
if ($total) {
$req = mysql_query("SELECT * FROM `cms_ban_users` WHERE `user_id` = '" . $user['id'] . "' ORDER BY `ban_time` DESC LIMIT $start, $kmess");
$i = 0;
while ($res = mysql_fetch_assoc($req)) {
$remain = $res['ban_time'] - time();
$period = $res['ban_time'] - $res['ban_while'];
echo $i % 2 ? '<div class="menu">' : '<div class="menu">';
echo '<img src="../images/box.png" width="10" height="10" align="left" />&#160;' .
'<b>Tài khoản đã bị khóa</b>' .
'<br />' . functions::checkout($res['ban_reason']);
if ($rights > 0)
echo '<br/><span class="forumtext"><b>Người khóa :</b></span> ' . $res['ban_who'] . '<br />';
echo '<span class="forumtext"><b>Thời gian :</b></span> ' . ($period < 86400000
? functions::timecount($period) : $lng_ban['ban_time_before_cancel']);
if ($remain > 0)
echo '<br /><span class="forumtext"><b>Hết hạn :</b></span> ' . functions::timecount($remain);
}
} else {
echo '<div class="menu"><p>' . $lng['list_empty'] . '</p></div>';
}
if ($total > $kmess) {
echo '<p>' . functions::display_pagination('profile.php?act=ban&amp;user=' . $user['id'] . '&amp;page=', $start, $total, $kmess) . '</p>' .
'<p><form action="profile.php?act=ban&amp;user=' . $user['id'] . '" method="post">' .
'<input type="text" name="page" size="2"/>' .
'<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/></form></p></div>';
}
}

?>
