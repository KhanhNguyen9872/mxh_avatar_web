<?php

///////////////////////---------HAM HIEN THI  THONG TIN CA NHAN MEM----------//////////////////
function nhan_dan($id, $mod = false) {
$ban = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" . $id . "' AND `ban_time` > '" . time() . "'"), 0);
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '" . $id . "'"));
$info=$user['id'];
$info_m='
'.(!empty($user[nhandan])?'<div id="'.$user[nhandan].'" >'.nick($info).'</div>':''.nick($info).'').'';$out .= '' . $info_m . '';
return $out;
}


function chucvu_mem($id, $mod = false) {
$ban = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" . $id . "' AND `ban_time` > '" . time() . "'"), 0);
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '" . $id . "'"));
$quyen=$user['rights'];
if ($quyen==1)
{
$tenquyen='';
}
if ($quyen==2)
{
$tenquyen='';
}
if ($quyen==3)
{
$tenquyen='<b style="color:blue">(Quản Trị Viên)</b>';
}
if ($quyen==4)
{
$tenquyen='';
}
if ($quyen==5)
{
$tenquyen='';
}
if ($quyen==6)
{
$tenquyen='<b style="color:green">(Tổng Quản Lý)</b>';
}
if ($quyen==7)
{
$tenquyen='<b style="color:red">(Giám đốc)</b>';
}
if ($quyen==8)
{
$tenquyen='';
}
if ($quyen==9)
{
$tenquyen='<b style="color:red">(Sáng Lập Viên)</b>';
}



$out .= '' . $tenquyen . '</font>';
return $out;
}
////////

///////////////////////---------HIEN AVATAR MEMB----------//////////////////
function avatar_mem($id, $mod = false) {
$ban = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" . $id . "' AND `ban_time` > '" . time() . "'"), 0);
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '" . $id . "'"));
$avatar=$user['id'];
$cross=$user['avatar'];
if ($cross == 1)
{
if (file_exists((ROOTPATH . 'files/users/avatar/' . $user['id'] . '.png'))) {
$img_avatar = '<img src="/files/users/avatar/' . $avatar . '.png"  alt="Thành Viên ' . $user['name'] . '" />';
           }     else
                    $img_avatar = '<img src="/images/empty.png" alt="Thành Viên ' . $user['name'] . '" />';
            }
else
{
$img_avatar = '<img src="/avatar/' . $avatar . '.png" alt="Thành Viên ' . $user['name'] . '" />';
}
$out .= '' . $img_avatar . '';
return $out;
}
////
function htmlent($noidung){
return html_entity_decode($noidung, ENT_QUOTES, 'UTF-8');
}
function ip_show()
    {
    	$ip = $_SERVER['REMOTE_ADDR'];

    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        	$ip = $_SERVER['HTTP_CLIENT_IP'];
    	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	}
    	return $ip;
}
///
////
function thoigiantinh($from, $to = '') {
if (empty($to))
$to = time();
$diff = (int) abs($to - $from);
if ($diff <= 60) {
$since = sprintf('chờ chút');
} elseif ($diff <= 3600) {
$mins = round($diff / 60);
if ($mins <= 1) {
$mins = 1;
}
/* translators: min=minute */
$since = sprintf('%s phút', $mins);
} else if (($diff <= 86400) && ($diff > 3600)) {
$hours = round($diff / 3600);
if ($hours <= 1) {
$hours = 1;
}
$since = sprintf('%s giờ', $hours);
} elseif ($diff >= 86400) {
$days = round($diff / 86400);
if ($days <= 1) {
$days = 1;
}
$since = sprintf('%s ngày', $days);
}
return $since;
}
//


