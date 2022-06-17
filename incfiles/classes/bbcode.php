<?php

/**
 * @package     JohnCMS
 * @link        http://johncms.com
 * @copyright   Copyright (C) 2008-2011 JohnCMS Community
 * @license     LICENSE.txt (see attached file)
 * @version     VERSION.txt (see attached file)
 * @author      http://johncms.com/about
 */

defined('_IN_JOHNCMS') or die('Restricted access');
function tagtv($var){ 
$db=mysql_fetch_array(mysql_query("select * from users where name='{$var}'")); 
if(mysql_num_rows(mysql_query("select * from users where name='{$var}'"))==0){ 
$ra='@'.$var.''; 
} else { 
$xemhd=@mysql_fetch_array(mysql_query("SELECT * FROM soo_forum WHERE id='".intval($_GET['thanks'])."'"));
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : core::$system_set['homeurl'];
$likehd= '<img src="/images/soo.gif" width="16" height="16">  đã tags bạn';
/*
mysql_query("INSERT INTO `hoatdong` SET
`user_id_to` = '".$db[id]."',
`type` = 'no',
`user_id` = '".$user_id."',
`time` = '" . time() . "',
`link` = '" .$linkhd. "',
`text` = '".$likehd."'
");
*/
$ra='<a href="/member/'.$db[id].'.html">'.nick($db[id]).'</a>'; 
} 
return $ra; 
}
class bbcode extends core
{
 	/* 
    ----------------------------------------------------------------- 
    Colors 
    ----------------------------------------------------------------- 
    */ 
    public static function colors($var) 
    { 
        if (!function_exists('process_colors')) { 
            function process_colors($var) 
            { 
$str = $var[1]; 
                $strlen = mb_strlen($str);  
                while ($strlen) { 
                    $arr1[] = mb_substr($str, 0, 1, "UTF-8");  
                    $str = mb_substr($str, 1, $strlen, "UTF-8");  
                    $strlen = mb_strlen($str); } 
                $arr2 = array( '#ff00cc', 
                               '#ff0099', 
                               '#ff0033', 
                               '#ff0000', 
                               '#ff3300', 
                               '#ff6600', 
                               '#ffcc00', 
                               '#ffff00', 
                               '#99ff00', 
                               '#66ff00', 
                               '#33ff00', 
                               '#00ff33', 
                               '#00ff66', 
                               '#00ffcc', 
                               '#00ffff', 
                               '#0099ff', 
                               '#0066ff', 
                               '#0000ff', 
                               '#3300ff', 
                               '#6600ff', 
                               '#9900ff', 
                               '#cc00ff' ); 
                $t = count($arr2); 
                $j = 0; 
                foreach ($arr1 as $value) { 
                        $out .= '<span style="color:' . $arr2[$j] . '">' . $value . '</span>';
                        $j++; 
                    if ($j == $t) $j = 0; 
                } 
                return $out; 
            } 
        } 
        return preg_replace_callback('~\\[colors\\](.+?)\\[/colors\\]~i', 'process_colors', $var); 
    }
    /*
    -----------------------------------------------------------------
    Подсветка кода
    -----------------------------------------------------------------
    */
    private static function highlight_code($var)
    {
        if (!function_exists('process_code')) {
            function process_code($php)
            {
                $php = strtr($php, array('<br />' => '', '\\' => 'slash_JOHNCMS'));
                $php = html_entity_decode(trim($php), ENT_QUOTES, 'UTF-8');
                $php = substr($php, 0, 2) != "<?" ? "<?php\n" . $php . "\n?>" : $php;
                $php = highlight_string(stripslashes($php), true);
                $php = strtr($php, array('slash_JOHNCMS' => '&#92;', ':' => '&#58;', '[' => '&#91;'));
                return '<div class="php"><div class="code"><span style="color: black"><b>PHP Code:</b></span></div><div class="coder">' . $php . '</div></div>';
            }
        }
        return preg_replace(array('#\[php\](.+?)\[\/php\]#se'), array("''.process_code('$1').''"), str_replace("]\n", "]", $var));
    }

