<?php
$tbboss = mysql_query("SELECT * FROM `boss_notice` WHERE `chuphong`= '" . $user_id . "' AND `view`='0' ORDER BY `time` DESC LIMIT 3");
while ($restbboss = mysql_fetch_array($tbboss)) {
if ($restbboss['type'] == 'a'){
echo'<div class="thongbaomini">';
echo'<img src="'.$home.'/boss/img/boss_new.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo nick($restbboss[nguoichoi]).' vừa sẵn sàng <a href="/boss/phong.php?id='.$restbboss['phong'].'">[ <b>phòng</b> ]</a> của bạn !';
echo '</div>';
}
if ($restbboss['type'] == 'b'){
echo'<div class="thongbaomini">';
echo'<img src="'.$home.'/boss/img/boss_new.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo nick($restbboss[nguoichoi2]).' vừa sẵn sàng <a href="/boss/phong.php?id='.$restbboss['phong'].'">[ <b>phòng</b> ]</a> của bạn !';
echo '</div>';
}
if ($restbboss['type'] == 'c'){
echo'<div class="thongbaomini">';
echo'<img src="'.$home.'/boss/img/boss_new.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo nick($restbboss[nguoichoi3]).' vừa sẵn sàng <a href="/boss/phong.php?id='.$restbboss['phong'].'">[ <b>phòng</b> ]</a> của bạn !';
echo '</div>';
}
}
?>