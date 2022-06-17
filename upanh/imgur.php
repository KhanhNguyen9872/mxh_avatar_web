<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Upload Ảnh';
require('../incfiles/head.php');
$img=$_FILES['img'];
if(isset($_POST['submit'])){ 
 if($img['name']==''){  
  echo "<h2>An Image Please.</h2>";
 }else{
  $filename = $img['tmp_name'];
  $client_id="b4273fccf244dcb";
  $handle = fopen($filename, "r");
  $data = fread($handle, filesize($filename));
  $pvars   = array('image' => base64_encode($data));
  $timeout = 30;
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
  curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
  $out = curl_exec($curl);
  curl_close ($curl);
  $pms = json_decode($out,true);
  $url=$pms['data']['link'];
  $size = substr(($pms['data']['size']/1024),0,4);
$time = time();
$id = isset($_GET['id']) ? $_GET['id']:$user_id;
 


  if($url!=""){
mysql_query("INSERT INTO `imgupload` SET
`user` = '$user_id',
`time` = '$time',
`size` = '$size',
`url` = '$url'
");
   echo '<div class="lucifer">Upload Ảnh<div class="menu"><center><b><font size="2"><font color=red>Tải Ảnh Lên Thành Công!!</font></font></b></center>';
   echo '<center><img style="padding:2px;border:2px solid #DCDCDC;max-width:100%;" src="'.$url.'"/></center><center><div style="background:#2D3BFD;border:2px solid #2D3BFD;padding:4px;width:45%;text-align:center;border-radius:2px;"><a href="'.$url.'"><b><font color=#ffffff>Download ảnh ('.$size.'KB)</font></b></a></center><a 
 href="index.php">Upload ảnh</a> | <a href="'.$home.'"> Trang chủ</a>';

  }else{
   
   echo $pms['data']['error'];  
  } 
 }
}

require_once('../incfiles/end.php');
?>