    /*
    -----------------------------------------------------------------
    Обработка URL в тэгах BBcode
    -----------------------------------------------------------------
    */
    private static function OLD_highlight_url($var)
    {
        if (!function_exists('process_url')) {
            function process_url($url)
            {
                $home = parse_url(core::$system_set['homeurl']);
                $tmp = parse_url($url[1]);
                    if ($home['host'] == $tmp['host'] || isset(core::$user_set['direct_url']) && core::$user_set['direct_url']) {
                        return '<a href="' . $url[1] . '">' . $url[2] . '</a>';
                    } else {
                        return '<a href="' . core::$system_set['homeurl'] . '/go.php?url=' . urlencode(htmlspecialchars_decode($url[1])) . '">' . $url[2] . '</a>';
                    }
            }
        }
        return preg_replace_callback('~\\[url=(https?://.+?)\\](.+?)\\[/url\\]~', 'process_url', $var);
    }
	
	/*
    -----------------------------------------------------------------
    Обработка тэгов и ссылок
    -----------------------------------------------------------------
    */
    public static function tags($var = '') {
global $login;
$var = preg_replace('#\[hr\]#si', '<hr/>', $var);
$var = str_replace('[HR][/HR]', '<hr/>', $var);
$var = preg_replace(array ('#@([\w\d]{2,})#se'), array ("''.tagtv('$1').''"), str_replace("]\n", "]", $var));
$var = preg_replace('#\[code\](.*?)\[/code\]#si', '<div class="phdr"><b>Mã</b></div><div class="gmenu">\1</div>', $var);
$var = preg_replace('#\[CODE\](.*?)\[/CODE\]#si', '<div class="phdr"><b>Mã</b></div><div class="gmenu">\1</div>', $var);
$var = preg_replace('#\[text\](.*?)\[/text\]#si', '<b>TEXT:</b><br><textarea>\1</textarea><br>', $var);
$var = preg_replace('#\[TEXT\](.*?)\[/TEXT\]#si', '<b>TEXT:</b><br><textarea>\1</textarea><br>', $var);
$var = str_replace('[br]', '<br/>', $var);
$var = preg_replace('#\[list\](.*?)\[/list\]#si', '<div style="border-top: 1px dashed #CECFCE; border-bottom: 1px dashed #CECFCE;">$1</div>', $var);
$var = preg_replace('#\[LIST\](.*?)\[/LIST\]#si', '<div style="border-top: 1px dashed #CECFCE; border-bottom: 1px dashed #CECFCE;">$1</div>', $var);
$var = preg_replace('#\[center\](.+?)\[/center\]#is', '<div align="center">\1</div>', $var );
$var = preg_replace('#\[CENTER\](.+?)\[/CENTER\]#is', '<div align="center">\1</div>', $var );
$var = preg_replace('#\[LEFT\](.+?)\[/LEFT\]#is', '<div align="left">\1</div>', $var );
$var = preg_replace('#\[left\](.+?)\[/left\]#is', '<div align="left">\1</div>', $var );
$var = preg_replace('#\[right\](.+?)\[/right\]#is', '<div align="right">\1</div>', $var );
$var = preg_replace('#\[RIGHT\](.+?)\[/RIGHT\]#is', '<div align="right">\1</div>', $var );
$var = preg_replace('#\[trichten\](.+?)\[/trichten\]#is', '<div class="user1">Trích dẫn bài của \1</div>', $var );
$var = preg_replace('#\[c\](.*?)\[/c\]#si', '<span class="quote" style="display:block"> \1</span>', $var);
$var = preg_replace('#\[trichnd\](.+?)\[/trichnd\]#is', '<div class="quote2"> \1</div>', $var );
$var = preg_replace('#\[quote=(.*?)\](.*?)\[/quote\]#si', '<div class="phdr">\1 đã viết</div><div class="gmenu">\2</div>', $var);
$var = preg_replace('#\[img](.+?)\[/img]#is', '<img src="\1" border="0" />', $var);
$var = preg_replace('#\[COLOR=(.+?)\](.+?)\[/COLOR\]#is', '<font style="color:\1;">\2</font>', $var );
$var = preg_replace('#\[color=(.+?)\](.+?)\[/color\]#is', '<font style="color:\1;">\2</font>', $var );
$var = preg_replace('#\[SIZE=(.+?)\](.+?)\[/SIZE\]#is', '<font style="font-size:\1;">\2</font>', $var );
$var = preg_replace('#\[size=(.+?)\](.+?)\[/size\]#is', '<font style="font-size:\1;">\2</font>', $var );
$var = preg_replace('#\[FONT=(.+?)\](.+?)\[/FONT\]#is', '<font face="\1">\2</font>', $var );
$var = preg_replace('#\[font=(.+?)\](.+?)\[/font\]#is', '<font face="\1">\2</font>', $var );
//////////////
$var = preg_replace("#\[spoiler=(?:&quot;|\"|')?(.*?)[\"']?(?:&quot;|\"|')?\](.*?)\[\/spoiler\](\r\n?|\n?)#si", "<div style=\"margin: 5px 5px 5px 5px;\"><div class=\"smallfont\" style=\"margin-bottom:2px\"><b>Spoiler</b> for <i>$1</i>: <input type=\"button\" style=\"margin: 0px; padding: 0px; width: 45px; font-size: 10px;\" onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerText = ''; this.value = 'Hide'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerText = ''; this.value = 'Show'; }\" value=\"Show\"></div><div style=\"border: 1px inset; background-color: whitesmoke; margin: 0px; padding: 2px;\"><div style=\"display: none;\">$2</div></div></div>", $var);
$var = preg_replace("#\[spoiler\](.*?)\[\/spoiler\](\r\n?|\n?)#si", "<div style=\"margin: 5px 5px 5px 5px;\"><div class=\"smallfont\" style=\"margin-bottom:2px\"><b>Ẩn Hiện</b>: <input type=\"button\" style=\"margin: 0px; padding: 0px; width: 45px; font-size: 10px;\" onClick=\"if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerText = ''; this.value = 'Hide'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerText = ''; this.value = 'Show'; }\" value=\"Show\"></div><div style=\"border: 1px inset; background-color: whitesmoke; margin: 0px; padding: 2px;\"><div style=\"display: none;\">$1</div></div></div>", $var);
$var = str_replace('[you]', $login, $var);
        $var = self::parse_time($var);               // Обработка тэга времени
        $var = self::highlight_code($var);           // Подсветка кода
        $var = self::highlight_url($var);            // Обработка ссылок
        $var = self::highlight_bb($var);             // Обработка ссылок
        $var = self::OLD_highlight_url($var);        // Обработка ссылок в BBcode
return $var;
}

	
	
	
	
	
	
	
    /*
    -----------------------------------------------------------------
    Обработка времени
    -----------------------------------------------------------------
    */
    private static function parse_time($var)
    {
        if (!function_exists('process_time')) {
            function process_time($time)
            {
                $shift = (core::$system_set['timeshift'] + core::$user_set['timeshift']) * 3600;
                if($out = strtotime($time)){
                    return date("d.m.Y / H:i", $out + $shift);
                } else {
                    return false;
                }
            }
        }
        return preg_replace(array('#\[time\](.+?)\[\/time\]#se'), array("''.process_time('$1').''"), $var);
    }

