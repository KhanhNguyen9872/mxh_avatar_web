<?php
//Code by ID Thiên Ân
//Facebook: https://facebook.com/idthienan
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
$textl = 'Khu sinh thái';
require('../../incfiles/head.php');
if(!$user_id){
echo '<div class="mainblok">
<div class="danhmuc"><b>Lỗi Truy Cập</b></div>';
echo '<div class="menu list-top">Vui lòng đăng nhập để sử dụng tính năng này!</div>';
echo '</div>';
require('../../incfiles/end.php');
exit;
}
$prov = mysql_num_rows(mysql_query("SELECT `id` FROM `fish` WHERE `user_id` = '".$user_id."' LIMIT 1"));
if($prov < 1){
    mysql_query("INSERT INTO `fish` SET 
    `name` = '".$login."',
    `user_id` = '".$user_id."',
    `lvl` = '0',
    `money` = '400',
    `time` = '0',
    `vsego` = '0',
    `rand_time` = '0',
    `status` = '0',
    `loc` = '0',
    `kg` = '0',
    `sorv` = '0'
    ");
    
    mysql_query("INSERT INTO `fish_in` SET 
    `user_id` = '".$user_id."',
    `ud` = '0',
    `ud_d` = '0',
    `kr` = '0',
    `kr_d` = '0',
    `ka` = '0',
    `ka_d` = '0',
    `na` = '0',
    `na_d` = '0'
    ");
}

mysql_query("UPDATE `fish` SET `time` = '0', `rand_time` = '0', `status` = '0' WHERE `user_id` = '".$user_id."' LIMIT 1");
mysql_query("UPDATE `users` SET `cancau`='".$datauser[savecancau]."',`docamtay`='0' WHERE `id`='".$user_id."'");
$act = $_GET['act'];
switch ($act) {
default:
?>

<style>
.honuoc{background-image:url("https://i.imgur.com/Du8u1ro.jpg");}
.nenho{background-image:url("https://i.imgur.com/mVCmnDb.jpg");}
</style>

<div>
<div class="phdr"><center> Câu Cá </center></div>
<div><div><div>
<div class="honuoc">
<br><br><br><br>
<br><br>
<br>
</center>

</div>
<div class="nenho">
<a href="fish.php"><center>

<img src="https://i.imgur.com/URWak6y.jpg">

</a>
</div>

<div class="da">



<img src="http://4rumvn.net/khusinhthai/img/4.png">
<img src="http://4rumvn.net/khusinhthai/img/10.png">

</div>
</div>
<?
 echo '<div class="da">';

while($pr = mysql_fetch_array($req))
    {
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$pr[user_id]."'"));
$flip=rand(1,2);
if($flip==1) {$flip=' class="flip"';}
else {$flip='';}
       
  
?>




 
 



<?php
      
   }

    ?>
<style>
.xe1{height:100px;}
</style>
     <?php
echo'






<div class="xe1">

<div id="wrapper">
    <div id="content">
   
   </div>
<center>
    <img src="https://realtimeapi.io/wp-content/uploads/2018/06/0_P-Qpk_dV1vLSutGq.gif" width="30%" id="loading" alt="loading" style="display:none;" />
    </center>


   </div>    </div> 


<a data-toggle="modal" data-target="#laibuon"><img src="http://4rumvn.net/khusinhthai/img/shopcauca.png"></a>
<a data-toggle="modal" data-target="#bxh1"><img src="http://4rumvn.net/khusinhthai/img/bxh.png"></a>
<a data-toggle="modal" data-target="#laibuon"><img src="http://4rumvn.net/khusinhthai/ThoCau.gif"></a><br>
<a data-toggle="modal" data-target="#exampleModal" ><img src="https://video.bts47.com/icon/npcanhbakhia.gif"></a>


 <center><a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a></center>'; 
echo'<br><form>
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
<div class="modal fade" id="bxh1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
       
       
       
                             <?php include("bangxephang.php"); ?>
       
       
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>  </div>  </div>  </div> </div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
       
       
       
                                  
                            <div class="da"><div><div class="phdr">Anh Ba Khía</div><table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tr><td width="50px;" class="blog-avatar"><img src="https://video.bts47.com/icon/npcanhbakhia.gif"/></td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0"><tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left"><img src="//4rumvn.net/giaodien/images/left-blog.png"></div><img src="//4rumvn.net/images/on.png" alt="online"/><font color="red"> <b> Phù Thủy </b></font><div class="text"><div class="omenu"><a href="nhakho.php"> Kho Cá Đã Câu</a></div><div class="omenu"><a href="phuthuy.php"> Đổi Màu Tên </a></div><div class="omenu"><a href="rename.php"> Đổi Tên NV<a/></div>

<div class="omenu"><a href="?act=kunai"> Đổi Kunai</a></div><div class="omenu"><a href="idthienan_antrom.php"> Ăn Trộm Farm<a/></div>

</div></div></td></tr></tbody></table></td></tr></tbody></table><script type="text/javascript">
$('#s').click(function() {  
$('#ss').toggle('fast','linear');  
}); 
$('#sss').click(function() {  
$('#ssss').toggle('fast','linear');  
});
$('#mo').click(function (){
$('#mo1').toggle('fast','linear');
}); 
</script>
<style>
a:hover 
{text-decoration:none;
color:#D570EE;
text-decoration:none;
font-weight:bold;
background-image:url("//4rumvn.net/icon/timbay.gif");
}

.node--newIndicator {
    font-size: 11px;
    color: #fefefe;
    background: #ff7f50;
    border-radius: 4px;
    padding-top: 3px;
    padding-right: 6px;
    padding-bottom: 3px;
    padding-left: 6px;
    text-transform: uppercase;
}
</style>
       
       
       
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>  </div>  </div>  </div>  </div> </div>























<!-- Modal -->
<div class="modal fade" id="laibuon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">  <center>
       <a href="//fb.com/idthienan">  <img src="https://graph.facebook.com/v3.3/100021100912869/picture?type=normal"><br>
       
       <h2><font color="red"><b> ID Thiên Ân </b></font></h2></a>
        <br>
Developer By ID Thiên Ân! => FB.Com/idthienan 
        </center></h5>
  
       
      </div>
      <div class="modal-body">
      <?php include("shop.php"); ?>


        </div>
   <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
</div></div></td></tr></tbody></table></td></tr></tbody></table>









<?
if(isset($_POST['batdau'])) {
echo '<META HTTP-EQUIV="refresh" CONTENT="0; URL=index.php?act=batdau">';
}
break;
case 'batdau':
?>
<div class="mainblok">
<div class="honuoccauca">
<div class="ngoicau">
<img src="<?echo '/avatar/' . $datauser['id'] . '.png" alt="' . $datauser['name'] . '"';?> style="vertical-align: 20px;">
</div></div>
<?php
echo '<form method="post">';
echo '<select name="cancau">';
$cc1=mysql_fetch_array(mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `id_loai`='1' AND `loai`='cancau'"));
$cc2=mysql_fetch_array(mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `id_loai`='2' AND `loai`='cancau'"));
$cc3=mysql_fetch_array(mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `id_loai`='3' AND `loai`='cancau'"));
if ($cc1[doben]>0) {
echo '<option value="1"> Cần câu tre ['.$cc1[doben].'%]</option>';
}
if ($cc2[doben]>0) {
echo '<option value="2"> Cần câu sắt ['.$cc2[doben].'%]</option>';
}
if ($cc3[doben]>0) {
echo '<option value="3"> Cần câu VIP ['.$cc3[doben].'%]</option>';
}
if ($cc1[doben]==0&&$cc2[doben]==0&$cc3[doben]==0) {
echo '<option> Chưa có cần câu!</option>';
}
echo '</select>';
echo '<select name="moicau">';
$moi1=mysql_fetch_array(mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `id_loai`='1' AND `loai`='moicau'"));
$moi2=mysql_fetch_array(mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `id_loai`='2' AND `loai`='moicau'"));
$moi3=mysql_fetch_array(mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `id_loai`='3' AND `loai`='moicau'"));
if ($moi1[doben]>0) {
echo '<option value="1"> Mồi cơm ['.$moi1[doben].' mồi]</option>';
}
if ($moi2[doben]>0) {
echo '<option value="2"> Mồi trùng ['.$moi2[doben].' mồi]</option>';
}
if ($moi3[doben]>0) {
echo '<option value="3"> Mồi trứng kiến ['.$moi3[doben].' mồi]</option>';
}
if ($moi1[doben]==0&&$moi2[doben]==0&$moi3[doben]==0) {
echo '<option> Chưa có mồi!</option>';
}
echo '</select>';
echo '<input type="submit" name="dicau" value="Câu">';
echo '</form></div>';
if(isset($_POST['giang'])) {
echo '<META HTTP-EQUIV="refresh" CONTENT="0; URL=index.php?act=giang">';
}
break;
case 'giang':
?>
<div class="mainblok">
<div class="honuoccauca">
<div class="ngoicau">
<img src="<?echo '/avatar/' . $datauser['id'] . '.png" alt="' . $datauser['name'] . '"';?> style="vertical-align: 20px;">
<img src="img/giangcau.png" alt="icon" style="vertical-align: 8px;">
<form method="post">
<input type="submit" name="cau" value="Giật">
</form>
</div></div></div></div></div>
<?
break;
}
echo' </div> </div> ';
require('../../incfiles/end.php');
?>


<script type="text/javascript">
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