<?php
define('_IN_JOHNCMS', 1);
require('../../incfiles/core.php');
$textl='Đua Pet';
require('../../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="mainblok">';
switch($act) {
default:
echo '<div class="phdr">'.$textl.'</div><div class="lucifer">';
echo '<table>';
echo '<tr>';
echo '<td>';
echo '<img src="/icon/duathu.gif">';
echo '</td>';
echo '<td>';
echo '<div class="login"><b><font color="brown"><a data-toggle="collapse" href="#collapseExample">  Đặt cược</b></font</a></div>';
echo '<div class="login"><b><font color="brown"><a data-toggle="collapse" href="#duathu"> Hướng dẫn đua pet</b></font</a></div>';
echo '</td>';
echo '</tr>';
echo '</table>';
echo'<br><div class="collapse" id="collapseExample">
  <div class="card card-body">
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    <div class="mainblok"><div class="phdr" style="margin-bottom: 10px;"><center>Đặt cược</center></div><div class="gmenu" style="margin-bottom: 10px;"><center>Trận đấu tiếp theo sẽ diễn ra trong vòng <b>25</b>s nữa~</div></center><a id="ccc"><div class="loginred"><center><font color="green"><b>[ Mở bảng đặt cược đua pet ]</b></font></center></div><div id="cccs" style="display:none;"><a id="1"><div class="login">
<img src="https://i.imgur.com/vaeP0YQ.gif"><font color="green"><b> Rắn thợ săn  </b></font>
</div></a><div id="1s" style="display:none;"><div class="loginred">đặt cược cho Rắn thợ săn : </br>
<form method="post"  action="duathu.php">
<input type="hidden" value="1" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div><a id="2"><div class="login">
<img src="https://i.imgur.com/L4zOfQd.gif"><font color="blue"><b> Vẹt xanh </b></font>
</div></a><div id="2s" style="display:none;"><div class="loginred">đặt cược cho Vẹt xanh : </br>
<form method="post"  action="duathu.php">
<input type="hidden" value="2" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div><a id="3"><div class="login">
<img src="https://i.imgur.com/O3U3s1X.gif"><font color="brown"><b> Tuần lộc </b></font>
</div></a><div id="3s" style="display:none;"><div class="loginred">đặt cược cho Tuần lộc : </br>
<form method="post" action="duathu.php"  action="duathu.php">
<input type="hidden" value="3" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div><a id="4"><div class="login">
<img src="https://i.imgur.com/FSlh2mU.gif"><font color="black"><b> Dargon Kingnight</b></font>
</div></a><div id="4s" style="display:none;"><div class="loginred">đặt cược cho Dargon Kingnight : </br>
<form method="post"  action="duathu.php">
<input type="hidden" value="4" name="pet" >
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div><a id="5"><div class="login">
<img src="https://i.imgur.com/u2RdyKm.gif"><font color="#9E9E9E"><b> Totoro</b></font>
</div></a><div id="5s" style="display:none;"><div class="loginred">đặt cược cho Totoro : </br>
<form method="post"  action="duathu.php">
<input type="hidden" value="5" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div><a id="6"><div class="login">
<img src="https://i.imgur.com/5UGkn6O.gif"><font color="pink"><b> Bướm hồng</b></font>
</div></a><div id="6s" style="display:none;"><div class="loginred">đặt cược cho Bướm hồng : </br>
<form method="post"  action="duathu.php">
<input type="hidden" value="6" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div><a id="7"><div class="login">
<img src="https://i.imgur.com/3DWJFYF.gif"><font color="#FFEB3B"><b> Pikachu</b></font>
</div></a><div id="7s" style="display:none;"><div class="loginred">đặt cược cho Pikachu : </br>
<form method="post"  action="duathu.php">
<input type="hidden" value="7" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div></div><div class="phdr"><center>Kết quả đợt trước </center></div><style type="text/css"> 
.bbb{background:url("http://i.imgur.com/UZkcWRX.png");} 
.ccc{background:url("http://i.imgur.com/HdaO3I0.png");}
</style><div class="bbb" style="height:120px; margin:0;"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div><div class="cola" style="min-height: 20px;margin:0"><div class="buico"></div></div><div class="ccc"><marquee behavior="slide" direction="right" scrollamount="5"><img src="https://i.imgur.com/vaeP0YQ.gif"></marquee></div><div class="ccc"><marquee behavior="slide" direction="right" scrollamount=""><img src="https://i.imgur.com/L4zOfQd.gif"></marquee></div><div class="ccc"><marquee behavior="slide" direction="right" scrollamount="3"><img src="https://i.imgur.com/O3U3s1X.gif"></marquee></div><div class="ccc"><marquee behavior="slide" direction="right" scrollamount="6"><img src="https://i.imgur.com/FSlh2mU.gif"></marquee></div><div class="ccc"><marquee behavior="slide" direction="right" scrollamount="2"><img src="https://i.imgur.com/u2RdyKm.gif"></marquee></div><div class="ccc"><marquee behavior="slide" direction="right" scrollamount="7"><img src="https://i.imgur.com/5UGkn6O.gif"></marquee></div><div class="ccc"><marquee behavior="slide" direction="right" scrollamount="4"><img src="https://i.imgur.com/3DWJFYF.gif"></marquee></div><div class="cola" style="min-height: 20px;margin:0"><div class="buico"></div></div></div>';
?>


<script type="text/javascript"> 
  
  
  
  
  $('#1').click(function() {  
$('#1s').toggle('fast','linear');  
}); 
$('#2').click(function() {  
$('#2s').toggle('fast','linear');  
}); 
$('#3').click(function() {  
$('#3s').toggle('fast','linear');  
}); 
$('#4').click(function() {  
$('#4s').toggle('fast','linear');  
}); 
$('#5').click(function() {  
$('#5s').toggle('fast','linear');  
}); 
$('#6').click(function() {  
$('#6s').toggle('fast','linear');  
}); 
$('#7').click(function() {  
$('#7s').toggle('fast','linear');  
});
$('#ccc').click(function() {  
$('#cccs').toggle('fast','linear');  
});
</script><style type="text/css">
.loginred{background-color:#ecfff4;border-radius:5px;padding:8px;margin-bottom:5px;border:solid 1px #F44336;}
</style><script type="text/javascript">
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
</div>
<br><div class="collapse" id="duathu">
  <div class="card card-body">
   <div class="phdr">Hướng dẫn đua pet</div>
   <b>Bước 1 :</b> đặt cược vào con pet mà bạn muốn , và tối thiểu đặt cược là 2.000.000xu , thắng sẽ được x3 tiền đặt cược  </br> <b>Bước 2 : </b> Chờ đợi kết quả
  </div>
</div>

<?php


break;
case 'huongdan';
echo '<div class="phdr">Hướng dẫn đua pet</div>';
echo '<b>Bước 1 :</b> đặt cược vào con pet mà bạn muốn , và tối thiểu đặt cược là 2.000.000xu , thắng sẽ được x3 tiền đặt cược  </br> <b>Bước 2 : </b> Chờ đợi kết quả ';
break;
}

require('../../incfiles/end.php');
?>