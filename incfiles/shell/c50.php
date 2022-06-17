<?php
defined('_IN_JOHNCMS') or die ('Error: restricted access');
$db_host = 'localhost';
$db_name = 'armysite_avatar';
$db_user = 'armysite_army';
$db_pass = 'ankloveX1@';
$baotri = 'Bao tri de fix 1 so loi. Vui long quay lai vao ngay mai!';
$conn = @mysql_connect("{$db_host}", "{$db_user}", "{$db_pass}") or die("$baotri");
@mysql_select_db("{$db_name}") or die("$baotri");
mysql_query("SET character_set_results=utf8", $conn);
mb_internal_encoding('UTF-8');
mysql_query("set names 'utf8'",$conn);
?>