<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl = 'Khu Công Viên';

if (!$user_id) {
header('Location: /login.php');
exit;
}
date_default_timezone_set("Asia/Saigon");
if (isset($_COOKIE['the']))
{
$the = $_COOKIE['the'];
}
elseif (!$is_mobile)
{
$the = 'web';
} else {
$the = 'wap';
}
////////CODE WEB Ở ĐÂY
if ($the == 'web')
{
?>
<style>
.nv{
     position:absolute;font-size: 9px;color:red;font-weight:bold;text-align: center;
}

</style>
<?php
//--code này copy để hiện avatar by cRoSsOver--//
$toado=rand(1,42);
if($toado==1) {$toado='0';}
elseif($toado==2) {$toado='0 0 0 40px';}
elseif($toado==3) {$toado='0 0 0 80px';}
elseif($toado==4) {$toado='0 0 0 120px';}
elseif($toado==5) {$toado='0 0 0 160px';}
elseif($toado==6) {$toado='0 0 0 200px';}
elseif($toado==7) {$toado='0 0 0 240px';}
elseif($toado==8) {$toado='0 0 0 280px';}
elseif($toado==9) {$toado='0 0 0 320px';}
elseif($toado==10) {$toado='0 0 0 360px';}
elseif($toado==11) {$toado='0 0 0 400px';}
elseif($toado==12) {$toado='0 0 0 440px';}
elseif($toado==13) {$toado='0 0 0 460px';}
elseif($toado==14) {$toado='40px 0 0 0';}
elseif($toado==15) {$toado='70px 0 0 0;z-index: 9999999;';}
elseif($toado==16) {$toado='70px 0 0 40px;z-index: 9999999;';}
elseif($toado==17) {$toado='70px 0 0 80px;z-index: 9999999;';}
elseif($toado==18) {$toado='70px 0 0 120px;z-index: 9999999;';}
elseif($toado==19) {$toado='70px 0 0 160px;z-index: 9999999;';}
elseif($toado==20) {$toado='70px 0 0 200px;z-index: 9999999;';}
elseif($toado==21) {$toado='70px 0 0 240px;z-index: 9999999;';}
elseif($toado==22) {$toado='70px 0 0 280px;z-index: 9999999;';}
elseif($toado==23) {$toado='70px 0 0 320px;z-index: 9999999;';}
elseif($toado==24) {$toado='70px 0 0 360px;z-index: 9999999;';}
elseif($toado==25) {$toado='70px 0 0 400px;z-index: 9999999;';}
elseif($toado==26) {$toado='70px 0 0 440px;z-index: 9999999;';}
elseif($toado==27) {$toado='70px 0 0 460px;z-index: 9999999;';}
elseif($toado==28) {$toado='50px 0 0 40px;z-index: 999999;';}
elseif($toado==29) {$toado='50px 0 0 60px;z-index: 999999;';}
elseif($toado==30) {$toado='50px 0 0 80px;z-index: 999999;';}
elseif($toado==31) {$toado='50px 0 0 100px;z-index: 999999;';}
elseif($toado==32) {$toado='50px 0 0 120px;z-index: 999999;';}
elseif($toado==33) {$toado='50px 0 0 140px;z-index: 999999;';}
elseif($toado==34) {$toado='40px 0 0 160px';}
elseif($toado==35) {$toado='40px 0 0 200px';}
elseif($toado==36) {$toado='40px 0 0 240px';}
elseif($toado==37) {$toado='40px 0 0 280px';}
elseif($toado==38) {$toado='40px 0 0 320px';}
elseif($toado==39) {$toado='40px 0 0 360px';}
elseif($toado==40) {$toado='40px 0 0 400px';}
elseif($toado==41) {$toado='40px 0 0 440px';}
elseif($toado==42) {$toado='40px 0 0 460px';}


echo '';
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
echo '';



}
////////CODE WAP Ở ĐÂY
if ($the == 'wap')
{


?>
<style>
.nv{
     position:absolute;font-size: 9px;color:red;font-weight:bold;text-align: center;
}

</style>
<?php
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


}











?>