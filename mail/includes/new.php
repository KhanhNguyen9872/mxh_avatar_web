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
$textl = $lng['mail'];
require_once('../incfiles/head.php');
echo '<div class="homeforum"><div class="icon-home"><div class="home">Tin nhắn</div></div></div>';
echo '<div class="phdr">Tin nhắn mới</div>';
echo '<div class="omenu">';
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM (SELECT DISTINCT `user_id` FROM `cms_mail` WHERE `from_id`='$user_id' AND `read`='0' AND `spam`='0') a;"), 0);
if($total == 1) {
    //Если все новые сообщения от одного итого же чела показываем сразу переписку
    $max = mysql_result(mysql_query("SELECT `user_id`, count(*) FROM `cms_mail` WHERE `from_id`='$user_id' AND `read`='0' AND `spam`='0' GROUP BY `user_id`"), 0);
    Header('Location: /mail/'.$max);
    echo '</div>';
    exit();
}
if($total) {
	if($total > $kmess) echo '<div class="phdr">' . functions::display_pagination('index.php?act=new&amp;page=', $start, $total, $kmess) . '</div>';
	//Групируем по контактам
	$query = mysql_query("SELECT `users`.* FROM `cms_mail`
		LEFT JOIN `users` ON `cms_mail`.`user_id`=`users`.`id`
		LEFT JOIN `cms_contact` ON `cms_mail`.`user_id`=`cms_contact`.`user_id`
		WHERE `cms_mail`.`from_id`='" . $user_id . "' AND `cms_mail`.`read`='0' AND `cms_mail`.`spam`='0' GROUP BY `cms_mail`.`user_id` ORDER BY `cms_contact`.`time` DESC LIMIT " . $start . "," . $kmess
    );
	for ($i = 0; ($row = mysql_fetch_assoc($query)) !== false; ++$i) {
		echo $i % 2 ? '<div class="omenu">' : '<div class="omenu">';
		$subtext = '<a href="/mail/' . $row['id'] . '">' . $lng_mail['correspondence'] . '</a> | <a href="index.php?act=deluser&amp;id=' . $row['id'] . '">' . $lng['delete'] . '</a> | <a href="index.php?act=ignor&amp;id=' . $row['id'] . '&amp;add">' . $lng_mail['ban_contact'] . '</a>';
		$count_message = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` WHERE ((`user_id`='{$row['id']}' AND `from_id`='$user_id') OR (`user_id`='$user_id' AND `from_id`='{$row['id']}')) AND `delete`!='$user_id' AND `spam`='0';"), 0);
		$new_count_message = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` WHERE `cms_mail`.`user_id`='{$row['id']}' AND `cms_mail`.`from_id`='$user_id' AND `read`='0' AND `delete`!='$user_id' AND `spam`='0';"), 0);
		$arg = array(
		'header' => '('.$count_message. ($new_count_message ? '/<span class="red">+' . $new_count_message . '</span>' : '') . ')',
		'sub' => $subtext
		);
		echo functions::display_user($row, $arg);
		echo '</div>';
	}
} else {
	echo '<div class="omenu"><b>' . $lng['list_empty'] . '</b></div>';
}
if ($total > $kmess) {
    echo '<div class="phdr">' . functions::display_pagination('index.php?act=new&amp;page=', $start, $total, $kmess) . '</div>';
}
echo '</div>';
$count_input = mysql_result(mysql_query("
	SELECT COUNT(*) 
	FROM `cms_mail` 
	LEFT JOIN `cms_contact` 
	ON `cms_mail`.`user_id`=`cms_contact`.`from_id` 
	AND `cms_contact`.`user_id`='$user_id' 
	WHERE `cms_mail`.`from_id`='$user_id' 
	AND `cms_mail`.`sys`='0' AND `cms_mail`.`delete`!='$user_id' 
	AND `cms_contact`.`ban`!='1' AND `spam`='0'"), 0);
echo '<div class="phdr">Hộp thư cá nhân</div>';
echo '<div class="phdrbox">';
echo '<div class="omenu">';
echo '<a href="/mail/thu-den.html"><img src="/mail/images/tinnhanden.png"/><font color="003366"> Hộp thư đến</font></a>';
echo '</div>';
$count_output = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` LEFT JOIN `cms_contact` ON `cms_mail`.`from_id`=`cms_contact`.`from_id` AND `cms_contact`.`user_id`='$user_id' 
WHERE `cms_mail`.`user_id`='$user_id' AND `cms_mail`.`delete`!='$user_id' AND `cms_mail`.`sys`='0' AND `cms_contact`.`ban`!='1'"), 0);
echo '<div class="omenu"><a href="/mail/thu-di.html"><img src="/mail/images/tinnhan.png"/> <font color="003366">Hộp thư đi</font></a>';
echo '</div>';
echo '</div>';