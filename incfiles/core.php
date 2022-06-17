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
//Error_Reporting(E_ALL & ~E_NOTICE);
error_Reporting(0);
@ini_set('session.use_trans_sid', '0');
@ini_set('arg_separator.output', '&amp;');
date_default_timezone_set('UTC');
mb_internal_encoding('UTF-8');

// Корневая папка
define('ROOTPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

/*
-----------------------------------------------------------------
Автозагрузка Классов
-----------------------------------------------------------------
*/
spl_autoload_register('autoload');
function autoload($name)
{
    $file = ROOTPATH . 'incfiles/classes/' . $name . '.php';
    if (file_exists($file))
        require_once($file);
}

/*
-----------------------------------------------------------------
Инициализируем Ядро системы
-----------------------------------------------------------------
*/
new core;

/*
-----------------------------------------------------------------
Получаем системные переменные для совместимости со старыми модулями
-----------------------------------------------------------------
*/
$rootpath = ROOTPATH;
$ip = core::$ip; // Адрес IP
$agn = core::$user_agent; // User Agent
$set = core::$system_set; // Системные настройки
$lng = core::$lng; // Фразы языка
$is_mobile = core::$is_mobile; // Определение мобильного браузера
$home = $set['homeurl']; // Домашняя страница

/*
-----------------------------------------------------------------
Получаем пользовательские переменные
-----------------------------------------------------------------
*/
$user_id = core::$user_id; // Идентификатор пользователя
$rights = core::$user_rights; // Права доступа
$datauser = core::$user_data; // Все данные пользователя
$set_user = core::$user_set; // Пользовательские настройки
$ban = core::$user_ban; // Бан
$login = isset($datauser['name']) ? $datauser['name'] : false;
//$kmess = $set_user['kmess'] > 4 && $set_user['kmess'] < 100 ? $set_user['kmess'] : 10;
$kmess = $set_user['kmess'];
$kmess2 = $kmess-9;
//Fix 10 Bài
function validate_referer()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
    if (@!empty($_SERVER['HTTP_REFERER'])) {
        $ref = parse_url(@$_SERVER['HTTP_REFERER']);
        if ($_SERVER['HTTP_HOST'] === $ref['host']) return;
    }
    die('Invalid request');
}

if ($rights) {
    validate_referer();
}

/*
-----------------------------------------------------------------
Получаем и фильтруем основные переменные для системы
-----------------------------------------------------------------
*/
$id = isset($_REQUEST['id']) ? abs(intval($_REQUEST['id'])) : false;
$user = isset($_REQUEST['user']) ? abs(intval($_REQUEST['user'])) : false;
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : '';
$mod = isset($_REQUEST['mod']) ? trim($_REQUEST['mod']) : '';
$do = isset($_REQUEST['do']) ? trim($_REQUEST['do']) : false;
$page = isset($_REQUEST['page']) && $_REQUEST['page'] > 0 ? intval($_REQUEST['page']) : 1;
$start = isset($_REQUEST['page']) ? $page * $kmess - $kmess : (isset($_GET['start']) ? abs(intval($_GET['start'])) : 0);
$start2 = isset($_REQUEST['page']) ? $page * $kmess2 - $kmess2 : (isset($_GET['start']) ? abs(intval($_GET['start'])) : 0); //ADD 10 Bài 10 Trang
$headmod = isset($headmod) ? $headmod : '';

