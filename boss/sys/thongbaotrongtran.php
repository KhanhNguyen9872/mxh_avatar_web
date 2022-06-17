<?php

if($areanonline['wait'] == 3) {
$ndarena = mysql_query("SELECT * FROM `boss_noidung` WHERE `phong` = '".$id."' AND `type` = '1' ORDER BY `time` DESC LIMIT 1");
while ($res = mysql_fetch_array($ndarena)) {
echo'<div class="menu list-top congdong">';
echo'<img src="'.$home.'/boss/img/danhnhau.png" alt="Chiến đấu" style="vertical-align: -25px;"/>&#160;';
echo''.nick($res[nguoidanh1]).' đã '.$res[cachdanh].' boss mất '.$res[sodanh].' HP';
echo'</div>';
}
$ndarena = mysql_query("SELECT * FROM `boss_noidung` WHERE `phong` = '".$id."' AND `type` = '5' ORDER BY `time` DESC LIMIT 4");
while ($res = mysql_fetch_array($ndarena)) {
echo'<div class="menu list-top congdong">';
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo''.nick($res[nguoidanh1]).' đã nhận được '.$res[sodanh].' xu từ Boss';
echo'</div>';
}
}

?>