<?php
define('_IN_JOHNCMS', 1);
$id = intval($_GET[id]);
require('../../incfiles/core.php');
$textl = 'Khu Dân Cư';
require('../../incfiles/head.php');
if(!$user_id){
Header("Location: $home");
Exit;
}
if(isset($_GET[id])){
echo'<div class="main-xmenu">';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../../incfiles/end.php');
exit;
}
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM gamemini_house WHERE user_id = $id"),0);
if($dem ==0 AND $user_id != $id){
Echo '<div class="rmenu">Người này vẫn trạng thái "VÔ GIA CƯ"</div></div>';
Require '../../incfiles/end.php';
Exit;
}
If($dem ==0 AND $user_id == $id){
echo '<div class="phdr">Mua nhà</div>';
if(isset($_POST[mua])){
If($datauser[xu] >= 100000){
if(mb_strlen($_POST[name]) <=50){
@mysql_query("INSERT INTO gamemini_house SET user_id = $user_id, name = '".mysql_real_escape_string($_POST['name'])."'");
@mysql_query("UPDATE users SET xu = xu -100000 WHERE id = $user_id");
Header("Location: /sanbay/dancu");
} else {
Echo '<div class="rmenu">Không hợp lệ</div>';
}
} else {
Echo '<div class="rmenu">Thiếu tiền!</div>';
}
}
Echo '<form method="post">Bạn chưa có nhà. Hãy mua với giá 100.000 xu<br>Nhập tên nhà có thể dùng BBCODE và smileys: (Max: 50 ký tự)<br><textarea name="name"></textarea><br><input type="submit" name="mua" value="Mua nhà"></form></div>';
Require '../../incfiles/end.php';
Exit;
}
if ($user_id==$id) {
mysql_query("UPDATE `gamemini_house_chat` SET `view`='1' WHERE `nha_id`='".$user_id."'");
}
$h = mysql_fetch_array(mysql_query("SELECT * FROM gamemini_house WHERE user_id = $id"),0);
If($h[level] ==1){$level = 'nenbetong';}
If($h[level] ==2){$level = 'nengach';}
if($h[level] ==3){$level = 'nengo'; }
echo'<div class="danhmuc">Nhà của ';
if($id != $user_id){
Echo nick($id);
} else {
Echo '<b>BẠN</b>';
}
Echo '</div><div class="bmenu_hero"><div class="login"><center>'.functions::smileys(bbcode::tags(htmlspecialchars($h[name]))).'</center></div></div>';
if(date("G")<19 && date("G")>=6) {echo '<div class="nhasang" style="height:120px; margin:0;"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div>';}
else {echo '<div class="nhatoi"></div>';}
$trangtri = mysql_query("SELECT * FROM gamemini_house_vpcb WHERE (theloai2 = 'trangtri' OR name_pic = 'dieuhoa') AND user_id = '$id' AND hienthi = '1' ORDER BY time ASC");
While($ott = mysql_fetch_array($trangtri)){
Echo '<span style="padding-left: '.$ott['css'].'%;"><img src="dodung/'.$ott[name_pic].'.png"></span>';
}
echo'</div>';
echo '<div class="'.$level.'" style="min-height:100px; margin:0">';
$other = mysql_query("SELECT * FROM gamemini_house_vpcb WHERE theloai2 != 'trangtri' AND user_id = '$id' AND hienthi = '1' AND name_pic != 'dieuhoa' ORDER BY time ASC");
While($ott1 = mysql_fetch_array($other)){
if($ott1[xuongdong] ==1){echo '<br>';}
if($ott1[xuongdong] ==2){echo '<br><br>';}
If($ott1[xuongdong] ==3){echo '<br><br><br>';}
If($ott1[xuongdong] ==4){echo '<br><br><br><br>';}
If($ott1[xuongdong] ==5){echo '<br><br><br><br><br>';}
Echo '<span style="margin-left: '.$ott1['css'].'%;"><img src="dodung/'.$ott1[name_pic].'.png"></span>';
}
echo '<center><img src="/avatar/'.$user_id.'.png""></center>';
echo'</div>';
If($id == $user_id){
Echo '<div class="lucifer"><div class="thongbaomini">Mẹo: nếu nhà trang bị quá nhiều đồ treo tường thì bức tường sẽ biến thành 1 thanh cuộn!</div>';
}
If($id ==1){
Echo '<div class="gmenu">Thiết kế nhà mẫu: 
<br><b>Tường:</b> điều hòa = 45%, đồng hồ = 5% (<=>50%)<br><b>Sàn:</b><br>Dòng 1: Tivi = 45%, máy giặt = 39% (<=>84%)<br>Dòng 2: tủ sách = 0%, bàn salon đặt ngang = 40%, ghế gỗ dọc = 17% (<=>57%)<br>Dòng 3: ghế gỗ = xuống 1 dòng + 63%, bàn tiếp khách = 2% (<=>65%)<br>Dòng 4: đèn ngủ = xuống 1 dòng + 0%, giường = 0%</div>';
}
echo '<div class="phdr">Thông tin</div><div class="news"><table><tbody><tr><td width="100"><img src="img/house'.$h[level].'.png"></td><td><b>Level: <b>'.$h[level].'</b>';
If($user_id ==$id){echo ' <a href="?id='.$id.'&act=upgrade">[Nâng cấp]</a>';}
Echo '<br/>Két sắt: <b>'.$h[taisan].'</b> Xu';
if($id == $user_id){echo ' <a href="?id='.$id.'&act=gui"><br>[Gửi tiền]</a><a href="?id='.$id.'&act=rut"> [Rút tiền]</a><br><a href="shop.php">[Mua đồ]</a> <a href="kho.php">[Kho đồ]</a>';}
Echo '</td></tr></tbody></table>';
if ($h[level]==3) {
echo '<div class="phdr">Trò chuyện '.($user_id==$id?'<a href="house.php?id='.$id.'&act=xoachat"><b><font color="red">[x]</font></b></a>':'').'</div>';
if (isset($_POST['chat'])) {
$text=$_POST['text'];
if (empty($text)||strlen($text)>50) {
echo '<div class="rmenu">Không hợp lệ</div>';
} else {
@mysql_query("INSERT INTO `gamemini_house_chat` SET
`user_id`='".$user_id."',
`nha_id`='".$id."',
`text`='".$text."',
`time`='".time()."'
");
header('Location: house.php?id='.$id.'');
}
}
echo '<form action="house.php?id='.$id.'" method="post">
<textarea name="text" placeholder="Nhập nội dung chat"></textarea><br/>
<input type="submit" name="chat" value="Gửi">
</form>';
$req=mysql_query("SELECT * FROM `gamemini_house_chat` WHERE `nha_id`='".$id."' ORDER BY `time` DESC LIMIT $start, $kmess");
while ($vina4u=mysql_fetch_array($req)) {
$thongtin = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='{$vina4u['user_id']}'"));
echo $i % 2 ? '<div class="menu list-bottom">' : '<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td
width="48px;" class="list_post">';
echo '<img src="'.$home.'/avatar/'.$vina4u['user_id'].'.png" alt="'.$vina4u['thongtin'].'" style="vertical-align: -5px;"/>';
echo'</td><td class="current-blog"><div class="blog-bg-left"><img src="/icon/left-blog.png"></div><span>';
echo (time() > $thongtin['lastdate'] + 300 ? '<img src="/images/off.png" title="OFF"/> ' : '<img src="/images/on.png" title="ON"/> ');
echo'<a href="/member/'.$vina4u['user_id'].'.html"><b>'.nick($vina4u['user_id']).'</b></a> <span style="font-size:12px;color:#777;">(' . functions::thoigian($vina4u['time']) . ')</span> ';
echo'</span></div>';
echo'<div class="text">';
$ban = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_ban_users` WHERE `user_id` = '" .$vina4u['user_id']. "' AND `ban_time` > '" . time() . "'"), 0);
if($ban > 0) {
echo'******bài viêt ẩn******';
} else {
$vina4u['text'] = functions::checkout($vina4u['text'], 1, 1);
echo functions::smileys(bbcode::tags($vina4u['text']));
}
echo '</td></tr></tbody></table></div>';
}
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM `gamemini_house_chat`  WHERE `nha_id`='".$id."'"),0);
if ($tong > $kmess) {
echo '<div class="menu">' . functions::pages('house.php?id='.$id.'&page=', $start, $tong, $kmess) . '</div>';
}
}
if($id ==$user_id){
Switch($act){
case 'upgrade':
If(isset($_POST['up'])){
if($_POST['loaitien'] == 'xu'){
If($h[level] ==1){
If($datauser[xu] >=500000){
@mysql_query("UPDATE users SET xu = xu -500000 WHERE id = $id");
@mysql_query("UPDATE gamemini_house SET level = '2' WHERE user_id = $id");
Header("Location: $home/sanbay/dancu/house.php?id=$id");
} else {
Echo '<div class="rmenu">Không đủ tiền nâng cấp</div>';
}
}
If($h[level] ==2){
If($datauser[xu] >=1500000){
@mysql_query("UPDATE users SET xu = xu -1500000 WHERE id = $id");
@mysql_query("UPDATE gamemini_house SET level = '3' WHERE user_id = $id");
Header("Location: $home/sanbay/dancu/house.php?id=$id");
} else {
Echo '<div class="rmenu">Không đủ tiền nâng cấp</div>';
}
}
} else {
If($h[level] ==1){
If($datauser[vnd] >=15){
@mysql_query("UPDATE users SET vnd = vnd -15 WHERE id = $id");
@mysql_query("UPDATE gamemini_house SET level = '2' WHERE user_id = $id");
Header("Location: $home/sanbay/dancu/house.php?id=$id");
} else {
Echo '<div class="rmenu">Không đủ tiền nâng cấp</div>';
}
}
If($h[level] ==2){
If($datauser[vnd] >=45){
@mysql_query("UPDATE users SET vnd = vnd - 45 WHERE id = $id");
@mysql_query("UPDATE gamemini_house SET level = '3' WHERE user_id = $id");
Header("Location: $home/sanbay/dancu/house.php?id=$id");
} else {
Echo '<div class="rmenu">Không đủ tiền nâng cấp</div>';
}
}
}
}
if($h[level] <3){
Echo '<div class="thongbaomini">Để nâng lên cấp 1 => 2 tốn 500.000 xu hoặc 15 lượng. Để nâng lên cấp 2 => 3 tốn 1.500.000 xu hoặc 45 lượng.<form method="post"><input type="radio" name="loaitien" value="xu">Dùng Xu<br><input type="radio" name="loaitien" value="vina">Dùng VNĐ<br><input type="submit" name="up" value="Nâng cấp"></form></div>';
} else {
Echo '<div class="rmenu">Chưa có cấp nhà số 4!</div>';
}
Break;
case 'xoachat':
if ($user_id==$id) {
mysql_query("DELETE FROM `gamemini_house_chat` WHERE `nha_id`='".$id."'");
} else {
header('Location: house.php?id='.$id.'');
}
break;
case 'gui':
If(isset($_POST[gui])){
$tien = intval($_POST['tien']);
If($datauser['xu'] >= $tien AND $tien >0){
@mysql_query("UPDATE gamemini_house SET taisan = taisan +$tien WHERE user_id = $id");
@mysql_query("UPDATE users SET xu = xu -$tien WHERE id = $id");
Header("Location: house.php?id=$id");
} else {echo '<div class="rmenu">Không hợp lệ</div>';
}
}
echo '<div class="thongbaomini"><form method="post">Nhập số xu gửi:<br><input type="number" name="tien"><br><input type="submit" name="gui" value="Cho vào két"></form></div>';
Break;
case 'rut':
If(isset($_POST[rut])){
$tien = intval($_POST['tien']);
If($h[taisan] >= $tien AND $tien >0){
@mysql_query("UPDATE gamemini_house SET taisan = taisan -$tien WHERE user_id = $id");
@mysql_query("UPDATE users SET xu = xu +$tien WHERE id = $id");
Header("Location: house.php?id=$id");
} else {echo '<div class="rmenu">Không hợp lệ</div>';
}
}
echo '<div class="thongbaomini"><form method="post">Nhập số xu muốn rút:<br><input type="number" name="tien"><br><input type="submit" name="rut" value="Rút khỏi két"></form></div>';
Break;
}
}
echo '</div>';
} else {
Header("Location: $home/sanbay/dancu/house.php?id=$user_id");
}
echo'<div><div>';
require('../../incfiles/end.php');
?>
                            