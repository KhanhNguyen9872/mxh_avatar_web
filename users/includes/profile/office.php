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
$textl = $lng_profile['my_office'];
require('../incfiles/head.php');

/*
-----------------------------------------------------------------
Code By Hoàng Anh
-----------------------------------------------------------------
*/


if ($user['id'] != $user_id) {
echo functions::display_error($lng['access_forbidden']);
require('../incfiles/end.php');
exit;
}

/*
-----------------------------------------------------------------
Diễn Đàn TuoiTre4u.Com
-----------------------------------------------------------------
*/
if($user['id'] == $user_id) {
}
echo '<div class="homeforum"><div class="icon-home"><div class="home">Thiết lập</div></div></div>';
echo '<div class="phdr"><b>Bản thân</b></div>';
$total_friends = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_contact` WHERE `user_id`='$user_id' AND `type`='2' AND `friends`='1'"), 0);
$new_friends = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_contact` WHERE `from_id`='$user_id' AND `type`='2' AND `friends`='0';"), 0);
$online_friends = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_contact` LEFT JOIN `users` ON `cms_contact`.`from_id`=`users`.`id` WHERE `cms_contact`.`user_id`='$user_id' AND `cms_contact`.`type`='2' AND `cms_contact`.`friends`='1' AND `lastdate` > " . (time() - 300) . ""), 0);
echo'<div class="omenu"><a href="profile.php?act=stat">' . $lng['statistics'] . '</a></div>' .
'<div><div class="omenu"><a href="profile.php?act=friends">Bạn Bè</a></div>';
if ($rights >= 1) {
$guest = counters::guestbook(2);
'<div><div class="omenu"><a href="../guestbook/index.php?act=ga&amp;do=set">' . $lng['admin_club'] . '</a> (<span class="red">' . $guest . '</span>)</div>';
}
/*
-----------------------------------------------------------------
Блок почты
-----------------------------------------------------------------
*/

//Hệ Thống
$count_systems_new = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail`
WHERE `from_id`='$user_id' AND `delete`!='$user_id' AND `sys`='1' AND `read`='0'"), 0);
echo '<div class="omenu"><a href="../mail/index.php?act=systems">Thông báo</a>';
if (empty($ban['1']) && empty($ban['3'])) {
echo '</div><div class="omenu"><a href="profile.php?act=matkhau">Đổi mật khẩu</a>';
}
// Cpanel TuoiTre4u
//Контакты
$count_contacts = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_contact`
WHERE `user_id`='" . $user_id . "' AND `ban`!='1';"), 0);
// Cpanel TuoiTre4u
$count_ignor = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_contact`
WHERE `user_id`='" . $user_id . "' AND `ban`='1';"), 0);
// Блок настроек
if ($rights >= 6)
{
echo '</div><div class="omenu"><span class="red"><a href="../' . $set['admp'] . '/index.php"><b>Admin Panel</b></a></span>';
}
echo '</div>';
?>