<?php
if (!empty($areanonline['nguoichoi'])) {$timenguoichoi1 = 1;}
if (!empty($areanonline['nguoichoi2'])) {$timenguoichoi2 = 1;}
if (!empty($areanonline['nguoichoi3'])) {$timenguoichoi3 = 1;} 
$timenguoichoi = $timenguoichoi1+$timenguoichoi2+$timenguoichoi3+1;
$hp1 = mysql_fetch_array(mysql_query("SELECT `hp` FROM `users` WHERE `id`='".$areanonline['user_id']."'"));
$hp2 = mysql_fetch_array(mysql_query("SELECT `hp` FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$hp3 = mysql_fetch_array(mysql_query("SELECT `hp` FROM `users` WHERE `id`='".$areanonline['nguoichoi2']."'"));
$hp4 = mysql_fetch_array(mysql_query("SELECT `hp` FROM `users` WHERE `id`='".$areanonline['nguoichoi3']."'"));
$tonghp = $hp1[hp]+$hp2[hp]+$hp3[hp]+$hp4[hp];
if ($tonghp <= '0') {
mysql_query("UPDATE `boss` SET `win`= '3' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `post`= '0' WHERE `id`='".$id."'");
mysql_query("DELETE FROM `boss_noidung` WHERE `phong`='".$id."'");
mysql_query("DELETE FROM `boss_danh` WHERE `phong`='".$id."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['user_id']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi2']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '0' WHERE `id`='".$areanonline['nguoichoi3']."'");
}

if ($timenguoichoi == 1) {
if($areanonline['luotdi'] == $areanonline['user_id']) {$luotchoi = $areanonline['user_id'];}
$luotchoi = $areanonline['user_id'];
}

if ($timenguoichoi == 2) {
if($areanonline['luotdi'] == $areanonline['user_id']) {
if ($hp2[hp] <= 0) {
$luotchoi = $areanonline['user_id'];
} else {
$luotchoi = $areanonline['nguoichoi'];
}
}
if($areanonline['luotdi'] == $areanonline['nguoichoi']) {
if ($hp1[hp] <= 0) {
$luotchoi = $areanonline['nguoichoi'];
} else {
$luotchoi = $areanonline['user_id'];
}
}
}
 
if ($timenguoichoi == 3) {
if($areanonline['luotdi'] == $areanonline['user_id']) {
if ($hp2[hp] <= 0) {
if ($hp3[hp] <= 0) {
if ($hp1[hp] <= 0) {
$luotchoi = $areanonline['nguoichoi'];
} else {
$luotchoi = $areanonline['user_id'];
}
} else {
$luotchoi = $areanonline['nguoichoi2'];
}
} else {
$luotchoi = $areanonline['nguoichoi'];
} 
}

if($areanonline['luotdi'] == $areanonline['nguoichoi']) {
if ($hp3[hp] <= 0) {
if ($hp1[hp] <= 0) {
if ($hp2[hp] <= 0) {
$luotchoi = $areanonline['nguoichoi2'];
} else {
$luotchoi = $areanonline['nguoichoi'];
}
} else {
$luotchoi = $areanonline['user_id'];
}
} else {
$luotchoi = $areanonline['nguoichoi2'];
} 
}


if($areanonline['luotdi'] == $areanonline['nguoichoi2']) {
if ($hp1[hp] <= 0) {
if ($hp2[hp] <= 0) {
if ($hp3[hp] <= 0) {
$luotchoi = $areanonline['user_id'];
} else {
$luotchoi = $areanonline['nguoichoi3'];
}
} else {
$luotchoi = $areanonline['nguoichoi'];
}
} else {
$luotchoi = $areanonline['user_id'];
} 
}
}


if ($timenguoichoi == 4) {
if($areanonline['luotdi'] == $areanonline['user_id']) {
if ($hp2[hp] <= 0) {
if ($hp3[hp] <= 0) {
if ($hp4[hp] <= 0) {
if ($hp1[hp] <= 0) {
$luotchoi = $areanonline['nguoichoi'];
} else {
$luotchoi = $areanonline['user_id'];
}
} else {
$luotchoi = $areanonline['nguoichoi3'];
}
} else {
$luotchoi = $areanonline['nguoichoi2'];
}
} else {
$luotchoi = $areanonline['nguoichoi'];
} 
}

if($areanonline['luotdi'] == $areanonline['nguoichoi']) {
if ($hp3[hp] <= 0) {
if ($hp4[hp] <= 0) {
if ($hp1[hp] <= 0) {
if ($hp2[hp] <= 0) {
$luotchoi = $areanonline['nguoichoi2'];
} else {
$luotchoi = $areanonline['nguoichoi'];
}
} else {
$luotchoi = $areanonline['user_id'];
}
} else {
$luotchoi = $areanonline['nguoichoi3'];
}
} else {
$luotchoi = $areanonline['nguoichoi2'];
} 
}


if($areanonline['luotdi'] == $areanonline['nguoichoi2']) {
if ($hp4[hp] <= 0) {
if ($hp1[hp] <= 0) {
if ($hp2[hp] <= 0) {
if ($hp3[hp] <= 0) {
$luotchoi = $areanonline['nguoichoi3'];
} else {
$luotchoi = $areanonline['nguoichoi2'];
}
} else {
$luotchoi = $areanonline['nguoichoi'];
}
} else {
$luotchoi = $areanonline['user_id'];
}
} else {
$luotchoi = $areanonline['nguoichoi3'];
} 
}

if($areanonline['luotdi'] == $areanonline['nguoichoi3']) {
if ($hp1[hp] <= 0) {
if ($hp2[hp] <= 0) {
if ($hp3[hp] <= 0) {
if ($hp4[hp] <= 0) {
$luotchoi = $areanonline['user_id'];
} else {
$luotchoi = $areanonline['nguoichoi3'];
}
} else {
$luotchoi = $areanonline['nguoichoi2'];
}
} else {
$luotchoi = $areanonline['nguoichoi'];
}
} else {
$luotchoi = $areanonline['user_id'];
} 
}
}

if(($areanonline['time']+30) < time()) {
mysql_query("UPDATE `boss` SET `luotdi`='".$luotchoi."',`time`='".time()."' WHERE `id`='".$id."'");
$thongtinboss = mysql_fetch_array(mysql_query("SELECT * FROM `boss_chien` WHERE `idboss`='".$areanonline['boss']."'"));
if (!empty($areanonline['nguoichoi'])) {$songuoichoi1 = 1;}
if (!empty($areanonline['nguoichoi2'])) {$songuoichoi2 = 1;}
if (!empty($areanonline['nguoichoi3'])) {$songuoichoi3 = 1;}
$songuoichoi = $songuoichoi1+$songuoichoi2+$songuoichoi3+1;
$bidanh = rand(1,$songuoichoi); 
#### boss
$chisodanhboss = mysql_fetch_array(mysql_query("SELECT * FROM `boss_chien` WHERE `idboss`='".$areanonline['boss']."'"));
$chiasucdanhboss = $chisodanhboss[sucmanh]/8;
$chiasucdanhboss2 = $chiasucdanhboss+$chiasucdanhboss/2;
$sucdanhboss = rand($chiasucdanhboss,$chiasucdanhboss2);
if ($bidanh == '1') {
$nguoibidanh = $areanonline['user_id'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['user_id']."'");
}
if ($bidanh == '2') {
if ($hp2[hp] <= 0) {
$nguoibidanh = $areanonline['user_id'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['user_id']."'");
} else {
$nguoibidanh = $areanonline['nguoichoi'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['nguoichoi']."'");
}
}

if ($bidanh == '3') {
if ($hp3[hp] <= 0) {
if ($hp4[hp] <= 0) {
if ($hp1[hp] <= 0) {
if ($hp2[hp] <= 0) {
$nguoibidanh = $areanonline['nguoichoi2'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['nguoichoi2']."'");
} else {
$nguoibidanh = $areanonline['nguoichoi'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['nguoichoi']."'");
}
} else {
$nguoibidanh = $areanonline['user_id'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['user_id']."'");
}
} else {
$nguoibidanh = $areanonline['nguoichoi3'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['nguoichoi3']."'");
}
} else {
$nguoibidanh = $areanonline['nguoichoi2'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['nguoichoi2']."'");
}
}

if ($bidanh == '4') {
if ($hp4[hp] <= 0) {
if ($hp1[hp] <= 0) {
if ($hp2[hp] <= 0) {
if ($hp3[hp] <= 0) {
$nguoibidanh = $areanonline['nguoichoi3'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['nguoichoi3']."'");
} else {
$nguoibidanh = $areanonline['nguoichoi2'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['nguoichoi2']."'");
}
} else {
$nguoibidanh = $areanonline['nguoichoi'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['nguoichoi']."'");
}
} else {
$nguoibidanh = $areanonline['user_id'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['user_id']."'");
}
} else {
$nguoibidanh = $areanonline['nguoichoi3'];
mysql_query("UPDATE `users` SET `hp`= `hp`-'".$sucdanhboss."' WHERE `id`='".$areanonline['nguoichoi3']."'");
}
}




mysql_query("INSERT INTO `boss_danh` SET
`nguoibidanh` = '".$nguoibidanh."',
`phong` = '".$id."',
`time` = '" . time() . "',
`sodanh` = '" .$sucdanhboss. "',
`type` = '1'
");
echo'</div>';
header("Location: /boss/$id");
}
?>