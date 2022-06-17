<?PHP
Define('_IN_JOHNCMS', 1);
Require('../incfiles/core.php');
$headmod = 'Làng cổ';
$textl = 'Làng Truyền Thuyết';
Require('../incfiles/head.php');
Include('hoisinh.php');
if (!$user_id){
Header("Location: /");
exit;
}
Echo '<div class="box_forums"><br/><div class="homeforum"><div class="icon-home"><div class="home">Làng Truyền Thuyết</div></div></div></div><div class="phdr">Làng Truyền Thuyết</div>';
if($datauser['level'] < 10){
echo'<div class="menu">Bạn phải đủ level 10 để vào làng cổ</div><div><div>';
require('../incfiles/end.php');
exit;
}
Echo'<link rel="stylesheet" href="game.css" type="text/css" />
<div class="datboss">
<img src="img/caydua.png">
<img src="img/caydua.png">
<img src="img/caydua.png">';
//Hiển thị Avatar 
//Update nơi đang online và tọa độ
mysql_query("UPDATE `vitri` SET `time`='".time()."',`online`='".$textl."',`toado`='".$toado."' WHERE `user_id`='".$user_id."'");
$time=time()-300;
//Bắt đầu cho hiện avatar
$req=mysql_query("SELECT * FROM `vitri` WHERE `online`='".$textl."' AND `time`>'".$time."'");

while($pr = mysql_fetch_array($req))
    {
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$pr[user_id]."'"));
$flip=rand(1,2);
if($flip==1) {$flip=' class="flip"';}
else {$flip='';}
        Echo'<a href="/member/'.$pr['user_id'].'.html"><label style="display: inline-block;text-align: center;"><img src="/avatar/'.$pr[user_id].'.png"></label></a>';
    }
//End avatar
Echo'<div class="buico"></div>';
include('danh.php');
$req = mysql_query("SELECT * FROM `langtruyenthuyet_boss`");
while($res = mysql_fetch_assoc($req)){
if($datauser['level'] >= $res['lvboss'] || $datauser['level'] < $res['lvbossmax']){
if($res['hienthi'] == 0){
if(time() > $res['timebosschet'] + 300 ){
mysql_query("UPDATE `langtruyenthuyet_boss` SET `hienthi`='1'");
mysql_query("UPDATE `langtruyenthuyet_boss` SET `hp`=`hpfull`");
}
}
if($res['hienthi'] == 1){
if($datauser['level'] >= $res['lvboss']){Echo'<a href="?act=danh&id='.$res['id'].'"><img src="img/boss/'.$res['iconboss'].'.png"></a>';}
}
}
}
Echo'<div class="buico"></div>
</div>
<div class="phdr">Chức năng</div>
<div class="omenu">
<a href="?act=bomhp">Bơm HP</a>|
<a href="?act=bommp">Bơm MP</a>|
</div>';
switch ($act){
default: 
break;
case 'bomhp':
$bomhp = '10000';
mysql_query("UPDATE `users` SET `hp` = `hp` + $bomhp WHERE `id` = $user_id");
Echo'<script type="text/javascript">alert("Bạn đã bơm '.$bomhp.' HP thành công");</script>';
break;
case 'bommp':
$bommp = '10000';
mysql_query("UPDATE `users` SET `mp` = `mp` + $bommp WHERE `id` = $user_id");
Echo'<script type="text/javascript">alert("Bạn đã bơm '.$bommp.' MP thành công");</script>';
break;
}
echo'<div><div>';
Require('../incfiles/end.php');
?>