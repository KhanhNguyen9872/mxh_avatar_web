<?php
/*
$ip = $_SERVER['REMOTE_ADDR'];
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
if($query && $query['status'] == 'success' && $query['countryCode'] != 'VN') {
  header('Locaation: http://google.com');
  exit;
}
*/
session_start();

$back = $_SERVER['HTTP_REFERER'];
if (empty($back))
{
 if($_SESSION['last_session_request'] > (time() - 5)){
    if(empty($_SESSION['last_request_count'])){
        $_SESSION['last_request_count'] = 1;
    }elseif($_SESSION['last_request_count'] < 5){
        $_SESSION['last_request_count'] = $_SESSION['last_request_count'] + 1;
    }elseif($_SESSION['last_request_count'] >= 5){
            header('Locaation: http://google.com');
            exit;
         }
 }else{
    $_SESSION['last_request_count'] = 1;
 }

$_SESSION['last_session_request'] = time();
}
if(isset($_SESSION['firewall']) && $_SESSION['firewall'] == 'no'){
$_SESSION['firewall'] = 'ok';
header('Locaation: http://google.com');
exit;
}
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

if(!isMobile()){
    // Do something for only mobile users

if($_SESSION['firewall']!='ok'){
include_once('/home4/cutelover/public_html/firewall.php');
?>
<script type="text/javascript">
  function showLoading(){
	document.getElementById('btnSubmit1').style.display='none';
	document.getElementById('btnSubmit2').style.display='inline-block';
	document.getElementById('loading').style.display='block';
	return true;
  }
</script>
<?php
exit('<!DOCTYPE html>
		<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Xác nhận truy cập - Firewall</title>
<meta name="HandheldFriendly" content="true" /> 
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" /> 
<link rel="stylesheet" href="/giaodien/firewall.css" type="text/css" />
</head>
	<body><div class="container">
		<form method="POST" action="/panel/ddos.php" onsubmit="showLoading();">
		<div class="knight"></div>
		<div class="dvbtn">
			<input class="btn btn-red" type="submit" id="btnSubmit1" name="submit" value="Click vào đây để tiếp tục">
			<button class="btn btn-gray" type="button" id="btnSubmit2" style="display: none;">Đang chuyển trang, vui lòng đợi...</button>
		</div>
		</form>
		<div class="loading" id="loading" style="display: none;">
			<div id="fadingBarsG">
				<div id="fadingBarsG_1" class="fadingBarsG">
				</div>
				<div id="fadingBarsG_2" class="fadingBarsG">
				</div>
				<div id="fadingBarsG_3" class="fadingBarsG">
				</div>
				<div id="fadingBarsG_4" class="fadingBarsG">
				</div>
				<div id="fadingBarsG_5" class="fadingBarsG">
				</div>
				<div id="fadingBarsG_6" class="fadingBarsG">
				</div>
				<div id="fadingBarsG_7" class="fadingBarsG">
				</div>
				<div id="fadingBarsG_8" class="fadingBarsG">
				</div>
			</div>
		</div>
	</div></body></html>');
}
}

defined('_IN_JOHNCMS') or die('Restricted access');

class core
{
    public static $root = '../';
    public static $ip; // Путь к корневой папке
    public static $ip_via_proxy = 0; // IP адрес за прокси-сервером
    public static $ip_count = array(); // Счетчик обращений с IP адреса
    public static $user_agent; // User Agent
    public static $system_set; // Системные настройки
    public static $lng_iso = 'vn'; // Двухбуквенный ISO код языка
    public static $lng_list = array(); // Список имеющихся языков
    public static $lng = array(); // Массив с фразами языка
    public static $deny_registration = FALSE; // Запрет регистрации пользователей
    public static $is_mobile = FALSE; // Мобильный браузер
    public static $core_errors = array(); // Ошибки ядра

    public static $user_id = FALSE; // Идентификатор пользователя
    public static $user_rights = 0; // Права доступа
    public static $user_data = array(); // Все данные пользователя
    public static $user_set = array(); // Пользовательские настройки
    public static $user_ban = array(); // Бан

    private $flood_chk = 1; // Включение - выключение функции IP антифлуда
    private $flood_interval = '120'; // Интервал времени в секундах
    private $flood_limit = '1000'; // Число разрешенных запросов за интервал

    function __construct()
    {
        // Получаем IP адреса
      $ip = '127.0.0.1';($_SERVER['REMOTE_ADDR']) or die('Invalid IP');
        self::$ip = sprintf("%u", $ip);

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $vars)) {
            foreach ($vars[0] AS $var) {
                $ip_via_proxy = ip2long($var);
                if ($ip_via_proxy && $ip_via_proxy != $ip && !preg_match('#^(10|172\.16|192\.168)\.#', $var)) {
                    self::$ip_via_proxy = sprintf("%u", $ip_via_proxy);
                    break;
                }
            }
        }

        // Получаем UserAgent
        if (isset($_SERVER["HTTP_X_OPERAMINI_PHONE_UA"]) && strlen(trim($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])) > 5) {
            self::$user_agent = 'Opera Mini: ' . htmlspecialchars(mb_substr(trim($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']), 0, 150));
        } elseif (isset($_SERVER['HTTP_USER_AGENT'])) {
            self::$user_agent = htmlspecialchars(mb_substr(trim($_SERVER['HTTP_USER_AGENT']), 0, 150));
        } else {
            self::$user_agent = 'Not Recognised';
        }

        $this->ip_flood(); // Проверка адреса IP на флуд
        if (get_magic_quotes_gpc()) $this->del_slashes(); // Удаляем слэши
        $this->db_connect(); // Соединяемся с базой данных
        $this->ip_ban(); // Проверяем адрес IP на бан
        $this->session_start(); // Стартуем сессию
        self::$is_mobile = $this->mobile_detect(); // Определение мобильного браузера
        $this->system_settings(); // Получаем системные настройки
        $this->auto_clean(); // Автоочистка системы
        $this->authorize(); // Авторизация пользователей
        $this->site_access(); // Доступ к сайту
        $this->lng_detect(); // Определяем язык системы
        self::$lng = self::load_lng(); // Загружаем язык
        // Оставляем транслит только для Русского
        if (self::$lng_iso != 'ru' && self::$lng_iso != 'uk') self::$user_set['translit'] = 0;
    }

    /*
    -----------------------------------------------------------------
    Валидация IP адреса
    -----------------------------------------------------------------
    */
    public static function ip_valid($ip)
    {
        if (preg_match('#^(?:(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?:\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$#', $ip)) {
            return TRUE;
        }
        return FALSE;
    }

    /*
    -----------------------------------------------------------------
    Загружаем фразы языка из файла
    -----------------------------------------------------------------
    */
    public static function load_lng($module = '_core')
    {
        if (!is_dir(ROOTPATH . 'incfiles/languages/' . self::$lng_iso)) self::$lng_iso = 'vn';
        $lng_file = ROOTPATH . 'incfiles/languages/' . self::$lng_iso . '/' . $module . '.lng';
        $lng_file_edit = ROOTPATH . 'files/lng_edit/' . self::$lng_iso . '_iso.lng';
        if (file_exists($lng_file)) {
            $out = parse_ini_file($lng_file) or die('ERROR: language file');
            if (file_exists($lng_file_edit)) {
                $lng_edit = parse_ini_file($lng_file_edit, TRUE);
                if (isset($lng_edit[$module])) {
                    $lng_module = array_diff_key($out, $lng_edit[$module]);
                    $out = $lng_module + $lng_edit[$module];
                }
            }
            return $out;
        }
        self::$core_errors[] = 'Language file <b>' . $module . '.lng</b> is missing';
        return FALSE;
    }

    /*
    -----------------------------------------------------------------
    Показываем ошибки ядра (если есть)
    -----------------------------------------------------------------
    */
    public static function display_core_errors()
    {
        return !empty(self::$core_errors) ? '<p style="color:#FF0000"><b>CORE ERROR</b>: ' . implode('<br />', self::$core_errors) . '</p>' : '';
    }

    /*
    -----------------------------------------------------------------
    Подключаемся к базе данных
    -----------------------------------------------------------------
    */
    private function db_connect()
    {
        require(ROOTPATH . 'incfiles/shell/c50.php');
        $db_host = isset($db_host) ? $db_host : 'localhost';
        $db_user = isset($db_user) ? $db_user : '';
        $db_pass = isset($db_pass) ? $db_pass : '';
        $db_name = isset($db_name) ? $db_name : '';
        $connect = @mysql_connect($db_host, $db_user, $db_pass) or die('Error: cannot connect to database server');
        @mysql_select_db($db_name) or die('Error: specified database does not exist');
        @mysql_query("SET NAMES 'utf8'", $connect);
    }

    /*
    -----------------------------------------------------------------
    Проверка адреса IP на флуд
    -----------------------------------------------------------------
    */
    private function ip_flood()
    {
        if ($this->flood_chk) {
            //if ($this->ip_whitelist(self::$ip))
            //    return true;
            $file = ROOTPATH . 'files/cache/ip_flood.dat';
            $tmp = array();
            $requests = 1;
            if (!file_exists($file)) $in = fopen($file, "w+");
            else $in = fopen($file, "r+");
            flock($in, LOCK_EX) or die("Cannot flock ANTIFLOOD file.");
            $now = time();
            while ($block = fread($in, 8)) {
                $arr = unpack("Lip/Ltime", $block);
                if (($now - $arr['time']) > $this->flood_interval) continue;
                if ($arr['ip'] == self::$ip) $requests++;
                $tmp[] = $arr;
                self::$ip_count[] = $arr['ip'];
            }
            fseek($in, 0);
            ftruncate($in, 0);
            for ($i = 0; $i < count($tmp); $i++) fwrite($in, pack('LL', $tmp[$i]['ip'], $tmp[$i]['time']));
            fwrite($in, pack('LL', self::$ip, $now));
            fclose($in);
            if ($requests > $this->flood_limit){
                die('FLOOD: exceeded limit of allowed requests');
            }
        }
    }

    /*
    -----------------------------------------------------------------
    Обрабатываем "белый" список IP адресов
    -----------------------------------------------------------------
    */
    private function ip_whitelist($ip)
    {
        $file = ROOTPATH . 'files/cache/ip_wlist.dat';
        if (file_exists($file)) {
            foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $val) {
                $tmp = explode(':', $val);
                if (!$tmp[1]) $tmp[1] = $tmp[0];
                if ($ip >= $tmp[0] && $ip <= $tmp[1]) return TRUE;
            }
        }
        return FALSE;
    }

    /*
    -----------------------------------------------------------------
    Удаляем слэши из глобальных переменных
    -----------------------------------------------------------------
    */
    private function del_slashes()
    {
        $in = array(
            &$_GET,
            &$_POST,
            &$_COOKIE
        );
        while ((list($k, $v) = each($in)) !== FALSE) {
            foreach ($v as $key => $val) {
                if (!is_array($val)) {
                    $in[$k][$key] = stripslashes($val);
                    continue;
                }
                $in[] = & $in[$k][$key];
            }
        }
        unset($in);
        if (!empty($_FILES)) foreach ($_FILES as $k => $v) $_FILES[$k]['name'] = stripslashes((string)$v['name']);
    }

    /*
    -----------------------------------------------------------------
    Проверяем адрес IP на Бан
    -----------------------------------------------------------------
    */
    private function ip_ban()
    {
        $req = mysql_query("SELECT `ban_type`, `link` FROM `cms_ban_ip`
            WHERE '" . self::$ip . "' BETWEEN `ip1` AND `ip2`
            " . (self::$ip_via_proxy ? " OR '" . self::$ip_via_proxy . "' BETWEEN `ip1` AND `ip2`" : "") . "
            LIMIT 1
        ") or die('Error: table "cms_ban_ip"');
        if (mysql_num_rows($req)) {
            $res = mysql_fetch_array($req);
            switch ($res['ban_type']) {
                case 2:
                    if (!empty($res['link'])) header('Location: ' . $res['link']);
                    else header('Location: http://8vui.top');
                    exit;
                    break;
                case 3:
                    self::$deny_registration = TRUE;
                    break;
                default :
                    header("HTTP/1.0 404 Not Found");
                    exit;
            }
        }
    }

    /*
    -----------------------------------------------------------------
    Стартуем Сессию
    -----------------------------------------------------------------
    */
    private function session_start()
    {
        session_name('SESID');
        @session_start();
    }

    /*
    -----------------------------------------------------------------
    Получаем системные настройки
    -----------------------------------------------------------------
    */
    private function system_settings()
    {
        $set = array();
        $req = mysql_query("SELECT * FROM `cms_settings`");
        while (($res = mysql_fetch_row($req)) !== FALSE) $set[$res[0]] = $res[1];
        if (isset($set['lng']) && !empty($set['lng'])) self::$lng_iso = $set['lng'];
        if (isset($set['lng_list'])) self::$lng_list = unserialize($set['lng_list']);
        self::$system_set = $set;
    }

    /*
    -----------------------------------------------------------------
    Определяем язык
    -----------------------------------------------------------------
    */
    private function lng_detect()
    {
        $setlng = isset($_POST['setlng']) ? substr(trim($_POST['setlng']), 0, 2) : '';
        if (!empty($setlng) && array_key_exists($setlng, self::$lng_list)) $_SESSION['lng'] = $setlng;
        if (isset($_SESSION['lng']) && array_key_exists($_SESSION['lng'], self::$lng_list)) self::$lng_iso = $_SESSION['lng'];
        elseif (self::$user_id && isset(self::$user_set['lng']) && array_key_exists(self::$user_set['lng'], self::$lng_list)) self::$lng_iso = self::$user_set['lng']; elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $accept = explode(',', strtolower(trim($_SERVER['HTTP_ACCEPT_LANGUAGE'])));
            foreach ($accept as $var) {
                $lng = substr($var, 0, 2);
                if (array_key_exists($lng, self::$lng_list)) {
                    self::$lng_iso = $lng;
                    break;
                }
            }
        }
    }

    /*
    -----------------------------------------------------------------
    Авторизация пользователя и получение его данных из базы
    -----------------------------------------------------------------
    */
    private function authorize()
    {
        $user_id = FALSE;
        $user_ps = FALSE;
        if (isset($_SESSION['uid']) && isset($_SESSION['ups'])) {
            // Авторизация по сессии
            $user_id = abs(intval($_SESSION['uid']));
            $user_ps = $_SESSION['ups'];
        } elseif (isset($_COOKIE['cuid']) && isset($_COOKIE['cups'])) {
            // Авторизация по COOKIE
            $user_id = abs(intval(base64_decode(trim($_COOKIE['cuid']))));
            $_SESSION['uid'] = $user_id;
            $user_ps = md5(trim($_COOKIE['cups']));
            $_SESSION['ups'] = $user_ps;
        }
        if ($user_id && $user_ps) {
            $req = mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id'");
            if (mysql_num_rows($req)) {
                $user_data = mysql_fetch_assoc($req);
                $permit = $user_data['failed_login'] < 3 || $user_data['failed_login'] > 2 && $user_data['ip'] == self::$ip && $user_data['browser'] == self::$user_agent ? TRUE : FALSE;
                if ($permit && $user_ps === $user_data['password']) {
                    // Если авторизация прошла успешно
                    self::$user_id = $user_data['preg'] ? $user_id : FALSE;
                    self::$user_rights = $user_data['rights'];
                    self::$user_data = $user_data;
                    self::$user_set = !empty($user_data['set_user']) ? unserialize($user_data['set_user']) : $this->user_setings_default();
                    $this->user_ip_history();
                    $this->user_ban_check();
                } else {
                    // Если авторизация не прошла
                    mysql_query("UPDATE `users` SET `failed_login` = '" . ($user_data['failed_login'] + 1) . "' WHERE `id` = '" . $user_data['id'] . "'");
                    $this->user_unset();
                }
            } else {
                // Если пользователь не существует
                $this->user_unset();
            }
        } else {
            // Для неавторизованных, загружаем настройки по-умолчанию
            self::$user_set = $this->user_setings_default();
        }
    }

    /*
    -----------------------------------------------------------------
    Проверка пользователя на Бан
    -----------------------------------------------------------------
    */
    private function user_ban_check()
    {
        $req = mysql_query("SELECT * FROM `cms_ban_users` WHERE `user_id` = '" . self::$user_id . "' AND `ban_time` > '" . time() . "'");
        if (mysql_num_rows($req)) {
            self::$user_rights = 0;
            while (($res = mysql_fetch_row($req)) !== FALSE) self::$user_ban[$res[4]] = 1;
        }
    }

    /*
    -----------------------------------------------------------------
    Фиксация истории IP адресов пользователя
    -----------------------------------------------------------------
    */
    private function user_ip_history()
    {
        if (self::$user_data['ip'] != self::$ip || self::$user_data['ip_via_proxy'] != self::$ip_via_proxy) {
            // Удаляем из истории текущий адрес (если есть)
            @mysql_query("DELETE FROM `cms_users_iphistory`
                WHERE `user_id` = '" . self::$user_id . "'
                AND `ip` = '" . self::$ip . "'
                AND `ip_via_proxy` = '" . self::$ip_via_proxy . "'
                LIMIT 1
            ");
            if (!empty(self::$user_data['ip']) && self::ip_valid(long2ip(self::$user_data['ip']))) {
                // Вставляем в историю предыдущий адрес IP
                mysql_query("INSERT INTO `cms_users_iphistory` SET
                    `user_id` = '" . self::$user_id . "',
                    `ip` = '" . self::$user_data['ip'] . "',
                    `ip_via_proxy` = '" . self::$user_data['ip_via_proxy'] . "',
                    `time` = '" . self::$user_data['lastdate'] . "'
                ");
            }
            // Обновляем текущий адрес в таблице `users`
            mysql_query("UPDATE `users` SET
                `ip` = '" . self::$ip . "',
                `ip_via_proxy` = '" . self::$ip_via_proxy . "'
                WHERE `id` = '" . self::$user_id . "'
            ");
        }
    }

    /*
    -----------------------------------------------------------------
    Пользовательские настройки по умолчанию
    -----------------------------------------------------------------
    */
    private function user_setings_default()
    {
        return array(
            'avatar'     => 1, // Показывать аватары
            'digest'     => 0, // Показывать Дайджест
            'direct_url' => 0, // Внешние ссылки
            'field_h'    => 3, // Высота текстового поля ввода
            'field_w'    => (self::$is_mobile ? 20 : 40), // Ширина текстового поля ввода
            'kmess'      => 10, // Число сообщений на страницу
            'quick_go'   => 1, // Быстрый переход
            'timeshift'  => 0, // Временной сдвиг
            'skin'       => self::$system_set['skindef'], // Тема оформления
            'smileys'    => 1, // Включить(1) выключить(0) смайлы
            'translit'   => 0 // Транслит
        );
    }

    /*
    -----------------------------------------------------------------
    Уничтожаем данные авторизации юзера
    -----------------------------------------------------------------
    */
    private function user_unset()
    {
        self::$user_id = FALSE;
        self::$user_rights = 0;
        self::$user_set = $this->user_setings_default();
        self::$user_data = array();
        unset($_SESSION['uid']);
        unset($_SESSION['ups']);
        setcookie('cuid', '');
        setcookie('cups', '');
    }

    /*
    -----------------------------------------------------------------
    Автоочистка системы
    -----------------------------------------------------------------
    */
    private function auto_clean()
    {
        if (self::$system_set['clean_time'] < time() - 86400) {
            mysql_query("DELETE FROM `cms_sessions` WHERE `lastdate` < '" . (time() - 86400) . "'");
            mysql_query("DELETE FROM `cms_users_iphistory` WHERE `time` < '" . (time() - 2592000) . "'");
            mysql_query("UPDATE `cms_settings` SET  `val` = '" . time() . "' WHERE `key` = 'clean_time' LIMIT 1");
            mysql_query("OPTIMIZE TABLE `cms_sessions` , `cms_users_iphistory`, `cms_mail`, `cms_contact`");
        }
    }

    /*
    -----------------------------------------------------------------
    Определение мобильного браузера
    -----------------------------------------------------------------
    */
    private function mobile_detect()
    {
        if (isset($_SESSION['is_mobile'])) {
            return $_SESSION['is_mobile'] == 1 ? TRUE : FALSE;
        }
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';
        $accept = isset($_SERVER['HTTP_ACCEPT']) ? strtolower($_SERVER['HTTP_ACCEPT']) : '';
        if ((strpos($accept, 'text/vnd.wap.wml') !== FALSE) || (strpos($accept, 'application/vnd.wap.xhtml+xml') !== FALSE)) {
            $_SESSION['is_mobile'] = 1;
            return TRUE;
        }
        if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
            $_SESSION['is_mobile'] = 1;
            return TRUE;
        }
        if (preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $user_agent)
            || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr($user_agent, 0, 4))
        ) {
            $_SESSION['is_mobile'] = 1;
            return TRUE;
        }
        $_SESSION['is_mobile'] = 2;
        return FALSE;
    }

    /*
    ---------------------------------------------------------------------------------
    Закрытие сайта / выгоняем всех онлайн юзеров и редиректим их на страницу ожидания
    ---------------------------------------------------------------------------------
    */

    private function site_access()
    {
        if (self::$system_set['site_access'] == 0 && (self::$user_id && self::$user_rights < 9))   // выгоняем всех, кроме SV!
        {
            self::user_unset();
            session_destroy();
            header('Location: '.self::$system_set['homeurl'].'/closed.php');
        }

        if (self::$system_set['site_access'] == 1 && (self::$user_id && self::$user_rights == 0))   // выгоняем всех, кроме администрации
        {
            self::user_unset();
            session_destroy();
            header('Location: '.self::$system_set['homeurl'].'/closed.php');
        }
    }

}