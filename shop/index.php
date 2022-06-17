<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Khu mua sắm';
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

echo '<div style="max-width:900px;width:auto;">';
echo '<div class="phdr"><center>Khu Mua Sắm </center></div>';
if(date("G")<19 && date("G")>=6) {echo '<div class="nhasang" style="height:120px; margin:0;"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div>';}
else {echo '<div class="nhatoi"></div>';}
echo '<div class="le"></div>';
echo '<div class="cola" style="height:70px;margin:0;"><img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 0;z-index:0;"/>
<img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 100px;z-index:0;"/>
<img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 200px;z-index:0;"/>
<img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 300px;z-index:0;"/>
<img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 400px;z-index:0;"/>
<img src="/icon/cay.png" alt="icon" style="position:absolute;margin:-35px 0 0 500px;z-index:0;"/>
<a href="/shop/list.php"><img src="/icon/shop.png" alt="icon" style="position:absolute;margin:-30px 0 0 10px;z-index:1;"/></a>
<a href="vatpham.php"><img src="/icon/nangcap.png" alt="icon" style="position:absolute;margin:-35px 0 0 200px;z-index:0;"/></a>
<a href="nangcap.php?act=index"><img src="/icon/kimhoan.gif" alt="icon" style="position:absolute;margin:40px 0 0 180px;z-index:1;"/></a>
<a href="/shop/myvien.php"><img src="/icon/myvien.png" alt="icon" style="position:absolute;margin:-30px 0 0 400px;z-index:1;"/></a>
<img src="/icon/choxebuyt.png" alt="icon" style="position:absolute;margin:140px 0 0 100px;z-index:0;"/></div>';

//update nơi đang online và tọa độ



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



<div class="da">







<style>
.xe1{height:100px;}
</style>


<div class="xe1">
<center>
<div id="wrapper">
    <div id="content">
   
  
   
  
    <img src="https://realtimeapi.io/wp-content/uploads/2018/06/0_P-Qpk_dV1vLSutGq.gif" width="25%" id="loading" alt="loading" style="display:none;" />
    </div>


   </div>  </div>


<?php

echo'  <a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a></center>'; 
echo'<br><br><br><br><form>
<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br><div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br><div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form>';



//end avatar




}
////////CODE WAP Ở ĐÂY
if ($the == 'wap')
{
echo '<div class="phdr"><center> Khu mua sắm </center></div>';
if(date("G")<19 && date("G")>=6) {echo '<div class="nhasang" style="height:120px; margin:0;"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div>';}
else {echo '<div class="nhatoi"></div>';}
echo '<div class="le"></div>';
echo '<div class="nennhatu">';
?>
<a href="list.php"><img src="/icon/shop.png"></a> 
<a href="vatpham.php"><img src="/icon/nangcap.png"></a> 
<a href="myvien.php"><img src="https://i.imgur.com/9CET9Tf.png"></a> 
<a href="myvien.php"><img src="/icon/myvien.png"></a> 
<?php
echo '</div>';
echo '<div class="da">';
//--code này copy để hiện avatar by cRoSsOver--//
//update nơi đang online và tọa độ
mysql_query("UPDATE `vitri` SET `time`='".time()."',`online`='".$textl."',`toado`='".$toado."' WHERE `user_id`='".$user_id."'");
$time=time()-300;
//bắt đầu cho hiện avatar
$req=mysql_query("SELECT * FROM `vitri` WHERE `online`='".$textl."' AND `time`>'".$time."'");
echo '<center>

<a href="nangcap.php?act=index"><img src="/icon/kimhoan.gif"></a>
<a href="myvien.php"><img src="http://4rumvn.net/avatar/premium.gif"></a>

</center>';

?>

<style>
.nv{
     position:absolute;font-size: 9px;color:red;font-weight:bold;text-align: center;
}

</style>





<?php



echo'


<div class="da">







<style>
.xe1{height:100px;}
</style>


<div class="xe1">
<center>
<div id="wrapper">
    <div id="content">
   
  
   
  
    <img src="https://realtimeapi.io/wp-content/uploads/2018/06/0_P-Qpk_dV1vLSutGq.gif" width="25%" id="loading" alt="loading" style="display:none;" />
    </div>


   </div>  </div>




  <a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a></center>'; 
echo'<br><br><br><br><form>
<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br><div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br><div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form>';




//end avatar

}
require('../incfiles/end.php');
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

