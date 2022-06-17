<?php
$sqllambanh = mysql_query("select * from `farm_nhabep_naubanh` WHERE `user_id` = '".$user_id."' AND `type` = '1' ORDER BY `id` DESC LIMIT $start, $kmess");
while ($thongtinbanh = mysql_fetch_array($sqllambanh)){
$tenvatlieu = mysql_fetch_array(mysql_query("SELECT `tenvatlieu` FROM `farm_nhabep` WHERE `id`='".$thongtinbanh['loaibanh']."'"));
echo'<div class="thongbaomini"><img src="/farm/nhabep/icon/'.$thongtinbanh['loaibanh'].'.png" alt="icon" /> '.htmlspecialchars($tenvatlieu['tenvatlieu']).' đã chín rồi vào <a href="/farm/nhabep/?id='.$thongtinbanh['loaibanh'].'">[ <b>đổi điểm</b> ]</a> thôi !</div>';
if (($thongtinbanh[time] + $thongtinbanh['timexong']) < $time) {
mysql_query("UPDATE `farm_nhabep_naubanh` SET `type` = '1', `timexong` = '0', `time` = '0' WHERE `id` = $user_id LIMIT 1");
}
}
$sqltimebanh = mysql_query("select * from `farm_nhabep_naubanh` WHERE `user_id` = '".$user_id."' AND `type` = '0' ORDER BY `id` DESC LIMIT $start, $kmess");
while ($timebanh = mysql_fetch_array($sqltimebanh)){
if (($timebanh[time] + $timebanh['timexong']) < $time) {
mysql_query("UPDATE `farm_nhabep_naubanh` SET `type` = '1', `timexong` = '0', `time` = '0' WHERE `user_id` = $user_id LIMIT 1");
}
}
?>