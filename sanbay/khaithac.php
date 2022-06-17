<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
$textl = 'Khu Khai Thác';
require('../incfiles/head.php');
switch($act) {
default:
echo'<div class="out-tab"><div class="phdr">Khu Khai Thác</div>';
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `khaithac` WHERE `user_id`='{$user_id}'"), 0);
if($kt == 0) {
mysql_query("INSERT INTO `khaithac` SET `user_id`='{$user_id}', `doben`='100'");
}
$dv = mysql_fetch_array(mysql_query("SELECT * FROM `khaithac` WHERE `user_id`='{$user_id}'"));
echo '<div class="menu"><form method="post"><input type="submit" name="sua" value="Sửa chữa" /></form>';
$time = time();
if(isset($_POST['sua'])) {
if(($dv['time'] + 86400) > time()) {
$time = $dv['time'] + 86400 - time();
echo 'Sau <b>'.date('H:i', $time).'</b> nữa bạn mới có thể sửa tiếp!';
} else if($dv['doben'] == 100) {
echo 'Công cụ của bạn không hư hỏng nên không cần sửa!';
} else {
mysql_query("UPDATE `khaithac` SET `doben`='100', `time`='{$time}' WHERE `user_id`='{$user_id}'");
echo 'Sửa máy thành công!';
}
}
echo '</div>';
echo '<div class="list1 phanngang">';
echo '<b>Độ bền:</b> <b class="green">'.$dv['doben'].'%</b><br/><b>Kim cương:</b> <b class="blue"> '.$dv['kimcuong'].'</b> viên</div>';
echo '<style type="text/css">
.nenkhaithac2{background:url(http://i.imgur.com/xyGmo75.png) repeat-x}
.nenkhaithac{background:url(http://i.imgur.com/MreO5M3.png) repeat-x}</style>';
echo '<div class="nenkhaithac" style="height:125px; margin:0;"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div><div class="cola" style="margin:0px 0px"><div class="nenkhaithac2" style="height:29px;"></div><center><img src="/avatar/'.$user_id.'.png" /><br/><form method="post"><input type="submit" name="submit" value="Khai thác" class="nut"/></form></center>';
if(isset($_POST['submit'])) {
if($dv['doben'] == 0) {
echo '</div><div class="danhsach phancach">Công cụ của bạn đã hư hỏng. Cần phải sửa chữa, nếu hôm nay bạn đã sửa vui lòng đợi đến ngày mai!';
} else {
$kcuong = rand(1, 5);
$rand = rand(1, 4);
if($rand < 6) {
mysql_query("UPDATE `khaithac` SET `kimcuong`=`kimcuong`+'{$kcuong}' WHERE `user_id`='{$user_id}'");

echo '</div><div class="danhsach phancach"><img src="'.$home.'/images/kc.png" alt="KC" class="margin-r-5 icon-m-o3"/> Bạn vừa đào được <b class="blue">'.$kcuong.'</b> Viên Kim Cương';
}elseif($rand < 3) {
mysql_query("UPDATE `khaithac` SET `kimcuong`=`kimcuong`+'{$kcuong}' WHERE `user_id`='{$user_id}'");
echo '</div><div class="danhsach phancach"><img src="'.$home.'/images/kc.png" alt="KC" class="margin-r-5 icon-m-o3"/> Bạn vừa đào được <b class="blue">'.$kcuong.'</b> Viên Kim Cương';
}elseif($rand < 4) {
//SU KIEN
$randsk=rand(1,3);
if ($randsk==1) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='48' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/48.png"> Bạn đã đào ra 1 Kunai<br/>';
} else {
mysql_query("UPDATE `khaithac` SET `kimcuong`=`kimcuong`+'{$kcuong}' WHERE `user_id`='{$user_id}'");
echo '</div><div class="danhsach phancach"><img src="'.$home.'/images/kc.png" alt="KC" class="margin-r-5 icon-m-o3"/> Bạn vừa đào được <b class="blue">'.$kcuong.'</b> Viên Kim Cương';
}
//END SK
}elseif($rand < 5) {
mysql_query("UPDATE `khaithac` SET `kimcuong`=`kimcuong`+'{$kcuong}' WHERE `user_id`='{$user_id}'");
echo '</div><div class="danhsach phancach"><img src="'.$home.'/images/kc.png" alt="KC" class="margin-r-5 icon-m-o3"/> Bạn vừa đào được <b class="blue">'.$kcuong.'</b> Viên Kim Cương';
}else{
mysql_query("UPDATE `khaithac` SET `kimcuong`='0' WHERE `user_id`='{$user_id}'");
echo '</div><div class="danhsach phancach">Bạn vừa bị mất hết số kim cương do đào trúng <b>Boom</b>';
}

mysql_query("UPDATE `khaithac` SET `doben`=`doben`-'10' WHERE `user_id`='{$user_id}'");
}
}
echo'</div></div>';
break;
case 'shop':
echo '<div class="phdr">Shop khu khai thác </div>';
//lấy số kim cương ở trong table `khaithac`
$res = mysql_fetch_array(mysql_query("SELECT * FROM `khaithac` WHERE `user_id` = '".$user_id."'"));
//--xử lý khi người dùng ấn vào nút Bán--//
//nếu người dùng bấm vào nút có name = submit thì xử lý
if (isset($_POST['submit']))
{
	$soluong = (int)$_POST['soluong']; //bọc hàm int để tránh bug
	//$soluong la lay tu số lượng member nhập vào
	//nếu mà số lượng nhập vào lớn hơn số lượng đang có thì in ra lỗi
	if ($soluong > $res['kimcuong'])
	{
		echo '<div class="rmenu">Bạn không đủ kim cương để bán!</div>';
	}
	else if ($soluong <= 0) //trường hợp member nhập số âm
	{
		echo '<div class="rmenu">Số lượng nhập không hợp lệ</div>';
	}
	else //trường hợp ngược lại
	{
		//tính thành tiền
		$tien = $soluong * 5000;
		//update tiền cho thành viên
		mysql_query("update users set xu = xu + '$tien' WHERE id = '$user_id'");
		//sau đó trừ số lượng trong data
		mysql_query("update khaithac set kimcuong = kimcuong - '$soluong' WHERE user_id = '$user_id'");
		//inra màn hình thnafh công
		echo '<div class="menu">Bạn đã bán thành công kim cương. thu về <b>'.$tien.'</b> xu</div>';
	}//chưa bọc form nữa
}
echo'<form method="post"><div class="omenu">
<table>
<tr>
<td><img src="/images/kc.png"></td>
<td><b><font color="blue">Kim cương</font></b><font color="red">(Max: <b>'.$res['kimcuong'].'</b> viên)</font><br/><b>Bán với giá: 5.000 xu / 1 viên</b><br/><input type="number" name="soluong" placeholder="Nhập số lượng..."></br>
<input type="submit" name="submit" value="Bán" class="nut"></td>
</tr>
</table>
</div></form>';
break;
case 'index':
echo '<div class="phdr">Khu khai thác </div>';
echo '<table>';
echo '<tr>';
echo '<td>';
echo '<img src="/icon/khaithac.png">';
echo '</td>';
echo '<td>';
echo '<div class="login"><a href="/sanbay/khaithac.php"><b><font color="brown">Vào khai thác kim cương</b></font</a></div>';
echo '<div class="login"><a href="/sanbay/khaithac.php?act=shop"><b><font color="brown">Shop khu khai thác</font></b></a></div>';
echo '</td>';
echo '</tr>';
echo '</table>';
break;
}
Echo'<div><div>';
require('../incfiles/end.php');
?>