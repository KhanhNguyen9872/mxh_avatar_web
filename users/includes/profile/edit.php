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

$textl = htmlspecialchars($user['name']) . ': ' . $lng_profile['profile_edit'];
require('../incfiles/head.php');

/*
-----------------------------------------------------------------
Code powerby ID Thiên Ân
-----------------------------------------------------------------
*/
if ($user['id'] != $user_id && ($rights < 7 || $user['rights'] > $rights)) {
echo functions::display_error($lng_profile['error_rights']);
require('../incfiles/end.php');
exit;
}

/*
-----------------------------------------------------------------
Code powerby ID Thiên Ân
-----------------------------------------------------------------
*/
if ($rights >= 7 && $rights > $user['rights'] && $act == 'reset') {
mysql_query("UPDATE `users` SET `set_user` = '', `set_forum` = '', `set_chat` = '' WHERE `id` = '" . $user['id'] . "'");
echo '<div class="gmenu"><p>' . $lng['settings_default'] . '<br /><a href="profile.php?user=' . $user['id'] . '">' . $lng['to_form'] . '</a></p></div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="phdr">Chỉnh sửa hồ sơ</div>';
echo'<div class="phdrbox">';
if (isset($_GET['delavatar'])) {
/*
-----------------------------------------------------------------
ID Thiên Ân - Developer By Hoàng Anh Nhen!
-----------------------------------------------------------------
*/
@unlink('../avatar/' . $user['id'] . '.png');
echo '<div class="rmenu">' . $lng_profile['avatar_deleted'] . '</div>';
} elseif (isset($_GET['delphoto'])) {
/*
-----------------------------------------------------------------
Pháº§n link áº£nh by HoÃ ng Anh
-----------------------------------------------------------------
*/
@unlink('../files/users/photo/' . $user['id'] . '.jpg');
@unlink('../files/users/photo/' . $user['id'] . '_small.jpg');
echo '<div class="rmenu">' . $lng_profile['photo_deleted'] . '</div>';
} elseif (isset($_POST['submit'])) {


$error = array ();
$user['imname'] = isset($_POST['imname']) ? functions::check(mb_substr($_POST['imname'], 0, 25)) : '';
$user['vip'] = isset($_POST['vip']) ? functions::check(mb_substr($_POST['vip'], 0, 500)) : '';
$user['name'] = isset($_POST['name']) ? functions::check(mb_substr($_POST['name'], 0, 500)) : '';
$user['live'] = isset($_POST['live']) ? functions::check(mb_substr($_POST['live'], 0, 500)) : '';
$user['dayb'] = isset($_POST['dayb']) ? intval($_POST['dayb']) : 0;
$user['monthb'] = isset($_POST['monthb']) ? intval($_POST['monthb']) : 0;
$user['yearofbirth'] = isset($_POST['yearofbirth']) ? intval($_POST['yearofbirth']) : 0;
$user['about'] = isset($_POST['about']) ? functions::check(mb_substr($_POST['about'], 0, 500)) : '';
$user['mail'] = isset($_POST['mail']) ? functions::check(mb_substr($_POST['mail'], 0, 40)) : '';
$user['mailvis'] = isset($_POST['mailvis']) ? 1 : 0;
$user['icq'] = isset($_POST['icq']) ? intval($_POST['icq']) : 0;
$user['skype'] = isset($_POST['skype']) ? functions::check(mb_substr($_POST['skype'], 0, 40)) : '';
$user['jabber'] = isset($_POST['jabber']) ? functions::check(mb_substr($_POST['jabber'], 0, 40)) : '';
$user['www'] = isset($_POST['www']) ? functions::check(mb_substr($_POST['www'], 0, 40)) : '';
// //
$user['name'] = isset($_POST['name']) ? functions::check(mb_substr($_POST['name'], 0, 20)) : $user['name'];
$user['xu'] = isset($_POST['xu']) ? functions::check(mb_substr($_POST['xu'], 0, 500)) : '';
$user['vnd'] = isset($_POST['vnd']) ? functions::check(mb_substr($_POST['vnd'], 0, 500)) : '';
$user['live'] = isset($_POST['live']) ? functions::check(mb_substr($_POST['live'], 0, 500)) : '';
$user['dayb'] = isset($_POST['dayb']) ? functions::check(mb_substr($_POST['dayb'], 0, 500)) : '';
$user['monthb'] = isset($_POST['monthb']) ? functions::check(mb_substr($_POST['monthb'], 0, 500)) : '';
$user['yearofbirth'] = isset($_POST['yearofbirth']) ? functions::check(mb_substr($_POST['yearofbirth'], 0, 500)) : '';
$user['about'] = isset($_POST['about']) ? functions::check(mb_substr($_POST['about'], 0, 500)) : '';
$user['mail'] = isset($_POST['mail']) ? functions::check(mb_substr($_POST['mail'], 0, 500)) : '';
$user['icq'] = isset($_POST['icq']) ? functions::check(mb_substr($_POST['icq'], 0, 500)) : '';
$user['skype'] = isset($_POST['skype']) ? functions::check(mb_substr($_POST['skype'], 0, 500)) : '';
$user['jabber'] = isset($_POST['jabber']) ? functions::check(mb_substr($_POST['jabber'], 0, 500)) : '';
$user['karma_off'] = isset($_POST['karma_off']);
$user['sex'] = isset($_POST['sex']) && $_POST['sex'] == 'm' ? 'm' : 'zh';
$user['rights'] = isset($_POST['rights']) ? abs(intval($_POST['rights'])) : $user['rights'];
// HoÃ ng Anh
if($user['rights'] > $rights || $user['rights'] > 9 || $user['rights'] < 0)
$user['rights'] == 0;
if ($rights >= 9) {
if (mb_strlen($user['name']) < 2 || mb_strlen($user['name']) > 20)
$error[] = $lng_profile['error_nick_lenght'];
$lat_nick = functions::rus_lat(mb_strtolower($user['name']));
if (preg_match("/[^0-9a-z\-\.\*\(\)\ \!\~\_\=\[\]] /", $lat_nick))
$error[] = $lng_profile['error_nick_symbols'];
}
if ($user['dayb'] || $user['monthb'] || $user['yearofbirth']) {
if ($user['dayb'] < 1 || $user['dayb'] > 31 || $user['monthb'] < 1 || $user['monthb'] > 12)
$error[] = $lng_profile['error_birth'];
}
if ($user['icq'] && ($user['icq'] < 10000 || $user['icq'] > 999999999))
$error[] = $lng_profile['error_icq'];
if ($rights >=0) {
mysql_query("UPDATE `users` SET
`imname` = '" . $user['imname'] . "',
`live` = '" . $user['live'] . "',
`dayb` = '" . $user['dayb'] . "',
`monthb` = '" . $user['monthb'] . "',
`yearofbirth` = '" . $user['yearofbirth'] . "',
`about` = '" . $user['about'] . "',
`mail` = '" . $user['mail'] . "',
`mailvis` = '" . $user['mailvis'] . "',
`icq` = '" . $user['icq'] . "',
`sex` = '" . $user['sex'] . "',
`skype` = '" . $user['skype'] . "',
`jabber` = '" . $user['jabber'] . "',
`www` = '" . $user['www'] . "'
WHERE `id` = '" . $user['id'] . "'
");
if ($rights >= 9) {
mysql_query("UPDATE `users` SET
`name` = '" . $user['name'] . "',
`vip` = '" . $user['vip'] . "',
`xu` = '" . $user['xu'] . "', 
`vnd` = '" . $user['vnd'] . "',
 `karma_off` = '" . $user['karma_off'] . "',
`sex` = '" . $user['sex'] . "',
`rights` = '" . $user['rights'] . "'
WHERE `id` = '" . $user['id'] . "'
");
}
}
header('Location: /member/' . $user['id'].'.html');
}

/*
-----------------------------------------------------------------
Developer By ID Thiên Ân - ? => fb.com/idthienan
-----------------------------------------------------------------
*/
echo '<div class="lucifer"><form action="/member/edit-' . $user['id'] . '.html" method="post">';
echo '<center>';
$link = '';
echo '<img id="avatar-tron" src="../avatar/' . $user['id'] . '.png" width="45" height="48" alt="' . $user['from'] . '"/>';
echo '</center>' .
'<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td >ID tài khoản</td>
<td class="right-info"><span>' . $user['id'] . '</span></td>
</tr>

<tr>
<td >Tên nick</td>
<td ><span>' . $user['name'] . '</span></td>
</tr>
<tr>
<td >Tên thật</td>
<td class="right-info"><span><input type="text" value="' . $user['imname'] . '" name="imname" /></span></td>
</tr>
<tr>
<td >Giới tính</td>
<td ><span><select name="sex"' . $lng_profile['specify_sex'] . '>
<option value="m"' . ($user['sex'] == 'm' ? 'selected="selected"' : '') . '/>' . $lng_profile['sex_m'] . '</option>
<option value="zh"' . ($user['sex'] == 'zh' ? 'selected="selected"' : '') . '/>' . $lng_profile['sex_w'] . '</option>
</select></p></td>
</tr>
<tr>
<td >Năm sinh</td>
<td class="right-info"><span><input type="text" value="'.$user['dayb'].'" size="2" maxlength="2" name="dayb" /> <input type="text" value="'.$user['monthb'].'" size="2" maxlength="2" name="monthb" /> <input type="text" value="'.$user['yearofbirth'].'" size="4" maxlength="4" name="yearofbirth" /></span></td>
</tr>
<tr>
<td >Tỉnh thành</td>
<td class="right-info"><span><input type="text" value="' . $user['live'] . '" name="live" /></span></td>
</tr>
<tr>
<td >Sở thích</td>
<td class="right-info"><span><textarea rows="' . $set_user['field_h'] . '" name="about">' . $user['about'] . '</textarea></span></td>
</tr>
<tr>
<td >Email</td>
<td class="right-info"><span><input type="text" value="' . $user['mail'] . '" name="mail" /></span></td>
</tr>




</table><div><div><div><div>


';
// Phần BQT
if ($datauser['rights'] >= 9) {
echo '' .
'
<tr>
<td >Chỉnh tên nick tài khoản</td>
<td class="right-info"><span><input type="text" value="' . $user['name'] . '" name="name" /></span></span></td>
</tr>
<tr>
<td >Chỉnh xu tài khoản</td>
<td class="right-info"><span><input type="text" value="' . $user['xu'] . '" name="xu" /></span></span></td>
</tr>
<tr>
<td >Chỉnh VNĐ tài khoản</td>
<td class="right-info"><span><input type="text" value="' . $user['vnd'] . '" name="vnd" /></span></span></td>
</tr>
<tr>
<td >Chỉnh Xem box MOD</td>
<td class="right-info"><span><input type="text" value="' . $user['vip'] . '" name="vip" /></span></span></td>
</tr>
</td></tr></table>';
if ($user['id'] != $user_id) {
echo '</center>' .
'<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">
<tr>
<td class="left-info">Chức vụ MXH</td>
<td class="right-info"><span><select name="rights"' . $lng_profile['specify_rights'] . '>
<option value="0"' . ($user['rights'] == '0' ? 'selected="selected"' : '') . '/>Member</option>
<option value="3"' . ($user['rights'] == '3' ? 'selected="selected"' : '') . '/>Fmod</option>
<option value="6"' . ($user['rights'] == '6' ? 'selected="selected"' : '') . '/>Smod</option>
<option value="7"' . ($user['rights'] == '7' ? 'selected="selected"' : '') . '/>Admin</option>
</select></p></td>
</tr>
</td></tr></table>';
}
}
echo '<br><center><input type="submit" value="Cập nhật" name="submit" class="nut" /> - <a href="/member/pass-'.$user[id].'.html"><input type="button" value="Đổi mật khẩu" class="nut"></a>'.(!empty($datauser['password_2']) ? ' - <a href="/member/pass_2-'.$user[id].'.html"><input type="button" value="Đổi mật khẩu cấp 2" class="nut"></a>' : '').'</center>' .
'</form></div> <div>          <div>         

';

if ($datauser['rights'] <= 1) {
echo '</div></div></div></div>'; }


?>
         
                     
                     
                   