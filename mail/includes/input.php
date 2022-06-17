<?php

/**
 * @developer     ID Thiên Ân
 * @link        fb.com/idthienan
 * @copyright   Copyright (C) 2019-2020 ID Thiên Ân Cute

 */

defined('_IN_JOHNCMS') or die('Error: restricted access');

$textl = $lng['mail'];
require_once('../incfiles/head.php');
echo '<div class="homeforum"><div class="icon-home"><div class="home">Tin nhắn</div></div></div>';
echo '<div class="phdr"><b>Hộp thư đến</b></div>';
echo '<div class="phdrbox">';
$total = mysql_result(mysql_query("SELECT COUNT(*)
  FROM (SELECT DISTINCT `cms_mail`.`user_id`
  FROM `cms_mail`
  LEFT JOIN `cms_contact` ON `cms_mail`.`user_id`=`cms_contact`.`from_id`
  WHERE `cms_mail`.`from_id`='$user_id'
  AND `cms_mail`.`delete`!='$user_id'
  AND `cms_mail`.`sys`='0'
  AND `cms_contact`.`ban`!='1') `tmp`"), 0);

if ($total) {
    $req = mysql_query("SELECT `users`.*, MAX(`cms_mail`.`time`) AS `time`
		FROM `cms_mail`
		LEFT JOIN `users` ON `cms_mail`.`user_id`=`users`.`id`
		LEFT JOIN `cms_contact` ON `cms_mail`.`user_id`=`cms_contact`.`from_id` AND `cms_contact`.`user_id`='$user_id'
		WHERE `cms_mail`.`from_id`='$user_id'
		AND `cms_mail`.`delete`!='$user_id'
		AND `cms_mail`.`sys`='0'
		AND `cms_contact`.`ban`!='1'
		GROUP BY `cms_mail`.`user_id`
		ORDER BY MAX(`cms_mail`.`time`) DESC
		LIMIT " . $start . "," . $kmess);

    for ($i = 0; $row = mysql_fetch_assoc($req); ++$i) {
        $count_message = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail`
            WHERE `user_id`='{$row['id']}'
            AND `from_id`='$user_id'
            AND `delete`!='$user_id'
            AND `sys`!='1'
        "), 0);

        $last_msg = mysql_fetch_assoc(mysql_query("SELECT *
            FROM `cms_mail`
            WHERE `from_id`='$user_id'
            AND `user_id` = '{$row['id']}'
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
            $text .= '...<a href="' . $row['id'] . '">' . $lng['continue'] . ' &gt;&gt;</a>';
        } else {
            // Или, обрабатываем тэги и выводим весь текст
            $text = functions::checkout($last_msg['text'], 1, 1);
            if ($set_user['smileys'])
                $text = functions::smileys($text, $res['rights'] ? 1 : 0);
        }

        $arg = array(
            'header' => '<span class="gray">(' . functions::thoigian($last_msg['time']) . ')</span>',
            'sub'    => '<p><a href="' . $row['id'] . '"><font color="003366">Các tin nhắn</font></a></p>',
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
} else {
    echo '<div class="menu"><p>' . $lng['list_empty'] . '</p></div>';
}

if ($total > $kmess) {
    echo '<div class="phantrang">' . functions::display_pagination('index.php?act=input&amp;page=', $start, $total, $kmess) . '</div>';
}
echo'</div>';