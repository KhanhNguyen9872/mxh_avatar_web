<?php
## API Bot Chat Simsimi By Api.Vina4u.PRO ###
## Author : Hoàng Minh Thuận - Phạm Thanh Phong ##
## Home : Api.Vina4u.Pro - Vina4u Team ##


/////Cấu hình BOT SimSimi API///////
   $tatmo = 1; //Tắt mở BOT, 1 là mở, 0 là tắt
   
   $loaitraloi = "cuphap";
   $tukhoa = "#gavang_";
   //Tạo một user làm user BOT và nhập ID của user đó vào đây
   $idbot = 908;
   
   //Cấu hình API
   $loctuxau = "1"; //Lọc những từ nói bậy. 0 là không lọc và 1 là có lọc. Mặc định là 0.
   $tenbot = "Gà Vàng"; //Cái này sẽ thay thế tất cả tên bot là simsimi thành tên của bạn truyền vào. Mặc định là Sim
   //End cấu hình BOT///
   
//GET Câu trả lời từ API 
$check = 0;
if($tatmo)
{
if($loaitraloi == "cuphap")
{
$test = "aaa".$msg;
$temp = explode($tukhoa,$test);
if($temp[0] == "aaa")
{
$check = 1;
$msg = $temp[1];
}
}
if($loaitraloi == "toanbo")
{
if(stripos(strtolower($msg), $tukhoa) !== false)
{
$check = 1;
}
}
if($check)
{
$c = curl_init("http://api.vina4u.pro/api.php?text=$msg");
curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$traloi = curl_exec($c);
curl_close($c);
$traloi = trim($traloi);
if($traloi == "error")
{
$traloi = "Câu này mình chưa được học. Bạn có thể dạy cho mình chứ ?!";
}
$time = time() + 2;
mysql_query("INSERT INTO `guest` SET
                `adm` = '$admset',
                `time` = '" . $time. "',
                `user_id` = '" .$idbot. "',
                `name` = '$tenbot',
                `text` = '" . mysql_real_escape_string($traloi) . "',
                `ip` = '" . core::$ip . "',
                `browser` = '" . mysql_real_escape_string($agn) . "',
                `otvet` = ''
");
}
}
//////End Bot//////
?>