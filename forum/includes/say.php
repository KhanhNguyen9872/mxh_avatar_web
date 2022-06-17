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

/*
-----------------------------------------------------------------
Закрываем доступ для определенных ситуаций
-----------------------------------------------------------------
*/
if (!$id || !$user_id || isset($ban['1']) || isset($ban['11']) || (!core::$user_rights && $set['mod_forum'] == 3)) {
require('../incfiles/head.php');
echo functions::display_error($lng['access_forbidden']);
require('../incfiles/end.php');
exit;
}

/*
-----------------------------------------------------------------
Вспомогательная Функция обработки ссылок форума
-----------------------------------------------------------------
*/
if(!$is_mobile){$g = '<script>
CKEDITOR.replace( \'msg\', {
extraPlugins: \'bbcode\',
// Remove unused plugins.
removePlugins: \'bidi,dialogadvtab,div,filebrowser,flash,format,forms,horizontalrule,iframe,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates\',
// Width and height are not supported in the BBCode format, so object resizing is disabled.
disableObjectResizing: true,
// Define font sizes in percent values.
fontSize_sizes: "30/30%;50/50%;100/100%;120/120%;150/150%;200/200%;300/300%",
toolbar: [
[ \'Source\', \'-\', \'Save\', \'NewPage\', \'-\', \'Undo\', \'Redo\' ],
[ \'Find\', \'Replace\', \'-\', \'SelectAll\', \'RemoveFormat\' ],
[ \'Link\', \'Unlink\', \'Image\', \'Smiley\', \'SpecialChar\' ],
\'/\',
[ \'Bold\', \'Italic\', \'Underline\' ],
[ \'FontSize\' ],
[ \'TextColor\' ],
[ \'NumberedList\', \'BulletedList\', \'-\', \'Blockquote\' ],
[ \'Maximize\' ]
],
// Strip CKEditor smileys to those commonly used in BBCode.
smiley_images: [
\'regular_smile.gif\', \'sad_smile.gif\', \'wink_smile.gif\', \'teeth_smile.gif\', \'tounge_smile.gif\',
\'embarrassed_smile.gif\', \'omg_smile.gif\', \'whatchutalkingabout_smile.gif\', \'angel_smile.gif\', \'shades_smile.gif\',
\'cry_smile.gif\', \'kiss.gif\'
],
smiley_descriptions: [
\'smiley\', \'sad\', \'wink\', \'laugh\', \'cheeky\', \'blush\', \'surprise\',
\'indecision\', \'angel\', \'cool\', \'crying\', \'kiss\'
]
});

</script>';
}else{
$g='';
}
function forum_link($m)
{
global $set;
if (!isset($m[3])) {
return '[url=' . $m[1] . ']' . $m[2] . '[/url]';
} else {
$p = parse_url($m[3]);
if ('http://' . $p['host'] . $p['path'] . '?id=' == $set['homeurl'] . '/forum/index.php?id=') {
$thid = abs(intval(preg_replace('/(.*?)id=/si', '', $m[3])));
$req = mysql_query("SELECT `text` FROM `forum` WHERE `id`= '$thid' AND `type` = 't' AND `close` != '1'");
if (mysql_num_rows($req) > 0) {
$res = mysql_fetch_array($req);
$name = strtr($res['text'], array(
'&quot;' => '',
'&amp;'  => '',
'&lt;'   => '',
'&gt;'   => '',
'&#039;' => '',
'['      => '',
']'      => ''
));
if (mb_strlen($name) > 40)
$name = mb_substr($name, 0, 40) . '...';

return '[url=' . $m[3] . ']' . $name . '[/url]';
} else {
return $m[3];
}
} else
return $m[3];
}
}

// Проверка на флуд
$flood = functions::antiflood();
if ($flood) {
require('../incfiles/head.php');
echo'<b><center>Tiêu đề bài viết không được vượt quá 70 ký tự !<br/>
Tiêu đề bài viết không được sử dụng ký tự đặc biệt !<br/>
số ký tự phải lớn hơn 10 và tối đa là 100 . !</b><br/>
thời gian giữa 2 bài viết tối thiểu là 60 giây và giữa 2 comment là 20 giây<br/><a href="/forum/' . $id . '.html">Click để quay về diễn đàn !</a></center>';
require('../incfiles/end.php');
exit;
}

$headmod = 'forum,' . $id . ',1';
$agn1 = strtok($agn, ' ');
$type = mysql_query("SELECT * FROM `forum` WHERE `id` = '$id'");
$type1 = mysql_fetch_assoc($type);

switch ($type1['type']) {
case 't':
if (($type1['edit'] == 1 || $type1['close'] == 1) && $rights < 7) {
// Проверка, закрыта ли тема
require('../incfiles/head.php');
echo'<b><center>Tiêu đề bài viết không được vượt quá 70 ký tự !<br/>
Tiêu đề bài viết không được sử dụng ký tự đặc biệt !<br/>
số ký tự phải lớn hơn 10 và tối đa là 100 . !</b><br/>
thời gian giữa 2 bài viết tối thiểu là 60 giây và giữa 2 comment là 20 giây<br/><a href="/forum/' . $id . '.html">Click để quay về diễn đàn !</a></center>';
require('../incfiles/end.php');
exit;
}
$msg = isset($_POST['msg']) ? functions::checkin(trim($_POST['msg'])) : '';
if (isset($_POST['msgtrans']))
$msg = functions::trans($msg);
//Обрабатываем ссылки
$msg = preg_replace_callback('~\\[url=(http://.+?)\\](.+?)\\[/url\\]|(http://(www.)?[0-9a-zA-Z\.-]+\.[0-9a-zA-Z]{2,6}[0-9a-zA-Z/\?\.\~&amp;_=/%-:#]*)~', 'forum_link', $msg);
if (isset($_POST['submit'])
&& !empty($_POST['msg'])
&& isset($_POST['token'])
&& isset($_SESSION['token'])
&& $_POST['token'] == $_SESSION['token']
) {
// Проверяем на минимальную длину
if (mb_strlen($msg) < 4) {
require('../incfiles/head.php');
echo'<b><center>Tiêu đề bài viết không được vượt quá 70 ký tự !<br/>
Tiêu đề bài viết không được sử dụng ký tự đặc biệt !<br/>
số ký tự phải lớn hơn 10 và tối đa là 100 . !</b><br/>
thời gian giữa 2 bài viết tối thiểu là 60 giây và giữa 2 comment là 20 giây<br/><a href="/forum/' . $id . '.html">Click để quay về diễn đàn !</a></center>';
require('../incfiles/end.php');
exit;
}
// Проверяем, не повторяется ли сообщение?
$req = mysql_query("SELECT * FROM `forum` WHERE `user_id` = '$user_id' AND `type` = 'm' ORDER BY `time` DESC");
if (mysql_num_rows($req) > 0) {
$res = mysql_fetch_array($req);
if ($msg == $res['text']) {
require('../incfiles/head.php');
echo'<b><center>Tiêu đề bài viết không được vượt quá 70 ký tự !<br/>
Tiêu đề bài viết không được sử dụng ký tự đặc biệt !<br/>
số ký tự phải lớn hơn 10 và tối đa là 100 . !</b><br/>
thời gian giữa 2 bài viết tối thiểu là 60 giây và giữa 2 comment là 20 giây<br/><a href="/forum/' . $id . '.html">Click để quay về diễn đàn !</a></center>';
require('../incfiles/end.php');
exit;
}
}
// Удаляем фильтр, если он был
if (isset($_SESSION['fsort_id']) && $_SESSION['fsort_id'] == $id) {
unset($_SESSION['fsort_id']);
unset($_SESSION['fsort_users']);
}

unset($_SESSION['token']);

// Добавляем сообщение в базу


mysql_query("INSERT INTO `forum` SET
`refid` = '$id',
`type` = 'm' ,
`time` = '" . time() . "',
`user_id` = '$user_id',
`id_user`='".$type1['user_id']."',
`from` = '$login',
`ip` = '" . core::$ip . "',
`ip_via_proxy` = '" . core::$ip_via_proxy . "',
`soft` = '" . mysql_real_escape_string($agn1) . "',
`text` = '" . mysql_real_escape_string($msg) . "',
`edit` = '',
`curators` = ''
");
$fadd = mysql_insert_id();
$a=mysql_query("select * from `forum_theodoi` where `tid`='$id'")or die(mysql_error());
if(mysql_num_rows($a)){

while($b=mysql_fetch_array($a)){
if($b['uid']!=$user_id){
$m=mysql_query("select * from `thongbao` where `topic`='$id' and `ok`='1' and `user`='".$b['uid']."'")or die(mysql_error());
$dem=mysql_num_rows(mysql_query("select `id` from `forum` where `refid`='".$id."' and `id`<=$fadd "));
$p=CEIL($dem/$kmess);
if(mysql_num_rows($m)){
$n=mysql_fetch_array($m);
$ng=$n['lan']+1;
$text='<b>'.nick($user_id).'</b> <font color="black">và '.$ng.' nguời khác đã bình luận trong chủ đề mà bạn theo dõi</font> <a href="'.$home.'/forum/'.$id.'-p'.$p.'.html#'.$fadd.'"><font color="2c5170">'.$type1['text'].'</font></a>';
mysql_query("update `thongbao` set `text`='".mysql_real_escape_string($text)."',`lan`='$ng',`time`='".time()."'")or die(mysql_error());
} ///da co t.b
else{
$text='<b>'.nick($user_id).'</b> <font color="black">đã bình luận trong chủ đề mà bạn theo dõi</font> <a href="'.$home.'/forum/'.$id.'-p'.$p.'.html#'.$fadd.'"><font color="2c5170">'.$type1['text'].'</font></a>';
mysql_query("insert into `thongbao` set `user`='".$b['uid']."',`text`='".mysql_real_escape_string($text)."',`lan`='0',`ok`='1',`time`='".time()."'")or die(mysql_error());

} //chua co t.b
} ///tru ban than minh
} ///vong while

} //neu co nguoi theo doi

$count_users = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id` = '" . $type1['user_id'] . "'"), 0);
//Если юзер найден, ставим ему метку о новом ответе
if($count_users)
mysql_query("UPDATE `users` SET `journal_forum`=(`journal_forum`+1) WHERE `id` = '" . $type1['user_id'] . "'");
// Обновляем время топика
mysql_query("UPDATE `forum` SET
`time` = '" . time() . "'
WHERE `id` = '$id'
");
// Обновляем статистику юзера
mysql_query("UPDATE `users` SET
`postforum`='" . ($datauser['postforum'] + 1) . "',
`xu`='" . ($datauser['xu'] + 100) . "',
`lastpost` = '" . time() . "'
WHERE `id` = '$user_id'
");
// Вычисляем, на какую страницу попадает добавляемый пост
$page = $set_forum['upfp'] ? 1 : ceil(mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 'm' AND `refid` = '$id'" . ($rights >= 7 ? '' : " AND `close` != '1'")), 0) / $kmess);
if (isset($_POST['addfiles'])) {
header("Location: /upload/forum-$fadd.html");
} else {
header("Location: /forum/$id-p$page.html");
}


$msg_pre = functions::checkout($msg, 1, 1);
if ($set_user['smileys']) {
$msg_pre = functions::smileys($msg_pre, $datauser['rights'] ? 1 : 0);
}
$msg_pre = preg_replace('#\[c\](.*?)\[/c\]#si', '<div class="quote">\1</div>', $msg_pre);
echo '<div class="phdr">' . $type1['text'] . '</div>';
echo'<div class="phdrbox">';
if ($msg && !isset($_POST['submit'])) {
echo '<div class="list1">' . functions::display_user($datauser, array('iphide' => 1, 'header' => '<span class="gray">(' . functions::thoigian(time()) . ')</span>', 'body' => $msg_pre)) . '</div>';
}
echo '<form name="form" action="/forum/' . $id . '-binhluan.html" method="post"><div class="gmenu">';
echo '<textarea rows="' . $set_user['field_h'] . '" name="msg">' . (empty($_POST['msg']) ? '' : functions::checkout($msg)) . '</textarea></p>' .$g.
'<p><input type="checkbox" name="addfiles" value="1" ' . (isset($_POST['addfiles']) ? 'checked="checked" ' : '') . '/> ' . $lng_forum['add_file'];
if ($set_user['translit']) {
echo '<br /><input type="checkbox" name="msgtrans" value="1" ' . (isset($_POST['msgtrans']) ? 'checked="checked" ' : '') . '/> ' . $lng['translit'];
}
$token = mt_rand(1000, 100000);
$_SESSION['token'] = $token;
echo '</p><p>' .
'<input type="submit" name="submit" value="' . $lng['sent'] . '" style="width: 107px; cursor: pointer"/> ' .
($set_forum['preview'] ? '<input type="submit" value="' . $lng['preview'] . '" style="width: 107px; cursor: pointer"/>' : '') .
'<input type="hidden" name="token" value="' . $token . '"/>' .
'</p></div></form>';
}

echo '</div>';
break;

case 'm':

$th = $type1['refid'];
$th2 = mysql_query("SELECT * FROM `forum` WHERE `id` = '$th'");
$th1 = mysql_fetch_array($th2);
if (($th1['edit'] == 1 || $th1['close'] == 1) && $rights < 7) {
require('../incfiles/head.php');
echo functions::display_error($lng_forum['error_topic_closed'], '<a href="/forum/' . $th1['id'] . '.html">' . $lng['back'] . '</a>');
require('../incfiles/end.php');
exit;
}
if ($type1['user_id'] == $user_id) {
require('../incfiles/head.php');
echo functions::display_error('Нельзя отвечать на свое же сообщение', '<a href="/forum/' . $th1['id'] . '.html">' . $lng['back'] . '</a>');
require('../incfiles/end.php');
exit;
}
$shift = (core::$system_set['timeshift'] + core::$user_set['timeshift']) * 3600;
$vr = date("d.m.Y / H:i", $type1['time'] + $shift);
$msg = isset($_POST['msg']) ? functions::checkin(trim($_POST['msg'])) : '';
$txt = isset($_POST['txt']) ? intval($_POST['txt']) : FALSE;
if (isset($_POST['msgtrans'])) {
$msg = functions::trans($msg);
}
$to = $type1['from'];
if (!empty($_POST['citata'])) {
// Если была цитата, форматируем ее и обрабатываем
$citata = isset($_POST['citata']) ? trim($_POST['citata']) : '';
$citata = bbcode::notags($citata);
$citata = preg_replace('#\[c\](.*?)\[/c\]#si', '', $citata);
$citata = mb_substr($citata, 0, 200);
$tp = date("d.m.Y H:i", $type1['time']);
$msg = '[c][trichten][b]'.$type1['from'].'[/b][/trichten] [trichnd]' . $citata . '[/trichnd][/c]' . $msg;

} elseif (isset($_POST['txt'])) {
// Если был ответ, обрабатываем реплику
switch ($txt) {
case 2:
$repl = $type1['from'] . ', ' . $lng_forum['reply_1'] . ', ';
break;

case 3:
$repl = $type1['from'] . ', ' . $lng_forum['reply_2'] . ' ([url=' . $set['homeurl'] . '/forum/index.php?act=post&id=' . $type1['id'] . ']' . $vr . '[/url]) ' . $lng_forum['reply_3'] . ', ';
break;

case 4:
$repl = $type1['from'] . ', ' . $lng_forum['reply_4'] . ' ';
break;

default :
$repl = $type1['from'] . ', ';
}
$msg = $repl . ' ' . $msg;
}
//Обрабатываем ссылки
$msg = preg_replace_callback('~\\[url=(http://.+?)\\](.+?)\\[/url\\]|(http://(www.)?[0-9a-zA-Z\.-]+\.[0-9a-zA-Z]{2,6}[0-9a-zA-Z/\?\.\~&amp;_=/%-:#]*)~', 'forum_link', $msg);
if (isset($_POST['submit'])
&& isset($_POST['token'])
&& isset($_SESSION['token'])
&& $_POST['token'] == $_SESSION['token']
) {
if (empty($_POST['msg'])) {
require('../incfiles/head.php');
echo functions::display_error($lng['error_empty_message'], '<a href="/forum/' . $th . '-binhluan.html">' . $lng['repeat'] . '</a>');
require('../incfiles/end.php');
exit;
}
// Проверяем на минимальную длину
if (mb_strlen($msg) < 1) {
require('../incfiles/head.php');
echo functions::display_error($lng['error_message_short'], '<a href="index.php?id=' . $id . '">' . $lng['back'] . '</a>');
require('../incfiles/end.php');
exit;
}
// Проверяем, не повторяется ли сообщение?
$req = mysql_query("SELECT * FROM `forum` WHERE `user_id` = '$user_id' AND `type` = 'm' ORDER BY `time` DESC LIMIT 1");
if (mysql_num_rows($req) > 0) {
$res = mysql_fetch_array($req);
if ($msg == $res['text']) {
require('../incfiles/head.php');
echo functions::display_error($lng['error_message_exists'], '<a href="index.php?id=' . $th . '&amp;start=' . $start . '">' . $lng['back'] . '</a>');
require('../incfiles/end.php');
exit;
}
}
// Удаляем фильтр, если он был
if (isset($_SESSION['fsort_id']) && $_SESSION['fsort_id'] == $th) {
unset($_SESSION['fsort_id']);
unset($_SESSION['fsort_users']);
}

unset($_SESSION['token']);

// Добавляем сообщение в базу
mysql_query("INSERT INTO `forum` SET
`refid` = '$th',
`type` = 'm',
`time` = '" . time() . "',
`user_id` = '$user_id',
`id_user`='".$type1['user_id']."',
`from` = '$login',
`ip` = '" . core::$ip . "',
`ip_via_proxy` = '" . core::$ip_via_proxy . "',
`soft` = '" . mysql_real_escape_string($agn1) . "',
`text` = '" . mysql_real_escape_string($msg) . "',
`edit` = '',
`curators` = ''
");
$fadd = mysql_insert_id();
// Обновляем время топика
$count_users = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `id` = '" . $type1['user_id'] . "'"), 0);
//Если юзер найден, ставим ему метку о новом ответе
if($count_users)
mysql_query("UPDATE `users` SET `journal_forum`=(`journal_forum`+1) WHERE `id` = '" . $type1['user_id'] . "'");
mysql_query("UPDATE `forum`
SET `time` = '" . time() . "'
WHERE `id` = '$th'
");
// Обновляем статистику юзера
mysql_query("UPDATE `users` SET
`postforum`='" . ($datauser['postforum'] + 1) . "',
`xu`='" . ($datauser['xu'] + 100) . "',
`lastpost` = '" . time() . "'
WHERE `id` = '$user_id'
");
// Вычисляем, на какую страницу попадает добавляемый пост
$page = $set_forum['upfp'] ? 1 : ceil(mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 'm' AND `refid` = '$th'" . ($rights >= 7 ? '' : " AND `close` != '1'")), 0) / $kmess);

///////////mod thong bao
if (isset($_POST['submit']))
{
$thong=functions::check($_GET['id']);
$thongbao = mysql_query("SELECT * FROM `forum` WHERE `id` = '".$thong."'");
$thongbao1 = mysql_fetch_assoc($thongbao);
$bai = $thongbao1['refid'];
$us = nick($user_id);
$ten1 = mysql_query("SELECT * FROM `forum` WHERE `id` = '".$bai."'");
$ten2 = mysql_fetch_assoc($ten1);
$ten = $ten2['text'];
$text = '<b><font color="003366">'.$us.'</font></b><font color="000000"> Vừa trích <img src="/images/trichdan.png"></img> bài viết của bạn tại chủ đề </font><a href="/forum/'.$bai.'.html"><font color="003366">'.$ten.'</font></a>';
mysql_query("INSERT INTO `thongbao` SET
`id` = '".$user_id."',
`user` = '".$thongbao1['user_id']."',
`text` = '$text',
`ok` = '1',
`time` = '" . time() . "'
");
}
//////////////////

if (isset($_POST['addfiles'])) {
header("Location: /upload/forum-$fadd.html");
} else {
header("Location: /forum/$th-p$page.html");
}
} else {
$textl = 'Trích dẫn bạn ' . $type1['from'] . '';
$top = '' . $type1['text'] . '';
require('../incfiles/head.php');
$qt = " $type1[text]";
$msg_pre = functions::checkout($msg, 1, 1);
if ($set_user['smileys']) {
$msg_pre = functions::smileys($msg_pre, $datauser['rights'] ? 1 : 0);
}
$msg_pre = preg_replace('#\[c\](.*?)\[/c\]#si', '<div class="quote">\1</div>', $msg_pre);
echo '<div class="phdr">' . $th1['text'] . '</div>';
echo'<div class="phdrbox">';
$qt = str_replace("<br/>", "\r\n", $qt);
$qt = trim(preg_replace('#\[c\](.*?)\[/c\]#si', '', $qt));
$qt = functions::checkout($qt, 0, 2);
if (!empty($_POST['msg']) && !isset($_POST['submit'])) {
echo '<div class="list1">' . functions::display_user($datauser, array('iphide' => 1, 'header' => '<span class="gray">(' . functions::thoigian(time()) . ')</span>', 'body' => $msg_pre)) . '</div>';
}
echo '<form name="form" action="/forum/' . $id . '-binhluan.html" method="post"><div class="gmenu">';
if (isset($_GET['cyt'])) {
// Trích dẫn bài viết mod by Hoàng Anh
echo '<b><font color="red">Bạn đang trích dẫn bài viết của ' . $type1['from'] . '</font></b>' .
'<textarea rows="' . $set_user['field_h'] . '" name="citata">' . (empty($_POST['citata']) ? $qt : functions::checkout($_POST['citata'])) . '</textarea>';
} else {
// Форма с репликой
echo '<p><h3>' . $lng_forum['reference'] . '</h3>' .
'<input type="radio" value="0" ' . (!$txt ? 'checked="checked"' : '') . ' name="txt" />&#160;<b>' . $type1['from'] . '</b>,<br />' .
'<input type="radio" value="2" ' . ($txt == 2 ? 'checked="checked"' : '') . ' name="txt" />&#160;<b>' . $type1['from'] . '</b>, ' . $lng_forum['reply_1'] . ',<br />' .
'<input type="radio" value="3" ' . ($txt == 3 ? 'checked="checked"'
: '') . ' name="txt" />&#160;<b>' . $type1['from'] . '</b>, ' . $lng_forum['reply_2'] . ' (<a href="index.php?act=post&amp;id=' . $type1['id'] . '">' . $vr . '</a>) ' . $lng_forum['reply_3'] . ',<br />' .
'<input type="radio" value="4" ' . ($txt == 4 ? 'checked="checked"' : '') . ' name="txt" />&#160;<b>' . $type1['from'] . '</b>, ' . $lng_forum['reply_4'] . '</p>';
}

echo '<textarea rows="' . $set_user['field_h'] . '" name="msg">' . (empty($_POST['msg']) ? '' : functions::checkout($_POST['msg'])) . '</textarea></p>' .$g;
if ($set_user['translit']) {
echo '<br /><input type="checkbox" name="msgtrans" value="1" ' . (isset($_POST['msgtrans']) ? 'checked="checked" ' : '') . '/> ' . $lng['translit'];
}
$token = mt_rand(1000, 100000);
$_SESSION['token'] = $token;
echo '</p><p><input type="submit" name="submit" value="Gửi" style="width: 70px; cursor: pointer;"/> ' .
'<input type="hidden" name="token" value="' . $token . '"/>' .
'</p></div></form>';
}
echo'</div>';
break;

default:
require('../incfiles/head.php');
echo functions::display_error($lng_forum['error_topic_deleted'], '<a href="index.php">' . $lng['to_forum'] . '</a>');
require('../incfiles/end.php');
}
