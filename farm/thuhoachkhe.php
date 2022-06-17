<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Thu hoạch khế';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
$time = time();
echo'<div class="phdr">Thu hoạch khế</div>';
echo'<div class="menu">';
if (($datauser['timethuhoachkhe'] + 3600 ) < $time) {
$randkhe = rand(100,500);
$remils = mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '31'"),0);
$checknv=mysql_num_rows(mysql_query("SELECT * FROM `nhiemvu_user` WHERE `user_id`='".$user_id."' AND `id_nv`='2'"));
if ($checknv>0) {
mysql_query("UPDATE `nhiemvu_user` SET `tiendo`=`tiendo`+'1' WHERE `user_id`='".$user_id."' AND `id_nv`='2'");
}
//nhiệm vụ naruto
$check_nv = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `user_id` = '".$user_id."' AND `id_nv` = '4'"));
if ($check_nv > 0) {
mysql_query("UPDATE `naruto_nhiemvu` SET `tiendo` = `tiendo` + '1' WHERE `id_nv` = '4' AND `user_id` = '".$user_id."'");
}
//end nhiệm vụ naruto
if($remils > 0) {
mysql_query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".$randkhe."' WHERE `id_user` = $user_id AND `semen` = '31' LIMIT 1");
} else {
mysql_query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".$randkhe."', '31', '".$user_id."') ");
}
echo '<img src="/icon/caykhechin.png" alt="icon" style="vertical-align: -5px;float: left;margin-right: 5px;"/><br/>Bạn vừa hái được '.$randkhe.' trái khế xin chúc mừng !';
mysql_query("UPDATE `users` SET `timethuhoachkhe` = '".time()."' WHERE `id` = $user_id");
} else {
$hoiphuc = $datauser['timethuhoachkhe'] + 3600 - time();
$timehoiphuc1 = date('H', $hoiphuc);
$timehoiphuc2 = date('i', $hoiphuc);
$timehoiphuc3 = date('s', $hoiphuc);
echo '<img src="/icon/caykhe.png" alt="icon"/><br/>Bạn còn '.(($datauser['timethuhoachkhe'] + 3600) < time() ? '':''.($timehoiphuc2 == 0 ? '' : ''.$timehoiphuc2.' phút ').''.$timehoiphuc3.' giây').' nữa để thu hoạch khế !';
}
echo'</div>';
echo "<div class='menu list-top congdong'>&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a></div>";
echo'</div>';
require('../incfiles/end.php');
?>
                            