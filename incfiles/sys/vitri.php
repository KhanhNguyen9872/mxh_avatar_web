<?php
$checkvt=mysql_num_rows(mysql_query("SELECT * FROM `vitri` WHERE `user_id`='".$user_id."'"));
if ($checkvt<1) {
mysql_query("INSERT INTO `vitri` SET
`user_id`='".$user_id."'");
}
?>