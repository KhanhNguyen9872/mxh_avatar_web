<?php
define('_IN_JOHNCMS', 1);
$idbot=2;
if($rights>=3) {
if(preg_match('|#delete|',$msg) || preg_match("|#xoa|",$msg)) {
$bot = "@$login vừa xóa chát box.";
$bot=html_entity_decode($bot,ENT_QUOTES,'UTF-8');
$time = time();
mysql_query("DELETE FROM `guest`");
}
}
?>
