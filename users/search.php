<?php

/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 2008-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/

define('_IN_JOHNCMS', 1);

$headmod = 'usersearch';
require('../incfiles/core.php');
$textl = $lng['search_user'];
require('../incfiles/head.php');

/*
-----------------------------------------------------------------
Принимаем данные, выводим форму поиска
-----------------------------------------------------------------
*/
$search_post = isset($_POST['search']) ? trim($_POST['search']) : false;
$search_get = isset($_GET['search']) ? rawurldecode(trim($_GET['search'])) : '';
$search = $search_post ? $search_post : $search_get;
echo '<div class="phdr"><a href="index.php"><b>' . $lng['community'] . '</b></a> | ' . $lng['search_user'] . '</div>' .
    '<form action="search.php" method="post">' .
    '<div class="gmenu"><p>' .
    '<input type="text" name="search" value="' . functions::checkout($search) . '" />' .
    '<input type="submit" value="' . $lng['search'] . '" name="submit" />' .
    '</p></div></form>';

/*
-----------------------------------------------------------------
Проверям на ошибки
-----------------------------------------------------------------
*/
$error = array();
if (!empty($search) && (mb_strlen($search) < 2 || mb_strlen($search) > 20))
    $error[] = $lng['nick'] . ': ' . $lng['error_wrong_lenght'];
if (preg_match("/[^1-9a-z\-\@\*\(\)\?\!\~\_\=\[\]]+/", functions::rus_lat(mb_strtolower($search))))
    $error[] = $lng['nick'] . ': ' . $lng['error_wrong_symbols'];
if ($search && !$error) {
    /*
    -----------------------------------------------------------------
    Выводим результаты поиска
    -----------------------------------------------------------------
    */
    $search_db = functions::rus_lat(mb_strtolower($search));
    $search_db = strtr($search_db, array (
        '_' => '\\_',
        '%' => '\\%'
    ));
    $search_db = '%' . $search_db . '%';
    $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `name_lat` LIKE '" . mysql_real_escape_string($search_db) . "'"), 0);
    echo '<div class="phdr"><b>' . $lng['search_results'] . '</b></div>';
    if ($total > $kmess)
        echo '<div class="topmenu">' . functions::display_pagination('search.php?search=' . urlencode($search) . '&amp;', $start, $total, $kmess) . '</div>';
    if ($total > 0) {
        $req = mysql_query("SELECT * FROM `users` WHERE `name_lat` LIKE '" . mysql_real_escape_string($search_db) . "' ORDER BY `name` ASC LIMIT $start, $kmess");
        $i = 0;
        while ($res = mysql_fetch_assoc($req)) {
            echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
            $res['name'] = mb_strlen($search) < 2 ? $res['name'] : preg_replace('|('.preg_quote($search, '/').')|siu','<span style="background-color: #FFFF33">$1</span>', $res['name']);
            echo functions::display_user($res);
            echo '</div>';
            ++$i;
        }
    } else {
        echo '<div class="menu"><p>' . $lng['search_results_empty'] . '</p></div>';
    }

    if ($total > $kmess) {
        echo '<div class="phdr">' . functions::display_pagination('search.php?search=' . urlencode($search) . '&amp;page=', $start, $total, $kmess) . '</div>';
    }
} else {
    if ($error)echo functions::display_error($error);
    
}


require('../incfiles/end.php');

?>