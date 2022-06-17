<?php
define('_IN_JOHNCMS', 1);
require ('../incfiles/core.php');
$id = $_GET['id'];
$thongtinhp = mysql_fetch_array(mysql_query("SELECT * FROM `boss_chien_arena` WHERE `phong`='".$id."'"));
if(empty($thongtinhp[phong])) {header('Location: '.$home.'');}
$per = floor(($thongtinhp['hp']*100)/$thongtinhp['hpfull']);
if($per>100){
$per=100;
} 
if($per<0){
$per=0;
} 
Header("Content-Type: Image/PNG");
$image=ImageCreateFromPNG("img/hp.png");
$bar=ImageCreateFromPNG("img/bar.png"); imagecopy($image, $bar,0, 0, 0, 0, $per,imagesy($bar)); ImagePNG($image);
ImageDestroy($image);
?>