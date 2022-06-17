<?php


if($areanonline['win'] == 0) {
if($areanonline['wait'] == 3) {
$bossdanh = mysql_query("SELECT * FROM `boss_danh` WHERE `phong` = '".$id."' ORDER BY `time` DESC LIMIT 1");
while ($res = mysql_fetch_array($bossdanh)) {
echo'<div class="menu list-top hot">';
if ($res['type'] == '1'){
echo'<img src="'.$home.'/icon/khudautruong.png" alt="Chiến đấu" style="vertical-align: -3px;"/>&#160;';
echo'Boss vừa đánh "'.nick($res[nguoibidanh]).'" mất '.$res[sodanh].' HP haha...';
}
echo'</div>';
}
}
}
?>