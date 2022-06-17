<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Khu giải trí';
require('../incfiles/head.php');
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

echo '<div class="phdr"><center>Khu Giải Trí </center></div>';
if(date("G")<19 && date("G")>=6) {echo '<div class="nencay" style="height:120px; margin:0;"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div>';}
else {echo '<div class="nhatoi"></div>';}
echo '<div class="le"></div>';
echo '<div class="cola" style="height:70px;margin:0;"><img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 0;z-index:0;"/>
<img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 100px;z-index:0;"/>
<img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 200px;z-index:0;"/>
<img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 300px;z-index:0;"/>
<img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 400px;z-index:0;"/>
<img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 500px;z-index:0;"/>
<a href="/khugiaitri/game.php"><img src="/icon/game.png" alt="icon" style="position:absolute;margin:10px 0 0 10px;z-index:1;"/></a>

<a href="/shop/pet.php"><img src="/icon/iconxoan/cuahangpet.png" alt="icon" style="position:absolute;margin:-10px 0 0 300px;z-index:1;"/></a>
<a href="/shop/gift.php"><img src="/icon/iconxoan/gift.png" alt="icon" style="position:absolute;margin:-15px 0 0 450px;z-index:1;"/></a>
<img src="/icon/choxebuyt.png" alt="icon" style="position:absolute;margin:140px 0 0 100px;z-index:0;"/></div>';


echo'


<div class="da">







<style>
.xe1{height:100px;}
</style>


<div class="xe1">

<div id="wrapper">
    <div id="content">
   
   </div>
   <center>
    <img src="https://realtimeapi.io/wp-content/uploads/2018/06/0_P-Qpk_dV1vLSutGq.gif" width="25%" id="loading" alt="loading" style="display:none;" />
    

</center>
   </div></div>
 




   <br><br><center><a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a></center>'; 
echo'<br><br><br><br><form>
<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br><div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br><div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form>









<div>

';







}
////////CODE WAP Ở ĐÂY
if ($the == 'wap')
{

echo '<div class="phdr"><center> Khu Giải Trí </center></div>';
if(date("G")<19 && date("G")>=6) {echo '<div class="nencay" style="height:120px; margin:0;"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div>';}
else {echo '<div class="nhatoi"></div>';}
echo '<div class="le"></div>';
echo '<div class="nennhatu">';
?>
<a href="/khugiaitri/game.php"><img src="/icon/game.png"></a>
<a href="/khugiaitri/honnhan.php"><img src="/icon/chuhon.png"></a>
<a href="/shop/pet.php"><img src="/icon/iconxoan/cuahangpet.png"></a>
<a href="/shop/gift.php"><img src="/icon/iconxoan/gift.png"></a>






<style>
.xe1{height:100px;}
</style>


<div class="xe1">

<div id="wrapper">
    <div id="content">
   
   </div>
   <center>
    <img src="https://realtimeapi.io/wp-content/uploads/2018/06/0_P-Qpk_dV1vLSutGq.gif" width="25%" id="loading" alt="loading" style="display:none;" />
    

</center>
   </div> </div> 










<?php
echo '

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
       
    }
//end avatar
echo'<div>';
}






?>


<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
(function($)
{
    $(document).ready(function()
    {
        $.ajaxSetup(
        {
            cache: false,
            beforeSend: function() {
                $('#content').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                $('#content').show();
            },
            success: function() {
                $('#loading').hide();
                $('#content').show();
            }
        });
        var $container = $("#content");
        $container.load("idthienan_realtime-nv.php");
        var refreshId = setInterval(function()
        {
            $container.load('idthienan_realtime-nv.php');
        }, 15000);
    });
})(jQuery);
</script>



<?php







require('../incfiles/end.php');
?>