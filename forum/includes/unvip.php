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
if ($rights >= 9) {
    if (!$id) {
        require('../incfiles/head.php');
        echo functions::display_error($lng['error_wrong_data']);
        require('../incfiles/end.php');
        exit;
    }
    // Проверяем, существует ли тема
    $req = mysql_query("SELECT * FROM `forum` WHERE `id` = '$id' AND `type` = 't' AND `topicvip`='1'");
    if (!mysql_num_rows($req)) {
        require('../incfiles/head.php');
        echo functions::display_error($lng_forum['error_topic_deleted']);
        require('../incfiles/end.php');
        exit;
    }
    $res = mysql_fetch_assoc($req);
    if (isset($_GET['yes']) && $rights == 9) {
        // Удаляем прикрепленные файлы
   mysql_query("UPDATE `forum` SET `topicvip` = '0' WHERE `id` = '$id'");
        header('Location: ?id=' . $id);
    }
    require('../incfiles/head.php');
    echo '<div class="phdr"><a href="index.php?id=' . $id . '"><b>' . $lng['forum'] . '</b></a> | Gỡ VIP</div>' .
        '<div class="rmenu"><p>Bạn có muốn hạ chủ đề xuống mức độ bình thường trong thể loại không?</p>' .
        '<p><a href="index.php?id=' . $id . '">' . $lng['cancel'] . '</a> | ' .
        '<a href="index.php?act=unvip&amp;id=' . $id . '&amp;yes">Chấp nhận</a>';
    echo '</p></div>';
    echo '<div class="phdr">&#160;</div>';
} else {
    echo functions::display_error($lng['access_forbidden']);
}
?>