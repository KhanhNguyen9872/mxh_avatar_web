<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl = 'Upload ảnh-Ảnh của tôi';
require('../incfiles/head.php');
$id = isset($_GET['id']) ? intval($_GET['id']):$user_id;
echo '<div class="phdr"><a href="'.$home.'">Trang chủ</a> »  <a href="'.$home.'/upanh">Upload ảnh</a> » <b>'.nick($id).'</b></div>';
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM `imgupload` WHERE `user` = '$id'"),0);
if($tong > 0){
$reg = mysql_query("SELECT * FROM `imgupload` WHERE `user` = '$id' ORDER BY `time` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_assoc($reg)){
echo '<div class="lucifer"><center><a href="showimg.php?id='.$res['id'].'"><img style="padding:2px;border:1px solid #D2D1D1;" src="'.$res['url'].'" width="100" height="70" alt="Hình ảnh upload Gocpho.biz"></a></center>'.functions::display_date($res['time']).' ('.$res['size'].'KB) » <a href="delete.php?id='.$res['id'].'">Xóa</a></div>';
}
} else {
echo '<div class="list1">'.nick($id).' chưa upload ảnh nào </div>';
}
if ( $tong > $kmess ){echo '<div class="quote">' . functions :: display_pagination ( 'file.php?' , $start , $tong , $kmess ) . '</div>' ;}

echo '<div class="phdr">Tổng: '.$tong.' ảnh</div>';
echo'<div><div>';
require('../incfiles/end.php');
?>