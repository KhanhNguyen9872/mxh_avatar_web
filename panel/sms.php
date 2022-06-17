<?php
error_reporting(0);
// 1. Nhan du lieu request tu iNET gui qua
$code               = $_REQUEST['code'];            // Ma chinh
$subCode            = $_REQUEST['subCode'];         // Ma phu
$mobile             = $_REQUEST['mobile'];          // So dien thoai +84
$mobile = '+'.$mobile.'';
$mobile = str_replace('+84','0', $mobile);
$mobile = str_replace('+01','01', $mobile);
$mobile = str_replace('+09','09', $mobile);
$serviceNumber      = $_REQUEST['serviceNumber'];   // Dau so 8x85
$info               = $_REQUEST['info'];            // Noi dung tin nhan
$ipremote           = $_SERVER['REMOTE_ADDR'];      // IP server goi qua truyen du lieu
$sub = explode(' ', $info);
$ma = strtoupper($sub[2]);
$id_user = intval($sub[3]);
// 2. Ghi log va kiem tra du lieu
// Tim file log.txt tai thu muc chua file php xu ly sms nay
// kiem tra de biet ban da nhan du thong tin ve tin nhan hay chua
$text = $code." - ".$subCode." - ".$mobile." - ".$serviceNumber." - ".$ipremote." - ".$info;
$fh = fopen('log.txt', "a+") or die("Could not open log.txt file.");
@fwrite($fh, date("d-m-Y, H:i")." - $text\n") or die("Could not write file!");
fclose($fh);


// 2. Kiem tra bao mat du lieu tu iNET gui qua
// Lien he voi iNET de lay IP nay
/*
if($_SERVER['REMOTE_ADDR'] != '210.211.127.168') { // 210.211.127.168
    echo $_SERVER['REMOTE_ADDR'];
    echo "Authen Error";
    exit;
}
*/

// 3. Xu ly du lieu cua ban tai day
// ket noi csdl
$ketnoi = mysqli_connect('localhost', 'nghiafun_game24h', 't1i4c1N2', 'nghiafun_game24h');
mysqli_set_charset($ketnoi, 'UTF-8');
$exist_u = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `users` WHERE `id` = '".$id_user."'"));
if ($exist_u > 0) {
$infouser = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT * FROM `users` WHERE `id` = '".$id_user."'"));
}
// xu ly du lieu
if ($subCode == '8VUI') {
	// 5. Tra ve tin nha gom kieu tin nhan (0) va noi dung tin nhan
	// Xuong dong trong tin nhan su dung \n
	if ($ma == 'ACTIVE') {
		$checksdt = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `users` WHERE `mibile` = '".$mobile."'"));
		if ($exist_u < 1) {
			$noidung = "Hi ".$mobile."! \nThanh vien khong ton tai.";    
		} else if (!empty($infouser['mibile'])) {
			$noidung = "Hi ".$mobile."! \nTai khoan nay da kich hoat SDT.";  
		} else if ($checksdt > 0) {
			$noidung = "Hi ".$mobile."! \nSDT nay da kich hoat 1 tai khoan khac.";  
		} else {
			$rand = rand(9999,99999);
			mysqli_query($ketnoi, "INSERT INTO `kichhoat` SET `code` = '".$rand."', `user_id` = '".$id_user."', `sdt` = '".$mobile."', `time` = '".(time() + 600)."'");
			$noidung = "Hi ".$mobile."! \nMa kich hoat cua ban la: $rand.\nVao cong vien de nhap ma kich hoat.\nMa kich hoat chi ton tai trong vong 10 phut!";     
		} 
	} else if ($ma == 'PASS') {
		$checksdt = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `users` WHERE `mibile` = '".$mobile."'"));
		if ($checksdt < 1) {
			$noidung = "Hi ".$mobile."! \nSDT cua ban chua kich hoat tai khoan nao tren 8vui.";   
		} else {
			$infouser = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT * FROM `users` WHERE `mibile` = '".$mobile."'"));
			$rand = rand(9999,99999);
			$mahoa = md5(md5($rand));
			mysqli_query($ketnoi, "UPDATE `users` SET `password` = '".$mahoa."' WHERE `id` = '".$infouser['id']."'");
			$noidung = "Hi ".$mobile."! \nMat khau moi cua nick {$infouser['name']} la $rand.\nVui long doi mat khau de dam bao an toan";   
		}
	} else if ($ma == 'PASS2') {
		$checksdt = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `users` WHERE `mibile` = '".$mobile."'"));
		if ($checksdt < 1) {
			$noidung = "Hi ".$mobile."! \nSDT cua ban chua kich hoat tai khoan nao tren 8vui.";   
		} else {
			$infouser = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT * FROM `users` WHERE `mibile` = '".$mobile."'"));
			$rand = rand(9999,99999);
			$mahoa = md5(md5($rand));
			mysqli_query($ketnoi, "UPDATE `users` SET `password_2` = '".$mahoa."' WHERE `id` = '".$infouser['id']."'");
			$noidung = "Hi ".$mobile."! \nMat khau cap 2 cua nick {$infouser['name']} la $rand.\nVui long doi mat khau cap 2 de dam bao an toan.";   
		}
	} else {
		$noidung = "Hi ".$mobile."! \nTin nhan sai cu phap roi ban nhe.";  
	}
	echo "0|".$noidung;  
}
?>