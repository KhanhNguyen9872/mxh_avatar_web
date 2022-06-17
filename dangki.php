<?php

/**
 * @package     JohnCMS
 * @link        http://johncms.com
 * @copyright   Copyright (C) 2008-2011 JohnCMS Community
 * @license     LICENSE.txt (see attached file)
 * @version     VERSION.txt (see attached file)
 * @author      http://johncms.com/about
 */

define('_IN_JOHNCMS', 1);

$rootpath = '';
require('incfiles/core.php');
$textl = $lng['registration'];
$headmod = 'registration';
require('incfiles/head.php');
$lng_reg = core::load_lng('registration');
echo'<div class="phdrbox">';
if (core::$deny_registration || !$set['mod_reg']) {
    echo '<p>' . $lng_reg['registration_closed'] . '</p>';
    require('incfiles/end.php');
    exit;
}

//Cấm reg nhiều nick
$ktip = mysql_result(mysql_query("SELECT COUNT(`ip`) FROM `users` WHERE `ip`='" . core::$ip . "'"), 0);
if ($ktip >= 100) {
	echo '<div class="menu"><font color="red">Kiểm tra thấy sever đã đăng kí hơn 100 nick và không thể đăng kí thêm nữa vui lòng đợi bản update để tiếp tục đăng kí, Liên hệ ID Thiên Ân để biết thêm chi tiết.</font></div></div>';
	require('incfiles/end.php');
	exit;
}

if ($user_id) {
	echo '<div class="rmenu">Vui lòng thoát trước khi đăng kí</div>';
	echo '</div>';
	require('incfiles/end.php');
	exit;
}
$checknick=mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'"));
if ($checknick==0 && isset($_GET['id'])) {
	echo '<div class="rmenu">Link giới thiệu không tồn tại</div>';
	echo '</div>';
	require('incfiles/end.php');
	exit;
}
$captcha = isset($_POST['captcha']) ? trim($_POST['captcha']) : NULL;
$reg_nick = isset($_POST['nick']) ? trim($_POST['nick']) : '';
$lat_nick = functions::rus_lat(mb_strtolower($reg_nick));
$reg_pass = isset($_POST['password']) ? trim($_POST['password']) : '';
$reg_live = isset($_POST['live']) ? trim($_POST['live']) : '';
$reg_mibile = isset($_POST['mibile']) ? trim($_POST['mibile']) : '';
$reg_name = isset($_POST['imname']) ? trim($_POST['imname']) : '';
$reg_mail = isset($_POST['mail']) ? trim($_POST['mail']) : '';
$reg_about = isset($_POST['about']) ? trim($_POST['about']) : '';
$reg_sex = isset($_POST['sex']) ? functions::check(mb_substr(trim($_POST['sex']), 0, 2)) : '';