    /*
    -----------------------------------------------------------------
    Парсинг ссылок
    -----------------------------------------------------------------
    За основу взята доработанная функция от форума phpBB 3.x.x
    -----------------------------------------------------------------
    */
    public static function highlight_url($text)
    {
        if (!function_exists('url_callback')) {
            function url_callback($type, $whitespace, $url, $relative_url)
            {
                $orig_url = $url;
                $orig_relative = $relative_url;
                $url = htmlspecialchars_decode($url);
                $relative_url = htmlspecialchars_decode($relative_url);
                $text = '';
                $chars = array('<', '>', '"');
                $split = false;
                foreach ($chars as $char) {
                    $next_split = strpos($url, $char);
                    if ($next_split !== false) {
                        $split = ($split !== false) ? min($split, $next_split) : $next_split;
                    }
                }
                if ($split !== false) {
                    $url = substr($url, 0, $split);
                    $relative_url = '';
                } else if ($relative_url) {
                    $split = false;
                    foreach ($chars as $char) {
                        $next_split = strpos($relative_url, $char);
                        if ($next_split !== false) {
                            $split = ($split !== false) ? min($split, $next_split) : $next_split;
                        }
                    }
                    if ($split !== false) {
                        $relative_url = substr($relative_url, 0, $split);
                    }
                }
                $last_char = ($relative_url) ? $relative_url[strlen($relative_url) - 1] : $url[strlen($url) - 1];
                switch ($last_char)
                {
                    case '.':
                    case '?':
                    case '!':
                    case ':':
                    case ',':
                        $append = $last_char;
                        if ($relative_url) $relative_url = substr($relative_url, 0, -1);
                        else $url = substr($url, 0, -1);
                        break;

                    default:
                        $append = '';
                        break;
                }
                $short_url = (mb_strlen($url) > 40) ? mb_substr($url, 0, 30) . ' ... ' . mb_substr($url, -5) : $url;
                switch ($type)
                {
                    case 1:
                        $relative_url = preg_replace('/[&?]sid=[0-9a-f]{32}$/', '', preg_replace('/([&?])sid=[0-9a-f]{32}&/', '$1', $relative_url));
                        $url = $url . '/' . $relative_url;
                        $text = $relative_url;
                        if (!$relative_url) {
                            return $whitespace . $orig_url . '/' . $orig_relative;
                        }
                        break;

                    case 2:
                        $text = $short_url;
                        if (!isset(core::$user_set['direct_url']) || !core::$user_set['direct_url']) {
                            $url = core::$system_set['homeurl'] . '/go.php?url=' . rawurlencode($url);
                        }
                        break;

                    case 3:
                        $url = 'http://' . $url;
                        $text = $short_url;
                        if (!isset(core::$user_set['direct_url']) || !core::$user_set['direct_url']) {
                            $url = core::$system_set['homeurl'] . '/go.php?url=' . rawurlencode($url);
                        }
                        break;

                    case 4:
                        $text = $short_url;
                        $url = 'mailto:' . $url;
                        break;
                }
                $url = htmlspecialchars($url);
                $text = htmlspecialchars($text);
                $append = htmlspecialchars($append);
                return $whitespace . '<a href="' . $url . '">' . $text . '</a>' . $append;
            }
        }

        static $url_match;
        static $url_replace;

        if (!is_array($url_match)) {
            $url_match = $url_replace = array();

            // Обработка внутренние ссылки
            $url_match[] = '#(^|[\n\t (>.])(' . preg_quote(core::$system_set['homeurl'], '#') . ')/((?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F]{2})*(?:/(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:\#(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F]{2})*)?)#ieu';
            $url_replace[] = "url_callback(1, '\$1', '\$2', '\$3')";

            // Обработка обычных ссылок типа xxxx://aaaaa.bbb.cccc. ...
            $url_match[] = '#(^|[\n\t (>.])([a-z][a-z\d+]*:/{2}(?:(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-zа-яё0-9.]+:[a-zа-яё0-9.]+:[a-zа-яё0-9.:]+\])(?::\d*)?(?:/(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:\#(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F]{2})*)?)#ieu';
            $url_replace[] = "url_callback(2, '\$1', '\$2', '')";

            // Обработка сокращенных ссылок, без указания протокола "www.xxxx.yyyy[/zzzz]"
            $url_match[] = '#(^|[\n\t (>])(www\.(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:\#(?:[a-zа-яё0-9\-._~!$&\'(*+,;=:@/?|]+|%[\dA-F]{2})*)?)#ieu';
            $url_replace[] = "url_callback(3, '\$1', '\$2', '')";
        }
        return preg_replace($url_match, $url_replace, $text);
    }

