<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Đổi shuriken + kunai';
require('../../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="phdr">Đổi shuriken ( 1 shuriken = 5 exp )</div>';
$res = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop`= '47' AND `user_id` = '".$user_id."' "));
if (isset($_POST['submit']))
{
	$soluong = (int)$_POST['soluong']; //bọc hàm int để tránh bug
	//$soluong la lay tu số lượng member nhập vào
	//nếu mà số lượng nhập vào lớn hơn số lượng đang có thì in ra lỗi
	if ($soluong > $res['soluong'])
	{
		echo '<div class="rmenu">Bạn không đủ shuriken để đổi !</div>';
	}
	else if ($soluong <= 0) 
	{
		echo '<div class="rmenu">Số lượng nhập không hợp lệ</div>';
	}
	else 
	{
		
		$exp = $soluong * 5;
		//update tiền cho thành viên
		mysql_query("update `users` set `naruto` = `naruto` + '$exp' WHERE id = '$user_id'");
		//sau đó trừ số lượng trong data
		mysql_query("update `vatpham` SET `soluong` = `soluong` - '$soluong' WHERE `id_shop` = '47' AND `user_id` = '".$user_id."'");
		//inra màn hình thnafh công
		echo '<div class="menu">Bạn đã đổi thành công shuriken thu về <b>'.$exp.'</b> exp</div>';
	}
}
echo'<form method="post"><div class="list1">
<table>
<tr/>
<td><img src="http://i.imgur.com/yhOvLv6.png"></td>
<td><b><font color="blue">Shuriken</font></b></br><font color="red">(Hiện có: <b>'.$res['soluong'].'</b> shuriken)</font></br><input type="number" name="soluong" width="60px" placeholder="Nhập số lượng shuriken muốn đổi"></br>
<input type="submit" name="submit" value="Đổi" class="nut"></td>
</tr>
</table>
</div></form>';
///////////////////////////////////////////////////////////////////////////////////////
echo '<div class="phdr">Đổi Kunai ( 1 kunai = 3 exp )</div>';
$res = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `id_shop`= '48' AND `user_id` = '".$user_id."' "));
if (isset($_POST['xxx']))
{
	$soluong = (int)$_POST['sss']; //bọc hàm int để tránh bug
	//$soluong la lay tu số lượng member nhập vào
	//nếu mà số lượng nhập vào lớn hơn số lượng đang có thì in ra lỗi
	if ($soluong > $res['soluong'])
	{
		echo '<div class="rmenu">Bạn không đủ Kunai để đổi !</div>';
	}
	else if ($soluong <= 0) 
	{
		echo '<div class="rmenu">Số lượng nhập không hợp lệ</div>';
	}
	else 
	{
		
		$x = $soluong * 3;
		//update tiền cho thành viên
		mysql_query("update `users` set `naruto` = `naruto` + '$x' WHERE id = '$user_id'");
		//sau đó trừ số lượng trong data
		mysql_query("update `vatpham` SET `soluong` = `soluong` - '$soluong' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
		//inra màn hình thnafh công
		echo '<div class="menu">Bạn đã đổi thành công kunai thu về <b>'.$exp.'</b> exp</div>';
	}
}
echo'<form method="post"><div class="list1">
<table>
<tr/>
<td><img src="http://i.imgur.com/KScfqF4.png"></td>
<td><b><font color="blue">Kunai</font></b></br><font color="red">(Hiện có: <b>'.$res['soluong'].'</b> kunai)</font></br><input type="number" name="sss" width="60px" placeholder="Nhập số lượng kunai muốn đổi"></br>
<input type="submit" name="xxx" value="Đổi" class="nut"></td>
</tr>
</table>
</div></form>';
echo '<div class="menu"><details><summary><font color="brown"><b> Các cấp độ ninja </b></font></summary>
1 exp = <b>ninja academy</b></br>
50 exp = <font color="#9900ff"><b>Gennin</b></font></br>
200 exp = <font color="#9900ff"><b>Gennin + 1</b></font></br>
300 exp = <font color="#9900ff"><b>Gennin + 2</b></font></br>
500 exp = <font color="green"><b>Chunnin</b></font></br>
800 exp = <font color="green"><b>Chunnin + 1</b></font></br>
1300 exp = <font color="green"><b>Chunnin + 2</b></font></br>
2000 exp = <font color="green"><b>Chunnin + 3</b></font></br>
4000 exp = <font color="blue">Jonin</font></br>
6000 exp = <font color="blue"><b>Jonin Special</b></font></br>
8000 exp = <font color="#FFEB3B"><b>Sannin </b></font></br>
10000 exp = <font color="red"><b>Kage</b></font></details></div>';
echo '</div>';
require('../../incfiles/end.php');
?>