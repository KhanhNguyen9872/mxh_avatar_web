<?php

defined('_IN_JOHNCMS') or die('Error: restricted access');
$textl = 'Sửa bài viết';
$top = 'Sửa bài viết';
require('../incfiles/head.php');
if (!$user_id || !$id) {
    echo functions::display_error($lng['error_wrong_data']);
    require('../incfiles/end.php');
    exit;
}
$req = mysql_query("SELECT * FROM `forum` WHERE `id` = '$id' AND `type` = 'm' " . ($rights >= 7 ? "" : " AND `close` != '1'"));
if (mysql_num_rows($req)) {
    /*
    -----------------------------------------------------------------
    Предварительные проверки
    -----------------------------------------------------------------
    */
    $res = mysql_fetch_assoc($req);
	if($rights  < 6 && $rights  != 3 && $user_id) {
    	$topic = mysql_fetch_assoc(mysql_query("SELECT `curators` FROM `forum` WHERE `id` = " . $res['refid']));
    	$curators = !empty($topic['curators']) ? unserialize($topic['curators']) : array();
    	if(array_key_exists($user_id, $curators)) $rights = 3;
    }
    $page = ceil(mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '" . $res['refid'] . "' AND `id` " . ($set_forum['upfp'] ? ">=" : "<=") . " '$id'" . ($rights < 7 ? " AND `close` != '1'" : '')), 0) / $kmess);
    $posts = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '" . $res['refid'] . "' AND `close` != '1'"), 0);
    $link = '/forum/' . $res['refid'] . '.html';
    $error = false;
    if ($rights >= 3) {
        // Проверка для Администрации
        if ($res['user_id'] != $user_id) {
            $req_u = mysql_query("SELECT * FROM `users` WHERE `id` = '" . $res['user_id'] . "'");
            if (mysql_num_rows($req_u)) {
                $res_u = mysql_fetch_assoc($req_u);
                if ($res_u['rights'] > $datauser['rights'])
                    $error = $lng['error_edit_rights'] . '<br /><a href="' . $link . '">' . $lng['back'] . '</a>';
            }
        }
    } else {
        // Проверка для обычных юзеров
        if ($res['user_id'] != $user_id)
            $error = $lng_forum['error_edit_another'] . '<br /><a href="' . $link . '">' . $lng['back'] . '</a>';
        if (!$error) {
            $req_m = mysql_query("SELECT * FROM `forum` WHERE `refid` = '" . $res['refid'] . "' ORDER BY `id` DESC LIMIT 1");
            $res_m = mysql_fetch_assoc($req_m);
            if ($res_m['user_id'] != $user_id)
                $error = $lng_forum['error_edit_last'] . '<br /><a href="' . $link . '">' . $lng['back'] . '</a>';
            elseif ($res['time'] < time() - 300)
                $error = $lng_forum['error_edit_timeout'] . '<br /><a href="' . $link . '">' . $lng['back'] . '</a>';
        }
    }
} else {
    $error = $lng_forum['error_post_deleted'] . '<br /><a href="index.php">' . $lng['forum'] . '</a>';
}
if (!$error) {
    switch ($do) {
        case 'restore':
            /*
            -----------------------------------------------------------------
            Восстановление удаленного поста
            -----------------------------------------------------------------
            */
            $req_u = mysql_query("SELECT `postforum` FROM `users` WHERE `id` = '" . $res['user_id'] . "'");
            if (mysql_num_rows($req_u)) {
                // Добавляем один балл к счетчику постов юзера
                $res_u = mysql_fetch_assoc($req_u);
                mysql_query("UPDATE `users` SET `postforum` = '" . ($res_u['postforum'] + 1) . "' WHERE `id` = '" . $res['user_id'] . "'");
            }
            mysql_query("UPDATE `forum` SET `close` = '0', `close_who` = '$login' WHERE `id` = '$id'");
            $req_f = mysql_query("SELECT * FROM `cms_forum_files` WHERE `post` = '$id' LIMIT 1");
            if (mysql_num_rows($req_f)) {
                mysql_query("UPDATE `cms_forum_files` SET `del` = '0' WHERE `post` = '$id' LIMIT 1");
            }
            header('Location: ' . $link);
            break;

        case 'delete':
            /*
            -----------------------------------------------------------------
            Удаление поста и прикрепленного файла
            -----------------------------------------------------------------
            */
            if ($res['close'] != 1) {
                $req_u = mysql_query("SELECT `postforum` FROM `users` WHERE `id` = '" . $res['user_id'] . "'");
                if (mysql_num_rows($req_u)) {
                    // Вычитаем один балл из счетчика постов юзера
                    $res_u = mysql_fetch_assoc($req_u);
                    $postforum = $res_u['postforum'] > 0 ? $res_u['postforum'] - 1 : 0;
                    mysql_query("UPDATE `users` SET `postforum` = '" . $postforum . "' WHERE `id` = '" . $res['user_id'] . "'");
                }
            }
            if ($rights >= 7 && !isset($_GET['hide'])) {
                // Удаление поста (для Супервизоров)
                $req_f = mysql_query("SELECT * FROM `cms_forum_files` WHERE `post` = '$id' LIMIT 1");
                if (mysql_num_rows($req_f)) {
                    // Если есть прикрепленный файл, удаляем его
                    $res_f = mysql_fetch_assoc($req_f);
                    unlink('../files/forum/tailen/' . $res_f['filename']);
                    mysql_query("DELETE FROM `cms_forum_files` WHERE `post` = '$id' LIMIT 1");
                }
                // Формируем ссылку на нужную страницу темы
                $page = ceil(mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `refid` = '" . $res['refid'] . "' AND `id` " . ($set_forum['upfp'] ? ">" : "<") . " '$id'"), 0) / $kmess);
                mysql_query("DELETE FROM `forum` WHERE `id` = '$id'");
                if ($posts < 2) {
                    // Пересылка на удаление всей темы
                    header('Location: index.php?act=deltema&id=' . $res['refid']);
                } else {
                    header('Location: /forum/' . $res['refid'] . '.html');
                }
            } else {
                // Скрытие поста
                $req_f = mysql_query("SELECT * FROM `cms_forum_files` WHERE `post` = '$id' LIMIT 1");
                if (mysql_num_rows($req_f)) {
                    // Если есть прикрепленный файл, скрываем его
                    mysql_query("UPDATE `cms_forum_files` SET `del` = '1' WHERE `post` = '$id' LIMIT 1");
                }
                if ($posts == 1) {
                    // Если это был последний пост темы, то скрываем саму тему
                    $res_l = mysql_fetch_assoc(mysql_query("SELECT `refid` FROM `forum` WHERE `id` = '" . $res['refid'] . "'"));
                    mysql_query("UPDATE `forum` SET `close` = '1', `close_who` = '$login' WHERE `id` = '" . $res['refid'] . "' AND `type` = 't'");
                    header('Location: index.php?act=deltema&id=' . $res['refid']);
                } else {
                    mysql_query("UPDATE `forum` SET `close` = '1', `close_who` = '$login' WHERE `id` = '$id'");
                    header('Location: /forum/' . $res['refid'] . '.html');
                }
            }
            break;

        case 'del':
            /*
            -----------------------------------------------------------------
            Удаление поста, предварительное напоминание
            -----------------------------------------------------------------
            */
            echo '<div class="phdr">' . $lng_forum['delete_post'] . '</div>' .
                 '<div class="menu"><p>';
            if ($posts == 1)
                echo $lng_forum['delete_last_post_warning'] . '<br />';
            echo $lng['delete_confirmation'] . '</p>' .
                 '<form action="/forum/index.php?act=editpost&amp;do=delete&amp;id=' . $id . '"method="post"/><input type="submit"value="Xóa"/></form>';
            echo '</div>';
            break;

        default:
            /*
            -----------------------------------------------------------------
            Редактирование поста
            -----------------------------------------------------------------
            */
            $msg = isset($_POST['msg']) ? functions::checkin(trim($_POST['msg'])) : '';
            if (isset($_POST['msgtrans']))
                $msg = functions::trans($msg);
            if (isset($_POST['submit'])) {
                if (empty($_POST['msg'])) {
                    echo functions::display_error($lng['error_empty_message'], '<a href="index.php?act=editpost&amp;id=' . $id . '">' . $lng['repeat'] . '</a>');
                    require('../incfiles/end.php');
                    exit;
                }
                mysql_query("UPDATE `forum` SET
                    `tedit` = '" . time() . "',
                    `edit` = '$login',
                    `kedit` = '" . ($res['kedit'] + 1) . "',
                    `text` = '" . mysql_real_escape_string($msg) . "'
                    WHERE `id` = '$id'
                ");
                header('Location: /forum/' . $res['refid'] . '.html');
            } else {
                $msg_pre = functions::checkout($msg, 1, 1);
                if ($set_user['smileys'])
                    $msg_pre = functions::smileys($msg_pre, $datauser['rights'] ? 1 : 0);
                $msg_pre = preg_replace('#\[c\](.*?)\[/c\]#si', '<div class="quote">\1</div>', $msg_pre);
                echo '<div class="phdr"><a href="' . $link . '"><b>' . $lng['forum'] . '</b></a> » ' . $lng_forum['edit_message'] . '</div>';
                echo '<div class="mainbody">';
                if ($msg && !isset($_POST['submit'])) {
                    $user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '" . $res['user_id'] . "' LIMIT 1"));
                    echo '<div class="menu">' . functions::display_user($user, array('iphide' => 1, 'header' => '<span class="gray">(' . functions::display_date($res['time']) . ')</span>', 'body' => $msg_pre)) . '</div>';
                }
                echo '<div class="menu"><form name="form" action="?act=editpost&amp;id=' . $id . '&amp;start=' . $start . '" method="post"><p>';
                    echo bbcode::auto_bb('form', 'msg');
                echo '<textarea rows="5" name="msg">' . (empty($_POST['msg']) ? htmlentities($res['text'], ENT_QUOTES, 'UTF-8') : functions::checkout($_POST['msg'])) . '</textarea><br/>';
                if ($set_user['translit'])
                    echo '<input type="checkbox" name="msgtrans" value="1" ' . (isset($_POST['msgtrans']) ? 'checked="checked" ' : '') . '/> ' . $lng['translit'];
                echo '</p><p><input type="submit" name="submit" value="Gửi" class="nut" style="width: 50px; cursor: pointer;"/> ' .
                     '</p></form></div>';
            }
    }
} else {
    /*
    -----------------------------------------------------------------
    Выводим сообщения об ошибках
    -----------------------------------------------------------------
    */
    echo functions::display_error($error);
}