    /*
    -----------------------------------------------------------------
    Удаление bbCode из текста
    -----------------------------------------------------------------
    */
   static function notags($var = '')
    {
        $var = preg_replace('#\[color=(.+?)\](.+?)\[/color]#si', '$2', $var);
        $var = preg_replace('!\[bg=(#[0-9a-f]{3}|#[0-9a-f]{6}|[a-z\-]+)](.+?)\[/bg]!is', '$2', $var);
        $var = preg_replace('#\[spoiler=(.+?)\]#si', '$2', $var);
        $replace = array(
            '[small]' => '',
            '[/small]' => '',
            '[big]' => '',
            '[/big]' => '',
            '[green]' => '',
            '[/green]' => '',
            '[red]' => '',
            '[/red]' => '',
            '[blue]' => '',
            '[/blue]' => '',
            '[b]' => '',
            '[/b]' => '',
            '[i]' => '',
            '[/i]' => '',
            '[u]' => '',
            '[/u]' => '',
            '[s]' => '',
            '[/s]' => '',
            '[quote]' => '',
            '[/quote]' => '',
            '[c]' => '',
            '[/c]' => '',
            '[*]' => '',
            '[/*]' => ''
        );
        return strtr($var, $replace);
    }

    /*
    -----------------------------------------------------------------
    Обработка bbCode
    -----------------------------------------------------------------
    */
    private static function highlight_bb($var)
    {
        // Список поиска
        $search = array(
'#\[img](.+?)\[/img]#is', // images 
'#\[d](.+?)\[/d]#is', // link download

            '#\[b](.+?)\[/b]#is', // Жирный
            '#\[i](.+?)\[/i]#is', // Курсив
            '#\[u](.+?)\[/u]#is', // Подчеркнутый
            '#\[s](.+?)\[/s]#is', // Зачеркнутый
            '#\[small](.+?)\[/small]#is', // Маленький шрифт
            '#\[big](.+?)\[/big]#is', // Большой шрифт
            '#\[red](.+?)\[/red]#is', // Красный
            '#\[green](.+?)\[/green]#is', // Зеленый
            '#\[blue](.+?)\[/blue]#is', // Синий
            '!\[color=(#[0-9a-f]{3}|#[0-9a-f]{6}|[a-z\-]+)](.+?)\[/color]!is', // Цвет шрифта
            '!\[bg=(#[0-9a-f]{3}|#[0-9a-f]{6}|[a-z\-]+)](.+?)\[/bg]!is', // Цвет фона
            '#\[(quote|c)](.+?)\[/(quote|c)]#is', // Цитата
            '#\[\*](.+?)\[/\*]#is', // Список
            '#\[spoiler=(.+?)](.+?)\[/spoiler]#is' // Спойлер
        );
        // Список замены
        $replace = array(
			'<a href="$1" title="Click to view image" target="_blank"><img src="$1" border="0" style="max-width: 200px;"></img></a>', //images 
			'<img src="'.self::$system_set['homeurl'].'/images/bb/download.gif" border="0"></img><a href="$1" title="Click to download">[Download]</a>',// link download

            '<span style="font-weight: bold">$1</span>', // Жирный
            '<span style="font-style:italic">$1</span>', // Курсив
            '<span style="text-decoration:underline">$1</span>', // Подчеркнутый
            '<span style="text-decoration:line-through">$1</span>', // Зачеркнутый
            '<span style="font-size:x-small">$1</span>', // Маленький шрифт
            '<span style="font-size:large">$1</span>', // Большой шрифт
            '<span style="color:red">$1</span>', // Красный
            '<span style="color:green">$1</span>', // Зеленый
            '<span style="color:blue">$1</span>', // Синий
            '<span style="color:$1">$2</span>', // Цвет шрифта
            '<span style="background-color:$1">$2</span>', // Цвет фона
            '<div class="bbcode_container"><div class="bbcode_quote"><div class="quote_container"><div class="bbcode_quote_container"></div>$2</div></div></div>', // Цитата
            '<span class="bblist">$1</span>', // Список
            '<div><div class="spoilerhead" style="cursor:pointer;" onclick="var _n=this.parentNode.getElementsByTagName(\'div\')[1];if(_n.style.display==\'none\'){_n.style.display=\'\';}else{_n.style.display=\'none\';}">$1 (+/-)</div><div class="spoilerbody" style="display:none">$2</div></div>' // Спойлер
        );
        return preg_replace($search, $replace, $var);
    }