/*
-----------------------------------------------------------------
Закрытие сайта / редирект гостей на страницу ожидания
-----------------------------------------------------------------

*/
/*
-----------------------------------------------------------------
Буфферизация вывода
-----------------------------------------------------------------
*/
//Fix xss
//if(isset($_POST)&&$textl!='vnstar.me'){
//foreach($_POST as $index => $value){
//if(is_string($_POST[$index]))
//$_POST[$index]=functions::checkout($_POST[$index]);
//}
//}
//if(isset($_GET)&&$textl!='vnstar.me'){
//foreach($_GET as $index => $value){
//if(is_string($_GET[$index]))
//$_GET[$index]=functions::checkout($_GET[$index]);
//}
//}
//--End
if ($set['gzip'] && @extension_loaded('zlib')) {
    @ini_set('zlib.output_compression_level', 3);
    ob_start('ob_gzhandler');
} else {
    ob_start();
}
require_once'func.ua.php';
$agn=ua();
include 'func.php';
/*
//mod auto ban ip
$ip_ddos = ip_show();
//ban ip ddos
$ban_ip = mysql_result(mysql_query("select count(*) from `ban_ip` where `ip` = '".$ip_ddos."' and `loai` = '1'"),0);
if($ban_ip == 0){
mysql_query("INSERT INTO `ban_ip` SET `ip`='".$ip_ddos."', `loai`='1', `check`='1', `time`='".time()."'");
}else{
mysql_query("UPDATE `ban_ip` SET `check`=`check`+1 WHERE `ip`='{$ip_ddos}' and `loai`='1'");
}
//band botnet
$chuoi = explode('.', $ip_ddos);
$chuoi_ip = $chuoi[0].'.'.$chuoi[1].'.'.$chuoi[2];
$dem_chuoi = mysql_result(mysql_query("select count(*) from `ban_ip` where `ip` = '".$chuoi_ip."' and `loai` = '2'"),0);
if($dem_chuoi == 0){
mysql_query("INSERT INTO `ban_ip` SET `ip`='".$chuoi_ip."', `check`='1', `loai`='2', `time`='".time()."'");
}else{
mysql_query("UPDATE `ban_ip` SET `check`=`check`+1 WHERE `ip`='{$chuoi_ip}' and `loai`='2'");
}
//thuc thi band ip
$check_ip = mysql_fetch_assoc(mysql_query("SELECT * FROM `ban_ip` WHERE `ip`='".$ip_ddos."' and `loai`='1' LIMIT 1"));
if($check_ip['check'] >= 300){
mysql_query("UPDATE `ban_ip` SET `check`=`check`+1, `ban`='1' WHERE `ip`='{$check_ip['ip']}' and `loai`='1'");
$log_ban = '
deny from '.$ip_ddos;
$url_log = fopen("/home/zfunnytk1/public_html/.htaccess","a");
fwrite($url_log,$log_ban);
fclose($url_log);
}
$check_chuoi = mysql_fetch_assoc(mysql_query("SELECT * FROM `ban_ip` WHERE `ip`='".$chuoi_ip."' and `loai`='2' LIMIT 1"));
if($check_chuoi['check'] == 500){
mysql_query("UPDATE `ban_ip` SET `check`=`check`+1, `ban`='1' WHERE `ip`='{$check_chuoi['ip']}' and `loai`='2'");
$log_ban = '
deny from '.$chuoi_ip.'.*';
$url_log = fopen("/home/zfunnytk1/public_html/.htaccess","a");
fwrite($url_log,$log_ban);
fclose($url_log);
}
//xoa log ban
mysql_query("DELETE FROM `ban_ip` WHERE `time`<'".(time() - 10 * 60)."' and `ban`='0'");

//unclock va xoa ban
$req = mysql_query ("SELECT * FROM `ban_ip` WHERE `ban` = '1' and `time` < '".(time() - 86400)."'");
while ($uip = mysql_fetch_assoc($req)) {
$autolay = '/home/zfunnytk1/public_html/.htaccess';
$layfile = @fopen($autolay, "r");
$data = fread($layfile, filesize($autolay));
if($uip['loai'] == 1){
$xoaip = str_replace('
deny from '.$uip['ip'],'',$data);
}else{
$xoaip = str_replace('
deny from '.$uip['ip'].'.*','',$data);
}
@fclose($autolay);
file_put_contents($autolay, $xoaip);
mysql_query("DELETE FROM `ban_ip` WHERE `id` = '".$uip['id']."'");
}
*/