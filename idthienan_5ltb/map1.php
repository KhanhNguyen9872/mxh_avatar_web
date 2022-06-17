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
<div class="phdr"><center>Bìa Rừng</center></div><div class="canh2"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div><div class="canh4"><div class="canhngocrong">

<a href="map2.php"/><img src="/icon/vao.gif"/></a>
<a href="/idthienan_5ltb" /><img src="/icon/vao.gif" style="float:right;margin-right" /></a>

</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<a href="/idthienan_5ltb/tc.php?id=1"><img src="https://i.imgur.com/Yy2vAc7.gif" style="position: absolute;vertical-align: 0px;margin:-151px 0 0 38px"/><br><span style="position: absolute;vertical-align: 0px;margin:-121px 0 0 36px"><b><font color="red"></b></font></span><img src="https://i.imgur.com/Yy2vAc7.gif" class="xavt" style="position: absolute;vertical-align: 0px;margin:-106px 0 0 171px"/><br><span style="position: absolute;vertical-align: 0px;margin:-76px 0 0 169px"><b><font color="red"></b></font></span><img src="https://i.imgur.com/Yy2vAc7.gif" class="xavt" style="position: absolute;vertical-align: 0px;margin:-232px 0 0 103px"/><br><span style="position: absolute;vertical-align: 0px;margin:-202px 0 0 101px"><b><font color="red"></b></font></span><img src="https://i.imgur.com/Yy2vAc7.gif" class="xavt" style="position: absolute;vertical-align: 0px;margin:-253px 0 0 193px"/><br><span style="position: absolute;vertical-align: 0px;margin:-223px 0 0 191px"><b><font color="red"></b></font></span><img src="https://i.imgur.com/Yy2vAc7.gif" class="xavt" style="position: absolute;vertical-align: 0px;margin:-234px 0 0 172px"/><br><span style="position: absolute;vertical-align: 0px;margin:-204px 0 0 170px"><b><font color="red"></b></font></span></a>;<a href="map3.php"/><font color="white"><b>Làng Chài</font></b><br><img src="/icon/vao.gif"/></a>



<center>
<a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br>


<img src="'.$checkin['img'].'"></label></a></center><br/><div class="buico"></div>

</div><div class="omenu"><center><form><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"><br />
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
 <input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓"> </form></center></div>';







Echo'<div><div>';
include'../incfiles/end.php';



?>







<style>
.troi {

background: url('http://4rumvn.net/biarung/img/troi.png');

}
.nenco {

background: url('http://4rumvn.net/biarung/img/ncc.png');

}

.buico{
height:24px;
background: url('http://4rumvn.net/biarung/img/buico.png');
background-repeat:repeat;
}
.bt{
height:148px;
background: url('http://4rumvn.net/biarung/img/bt.png');
background-repeat:repeat;
}
<style type="text/css">
.canh1{background:url(http://4rumvn.net/icon/rong1.png);
}
.canh2{background:url(http://4rumvn.net/icon/rong2.png)}
.canh3{
background:url(http://4rumvn.net/icon/rong3.png)
}
.canh4{
background:url(http://4rumvn.net/icon/rong4.png)
}
.canh5{
background:url(http://4rumvn.net/icon/rong5.png)
}
.canhngocrong{
background:url(http://4rumvn.net/icon/rong.png)
}
.nenkhaithac2{background:url(http://i.imgur.com/xyGmo75.png) repeat-x}
.nenkhaithac{background:url(http://i.imgur.com/MreO5M3.png) repeat-x}
</style>