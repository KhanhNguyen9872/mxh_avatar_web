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
$textl = $lng['administration'];
$headmod = "admlist";
require('../incfiles/head.php');

/*
-----------------------------------------------------------------
Выводим список администрации
-----------------------------------------------------------------
*/
echo '<div class="phdr"><a href="index.php"><b>' . $lng['community'] . '</b></a> | ' . $lng['administration'] . '</div>';
$req = mysql_query("SELECT COUNT(*) FROM `users` WHERE `rights` >= 1");
$total = mysql_result($req, 0);
$req = mysql_query("SELECT `id`, `name`, `sex`, `lastdate`, `datereg`, `status`, `rights`, `ip`, `browser`, `rights` FROM `users` WHERE `rights` >= 1 ORDER BY `rights` DESC LIMIT $start, $kmess");
for ($i = 0; $res = mysql_fetch_assoc($req); ++$i) {
    echo $i % 2 ? '<div class="menu">' : '<div class="menu">';
    echo functions::display_user($res) . '</div>';
}
echo '<div class="menu">' . $lng['total'] . ': ' . $total . '';
if ($total > $kmess) {
    echo '<p>' . functions::display_pagination('index.php?act=admlist&amp;page=', $start, $total, $kmess) . '</p>' .
        '<p><form action="index.php?act=admlist" method="post">' .
        '<input type="text" name="page" size="2"/>' .
        '<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/>' .
        '</form></p>';
}
echo'<p><a href="index.php?act=search">' . $lng['search_user'] . '</a><br />' .
    '<a href="index.php">' . $lng['back'] . '</a></p>';