<?php
error_reporting(0);
//connect
$conn = mysql_connect('localhost', 'nghiafun_game24h', 't1i4c1N2') or die('Không thể kết nối CSDL');
mysql_select_db('nghiafun_game24h');
mysql_query("UPDATE `users` SET `baodanh` = '0', `nhanhopqua` = '0', `chanchat`='0'");
mysql_query("DELETE FROM `nhiemvu_user`");
mysql_query("DELETE FROM `naruto_nhiemvu`");
?>