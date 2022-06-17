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
$textl = 'Upload file';
$top = 'Upload file';
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
            /*
            -----------------------------------------------------------------
            Проверка, был ли выгружен файл и с какого браузера
            -----------------------------------------------------------------
            */
            $do_file = false;
            $do_file_mini = false;
            if ($_FILES['fail']['size'] > 0) {
                // Проверка загрузки с обычного браузера
                $do_file = true;
                $fname = strtolower($_FILES['fail']['name']);
                $fsize = $_FILES['fail']['size'];
            } elseif (strlen($_POST['fail1']) > 0) {
                // Проверка загрузки с Opera Mini
                $do_file_mini = true;
                $array = explode('file=', $_POST['fail1']);
                $fname = strtolower($array[0]);
                $filebase64 = $array[1];
                $fsize = strlen(base64_decode($filebase64));
            }
            /*
            -----------------------------------------------------------------
            Обработка файла (если есть), проверка на ошибки
            -----------------------------------------------------------------
            */
            if ($do_file || $do_file_mini) {            
                // Список допустимых расширений файлов.
                $al_ext = array_merge($ext_win, $ext_java, $ext_sis, $ext_doc, $ext_pic, $ext_arch, $ext_video, $ext_audio, $ext_other);
                $ext = explode(".", $fname);
                $error = array();
                // Проверка на допустимый размер файла
                if ($fsize > 1024 * $set['flsz'])
                    $error[] = $lng_forum['error_file_size'] . ' ' . $set['flsz'] . 'kb.';
                // Проверка файла на наличие только одного расширения
                if (count($ext) != 2)
                    $error[] = $lng_forum['error_file_name'];
                // Проверка допустимых расширений файлов
                if (!in_array($ext[1], $al_ext))
                    $error[] = $lng_forum['error_file_ext'] . ':<br />' . implode(', ', $al_ext);
                // Проверка на длину имени
                if (strlen($fname) > 5000)
                    $error[] = $lng_forum['error_file_name_size'];
                // Проверка на запрещенные символы
                if (preg_match("/[^\da-z_\-.]+/", $fname))
                    $error[] = $lng_forum['error_file_symbols'];
                // Проверка наличия файла с таким же именем
                if (file_exists("../files/forum/attach/$fname")) {
                    $fname = time() . $fname;
                }
                // Окончательная обработка
                if (!$error && $do_file) {
                    // Для обычного браузера
                    $fname = "8vui.$id.".$fname."";
                    if ((move_uploaded_file($_FILES["fail"]["tmp_name"], "../files/forum/tailen/$fname")) == true) {
                        @chmod("$fname", 0777);
                        @chmod("../files/forum/tailen/$fname", 0777);
                        $lng_forum['file_uploaded'] . '<br/>';
                    } else {
                        $error[] = $lng_forum['error_upload_error'];
                    }
                } elseif ($do_file_mini) {
                    // Для Opera Mini
                    if (strlen($filebase64) > 0) {
                        $FileName = "../files/forum/tailen/$fname";
                        $filedata = base64_decode($filebase64);
                        $fid = @fopen($FileName, "wb");
                        if ($fid) {
                            if (flock($fid, LOCK_EX)) {
                                fwrite($fid, $filedata);
                                flock($fid, LOCK_UN);
                            }
                            fclose($fid);
                        }
                        if (file_exists($FileName) && filesize($FileName) == strlen($filedata)) {
                           echo $lng_forum['file_uploaded'] . '<br/>';
                        } else {
                            $error[] = $lng_forum['error_upload_error'];
                        }
                    }
                }
                if (!$error) {
                    // Определяем тип файла
                    $ext = strtolower($ext[1]);
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
                    echo functions::display_error($error, '<a href="index.php?act=addfile&amp;id=' . $id . '">' . $lng['repeat'] . '</a>');
                }
            } else {
                echo'<div class="menu"><b>Bạn đã upload không đúng định dạng</b><br/>[<a href="' . $set['homeurl'] . '/upload/forum-'.$id.'.html"><b>Upload lại</b></a>]</div>';
            }
            $pa = mysql_query("SELECT `id` FROM `forum` WHERE `type` = 'm' AND `refid` = '" . $res['refid'] . "'");
            $pa2 = mysql_num_rows($pa);
            $page = ceil($pa2 / $kmess);
            echo '<div class="menu">[<a href="/forum/' . $res['refid'] . '.html"><b>Up xong</b></a>] - [<a href="' . $set['homeurl'] . '/upload/forum-'.$id.'.html"><b>Up thêm</b></a>]</div>';
        } else {
            /*
            -----------------------------------------------------------------
            Форма выбора файла для выгрузки
            -----------------------------------------------------------------
            */
            echo '<div class="phdr"><b><font color="red">Upload</font></b> | <a href="' . $set['homeurl'] . '/import/forum-'.$id.'.html">Import</a></div>' .
                 '<div class="phdrbox">' .
                 '<div class="gmenu"><form action="/upload/forum-' . $id . '.html" method="post" enctype="multipart/form-data"><p>';
            if (stristr($agn, 'Opera/8.01')) {
                echo '<input name="fail1" value =""/>&#160;<br/><a href="op:fileselect">' . $lng_forum['select_file'] . '</a>';
            } else {
                echo '<input type="file" name="fail"/>';
            }
            echo '</p><p><input type="submit" name="submit" value="' . $lng_forum['upload'] . '"/></p></form></div>';



            echo '<div class="menu">Bạn chỉ có thể up file dưới: ' . $set['flsz'] . 'kb.</div></div>';
        }
        break;

    default:
        echo functions::display_error($lng['error_wrong_data']);
}
?>