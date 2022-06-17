<?php
function nick_online($id, $mod = false) {
$ban = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" . $id . "' AND `ban_time` > '" . time() . "'"), 0);
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '" . $id . "'"));
$cclan=mysql_num_rows(mysql_query("SELECT * FROM `nhom_user` WHERE `duyet`='1' AND `user_id`='".$id."'"));

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
$out .= ''.$icontop.' '.$iconcc.' '.$iconnick.' '.$font.'' . $user['name'] . '</font> '.$clan.'';
} else {
$out .= ''.$icontop.' '.$iconcc.' '.$iconnick.' <font '.($shadow == 'on' ? 'class="'.$post['class'].'"' : '').' color>' . $user['name'] . '</font> '.$clan.'';
}
}
return $out;
}
function show_online($user = array(), $status = 0, $ip = 0, $str = '', $text = '', $sub = '') { global $set_user, $realtime, $user_id, $admp, $home; 
$out = false;  
$out .= '<a href="/member/' . $user['id'] . '.html"><font color="2c5170">' . nick_online($user['id']) . '</font></a>'; 
return $out;
} 
function timecount($var) { 
if ($var < 0) 
$var = 0; 
$day = ceil($var / 86400); 
if ($var > 345600) { 
$str = $day . ' Giờ'; 
} elseif ($var >= 172800) { 
$str = $day . ' Рhút'; 
} elseif ($var >= 86400) { 
$str = '1 Giây'; 
} else { 
$str = gmdate('G:i:s', $var); 
} 
return $str; 
}  
$on = $_GET['on']; 
switch($on) { 
default:  
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `" . ($act == 'guest' ? 'cms_guests' : 'users') . "` WHERE `lastdate` > '" . (time() - 300) . "'"), 0);
if ($total > 0) { 
$req = mysql_query("SELECT * FROM `" . ($act == 'guest' ? 'cms_guests' : 'users') . "` WHERE `preg`='1' and `lastdate` > '" . (time() - 300) . "' ORDER BY " . ($act == 'guest' ? "`movings` DESC" : "`name` ASC") . " LIMIT 1000"); 
while ($res = mysql_fetch_assoc($req)) { 
echo  show_online($res, 0, ($act == 'guest' || ($rights >= 1 && $rights >= $res['rights']) ? ($rights >= 6 ? 2 : 1) : 0), ' (' . $res['movings'] . ' - ' . timecount($realtime - $res['sestime']) . ') ' . $place); 
echo ' . '; 
++$l; 
} 
} 
else { 
echo '<div class="list1"><p>Không thành viên nào online!</p></div>'; 
} 
break; 
}
?>