<?php
header('Content-Type: image/png');
$img=abs(intval($_GET['color']));
$text = $_GET['text'];
$data=file_get_contents('img/data.dat');
$data=preg_match("/::fs$img=(.*?)::/is",$data,$ndata);
$data=explode('&',$ndata[1]);
$sfont = $_GET['font'];
$font = 'font/'.$sfont.'.ttf';
$size = $_GET['size'];
$color = $_GET['colo'];
$color1 = $_GET['color1'];
$color2 = $_GET['color2'];
//lay anh nen
$image = imagecreatefromjpeg('img/demo/'.$img.'.jpg');
//mau chu
$mauchu = imagecolorallocate($image,$color,$color1,$color2);
//viet ten len anh
imagettftext($image,$size,$data[1],$data[2],$data[3],$mauchu,$font,$text);
//xuat anh
imagepng($image);
imagedestroy($image);
?>
