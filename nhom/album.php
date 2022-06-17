<?php
/*///////////////////////
/Diendanvn.me
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Album hình ảnh';
require('../incfiles/head.php');
include_once('func.php');
$id= intval(abs($_GET['id']));
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'"),0);
if(!isset($id) || $dem == 0) {
echo '<br/><div class="tb">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
echo head_nhom($id,$user_id);
echo '<div class="phdr"><b>Album hình ảnh</b></div><div class="da"><div class="lucifer">';
echo '<div class="list1"><a href="img.php?id='.$id.'"><button><i class="fa fa-camera"></i> Thêm hình ảnh</button></a></div>';
$tong =mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_bd` WHERE `sid`='$id' AND `type`='2'"),0);
if($tong) {
$req =mysql_query("SELECT * FROM `nhom_bd` WHERE `sid`='$id' AND `type`='2' ORDER BY `time` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
echo '<div class="list1">'.ten_nick($res['user_id'],0,$id).'';
if($res['type']==2) {
echo '<div class="nhom_img" align="center"><a href="cmt.php?id='.$res['id'].'"><img src="files/anh_'.$res['time'].'.jpg" alt="image" /></a></div>';
}
echo '<span class="xam">'.ngaygio($res['time']).'</span></div>';
}
if ($tong> $kmess){echo '<divclass="topmenu">' . functions::display_pagination('album.php?id='.$id.'&', $start, $tong, $kmess) . '</div>';
}
} else {
echo '<div class="list1">Không có hình ảnh nào</div>';
}
echo '<div class="list1"><a href="page.php?id='.$id.'"><i class="fa fa-reply" aria-hidden="true"></i> Trở về nhóm</a></div>';
require('../incfiles/end.php');
?>