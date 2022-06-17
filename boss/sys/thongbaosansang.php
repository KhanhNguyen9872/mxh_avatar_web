<?php
if (!empty($areanonline['nguoichoi'])) {
$noticearena = mysql_result(mysql_query("SELECT COUNT(*) FROM `boss_notice` WHERE
`chuphong` = '".$areanonline['user_id']."' AND 
`nguoichoi` = '".$areanonline['nguoichoi']."' AND 
`phong` = '".$id."' AND 
`view` = '0' AND 
`type` = 'a'
"), 0);

if($xoatb['luothien'] == 0) {
if($noticearena == 0) {
mysql_query("INSERT INTO `boss_notice` SET
`chuphong` = '".$areanonline['user_id']."',
`nguoichoi` = '".$areanonline['nguoichoi']."',
`phong` = '".$id."',
`luothien` = '1',
`time` = '" . time() . "',
`type` = 'a'
");
}
}
}


if (!empty($areanonline['nguoichoi2'])) {
$noticearena = mysql_result(mysql_query("SELECT COUNT(*) FROM `boss_notice` WHERE
`chuphong` = '".$areanonline['user_id']."' AND 
`nguoichoi` = '".$areanonline['nguoichoi2']."' AND 
`phong` = '".$id."' AND 
`view` = '0' AND 
`type` = 'b'
"), 0);

if($xoatb['luothien'] == 0) {
if($noticearena == 0) {
mysql_query("INSERT INTO `boss_notice` SET
`chuphong` = '".$areanonline['user_id']."',
`nguoichoi` = '".$areanonline['nguoichoi2']."',
`phong` = '".$id."',
`luothien` = '1',
`time` = '" . time() . "',
`type` = 'b'
");
}
}
}


if (!empty($areanonline['nguoichoi3'])) {
$noticearena = mysql_result(mysql_query("SELECT COUNT(*) FROM `boss_notice` WHERE
`chuphong` = '".$areanonline['user_id']."' AND 
`nguoichoi` = '".$areanonline['nguoichoi3']."' AND 
`phong` = '".$id."' AND 
`view` = '0' AND 
`type` = 'c'
"), 0);

if($xoatb['luothien'] == 0) {
if($noticearena == 0) {
mysql_query("INSERT INTO `boss_notice` SET
`chuphong` = '".$areanonline['user_id']."',
`nguoichoi` = '".$areanonline['nguoichoi3']."',
`phong` = '".$id."',
`luothien` = '1',
`time` = '" . time() . "',
`type` = 'c'
");
}
}
}
?>