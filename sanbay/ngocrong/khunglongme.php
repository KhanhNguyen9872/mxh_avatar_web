<?php
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
$textl = 'Làng Kakarot';
require('../../incfiles/head.php');
if(!$user_id){

header('Location: /login.php');

require('../../incfiles/end.php');
exit;
}
echo'<link rel="stylesheet" href="http://4rumvn.net/sanbay/ngocrong/game.css" type="text/css">';
echo '<div class="phdr"><center> Ngọc Rồng</center></div>';
echo '<div class="canhngocrong2" style="height:78px"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div>';

echo '<div class="canhngocrong3" style="height:78px;margin:-58px 0 0 0px"></div>';
echo '<div class="canhngocrong" style="height:100px;margin:-69px 0 0 0px"></div>';
echo '<div class="canhngocrong1" style="height:100px;margin:-27px 0 0 0px"><center>';


echo'


<a href="doihoan.php"><img style="float:left;margin-left"/ src="http://4rumvn.net/icon/vao.gif" ></a>
<a href="#update"><img style="float:right;margin-right"/ src="http://4rumvn.net/icon/vao.gif" ></a>






</div>';


echo'<div class="canhngocrong5" style="height:27px"></div>';
echo'<div class="canhngocrong4" style="height:78px">';



Echo'<img style="position:absolute;margin:-120px 0 0 190px" src="https://video.bts47.com/icon/tramtauvutru.png">';
echo'<a href="xayda3.php"><button type="button" style="position:absolute;margin:-90px 0 0 168px"   class="btn btn-light">Trạm Tàu Vũ Trụ</button></a>';




?>
 
   
<?php

   Echo'<div  style="position:absolute;margin:-65px 0 0 140px"><a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png" ></label></a> </div>'; 
echo'<br><br><br><br><div class="list1"><br><form>
<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br><div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br><div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form><br></div>';

?>

<style>
.xe1{height:100px;}
</style>

</div>
<?php echo'
<div class="xe1">

<div id="wrapper">
<center>
    <div id="content">
   
   </div>
  </center>
    <img src="https://realtimeapi.io/wp-content/uploads/2018/06/0_P-Qpk_dV1vLSutGq.gif" width="25%" id="loading" alt="loading" style="display:none;" />
    


   </div></div>
 
'; ?>







<?php






    echo '<div><br><div>';
require('../../incfiles/end.php');
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
            $container.load('idthienan_realtime-nv1.php');
        }, 15000);
    });
})(jQuery);
</script>
