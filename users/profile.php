<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$lng_profile = core::load_lng('profile');

if (!$user_id) {
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}

$user = functions::get_user($user);
if (!$user) {
require('../incfiles/head.php');
echo functions::display_error($lng['user_does_not_exist']);
require('../incfiles/end.php');
exit;
}

/*
-----------------------------------------------------------------
Thông tin nick
-----------------------------------------------------------------
*/
$array = array(
'activity'  => 'includes/profile',
'yourtopic' => 'includes/profile',
'chuki'     => 'includes/profile',
'ban'       => 'includes/profile',
'edit'      => 'includes/profile',
'images'    => 'includes/profile',
'info'      => 'includes/profile',
'ip'        => 'includes/profile',
'office'    => 'includes/profile',
'matkhau'   => 'includes/profile',
'matkhau_2'   => 'includes/profile',
'reset'     => 'includes/profile',
'settings'  => 'includes/profile',
'stat'      => 'includes/profile',
'friends'   => 'includes/profile'
);
$path = !empty($array[$act]) ? $array[$act] . '/' : '';
if (array_key_exists($act, $array) && file_exists($path . $act . '.php')) {
require_once($path . $act . '.php');
} else {
/*
-----------------------------------------------------------------

-----------------------------------------------------------------
*/
$headmod = 'profile,' . $user['id'];
$textl = 'Thông tin ' . htmlspecialchars($user['name']). '';
require('../incfiles/head.php');


$menu = array();
if ($user['id'] != $user_id && $rights >= 9 && $rights > $user['rights']) {
$menu[] = '<a href="' . $set['homeurl'] . '/' . $set['admp'] . '/index.php?act=usr_del&amp;id=' . $user['id'] . '">' . $lng['delete'] . '</a>';
}
if ($user['id'] != $user_id && $rights >= 3 && $user['rights']) {
$menu[] = '<a href="profile.php?act=ban&amp;mod=do&amp;user=' . $user['id'] . '">' . $lng['ban_do'] . '</a>';
}


if ($user['dayb'] == date('j', time()) && $user['monthb'] == date('n', time())) {
echo '<div class="gmenu">' . $lng['birthday'] . '!!!</div>';
}
$thongtinnhanvat = $datauser;
$p = $thongtinnhanvat['point'];
if($p <=500){
$rank = 'cu';
if($p <=100)
$n_rank = 'Đồng đoàn V';
if($p <=200 AND $p >100)
$n_rank = 'Đồng đoàn IV';
if($p <=300 AND $p >200)
$n_rank = 'Đồng đoàn III';
if($p <=400 AND $p > 300)
$n_rank = 'Đồng đoàn II';
if($p <=500 AND $p >400)
$n_rank = 'Đồng đoàn I';
}
if($p > 500 AND $p <=1000){
$rank = 'ag';
if($p <=600 AND $p >500)
$n_rank = 'Bạc đoàn V';
if($p <=700 AND $p >600)
$n_rank = 'Bạc đoàn IV';
if($p <=800 AND $p >700)
$n_rank = 'Bạc đoàn III';
if($p <=900 AND $p > 800)
$n_rank = 'Bạc đoàn II';
if($p <=1000 AND $p >900)
$n_rank = 'Bạc đoàn I';
}
if($p > 1000 AND $p <=1500){
$rank = 'au';
if($p <=1100 AND $p >1000)
$n_rank = 'Vàng đoàn V';
if($p <=1200 AND $p >1100)
$n_rank = 'Vàng đoàn IV';
if($p <=1300 AND $p >1200)
$n_rank = 'Vàng đoàn III';
if($p <=1400 AND $p > 1300)
$n_rank = 'Vàng đoàn II';
if($p <=1500 AND $p >1400)
$n_rank = 'Vàng đoàn I';
}
if($p > 1500 AND $p <=2000){
$rank = 'platium';
if($p <=1600 AND $p >1500)
$n_rank = 'Bạch kim đoàn V';
if($p <=1700 AND $p >1600)
$n_rank = 'Bạch kim đoàn IV';
if($p <=1800 AND $p >1700)
$n_rank = 'Bạch kim đoàn III';
if($p <=1900 AND $p > 1800)
$n_rank = 'Bạch kim đoàn II';
if($p <=2000 AND $p >1900)
$n_rank = 'Bạch kim đoàn I';
}
if($p > 2000 AND $p <=2500){
$rank = 'dinamon';
if($p <=2100 AND $p >2000)
$n_rank = 'Kim cương đoàn V';
if($p <=2200 AND $p >2100)
$n_rank = 'Kim cương đoàn IV';
if($p <=2300 AND $p >2200)
$n_rank = 'Kim cương đoàn III';
if($p <=2400 AND $p > 2300)
$n_rank = 'Kim cương đoàn II';
if($p <=2500 AND $p >2400)
$n_rank = 'Kim cương đoàn I';
}
if($p >2500){
$rank = 'thachdau';
$n_rank = 'Thách đấu <font color=red>(MAX)</font>';
}
$arg = array(
'lastvisit' => 1,
'iphist'    => 1,
'header'    => ''
);
if ($user['id'] != core::$user_id) {
$arg['footer'] = '<span class="gray">' . core::$lng['where'] . ':</span> ' . functions::display_place($user['id'], $user['place']);
}
echo '<div class="phdr">Thông tin '.$user[name].'</div><div class="lucifer">';
echo'<div class="phdrbox">';
echo'<div class="profile">';
if ($user[id]==$user_id||$rights>=7) {
echo '<a href="/member/edit-' . $user['id'] . '.html"><input type="button" value="Chỉnh sửa" class="nut"></a>';
}
if ($rights>$user[rights]&&$user_id!=$user[id]) {
if ($user['chanchat'] == 0)
{
echo '<a href="/users/chanchat.php?id=' . $user['id'] . '"><input type="button" value="Chặn chat" class="nut"></a>';
}
else
{
echo '<a href="/users/chanchat.php?id=' . $user['id'] . '"><input type="button" value="Bỏ chặn chat" class="nut"></a>';
}
echo '<a href="/users/profile.php?act=ban&mod=do&user=' . $user['id'] . '"><input type="button" value="Khóa nick" class="nut"></a>';
echo '<a href="/users/profile.php?act=ban&mod=delhist&user=' . $user['id'] . '"><input type="button" value="Unband" class="nut"></a>';
}
echo '<br/>';
if (empty($user['nguoiyeu']))
{
echo '<a href="/member/' . $user['id'] . '.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">' . $user['name'] . '</b><br><img src="/avatar/' . $user['id'] . '.png"></label></a>';
}
else
{
$xxx=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$user[nguoiyeu]."'"));
echo '<label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$user['name'].'</b><br><img src="/avatar/'.$user['id'].'.png"></label> <img src="/icon/tinhyeu.png"> <label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$xxx[name].'</b><br><img src="/avatar/'.$user['nguoiyeu'].'.png" class="xavt"></label>';
}
echo'</div>';


