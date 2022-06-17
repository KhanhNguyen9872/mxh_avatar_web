<?php

/*
////////////////////////////////////////////////////////////////////////////////
// JohnCMS                Mobile Content Management System                    //
// Project site:          http://johncms.com                                  //
// Support site:          http://gazenwagen.com                               //
////////////////////////////////////////////////////////////////////////////////
// Lead Developer:        Oleg Kasyanov   (AlkatraZ)  alkatraz@gazenwagen.com //
// Development Team:      Eugene Ryabinin (john77)    john77@gazenwagen.com   //
//                        Dmitry Liseenko (FlySelf)   flyself@johncms.com     //
////////////////////////////////////////////////////////////////////////////////
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

if ($user_id) {
    if (!$id) {
        require('../incfiles/head.php');
        echo functions::display_error($lng['error_wrong_data']);
        require('../incfiles/end.php');
        exit;
    }

    $typ = mysql_query("SELECT * FROM `forum` WHERE `id` = '$id'");
    $ms = mysql_fetch_assoc($typ);
    if ($ms['type'] != "t") {
        require('../incfiles/head.php');
        echo functions::display_error($lng['error_wrong_data']);
        require('../incfiles/end.php');
        exit;
    }

    if (isset($_POST['submit'])) {
        $nn = isset($_POST['nn']) ? functions::check($_POST['nn']) : false;
        if (!$nn) {
            require('../incfiles/head.php');
            echo functions::display_error($lng_forum['error_topic_name'], '<a href="index.php?act=tag&amp;id=' . $id . '">' . $lng['repeat'] . '</a>');
            require('../incfiles/end.php');
            exit;
        }
        // Проверяем, есть ли тема с таким же названием?
        $pt = mysql_query("SELECT * FROM `forum` WHERE `type` = 't' AND `refid` = '" . $ms['refid'] . "' and tags='$nn' LIMIT 1");
        if (mysql_num_rows($pt) != 0) {
            require('../incfiles/head.php');
            echo functions::display_error($lng_forum['error_topic_exists'], '<a href="index.php?act=tag&amp;id=' . $id . '">' . $lng['repeat'] . '</a>');
            require('../incfiles/end.php');
            exit;
        }
        mysql_query("update `forum` set  tags='" . $nn . "' where id='" . $id . "';");
        header("Location: /forum/$id.html");
    } else {
        /*
        -----------------------------------------------------------------
        Переименовываем тему
        -----------------------------------------------------------------
        */
        require('../incfiles/head.php');

        echo '<div class="phdr"><a href="index.php?id=' . $id . '"><b>' . $lng['forum'] . '</b></a> |      Từ khóa của chủ đề này</div>' .
            '<div class="menu"><form action="index.php?act=tag&amp;id=' . $id . '" method="post">' .
            '<p><h3>Nhập từ tìm kiếm cho chủ đề: "' . $ms['text'] . '"</h3>' .
            '<textarea type="text" name="nn" value="' . $ms['tags'] . '">' . $ms['tags'] . '</textarea></p>' .
            '<p><input type="submit" name="submit" value="' . $lng['save'] . '"/></p>' .
            '</form></div>' .
            '<div class="rmenu">Bạn có thể thêm nhiều từ khóa bằng cách thêm dấu phẩy (,) giữa các từ khóa. Chú ý: Từ khóa sẽ hiện thị đối với tất cả mọi người và nên viết ở dấu ,không nên có khoản cách.</div>';
    }
} else {
    require('../incfiles/head.php');
    echo functions::display_error($lng['access_forbidden']);
}
?>