<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Hawaii';
$headmod='hawaii';
require('../../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="phdr"><img src="/icon/iconnguoi1.png">  Hawaii</div>';
echo '<div class="bien"><a href="shop.php"><div class="vaoshop"><br/></div></div>';
echo '<div class="nencat"><img src="/icon/ghehawai.png" alt="ghehawai" style="vertical-align: 4px;"/> <img src="/icon/duhawai.png" alt="duhawai" style="vertical-align: 4px;"/><img src="/icon/ghehawai.png" alt="ghehawai" style="vertical-align: 4px;"/><a href="npc.php"> <img src="drdoom.gif" alt="shophawai11" style="vertical-align: 4px;"/></a><img src="/icon/caydua.png" alt="caydua" style="vertical-align: 4px;"/> <img src="/icon/banghehawai.png" alt="banghehawai" style="vertical-align: 4px;"/><img src="/icon/ochawai.png" alt="ochawai" style="vertical-align: 4px;"/>';
echo '<div class="nencat">';


 


//--code này copy để hiện avatar by cRoSsOver--//
//update nơi đang online và tọa độ
mysql_query("UPDATE `vitri` SET `time`='".time()."',`online`='".$textl."',`toado`='".$toado."' WHERE `user_id`='".$user_id."'");
$time=time()-300;
//bắt đầu cho hiện avatar
$req=mysql_query("SELECT * FROM `vitri` WHERE `online`='".$textl."' AND `time`>'".$time."'");
$i=1;
while($pr = mysql_fetch_array($req))
    {
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$pr[user_id]."'"));
$flip=rand(1,2);
        echo '<a href="/member/'.$pr['user_id'].'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$name[name].'</b><br><img src="/avatar/'.$pr[user_id].'.png"></label></a>';
        $i++;
    }
    echo '</div><div>';






 echo '<a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a>';   

echo'<center><form> 

<input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br>
<div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br>
<div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  

</form></center>';









require('../../incfiles/end.php');
?>
                            