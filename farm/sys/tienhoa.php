<?php
$vatnuoitruyvanth = mysql_query("select * from `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."'");
while ($vatnuoitienhoa = mysql_fetch_array($vatnuoitruyvanth)){
$thongtinvatnuoi = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi` WHERE `id` = '".$vatnuoitienhoa['id_vatnuoi']."'"));
$thuhoachga = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '1'"),0);
$thuhoachbo = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '2'"),0);
$thuhoachcuu = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '3'"),0);
if ($vatnuoitienhoa['tienhoa'] == 1) {
if (($vatnuoitienhoa['timetienhoa']+$thongtinvatnuoi['timelon']) < $time) {
mysql_query("UPDATE `farm_vatnuoi_cuaban` SET `tienhoa` = '2', `timesanluong` = '".time()."' WHERE `id` = '".$vatnuoitienhoa[id]."'");
if ($vatnuoitienhoa[id_vatnuoi] == 1) {
$autotrung = rand(15,20);
if ($thuhoachga > 0) {
mysql_query("UPDATE `farm_vatnuoi_sanluong` SET `soluong` = `soluong`+'".$autotrung."' WHERE `user_id` = '".$user_id."' AND `type`='1'");
} else {
mysql_query("INSERT INTO `farm_vatnuoi_sanluong` SET `user_id`='" . $user_id. "', `type`='1', `soluong`='".$autotrung."'");
}
}


if ($vatnuoitienhoa['id_vatnuoi'] == 3) {
$thuhoach = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '2'"),0);
$autosua = rand(150,250);
if ($thuhoachbo > 0) {
mysql_query("UPDATE `farm_vatnuoi_sanluong` SET `soluong` = `soluong`+'".$autosua."' WHERE `user_id` = '".$user_id."' AND `type`='2'");
} else {
mysql_query("INSERT INTO `farm_vatnuoi_sanluong` SET `user_id`='" . $user_id. "', `type`='2', `soluong`='".$autosua."'");
}
}


if ($vatnuoitienhoa['id_vatnuoi'] == 4) {
$thuhoach = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '3'"),0);
$autolongcuu = rand(100,150);
if ($thuhoachcuu > 0) {
mysql_query("UPDATE `farm_vatnuoi_sanluong` SET `soluong` = `soluong`+'".$autolongcuu."' WHERE `user_id` = '".$user_id."' AND `type`='3'");
} else {
mysql_query("INSERT INTO `farm_vatnuoi_sanluong` SET `user_id`='" . $user_id. "', `type`='3', `soluong`='".$autolongcuu."'");
}
}
}
}
}
?>