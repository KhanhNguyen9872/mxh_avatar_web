<?php
if(isset($_GET['xem'])) {
echo'<div class="main-xmenu">';
echo'<div class="phdr"><center>Nông Trại</center></div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}

date_default_timezone_set('Asia/Ho_Chi_Minh');
$kiemtra = date("H");
echo'<div class="cola" style="padding: 0;margin-bottom: 2px;margin-top: 3px;">'.($kiemtra >= 6 && $kiemtra <= 18? '<div class="nennongtrai"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee>' :'<div class="nennongtrai_toi">').'</div>';
echo'<div style="margin-top: -70px;text-align: center;">';
echo'<a href="/farm/"><img src="/icon/farm.png"></a><a href="/atm/"><img src="/icon/atm.png"></a>';
echo'<a href="/farm/shop.php"><img src="../icon/cuahangfarm.png"></a> 
 <br></div>';
 
 


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
 echo'<a href="laibuon.php"><img src="/icon/laibuon.gif" style="margin:-80px 0 0 60px"></a>';
 echo'';
 
echo'<div class="dat"><br>';





?>




 
  <?php
  Echo'
  <a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a>
  ';
  ?>
  
  
  <form>
<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br>
<div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br>
<div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form> </div>





<?php    
 

 
  


require('../incfiles/end.php');
exit;
}
?>
                            
                            
                            
                         <style>
.nenidthienan{
background: url('https://i.imgur.com/9SJUHJe.png') repeat-x; 
height: 28px;
	max-width: 100%;
}
.nen{
background: url('https://i.imgur.com/TWiOW1S.png') repeat ; 
height: 100px;
max-width: 100%;
}
.co{
background-image: url('https://i.imgur.com/sCnEF0u.png');
background-repeat: no-repeat;
height: 54px;
	max-width: 100%;
}
.hr{
background: url('https://i.imgur.com/fn3kXv6.png') repeat-x;
height: 20px;
	max-width: 100%;
}
.duong{
background: url('https://i.imgur.com/N1AX2mD.png') no-repeat;
height: 20px;
	max-width: 100%;
}
.nentroi{
background: url('https://i.imgur.com/IRD9IN5.png') repeat-x;
height: 80px;
	max-width: 100%;
}
</style>