<?php
if(!$user_id) {
echo '<div class="omenu">Chỉ thành viên trong diễn đàn mới có thể sử dụng!</div>';
require('../incfiles/end.php');
exit;
}
function nick($id, $mod = false) {
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
$time= time();
//func time viet bai
function ngaygio($var) {
$time = time();
$jun = round(($time-$var)/60);
$shift = ($system_set['timeshift']+$user_set['timeshift'])*3600;
if (date('Y', $var) == date('Y', time())) {
if($jun < 1) {
$jun='Vừa xong';
}
if($jun >= 1 && $jun < 60){
$jun = "$jun phút trước";
}
if($jun >= 60 && $jun < 1440){
$jun = round($jun/60);
$jun = "$jun giờ trước";
}
if($jun >= 1440 && $jun < 2880){
$jun = "Hôm qua";
}
if($jun >= 2880 && $jun < 10080){
$day = round($jun/60/24);
$jun = "$day ngày trước";
}
}
if($jun > 10080){
$jun = date("d/m/Y - H:i", $var+$shift);
}
$xuat = '<span class="xam">'.$jun.'</span>';
return $xuat;
}
//func hien tên nick
function ten_nick($id,$set=0,$sid=0) {
$var = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'"));
$vad = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_user` WHERE `id`='".$sid."'AND `user_id`='".$id."'"));

$array = array(
1 => '<b><font color="008000">Phó Bang</font></b>',
2 => '<b><font color="ff0000">Bang Chủ</font></b>');

if($set==0) {
$xuat .= (time() > $var['lastdate'] + 300 ? ' <img style="vertical-align:middle;" title="' . $var['from'] . ' is offline" src="/images/off.png" alt="offline"/> ' : '<img style="vertical-align:middle;" title="' . $var['from'] . ' is online" src="/images/on.png" alt="online"/> ');
$xuat .= ' <a href="/users/profile.php?user='.$id.'"><span class="vmenu"><b>'.$var['name'].'</b></span></a>';
$xuat .=' <span class="xam">'.$array[$vad['rights']].'</span>';
} else {
$xuat .= '<table cellpadding="0" cellspacing="0"><tr><td>';
$ur = @getimagesize('../avatar/'.$id.'.png');
if(is_array($ur))
$xuat .= '<img src="../avatar/' . $id . '.png" width="45" height="48" alt="" />&#160;';
else
$xuat .= '<img src="../avatar/' . $id . '.png" width="45" height="48" alt="" />&#160;';

$xuat .= '</td><td align="left">';
$xuat .= (time() > $var['lastdate']+300 ? '<span style="color:red;">&#8226;</span>' : '<span style="color:green;">&#8226;</span>');
$xuat .= '&#160<a href="/users/profile.php?user='.$id.'"><span class="vmenu"><b>'.$var['name'].'</b></span></a>';
$xuat .='<br/><span class="xam">'.$array[$vad['rights']].'</span>';
}
$xuat .= '</td></tr></table>';

return $xuat;
}
//func xuat thong tin tu user
function user_nick($id) {
$var = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'"));
return $var;
}
//func hien head nhom
function head_nhom($id,$user_id) {
	global $datauser;
$nhom = mysql_fetch_array(mysql_query("SELECT * FROM `nhom` WHERE `id`='".$id."'"));
$array = array(
0 => 'Nhóm công khai',
1 => 'Nhóm đóng',
2 => 'Nhóm kín');
$url = @getimagesize('avatar/'.$id.'.png');
if(is_array($url))
$xuat .= '<div class="login"><table cellpadding="0" cellspacing="0" width="100%"><tr><td width="48px"><img src="/avatar/'.$nhom['user_id'].'.png" alt="" /></td><td><b>'.$nhom['name'].'</b></br><span class="xam">'.$array[$nhom['set']].'</span></td></tr></table>';
else
$xuat .= '<div class="login"><table cellpadding="0" cellspacing="0" width="100%"><tr><td width="48px"><img src="/avatar/'.$nhom['user_id'].'.png" alt="" /></td><td><b>'.$nhom['name'].'</b><br/ ><span class="xam">'.$array[$nhom['set']].'</span></td></tr></table>';
$ktdem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `user_id`='".$user_id."' AND `id`='".$id."'"), 0);
$kt = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_user` WHERE `user_id`='".$user_id."' AND `id`='".$id."'"));
$xuat .= ''.($ktdem == 0 ? '<div class="tb"><form method="post" action="page.php?thamgia&id='.$id.'"><input type="submit" name="sub" value="Tham gia nhóm" class="redbut" /></form></div>':''.($kt['duyet'] == 0 ? '<div class="tb"><form method="post" action="page.php?rutkhoi&id='.$id.'"><input type="submit" name="sub" value="Đang chờ duyệt" class="bluebut"/></form></div>':''.($kt['duyet'] == 1 && $kt['rights'] != 2 ? '<form method="post" action="page.php?rutkhoi&id='.$id.'"><input type="submit" name="sub" value="Rời khỏi nhóm" class="bluebut"/></form></br>':'').'').'').'';
if($kt['duyet'] == 1) 
	$xuat .= ' <a href="'.$home.'/nhom/raise.php"><button class="redbut">Đóng góp</button></a> <a href="'.$home.'/nhom/shop.php"><button class="redbut">Kho nhóm</button></a>';
$xuat .='</div>';
return $xuat;
}
function catchu($string,$start,$length){
$arrwords = explode(" ",$string);
$arrsubwords=array_slice($arrwords,$start,$length);
$result = implode(" ",$arrsubwords);
return $result;
}
//func lay info nhom theo id
function nhom($id) {
$var = mysql_fetch_array(mysql_query("SELECT * FROM `nhom` WHERE `id`='".$id."'"));
return $var;
}
//func chuc vu trong nhom
function quyen_nhom($id,$user) {
$var = mysql_fetch_array(mysql_query("SELECT `rights` FROM `nhom_user` WHERE `id`='".$id."' AND `user_id`='".$user."'"));
$mang = array(
0 => 'Thành viên', 1 => 'Phó Nhóm', 2 => 'Trưởng Nhóm');
return $mang[$var['rights']];
}
//func cat ngan
function thugon($text,$id,$luong=30) {
$tach = explode(' ',$text);
$dem = count($tach);
if($dem > $luong) {
$xuat =functions::checkout($text);
$xuat = functions::smileys(tags($xuat));
$xuat = ''.catchu(notags($xuat),0,$luong).' ... <a href="action.php?act=post&id='.$id.'">Đọc tiếp... >></a>';
} else {
$xuat =functions::checkout($text, 1, 1);
$xuat = functions::smileys(tags($xuat));
}
return $xuat;
}
//func lay bd theo id
function baidang($id) {
$var = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_bd` WHERE `id`='".$id."'"));
return $var;
}
?>