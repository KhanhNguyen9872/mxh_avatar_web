<?php
$timevn1 = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi_choan` WHERE `user_id` = '".$user_id."' AND `vatnuoi` = '1' LIMIT 1"));
$timevn2 = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi_choan` WHERE `user_id` = '".$user_id."' AND `vatnuoi` = '2' LIMIT 1"));
$timevn3 = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi_choan` WHERE `user_id` = '".$user_id."' AND `vatnuoi` = '3' LIMIT 1"));
$timevn4 = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi_choan` WHERE `user_id` = '".$user_id."' AND `vatnuoi` = '4' LIMIT 1"));
$timevn5 = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi_choan` WHERE `user_id` = '".$user_id."' AND `vatnuoi` = '5' LIMIT 1"));
$demvn1 = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '1'"),0);
$demvn2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '2'"),0);
$demvn3 = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '3'"),0);
$demvn4 = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '4'"),0);
$demvn5 = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."' AND `id_vatnuoi` = '5'"),0);

if ($demvn1 > 0) {
if (($timevn1[timean] + 3600) < $time) {
if ($timevn1[tinhtrang] == 2) {
if ($timevn1[xem] == 0) {
mysql_query("UPDATE `farm_vatnuoi_choan` SET `tinhtrang` = '1', `xem` = '1' WHERE `vatnuoi` = '1' AND `user_id` = '".$user_id."' LIMIT 1");
header('Location: '.$home.'/farm/');
}
}
}
}

if ($demvn2 > 0) {
if (($timevn2[timean] + 3600) < $time) {
if ($timevn2[tinhtrang] == 2) {
if ($timevn2[xem] == 0) {
mysql_query("UPDATE `farm_vatnuoi_choan` SET `tinhtrang` = '1', `xem` = '1' WHERE `vatnuoi` = '2' AND `user_id` = '".$user_id."' LIMIT 1");
header('Location: '.$home.'/farm/');
}
}
}
}

if ($demvn3 > 0) {
if (($timevn3[timean] + 3600) < $time) {
if ($timevn3[tinhtrang] == 2) {
if ($timevn3[xem] == 0) {
mysql_query("UPDATE `farm_vatnuoi_choan` SET `tinhtrang` = '1', `xem` = '1' WHERE `vatnuoi` = '3' AND `user_id` = '".$user_id."' LIMIT 1");
header('Location: '.$home.'/farm/');
}
}
}
}

if ($demvn4 > 0) {
if (($timevn4[timean] + 3600) < $time) {
if ($timevn4[tinhtrang] == 2) {
if ($timevn4[xem] == 0) {
mysql_query("UPDATE `farm_vatnuoi_choan` SET `tinhtrang` = '1', `xem` = '1' WHERE `vatnuoi` = '4' AND `user_id` = '".$user_id."' LIMIT 1");
header('Location: '.$home.'/farm/');
}
}
}
}

if ($demvn5 > 0) {
if (($timevn5[timean] + 3600) < $time) {
if ($timevn5[tinhtrang] == 2) {
if ($timevn5[xem] == 0) {
mysql_query("UPDATE `farm_vatnuoi_choan` SET `tinhtrang` = '1', `xem` = '1' WHERE `vatnuoi` = '5' AND `user_id` = '".$user_id."' LIMIT 1");
header('Location: '.$home.'/farm/');
}
}
}
}

if ($timevn1[tinhtrang] == 1 || $timevn2[tinhtrang] == 1 || $timevn3[tinhtrang] == 1 || $timevn4[tinhtrang] == 1 || $timevn5[tinhtrang] == 1) {
echo'<div class="thongbaomini">';
if ($timevn1[tinhtrang] == 1) { echo'<img src="/farm/vatnuoi/shop/1.png" alt="icon"/> '; }
if ($timevn2[tinhtrang] == 1) { echo'<img src="/farm/vatnuoi/shop/2.png" alt="icon"/> '; }
if ($timevn3[tinhtrang] == 1) { echo'<img src="/farm/vatnuoi/shop/3.png" alt="icon"/> '; }
if ($timevn4[tinhtrang] == 1) { echo'<img src="/farm/vatnuoi/shop/4.png" alt="icon"/> '; }
if ($timevn5[tinhtrang] == 1) { echo'<img src="/farm/vatnuoi/shop/5.png" alt="icon"/> '; }
echo'chúng em đói rồi cậu chủ ơi 1 ngày mà không cho ăn là chúng em chết cong đít đó nha !';
echo'</div>';
}

////// 1 ngay ko cho an chet
if ($timevn1[tinhtrang] == 1 || $timevn2[tinhtrang] == 1 || $timevn3[tinhtrang] == 1 || $timevn4[tinhtrang] == 1 || $timevn5[tinhtrang] == 1) {
if ($timevn1[tinhtrang] == 1) {
if (($timevn1[timean] + 86400) < $time) {
mysql_query("DELETE FROM `farm_vatnuoi_cuaban` WHERE `id_vatnuoi`='1'AND `user_id` = '".$user_id."'");
mysql_query("DELETE FROM `farm_vatnuoi_choan` WHERE `vatnuoi`='1' AND `user_id` = '".$user_id."'");
}
}
if ($timevn2[tinhtrang] == 1) {
if (($timevn2[timean] + 86400) < $time) {
mysql_query("DELETE FROM `farm_vatnuoi_cuaban` WHERE `id_vatnuoi`='2' AND `user_id` = '".$user_id."'");
mysql_query("DELETE FROM `farm_vatnuoi_choan` WHERE `vatnuoi`='2' AND `user_id` = '".$user_id."'");
}
}
if ($timevn3[tinhtrang] == 1) {
if (($timevn3[timean] + 86400) < $time) {
mysql_query("DELETE FROM `farm_vatnuoi_cuaban` WHERE `id_vatnuoi`='3'AND `user_id` = '".$user_id."'");
mysql_query("DELETE FROM `farm_vatnuoi_choan` WHERE `vatnuoi`='3' AND `user_id` = '".$user_id."'");
}
}
if ($timevn4[tinhtrang] == 1) {
if (($timevn4[timean] + 86400) < $time) {
mysql_query("DELETE FROM `farm_vatnuoi_cuaban` WHERE `id_vatnuoi`='4'AND `user_id` = '".$user_id."'");
mysql_query("DELETE FROM `farm_vatnuoi_choan` WHERE `vatnuoi`='4' AND `user_id` = '".$user_id."'");
}
}
if ($timevn5[tinhtrang] == 1) {
if (($timevn5[timean] + 86400) < $time) {
mysql_query("DELETE FROM `farm_vatnuoi_cuaban` WHERE `id_vatnuoi`='5'AND `user_id` = '".$user_id."'");
mysql_query("DELETE FROM `farm_vatnuoi_choan` WHERE `vatnuoi`='5' AND `user_id` = '".$user_id."'");
}
}
}
?>