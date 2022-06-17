<?php

$textl = 'Nhà Tù';


echo'<div class="main-xmenu">';
echo'<div class="phdr"><i class="fa fa-comments-o"></i> Nhà Tù</div><div class="box_list_parent_index"><div class="da"><br><br><br><br><br>';
if ($ban)
{
echo'<div class="danhmuc">Vi phạm của bạn</div>';
$vipham = mysql_fetch_array(mysql_query("SELECT * FROM `cms_ban_users` WHERE `user_id`='" . $user_id. "' ORDER BY `ban_while` DESC LIMIT 1"));
echo'<div class="list1">Đăng nhập không thành công !<br/>• Bạn bị khóa bởi : <b>'.$vipham['ban_who'].'</b><br/>• lý do bị khóa : '.$vipham['ban_reason'].'<br/>• Thời gian : '.thoigiantinh($vipham['ban_time']).'<br/>• Liên hệ Admin để biết thêm chi tiết<br/><center><a href="/exit.php">Trở lại đăng nhập</a></center></div>';
}

echo'<div class="viengame">';
echo'<div class="tuongnhatu"><div class="cuasonhatu"></div></div>';
echo '<div class="nennhatu" style="text-align: center;">';
mysql_query("UPDATE `vitri` SET `online`='nhatu' WHERE `user_id`='".$user_id."'");
$req=mysql_query("SELECT * FROM `cms_ban_users` WHERE `ban_time`>'".time()."' ORDER BY RAND() LIMIT 15");
while ($res = mysql_fetch_array($req)) {
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$res[user_id]."'"));
 echo '<a href="/member/'.$res['user_id'].'.html"><label style="display: inline-block;text-align: center;"><s><b style="font-size: 9px;color:black;font-weight:bold;text-align: center;">'.$name[name].'</b></s><br><img src="/avatar/'.$res[user_id].'.png"></label></a>';
}
echo'</div>';
echo'</div>';
echo'</div>';
echo '<div class="main-xmenu">';
if(isset($_POST['submitchat'])) {
$loai=functions::checkout($_POST['loai']);
$noidungchat = bbcode::notags($noidungchat);
$noidungchat = isset($_POST['noidungchat']) ? functions::checkin(trim($_POST['noidungchat'])) : '';
if(empty($_POST['noidungchat'])) {
echo '<div class="menu">Bạn đã nhập nội dung đâu</div>';
} else if(strlen($_POST['noidungchat']) < 2) { // 2 là số kí tự ít nhất
echo '<div class="menu">Bạn phải viết trên 5 kí tự</div>';
} else if(strlen($_POST['noidungchat']) > 4000) {
echo '<div class="menu">Bạn không được viết quá 5000 kí tự</div>';
} else {
if($user_id){
$checknv=mysql_num_rows(mysql_query("SELECT * FROM `nhiemvu_user` WHERE `user_id`='".$user_id."' AND `id_nv`='3'"));
if ($checknv>0) {
mysql_query("UPDATE `nhiemvu_user` SET `tiendo`=`tiendo`+'1' WHERE `user_id`='".$user_id."' AND `id_nv`='3'");
}
mysql_query("INSERT INTO `guest` SET `user_id`='".$user_id."', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
header('Location: '.$home.'/sanbay/nhatu.php');
}
}
}


//chat box ajax
if ($user_id) {

if ($datauser['chanchat'] == 1)
{
echo '<div class="rmenu">Bạn đã bị chặn chat...</div>';
}
else
{
//--Phòng Chát--//

$refer = base64_encode($_SERVER['REQUEST_URI']);
$token = mt_rand(1000, 100000);
$_SESSION['token'] = $token;

}


}


?>