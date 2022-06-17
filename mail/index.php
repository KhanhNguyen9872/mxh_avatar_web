<?php

/**
* @developer     ID Thiên Ân
* @link       fb.com/idthienan
* @copyright   Copyright (C) 20019-2020 ID Thiên Ân

*/

define('_IN_JOHNCMS', 1);

require_once('../incfiles/core.php');
// Проверяем права доступа

$headmod = 'mail';
$lng_mail = core::load_lng('mail');
if (isset($_SESSION['ref']))
unset($_SESSION['ref']);

//Проверка авторизации
if (!$user_id) {
Header('Location: ' . $home . '/?err');
exit;
}

function formatsize($size)
{
// Форматирование размера файлов
if ($size >= 1073741824) {
$size = round($size / 1073741824 * 100) / 100 . ' Gb';
} elseif ($size >= 1048576) {
$size = round($size / 1048576 * 100) / 100 . ' Mb';
} elseif ($size >= 1024) {
$size = round($size / 1024 * 100) / 100 . ' Kb';
} else {
$size = $size . ' b';
}

return $size;
}

// Массив подключаемых функций
$mods = array(
'ignor',
'write',
'systems',
'deluser',
'load',
'files',
'input',
'output',
'delete',
'new'
);

//Проверка выбора функции
if ($act && ($key = array_search($act, $mods)) !== FALSE && file_exists('includes/' . $mods[$key] . '.php')) {
require('includes/' . $mods[$key] . '.php');
} else {
$textl = $lng['mail'];
require_once('../incfiles/head.php');

echo '<div class="phdr"><b>' . $lng_mail['contacts'] . '</b></div>';

if ($id) {
$req = mysql_query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1;");
if (mysql_num_rows($req) == 0) {
echo functions::display_error($lng['error_user_not_exist']);
require_once("../incfiles/end.php");
exit;
}

$res = mysql_fetch_assoc($req);

if ($id == $user_id) {
echo '<div class="rmenu">' . $lng_mail['impossible_add_contact'] . '</div>';
} else {
//Добавляем в заблокированные
if (isset($_POST['submit'])) {
$q = mysql_query("SELECT * FROM `cms_contact`
WHERE `user_id`='" . $user_id . "' AND `from_id`='" . $id . "';");
if (mysql_num_rows($q) == 0) {
mysql_query("INSERT INTO `cms_contact` SET
`user_id` = '" . $user_id . "',
`from_id` = '" . $id . "',
`time` = '" . time() . "';");
}
echo '<div class="omenu">' . $lng_mail['add_contact'] . '</div>';
} else {
echo '<div class="gmenu"><form action="index.php?id=' . $id . '&amp;add" method="post"><div>
' . $lng_mail['really_add_contact'] . '<br />
<input type="submit" name="submit" value="' . $lng['add'] . '"/>
</div></form></div>';
}
}
} else {
echo'<div class="omenu"><b>' . $lng_mail['my_contacts'] . '</b> | <a href="index.php?act=ignor">' . $lng_mail['blocklist'] . '</a></div>';
//Получаем список контактов
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_contact` WHERE `user_id`='" . $user_id . "' AND `ban`!='1'"), 0);
if ($total) {
if ($total > $kmess) echo '<div class="phdr">' . functions::display_pagination('index.php?page=', $start, $total, $kmess) . '</div>';
$req = mysql_query("SELECT `users`.* FROM `cms_contact`
LEFT JOIN `users` ON `cms_contact`.`from_id`=`users`.`id`
WHERE `cms_contact`.`user_id`='" . $user_id . "'
AND `cms_contact`.`ban`!='1'
ORDER BY `users`.`name` ASC
LIMIT $start, $kmess"
);

for ($i = 0; ($row = mysql_fetch_assoc($req)) !== FALSE; ++$i) {
echo $i % 2 ? '<div class="omenu">' : '<div class="omenu">';
$subtext = '<a href="index.php?act=write&amp;id=' . $row['id'] . '">' . $lng_mail['correspondence'] . '</a> | <a href="index.php?act=deluser&amp;id=' . $row['id'] . '">' . $lng['delete'] . '</a> | <a href="index.php?act=ignor&amp;id=' . $row['id'] . '&amp;add">' . $lng_mail['ban_contact'] . '</a>';
$count_message = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` WHERE ((`user_id`='{$row['id']}' AND `from_id`='$user_id') OR (`user_id`='$user_id' AND `from_id`='{$row['id']}')) AND `sys`!='1' AND `spam`!='1' AND `delete`!='$user_id';"), 0);
$new_count_message = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` WHERE `cms_mail`.`user_id`='{$row['id']}' AND `cms_mail`.`from_id`='$user_id' AND `read`='0' AND `sys`!='1' AND `spam`!='1' AND `delete`!='$user_id';"), 0);
$arg = array(
'header' => '(' . $count_message . ($new_count_message ? '/<span class="red">+' . $new_count_message . '</span>' : '') . ')',
'sub'    => $subtext
);
echo functions::display_user($row, $arg);
echo '</div>';
}
} else {
echo '<div class="menu"><p>' . $lng['list_empty'] . '</p></div>';
}

echo '<div class="omenu">' . $lng['total'] . ': ' . $total . '</div>';
if ($total > $kmess) {
echo '<div class="phdr">' . functions::display_pagination('index.php?page=', $start, $total, $kmess) . '</div>';
echo '<p><form action="index.php" method="get">
<input type="text" name="page" size="2"/>
<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/></form></p>';
}
echo '<p><a href="../users/profile.php?act=office">' . $lng['personal'] . '</a></p>';
}
}
echo'<div><div>';
require_once('../incfiles/end.php');
