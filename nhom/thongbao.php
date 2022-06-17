<?php
/*///////////////////////
//@Tac gia: Admin Diendanvn.me
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Thông báo nhóm';
require('../incfiles/head.php');
require('func.php');
switch($act) {
default:
echo '<div class="mainblok"><div class="phdr"><b>Thông báo nhóm</b></div>';
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_tb` WHERE `fr_user`='$user_id'"),0);
if($dem) {
$req = mysql_query("SELECT * FROM `nhom_tb` WHERE `fr_user`='$user_id' ORDER BY `time` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
echo ''.($res['read']==0 ? '<div class="tb">':'<div class="rtb">').'';
$user = user_nick($res['user_id']);
$user2 = user_nick($res['fr_user']);
if($res['type']==0) {
$bd = baidang($res['sid']);
echo '<img src="img/like.png" alt="" />&#160;<a href ="/users/profile.php?user='.$res['user_id'].'">'.$user['name'].'</a> đã thích bài viết của bạn: <a href="?act=go&id='.$res['vid'].'">'.catchu(notags($bd['text']),0,5).'...</a> <span class="xam">'.ngaygio($res['time']).'</span> <a href ="?act=del&id='.$res['vid'].'">[<span style="color:red;">x</span>]</a>';
} else if($res['type']==1) {
$bd = baidang($res['sid']);
echo '<img src="img/like.png" alt="" />&#160;<a href ="/users/profile.php?user='.$res['user_id'].'">'.$user['name'].'</a> đã thích <a href="?act=go&id='.$res['vid'].'">một hình ảnh</a> của bạn'.(!empty($bd['text']) ? ': <a href="?act=go&id='.$res['vid'].'">'.catchu(notags($bd['text']),0,5).'...</a>':'').' <span class="xam">'.ngaygio($res['time']).'</span> <a href ="?act=del&id='.$res['vid'].'">[<span style="color:red;">x</span>]</a>';
} else if($res['type']==2) {
$bd = baidang($res['id']);
$user3 = user_nick($bd['user_id']);
echo '<img src="img/cmt.png" alt="" />&#160;<a href ="/users/profile.php?user='.$res['user_id'].'">'.$user['name'].'</a> đã bình luận trong bài viết của '.($user_id==$bd['user_id'] ? 'bạn':'<a href ="/users/profile.php?user='.$bd['user_id'].'">'.$user3['name'].'</a>').': <a href="?act=go&id='.$res['vid'].'">'.catchu(notags($bd['text']),0,5).'...</a> <span class="xam">'.ngaygio($res['time']).'</span> <a href ="?act=del&id='.$res['vid'].'">[<span style="color:red;">x</span>]</a>';
} else if($res['type']==3) {
$bd = baidang($res['id']);
$user3 = user_nick($bd['user_id']);
echo '<img src="img/img.png" alt="" />&#160;<a href ="/users/profile.php?user='.$res['user_id'].'">'.$user['name'].'</a> đã bình luận trong <a href="?act=go&id='.$res['vid'].'">một hình ảnh</a> của '.($user_id==$bd['user_id'] ? 'bạn':'<a href ="/users/profile.php?user='.$bd['user_id'].'">'.$user3['name'].'</a>').''.(!empty($bd['text']) ? ': <a href="?act=go&id='.$res['vid'].'">'.catchu(notags($bd['text']),0,5).'...</a>':'').' <span class="xam">'.ngaygio($res['time']).'</span> <a href ="?act=del&id='.$res['vid'].'">[<span style="color:red;">x</span>]</a>';
} else if($res['type']==4) {
$nhom = nhom($res['id']);
echo '<img src="img/add.png" alt="" />&#160;<a href ="/users/profile.php?user='.$res['user_id'].'">'.$user['name'].'</a> đã cho bạn tham gia nhóm: <a href="?act=go&id='.$res['vid'].'">'.$nhom['name'].'</a> <span class="xam">'.ngaygio($res['time']).'</span> <a href ="?act=del&id='.$res['vid'].'">[<span style="color:red;">x</span>]</a>';
}
echo '</div>';
}
if ($dem > $kmess){echo '<div class="rtb" align="center">' . functions::display_pagination('thongbao.php?', $start, $dem, $kmess) . '</div>';
}
} else {
echo '<div class="tb" align="center">Chưa có thông báo nào!</div>';
}
echo '<div class="list1"><a href="/nhom">Danh sách nhóm >></a></div></div>';
break;
case 'go':
$id= intval(abs($_GET['id']));
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_tb` WHERE `vid`='$id'"),0);
if($kt==0) { header('Location: thongbao.php'); }
$go = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_tb` WHERE `vid`='$id'"));
if($go['fr_user']==$user_id) {
if($go['type']!=4) {
mysql_query("UPDATE `nhom_tb` SET `read`='1' WHERE `vid`='$id'");
header('Location: cmt.php?id='.$go['id'].'#'.$go['sid'].'');
} else if($go['type']==4) {
mysql_query("UPDATE `nhom_tb` SET `read`='1' WHERE `vid`='$id'");
header('Location: page.php?id='.$go['id'].'');
}
} else { header('Location: thongbao.php'); }
break;
case 'del':
$id= intval(abs($_GET['id']));
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_tb` WHERE `vid`='$id'"),0);
if($kt==0) { header('Location: thongbao.php'); }
$go = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_tb` WHERE `vid`='$id'"));
if($go['fr_user']==$user_id) {
mysql_query("DELETE FROM `nhom_tb` WHERE `vid`='$id'");
header('Location: thongbao.php');
} else { header('Location: thongbao.php'); }
break;
}
require('../incfiles/end.php');
?>
