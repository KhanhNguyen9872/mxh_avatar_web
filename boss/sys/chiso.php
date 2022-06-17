<?php
if ($ttboss[hp] <= '-1') {



if($areanonline['mucdo'] == 1) {
mysql_query("UPDATE `boss_chien_arena` SET `hp`= '0' WHERE `phong`='".$ttboss[phong]."'");
mysql_query("UPDATE `boss` SET `win`= '1' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `post`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `nguoichoi`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `nguoichoi2`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `nguoichoi3`= '0' WHERE `id`='".$id."'");
mysql_query("DELETE FROM `boss_noidung` WHERE `phong`='".$id."'");
mysql_query("DELETE FROM `boss_danh` WHERE `phong`='".$id."'");
mysql_query("DELETE FROM `boss_notice` WHERE `phong`='".$id."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['user_id']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi2']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi3']."'");
if ($areanonline['boss'] == '1') {$xutang = rand(5000,30000);$xutang1 = rand(5000,30000);$xutang2 = rand(5000,30000);$xutang3 = rand(5000,30000);}
if ($areanonline['boss'] == '2') {$xutang = rand(10000,40000);$xutang1 = rand(10000,40000);$xutang2 = rand(10000,40000);$xutang3 = rand(10000,40000);}
if ($areanonline['boss'] == '3') {$xutang = rand(15000,50000);$xutang1 = rand(15000,50000);$xutang2 = rand(15000,50000);$xutang3 = rand(15000,50000);}
if ($areanonline['boss'] == '4') {$xutang = rand(20000,60000);$xutang1 = rand(20000,60000);$xutang2 = rand(20000,60000);$xutang3 = rand(20000,60000);}

if (!empty($areanonline['nguoichoi'])) {
mysql_query("update `users` set `xu` = `xu`+'".$xutang1."' where `id` = '".$areanonline['nguoichoi']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang1. "',
`type` = '5'
");
}
if (!empty($areanonline['nguoichoi2'])) {
mysql_query("update `users` set `xu` = `xu`+'".$xutang2."' where `id` = '".$areanonline['nguoichoi2']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi2']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang2. "',
`type` = '5'
");
}
if (!empty($areanonline['nguoichoi3'])) {
mysql_query("update `users` set `xu` = `xu`+'".$xutang3."' where `id` = '".$areanonline['nguoichoi3']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi3']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang3. "',
`type` = '5'
");
}
mysql_query("update `users` set `xu` = `xu`+'".$xutang."' where `id` = '".$areanonline['user_id']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['user_id']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang. "',
`type` = '5'
");
header("Location: phong.php?id=$id");
}





if($areanonline['mucdo'] == 2) {
if($areanonline['cuaai'] == 1) {
$chisoboss = mysql_fetch_array(mysql_query("SELECT `hpfull`,`sucmanh` FROM `boss_chien` WHERE `idboss`='".$areanonline['boss']."'"));
$hpboss1 = $chisoboss[hpfull]/2;
$hpboss2 = $hpboss1/2;
$hpboss = $chisoboss[hpfull]+$hpboss2;
$smboss1 = $chisoboss[sucmanh]/2;
$smboss2 = $smboss1/2;
$smboss = $chisoboss[sucmanh]+$smboss2;
mysql_query("UPDATE `boss` SET `cuaai`= '2' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss_chien_arena` SET `hp`= '".$hpboss."' WHERE `phong`='".$id."'");
mysql_query("UPDATE `boss_chien_arena` SET `hpfull`= '".$hpboss."' WHERE `phong`='".$id."'");
mysql_query("UPDATE `boss_chien_arena` SET `sucmanh`= '".$smboss."' WHERE `phong`='".$id."'");
header("Location: phong.php?id=$id");
}
if($areanonline['cuaai'] == 2) {
mysql_query("UPDATE `boss_chien_arena` SET `hp`= '0' WHERE `phong`='".$ttboss[phong]."'");
mysql_query("UPDATE `boss` SET `win`= '1' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `nguoichoi`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `nguoichoi2`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `nguoichoi3`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `post`= '0' WHERE `id`='".$id."'");
mysql_query("DELETE FROM `boss_noidung` WHERE `phong`='".$id."'");
mysql_query("DELETE FROM `boss_danh` WHERE `phong`='".$id."'");
mysql_query("DELETE FROM `boss_notice` WHERE `phong`='".$id."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['user_id']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi2']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi3']."'");
if ($areanonline['boss'] == '1') {$xutang = rand(500,900);$xutang1 = rand(500,900);$xutang2 = rand(500,900);$xutang3 = rand(500,900);}
if ($areanonline['boss'] == '2') {$xutang = rand(1400,2000);$xutang1 = rand(1400,2000);$xutang2 = rand(1400,2000);$xutang3 = rand(1400,2000);}
if ($areanonline['boss'] == '3') {$xutang = rand(1800,2400);$xutang1 = rand(1800,2400);$xutang2 = rand(1800,2400);$xutang3 = rand(1800,2400);}
if ($areanonline['boss'] == '4') {$xutang = rand(2200,3000);$xutang1 = rand(2200,3000);$xutang2 = rand(2200,3000);$xutang3 = rand(2200,3000);}

if (!empty($areanonline['nguoichoi'])) {
mysql_query("update `users` set `xu` = `xu`+'".$xutang1."' where `id` = '".$areanonline['nguoichoi']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang1. "',
`type` = '5'
");
}
if (!empty($areanonline['nguoichoi2'])) {
mysql_query("update `users` set `xu` = `xu`+'".$xutang2."' where `id` = '".$areanonline['nguoichoi2']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi2']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang2. "',
`type` = '5'
");
}
if (!empty($areanonline['nguoichoi3'])) {
mysql_query("update `users` set `xu` = `xu`+'".$xutang3."' where `id` = '".$areanonline['nguoichoi3']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi3']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang3. "',
`type` = '5'
");
}
mysql_query("update `users` set `xu` = `xu`+'".$xutang."' where `id` = '".$areanonline['user_id']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['user_id']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang. "',
`type` = '5'
");
header("Location: phong.php?id=$id");
}
}






if($areanonline['mucdo'] == 3) {
if($areanonline['cuaai'] == 1) {
$chisoboss = mysql_fetch_array(mysql_query("SELECT `hpfull`,`sucmanh` FROM `boss_chien` WHERE `idboss`='".$areanonline['boss']."'"));
$hpboss1 = $chisoboss[hpfull]/2;
$hpboss2 = $hpboss1/2;
$hpboss = $chisoboss[hpfull]+$hpboss2;
$smboss1 = $chisoboss[sucmanh]/2;
$smboss2 = $smboss1/2;
$smboss = $chisoboss[sucmanh]+$smboss2;
mysql_query("UPDATE `boss` SET `cuaai`= '2' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss_chien_arena` SET `hp`= '".$hpboss."' WHERE `phong`='".$id."'");
mysql_query("UPDATE `boss_chien_arena` SET `hpfull`= '".$hpboss."' WHERE `phong`='".$id."'");
mysql_query("UPDATE `boss_chien_arena` SET `sucmanh`= '".$smboss."' WHERE `phong`='".$id."'");
header("Location: phong.php?id=$id");
}
if($areanonline['cuaai'] == 2) {
$chisoboss = mysql_fetch_array(mysql_query("SELECT `hpfull`,`sucmanh` FROM `boss_chien` WHERE `idboss`='".$areanonline['boss']."'"));
$hpboss = $chisoboss[hpfull]*2;
$smboss = $chisoboss[sucmanh]*2;
mysql_query("UPDATE `boss` SET `cuaai`= '3' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss_chien_arena` SET `hp`= '".$hpboss."' WHERE `phong`='".$id."'");
mysql_query("UPDATE `boss_chien_arena` SET `hpfull`= '".$hpboss."' WHERE `phong`='".$id."'");
mysql_query("UPDATE `boss_chien_arena` SET `sucmanh`= '".$smboss."' WHERE `phong`='".$id."'");
header("Location: phong.php?id=$id");
}
if($areanonline['cuaai'] == 3) {
mysql_query("UPDATE `boss_chien_arena` SET `hp`= '0' WHERE `phong`='".$ttboss[phong]."'");
mysql_query("UPDATE `boss` SET `win`= '1' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `nguoichoi`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `nguoichoi2`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `nguoichoi3`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `post`= '0' WHERE `id`='".$id."'");
mysql_query("DELETE FROM `boss_noidung` WHERE `phong`='".$id."'");
mysql_query("DELETE FROM `boss_danh` WHERE `phong`='".$id."'");
mysql_query("DELETE FROM `boss_notice` WHERE `phong`='".$id."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['user_id']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi2']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi3']."'");
if ($areanonline['boss'] == '1') {$xutang = rand(1800,2400);$xutang1 = rand(1800,2400);$xutang2 = rand(1800,2400);$xutang3 = rand(1800,2400);}
if ($areanonline['boss'] == '2') {$xutang = rand(2200,3000);$xutang1 = rand(2200,3000);$xutang2 = rand(2200,3000);$xutang3 = rand(2200,3000);}
if ($areanonline['boss'] == '3') {$xutang = rand(2800,3600);$xutang1 = rand(2800,3600);$xutang2 = rand(2800,3600);$xutang3 = rand(2800,3600);}
if ($areanonline['boss'] == '4') {$xutang = rand(3500,4000);$xutang1 = rand(3500,4000);$xutang2 = rand(3500,4000);$xutang3 = rand(3500,4000);}

if (!empty($areanonline['nguoichoi'])) {
mysql_query("update `users` set `xu` = `xu`+'".$xutang1."' where `id` = '".$areanonline['nguoichoi']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang1. "',
`type` = '5'
");
}
if (!empty($areanonline['nguoichoi2'])) {
mysql_query("update `users` set `xu` = `xu`+'".$xutang2."' where `id` = '".$areanonline['nguoichoi2']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi2']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang2. "',
`type` = '5'
");
}
if (!empty($areanonline['nguoichoi3'])) {
mysql_query("update `users` set `xu` = `xu`+'".$xutang3."' where `id` = '".$areanonline['nguoichoi3']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi3']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang3. "',
`type` = '5'
");
}
mysql_query("update `users` set `xu` = `xu`+'".$xutang."' where `id` = '".$areanonline['user_id']."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['user_id']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$xutang. "',
`type` = '5'
");
header("Location: phong.php?id=$id");
}
}







}

?>