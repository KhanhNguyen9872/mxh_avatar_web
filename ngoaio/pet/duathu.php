<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Đua PET';
require('../../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div><div class="lucifer"><div class="phdr" style="margin-bottom: 10px;"><center>Đặt cược</center></div>';
$ketqua = mysql_fetch_array(mysql_query("SELECT * FROM `ketquapet` ORDER BY `time` DESC LIMIT 1"));
echo '<div class="gmenu" style="margin-bottom: 10px;"><center>Trận đấu tiếp theo sẽ diễn ra trong vòng <b>'.($ketqua['time'] - time()).'</b>s nữa~</div></center><a id="ccc"><div class="loginred"><center><font color="green"><b>[ Mở bảng đặt cược đua pet ]</b></font></center></div><div id="cccs" style="display:none;">';
if (isset($_POST['submit'])) {
	$pet = (int)$_POST['pet'];
	if (!in_array($pet, array(1,2,3,4,5,6,7))) {
		echo '<div class="rmenu">Bug clgt???</div>';
	} else {
		$kq=mysql_fetch_array(mysql_query("SELECT * FROM `ketquapet` ORDER BY `id` DESC LIMIT 1"));
		$lan=$kq['id']+1;
		$checknum = mysql_num_rows(mysql_query("SELECT * FROM `cuocpet` WHERE `user_id` = '".$user_id."' AND `lan` = '".$lan."'"));
		$tiencuoc = intval($_POST['tiencuoc']);
		if ($tiencuoc > $datauser['xu']) {
			echo '<div class="rmenu">Thiếu xu bạn ơi...</div>';
		} else if ($checknum > 0) {
			echo '<div class="rmenu">Lần này bạn đã cược rồi nhé, vui lòng chờ trận đấu kết thúc</div>';
		} else if ($tiencuoc > 2000000) {
			echo '<div class="rmenu">Tiền cược không quá 2tr xu</div>';
		} else {
			mysql_query("INSERT INTO `cuocpet` SET `user_id` = '".$user_id."', `lan` = '".$lan."', `tien` = '".$tiencuoc."', `pet` = '".$pet."', `time` = '".time()."'");
			mysql_query("UPDATE `users` SET `xu` = `xu` - '".$tiencuoc."' WHERE `id` = '".$user_id."'");
			//nhiệm vụ naruto
			$check_nv = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `user_id` = '".$user_id."' AND `id_nv` = '2'"));
			if ($check_nv > 0) {
			mysql_query("UPDATE `naruto_nhiemvu` SET `tiendo` = `tiendo` + '1' WHERE `id_nv` = '2' AND `user_id` = '".$user_id."'");
			}
			//end nhiệm vụ naruto
			echo '<div class="menu">Cược thành công. Bạn vui lòng đợi để xem kết quả</div>';
		}
	}
}
echo '<a id="1"><div class="login">
<img src="http://i.imgur.com/vaeP0YQ.gif"><font color="green"><b> Rắn thợ săn  </b></font>
</div></a><div id="1s" style="display:none;"><div class="loginred">đặt cược cho Rắn thợ săn : </br>
<form method="post">
<input type="hidden" value="1" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div>';

echo '<a id="2"><div class="login">
<img src="http://i.imgur.com/L4zOfQd.gif"><font color="blue"><b> Vẹt xanh </b></font>
</div></a><div id="2s" style="display:none;"><div class="loginred">đặt cược cho Vẹt xanh : </br>
<form method="post">
<input type="hidden" value="2" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div>';

echo '<a id="3"><div class="login">
<img src="http://i.imgur.com/O3U3s1X.gif"><font color="brown"><b> Tuần lộc </b></font>
</div></a><div id="3s" style="display:none;"><div class="loginred">đặt cược cho Tuần lộc : </br>
<form method="post">
<input type="hidden" value="3" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div>';

echo '<a id="4"><div class="login">
<img src="http://i.imgur.com/FSlh2mU.gif"><font color="black"><b> Dargon Kingnight</b></font>
</div></a><div id="4s" style="display:none;"><div class="loginred">đặt cược cho Dargon Kingnight : </br>
<form method="post">
<input type="hidden" value="4" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div>';

echo '<a id="5"><div class="login">
<img src="http://i.imgur.com/u2RdyKm.gif"><font color="#9E9E9E"><b> Totoro</b></font>
</div></a><div id="5s" style="display:none;"><div class="loginred">đặt cược cho Totoro : </br>
<form method="post">
<input type="hidden" value="5" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div>';

echo '<a id="6"><div class="login">
<img src="http://i.imgur.com/5UGkn6O.gif"><font color="pink"><b> Bướm hồng</b></font>
</div></a><div id="6s" style="display:none;"><div class="loginred">đặt cược cho Bướm hồng : </br>
<form method="post">
<input type="hidden" value="6" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div>';

echo '<a id="7"><div class="login">
<img src="http://i.imgur.com/3DWJFYF.gif"><font color="#FFEB3B"><b> Pikachu</b></font>
</div></a><div id="7s" style="display:none;"><div class="loginred">đặt cược cho Pikachu : </br>
<form method="post">
<input type="hidden" value="7" name="pet">
<input type="text" name="tiencuoc" placeholder="Nhập tiền cược...">
<input type="submit" value="Cược" name="submit">
</form>
</div></div></div>';

echo '<div class="phdr"><center>Kết quả đợt trước </center></div>';
echo'<style type="text/css"> 
.bbb{background:url("http://i.imgur.com/UZkcWRX.png");} 
.ccc{background:url("http://i.imgur.com/HdaO3I0.png");}
</style>';
echo '<div class="bbb" style="height:120px; margin:0;"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div><div class="cola" style="min-height: 20px;margin:0"><div class="buico"></div></div>';
$tocdo = array();
for ($pet = 1; $pet <= 7; $pet++) {
	for ($none = 1; $none <= 7; $none++) {
		if ($ketqua['vitri'.$pet] == $none) {
			if ($pet == 1) {
				$tocdo[$none] = 7;
			}
			if ($pet == 2) {
				$tocdo[$none] = 6;
			}
			if ($pet == 3) {
				$tocdo[$none] = 5;
			}
			if ($pet == 4) {
				$tocdo[$none] = 4;
			}
			if ($pet == 5) {
				$tocdo[$none] = 3;
			}
			if ($pet == 6) {
				$tocdo[$none] = 2;
			}
			if ($pet == 7) {
				$tocdo[$none] = 1;
			}
		}
	}
	
	if ($ketqua['vitri1'] == 6) {
		$tocdo[6] = 7;
	}
	if ($ketqua['vitri1'] == 7) {
		$tocdo[6] = 7;
	}
}
///rắn thợ săn
echo'<div class="ccc"><marquee behavior="slide" direction="right" scrollamount="'.$tocdo[1].'"><img src="http://i.imgur.com/vaeP0YQ.gif"></marquee></div>';
///vẹt xanh
echo'<div class="ccc"><marquee behavior="slide" direction="right" scrollamount="'.$tocdo[2].'"><img src="http://i.imgur.com/L4zOfQd.gif"></marquee></div>';
///tuần lộc
echo'<div class="ccc"><marquee behavior="slide" direction="right" scrollamount="'.$tocdo[3].'"><img src="http://i.imgur.com/O3U3s1X.gif"></marquee></div>';
///Dargon Kingnight
echo'<div class="ccc"><marquee behavior="slide" direction="right" scrollamount="'.$tocdo[4].'"><img src="http://i.imgur.com/FSlh2mU.gif"></marquee></div>';
///Totoro
echo'<div class="ccc"><marquee behavior="slide" direction="right" scrollamount="'.$tocdo[5].'"><img src="http://i.imgur.com/u2RdyKm.gif"></marquee></div>';
///bướm hồng
echo'<div class="ccc"><marquee behavior="slide" direction="right" scrollamount="'.$tocdo[6].'"><img src="http://i.imgur.com/5UGkn6O.gif"></marquee></div>';
///Pikachu
echo'<div class="ccc"><marquee behavior="slide" direction="right" scrollamount="'.$tocdo[7].'"><img src="http://i.imgur.com/3DWJFYF.gif"></marquee></div>';
echo'<div class="cola" style="min-height: 20px;margin:0"><div class="buico"></div></div>';
$req = mysql_query("SELECT * FROM `cuocpet` WHERE `pet` = '".$ketqua['vitri1']."' AND `lan` = '".$ketqua['id']."'");
$nick = '';
while ($res = mysql_fetch_assoc($req)) {
	$nick .= nick($res['user_id']). ', ';
}
if (!empty($nick)) {
echo '<div class="rmenu">-Danh sách người chơi trúng thưởng đợt trước: <b>'.trim($nick, ', ').'</b></div>';
}
echo '</div>';
//
include 'xuli.php';
echo'<style type="text/css">
.loginred{background-color:#ecfff4;border-radius:5px;padding:8px;margin-bottom:5px;border:solid 1px #F44336;}
</style>';
//
require('../../incfiles/end.php');
?>