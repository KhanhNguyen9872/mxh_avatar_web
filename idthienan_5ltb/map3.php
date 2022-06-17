<?php
/* 
Code pokemon được viết bởi Châu Huỳnh
Vui Lòng Để Bản Quyền Nếu Bạn Là Người Có Học
Site : DanChoiViet.Me
*/
define('_IN_JOHNCMS',1);
$rootpath='../../';
include'../incfiles/core.php';
include'../incfiles/head.php';
if(!$user_id){
echo'Đăng Nhập Đi';
include'../incfiles/end.php';
exit;
}


$tuipkm = mysql_result(mysql_query("SELECT COUNT(*) FROM `tuipkm1` WHERE `user_id`='{$user_id}'"), 0);
$checkin = mysql_fetch_array(mysql_query("SELECT * FROM `tuipkm1` WHERE `user_id`='{$user_id}'"));



Echo'

<div class="phdr"><a href="index.php">Làng Chài</a> | <b><a href="index.php">Quay lại</a></b></div><div class="nhasang" style="height:120px; margin:0;"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div><div class="le"></div><div class="cola" style="min-height: 100px;margin:0"><div class="cola" style="min-height: 100px;margin:0"><div class="buico"></div><center><br><a id="click"><img src="https://i.imgur.com/wRIkSEb.gif"/></a><span id="show" style="display: none;"><div class="lucifer"><a href="#thutin"/><b><font color="red">→ Nhận Thư Tín Từ Làng Chài</a><br><a href="#nv"/><b><font color="blue">→ Thông Tin Quái Rùa Mai Đỏ</a></font><br><a href="#hd"/><b><font color="green">→ Hướng Dẫn Làng Chài</a></font></div></td></span><br></center><br><br><center><a href="map4.php"/><font color="white"><b>Map Rùa Mai Đỏ</font></b><br><img src="/icon/vao.gif"/></a></center>







<center>
<a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br>


<img src="'.$checkin['img'].'"></label></a></center><br/><div class="buico"></div>

</div><div class="omenu"><center><form><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"><br />
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
 <input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓"> </form></center></div></div>



<center><div class="omenu"><a href="/idthienan_5ltb" /><img src="/icon/vao.gif" />[Trở Về Làng]<img src="/icon/vao.gif" /></a></div></center>

';








Echo'<div><div>';
include'../incfiles/end.php';



?>







<script type="text/javascript"> 
$('#click').click(function() {  
$('#show').toggle('fast','linear');  
}); 
</script>