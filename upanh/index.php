<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl = 'Upload ảnh';
require('../incfiles/head.php');
echo '<style>
.google{background:#dd4b39;color:#fff;padding:5px 10px;}
.facebook{background:#69A2FE;color:#fff;padding:5px 10px;margin-bottom:3px;}
.google:hover,.facebook:hover{color:#fff;background:#4b4b4b;box-shadow:inset 0 0 8px rgba(0,0,0,0.31),0 1px 0 rgba(255,255,255,0.8);transition:border .25s linear,color .25s linear,background-color .25s linear}

</style>';
$res = mysql_result(mysql_query("SELECT COUNT(*) FROM `imgupload` WHERE `user`='$user_id' "),0);
echo '<div class="phdr"><a href="'.$home.'">Trang chủ</a> »  <a href="'.$home.'/upanh"><b>Upload ảnh</b></a></div>
<div class="list1" style="padding:10px;"><a href="file.php?id='.$user_id.'"><span class="google">Ảnh của tôi (<b>'.$res.'</b>)</span></a><a href="upload.php"><span class="facebook"><img src="images/cloud.png">&#160;Upload Ảnh</span></a></div><div class="phdr">Top ảnh mới</div>';

$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM `imgupload`"),0);
if($tong == 0){
echo '<div class="list1">Chưa Upload ảnh nào</div>';
}
$reg = mysql_query("SELECT * FROM `imgupload` ORDER BY `time` DESC LIMIT $start,$kmess");
while($res=mysql_fetch_assoc($reg)){
echo '<div class="lucifer"><center><a href="showimg.php?id='.$res['id'].'"><img style="padding:2px;border:1px solid #D2D1D1;" src="'.$res['url'].'" width="100" height="70" alt="Hình ảnh upload Gocpho.biz"></a></center>'.nick($res['user']).' » '.functions::display_date($res['time']).' » '.$res['size'].'KB</div>';
}
if ( $tong > $kmess ){echo '<div class="quote">' . functions :: display_pagination ( 'index.php?' , $start , $tong , $kmess ) . '</div>' ;}
echo'<div><div>';
require('../incfiles/end.php');
?>