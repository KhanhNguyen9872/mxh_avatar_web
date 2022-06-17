<?php
define('_IN_JOHNCMS', 1);
require('../../incfiles/core.php');
$textl= 'Boss Online';
require('../../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Boss Online</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../../incfiles/end.php');
exit;
}
echo'<div class="bautroiboss">';
echo'<a href="/boss/danhsach.php"><img src="/Style/4rum/images/nha.png" alt="icon" style="margin-bottom: -65px"/><img src="/khugiaitri/cauca/img/vao.gif" style="margin-bottom: -85px; margin-left:-115px;"></a>';
echo'<div class="hangraoboss"></div>';
echo'<div class="datboss">';
//--code này copy để hiện avatar by cRoSsOver--//
//update nơi đang online và tọa độ
mysql_query("UPDATE `vitri` SET `time`='".time()."',`online`='".$textl."',`toado`='".$toado."' WHERE `user_id`='".$user_id."'");
$time=time()-300;
//bắt đầu cho hiện avatar
$req=mysql_query("SELECT * FROM `vitri` WHERE `online`='".$textl."' AND `time`>'".$time."'");
while($pr = mysql_fetch_array($req))
    {
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$pr[user_id]."'"));
$flip=rand(1,2);
if($flip==1) {$flip=' class="flip"';}
else {$flip='';}
        echo '<a href="/member/'.$pr['user_id'].'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$name[name].'</b><br><img src="/avatar/'.$pr[user_id].'.png"></label></a>';
    }
//end avatar
echo'</div><div class="buico">';
echo'</div>';
require('../../incfiles/end.php');
?>