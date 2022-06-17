<?php
$thongtinonline1 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['user_id']."'"));
$thongtinonline2 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$thongtinonline3 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi2']."'"));
$thongtinonline4 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi3']."'"));
if($areanonline['wait']==3) {
if ($areanonline['win'] == '0') {
echo'<div class="menu list-top">';
echo 'Thời gian chờ "'.(($areanonline['time']+30)-time()).'" giây<br/>Lượt Đi Của <span style="color:green;">'.nick($luotchoi).'</span><br/><a href="/boss/'.$id.'"><input type="button" value="Làm mới" /></a></div>';
}
}
$online1 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['user_id']."'"));
$online2 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$online3 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi2']."'"));
$online4 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi3']."'"));
if ((time() > $online1['lastdate'] + 120)) {
mysql_query("UPDATE `boss` SET `user_id`='0' WHERE `id`='".$id."'");
}
if ((time() > $online2['lastdate'] + 120)) {
mysql_query("UPDATE `boss` SET `nguoichoi`='0' WHERE `id`='".$id."'");
}
if ((time() > $online3['lastdate'] + 120)) {
mysql_query("UPDATE `boss` SET `nguoichoi2`='0' WHERE `id`='".$id."'");
}
if ((time() > $online4['lastdate'] + 120)) {
mysql_query("UPDATE `boss` SET `nguoichoi3`='0' WHERE `id`='".$id."'");
}
?>