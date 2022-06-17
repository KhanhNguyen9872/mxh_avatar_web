<?php
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
$textl = 'Ngọc Rồng';
require('../../incfiles/head.php');
if(!$user_id){
echo '<div class="mainblok">
<div class="danhmuc"><b>Lỗi Truy Cập</b></div>';
echo '<div class="menu list-top">Vui lòng đăng nhập để sử dụng tính năng này!</div>';
echo '</div>';
require('../../incfiles/end.php');
exit;
}

echo '<div class="phdr"><center> Ngọc Rồng</center></div> <div> <div> <link rel="stylesheet" href="https://4rumvn.net/sanbay/ngocrong/game.css" type="text/css">';
echo '<div class="canhngocrong2" style="height:78px"></div>';
echo '<div class="canhngocrong3" style="height:78px;margin:-58px 0 0 0px"></div>';
echo '<div class="canhngocrong" style="height:100px;margin:-69px 0 0 0px"></div>';
echo '<div class="canhngocrong1" style="height:100px;margin:-27px 0 0 0px"><center>

<a href="#nrsd"><img style="margin:70px 0 0 -10px" src="/icon/omegas.png"></a>
<img src="/icon/tramtauvutru.png">

<a href="tramtauxayda.php"><img style="margin:70px 0 0 -10px" src="http://4rumvn.net/icon/buma.png"></a>


</center></div>';
echo'<div class="canhngocrong5" style="height:27px"></div>';
echo'<div class="canhngocrong4" style="height:78px"></div>';




  Echo'<div  style="position:absolute;margin:-145px 0 0 140px"><a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png" ></label></a> </div>'; 
echo'<div class="list1"><br><form>
<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br><div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br><div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form><br></div>';


echo'<a href="khunglongme.php" style="position:absolute;margin:-330px 0 0 80px"><button type="button" class="btn btn-light">Khung Long Mẹ</button></a>';




require('../../incfiles/end.php');
?>