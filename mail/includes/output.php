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

$textl = $lng['mail'];
require_once('../incfiles/head.php');
echo '<div class="homeforum"><div class="icon-home"><div class="home">Tin nhắn</div></div></div>';
echo '<div class="phdr"><b>' . $lng_mail['sent_messages'] . '</b></div>';

$total = mysql_result(mysql_query("SELECT COUNT(*)
  FROM (SELECT DISTINCT `cms_mail`.`from_id`
  FROM `cms_mail`
  LEFT JOIN `cms_contact` ON `cms_mail`.`from_id`=`cms_contact`.`from_id`
  WHERE `cms_mail`.`user_id`='$user_id'
  AND `cms_mail`.`delete`!='$user_id'
  AND `cms_mail`.`sys`='0'
  AND `cms_contact`.`ban`!='1') `tmp`"), 0);

if ($total) {
    $req = mysql_query("SELECT `users`.*, MAX(`cms_mail`.`time`) AS `time`
        FROM `cms_mail`
	    LEFT JOIN `users` ON `cms_mail`.`from_id`=`users`.`id`
		LEFT JOIN `cms_contact` ON `cms_mail`.`from_id`=`cms_contact`.`from_id` AND `cms_contact`.`user_id`='$user_id'
		WHERE `cms_mail`.`user_id`='" . $user_id . "'
		AND `cms_mail`.`delete`!='$user_id'
		AND `cms_mail`.`sys`='0'
		AND `cms_contact`.`ban`!='1'
		GROUP BY `cms_mail`.`from_id`
		ORDER BY MAX(`cms_mail`.`time`) DESC
		LIMIT " . $start . "," . $kmess
    );

    for ($i = 0; $row = mysql_fetch_assoc($req); ++$i) {
        $count_message = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail`
            WHERE `user_id`='$user_id'
            AND `from_id`='{$row['id']}'
            AND `delete`!='$user_id'
            AND `sys`!='1'
        "), 0);

        $last_msg = mysql_fetch_assoc(mysql_query("SELECT *
            FROM `cms_mail`
            WHERE `from_id`='{$row['id']}'
            AND `user_id` = '$user_id'
            AND `delete` != '$user_id'
            ORDER BY `id` DESC
            LIMIT 1"));
        if (mb_strlen($last_msg['text']) > 500) {
            $text = mb_substr($last_msg['text'], 0, 500);
            $text = functions::checkout($text, 1, 1);
            if ($set_user['smileys']) {
                $text = functions::smileys($text, $res['rights'] ? 1 : 0);
            }
            $text = bbcode::notags($text);
            $text .= '...<a href="index.php?act=write&amp;id=' . $row['id'] . '">' . $lng['continue'] . ' &gt;&gt;</a>';
        } else {
            // Или, обрабатываем тэги и выводим весь текст
            $text = functions::checkout($last_msg['text'], 1, 1);
            if ($set_user['smileys'])
                $text = functions::smileys($text, $res['rights'] ? 1 : 0);
        }

        $arg = array(
            'header' => '<span class="gray">(' . functions::thoigian($last_msg['time']) . ')</span>',
            'body'   => '<div style="font-size: small"><small>' . $text . '</small></div>',
            'sub'    => '<p><small><a href="index.php?act=write&amp;id=' . $row['id'] . '"><font color="003366">Tin nhắn</font></a> | <a href="index.php?act=ignor&amp;id=' . $row['id'] . '&amp;add"><font color="003366">Bỏ qua</font></a> | <a href="index.php?act=deluser&amp;id=' . $row['id'] . '"><font color="003366">Xóa</font></a></small></p>',
            'iphide' => 1
        );

        if (!$last_msg['read']) {
            echo '<div class="omenu">';
        } else {
            echo $i % 2 ? '<div class="omenu">' : '<div class="omenu">';
        }
        echo functions::display_user($row, $arg);
        echo '</div>';
    }

//    for ($i = 0; $row = mysql_fetch_assoc($req); ++$i) {
//        echo $i % 2 ? '<div class="omenu">' : '<div class="omenu">';
//        $subtext = '<a href="index.php?act=output&amp;id=' . $row['id'] . '">' . $lng_mail['sent'] . '</a> | <a href="index.php?act=write&amp;id=' . $row['id'] . '">' . $lng_mail['correspondence'] . '</a> | <a href="index.php?act=deluser&amp;id=' . $row['id'] . '">' . $lng['delete'] . '</a> | <a href="index.php?act=ignor&amp;id=' . $row['id'] . '&amp;add">' . $lng_mail['ban_contact'] . '</a>';
//        $count_message = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` WHERE `user_id`='$user_id' AND `from_id`='{$row['id']}' AND `delete`!='$user_id';"), 0);
//        $new_count_message = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` WHERE `cms_mail`.`user_id`='$user_id' AND `cms_mail`.`from_id`='{$row['id']}' AND `read`='0' AND `delete`!='$user_id'"), 0);
//        $arg = array(
//            'header' => '(' . $count_message . ($new_count_message ? '/<span class="red">+' . $new_count_message . '</span>' : '') . ')',
//            'sub'    => $subtext
//        );
//        echo functions::display_user($row, $arg);
//        echo '</div>';
//    }
} else {
    echo '<div class="omenu"><p>' . $lng['list_empty'] . '</p></div>';
}

if ($total > $kmess) {
    echo '<div class="phantrang">' . functions::display_pagination('index.php?act=output&amp;page=', $start, $total, $kmess) . '</div>';
}
