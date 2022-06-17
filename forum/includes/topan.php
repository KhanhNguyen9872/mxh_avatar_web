<?php

/*
Mod in đậm Hoàng Anh
Mod này chỉ in đậm ko lên trang nhất !
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

if ($rights == 6 || $rights >= 9) {
    if (empty($_GET['id'])) {
        require('../incfiles/head.php');
        echo functions::display_error($lng['error_wrong_data']);
        require('../incfiles/end.php');
        exit;
    }
    $req = mysql_query("SELECT COUNT(*) FROM `forum` WHERE `id` = '" . $id . "' AND `type` = 't'");
    if (mysql_result($req, 0) > 0) {
        mysql_query("UPDATE `forum` SET  `topan` = '" . (isset($_GET['topan']) ? '1' : '0') . "' WHERE `id` = '$id'");
        header('Location: '.$id.'.html');
    } else {
        require('../incfiles/head.php');
        echo functions::display_error($lng['error_wrong_data']);
        require('../incfiles/end.php');
        exit;
    }
}

?>