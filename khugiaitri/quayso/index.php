<?php

/*
////////////////////////////////////////////////////////////////////////////////
// JohnCMS                             Content Management System              //
// Официальный сайт сайт проекта:      http://johncms.com                     //
// Дополнительный сайт поддержки:      http://gazenwagen.com                  //
////////////////////////////////////////////////////////////////////////////////
// JohnCMS core team:                                                         //
// Евгений Рябинин aka john77          john77@gazenwagen.com                  //
// Олег Касьянов aka AlkatraZ          alkatraz@gazenwagen.com                //
//                                                                            //

Скрипт игры Бандит. Переделан с мотора под джон ПеревозЧЕГом. 
Сайт http://owab.ru

// Информацию о версиях смотрите в прилагаемом файле version.txt              //
////////////////////////////////////////////////////////////////////////////////
*/

define('_IN_JOHNCMS', 1);
$textl = 'Máy Quay Xèng ';
$rootpath = '../';
require("../../incfiles/core.php");
require("../../incfiles/head.php");



$rand = isset($_GET['rand']) ? $_GET['rand'] : '';
$num1 = isset($_GET['num1']) ? $_GET['num1'] : '';
$num2 = isset($_GET['num2']) ? $_GET['num2'] : '';
$num3 = isset($_GET['num3']) ? $_GET['num3'] : '';
$num4 = isset($_GET['num4']) ? $_GET['num4'] : '';
$num5 = isset($_GET['num5']) ? $_GET['num5'] : '';
$num6 = isset($_GET['num6']) ? $_GET['num6'] : '';
$num7 = isset($_GET['num7']) ? $_GET['num7'] : '';
$num8 = isset($_GET['num8']) ? $_GET['num8'] : '';
$num9 = isset($_GET['num4']) ? $_GET['num9'] : '';
echo '<div class="phdr"><b>Máy Quay Xèng</b><br/></div>';

$vnd_minus = "10000";

