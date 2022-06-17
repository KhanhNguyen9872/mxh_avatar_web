<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Boss Online';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc"><img src="/icon/caycotlua.gif">  Boss Online</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="bautroiboss">';
echo'<a href="/boss/danhsach.php"><img src="img/nha.png" alt="icon" style="margin-bottom: -65px"/></a>';
echo'<div class="hangraoboss"></div>';
echo'<div class="datboss" style="height: 120px;"><div class="left"><a href="/shop/vatpham.php"><img src="/icon/iconxoan/da.png"></a><a href="/boss/bacsi.php"><img src="img/bs.gif"></a></div></div>';
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
   echo'  <br><br>';
      echo '<a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a>';   
echo'<br><br><form> 

<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form>'; 
     
//end avatar
echo'</div><div class="buico">';
echo'</div>';
echo '</div>';
echo '</div>';
require('../incfiles/end.php');
?>