function nick($id, $mod = false) {
$ban = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" . $id . "' AND `ban_time` > '" . time() . "'"), 0);
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '" . $id . "'"));
$cclan=mysql_num_rows(mysql_query("SELECT * FROM `nhom_user` WHERE `duyet`='1' AND `user_id`='".$id."'"));
/*
if ($user['naruto'] != 0) {
$ninja = $user['naruto'];
if ($ninja <= 1) {
$ninja = '<font color="black"><b> - Ninja academy</b></font>';
} elseif ($ninja <= 50) {
$ninja = '<font color="#9900ff"><b> - Gennin</b></font>';
}elseif ($ninja <= 200){
$ninja = '<font color="#9900ff"><b> - Gennin + 1</b></font>';
}elseif ($ninja <= 300) {
$ninja = '<font color="#9900ff"><b> - Gennin + 2</b></font>';
}elseif ($ninja <= 500) {
$ninja = '<font color="green"><b> - Chunnin</b></font>';
}elseif ($ninja <= 800){
$ninja = '<font color="green"><b> - Chunnin + 1</b></font>';
}elseif ($ninja <= 1300){
$ninja = '<font color="green"><b> - Chunnin + 2</b></font>';
}elseif ($ninja <= 2000){
$ninja = '<font color="green"><b> - Chunnin + 3</b></font>';
}elseif ($ninja <= 4000){
$ninja = '<font color="blue"> - Jonin</font>';
}elseif ($ninja <= 6000){
$ninja = '<font color="blue"><b> - Jonin Special</b></font>';
}elseif ($ninja <= 8000){
$ninja = '<font color="#FFEB3B"><b> - Sannin </b></font>';
}elseif ($ninja <= 10000){
$ninja = '<font color="red"><b> - Kage</b></font>';
}
}*/
if ($cclan) {
$ss=mysql_fetch_array(mysql_query("SELECT * FROM `nhom_user` WHERE `user_id`='".$id."'"));
$nhom=mysql_fetch_array(mysql_query("SELECT * FROM `nhom` WHERE `id`='".$ss[id]."'"));
$clan='<img src="/images/clan/'.$nhom[icon].'.png">';
} else {
$clan='';
}
if($ban > 0) {
$out .= '<font color="black">'.($mod == 1 ? '<small>' : '<b>').'<s>' . $user['name'] . '</s>'.($mod == 1 ? '</small>' : '</b>').'</font>';
} else {
$config = explode('|', $user['iconset']);
$i=1;
$req = mysql_query("SELECT * FROM `users` WHERE `rights`!='9' ORDER BY `vnd` DESC");
$icontop = '';
while($res=mysql_fetch_array($req)) {
if ($i==1&&$res[id]==$id && $config[0] == 'on') {
$icontop = '<img src="/images/shopicon/xephang1.gif" alt="icon"/>';
} else if ($i==2&&$res[id]==$id && $config[0] == 'on') {
$icontop = '<img src="/images/shopicon/xephang2.gif" alt="icon"/>';
} else if ($i==3&&$res[id]==$id && $config[0] == 'on') {
$icontop = '<img src="/images/shopicon/xephang3.gif" alt="icon"/>';
}
$i++;
}
$iconcc = '';
$i=1;
$req = mysql_query("SELECT * FROM `users` ORDER BY `soca` DESC");
while($res=mysql_fetch_array($req)) {
if ($i==1&&$res[id]==$id && $config[1] == 'on') {
$iconcc = '<img src="/images/shopicon/cauca1.gif" alt="icon"/>';
} else if ($i==2&&$res[id]==$id && $config[1] == 'on') {
$iconcc = '<img src="/images/shopicon/cauca2.gif" alt="icon"/>';
} else if ($i==3&&$res[id]==$id && $config[1] == 'on') {
$iconcc = '<img src="/images/shopicon/cauca3.gif" alt="icon"/>';
}
$i++;
}
$shadow = 'off';
$post = mysql_fetch_assoc(mysql_query("SELECT * FROM `shadow` WHERE `user_id` = '".$id."'"));
if ($post['class'] != '' && $post['time'] >= time() && $post['config'] == 'on') $shadow = 'on';
if(!empty($user['icon'])) {$iconnick .= '<img src="'.$user[icon].'" alt="icon"/>';}
if($user['rights'] > 1) {
if($user['rights'] == 3) {$font = '<font '.($shadow == 'on' ? 'class="'.$post['class'].'"' : '').' color="#9900ff">';}
if($user['rights'] > 3) {$font = '<font '.($shadow == 'on' ? 'class="'.$post['class'].'"' : '').' color="#9900ff">';}
if($user['rights'] == 6) {$font = '<font '.($shadow == 'on' ? 'class="'.$post['class'].'"' : '').' color="#008000">';}
if($user['rights'] == 7) {$font = '<font '.($shadow == 'on' ? 'class="'.$post['class'].'"' : '').' color="red">';}
if($user['rights'] == 9) {$font = '<font '.($shadow == 'on' ? 'class="'.$post['class'].'"' : '').' color="red">';}
if($user['rights'] == 10) {$font = '<font '.($shadow == 'on' ? 'class="'.$post['class'].'"' : '').' color="#110000">';}
$out .= ''.$icontop.' '.$iconcc.' '.$iconnick.' '.$font.'' . $user['name'] . '</font> '.$ninja.''.$clan.'';
} else {
$out .= ''.$icontop.' '.$iconcc.' '.$iconnick.' <font '.($shadow == 'on' ? 'class="'.$post['class'].'"' : '').' color>' . $user['name'] . '</font>'.$ninja.' '.$clan.'';
}
}
return $out;
}
function doimau($text){
$ret = '';
$color = array("009900","3366CC","FFCC33","FF0099","FF0000","996600","prefixPrimary","prefixSecondary","prefixRed","prefixGreen","prefixOlive","prefixLightGreen","prefixBlue","prefixRoyalBlue","prefixSkyBlue","prefixGray","prefixSilver","prefixYellow","prefixOrange");
$i = rand(1,12);
$mau = $color[$i];
$ret = '<font color="'.$mau.'">'.$text.'</font>';
return $ret;
}
function delhtml($text){
$nd = array("/\<em\>(.*?)\<\/em\>/is" => "$1", "/\<b\>(.*?)\<\/b\>/is" => "$1",
"/\<i\>(.*?)\<\/i\>/is" => "$1",
"/\<u\>(.*?)\<\/u\>/is" => "$1",
"/\<s\>(.*?)\<\/s\>/is" => "$1",
"/\<center\>(.*?)\<\/center\>/is" => "$1", "/\<h2\>(.*?)\<\/h2\>/is" => "$1", "/\<p\>(.*?)\<\/p\>/is" => "$1", "/\<ul\>(.*?)\<\/ul\>/is" => "$1", "/\<li\>(.*?)\<\/li\>/is" => "$1", "/\<div class=(.*?)\>(.*?)\<\/div\>/is" => "$2", "/\<div align=(.*?)\>(.*?)\<\/div\>/is" => "$2", "/\<span style=(.*?)\>(.*?)\<\/span\>/is" => "$2", "/\<span class=(.*?)\>(.*?)\<\/span\>/is" => "$2", "/\<I class=(.*?)\>(.*?)\<\/I\>/is" => "$2", "/\<I style=(.*?)\>(.*?)\<\/I\>/is" => "$2", "/\<strong\>(.*?)\<\/strong\>/is" => "$1", "/\<br class=(.*?)\>/is" => "", "/\<z (.*?)\>/is" => "", "/\<em\>(.*?)\<\/em\>/is" => "$1", "/\<font size=(.*?)\>(.*?)\<\/font\>/is" => "$2", "/\<div style=(.*?)\>(.*?)\<\/div\>/is" => "$2", "/\<font(.*?)\>(.*?)\<\/font\>/is" => "$2", "/\<td(.*?)\>(.*?)\<\/td\>/is" => "$2", "/\<tr(.*?)\>(.*?)\<\/tr\>/is" => "$2", "/\<p(.*?)\>(.*?)\<\/p\>/is" => "$2", "/\<a href=(.*?)\>Tải ảnh về máy\<\/a\>/is" => "");
$text = preg_replace(array_keys($nd), array_values($nd), $text);
return $text;
}