    /*
    -----------------------------------------------------------------
    Панель кнопок bbCode (для компьютеров)
    -----------------------------------------------------------------
    */
    public static function auto_bb($form, $field)
    {
        $colors = array(
            'ffffff', 'bcbcbc', '708090', '6c6c6c', '454545',
            'fcc9c9', 'fe8c8c', 'fe5e5e', 'fd5b36', 'f82e00',
            'ffe1c6', 'ffc998', 'fcad66', 'ff9331', 'ff810f',
            'd8ffe0', '92f9a7', '34ff5d', 'b2fb82', '89f641',
            'b7e9ec', '56e5ed', '21cad3', '03939b', '039b80',
            'cac8e9', '9690ea', '6a60ec', '4866e7', '173bd3',
            'f3cafb', 'e287f4', 'c238dd', 'a476af', 'b53dd2'
        );
        $i = 1;
        $font_color = '';
        $bg_color = '';
        foreach ($colors as $value) {
            $font_color .= '<a href="javascript:tag(\'[color=#' . $value . ']\', \'[/color]\'); show_hide(\'color\');" style="background-color:#' . $value . ';"></a>';
            $bg_color .= '<a href="javascript:tag(\'[bg=#' . $value . ']\', \'[/bg]\'); show_hide(\'bg\');" style="background-color:#' . $value . ';"></a>';
        }
        $smileys = !empty(self::$user_data['smileys']) ? unserialize(self::$user_data['smileys']) : '';
        if (!empty($smileys)) {
            $res_sm = '';
            $bb_smileys = '<small><a href="' . self::$system_set['homeurl'] . '/pages/faq.php?act=my_smileys">' . self::$lng['edit_list'] . '</a></small><br />';
            foreach ($smileys as $value)
                $res_sm .= '<a href="javascript:tag(\':' . $value . '\', \':\'); show_hide(\'sm\');">:' . $value . ':</a> ';
            $bb_smileys .= functions::smileys($res_sm, self::$user_data['rights'] >= 1 ? 1 : 0);
        } else {
            $bb_smileys = '<small><a href="' . self::$system_set['homeurl'] . '/pages/faq.php?act=smileys">' . self::$lng['add_smileys'] . '</a></small>';
        }
        $out = '<style>.color a {float:left; display: block; width: 10px; height: 10px; margin: 1px; border: 1px solid black;}</style>
            <script language="JavaScript" type="text/javascript">
            function tag(text1, text2) {
              if ((document.selection)) {
                document.' . $form . '.' . $field . '.focus();
                document.' . $form . '.document.selection.createRange().text = text1+document.' . $form . '.document.selection.createRange().text+text2;
              } else if(document.forms[\'' . $form . '\'].elements[\'' . $field . '\'].selectionStart!=undefined) {
                var element = document.forms[\'' . $form . '\'].elements[\'' . $field . '\'];
                var str = element.value;
                var start = element.selectionStart;
                var length = element.selectionEnd - element.selectionStart;
                element.value = str.substr(0, start) + text1 + str.substr(start, length) + text2 + str.substr(start + length);
              } else {
                document.' . $form . '.' . $field . '.value += text1+text2;
              }
            }
            function show_hide(elem) {
              obj = document.getElementById(elem);
              if( obj.style.display == "none" ) {
                obj.style.display = "block";
              } else {
                obj.style.display = "none";
              }
            }
            </script>
	            <a href="javascript:tag(\'[b]\', \'[/b]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/bold.gif" alt="b" title="' . self::$lng['tag_bold'] . '" border="0"/></a>
            <a href="javascript:tag(\'[i]\', \'[/i]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/italics.gif" alt="i" title="' . self::$lng['tag_italic'] . '" border="0"/></a>
            <a href="javascript:tag(\'[u]\', \'[/u]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/underline.gif" alt="u" title="' . self::$lng['tag_underline'] . '" border="0"/></a>
            <a href="javascript:tag(\'[s]\', \'[/s]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/strike.gif" alt="s" title="' . self::$lng['tag_strike'] . '" border="0"/></a>
            <a href="javascript:tag(\'[*]\', \'[/*]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/list.gif" alt="s" title="' . self::$lng['tag_list'] . '" border="0"/></a>
            <a href="javascript:tag(\'[spoiler=]\', \'[/spoiler]\');"><img src="/images/bb/sp.gif" alt="spoiler" title="Spoiler" border="0"/></a>
            <a href="javascript:tag(\'[c]\', \'[/c]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/quote.gif" alt="quote" title="' . self::$lng['tag_quote'] . '" border="0"/></a>
            <a href="javascript:tag(\'[php]\', \'[/php]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/php.gif" alt="cod" title="' . self::$lng['tag_code'] . '" border="0"/></a>
            <a href="javascript:tag(\'[url=]\', \'[/url]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/link.gif" alt="url" title="' . self::$lng['tag_link'] . '" border="0"/></a>
			<a href="javascript:tag(\'[d]\', \'[/d]\', \'\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/download.gif" alt="download" title="Chèn tệp tin" border="0"/></a>
            <a href="javascript:tag(\'[img]\', \'[/img]\')"><img src="' . self::$system_set['homeurl'] . '/images/bb/img.gif" alt="images" title="images" border="0"/></a>
            <a href="javascript:show_hide(\'color\');"><img src="' . self::$system_set['homeurl'] . '/images/bb/color.gif" title="' . self::$lng['color_text'] . '" border="0"/></a>
            <a href="javascript:show_hide(\'bg\');"><img src="' . self::$system_set['homeurl'] . '/images/bb/color_bg.gif" title="' . self::$lng['color_bg'] . '" border="0"/></a>';
		
        if (self::$user_id) {
            $out .= ' <a href="javascript:show_hide(\'sm\');"><img src="' . self::$system_set['homeurl'] . '/images/bb/smileys.gif" alt="sm" title="' . self::$lng['smileys'] . '" border="0"/></a></div>
			
                <table id="sm" style="display:none"><tr><td>' . $bb_smileys . '</td></tr></table>
                <div id="sm" style="display:none">'.$bb_smileys.'</div>';
                
        }else $out .= '<br />';
        
        $out .= '<div id="color" class="bbpopup" style="display:none;">Màu chữ: '.$font_color.'</div>'.
            '<div id="bg" class="bbpopup" style="display:none">Màu nền: '.$bg_color.'</div>';
        return $out;
    }
}