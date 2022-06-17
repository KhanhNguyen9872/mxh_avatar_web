<?php
define('_IN_JOHNCMS', 1);
require('../../incfiles/core.php');
$textl = 'Khu Dân Cư';
require('../../incfiles/head.php');
echo'<div class="phdr"><center>Khu Dân Cư <a href="house.php?id=1">[Nhà mẫu]</a></center></div>';
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
require('../../incfiles/end.php');
exit;
} 
$req=mysql_query("SELECT * FROM `vitri` WHERE `online`='".$textl."' AND `time`>'".$time."'");
while($pr = mysql_fetch_array($req))
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$pr[user_id]."'"));
echo '<div class="maintxt"><div class="nhasang" style="min-height: 130px;"></div>';
echo'</div>';
echo '<div class="cotinhte" style="min-height: 300px;margin:0"><a href="house.php?id='.$user_id.'"><img src="img/npcnhadat.gif"></a><div class="right"> <br>                            ';  
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `gamemini_house`"),0);
$qs = mysql_query("SELECT * FROM gamemini_house ORDER BY taisan DESC LIMIT $start,$kmess");
While ($house = mysql_fetch_array($qs)){
echo ' <a href="house.php?id='.$house[user_id].'"><img src="'.$home.'/sanbay/dancu/img/house'.$house[level].'.png"></a>';
}
echo'</div>';

echo'<div class="buico"></div> ';
  echo' <br><br><a href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a>';
 echo'</div>'; 

if ($tong>$kmess) {
echo'<div class="buico"></div>';
echo '<div class="login">' . functions::pages('index.php?page=', $start, $tong, $kmess) . '</div>';
}
echo'<div><div>';
require('../../incfiles/end.php');
?>