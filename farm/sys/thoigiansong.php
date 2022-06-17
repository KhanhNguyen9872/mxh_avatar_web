<?php
$songvatnuoi = mysql_query("select `id`, `timesong`, `id_vatnuoi` from `farm_vatnuoi_cuaban` WHERE `user_id` = '".$user_id."'");
while ($chiso = mysql_fetch_array($songvatnuoi)) {
$tinhtrangsong = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi` WHERE `id` = '".$chiso[id_vatnuoi]."'"));
if (($chiso[timesong] + $tinhtrangsong[timesong]) < $time) {
mysql_query("DELETE FROM `farm_vatnuoi_cuaban` WHERE `id` = '".$chiso[id]."'");
mysql_query("DELETE FROM `farm_vatnuoi_choan` WHERE `sid` = '".$chiso[id]."'");
header('Location: '.$home.'/farm/');
}
}
?>