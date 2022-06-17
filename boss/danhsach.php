<?php
define('_IN_JOHNCMS', 1);
$noionline = 'boss';
require('../incfiles/core.php');
$textl= 'Boss Online';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="danhmuc"><img src="/icon/caycotlua.gif"> Boss Online</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo'<div class="menu list-bottom congdong"><a href="/boss/taophong.php"><input type="button" value="Tạo phòng mới" class="buttonxoan" /></a></div>';
echo'<div class="bautroiboss">';
echo'<img src="img/nhaboss.png" alt="icon" style="margin-bottom: -65px"/>';
echo'<div class="hangraoboss"></div>';
echo'<div class="datboss" style="height: 40px;"><a href="/boss/bxh.php"><img src="/icon/bxh.png"></a></div>';
echo'<div class="datboss"><br>';
$req=mysql_query("SELECT * FROM `boss` WHERE `wait`!='4'  ORDER BY `id`");
while ($res = mysql_fetch_array($req)) {
if (empty($res['user_id']) && empty($res['nguoichoi']) && empty($res['nguoichoi2']) && empty($res['nguoichoi3'])) {
mysql_query("DELETE FROM `boss` WHERE `id`='".$res['id']."'");
}
if (!empty($res['nguoichoi'])) {$songuoichoi = 1;}
if (!empty($res['nguoichoi2'])) {$songuoichoi2 = 1;}
if (!empty($res['nguoichoi3'])) {$songuoichoi3 = 1;}
$tongsonguoichoi = $songuoichoi+$songuoichoi2+$songuoichoi3+1;
echo'<a href="/boss/'.$res['id'].'">';
echo'<span class="listboss">';
if ($res['mucdo'] == 1) {echo'Dễ ';}
if ($res['mucdo'] == 2) {echo'Thường ';}
if ($res['mucdo'] == 3) {echo'Khó ';}
if ($tongsonguoichoi == 4) {
echo '[<span style="color:red">Đầy</span>]<br/>';
} else {
echo '('.$tongsonguoichoi.'/4)<br/>';
}
echo'<img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/f13de84d-8eaf-403c-868c-a5d2541b4513/dbzsspo-80bb2473-6797-4292-8729-b391a95ad2ab.png/v1/fill/w_1024,h_1244,strp/goku_black_super_saiyan_rose_by_chronofz_dbzsspo-fullview.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTI0NCIsInBhdGgiOiJcL2ZcL2YxM2RlODRkLThlYWYtNDAzYy04NjhjLWE1ZDI1NDFiNDUxM1wvZGJ6c3Nwby04MGJiMjQ3My02Nzk3LTQyOTItODcyOS1iMzkxYTk1YWQyYWIucG5nIiwid2lkdGgiOiI8PTEwMjQifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.YCUSDR11vBg34JIYDYZBFrT8biVBNYnyWmymZ1stZac" width="10%" alt="Boss" style="margin-top: 3px"/>';
 
  
  
echo'</span></a>';
}
echo'<br><br><br><br><br><br>';




echo '<center><a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a></center>';   













echo'<br><br><br><br><br><br><form> 

<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form>';


echo'</div>';
require('../incfiles/end.php');
?>