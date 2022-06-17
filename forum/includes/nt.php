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
$admin_only = array ( 2 );
if ( in_array( $id, $admin_only ) && $rights < 9 ):
require('../incfiles/head.php');
 echo '<div class="forumtext"><center><b>Bạn Không Đủ Quyền Đăng Bài Trong Chuyên Mục Này.</b></br><a href="/">Trở lại diễn đàn</a></center></div>';
 require('../incfiles/end.php');
 exit;
endif;
$admin_only = array ( 665 );
if ( in_array( $id, $admin_only ) && $rights < 2 ):
require('../incfiles/head.php');
 echo '<div class="forumtext"><center><b>Bạn Không Đủ Quyền Đăng Bài Trong Chuyên Mục Này.</b></br><a href="/">Trở lại diễn đàn</a></center></div>';
 require('../incfiles/end.php');
 exit;
endif;
/*
-----------------------------------------------------------------
Закрываем доступ для определенных ситуаций
-----------------------------------------------------------------
*/
if (!$id || !$user_id || isset($ban['1']) || isset($ban['11']) || (!core::$user_rights && $set['mod_forum'] == 3)) {
    require('../incfiles/head.php');
    echo functions::display_error($lng['access_forbidden']);
    require('../incfiles/end.php');
    exit;
}

/*
-----------------------------------------------------------------
Вспомогательная Функция обработки ссылок форума
-----------------------------------------------------------------
*/
function forum_link($m)
{
    global $set;
    if (!isset($m[3])) {
        return '[url=' . $m[1] . ']' . $m[2] . '[/url]';
    } else {
        $p = parse_url($m[3]);
        if ('http://' . $p['host'] . $p['path'] . '?id=' == $set['homeurl'] . '/') {
            $thid = abs(intval(preg_replace('/(.*?)id=/si', '', $m[3])));
            $req = mysql_query("SELECT `text` FROM `forum` WHERE `id`= '$thid' AND `type` = 't' AND `close` != '1'");
            if (mysql_num_rows($req) > 0) {
                $res = mysql_fetch_array($req);
                $name = strtr($res['text'], array(
                    '&quot;' => '',
                    '&amp;' => '',
                    '&lt;' => '',
                    '&gt;' => '',
                    '&#039;' => '',
                    '[' => '',
                    ']' => ''
                ));
                if (mb_strlen($name) > 40)
                    $name = mb_substr($name, 0, 40) . '...';
                return '[url=' . $m[3] . ']' . $name . '[/url]';
            } else {
                return $m[3];
            }
        } else
            return $m[3];
    }
}