if (isset($_POST['submit'])) {
    // Принимаем переменные
    $error = array();
    // Проверка Логина
    if (empty($reg_nick))
        $error['login'][] = $lng_reg['error_nick_empty'];
    elseif (mb_strlen($reg_nick) < 3 || mb_strlen($reg_nick) > 15)
        $error['login'][] = $lng_reg['error_nick_lenght'];
    if (preg_match('/[^\da-z\-\@\*\(\)\?\!\~\_\=\[\]]+/', $lat_nick))
        $error['login'][] = $lng['error_wrong_symbols'];
    // Проверка пароля
    if (empty($reg_pass)) $error['password'][] = $lng['error_empty_password'];
    elseif (mb_strlen($reg_pass) < 3 || mb_strlen($reg_pass) > 10) $error['password'][] = $lng['error_wrong_lenght'];
    if (preg_match('/[^\dA-Za-z]+/', $reg_pass)) $error['password'][] = $lng['error_wrong_symbols'];
    // Проверка пола
    if ($reg_sex != 'm' && $reg_sex != 'zh') $error['sex'] = $lng_reg['error_sex'];
    // Проверка кода CAPTCHA

    // Проверка переменных
    if (empty($error)) {
        $pass = md5(md5($reg_pass));
        $reg_name = functions::check(mb_substr($reg_name, 0, 20));
        $reg_about = functions::check(mb_substr($reg_about, 0, 500));
        // Проверка, занят ли ник
        $req = mysql_query("SELECT * FROM `users` WHERE `name_lat`='" . mysql_real_escape_string($lat_nick) . "'");
        if (mysql_num_rows($req) != 0) {
            $error['login'][] = $lng_reg['error_nick_occupied'];
        }
    }
    if (empty($error)) {
        $preg = $set['mod_reg'] > 1 ? 1 : 0;
        if(isset($_GET[id])) {
        mysql_query("INSERT INTO `users` SET
            `name` = '" . mysql_real_escape_string($reg_nick) . "',
            `name_lat` = '" . mysql_real_escape_string($lat_nick) . "',
            `password` = '" . mysql_real_escape_string($pass) . "',
            `imname` = '$reg_name',
            `live` = '$reg_live',
            `mibile` = '1',
            `about` = '$reg_about',
            `mail` = '$reg_mail',
            `sex` = '$reg_sex',
            `rights` = '0',
            `ip` = '" . core::$ip . "',
            `ip_via_proxy` = '" . core::$ip_via_proxy . "',
            `browser` = '" . mysql_real_escape_string($agn) . "',
            `datereg` = '" . time() . "',
            `lastdate` = '" . time() . "',
            `sestime` = '" . time() . "',
            `preg` = '$preg',
            `set_user` = '',
            `set_forum` = '',
            `xu`='5000000',
            `vnd`='1000',
            `set_mail` = '',
            `smileys` = ''
        ") or exit(__LINE__ . ': ' . mysql_error());
        } else {
                mysql_query("INSERT INTO `users` SET
            `name` = '" . mysql_real_escape_string($reg_nick) . "',
            `name_lat` = '" . mysql_real_escape_string($lat_nick) . "',
            `password` = '" . mysql_real_escape_string($pass) . "',
            `imname` = '$reg_name',
            `live` = '$reg_live',
            `mibile` = '1',
            `about` = '$reg_about',
            `mail` = '$reg_mail',
            `sex` = '$reg_sex',
            `rights` = '0',
            `ip` = '" . core::$ip . "',
            `ip_via_proxy` = '" . core::$ip_via_proxy . "',
            `browser` = '" . mysql_real_escape_string($agn) . "',
            `datereg` = '" . time() . "',
            `lastdate` = '" . time() . "',
            `sestime` = '" . time() . "',
            `preg` = '$preg',
            `set_user` = '',
            `set_forum` = '',
            `gioithieu`='$id',
            `xu`='5000000',
            `vnd`='1000',
            `set_mail` = '',
            `smileys` = ''
        ") or exit(__LINE__ . ': ' . mysql_error());
        }
        $usid = mysql_insert_id();
        $time = time();
        $bot = 'Chào mừng @'.$reg_nick.' vừa gia nhập vào diễn đàn , chúc bạn online vui vẻ !';
        mysql_query("INSERT INTO `guest` SET
             `adm` = '0',
             `time` = '$time',
             `user_id` = '2',
             `name` = 'BOT',
             `text` = '" . mysql_real_escape_string($bot) . "',
             `ip` = '0000',
             `browser` = 'IPHONE'
         ");

        // Отправка системного сообщения
        $set_mail = unserialize($set['setting_mail']);
        if (!isset($set_mail['message_include'])) {
            $set_mail['message_include'] = 0;
        }

        if ($set_mail['message_include']) {
            $array = array('{LOGIN}', '{TIME}');
            $array_replace = array($reg_nick, '{TIME=' . time() . '}');

            if (empty($set['them_message']))
                $set['them_message'] = $lng_mail['them_message'];
            if (empty($set['reg_message']))
                $set['reg_message'] = $lng['hi'] . ", {LOGIN}\r\n" . $lng_mail['pleased_see_you'] . "\r\n" . $lng_mail['come_my_site'] . "\r\n" . $lng_mail['respectfully_yours'];
            $theme = str_replace($array, $array_replace, $set['them_message']);
            $system = str_replace($array, $array_replace, $set['reg_message']);
            mysql_query("INSERT INTO `cms_mail` SET
			    `user_id` = '0',
			    `from_id` = '" . $usid . "',
			    `text` = '" . mysql_real_escape_string($system) . "',
			    `time` = '" . time() . "',
			    `sys` = '1',
			    `them` = '" . mysql_real_escape_string($theme) . "'
			");
        }

echo'<div style="background: rgb(255, 233, 233); border-radius: 2px; border: 1px solid rgb(251, 196, 196); box-sizing: border-box; color: #de5959; float: none; font-family: Arial, sans-serif; font-size: 15px; margin: 0px auto; outline: 0px; padding: 15px 20px; vertical-align: baseline;"><center><h3><font color="#FF9933"><b>Đăng Kí Thành Công<b></font></h3>';
        echo'<img src="https://nhandaovadoisong.com.vn/wp-content/uploads/2019/05/hinh-nen-dien-thoai-de-thuong-42.gif" width="30%"></div>';
        if ($set['mod_reg'] == 1) {
          /*  echo '<p><span class="red">Đăng ký thành công soạn tin : <b>NT VNTV DK ' . $reg_nick . ' Gửi 8098 ( 500Đ / 1 SMS )<br/>
Để kích hoạt tài khoản !</b></span></p>';
*/
        } else {
            echo '<br><a href="/dangnhap.html"><button type="button" class="btn btn-info btn-lg">Đăng Nhập</button></a><br><br>';
        }
        echo '</p></div>';
        require('incfiles/end.php');
        exit;
    }
}

/*
-----------------------------------------------------------------
Форма регистрации
-----------------------------------------------------------------
*/
if ($set['mod_reg'] == 1) echo '<div class="rmenu"></div>';
echo'<form method="post"><div class="gmenu">' .
'<b>Tên đăng nhập:</b><br/>' .
'<input type="text" name="nick" maxlength="15" value="' . htmlspecialchars($reg_nick) . '"' . (isset($error['login']) ? ' style="background-color: #FFCCCC"' : '') . '/><br />' .
'<br/>' .
'<b>' . $lng_reg['password'] . '</b><br/>' .
'<input type="text" name="password" maxlength="30" value="' . htmlspecialchars($reg_pass) . '"' . (isset($error['password']) ? ' style="background-color: #FFCCCC"' : '') . '/><br/><br>' .
'</span>' .
(isset($error['sex']) ? '<span class="red"><small>' . $error['sex'] . '</small></span><br />' : '') .
'</div></div>' .
'<div class="phdrbox">' .
'<div class="gmenu">' .
'<p><b> Giới tính</b><br/>' .
'<select name="sex"' . (isset($error['sex']) ? ' style="background-color: #FFCCCC"' : '') . '>' .
'<option value="m"' . ($reg_sex == 'm' ? ' selected="selected"' : '') . '>Nam </i></option>' .
'<option value="zh"' . ($reg_sex == 'zh' ? ' selected="selected"' : '') . '>Nữ </i></option>' .
'<option value="?"' . ($reg_sex == '?' ? ' selected="selected"' : '') . '>Khác </i></option>' .
'</select></p>' .
'</span></div>' .
'<div class="menu">' .
'<p><b>Tên của bạn</b><br/>' .
(isset($error['imname']) ? '<span style="color:blue">Bạn chưa nhập tên của bạn</span><br />' : '') .
'<input type="text" name="imname" maxlength="30" value="' . htmlspecialchars($reg_name) . '"' . (isset($error['imname']) ? ' style="background-color: #FFCCCC"' : '') . '/><br />' .
'' .
'' .
'' .
'</div>' .
'<div class="gmenu">' .

'<p><input type="submit" name="submit" value="' . $lng_reg['registration'] . '"/></p></div></form><br>';
echo'</div>';
require('incfiles/end.php');
                            
                            
                            
                            