<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Khu ngoại ô';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="phdr"><center>Khu ngoại ô</center></div>';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<style type="text/css"> 
.ngoaio{background:url("http://i.imgur.com/3Ai56v9.gif") no-repeat; background-size: 900px 256px;} 
</style>';
echo '<div class="menu"><div class="ngoaio" style="min-height:256px"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div><div class="cola" style="min-height: 100px;margin:0"><div class="buico"></div><a data-toggle="modal" data-target="#nhatu"><img src="/icon/giamthi.gif"></a><a href="nhatu.php"><img src="/icon/nhatu.png"></a><img src="/icon/cay.png" style="float:right"><center>';
echo'</br></br></br></br><a href="pet/npcduathu.php"><img src="/icon/duathu.gif" style="margin-top: -120px;"></a><a href="pet/duathu.php"><img src="/icon/duathu.png" style="margin-top: -120px;"></a>'; 
echo'<br/>';
?>





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
 
 <?php
 
   echo'<br><br><center><a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a></center>'; 
echo'<br><br><br><br><form>
<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br><div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br><div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form>
';
  ?>
 
 


<!-- Modal -->
<div class="modal fade" id="nhatu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
        <center>
        <img src="https://graph.facebook.com/v3.3/100021100912869/picture?type=normal"><br>
       
       <h2><font color="red"><b> ID Thiên Ân </b></font></h2>
        <br>
Developer By ID Thiên Ân! => FB.Com/idthienan 
        </center>
        
       
      </div>
      <div class="modal-body">
       
       
       
                            
          <?php include("nhatu.php"); ?>
       
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>  </div> 


 
 
 
 
 
<?php








   
echo'</center><div class="buico"></div></div>';

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



























