<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl = 'Nhiệm vụ - Kakashi';
if (!$user_id) {
header('Location: /login.php');
exit;
}
require('../../incfiles/head.php');
echo '<div class="phdr">'.$textl.'</div>';
if (isset($_GET['ok'])) {
	echo '<div class="list1">Nhận thưởng thành công</div>';
}
switch($act) {
case 'hoanthanh':
if (!in_array($id, array(1,2,3,4))) {
	header('Location: nhiemvu.php');
	exit;
} else {
	$info1 = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '1' AND `tiendo` >= '2' AND `nhanthuong` = '0' AND `user_id` = '".$user_id."'"));
	$info2 = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '2' AND `tiendo` >= '2' AND `nhanthuong` = '0' AND `user_id` = '".$user_id."'"));
	$info3 = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '3' AND `tiendo` >= '2' AND `nhanthuong` = '0' AND `user_id` = '".$user_id."'"));
	$info4 = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '4' AND `tiendo` >= '5' AND `nhanthuong` = '0' AND `user_id` = '".$user_id."'"));
	if ($id == 1 && $info1 > 0) {
		mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '10' WHERE `id_shop` = '47' AND `user_id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_nhiemvu` SET `nhanthuong` = '1' WHERE `id_nv` = '1' AND `user_id` = '".$user_id."'");
		header('Location: nhiemvu.php?ok');
		exit;
	} else if ($id == 2 && $info2 > 0) {
		mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '5' WHERE `id_shop` = '47' AND `user_id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_nhiemvu` SET `nhanthuong` = '1' WHERE `id_nv` = '2' AND `user_id` = '".$user_id."'");
		header('Location: nhiemvu.php?ok');
		exit;
	} else if ($id == 3 && $info3 > 0) {
		mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '5' WHERE `id_shop` = '47' AND `user_id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_nhiemvu` SET `nhanthuong` = '1' WHERE `id_nv` = '3' AND `user_id` = '".$user_id."'");
		header('Location: nhiemvu.php?ok');
		exit;
	} else if ($id == 4 && $info4 > 0) {
		mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '5' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_nhiemvu` SET `nhanthuong` = '1' WHERE `id_nv` = '4' AND `user_id` = '".$user_id."'");
		header('Location: nhiemvu.php?ok');
		exit;
	} else {
		header('Location: nhiemvu.php');
		exit;
	}
}
break;
case 'nhan_nv':
if (!in_array($id, array(1,2,3,4))) {
	header('Location: nhiemvu.php');
	exit;
} else {
	$check_nv =  mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `user_id` = '".$user_id."' AND `nhanthuong` = '0'"));
	$check_hoanthanh = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `user_id` = '".$user_id."' AND `id_nv` = '".$id."' AND `nhanthuong` = '1'"));
	if ($check_nv > 0) {
		echo '<div class="list1">Hãy hoàn thành nhiệm vụ để nhận nhiệm vụ mới!</div>';
	} else if ($check_hoanthanh > 0) {
		echo '<div class="list1">Bạn đã nhận thưởng từ nhiệm vụ này rồi nhé!</div>';
	} else {
		if ($id == 1) {
			mysql_query("INSERT INTO `naruto_nhiemvu` SET `user_id` = '".$user_id."', `id_nv` = '".$id."', `tiendo` = '0'");
		} else if ($id == 2) {
			mysql_query("INSERT INTO `naruto_nhiemvu` SET `user_id` = '".$user_id."', `id_nv` = '".$id."', `tiendo` = '0'");
		} else if ($id == 3) {
			mysql_query("INSERT INTO `naruto_nhiemvu` SET `user_id` = '".$user_id."', `id_nv` = '".$id."', `tiendo` = '0'");
		} else if ($id == 4) {
			mysql_query("INSERT INTO `naruto_nhiemvu` SET `user_id` = '".$user_id."', `id_nv` = '".$id."', `tiendo` = '0'");
		}	
		header('Location: nhiemvu.php');
		exit;
	}
}
break;
default:
$check1 = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '1' AND `user_id` = '".$user_id."'"));
$check2 = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '2' AND `user_id` = '".$user_id."'"));
$check3 = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '3' AND `user_id` = '".$user_id."'"));
$check4 = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '4' AND `user_id` = '".$user_id."'"));
$info1 = mysql_fetch_assoc(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '1' AND `user_id` = '".$user_id."'"));
$info2 = mysql_fetch_assoc(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '2' AND `user_id` = '".$user_id."'"));
$info3 = mysql_fetch_assoc(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '3' AND `user_id` = '".$user_id."'"));
$info4 = mysql_fetch_assoc(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `id_nv` = '4' AND `user_id` = '".$user_id."'"));
echo '<div class="rmenu"><center><img src="/avatar/3.png"><br/><b>Hãy chọn nhiệm vụ ngươi có thể làm được nhé!</b></center></div>';
echo '<div class="menu">
<table width="80%">
	<tr>
		<td class="left-info"><center><img src="http://8vui.top/icon/iconfarm.png"></center></td>
		<td class="right-info" style="padding-left:20px;"><b>Nhiệm vụ 1</b><br/>Mục tiêu: Thu hoạch farm 2 lần<br/>Phần thưởng: <b>10</b> <img src="/images/vatpham/47.png"><br/>'.($check1 > 0 ? ''.($info1['tiendo'] >= 2 ? '<a href="?act=hoanthanh&id=1"><input type="button" value="Hoàn thành nhiệm vụ"></a>' : 'Tiến độ: '.$info1['tiendo'].' / 2').'' : '<a href="?act=nhan_nv&id=1"><input type="button" value="Nhận nhiệm vụ"></a>').'</td>
	</tr>
</table>
</div>';
echo '<div class="menu">
<table width="80%">
	<tr>
		<td class="left-info"><center><img src="http://8vui.us/images/duathu.png"></center></td>
		<td class="right-info" style="padding-left:20px;"><b>Nhiệm vụ 2</b><br/>Mục tiêu: Đua pet 2 lần<br/>Phần thưởng: <b>5</b> <img src="/images/vatpham/47.png"><br/>'.($check2 > 0 ? ''.($info2['tiendo'] >= 2 ? '<a href="?act=hoanthanh&id=2"><input type="button" value="Hoàn thành nhiệm vụ"></a>' : 'Tiến độ: '.$info2['tiendo'].' / 2').'' : '<a href="?act=nhan_nv&id=2"><input type="button" value="Nhận nhiệm vụ"></a>').'</td>
	</tr>
</table>
</div>';
echo '<div class="menu">
<table width="80%">
	<tr>
		<td class="left-info"><center><img src="http://8vui.top/images/muasam.png"></center></td>
		<td class="right-info" style="padding-left:20px;"><b>Nhiệm vụ 3</b><br/>Mục tiêu: Mua 2 thú cưng<br/>Phần thưởng: <b>5</b> <img src="/images/vatpham/47.png"><br/>'.($check3 > 0 ? ''.($info3['tiendo'] >= 2 ? '<a href="?act=hoanthanh&id=3"><input type="button" value="Hoàn thành nhiệm vụ"></a>' : 'Tiến độ: '.$info3['tiendo'].' / 2').'' : '<a href="?act=nhan_nv&id=3"><input type="button" value="Nhận nhiệm vụ"></a>').'</td>
	</tr>
</table>
</div>';
echo '<div class="menu">
<table width="80%">
	<tr>
		<td class="left-info"><center><img src="http://8vui.top/icon/khe.png"></center></td>
		<td class="right-info" style="padding-left:20px;"><b>Nhiệm vụ 4</b><br/>Mục tiêu: Thu hoạch cây khế 5 lần<br/>Phần thưởng: <b>5</b> <img src="/images/vatpham/48.png"><br/>'.($check4 > 0 ? ''.($info4['tiendo'] >= 5 ? '<a href="?act=hoanthanh&id=4"><input type="button" value="Hoàn thành nhiệm vụ"></a>' : 'Tiến độ: '.$info4['tiendo'].' / 5').'' : '<a href="?act=nhan_nv&id=4"><input type="button" value="Nhận nhiệm vụ"></a>').'</td>
	</tr>
</table>
</div>';
break;
}
require('../../incfiles/end.php');
?>