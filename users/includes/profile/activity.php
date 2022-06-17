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
История активности
-----------------------------------------------------------------
*/
$textl = 'Thông tin bài viết của ' . htmlspecialchars($user['name']) . '';
require('../incfiles/head.php');


switch ($mod) {
    case 'comments':
        /*
        -----------------------------------------------------------------
        Thông tin bài viết by Hoàng Anh
        -----------------------------------------------------------------
        */
        $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `guest` WHERE `user_id` = '" . $user['id'] . "'" . ($rights >= 1 ? '' : " AND `adm` = '0'")), 0);
        echo '<div class="phdr"><b>' . $lng['comments'] . '</b></div>';
        if ($total > $kmess) echo '<div class="omenu">' . functions::display_pagination('profile.php?act=activity&amp;mod=comments&amp;user='. $user['id'].'&amp;page=&amp;', $start, $total, $kmess) . '</div>';
        $req = mysql_query("SELECT * FROM `guest` WHERE `user_id` = '" . $user['id'] . "'" . ($rights >= 1 ? '' : " AND `adm` = '0'") . " ORDER BY `id` DESC LIMIT $start, $kmess");
        if (mysql_num_rows($req)) {
            $i = 0;
            while ($res = mysql_fetch_assoc($req)) {
                echo ($i % 2 ? '<div class="list1">' : '<div class="list1">') . functions::checkout($res['text'], 2, 1) . '' .
                     '<span class="gray">(' . functions::thoigian($res['time']) . ')</span>' .
                     '</div>';
                ++$i;
            }
        } else {
            echo '<div class="menu"><p>' . $lng_profile['guest_empty'] . '</p></div>';
        }
        break;

    case 'topic':
        /*
        -----------------------------------------------------------------
        Список тем Форума
        -----------------------------------------------------------------
        */
        $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `user_id` = '" . $user['id'] . "' AND `type` = 't'" . ($rights >= 6 ? '' : " AND `close`!='1' AND `topan` !='1'")), 0);
        echo '<div class="phdr"><b>' . $lng['forum'] . '</b>: ' . $lng['themes'] . '</div>';
        echo'<div class="phdrbox">';
        if ($total > $kmess) echo '<div class="omenu">' . functions::display_pagination('profile.php?act=activity&amp;mod=topic&amp;user='. $user['id'].'&amp;page=', $start, $total, $kmess) . '</div>';
        $req = mysql_query("SELECT * FROM `forum` WHERE `user_id` = '" . $user['id'] . "' AND `type` = 't'" . ($rights >= 6 ? '' : " AND `close`!='1' AND `topan` !='1'") . " ORDER BY `id` DESC LIMIT $start, $kmess");
        if (mysql_num_rows($req)) {
            $i = 0;
            while ($res = mysql_fetch_assoc($req)) {
                $post = mysql_fetch_assoc(mysql_query("SELECT * FROM `forum` WHERE `refid` = '" . $res['id'] . "'" . ($rights >= 6 ? '' : " AND `close`!='1' AND `topan` !='1'") . " ORDER BY `id` ASC LIMIT 1"));
                $section = mysql_fetch_assoc(mysql_query("SELECT * FROM `forum` WHERE `id` = '" . $res['refid'] . "'"));
                $category = mysql_fetch_assoc(mysql_query("SELECT * FROM `forum` WHERE `id` = '" . $section['refid'] . "'"));
                $text = mb_substr($post['text'], 0, 5000);
                $text = functions::checkout($text, 2, 1);
                echo ($i % 2 ? '<div class="list1">' : '<div class="list1">') .
                     '<a href="' . $set['homeurl'] . '/forum/' . $res['id'] . '.html"><b><font color="003366">' .bbcode::tags(functions::smileys($res['text'])) . '</font></b></a>' .
                     '<br />' . $text . '...<span class="gray">(' . functions::thoigian($res['time']) . ')</span>' .
                     '</div>';
                ++$i;
            }
        } else {
            echo '<div class="menu"><p>' . $lng['list_empty'] . '</p></div>';
        }
        break;

    default:
        /*
        -----------------------------------------------------------------
        Список постов Форума
        -----------------------------------------------------------------
        */
        $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `user_id` = '" . $user['id'] . "' AND `type` = 'm'" . ($rights >= 6 ? '' : " AND `close`!='1' AND `topan` !='1'")), 0);
        echo '<div class="phdr"><b>' . $lng['forum'] . '</b>: ' . $lng['messages'] . '</div>';
        echo'<div class="phdrbox">';
        if ($total > $kmess) echo '<div class="omenu">' . functions::display_pagination('profile.php?act=activity&amp;user='. $user['id'].'&amp;page=', $start, $total, $kmess) . '</div>';
        $req = mysql_query("SELECT * FROM `forum` WHERE `user_id` = '" . $user['id'] . "' AND `type` = 'm' " . ($rights >= 6 ? '' : " AND `close`!='1' AND `topan` !='1'") . " ORDER BY `id` DESC LIMIT $start, $kmess");
        if (mysql_num_rows($req)) {
            $i = 0;
            while ($res = mysql_fetch_assoc($req)) {
                $topic = mysql_fetch_assoc(mysql_query("SELECT * FROM `forum` WHERE `id` = '" . $res['refid'] . "'"));
                $section = mysql_fetch_assoc(mysql_query("SELECT * FROM `forum` WHERE `id` = '" . $topic['refid'] . "'"));
                $category = mysql_fetch_assoc(mysql_query("SELECT * FROM `forum` WHERE `id` = '" . $section['refid'] . "'"));
                $text = mb_substr($res['text'], 0, 5000);
                $text = functions::checkout($text, 2, 1);
                $text = preg_replace('#\[c\](.*?)\[/c\]#si', '<div class="quote">\1</div>', $text);
                echo ($i % 2 ? '<div class="list1">' : '<div class="list1">') .
                     '<a href="' . $set['homeurl'] . '/forum/' . $topic['id'] . '.html"><font color="003366">' .bbcode::tags(functions::smileys($topic['text'])) . '</font></a>' .
                     '<br />' . $text . '...<a href="' . $set['homeurl'] . '/forum/' . $res['id'] . '"><br /><span class="gray">(' . functions::thoigian($res['time']) . ')</span>' .
                     '</div>';
                ++$i;
            }
        } else {
            echo '<div class="menu"><p>' . $lng['list_empty'] . '</p></div>';
        }
}

if ($total > $kmess) {
    echo '<div class="omenu">' . functions::display_pagination('profile.php?act=activity' . ($mod ? '&amp;mod=' . $mod : '') . '&amp;user='. $user['id'].'&amp;page=', $start, $total, $kmess) . '</div>' .
         '<p><form action="profile.php?act=activity&amp;user=' . $user['id'] . ($mod ? '&amp;mod=' . $mod : '') . '" method="post">';
}

?>