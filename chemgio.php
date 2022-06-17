<?php
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('incfiles/core.php');
if (!$user_id) {
exit;
}
if (isset($_POST['msg'])) {
$msg = isset($_POST['msg']) ? mb_substr(trim($_POST['msg']), 0, 15000) : '';
//$flood = functions::antiflood();
if ($ban['1'] || $ban['13'])
$error[] = $lng['access_forbidden'];
/*
if ($flood)
$error = $lng['error_flood'] . ' ' . $flood . '&#160;' . $lng['seconds'];
if (!$error) {
$req = mysql_query("SELECT * FROM `guest` WHERE `user_id` = '$user_id' ORDER BY `time` DESC");
$res = mysql_fetch_array($req);
if ($res['text'] == $msg) {
exit;
}
}
*/
if (!$error) { 
//--BOT AUTO--//
include_once 'quicklink.php';
include_once 'bot.php';
include_once 'del.php';
include_once 'simsimi.php'; 
include_once 'thayphan.php';
include_once 'botavatar.php';
mysql_query("INSERT INTO `guest` SET
`adm` = '$admset',
`time` = '" . time() . "',
`user_id` = '$user_id',
`name` = '$from',
`text` = '" . mysql_real_escape_string($msg) . "',
`ip` = '" . core::$ip . "',
`browser` = '" . mysql_real_escape_string($agn) . "'
");

if ($user_id) {
$postguest = $datauser['postguest'] + 1;
mysql_query("UPDATE `users` SET `postguest` = '$postguest', `lastpost` = '" . time() . "' WHERE `id` = '$user_id'");
}
}
}
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM `guest`"), 0);
if($tong) {
$req = mysql_query("SELECT `guest`.*, `guest`.`id` AS `gid`, `users`.`lastdate`, `users`.`id`, `users`.`rights`, `users`.`name`
FROM `guest` LEFT JOIN `users` ON `guest`.`user_id` = `users`.`id`
WHERE `guest`.`adm`='0' ORDER BY `time` DESC LIMIT $start, 6");
while ($gres = mysql_fetch_assoc($req)) {
$post = $gres['text'];
if(strlen($post) > 160) {
$post = substr($post, 0, 160).'....';
}
$post = functions::checkout($gres['text'], 1, 1);
if ($set_user['smileys'])
$post = functions::smileys($post, $gres['rights'] ? 1 : 0);
$ban = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `chanchat`='1' AND `id` = '".$gres['id']."'"));
if (!$ban)
{
echo'<div class="forumtext">';
echo'<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tr><td width="60px;" class="blog-avatar">';
if ($gres['id'] == 908)
{
echo '<img class="avatarforum" src="/images/gavang.png" width="45" height="48" alt="'.$gres['name'].'"/>';
}
else
{
echo '<img class="avatarforum" src="/avatar/'.$gres['id'].'.png" width="45" height="48" alt="'.$gres['name'].'"/>';
}
echo'</td><td style="vertical-align: bottom;"><table cellpadding="0"  cellspacing="0"><tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left">';
echo'<img src="/giaodien/images/left-blog.png"></div>';
echo (time() > $gres['lastdate'] + 300 ? ' <img style="vertical-align:middle;" title="' . $res['from'] . ' is offline" src="/images/off.png" alt="offline"/> ' : '<img style="vertical-align:middle;" title="' . $res['from'] . ' is online" src="/images/on.png" alt="online"/> ');
echo'<a href="/member/'.$gres['id'].'.html"><b><font color="003366">'.nick($gres['id']).'</font></b></a>';
echo'<div class="text">';
echo''.$post.'<br/><br/>';
echo '<span style="font-size:11px;color:#777;float:right"> (' . functions::thoigian($gres['time']) . ')</span>';
echo'</div></div></td></tr></tbody></table></td></tr></tbody></table>';
echo'</div>';
++$i;
}
}
} else {
echo '<div class="menu"><p>' . $lng['guestbook_empty'] . '</p></div>';
}

?>