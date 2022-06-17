<?php
$dg = mysql_query("SELECT * FROM `daugia` WHERE `timeend` < time()");
while($check = mysql_fetch_array($dg)){ 
$win = mysql_fetch_array(mysql_query("SELECT `user_id`,`id` FROM `daugia_act` WHERE `id` = '".$check['id']."' ORDER BY `cost` DESC LIMIT 1"),0);
$arr = mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id` = '".$check['idvp']."'"),0);
                mysql_query("INSERT INTO `khodo` SET 
               `user_id`='" . $win['user_id']. "',
               `id_loai`='" . $arr['id_loai'] . "',
               `loai`='" . $arr['loai'] . "',
               `id_shop`='" . $arr['id']. "',
               `tenvatpham` = '".$arr['tenvatpham']."'
               "); 
@mysql_query("INSERT INTO `guest` SET `time` = '".time()."', `text` = 'Đã kết thúc phiên đấu giá kiểm tra rương và xem bất ngờ :D', `user_id` = 2");
$cost = ($check['xu'] ? 'xu' : 'vnd');
$lay = mysql_query("SELECT `cost`,`user_id` FROM `daugia_act` WHERE `iddg` = '".$check['id']."' AND `id` != '".$win['id']."'");
while($cong = mysql_fetch_array($lay)){ 
$c = $cong['cost']; 
@mysql_query("UPDATE users SET $cost = $cost+$c WHERE `id` = '".$cong['user_id']."'");
} 
}
?>