<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$id= intval(abs($_GET['id']));
$nhom = mysql_fetch_array(mysql_query("SELECT * FROM `nhom` WHERE `id`='".$id."'"));
$textl= $nhom['name'];
require('../incfiles/head.php');
include_once('func.php');
echo '<div class="menunhom">';
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'"),0);
if(!isset($id) || $dem == 0) {
echo '<br/><div class="omenu">Nhóm không tồn tại hoặc đã bị xoá!</div></div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="phdr">Tranh Chính Của Nhóm</div><div class="da"><div class="lucifer">';
echo head_nhom($id,$user_id);

$thanhvien = mysql_result( mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `user_id`='$user_id'"),0);
if(isset($_GET['thamgia'])) {
if($thanhvien == 0) {
mysql_query("INSERT INTO `nhom_user` SET `user_id`='$user_id', `id`='$id', `time`='$time', `rights`='0', `duyet`='0'");
header('Location: page.php?id='.$id.'');
}else{
	echo functions::display_error('Bạn đã vào 1 nhóm trước đó rồi');
	echo'</div>';
	require('../incfiles/end.php');
	exit;	
}
}
if(isset($_GET['rutkhoi'])) {
if($thanhvien >= 1 && $nhom['user_id']!=$user_id) {
mysql_query("DELETE FROM `nhom_user` WHERE `user_id`='$user_id' AND `id`='$id'");
header('Location: page.php?id='.$id.'');
}
}
echo'<div class="list1" style="font-size: 11px;font-weight: bold;"><link rel="stylesheet" type="text/css" href="/icon/stylexoan.css">
<table style="width:100%" border="0" cellspacing="0">
  <tr>
    <td style="text-align:center"><a style="color: #7a9127;" href="more.php?act=mem&id='.$id.'"><img src="/icon/hot/thanhvienclan.png" width="36" height="36" alt="icon" width="34px"/><br/>Thành viên</a></td> 
    <td style="text-align: center;"><a style="color: #7a9127;" href="album.php?id='.$id.'"><img src="/icon/hot/album.png" alt="icon" width="36" height="36"/><br/>Album ảnh</a></td>
    <td style="text-align:center"><a style="color: #7a9127;" href="shop.php"><img src="/icon/hot/shopclan.png" width="36" height="36" alt="icon" width="34px"/><br/>Shop Clan</a></td> 
      </tr></table></div>';
//duyet don
$duyet =mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='$id' AND `duyet`='0'"),0);
if($nhom['user_id'] == $user_id) {
echo '<div class="list1"><a href="duyet.php?id='.$id.'"><i class="fa fa-user-plus" aria-hidden="true"></i><b> Đơn xin gia nhập ('.$duyet.')</b></a></div>';
echo '<div class="list1"><a href="muashop.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i><b> Mua đồ cho shop clan</b></a></div>';
}
//Ô đăng bài
$ktviet = mysql_result( mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `user_id`='$user_id' AND `id`='$id' AND `duyet`='1'"),0);
if($ktviet != 0) {
echo '<div class="phdr">Kênh Chát</div><form method="post"><div class="list1"><form name="shoutbox" id="shoutbox" action="/guestbook/index.php?act=say" method="post">'.bbcode::auto_bb('shoutbox', 'msg').'<div class="list1">';
$text = functions::checkin($_POST['text']);
if(isset($_POST['submit'])) {
if(empty($text)) {
echo '<div class="list1">Chưa nhập nội dung!</div>';
} else if(strlen($text) > 5000) {
echo '<div class="list1">Nội dung quá dài. Chỉ tối đa 5000 kí tự!</div>';
} else {
@mysql_query("INSERT INTO `nhom_bd` SET `sid`='".$id."', `user_id`='".$user_id."', `time`='".$time."', `stime`='".$time."',  `text`='".mysql_real_escape_string($text)."', `type`='0'");
echo '<div class="omenu">Đăng bài thành công!</div>';
}
}
echo '<textarea name="text" cows="3" placeholder="Vui lòng viết tiếng việt có dấu để tôn trọng người đọc" class="form-control" style="border-left:2px solid #44B6AE !important;"></textarea><br/ ><button name="submit"><i class="fa fa-pencil" aria-hidden="true"></i> Đăng</button><div style="float:right; padding-top:4px;"></div></div></form>';
}
//Bài đăng khác
if($nhom['set'] == 0 || $ktviet != 0 && $nhom['set'] == 1 || $ktviet != 0 &&$nhom['set'] == 2) {
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `sid`='$id' AND `type`!='1'"),0);
if($dem) {
$req = mysql_query("SELECT * FROM `nhom_bd` WHERE `sid`='$id' AND `type`!='1' ORDER BY `stime` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
$gres = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '".$res['user_id']."'"));
$post = $res['text'];
if(strlen($post) > 160) {
$post = substr($post, 0, 160).'....';
}
$post = functions::checkout($post, 1, 1);
$post = functions::smileys($post);
echo'<div class="forumtext">';
echo'<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tr><td width="60px;" class="blog-avatar">';
echo '<img class="avatarforum" src="/avatar/'.$res['user_id'].'.png" width="45" height="48""/>';
echo'</td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0"><tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left">';
echo'<img src="/giaodien/images/left-blog.png"></div>';
echo (time() > $gres['lastdate'] + 300 ? ' <img style="vertical-align:middle;"  src="/images/off.png" alt="offline"/> ' : '<img style="vertical-align:middle;" title="' . $res['from'] . ' is online" src="/images/on.png" alt="online"/> ');
echo'<a href="/member/'.$res['user_id'].'.html"><b><font color="003366">'.nick($res['user_id']).'</font></b></a>';
echo'<div class="text">';
if($res['type']==2) {
echo '<div class="nhom_img" align="center"><a href="cmt.php?id='.$res['id'].'"><img src="files/anh_'.$res['time'].'.jpg" alt="image" /></a></div>';
}
echo''.$post.'<br/><br/>';
echo '<span style="font-size:11px;color:#777;float:right"> (' . functions::thoigian($res['time']) . ')</span>';
$like = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='".$res['id']."' AND `type`!='1'"),0);
$klike = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_like` WHERE `id`='".$res['id']."' AND `user_id`='".$user_id."' AND `type`!='1'"),0);
$bl = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `cid`='".$res['id']."' AND `type`='1'"),0);
$xoa = mysql_fetch_array(mysql_query("SELECT `rights` FROM `nhom_user` WHERE `id`='".$id."' AND `user_id`='".$res['user_id']."'"));
$xoa2 = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_user` WHERE `id`='".$id."' AND `user_id`='".$user_id."'"));
echo '<br>'.($like > 0 ? '<a href="more.php?act=like&id='.$res['id'].'"><img src="l.png" alt="l" /> '.$like.'</a> · ':'').''.($klike == 0 ? '<a href="action.php?act=like&id='.$res['id'].'"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Thích</a>':'<a href="action.php?act=dislike&id='.$res['id'].'"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Bỏ thích</a>').' · <a href="cmt.php?id='.$res['id'].'"><i class="fa fa fa-pencil-square-o"></i> Bình luận ('.$bl.')</a>'.($xoa2['rights'] > $xoa['rights'] || $res['user_id'] == $user_id || $rights == 9 ? ' · <a href="action.php?act=del&id='.$res['id'].'"><i class="fa fa-times-circle"></i> Xoá</a>':'').'';
echo'</div></div></td></tr></tbody></table></td></tr></tbody></table>';
echo'</div>';
}
} else {
echo '<div class="omenu" align="center">Chưa có bài đăng!</div>';
}
if ($dem > $kmess){
echo '<div class="omenu" align="center">' . functions::display_pagination('page.php?id='.$id.'&page=', $start, $dem, $kmess) . '</div>';
}
//Trinh don nhom
$tv =mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$id."' AND `duyet`='1'") ,0);
$anh =mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `sid`='$id' AND `type`='2'"),0);
$dv = mysql_fetch_array(mysql_query("SELECT * FROM `nhom` WHERE `id`='$id'"));
echo '<div class="phdr">Quản lí nhóm</div>
<div class="list1"><details><summary><b>Mở bảng quản lí nhóm</b></summary><a href="thongtin.php?id='.$id.'"><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Thông tin</b></a></br>'.($nhom['user_id'] == $user_id ? '<a href="edit.php?id='.$id.'"><i class="fa fa-hand-o-right" aria-hidden="true"></i> <b> Chỉnh sửa nhóm</b></a></br>':'').'';
echo '<font color="2c5170"><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Quỹ xu : '.$dv['xu'].'</font></b></br>';
echo '<font color="2c5170"><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Quỹ lượng : '.$dv['luong'].'</font></b></br>';
echo '<b><font color="2c5170"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Cấp độ : '.$dv['lv'].'</font></b></br>';
}
if ($datauser['rights'] >= 9) { 
echo'<a href="action.php?act=xoanhom&id='.$id.'" style="color:red;"><i class="fa fa-hand-o-right" aria-hidden="true"></i><b> Xóa nhóm</b></a>';
}
echo'</div></details></div>';
echo'</td></tr></tbody></table></td></tr></tbody></table>';
require('../incfiles/end.php');
?>
                            