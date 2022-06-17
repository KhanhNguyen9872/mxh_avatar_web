<?php
if(isset($_GET['thuhoachtrung'])) {
$sotrungga = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '1' AND `soluong` > '0'"),0);
if ($sotrungga == 0) {
echo'<div class="menu">Bạn không còn trứng để thu hoạch</div>';
echo "<div class='menu list-top congdong'>&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a></div>";
echo'</div>';
require('../incfiles/end.php');
exit;
}
$sotrung = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '1'")); 
$semen = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '28'  LIMIT 1")); 
$remils = mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '28'"),0);
if($remils>0) {
mysql_query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".$sotrung[soluong]."' WHERE `id_user` = $user_id AND `semen` = '28' LIMIT 1");
} else {
mysql_query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".$sotrung[soluong]."', '28', '".$user_id."') ");
}
mysql_query("DELETE FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '1'"); 
header("Location: /farm/");
}



if(isset($_GET['thuhoachsua'])) {
$sosuabo = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '2' AND `soluong` > '0'"),0);
if ($sosuabo == 0) {
echo'<div class="menu">Bạn không còn sữa để thu hoạch</div>';
echo "<div class='menu list-top congdong'>&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a></div>";
echo'</div>';
require('../incfiles/end.php');
exit;
}
$sosua = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '2'")); 
$semen = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '29'  LIMIT 1")); 
$remils = mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '29'"),0);
if($remils>0) {
mysql_query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".$sosua[soluong]."' WHERE `id_user` = $user_id AND `semen` = '29' LIMIT 1");
} else {
mysql_query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".$sosua[soluong]."', '29', '".$user_id."') ");
}
mysql_query("DELETE FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '2'"); 
header("Location: /farm/");
}


if(isset($_GET['thuhoachlongcuu'])) {
$solongcuu = mysql_result(mysql_query("SELECT COUNT(*) FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '3' AND `soluong` > '0'"),0);
if ($solongcuu == 0) {
echo'<div class="menu">Bạn không còn lông cừu để thu hoạch</div>';
echo "<div class='menu list-top congdong'>&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a></div>";
echo'</div>';
require('../incfiles/end.php');
exit;
}
$longcuu = mysql_fetch_array(mysql_query("select * from `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '3'")); 
$semen = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '30'  LIMIT 1")); 
$remils = mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '30'"),0);
if($remils>0) {
mysql_query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".$longcuu[soluong]."' WHERE `id_user` = $user_id AND `semen` = '30' LIMIT 1");
} else {
mysql_query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".$longcuu[soluong]."', '30', '".$user_id."') ");
}
mysql_query("DELETE FROM `farm_vatnuoi_sanluong` WHERE `user_id` = '".$user_id."' AND `type` = '3'"); 
header("Location: /farm/");
}
?>