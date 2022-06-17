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
Echo'<link rel="stylesheet" href="game.css" type="text/css" />
<div class="bautroiboss">
<br><img src="img/sun1.png"><br>
<img src="img/chimtinhanh.png">
<div class="hangraoboss"></div>
<div class="datboss">
<img src="img/caydua.png">
<a href="npc.php"><img src="img/npcsoi.png"></a>
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

echo'

  <br><br><center><a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a></center>'; 
echo'<br><br><br><br><form>
<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br><div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br><div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form>

';
Echo'<div class="buico"></div>
';



Require('../incfiles/end.php');
?>