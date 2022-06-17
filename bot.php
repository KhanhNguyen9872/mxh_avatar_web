<?php
/**
 * @package     JohnCMSVN
 * @link        http://johncmsvn.com
 * @copyright   Copyright (C) 2014 JohnCMSVN Community
 * @license     LICENSE.txt (see attached file)
 * @version     VERSION.txt (see attached file)
 * @author      Văn Việt
 */
define('_IN_JOHNCMS', 1);
$idbot = 1;
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `bot`;"), 0);
if($total > 0) {
$req = mysql_query("SELECT * FROM `bot` ORDER BY `id` LIMIT $total");
while ($check = mysql_fetch_assoc($req)) {
for ($i=1; $i<=$total; $i++) {
$key = strtolower($check['key']);
$txtcheck = strtolower($msg);
$txt = $check['text'];
$txt1 = ($check['txt1'] ? $check['txt1'] : $txt);
$txt2 = ($check['txt2'] ? $check['txt2'] : $txt);
$txt3 = ($check['txt3'] ? $check['txt3'] : $txt);
$txt4 = ($check['txt4'] ? $check['txt4'] : $txt);
$txt5 = ($check['txt5'] ? $check['txt5'] : $txt);
$list = array($txt, $txt1, $txt2, $txt3, $txt4, $txt5);
$rtxt = rand(0, 5);
if(preg_match('|'.$key.'|', $txtcheck)) {
$bot = $list[$rtxt];
}
}
}
$bot = str_replace('{user}', $login, $bot);
$bot = str_replace('{text}', $msg, $bot);
$bot = str_replace('{reply}', '[quote='.$login.']'.$msg.'[/quote]', $bot);
$time = time()+5;
if($bot) {
mysql_query("INSERT INTO `guest` SET
`adm` = '$admset',
`time` = '$time',
`user_id` = '2',
`name` = 'BOT',
`text` = '" . mysql_real_escape_string($bot) . "',
`ip` = '000000',
`browser` = 'BOT 3G'
");
}
}
?>