//--- Hàm hiển thị màu topic ---//
function topic($text){
$ret = '';
$color = array("prefix prefixPrimary","prefix prefixSecondary", "prefix prefixRed", "prefix prefixGreen", "prefix prefixOlive", "prefix prefixLightGreen", "prefix prefixBlue", "prefix prefixRoyalBlue", "prefix prefixSkyBlue", "prefix prefixGray", "prefix prefixSilver", "prefix prefixOrange", "prefix prefixYellow");
$ran = rand(0, 12);
$mau=$color[$ran];
$ret = '<span class="'.$mau.'">'.$text.'</span>';
return $ret;
}
////
function catchuoi($chuoi, $gioihan) {
$chuoi = preg_replace('#\[b\](.*?)\[/b\]#si', '\1',$chuoi);

$chuoi = preg_replace('#\[youtube\](.*?)\[/youtube\]#si', '\2',$chuoi);

$chuoi = preg_replace('#\[c\](.*?)\[/c\]#si', '\2',$chuoi);


$chuoi = preg_replace('#\[i\](.*?)\[/i\]#si', '\1',$chuoi);
$chuoi = preg_replace('#\[u\](.*?)\[/u\]#si', '\1',$chuoi);


$chuoi = preg_replace('#\[s\](.*?)\[/s\]#si', '\1',$chuoi);
$chuoi = preg_replace('#\[center\](.*?)\[/center\]#si', '\1',$chuoi);


$chuoi = preg_replace("#\[SIZE=(.*?)\](. ?)\[/SIZE\]#is", "\\2",$chuoi);
$chuoi = preg_replace("#\[FONT=(.*?)\](. ?)\[/FONT\]#is", "\\2",$chuoi);

$chuoi = preg_replace("#\[7MAU\](.*?)\[/7MAU\]#is", "\\1",$chuoi);
$chuoi = preg_replace("#\[CODE=(.*?)\](. ?)\[/CODE\]#is", "\\2",$chuoi);
$chuoi = preg_replace("#\[PHP=(.*?)\](. ?)\[/PHP\]#is", "\\2",$chuoi);
$chuoi = str_replace('<br/>','',$chuoi);
$chuoi = str_replace('[code]','',$chuoi);
$chuoi = str_replace('[php]','',$chuoi);
if (strlen($chuoi) <= $gioihan) {
return $chuoi;
} else {
if (strpos($chuoi," ",$gioihan) > $gioihan) {
$new_gioihan=strpos($chuoi," ",$gioihan);
$new_chuoi = substr($chuoi,0,$new_gioihan);
return ''.$new_chuoi.'...';
}
$new_chuoi = substr($chuoi,0,$gioihan);
return $new_chuoi.'...';
}
}
///
function rand_color($text) {
$color = array();
$color[] = '<font color="000011">';
$color[] = '<font color="000022">';
$color[] = '<font color="000044">';
$color[] = '<font color="000055">';
$color[] = '<font color="000077">';
$color[] = '<font color="000088">';
$color[] = '<font color="000099">';
$color[] = '<font color="0000AA">';
$color[] = '<font color="0000BB">';
$color[] = '<font color="0000CC">';
$color[] = '<font color="0000DD">';
$color[] = '<font color="0000EE">';
$color[] = '<font color="0000FF">';
$color[] = '<font color="001100">';
$color[] = '<font color="002200">';
$color[] = '<font color="003300">';
$color[] = '<font color="004400">';
$color[] = '<font color="005500">';
$color[] = '<font color="006600">';
$color[] = '<font color="007700">';
$color[] = '<font color="008800">';
$color[] = '<font color="009900">';
$color[] = '<font color="00AA00">';
$color[] = '<font color="00BB00">';
$color[] = '<font color="00CC00">';
$color[] = '<font color="00DD00">';
$color[] = '<font color="00EE00">';
$color[] = '<font color="00FF00">';
$color[] = '<font color="000033">';
$color[] = '<font color="000066">';
$color[] = '<font color="000099">';
$color[] = '<font color="0000CC">';
$color[] = '<font color="0000FF">';
$color[] = '<font color="330000">';
$color[] = '<font color="330033">';
$color[] = '<font color="330066">';
$color[] = '<font color="330099">';
$color[] = '<font color="3300CC">';
$color[] = '<font color="3300FF">';
$color[] = '<font color="660000">';
$color[] = '<font color="660033">';
$color[] = '<font color="660066">';
$color[] = '<font color="660099">';
$color[] = '<font color="6600CC">';
$color[] = '<font color="6600FF">';
$color[] = '<font color="990000">';
$color[] = '<font color="990033">';
$color[] = '<font color="990066">';
$color[] = '<font color="990099">';
$color[] = '<font color="9900CC">';
$color[] = '<font color="9900FF">';
$color[] = '<font color="CC0000">';
$color[] = '<font color="CC0033">';
$color[] = '<font color="CC0066">';
$color[] = '<font color="CC0099">';
$color[] = '<font color="CC00CC">';
$color[] = '<font color="CC00FF">';
$color[] = '<font color="FF0000">';
$color[] = '<font color="FF0033">';
$color[] = '<font color="FF0066">';
$color[] = '<font color="FF0099">';
$color[] = '<font color="FF00CC">';
$color[] = '<font color="FF00FF">';
$color[] = '<font color="003300">';
$color[] = '<font color="003333">';
$color[] = '<font color="003366">';
$color[] = '<font color="003399">';
$color[] = '<font color="0033CC">';
$color[] = '<font color="FF3333">';
$color[] = '<font color="0033FF">';
$color[] = '<font color="333300">';
$color[] = '<font color="333333">';
$color[] = '<font color="333366">';
$color[] = '<font color="333399">';
$color[] = '<font color="3333CC">';
$color[] = '<font color="3333FF">';
$color[] = '<font color="663300">';
$color[] = '<font color="663333">';
$color[] = '<font color="663366">';
$color[] = '<font color="663399">';
$color[] = '<font color="6633CC">';
$color[] = '<font color="6633FF">';
$color[] = '<font color="993300">';
$color[] = '<font color="993333">';
$color[] = '<font color="993366">';
$color[] = '<font color="993399">';
$color[] = '<font color="9933CC">';
$color[] = '<font color="9933FF">';
$color[] = '<font color="CC3300">';
$color[] = '<font color="CC3333">';
$color[] = '<font color="CC3366">';
$color[] = '<font color="CC3399">';
$color[] = '<font color="CC33CC">';
$color[] = '<font color="CC33FF">';
$color[] = '<font color="FF3300">';
$color[] = '<font color="FF3333">';
$color[] = '<font color="FF3366">';
$color[] = '<font color="FF3399">';
$color[] = '<font color="FF33CC">';
$color[] = '<font color="FF33FF">';
$color[] = '<font color="006600">';
$color[] = '<font color="006633">';
$color[] = '<font color="006666">';
$color[] = '<font color="006699">';
$color[] = '<font color="0066CC">';
$color[] = '<font color="0066FF">';
$color[] = '<font color="336600">';
$color[] = '<font color="336633">';
$color[] = '<font color="336666">';
$color[] = '<font color="336699">';
$color[] = '<font color="3366CC">';
$color[] = '<font color="3366FF">';
$color[] = '<font color="666600">';
$color[] = '<font color="666633">';
$color[] = '<font color="666666">';
$color[] = '<font color="666699">';
$color[] = '<font color="6666CC">';
$color[] = '<font color="6666FF">';
$color[] = '<font color="996600">';
$color[] = '<font color="996633">';
$color[] = '<font color="996666">';
$color[] = '<font color="996699">';
$color[] = '<font color="9966CC">';
$color[] = '<font color="9966FF">';
$color[] = '<font color="CC6600">';
$color[] = '<font color="CC6633">';
$color[] = '<font color="CC6666">';
$color[] = '<font color="CC6699">';
$color[] = '<font color="CC66CC">';
$color[] = '<font color="CC66FF">';
$color[] = '<font color="FF6600">';
$color[] = '<font color="FF6633">';
$color[] = '<font color="FF6666">';
$color[] = '<font color="FF6699">';
$color[] = '<font color="FF66CC">';
$color[] = '<font color="FF66FF">';
$color[] = '<font color="009900">';
$color[] = '<font color="009933">';
$color[] = '<font color="009966">';
$color[] = '<font color="009999">';
$color[] = '<font color="0099CC">';
$color[] = '<font color="0099FF">';
$color[] = '<font color="339900">';
$color[] = '<font color="339933">';
$color[] = '<font color="339966">';
$color[] = '<font color="339999">';
$color[] = '<font color="3399CC">';
$color[] = '<font color="3399FF">';
$color[] = '<font color="669900">';
$color[] = '<font color="669933">';
$color[] = '<font color="669966">';
$color[] = '<font color="669999">';
$color[] = '<font color="6699CC">';
$color[] = '<font color="6699FF">';
$color[] = '<font color="999900">';
$color[] = '<font color="999933">';
$color[] = '<font color="999966">';
$color[] = '<font color="999999">';
$color[] = '<font color="9999CC">';
$color[] = '<font color="9999FF">';
$color[] = '<font color="CC9900">';
$color[] = '<font color="CC9933">';
$color[] = '<font color="CC9966">';
$color[] = '<font color="CC9999">';
$color[] = '<font color="CC99CC">';
$color[] = '<font color="CC99FF">';
$color[] = '<font color="FF9900">';
$color[] = '<font color="FF9933">';
$color[] = '<font color="FF9966">';
$color[] = '<font color="FF9999">';
$color[] = '<font color="FF99CC">';
$color[] = '<font color="FF99FF">';
$color[] = '<font color="00CC00">';
$color[] = '<font color="00CC33">';
$color[] = '<font color="00CC66">';
$color[] = '<font color="00CC99">';
$color[] = '<font color="33CC33">';
$color[] = '<font color="33CC66">';
$color[] = '<font color="00CCCC">';
$color[] = '<font color="00CCFF">';
$color[] = '<font color="33CC00">';
$color[] = '<font color="33CC33">';
$color[] = '<font color="33CC66">';
$color[] = '<font color="33CC99">';
$color[] = '<font color="33CCCC">';
$color[] = '<font color="33CCFF">';
$color[] = '<font color="66CC00">';
$color[] = '<font color="66CC33">';
$color[] = '<font color="66CC66">';
$color[] = '<font color="66CC99">';
$color[] = '<font color="66CCCC">';
$color[] = '<font color="66CCFF">';
$color[] = '<font color="99CC00">';
$color[] = '<font color="99CC33">';
$color[] = '<font color="99CC66">';
$color[] = '<font color="99CC99">';
$color[] = '<font color="99CCCC">';
$color[] = '<font color="99CCFF">';
$color[] = '<font color="CCCC00">';
$color[] = '<font color="CCCC33">';
$color[] = '<font color="CCCC66">';
$color[] = '<font color="CCCC99">';
$color[] = '<font color="CCCCCC">';
$color[] = '<font color="CCCCFF">';
$color[] = '<font color="FFCC00">';
$color[] = '<font color="FFCC33">';
$color[] = '<font color="FFCC66">';
$color[] = '<font color="FFCC99">';
$color[] = '<font color="FFCCCC">';
$color[] = '<font color="FFCCFF">';
$color[] = '<font color="00FF00">';
$color[] = '<font color="00FF33">';
$color[] = '<font color="00FF66">';
$color[] = '<font color="00FF99">';
$color[] = '<font color="00FFCC">';
$color[] = '<font color="00FFFF">';
$color[] = '<font color="33FF00">';
$color[] = '<font color="33FF33">';
$color[] = '<font color="33FF66">';
$color[] = '<font color="33FF99">';
$color[] = '<font color="33FFCC">';
$color[] = '<font color="33FFFF">';
$color[] = '<font color="66FF00">';
$color[] = '<font color="66FF33">';
$color[] = '<font color="66FF66">';
$color[] = '<font color="66FF99">';
$color[] = '<font color="66FFCC">';
$color[] = '<font color="66FFFF">';
$color[] = '<font color="99FF00">';
$color[] = '<font color="99FF33">';
$color[] = '<font color="99FF66">';
$color[] = '<font color="99FF99">';
$color[] = '<font color="99FFCC">';
$color[] = '<font color="99FFFF">';
$color[] = '<font color="CCFF00">';
$color[] = '<font color="CCFF33">';
$color[] = '<font color="CCFF66">';
$color[] = '<font color="CCFF99">';
$color[] = '<font color="CCFFCC">';
$color[] = '<font color="CCFFFF">';
$color[] = '<font color="FFFF00">';
$color[] = '<font color="FFFF33">';
$color[] = '<font color="FFFF66">';
$color[] = '<font color="FFFF99">';
$color[] = '<font color="FFFFCC">';
$color[] = '<font color="FFFFFF">';
$color[] = '<font color="110000">';
$color[] = '<font color="220000">';
$color[] = '<font color="330000">';
$color[] = '<font color="440000">';
$color[] = '<font color="550000">';
$color[] = '<font color="660000">';
$color[] = '<font color="770000">';
$color[] = '<font color="880000">';
$color[] = '<font color="990000">';
$color[] = '<font color="AA0000">';
$color[] = '<font color="BB0000">';
$color[] = '<font color="CC0000">';
$color[] = '<font color="DD0000">';
$color[] = '<font color="EE0000">';
$color[] = '<font color="FF0000">';
$color[] = '<font color="111111">';
$color[] = '<font color="222222">';
$color[] = '<font color="333333">';
$color[] = '<font color="444444">';
$color[] = '<font color="555555">';
$color[] = '<font color="666666">';
$color[] = '<font color="777777">';
$color[] = '<font color="888888">';
$color[] = '<font color="999999">';
$color[] = '<font color="AAAAAA">';
$color[] = '<font color="BBBBBB">';
$color[] = '<font color="CCCCCC">';
$color[] = '<font color="DDDDDD">';
$color[] = '<font color="EEEEEE">';
$color[] = '<font color="FFFFFF">';
$out .= '' . $color[rand(0, count($color)-1)] . '' . $text . '</font>';
return $out;
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
$teamnext = isset($_REQUEST['teamnext']) && $_REQUEST['teamnext'] > 0 ? intval($_REQUEST['teamnext']) : 1;
$teampage = isset($_REQUEST['teamnext']) ? $teamnext* $teamkmess - $teamkmess : (isset($_GET['teampage']) ? abs(intval($_GET['teampage'])) : 0);
$homenext = isset($_REQUEST['homenext']) && $_REQUEST['homenext'] > 0 ? intval($_REQUEST['homenext']) : 1;
$homepage = isset($_REQUEST['homenext']) ? $homenext* $homekmess - $homekmess : (isset($_GET['homepage']) ? abs(intval($_GET['homepage'])) : 0);
$next = isset($_REQUEST['next']) && $_REQUEST['next'] > 0 ? intval($_REQUEST['next']) : 1;
$chuyentrang = isset($_REQUEST['next']) ? $next* $phannua - $phannua : (isset($_GET['chuyentrang']) ? abs(intval($_GET['chuyentrang'])) : 0);
$noionline = isset($noionline) ? $noionline : '';

/*
-----------------------------------------------------------------
Закрытие сайта / редирект гостей на страницу ожидания
-----------------------------------------------------------------
*/
function rand_size($text) {
$size = array();
// $size[] = '<font size="+2">';
$size[] = '<font size="+1">';
$size[] = '<font>';
$size[] = '<font size="-1">';
$out .= '' . $size[rand(0, count($size)-1)] . '' . $text . '</font>';
return $out;
}
function rand_face($text) {
$face = array();
$face[] = '<font face="arial">';
$face[] = '<font>';
$face[] = '<font face="tahoma">';
$out .= '' . $face[rand(0, count($face)-1)] . '' . $text . '</font>';
return $out;
}
///
function Anlink($link) {
global $user_id;
if($user_id) {
$url = '<a href="'.$link[1].'">'.$link[2].'</a>';
return $url;
} else {
$url = '<b>Bạn cần <a href="/login.php"><font color="red">[Đăng nhập]</font></a> để thấy link!</b>';
return $url;
}
}
?>