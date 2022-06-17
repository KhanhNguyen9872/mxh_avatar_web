<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
$textl = 'Import file';
$top = 'Import file';
require('../incfiles/head.php');
if (!$id || !$user_id) {
    echo functions::display_error($lng['error_wrong_data']);
    require('../incfiles/end.php');
    exit;
}
// Проверяем, тот ли юзер заливает файл
$req = mysql_query("SELECT * FROM `forum` WHERE `id` = '$id'");
$res = mysql_fetch_assoc($req);
if ($res['user_id'] != $user_id) {
    echo functions::display_error($lng['error_wrong_data']);
    require('../incfiles/end.php');
    exit;
}
$req1 = mysql_query("SELECT COUNT(*) FROM `cms_forum_files` WHERE `post` = '$id'");
if (mysql_result($req1, 0) > 50) {
    echo functions::display_error($lng_forum['error_file_uploaded']);
    require('../incfiles/end.php');
    exit;
}
switch ($res['type']) {
    case "m":
        if (isset($_POST['submit'])) {
			$url = trim($_POST['url']);
	        $newn = $_POST['newn'];
	        	        $tentaptin=basename($url);
	        $path_parts = pathinfo($url);
	        $duoi=$path_parts['extension'];
	        $ten=$path_parts['filename'];
			if (empty ($newn)) {$fname=$tentaptin;}else{$fname=''.$newn.'.'.$duoi.'';}

                $al_ext = array_merge($ext_win, $ext_java, $ext_sis, $ext_doc, $ext_pic, $ext_arch, $ext_video, $ext_audio, $ext_other);
                $ext = explode(".", $fname);
                $error = array ();

                if (!in_array($duoi, $al_ext))
                    $error[] = '<b>Các định dạng không phù hợp hoặc đường dẫn này chứa chữ Hoa hãy đổi tên lại</b>';

                if (strlen($fname) > 5000)
                    $error[] = $lng_forum['error_file_name_size'];

                if(preg_match("/[^\da-z_\-.]+/", $fname))
                    $error[] = $lng_forum['error_file_symbols'];
                $fname = "8vui.$id.".$fname."";
                if (file_exists("../files/forum/attach/$fname")) {
                    $fname = $realtime . $fname;
                }
                    $import = "../files/forum/attach/$fname";
                    if (copy($url, $import)) {
                        echo "";
                    } else {
                        $error[] = "";
                    }

                if (!$error) {
                    // Определяем тип файла
                    $ext = $duoi;
                    if (in_array($ext, $ext_win))
                        $type = 1;
                    elseif (in_array($ext, $ext_java))
                        $type = 2;
                    elseif (in_array($ext, $ext_sis))
                        $type = 3;
                    elseif (in_array($ext, $ext_doc))
                        $type = 4;
                    elseif (in_array($ext, $ext_pic))
                        $type = 5;
                    elseif (in_array($ext, $ext_arch))
                        $type = 6;
                    elseif (in_array($ext, $ext_video))
                        $type = 7;
                    elseif (in_array($ext, $ext_audio))
                        $type = 8;
                    else
                        $type = 9;
                    // Определяем ID субкатегории и категории
                    $req2 = mysql_query("SELECT * FROM `forum` WHERE `id` = '" . $res['refid'] . "'");
                    $res2 = mysql_fetch_array($req2);
                    $req3 = mysql_query("SELECT * FROM `forum` WHERE `id` = '" . $res2['refid'] . "'");
                    $res3 = mysql_fetch_array($req3);
                    // Заносим данные в базу
                    mysql_query("INSERT INTO `cms_forum_files` SET
                        `cat` = '" . $res3['refid'] . "',
                        `subcat` = '" . $res2['refid'] . "',
                        `topic` = '" . $res['refid'] . "',
                        `post` = '$id',
                        `time` = '" . $res['time'] . "',
                        `filename` = '" . mysql_real_escape_string($fname) . "',
                        `filetype` = '$type'
                    ");
                } else {
                    echo functions::display_error($error, '[<a href="' . $set['homeurl'] . '/import/forum-' . $id . '.html"><b>Upload lại</b></a>]');
                }
            $pa = mysql_query("SELECT `id` FROM `forum` WHERE `type` = 'm' AND `refid` = '" . $res['refid'] . "'");
            $pa2 = mysql_num_rows($pa);
            $page = ceil($pa2 / $kmess);
           echo '<div class="menu">[<a href="/forum/' . $res['refid'] . '.html"><b>Upload xong</b></a>] - [<a href="' . $set['homeurl'] . '/import/forum-'.$id.'.html"><b>Upload thêm</b></a>]</div>';
        } else {
            echo '<div class="phdr"><a href="/upload/forum-'.$id.'.html">Upload</a> | <font color="red">Import</font></div>' .
                '<div class="mainbody">' .
                '<div class="gmenu"><form action="/forum/index.php?act=import&amp;id=' . $id . '" method="post" enctype="multipart/form-data"><p>';
                echo "Nhập URL:<br/><input type='text' name='url' value='http://'/><br/><font color='red'>Bạn hãy đặt tên file cho phù hợp không nên đặt tên có dấu và chữ hoa nhé hãy để trống nếu muốn để tên gốc!</font><br/><input type='text' name='newn'value=''/>";

            echo '</p><p><input type="submit" name="submit" value="Upload"/></p></form></div>' .
                '<div class="menu">Bạn chỉ có thể up file dưới: ' . $set['flsz'] . 'kb.</div></div>';
        }
        break;

    default:
        echo functions::display_error($lng['error_wrong_data']);
}
?>