if ($rights >= 7 && !$user['preg'] && empty($user['regadm'])) {
echo '<div class="rmenu">' . $lng_profile['awaiting_registration'] . '</div>';
}

echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">';
echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>';
echo '<center><a id="click"><img src="/icon/hot/giaodich.png"></a><div id="show" style="display: none;"><a href="/ruong/index.php?id=' . $user['id'] . '"><img src="/icon/hot/ruong.png" style="margin-left:10px"></a><a href="/users/danh.php?id=' . $user['id'] . '" style="font-weight:bold;"><img src="/icon/hot/danh.png" style="margin-left:10px;margin-bottom:10px;margin-top:10px"></a><a href="/khugiaitri/honnhan.php?act=kethon&id='.$user[id].'"><img src="/icon/hot/tim.png" style="margin-left:10px"></a> <a href="/sanbay/dancu/house.php?id=' . $user['id'] . '"><img src="/icon/hot/home.png" style="margin-left:10px"></a></div>';
echo '<a href="/mail/' . $user['id'] . '" title = "Nhắn tin"><img src="/icon/hot/sms.png" style="margin-left:10px"></a><a id="vao"><img src="/icon/hot/thongtin.png" style="margin-left:10px"></a></div><div id="ra" style="display: none;">';
echo'<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">
</tr>
<tr>
<td class="left-info">ID tài khoản</td>
<td class="right-info"><span>' . $user['id'] . '</span></td>
</tr>
<tr>
<td class="left-info">Tên nick</td>
<td class="right-info"><span>' . htmlspecialchars($user['name']). '</span></td>
</tr>
<tr>
<td class="left-info">Tên thật</td>
<td class="right-info"><span>' . functions::checkout($user['imname']) . '</span></td>
</tr>
<tr>
<td class="left-info">Giới tính</td>
<td class="right-info">
<span>
' . ($user['sex'] == 'm' ? 'Con trai' : 'Con gái') . '</span>
</td>
</tr>
<tr>
<td class="left-info">Sức Mạnh</td>
<td class="right-info"><span>' . $user['sucmanh'] . ' Sức Mạnh</span></td>
</tr>
<tr>
<td class="left-info">Máu</td>
<td class="right-info"><span>' . $user['hp'] . '/' . $user['hpfull'] . ' HP</span></td>
</tr>
<tr>
<td class="left-info">Xu</td>
<td class="right-info"><span>' . $user['xu'] . ' Xu</span></td>
</tr>
<tr>
<td class="left-info">Lượng</td>
<td class="right-info"><span>' . $user['vnd'] . ' Lượng</span></td>
</tr>
<tr>
<td class="left-info">Bài viết</td>
<td class="right-info"><span>' . $user['postforum'] . ' Bài</span></td>
</tr>
<tr>
<td class="left-info">Lượt thích</td>
<td class="right-info"><span>' . $user['thank_di'] . ' Lượt</span></td>
</tr>
<tr>
<td class="left-info">Tỉnh thành</td>
<td class="right-info"><span>' . functions::checkout($user['live']) . '</span></td>
</tr>
<tr>
<td class="left-info">Điện thoại</td>
<td class="right-info"><span>' . functions::checkout($user['mibile']) . '</span></td>
</tr>
<tr>
<td class="left-info">Sở thích</td>
<td class="right-info"><span>' . functions::checkout($user['about']) . '</span></td>
</tr>
</table><div class="list1">
<table><tbody><tr><td><img src="/ranking/'.$rank.'.png" width="85px;"></td><td><b><big>'.$n_rank.'</big></b><br><font color=green>Point: <b>'.$thongtinnhanvat['point'].'</b></font><br>Thắng: <b>'.$thongtinnhanvat['thang'].'</b> trận<br>
Thua: <b>'.$thongtinnhanvat['thua'].'</b> trận</td></tr></tbody></table></div></div></center>';

include('xuli.php');
}

echo'<div>';
require_once('../incfiles/end.php');
                            