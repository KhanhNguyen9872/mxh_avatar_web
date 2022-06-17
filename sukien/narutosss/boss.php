<?php
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
$textl = 'Tiêu diệt cửu vĩ';
require_once('../../incfiles/head.php');
switch ($act) {
case '1':
$act = intval($act);
$post = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '1'"));
echo '<div class="phdr">Đấu với '.$post['name'].'</div>';
if ($post['hp'] <= 0) {
echo '<div class="rmenu"><b>'.$post['name'].'</b> đã bị tiêu diệt bởi <b>'.nick($post['user_id']).'</b> <a href="?act='.($act+1).'"><input type="submit" value="Vào ải tiếp theo"></a></div>';
}
echo '<div class="gmenu">Click vào hình để đánh</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">'.$post['name'].' đã kiệt sức hãy quay lại sau</div>';
	} else if ($datauser['hpfull'] < 1000 || $datauser['sucmanh'] < 1000) 
	{
		echo '<div class="rmenu">Bạn quá yếu. Hãy luyện đồ để đủ 1,000 HP và 1,000 SM</div>';
	} else if ($datauser['hp'] <=0)
	{
		echo '<div class="rmenu">Bạn đã kiệt sức... Hãy đến gặp bác sĩ!</div>';
	}
	else if ($datauser['lastpost'] > time())
	{
		echo '<div class="rmenu">Đang hồi skill vui lòng đợi <b>'.($datauser['lastpost'] - time()).'</b>s nữa</div>';
	}
	else
	{
		$sd1=rand($post['sucmanh']/100*10, $post['sucmanh']);
		$sd2=rand($datauser['sucmanh']/100*10,($datauser['sucmanh'] + ($datauser['hpfull']*10/100)));
		$nhan = rand(1,5);
		$mayman = rand(1,10);
		
		$tien = ceil(($sd2 * $nhan) / 10);
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_boss` SET `hp` = `hp` - '".$sd1."' WHERE `id` = '".$act."'");
		echo '<div class="rmenu">Bạn đánh '.$post['name'].' mất <b>'.$sd2.' HP</b>, '.$post['name'].' phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		$checkboss = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$act."'"));
		if ($checkboss['hp'] <= 0) {
			mysql_query("UPDATE `naruto_boss` SET `user_id` = '".$user_id."' WHERE `id` = '".$post['id']."'");
			mysql_query("UPDATE `users` SET `vnd` = `vnd` + '5' WHERE `id` = '".$user_id."'");
			echo '<div class="rmenu">Bạn đã tiêu diệt '.$post['name'].' và nhận được 5 lượng</div>';
		}
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://8vui.top/images/vatpham/48.png"> Bạn nhận được 1 kunai</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 400px;">';

echo '<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act='.$act.'&danh"><img height="250" src="img/'.$act.'.png"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>';

echo '</div>';
break;
case '2':
$act = intval($act);
$post = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '2'"));
$prev = $act - 1;
$fuckyou = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$prev."'"));
if ($fuckyou['hp'] > 0) {
	echo '<div class="phdr">Hãy quay lại</div>';
	echo '<div class="list1">Hãy tiêu diệt <a href="?act='.$fuckyou['id'].'"><b>'.$fuckyou['name'].'</b></a> trước đã. Ngươi mới có cơ để chơi ta!</div>';
	require_once('../../incfiles/end.php');
	exit;
}
echo '<div class="phdr">Đấu với '.$post['name'].'</div>';
if ($post['hp'] <= 0) {
echo '<div class="rmenu"><b>'.$post['name'].'</b> đã bị tiêu diệt bởi <b>'.nick($post['user_id']).'</b> <a href="?act='.($act+1).'"><input type="submit" value="Vào ải tiếp theo"></a></div>';
}
echo '<div class="gmenu">Click vào hình để đánh</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">'.$post['name'].' đã kiệt sức hãy quay lại sau</div>';
	} else if ($datauser['hpfull'] < 1000 || $datauser['sucmanh'] < 1000) 
	{
		echo '<div class="rmenu">Bạn quá yếu. Hãy luyện đồ để đủ 1,000 HP và 1,000 SM</div>';
	} else if ($datauser['hp'] <=0)
	{
		echo '<div class="rmenu">Bạn đã kiệt sức... Hãy đến gặp bác sĩ!</div>';
	}
	else if ($datauser['lastpost'] > time())
	{
		echo '<div class="rmenu">Đang hồi skill vui lòng đợi <b>'.($datauser['lastpost'] - time()).'</b>s nữa</div>';
	}
	else
	{
		$sd1=rand($post['sucmanh']/100*10, $post['sucmanh']);
		$sd2=rand($datauser['sucmanh']/100*10,($datauser['sucmanh'] + ($datauser['hpfull']*10/100)));
		$nhan = rand(1,5);
		$mayman = rand(1,10);
		
		$tien = ceil(($sd2 * $nhan) / 10);
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_boss` SET `hp` = `hp` - '".$sd1."' WHERE `id` = '".$act."'");
		echo '<div class="rmenu">Bạn đánh '.$post['name'].' mất <b>'.$sd2.' HP</b>, '.$post['name'].' phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		$checkboss = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$act."'"));
		if ($checkboss['hp'] <= 0) {
			mysql_query("UPDATE `naruto_boss` SET `user_id` = '".$user_id."' WHERE `id` = '".$post['id']."'");
			mysql_query("UPDATE `users` SET `vnd` = `vnd` + '5' WHERE `id` = '".$user_id."'");
			echo '<div class="rmenu">Bạn đã tiêu diệt '.$post['name'].' và nhận được 5 lượng</div>';
		}
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://8vui.top/images/vatpham/48.png"> Bạn nhận được 1 kunai</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 400px;">';

echo '<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act='.$act.'&danh"><img height="250" src="img/'.$act.'.png"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>';

echo '</div>';
break;
case '3':
$act = intval($act);
$post = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '3'"));
$prev = $act - 1;
$fuckyou = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$prev."'"));
if ($fuckyou['hp'] > 0) {
	echo '<div class="phdr">Hãy quay lại</div>';
	echo '<div class="list1">Hãy tiêu diệt <a href="?act='.$fuckyou['id'].'"><b>'.$fuckyou['name'].'</b></a> trước đã. Ngươi mới có cơ để chơi ta!</div>';
	require_once('../../incfiles/end.php');
	exit;
}
echo '<div class="phdr">Đấu với '.$post['name'].'</div>';
if ($post['hp'] <= 0) {
echo '<div class="rmenu"><b>'.$post['name'].'</b> đã bị tiêu diệt bởi <b>'.nick($post['user_id']).'</b> <a href="?act='.($act+1).'"><input type="submit" value="Vào ải tiếp theo"></a></div>';
}
echo '<div class="gmenu">Click vào hình để đánh</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">'.$post['name'].' đã kiệt sức hãy quay lại sau</div>';
	} else if ($datauser['hpfull'] < 1000 || $datauser['sucmanh'] < 1000) 
	{
		echo '<div class="rmenu">Bạn quá yếu. Hãy luyện đồ để đủ 1,000 HP và 1,000 SM</div>';
	} else if ($datauser['hp'] <=0)
	{
		echo '<div class="rmenu">Bạn đã kiệt sức... Hãy đến gặp bác sĩ!</div>';
	}
	else if ($datauser['lastpost'] > time())
	{
		echo '<div class="rmenu">Đang hồi skill vui lòng đợi <b>'.($datauser['lastpost'] - time()).'</b>s nữa</div>';
	}
	else
	{
		$sd1=rand($post['sucmanh']/100*10, $post['sucmanh']);
		$sd2=rand($datauser['sucmanh']/100*10,($datauser['sucmanh'] + ($datauser['hpfull']*10/100)));
		$nhan = rand(1,5);
		$mayman = rand(1,10);
		
		$tien = ceil(($sd2 * $nhan) / 10);
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_boss` SET `hp` = `hp` - '".$sd1."' WHERE `id` = '".$act."'");
		echo '<div class="rmenu">Bạn đánh '.$post['name'].' mất <b>'.$sd2.' HP</b>, '.$post['name'].' phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		$checkboss = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$act."'"));
		if ($checkboss['hp'] <= 0) {
			mysql_query("UPDATE `naruto_boss` SET `user_id` = '".$user_id."' WHERE `id` = '".$post['id']."'");
			mysql_query("UPDATE `users` SET `vnd` = `vnd` + '5' WHERE `id` = '".$user_id."'");
			echo '<div class="rmenu">Bạn đã tiêu diệt '.$post['name'].' và nhận được 5 lượng</div>';
		}
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://8vui.top/images/vatpham/48.png"> Bạn nhận được 1 kunai</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 400px;">';

echo '<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act='.$act.'&danh"><img height="250" src="img/'.$act.'.png"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>';

echo '</div>';
break;
case '4':
$act = intval($act);
$post = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '4'"));
$prev = $act - 1;
$fuckyou = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$prev."'"));
if ($fuckyou['hp'] > 0) {
	echo '<div class="phdr">Hãy quay lại</div>';
	echo '<div class="list1">Hãy tiêu diệt <a href="?act='.$fuckyou['id'].'"><b>'.$fuckyou['name'].'</b></a> trước đã. Ngươi mới có cơ để chơi ta!</div>';
	require_once('../../incfiles/end.php');
	exit;
}
echo '<div class="phdr">Đấu với '.$post['name'].'</div>';
if ($post['hp'] <= 0) {
echo '<div class="rmenu"><b>'.$post['name'].'</b> đã bị tiêu diệt bởi <b>'.nick($post['user_id']).'</b> <a href="?act='.($act+1).'"><input type="submit" value="Vào ải tiếp theo"></a></div>';
}
echo '<div class="gmenu">Click vào hình để đánh</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">'.$post['name'].' đã kiệt sức hãy quay lại sau</div>';
	} else if ($datauser['hpfull'] < 1000 || $datauser['sucmanh'] < 1000) 
	{
		echo '<div class="rmenu">Bạn quá yếu. Hãy luyện đồ để đủ 1,000 HP và 1,000 SM</div>';
	} else if ($datauser['hp'] <=0)
	{
		echo '<div class="rmenu">Bạn đã kiệt sức... Hãy đến gặp bác sĩ!</div>';
	}
	else if ($datauser['lastpost'] > time())
	{
		echo '<div class="rmenu">Đang hồi skill vui lòng đợi <b>'.($datauser['lastpost'] - time()).'</b>s nữa</div>';
	}
	else
	{
		$sd1=rand($post['sucmanh']/100*10, $post['sucmanh']);
		$sd2=rand($datauser['sucmanh']/100*10,($datauser['sucmanh'] + ($datauser['hpfull']*10/100)));
		$nhan = rand(1,5);
		$mayman = rand(1,10);
		
		$tien = ceil(($sd2 * $nhan) / 10);
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_boss` SET `hp` = `hp` - '".$sd1."' WHERE `id` = '".$act."'");
		echo '<div class="rmenu">Bạn đánh '.$post['name'].' mất <b>'.$sd2.' HP</b>, '.$post['name'].' phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		$checkboss = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$act."'"));
		if ($checkboss['hp'] <= 0) {
			mysql_query("UPDATE `naruto_boss` SET `user_id` = '".$user_id."' WHERE `id` = '".$post['id']."'");
			mysql_query("UPDATE `users` SET `vnd` = `vnd` + '5' WHERE `id` = '".$user_id."'");
			echo '<div class="rmenu">Bạn đã tiêu diệt '.$post['name'].' và nhận được 5 lượng</div>';
		}
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://8vui.top/images/vatpham/48.png"> Bạn nhận được 1 kunai</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 400px;">';

echo '<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act='.$act.'&danh"><img height="250" src="img/'.$act.'.png"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>';

echo '</div>';
break;
case '5':
$act = intval($act);
$post = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '5'"));
$prev = $act - 1;
$fuckyou = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$prev."'"));
if ($fuckyou['hp'] > 0) {
	echo '<div class="phdr">Hãy quay lại</div>';
	echo '<div class="list1">Hãy tiêu diệt <a href="?act='.$fuckyou['id'].'"><b>'.$fuckyou['name'].'</b></a> trước đã. Ngươi mới có cơ để chơi ta!</div>';
	require_once('../../incfiles/end.php');
	exit;
}
echo '<div class="phdr">Đấu với '.$post['name'].'</div>';
if ($post['hp'] <= 0) {
echo '<div class="rmenu"><b>'.$post['name'].'</b> đã bị tiêu diệt bởi <b>'.nick($post['user_id']).'</b> <a href="?act='.($act+1).'"><input type="submit" value="Vào ải tiếp theo"></a></div>';
}
echo '<div class="gmenu">Click vào hình để đánh</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">'.$post['name'].' đã kiệt sức hãy quay lại sau</div>';
	} else if ($datauser['hpfull'] < 1000 || $datauser['sucmanh'] < 1000) 
	{
		echo '<div class="rmenu">Bạn quá yếu. Hãy luyện đồ để đủ 1,000 HP và 1,000 SM</div>';
	} else if ($datauser['hp'] <=0)
	{
		echo '<div class="rmenu">Bạn đã kiệt sức... Hãy đến gặp bác sĩ!</div>';
	}
	else if ($datauser['lastpost'] > time())
	{
		echo '<div class="rmenu">Đang hồi skill vui lòng đợi <b>'.($datauser['lastpost'] - time()).'</b>s nữa</div>';
	}
	else
	{
		$sd1=rand($post['sucmanh']/100*10, $post['sucmanh']);
		$sd2=rand($datauser['sucmanh']/100*10,($datauser['sucmanh'] + ($datauser['hpfull']*10/100)));
		$nhan = rand(1,5);
		$mayman = rand(1,10);
		
		$tien = ceil(($sd2 * $nhan) / 10);
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_boss` SET `hp` = `hp` - '".$sd1."' WHERE `id` = '".$act."'");
		echo '<div class="rmenu">Bạn đánh '.$post['name'].' mất <b>'.$sd2.' HP</b>, '.$post['name'].' phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		$checkboss = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$act."'"));
		if ($checkboss['hp'] <= 0) {
			mysql_query("UPDATE `naruto_boss` SET `user_id` = '".$user_id."' WHERE `id` = '".$post['id']."'");
			mysql_query("UPDATE `users` SET `vnd` = `vnd` + '5' WHERE `id` = '".$user_id."'");
			echo '<div class="rmenu">Bạn đã tiêu diệt '.$post['name'].' và nhận được 5 lượng</div>';
		}
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://8vui.top/images/vatpham/48.png"> Bạn nhận được 1 kunai</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 400px;">';

echo '<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act='.$act.'&danh"><img height="250" src="img/'.$act.'.png"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>';

echo '</div>';
break;
case '6':
$act = intval($act);
$post = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '6'"));
$prev = $act - 1;
$fuckyou = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$prev."'"));
if ($fuckyou['hp'] > 0) {
	echo '<div class="phdr">Hãy quay lại</div>';
	echo '<div class="list1">Hãy tiêu diệt <a href="?act='.$fuckyou['id'].'"><b>'.$fuckyou['name'].'</b></a> trước đã. Ngươi mới có cơ để chơi ta!</div>';
	require_once('../../incfiles/end.php');
	exit;
}
echo '<div class="phdr">Đấu với '.$post['name'].'</div>';
if ($post['hp'] <= 0) {
echo '<div class="rmenu"><b>'.$post['name'].'</b> đã bị tiêu diệt bởi <b>'.nick($post['user_id']).'</b> <a href="?act='.($act+1).'"><input type="submit" value="Vào ải tiếp theo"></a></div>';
}
echo '<div class="gmenu">Click vào hình để đánh</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">'.$post['name'].' đã kiệt sức hãy quay lại sau</div>';
	} else if ($datauser['hpfull'] < 1000 || $datauser['sucmanh'] < 1000) 
	{
		echo '<div class="rmenu">Bạn quá yếu. Hãy luyện đồ để đủ 1,000 HP và 1,000 SM</div>';
	} else if ($datauser['hp'] <=0)
	{
		echo '<div class="rmenu">Bạn đã kiệt sức... Hãy đến gặp bác sĩ!</div>';
	}
	else if ($datauser['lastpost'] > time())
	{
		echo '<div class="rmenu">Đang hồi skill vui lòng đợi <b>'.($datauser['lastpost'] - time()).'</b>s nữa</div>';
	}
	else
	{
		$sd1=rand($post['sucmanh']/100*10, $post['sucmanh']);
		$sd2=rand($datauser['sucmanh']/100*10,($datauser['sucmanh'] + ($datauser['hpfull']*10/100)));
		$nhan = rand(1,5);
		$mayman = rand(1,10);
		
		$tien = ceil(($sd2 * $nhan) / 10);
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_boss` SET `hp` = `hp` - '".$sd1."' WHERE `id` = '".$act."'");
		echo '<div class="rmenu">Bạn đánh '.$post['name'].' mất <b>'.$sd2.' HP</b>, '.$post['name'].' phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		$checkboss = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$act."'"));
		if ($checkboss['hp'] <= 0) {
			mysql_query("UPDATE `naruto_boss` SET `user_id` = '".$user_id."' WHERE `id` = '".$post['id']."'");
			mysql_query("UPDATE `users` SET `vnd` = `vnd` + '5' WHERE `id` = '".$user_id."'");
			echo '<div class="rmenu">Bạn đã tiêu diệt '.$post['name'].' và nhận được 5 lượng</div>';
		}
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://8vui.top/images/vatpham/48.png"> Bạn nhận được 1 kunai</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 400px;">';

echo '<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act='.$act.'&danh"><img height="250" src="img/'.$act.'.png"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>';

echo '</div>';
break;
case '7':
$act = intval($act);
$post = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '7'"));
$prev = $act - 1;
$fuckyou = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$prev."'"));
if ($fuckyou['hp'] > 0) {
	echo '<div class="phdr">Hãy quay lại</div>';
	echo '<div class="list1">Hãy tiêu diệt <a href="?act='.$fuckyou['id'].'"><b>'.$fuckyou['name'].'</b></a> trước đã. Ngươi mới có cơ để chơi ta!</div>';
	require_once('../../incfiles/end.php');
	exit;
}
echo '<div class="phdr">Đấu với '.$post['name'].'</div>';
if ($post['hp'] <= 0) {
echo '<div class="rmenu"><b>'.$post['name'].'</b> đã bị tiêu diệt bởi <b>'.nick($post['user_id']).'</b> <a href="?act='.($act+1).'"><input type="submit" value="Vào ải tiếp theo"></a></div>';
}
echo '<div class="gmenu">Click vào hình để đánh</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">'.$post['name'].' đã kiệt sức hãy quay lại sau</div>';
	} else if ($datauser['hpfull'] < 1000 || $datauser['sucmanh'] < 1000) 
	{
		echo '<div class="rmenu">Bạn quá yếu. Hãy luyện đồ để đủ 1,000 HP và 1,000 SM</div>';
	} else if ($datauser['hp'] <=0)
	{
		echo '<div class="rmenu">Bạn đã kiệt sức... Hãy đến gặp bác sĩ!</div>';
	}
	else if ($datauser['lastpost'] > time())
	{
		echo '<div class="rmenu">Đang hồi skill vui lòng đợi <b>'.($datauser['lastpost'] - time()).'</b>s nữa</div>';
	}
	else
	{
		$sd1=rand($post['sucmanh']/100*10, $post['sucmanh']);
		$sd2=rand($datauser['sucmanh']/100*10,($datauser['sucmanh'] + ($datauser['hpfull']*10/100)));
		$nhan = rand(1,5);
		$mayman = rand(1,10);
		
		$tien = ceil(($sd2 * $nhan) / 10);
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_boss` SET `hp` = `hp` - '".$sd1."' WHERE `id` = '".$act."'");
		echo '<div class="rmenu">Bạn đánh '.$post['name'].' mất <b>'.$sd2.' HP</b>, '.$post['name'].' phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		$checkboss = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$act."'"));
		if ($checkboss['hp'] <= 0) {
			mysql_query("UPDATE `naruto_boss` SET `user_id` = '".$user_id."' WHERE `id` = '".$post['id']."'");
			mysql_query("UPDATE `users` SET `vnd` = `vnd` + '5' WHERE `id` = '".$user_id."'");
			echo '<div class="rmenu">Bạn đã tiêu diệt '.$post['name'].' và nhận được 5 lượng</div>';
		}
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://8vui.top/images/vatpham/48.png"> Bạn nhận được 1 kunai</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 400px;">';

echo '<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act='.$act.'&danh"><img height="250" src="img/'.$act.'.png"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>';

echo '</div>';
break;
case '8':
$act = intval($act);
$post = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '8'"));
$prev = $act - 1;
$fuckyou = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$prev."'"));
if ($fuckyou['hp'] > 0) {
	echo '<div class="phdr">Hãy quay lại</div>';
	echo '<div class="list1">Hãy tiêu diệt <a href="?act='.$fuckyou['id'].'"><b>'.$fuckyou['name'].'</b></a> trước đã. Ngươi mới có cơ để chơi ta!</div>';
	require_once('../../incfiles/end.php');
	exit;
}
echo '<div class="phdr">Đấu với '.$post['name'].'</div>';
if ($post['hp'] <= 0) {
echo '<div class="rmenu"><b>'.$post['name'].'</b> đã bị tiêu diệt bởi <b>'.nick($post['user_id']).'</b> <a href="?act='.($act+1).'"><input type="submit" value="Vào ải tiếp theo"></a></div>';
}
echo '<div class="gmenu">Click vào hình để đánh</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">'.$post['name'].' đã kiệt sức hãy quay lại sau</div>';
	} else if ($datauser['hpfull'] < 1000 || $datauser['sucmanh'] < 1000) 
	{
		echo '<div class="rmenu">Bạn quá yếu. Hãy luyện đồ để đủ 1,000 HP và 1,000 SM</div>';
	} else if ($datauser['hp'] <=0)
	{
		echo '<div class="rmenu">Bạn đã kiệt sức... Hãy đến gặp bác sĩ!</div>';
	}
	else if ($datauser['lastpost'] > time())
	{
		echo '<div class="rmenu">Đang hồi skill vui lòng đợi <b>'.($datauser['lastpost'] - time()).'</b>s nữa</div>';
	}
	else
	{
		$sd1=rand($post['sucmanh']/100*10, $post['sucmanh']);
		$sd2=rand($datauser['sucmanh']/100*10,($datauser['sucmanh'] + ($datauser['hpfull']*10/100)));
		$nhan = rand(1,5);
		$mayman = rand(1,10);
		
		$tien = ceil(($sd2 * $nhan) / 10);
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_boss` SET `hp` = `hp` - '".$sd1."' WHERE `id` = '".$act."'");
		echo '<div class="rmenu">Bạn đánh '.$post['name'].' mất <b>'.$sd2.' HP</b>, '.$post['name'].' phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		$checkboss = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$act."'"));
		if ($checkboss['hp'] <= 0) {
			mysql_query("UPDATE `naruto_boss` SET `user_id` = '".$user_id."' WHERE `id` = '".$post['id']."'");
			mysql_query("UPDATE `users` SET `vnd` = `vnd` + '5' WHERE `id` = '".$user_id."'");
			echo '<div class="rmenu">Bạn đã tiêu diệt '.$post['name'].' và nhận được 5 lượng</div>';
		}
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://8vui.top/images/vatpham/48.png"> Bạn nhận được 1 kunai</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 400px;">';

echo '<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act='.$act.'&danh"><img height="250" src="img/'.$act.'.png"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>';

echo '</div>';
break;
case '9':
$act = intval($act);
$post = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '9'"));
$prev = $act - 1;
$fuckyou = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$prev."'"));
if ($fuckyou['hp'] > 0) {
	echo '<div class="phdr">Hãy quay lại</div>';
	echo '<div class="list1">Hãy tiêu diệt <a href="?act='.$fuckyou['id'].'"><b>'.$fuckyou['name'].'</b></a> trước đã. Ngươi mới có cơ để chơi ta!</div>';
	require_once('../../incfiles/end.php');
	exit;
}
echo '<div class="phdr">Đấu với '.$post['name'].'</div>';
if ($post['hp'] <= 0) {
echo '<div class="rmenu"><b>'.$post['name'].'</b> đã bị tiêu diệt bởi <b>'.nick($post['user_id']).'</b> <a href="?act='.($act+1).'"><input type="submit" value="Vào ải tiếp theo"></a></div>';
}
echo '<div class="gmenu">Click vào hình để đánh</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">'.$post['name'].' đã kiệt sức hãy quay lại sau</div>';
	} else if ($datauser['hpfull'] < 1000 || $datauser['sucmanh'] < 1000) 
	{
		echo '<div class="rmenu">Bạn quá yếu. Hãy luyện đồ để đủ 1,000 HP và 1,000 SM</div>';
	} else if ($datauser['hp'] <=0)
	{
		echo '<div class="rmenu">Bạn đã kiệt sức... Hãy đến gặp bác sĩ!</div>';
	}
	else if ($datauser['lastpost'] > time())
	{
		echo '<div class="rmenu">Đang hồi skill vui lòng đợi <b>'.($datauser['lastpost'] - time()).'</b>s nữa</div>';
	}
	else
	{
		$sd1=rand($post['sucmanh']/100*10, $post['sucmanh']);
		$sd2=rand($datauser['sucmanh']/100*10,($datauser['sucmanh'] + ($datauser['hpfull']*10/100)));
		$nhan = rand(1,5);
		$mayman = rand(1,10);
		
		$tien = ceil(($sd2 * $nhan) / 10);
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_boss` SET `hp` = `hp` - '".$sd1."' WHERE `id` = '".$act."'");
		echo '<div class="rmenu">Bạn đánh '.$post['name'].' mất <b>'.$sd2.' HP</b>, '.$post['name'].' phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		$checkboss = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$act."'"));
		if ($checkboss['hp'] <= 0) {
			mysql_query("UPDATE `naruto_boss` SET `user_id` = '".$user_id."' WHERE `id` = '".$post['id']."'");
			mysql_query("UPDATE `users` SET `vnd` = `vnd` + '5' WHERE `id` = '".$user_id."'");
			echo '<div class="rmenu">Bạn đã tiêu diệt '.$post['name'].' và nhận được 5 lượng</div>';
		}
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://8vui.top/images/vatpham/48.png"> Bạn nhận được 1 kunai</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 400px;">';

echo '<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act='.$act.'&danh"><img height="250" src="img/'.$act.'.png" class="xavt"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>';

echo '</div>';
break;
case '10':
$act = intval($act);
$post = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '10'"));
$prev = $act - 1;
$fuckyou = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$prev."'"));
if ($fuckyou['hp'] > 0) {
	echo '<div class="phdr">Hãy quay lại</div>';
	echo '<div class="list1">Đệ của ta còn chưa giết được đòi chịch ta hả. Quên đi!</div>';
	require_once('../../incfiles/end.php');
	exit;
}
echo '<div class="phdr">Đấu với '.$post['name'].'</div>';
if ($post['hp'] <= 0) {
echo '<div class="rmenu"><b>'.$post['name'].'</b> đã bị tiêu diệt bởi <b>'.nick($post['user_id']).'</b> Hãy chúc mừng vị anh hùng này...</div>';
}
echo '<div class="gmenu">Click vào hình để đánh</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">'.$post['name'].' đã kiệt sức hãy quay lại sau</div>';
	} else if ($datauser['hpfull'] < 1000 || $datauser['sucmanh'] < 1000) 
	{
		echo '<div class="rmenu">Bạn quá yếu. Hãy luyện đồ để đủ 1,000 HP và 1,000 SM</div>';
	} else if ($datauser['hp'] <=0)
	{
		echo '<div class="rmenu">Bạn đã kiệt sức... Hãy đến gặp bác sĩ!</div>';
	}
	else if ($datauser['lastpost'] > time())
	{
		echo '<div class="rmenu">Đang hồi skill vui lòng đợi <b>'.($datauser['lastpost'] - time()).'</b>s nữa</div>';
	}
	else
	{
		$sd1=rand($post['sucmanh']/100*10, $post['sucmanh']);
		$sd2=rand($datauser['sucmanh']/100*10,($datauser['sucmanh'] + ($datauser['hpfull']*10/100)));
		$nhan = rand(1,5);
		$mayman = rand(1,10);
		
		$tien = ($sd2 * ($nhan + 10));
		$randluong = rand(1,10);
		$lucky = rand(1,50);
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `naruto_boss` SET `hp` = `hp` - '".$sd1."' WHERE `id` = '".$act."'");
		echo '<div class="rmenu">Bạn đánh '.$post['name'].' mất <b>'.$sd2.' HP</b>, '.$post['name'].' phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		$checkboss = mysql_fetch_array(mysql_query("SELECT * FROM `naruto_boss` WHERE `id` = '".$act."'"));
		if ($checkboss['hp'] <= 0) {
			mysql_query("UPDATE `naruto_boss` SET `user_id` = '".$user_id."' WHERE `id` = '".$post['id']."'");
			mysql_query("INSERT INTO `khodo` SET `id_shop` = '959' WHERE `user_id` = '".$user_id."', `loai` = 'thucung', `id_loai` ='63', `tenvatpham` ='Tuần lộc'");
			echo '<div class="rmenu"><img src="http://i.imgur.com/O3U3s1X.gif"> Bạn đã tiêu diệt '.$post['name'].' và nhận được PET <b>Tuần lộc</b> vĩnh viễn</div>';
		}
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '48' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://8vui.top/images/vatpham/48.png"> Bạn nhận được 1 kunai</div>';
		}
		if ($lucky == 1) {
			mysql_query("UPDATE `users` SET `vnd` = `vnd` + '".$randluong."' WHERE `id` = '".$user_id."'");
			echo '<div class="rmenu">Bạn nhận được '.$randluong.' lượng</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 400px;">';

echo '<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act='.$act.'&danh"><img height="250" src="img/'.$act.'.png" class="xavt"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>';

echo '</div>';
break;
default:
echo '<div class="phdr">'.$textl.' [<a href="/index.php">Quay lại</a>]</div>';
echo '<div class="danhsach phancach">
-<font color="red">Nơi đây hội tụ những BOSS KHỦNG</font>
<br>-Có tổng cộng 9 boss cần vượt qua để có thể gặp được boss cuối
<br>-Người tiêu diệt boss thường sẽ nhận được 5 lượng
<br>-Đánh với Boss cuối có thể nhận được nhiều phần quà ngẫu nhiên, xu nhiều hơn có thể nhận được lượng
<br>-Người tiêu diệt được Boss cuối sẽ nhận được pet <b>Tuần lộc</b> <img src="http://i.imgur.com/O3U3s1X.gif"> vĩnh viễn
<br>-<b>Hãy cùng nhau</b> tiêu diệt những con Boss nào!<br/><center><a href="?act=1"><input type="submit" value="Tiến vào ải"></a></center></div>';
break;
}
require_once('../../incfiles/end.php');
?>