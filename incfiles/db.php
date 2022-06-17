<?php

defined('_IN_JOHNCMS') or die ('Error: restricted access');

$db_host = 'localhost';
$db_name = 'nghiafun_game24h';
$db_user = 'nghiafun_game24h';
$db_pass = 't1i4c1N2';
$baotri = 'Dang bao tri !';
$conn = @mysql_connect("{$db_host}", "{$db_user}", "{$db_pass}") or die("$baotri");
@mysql_select_db("{$db_name}") or die("$baotri data");
mysql_query("SET character_set_results=utf8", $conn);
mb_internal_encoding('UTF-8');
mysql_query("set names 'utf8'",$conn);

?>