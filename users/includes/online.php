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
$headmod = 'online';
$textl = $lng['online'];
//$lng_online = core::load_lng('online');
require('../incfiles/head.php');

/*
-----------------------------------------------------------------
Mod online Hoàng Anh
-----------------------------------------------------------------
*/
$menu[] = !$mod ? '<b>' . $lng['users'] . '</b>' : '<a href="index.php?act=online">Đang online</a>';
if (core::$user_rights) {
$menu[] = $mod == 'ip' ? '<b>' . $lng['ip_activity'] . '</b>' : '<a href="index.php?act=online&amp;mod=ip">Ip hoạt động</a>';
}

echo '<div class="phdr">Đang trực tuyến</div>';

switch ($mod) {
case 'ip':
// Địa chỉ ip Hoàng Anh
$ip_array = array_count_values(core::$ip_count);
$total = count($ip_array);
if ($start >= $total) {
// Phân trang by Hoàng Anh
$start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
}
$end = $start + $kmess;
if ($end > $total) $end = $total;
arsort($ip_array);
$i = 0;
foreach ($ip_array as $key => $val) {
$ip_list[$i] = array($key => $val);
++$i;
}
if ($total && core::$user_rights) {
if ($total > $kmess) echo '<div class="omenu">' . functions::display_pagination('index.php?act=online&amp;page=mod=ip&amp;page=', $start, $total, $kmess) . '</div>';
for ($i = $start; $i < $end; $i++) {
$out = each($ip_list[$i]);
$ip = long2ip($out[0]);
if ($out[0] == core::$ip) echo '<div class="menu">';
else echo $i % 2 ? '<div class="menu">' : '<div class="menu">';
echo'[' . $out[1] . ']&#160;&#160;<a href="' . core::$system_set['homeurl'] . '/' . core::$system_set['admp'] . '/index.php?act=search_ip&amp;ip=' . $ip . '">' . $ip . '</a>';
echo '</div>';
}
if ($total > $kmess) {
echo '<div class="omenu">' . functions::display_pagination('index.php?act=online&amp;page=mod=ip&amp;page=', $start, $total, $kmess) . '</div>';
}
}
require_once('../incfiles/end.php');
exit;
break;

case 'guest':
// Lịch sử online by Hoàng Anh
$sql_total = "SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > " . (time() - 300);
$sql_list = "SELECT * FROM `cms_sessions` WHERE `lastdate` > " . (time() - 300) . " ORDER BY `movings` DESC LIMIT ";
break;

case 'history':
// Hiện thị on off Hoàng Anh
$sql_total = "SELECT COUNT(*) FROM `users` WHERE `lastdate` > " . (time() - 172800 . " AND `lastdate` < " . (time() - 310));
$sql_list = "SELECT * FROM `users` WHERE `lastdate` > " . (time() - 172800) . " AND `lastdate` < " . (time() - 310) . " ORDER BY `sestime` DESC LIMIT ";
break;

default:
// Hoàng Anh v2
$sql_total = "SELECT COUNT(*) FROM `users` WHERE `lastdate` > " . (time() - 300);
$sql_list = "SELECT * FROM `users` WHERE `lastdate` > " . (time() - 300) . " ORDER BY `name` ASC LIMIT ";
}

$total = mysql_result(mysql_query($sql_total), 0);
if ($start >= $total) {
// Phân trang dòng trên by Hoàng Anh
$start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
}

if ($total > $kmess) echo '<div class="omenu">' . functions::display_pagination('index.php?act=online&amp;page=' . ($mod ? 'mod=' . $mod . '&amp;page=' : ''), $start, $total, $kmess) . '</div>';
if ($total) {
$req = mysql_query($sql_list . "$start, $kmess");
$i = 0;
while (($res = mysql_fetch_assoc($req)) !== false) {
if ($res['id'] == core::$user_id) echo '<div class="forumtext">';
else echo $i % 2 ? '<div class="forumtext">' : '<div class="forumtext">';
$arg['stshide'] = 1;
$arg['header'] = ' <span class="gray">(';
if ($mod == 'history') $arg['header'] .= functions::display_date($res['sestime']);
else $arg['header'] .= $res['movings'] . ' - ' . functions::timecount(time() - $res['sestime']);
$arg['header'] .= ')</span><br /><img src="../images/box.png" />&#160;' . functions::display_place($res['id'], $res['place']);
echo functions::display_user($res, $arg);
echo '</div>';
++$i;
}
} else {
echo '<div class="menu"><div class="menu"><p>' . $lng['list_empty'] . '</p>';
}
echo'<div class="omenu">';