// Проверка на флуд
$flood = functions::antiflood();
if ($flood) {
    require('../incfiles/head.php');
    echo functions::display_error($lng['error_flood'] . ' ' . $flood . $lng['sec'] . ', <a href="/' . $id . ''.functions::toigiaitri($id["text"]).'.html">' . $lng['back'] . '</a>');
    require('../incfiles/end.php');
    exit;
}
$req_r = mysql_query("SELECT * FROM `forum` WHERE `id` = '$id' AND `type` = 'r' LIMIT 1");
if (!mysql_num_rows($req_r)) {
    require('../incfiles/head.php');
    echo functions::display_error($lng['error_wrong_data']);
    require('../incfiles/end.php');
    exit;
}
$th = isset($_POST['th']) ? functions::check(mb_substr(trim($_POST['th']), 0, 100)) : '';
$msg = isset($_POST['msg']) ? functions::checkin(trim($_POST['msg'])) : '';
$tags = isset($_POST['tags']) ? trim($_POST['tags']) : '';   $msg = preg_replace_callback('~\\[url=(http://.+?)\\](.+?)\\[/url\\]|(http://(www.)?[0-9a-zA-Z\.-]+\.[0-9a-zA-Z]{2,6}[0-9a-zA-Z/\?\.\~&amp;_=/%-:#]*)~', 'forum_link', $msg);
if (isset($_POST['submit'])
    && isset($_POST['token'])
    && isset($_SESSION['token'])
    && $_POST['token'] == $_SESSION['token']
) {
    $error = array();
    if (empty($th))
        $error[] = $lng_forum['error_topic_name'];
    if (mb_strlen($th) < 15)
        $error[] = $lng_forum['error_topic_name_lenght'];
    if (empty($msg))
        $error[] = $lng['error_empty_message'];
    if (mb_strlen($msg) < 20)
        $error[] = $lng['error_message_short'];
    if (!$error) {
        $msg = preg_replace_callback('~\\[url=(http://.+?)\\](.+?)\\[/url\\]|(http://(www.)?[0-9a-zA-Z\.-]+\.[0-9a-zA-Z]{2,6}[0-9a-zA-Z/\?\.\~&amp;_=/%-:#]*)~', 'forum_link', $msg);
        // Прверяем, есть ли уже такая тема в текущем разделе?
        if (mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `refid` = '$id' AND `text` = '$th'"), 0) > 0)
            $error[] = $lng_forum['error_topic_exists'];
        // Проверяем, не повторяется ли сообщение?
        $req = mysql_query("SELECT * FROM `forum` WHERE `user_id` = '$user_id' AND `type` = 'm' ORDER BY `time` DESC");
        if (mysql_num_rows($req) > 0) {
            $res = mysql_fetch_array($req);
            if ($msg == $res['text'])
                $error[] = $lng['error_message_exists'];
        }
    }
    $cat = strtok($agn, ' ');
    $contents = $msg;
        $title = $th;

/*--------------------------------------------------------------------*/
/*
$url = '/forum/';// đường dẫn mặc định thư mục photo
$dir = 'photo';//thư mục mặc định chứa ảnh, không nên sửa
$w=200;//chi?u r?ng c?n resize
$h=200;//chi?u cao c?n resize
function watermark($input,$source,$link,$w,$h,$rs){
preg_match ('#\.jpg$#i',$input) ?  $im_input = imagecreatefromjpeg($input):'';
preg_match ('#\.png$#i',$input) ?  $im_input = imagecreatefrompng($input):'';
preg_match ('#\.gif$#i',$input) ?  $im_input = imagecreatefromgif($input):'';
$im_source = imagecreatefrompng($source);
imagecopy($im_input, $im_source, imagesx($im_input)-imagesx($im_source)-4, imagesy($im_input)-imagesy($im_source)-4, 0, 0,imagesx($im_source),imagesy($im_source));
if ($rs == 'yes') {
$thumb = imagecreatetruecolor($w, $h);
imagecopyresized($thumb, $im_input, 0, 0, 0, 0, $w, $h, imagesx($im_input), imagesy($im_input));
preg_match ('#\.jpg$#i',$input) ? imagejpeg($thumb,$link):'';
preg_match ('#\.png$#i',$input) ? imagepng($thumb,$link):'';
preg_match ('#\.gif$#i',$input) ? imagegif($thumb,$link):'';
} else {
preg_match ('#\.jpg$#i',$input) ? imagejpeg($im_input,$link):'';
preg_match ('#\.png$#i',$input) ? imagepng($im_input,$link):'';
preg_match ('#\.gif$#i',$input) ? imagegif($im_input,$link):'';
}
}

function get_link ($input) {
  preg_match_all ('#\[img\](.+?)\[/img\]#i',$input,$regex);
  return $regex[1];
  }

function get_img ($link,$name) {
       copy ($link,$name);
  return $name;
}
function replace_link ($a_r,$b_r,$str) {
  return str_replace ($a_r,$b_r,$str);
  }
$list = get_link ($contents); // l?y danh sách link ?nh
$new = array ();
  $d = date ('d',time());
  $m = date ('m',time());
  $y = date ('y',time());
  @mkdir ("$dir/$y/$m/$d",0777,true);

foreach ($list as $key=>$link) {
  $end = preg_match('#(\.jpg)$#i',$link) ? '.jpg' : (preg_match('#(\.gif)$#i',$link) ? '.gif':'.png');
  //echo "$dir/$y/$m/$d/" . convert ($title) . "-$key-" . $end ;
  // print_r ($link) . '<br />';
  $new[] = get_img ($link,"$dir/$y/$m/$d/" . convert ($title) . "-$key-" . $end);
  watermark ($new[$key],'logo.png',$new[$key],$w,$h,$rs);
  }
      foreach ($new as $key=>$val) {
        $new[$key] = $url . $val;
        }
  $contents = preg_replace ('#\[img\](.+?)\[/img\]#is','[img]$1[/img]',replace_link ($list,$new,$contents));

        /*-------------------------------------------------------------------*/
        /*
        $msg = $contents;
        */
       
    if (!$error) {
        unset($_SESSION['token']);

        // Добавляем тему
        mysql_query("INSERT INTO `forum` SET 
            `refid` = '$id',
            `type` = 't',
            `time` = '" . time() . "',
            `user_id` = '$user_id',
            `from` = '$login',
            `text` = '$th',
            `tags` = '$tags',
            `soft` = '',
            `edit` = '',
            `curators` = ''
        ") or exit(__LINE__ . ': ' . mysql_error());
        $rid = mysql_insert_id();
        // Добавляем текст поста
        mysql_query("INSERT INTO `forum` SET
            `refid` = '$rid',
            `type` = 'm',
            `time` = '" . time() . "',
            `user_id` = '$user_id',
            `from` = '$login',
            `ip` = '" . core::$ip . "',
            `ip_via_proxy` = '" . core::$ip_via_proxy . "',
            `soft` = '" . mysql_real_escape_string($cat) . "',
            `text` = '" . mysql_real_escape_string($msg) . "',
            `tags` = '" . mysql_real_escape_string($tags) . "',
            `edit` = '',
            `curators` = ''
        ") or exit(__LINE__ . ': ' . mysql_error());
        $postid = mysql_insert_id();
      // Записываем счетчик постов юзера
$fpst = $datauser['postforum'] + 1;
mysql_query("UPDATE `users` SET
`postforum` = '$fpst',
`xu`='" . ($datauser['xu'] + 200) . "',
`lastpost` = '" . time() . "'
WHERE `id` = '$user_id'
");
        // Ставим метку о прочтении
        mysql_query("INSERT INTO `cms_forum_rdm` SET
            `topic_id`='$rid',
            `user_id`='$user_id',
            `time`='" . time() . "'
        ");
$req = mysql_query ("SELECT `text`FROM `forum` WHERE `id`= '" . $rid . "'" );
mysql_query("insert into `forum_theodoi` set `uid`='$user_id',`tid`='$rid' ")or die(mysql_error()); 
$res = mysql_fetch_assoc($req); 
$tieude = html_entity_decode($res['text'],ENT_QUOTES,'UTF-8'); 
$time = time(); 
$bot = $login.' [color=#000000]vừa đăng một bài viết [/color][url='.$set[homeurl].'/forum/'.$rid.'.html][color=#003366]' . $tieude . '[/color][/url]'; 
mysql_query("INSERT INTO `guest` SET 
`adm` = '0', 
`time` = '$time', 
`user_id` = '2', 
`name` = 'BOT', 
`text` = '" . mysql_real_escape_string($bot) . "', 
`ip` = '0000', 
`browser` = 'IPhone 7S' 
");
        if ($_POST['addfiles'] == 1)
            header("Location: index.php?id=$postid&act=addfile");
        else
            header("Location: /forum/$rid.html");
    } else {
        // Выводим сообщение об ошибке
        require('../incfiles/head.php');
        echo'<b><center>Tiêu đề bài viết không được vượt quá 70 ký tự !<br/>
Tiêu đề bài viết không được sử dụng ký tự đặc biệt !<br/>
số ký tự phải lớn hơn 15 và tối đa là 100 . !</b><br/>
thời gian giữa 2 bài viết tối thiểu là 60 giây và giữa 2 comment là 20 giây<br/><a href="/forums/dang-bai-' . $id . '.html">Click để quay về diễn đàn !</a></center>';
        require('../incfiles/end.php');
        exit;
    }
} else {
    $res_r = mysql_fetch_assoc($req_r);
    $req_c = mysql_query("SELECT * FROM `forum` WHERE `id` = '" . $res_r['refid'] . "'");
    $res_c = mysql_fetch_assoc($req_c);
    require('../incfiles/head.php');
    $msg_pre = functions::checkout($msg, 1, 1);
    if ($set_user['smileys'])
        $msg_pre = functions::smileys($msg_pre, $datauser['rights'] ? 1 : 0);
    $msg_pre = preg_replace('#\[c\](.*?)\[/c\]#si', '<div class="quote">\1</div>', $msg_pre);
    if ($msg && $th && !isset($_POST['submit']))
        echo '<div class="list1"><img src="../theme/default/images/op.gif" border="0" alt="op" /> <span style="font-weight: bold">' . $th . '</span></div>' .
            '<div class="list1">' . functions::display_user($datauser, array('iphide' => 1, 'header' => '<span class="gray">(' . functions::display_date(time()) . ')</span>', 'body' => $msg_pre)) . '</div>';
    echo '<div class="phdr">Viết bài mới</div>';
    echo'<div class="phdrbox">';
    echo '<form name="form" action="/forums/dang-bai-' . $id . '.html" method="post">' .
        '<div class="menu">' .
        '<b>Tiêu đề :</b><br/>';
        echo'<input type="text" size="20" maxlength="500" name="th" value="' . $th . '"/></p>' .
        '<b>Nội dung :</b><br/>';
    echo '<textarea rows="' . $set_user['field_h'] . '" name="msg">' . (isset($_POST['msg']) ? functions::checkout($_POST['msg']) : '') . '</textarea></p>' .
         '<p><input type="file" name="addfiles" value="1" ' . (isset($_POST['addfiles']) ? 'checked="checked" ' : '') . '/> ' .
         '<p><input type="file" name="addfiles" value="1" ' . (isset($_POST['addfiles']) ? 'checked="checked" ' : '') . '/> ' .
         '<p><input type="file" name="addfiles" value="1" ' . (isset($_POST['addfiles']) ? 'checked="checked" ' : '') . '/> ' ;
    if ($set_user['translit']) {
        echo '<br /><input type="checkbox" name="msgtrans" value="1" ' . (isset($_POST['msgtrans']) ? 'checked="checked" ' : '') . '/> ' . $lng['translit'];
    }
    $token = mt_rand(1000, 100000);
    $_SESSION['token'] = $token;
    echo'</p><p><input type="submit" name="submit" value="Gửi" style="width: 70px; cursor: pointer;"/> ' .
        '<input type="hidden" name="token" value="' . $token . '"/>' .
        '</p></div></form>';
        echo'</div>';
}