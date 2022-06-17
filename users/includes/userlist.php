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
$textl = $lng['users_list'];
$headmod = 'userlist';
require('../incfiles/head.php');

/*
-----------------------------------------------------------------
Выводим список пользователей
-----------------------------------------------------------------
*/
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users`"), 0);
echo '<div class="phdr"><a href="index.php"><b>' . $lng['community'] . '</b></a> | ' . $lng['users_list'] . '</div>';
echo'<form action="/users/search.php" method="post"><div class="gmenu"><p><input type="text" name="search" value="" /><input type="submit" value="Tìm kiếm" name="submit" /></p></div></form>';
if ($total > $kmess)
echo '<div class="omenu">' . functions::display_pagination('index.php?act=userlist&amp;page=', $start, $total, $kmess) . '</div>';
$req = mysql_query("SELECT `id`, `name`, `sex`, `lastdate`, `datereg`, `status`, `rights`, `ip`, `browser`, `rights` FROM `users` WHERE `preg` = 1 ORDER BY `datereg` DESC LIMIT $start, $kmess");
for($i = 0; ($res = mysql_fetch_assoc($req)) !== false; $i++){
    echo $i % 2 ? '<div class="menu">' : '<div class="menu">';
    echo functions::display_user($res) . '</div>';
}
echo '<div class="menu">' . $lng['total'] . ': ' . $total . '';
if ($total > $kmess) {
    echo '<div class="omenu">' . functions::display_pagination('index.php?act=userlist&amp;page=', $start, $total, $kmess) . '</div>';
}

?>