if (!empty($user_id)) {

if(!isset($_GET['action'])){  

echo '<div class="lucifer">Bạn có thích cờ bạc không? Và chiến thắng, bạn cảm thấy Vui vẻ? Chơi và nhận được giải thưởng<br/>';
echo'Bạn có : ' . $datauser['xu'] . ' Xu<br/>';
echo'<center>- <img src="1.gif" alt=""/> <img src="2.gif" alt=""/> <img src="3.gif" alt=""/> -<br/>';  
echo'- <img src="7.gif" alt=""/> <img src="7.gif" alt=""/> <img src="7.gif" alt=""/> -<br/>';  
echo'- <img src="4.gif" alt=""/> <img src="5.gif" alt=""/> <img src="6.gif" alt=""/> -<br/></center>';  

echo'<center><br><button class="btn btn-dark"><a href="index.php?action=go">Chơi</a></button></center><br/>';    
    

} 


//---------------------------- Игра -----------------------------------//
if($_GET['action']=="go"){ 
if($datauser['xu']>$vnd_minus){
$num1 = mt_rand(1, 8);
$num2 = mt_rand(1, 8);
$num3 = mt_rand(1, 8);
$num4 = mt_rand(1, 8);
///////уменьшаем шанс выпадения 7 в центре
$num_a= mt_rand(1, 6);
$num_b= mt_rand(1, 8);
$num_d = array($num_a, $num_b);
$num_e = mt_rand(0, 1); 
$num5 = $num_d[$num_e];
///////
$num6 = mt_rand(1, 8);
$num7 = mt_rand(1, 8);
$num8 = mt_rand(1, 8);
$num9 = mt_rand(1, 8);

$rand = mt_rand(100, 999);

echo'<div class="lucifer"><center>- <img src="'.$num1.'.gif" alt=""/> <img src="'.$num2.'.gif" alt=""/> <img src="'.$num3.'.gif" alt=""/> -<br/>';
echo'- <img src="'.$num4.'.gif" alt=""/> <img src="'.$num5.'.gif" alt=""/> <img src="'.$num6.'.gif" alt=""/> -<br/>'; 
echo'- <img src="'.$num7.'.gif" alt=""/> <img src="'.$num8.'.gif" alt=""/> <img src="'.$num9.'.gif" alt=""/> -<br/></center>'; 

/////////////////////////////////линии//////////////////////////////
$sum=0;

if ($num1 == 1 && $num2 == $num1 && $num3 == $num1) {echo'Cherry đầu tiên<br/>'; $sum+="10000";}
if ($num4 == 1 && $num5 == $num4 && $num6 == $num4) {echo'Cherry ở giữa<br/>'; $sum+="15000";}
if ($num7 == 1 && $num8 == $num7 && $num9 == $num7) {echo'Cherry Cuối Cùng<br/>';  $sum+="10000";}

if ($num1 == 2 && $num2 == $num1 && $num3 == $num1) {echo'Cam đầu tiên<br/>'; $sum+="15000";}
if ($num4 == 2 && $num5 == $num4 && $num6 == $num4) {echo'Cam ở giữa<br/>'; $sum+="25000";}
if ($num7 == 2 && $num8 == $num7 && $num9 == $num7) {echo'Cam Cuối Cùng<br/>'; $sum+="15000";}

if ($num1 == 3 && $num2 == $num1 && $num3 == $num1) {echo'Nho đầu tiên<br/>'; $sum+="20000";}
if ($num4 == 3 && $num5 == $num4 && $num6 == $num4) {echo'Nho ở giữa<br/>'; $sum+="25000";}
if ($num7 == 3 && $num8 == $num7 && $num9 == $num7) {echo'Nho Cuối Cùng<br/>'; $sum+="15000";}

if ($num1 == 4 && $num2 == $num1 && $num3 == $num1) {echo'Chuối đầu tiên<br/>'; $sum+="25000";}
if ($num4 == 4 && $num5 == $num4 && $num6 == $num4) {echo'Chuối ở giữa<br/>'; $sum+="35000";}
if ($num7 == 4 && $num8 == $num7 && $num9 == $num7) {echo'Chuối Cuối Cùng<br/>'; $sum+="25000";}

if ($num1 == 5 && $num2 == $num1 && $num3 == $num1) {echo'Táo đầu tiên<br/>'; $sum+="30000";}
if ($num4 == 5 && $num5 == $num4 && $num6 == $num4) {echo'Táo ở giữa<br/>'; $sum+="50000";}
if ($num7 == 5 && $num8 == $num7 && $num9 == $num7) {echo'Táo Cuối Cùng<br/>'; $sum+="30000";}

if ($num1 == 6 && $num2 == $num1 && $num3 == $num1) {echo'BAR đầu tiên<br/>'; $sum+="50000";}
if ($num4 == 6 && $num5 == $num4 && $num6 == $num4) {echo'BAR ở giữa<br/>'; $sum+="70000";}
if ($num7 == 6 && $num8 == $num7 && $num9 == $num7) {echo'BAR Cuối Cùng<br/>'; $sum+="55000";}

if ($num1 == 7 && $num2 == $num1 && $num3 == $num1) {echo'777-Đầu<br/>'; $sum+="177000";}
if ($num4 == 7 && $num5 == $num4 && $num6 == $num4) {echo'777-Giữa<br/>'; $sum+="777000";}
if ($num7 == 7 && $num8 == $num7 && $num9 == $num7) {echo'777-Cuối Cùng<br/>'; $sum+="177000";}

if ($num1 == 8 && $num2 == $num1 && $num3 == $num1) {echo'$$$-Đầu<br/>'; $sum+="60000";}
if ($num4 == 8 && $num5 == $num4 && $num6 == $num4) {echo'$$$-Giữa<br/>'; $sum+="100000";}
if ($num7 == 8 && $num8 == $num7 && $num9 == $num7) {echo'$$$-Cuối Cùng<br/>'; $sum+="60000";}



//------------------------------ Запись в профиль ----------------------------//
if(!empty($sum)){

                        $vnd_plus_c = ($datauser['xu'] + $sum);
                        mysql_query("update `users` set xu='" . $vnd_plus_c . "' where id='" . $user_id .
                            "';");

echo'<br/><b><center><button class="btn btn-dark"><a href="index.php?action=go&amp;rand='.$rand.'&amp;">Chơi</a></b></button></center><br/>'; } else {
//------------------------------ Запись в профиль ----------------------------//
 
                        $vnd_minus_с = ($datauser['xu'] - $vnd_minus);
                        mysql_query("update `users` set xu='" . $vnd_minus_с . "' where id='" . $user_id .
                            "';");


echo'<br/><b><center><button class="btn btn-dark"><a href="index.php?action=go&amp;rand='.$rand.'&amp;">Chơi</a></b></button></center><br/>';}
}else{echo'Bạn không thể chơi vì trên tài khoản của bạn chưa đủ tiền<br/>';}

sleep(1); //задержка 1 сек

echo'Bạn có : ' . $datauser['xu'] . ' Xu<br/><br/>';
}


//---------------------------- Правила -----------------------------------//
if($_GET['action']=="faq"){ 

echo 'Các quy tắc rất đơn giản. Nhấn Play và giành chiến thắng điểm.<br/>';
echo 'Đối với mỗi nhấp chuột trên tài khoản của bạn để viết '.$vnd_minus.' Xu<br/>';
echo 'Nếu bạn may mắn và giành chiến thắng điểm, họ sẽ ngay lập tức được chuyển vào tài khoản của bạn<br/><br/>';
echo 'Sự kết hợp của hình ảnh theo chiều dọc, chiều ngang và thậm chí theo đường chéo<br/><br/>';
echo 'Danh sách kết hợp chiến thắng:<br/>';

echo '<img src="1.gif" alt=""/> * 3 anh đào = 10 giữa dòng / cột (5 - trên hoặc thấp hơn hàng / cột)<br/>';
echo '<img src="2.gif" alt=""/> * 3 cam = 15, giữa hàng / cột (10 dòng / cột trên hoặc thấp hơn)<br/>'; 
echo '<img src="3.gif" alt=""/> * 3 nho = 25 / cột số lượng trung bình (15 - trên hoặc thấp hơn phạm vi / cột)<br/>';
echo '<img src="4.gif" alt=""/> * 3 Chuối = 35 giữa hàng / cột (25 dòng / cột trên hoặc thấp hơn)<br/>';
echo '<img src="5.gif" alt=""/> * 3 Táo = 50 giữa hàng / cột (30 dòng / cột trên hoặc thấp hơn)<br/>';
echo '<img src="6.gif" alt=""/> * 3 BAR = 100 theo đường chéo<br/>';
echo '<img src="6.gif" alt=""/> * 3 BAR = 70 giữa dòng / cột (50 dòng / cột trên hoặc thấp hơn)<br/>';
echo '<img src="8.gif" alt=""/> * 3 $$$ = 100 giữa dòng / cột (60 - trên hoặc thấp hơn hàng / cột)<br/>';
echo '<img src="8.gif" alt=""/> * 3 $$$ = 333 theo đường chéo<br/>';
echo '<img src="7.gif" alt=""/> * 3 777 = 150 diagonalisredny để một cột (100 cột bên trái hoặc bên phải)<br/>';
echo '<img src="7.gif" alt=""/> * 3 777 = 150 theo đường chéo<br/>';
echo '<img src="7.gif" alt=""/> * 3 777 = 777 số lượng trung bình (177 - hàng trên hoặc thấp hơn)<br/>';


echo '<br/><img src="8.gif" alt=""/> <a href="index.php">Quay lại</a><br/>';

}

}else{
echo '<br/>Bạn không được phép để bắt đầu trò chơi, bạn phải<br/>';
echo '<b><a href="../../login.php">Đăng nhập</a></b> hoặc <b><a href="../../registration.php">Đăng kí</a></b><br/><br/>';
}

echo '<br/><div class="menu"><img src="8.gif" alt=""/> <a href="index.php?action=faq&amp;">Quy tắc của trò chơi</a></div><br/>';

echo'<div>';





require("../../incfiles/end.php");
?>