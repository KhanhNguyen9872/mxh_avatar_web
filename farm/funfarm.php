<?php
$time = time();
if($user_id){
include 'str.php';
$post = mysql_result(mysql_query("select count(*) from `fermer_gr` WHERE  `id_user` = '{$user_id}'  LIMIT 1"),0);
if($post<5){
mysql_query("INSERT INTO `fermer_gr` (`kol`,`semen`, `id_user`) VALUES  ( NULL, '0', '".$user_id."') ");
mysql_query("INSERT INTO `fermer_gr` (`kol`,`semen`, `id_user`) VALUES  ( NULL, '0', '".$user_id."') ");
mysql_query("INSERT INTO `fermer_gr` (`kol`,`semen`, `id_user`) VALUES  ( NULL, '0', '".$user_id."') ");
mysql_query("INSERT INTO `fermer_gr` (`kol`,`semen`, `id_user`) VALUES  ( NULL, '0', '".$user_id."') ");
mysql_query("INSERT INTO `fermer_gr` (`kol`,`semen`, `id_user`) VALUES  ( NULL, '0', '".$user_id."') ");
}
}
?>