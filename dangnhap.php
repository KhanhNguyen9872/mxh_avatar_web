<?php
define('_IN_JOHNCMS', 1);
$rootpath = '';
$headmod = 'login';
require('incfiles/core.php');
require('incfiles/head.php');

echo'<div class="phdrbox">';
    $error = array();
    $captcha = FALSE;
    $display_form = 1;
    $user_login = isset($_POST['n']) ? functions::check($_POST['n']) : NULL;
    $user_pass = isset($_POST['p']) ? functions::check($_POST['p']) : NULL;
    $user_mem = isset($_POST['mem']) ? 1 : 0;
    $user_code = isset($_POST['code']) ? trim($_POST['code']) : NULL;
    if ($user_pass && !$user_login)
        $error[] = $lng['error_login_empty'];
    if ($user_login && !$user_pass)
        $error[] = $lng['error_empty_password'];
    if ($user_login && (mb_strlen($user_login) < 2 || mb_strlen($user_login) > 20))
        $error[] = $lng['nick'] . ': ' . $lng['error_wrong_lenght'];
    if ($user_pass && (mb_strlen($user_pass) < 3 || mb_strlen($user_pass) > 15))
        $error[] = $lng['password'] . ': ' . $lng['error_wrong_lenght'];
    if (!$error && $user_pass && $user_login) {
        // Запрос в базу на юзера
        $req = mysql_query("SELECT * FROM `users` WHERE `name_lat`='" . functions::rus_lat(mb_strtolower($user_login)) . "' LIMIT 1");
        if (mysql_num_rows($req)) {
            $user = mysql_fetch_assoc($req);
/*            if ($user['failed_login'] > 2) {
                if ($user_code) {
                    if (mb_strlen($user_code) > 3 && $user_code == $_SESSION['code']) {
                        // Если введен правильный проверочный код
                        unset($_SESSION['code']);
                        $captcha = TRUE;
                    } else {
                        // Если проверочный код указан неверно
                        unset($_SESSION['code']);
                        $error[] = $lng['error_wrong_captcha'];
                    }
                } else {
                    // Показываем CAPTCHA
                    $display_form = 0;
                    echo '<form action="login.php' . ($id ? '?id=' . $id : '') . '" method="post">' .
                        '<div class="menu"><p><img src="captcha.php?r=' . rand(1000, 9999) . '" alt="' . $lng['verifying_code'] . '"/><br />' .
                        $lng['enter_code'] . ':<br/><input type="text" size="5" maxlength="5"  name="code"/>' .
                        '<input type="hidden" name="n" value="' . $user_login . '"/>' .
                        '<input type="hidden" name="p" value="' . $user_pass . '"/>' .
                        '<input type="hidden" name="mem" value="' . $user_mem . '"/>' .
                        '<input type="submit" name="submit" value="' . $lng['continue'] . '"/></p></div></form>';
                }
            }
*/
//            if ($user['failed_login'] < 3 || $captcha) {
                if (md5(md5($user_pass)) == $user['password']) {
                    // Если логин удачный
                    $display_form = 0;
                    mysql_query("UPDATE `users` SET `failed_login` = '0' WHERE `id` = '" . $user['id'] . "'");
                    if (!$user['preg']) {
                        // Если регистрация не подтверждена
                        echo '<div class="rmenu"><p>' . $lng['registration_not_approved'] . '</p></div>';
                    } else {
                        // Если все проверки прошли удачно, подготавливаем вход на сайт
                        if (isset($_POST['mem'])) {
                            // Установка данных COOKIE
                            $cuid = base64_encode($user['id']);
                            $cups = md5($user_pass);
                            setcookie("cuid", $cuid, time() + 3600 * 24 * 365);
                            setcookie("cups", $cups, time() + 3600 * 24 * 365);
                        }
                        // Установка данных сессии
                        $_SESSION['uid'] = $user['id'];
                        $_SESSION['ups'] = md5(md5($user_pass));
                        mysql_query("UPDATE `users` SET `sestime` = '" . time() . "' WHERE `id` = '" . $user['id'] . "'");
                        $set_user = unserialize($user['set_user']);
                        if ($user['lastdate'] < (time() - 3600) && $set_user['digest'])
                            header('Location: ' . $set['homeurl'] . '/index.php?act=digest&last=' . $user['lastdate']);
                        else
                            header('Location: ' . $set['homeurl'] . '/index.php');
                        echo '<div class="gmenu"><p><b><a href="index.php?act=digest">' . $lng['enter_on_site'] . '</a></b></p></div>';
                    }
                } else {
                    // Если логин неудачный
                    if ($user['failed_login'] < 3) {
                        // Прибавляем к счетчику неудачных логинов
                        mysql_query("UPDATE `users` SET `failed_login` = '" . ($user['failed_login'] + 1) . "' WHERE `id` = '" . $user['id'] . "'");
                    }
                    $error[] = $lng['authorisation_not_passed'];
                }
//            }
        } else {
            $error[] = $lng['authorisation_not_passed'];
        }
    }
    if ($display_form) {
        if ($error)
            echo functions::display_error($error);

        $info = '';
        if (core::$system_set['site_access'] == 0 || core::$system_set['site_access'] == 1) {
            if (core::$system_set['site_access'] == 0) {
                $info = '<div class="rmenu">' . $lng['info_only_sv'] . '</div>';
            } elseif (core::$system_set['site_access'] == 1) {
                $info = '<div class="rmenu">' . $lng['info_only_adm'] . '</div>';
            }
        }

        echo $info;

echo'<div ><form action="/login.php" method="post">
<b> Tên đăng nhập: </b>
<br/>
<input
type="text" name="n"
value="" maxlength="28"
size="25">
<br/>
<b>  Mật Khẩu: </b> 
<br/>
<input type="password"
name="p" maxlength="25"
size="25">
<br/>
<input
type="hidden" name="mem"
value="1"
checked="checked"><input type="hidden" name="next" value="'.$url.'" />
<br/>
<input type="submit"  value="Đăng nhập" />


</form><br></div>';
/*echo '<div class="menu"><small><center>Sử dụng tài khoản đã đăng kí để đăng nhập</center></small><form action="dangnhap.html" method="post"><p><i class="fa fa-user"></i> Tên đăng nhập :</br> ' .
'<input type="text" name="n" value="' . htmlentities($user_login, ENT_QUOTES, 'UTF-8') . '" maxlength="20"/>' .
'<br/><i class="fa fa-lock"></i> Mật Khẩu&nbsp:&nbsp;&nbsp;</br>' .
'<input type="password" name="p" maxlength="20"/></p>' .
'nếu chưa có tài khoản thì hãy : <a href="/dangki.html">Đăng kí</a> '.
'<p><center><button name="submit">Đăng nhập</button></center></p>' .
'</form></div>';*/
}

echo'</div>';
require('incfiles/end.php');