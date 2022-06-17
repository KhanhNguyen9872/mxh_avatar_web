<?
$image = $_GET['img'];
$imd = @imagecreatefromjpeg('files/'.$image);
if((@imagesx($imd)>150) && (@imagesy($imd)>200)) {
$im = @imagecreatetruecolor(150,200);
$img = @imagecreatefromjpeg('files/'.$image);
$mau = @imagecolorallocatealpha($im,255,255,255,127);
@imagefill($im,0,0,$mau);
@imagealphablending($im,false);
@imagesavealpha($im,true);
@imagecopyresized($im,$img,0,0,0,0,150,200,imagesx($img), imagesy($img));
} else {
$im = @imagecreatefromjpeg('files/'.$image);
}
header('Content-type: image/jpeg');
imagejpeg($im);
imagedestroy($im);
?>
