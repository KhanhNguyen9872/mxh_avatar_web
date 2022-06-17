<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Clan - Hội Nhóm';
require('../incfiles/head.php');
include_once('func.php');
echo '<div class="box_forums">';
$dv = mysql_fetch_array(mysql_query("SELECT * FROM `nhom_user` WHERE `user_id`='$user_id' OR `id`='$id'"));
echo '<div class="list1"><form id="form" action="tao.php" method="GET"><center><button><i class="fa fa-plus" aria-hidden="true"></i> Tạo Clan mới</button></center></form></div>';
$result = mysql_query("SELECT * FROM `nhom_user` WHERE `user_id` = '$user_id' OR `id` = '$user_id' AND `duyet` = '1'");
$check = mysql_num_rows($result);
if ($check > 0)
{
$nhom = mysql_fetch_array($result);
$nhom = nhom($nhom['id']);
$xx=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$nhom[user_id]."'"));
$chunhom = user_nick($nhom['user_id']);
echo '<div class="phdr">Clan tham gia</div><div class="lucifer">';
echo'<div class="forumtext"><table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tbody><tr><td width="60px;" class="blog-avatar"><img class="avatarforum" src="../avatar/'.$nhom[user_id].'.png"></td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0"><tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left"><img src="/giaodien/images/left-blog.png"></div><a href="/member/'.$nhom[user_id].'.html"><b> '.(time()>$xx[lastdate]+300?'<img style="vertical-align:middle;" src="/images/off.png">':'<img style="vertical-align:middle;" src="/images/on.png">').' </b></a><b><a href="/member/'.$nhom[user_id].'.html"><b><span style="color:#ff1234">'.$chunhom[name].'<span style="color:#ff1234;"> - Hội Trưởng</span></span></b></a></b><div class="text"><a href="page.php?id='.$nhom[id].'"><b><font color="2c5170"><img src="/images/clan/'.$nhom[icon].'.png" alt="icon nhóm"> - '.$nhom[name].'</font></b></a><br>'.$nhom[gt].'</div></td></tr></tbody></table></td></tr></tbody></table></div></div>';
}
echo '<div class="phdr"><b>Nhóm ngẫu nhiên</b></div><div class="lucifer">';

$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom`"),0);
if($dem) {
$req = mysql_query("SELECT * FROM `nhom` ORDER BY RAND()
 DESC LIMIT 5");
while($res=mysql_fetch_array($req)) {
$nhom = nhom($res['id']);
$xx=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$nhom[user_id]."'"));
$chunhom = user_nick($nhom['user_id']);
echo'<div class="forumtext"><table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tbody><tr><td width="60px;" class="blog-avatar"><img class="avatarforum" src="../avatar/'.$nhom[user_id].'.png"></td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0"><tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left"><img src="/giaodien/images/left-blog.png"></div><a href="/member/'.$nhom[user_id].'.html"><b> '.(time()>$xx[lastdate]+300?'<img style="vertical-align:middle;" src="/images/off.png">':'<img style="vertical-align:middle;" src="/images/on.png">').' </b></a><b><a href="/member/'.$nhom[user_id].'.html"><b><span style="color:#ff1234">'.$chunhom[name].'<span style="color:#ff1234;"> - Hội Trưởng</span></span></b></a></b><div class="text"><a href="page.php?id='.$nhom[id].'"><b><font color="2c5170"><img src="/images/clan/'.$nhom[icon].'.png" alt="icon nhóm"> - '.$nhom[name].'</font></b></a><br>'.$nhom[gt].'</div></td></tr></tbody></table></td></tr></tbody></table></div>';
}
if($dem > 10)
echo '<div class="lucifer"><div class="login" align="center"><a href="more.php?act=nhom"><i class="fa fa-users" aria-hidden="true"></i><b> Xem thêm</b></a></div>';
} else {
echo '<div class="omenu" align="center">Chưa có clan nào!</div></div>';
}
echo '</div>';
require('../incfiles/end.php');
?>