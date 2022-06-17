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
if ($rights == 3 || $rights >= 6) {
    $topic_vote = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_forum_vote` WHERE `type`='1' AND `topic` = '$id'"), 0);
    require('../incfiles/head.php');
    if ($topic_vote == 0) {
        echo functions::display_error($lng['error_wrong_data']);
        require('../incfiles/end.php');
        exit;
    }
    if (isset($_GET['yes'])) {
        mysql_query("DELETE FROM `cms_forum_vote` WHERE `topic` = '$id'");
        mysql_query("DELETE FROM `cms_forum_vote_users` WHERE `topic` = '$id'");
        mysql_query("UPDATE `forum` SET  `realid` = '0'  WHERE `id` = '$id'");
        echo $lng_forum['voting_deleted'] . '<br /><div class="menu"><a href="' . $_SESSION['prd'] . '">' . $lng['continue'] . '</a></div>';
    } else {
        echo '<div class="phdr">Xóa bỏ phiếu</div>';
        echo '<div class="menu"><p>' . $lng_forum['voting_delete_warning'] . '</p>';
        echo '<p><a href="?act=delvote&amp;id=' . $id . '&amp;yes">' . $lng['delete'] . '</a><br />';
        echo '<a href="' . htmlspecialchars(getenv("HTTP_REFERER")) . '">' . $lng['cancel'] . '</a></p></div>';
        $_SESSION['prd'] = htmlspecialchars(getenv("HTTP_REFERER"));
    }
} else {
    header('location: ../index.php?err');
}
?>