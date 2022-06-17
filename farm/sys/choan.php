<?php
if(isset($_GET['chogaan'])) {
mysql_query("UPDATE `farm_vatnuoi_choan` SET 
`timean` = '".time()."',
`xem` = '0',
`tinhtrang` = '2' WHERE `vatnuoi` = '1' AND `user_id` = '".$user_id."'");
header('Location: '.$home.'/farm/');
}
if(isset($_GET['choheocuuboan'])) {
mysql_query("UPDATE `farm_vatnuoi_choan` SET 
`timean` = '".time()."',
`xem` = '0',
`tinhtrang` = '2' WHERE `vatnuoi` = '2' AND `user_id` = '".$user_id."' LIMIT 1");

mysql_query("UPDATE `farm_vatnuoi_choan` SET 
`timean` = '".time()."',
`xem` = '0',
`tinhtrang` = '2' WHERE `vatnuoi` = '3' AND `user_id` = '".$user_id."' LIMIT 1");

mysql_query("UPDATE `farm_vatnuoi_choan` SET 
`timean` = '".time()."',
`tinhtrang` = '2' WHERE `vatnuoi` = '4' AND `user_id` = '".$user_id."' LIMIT 1");
header('Location: '.$home.'/farm/');
}
if(isset($_GET['chocaan'])) {
mysql_query("UPDATE `farm_vatnuoi_choan` SET 
`timean` = '".time()."',
`xem` = '0',
`tinhtrang` = '2' WHERE `vatnuoi` = '5' AND `user_id` = '".$user_id."'");
header('Location: '.$home.'/farm/');
}
?>