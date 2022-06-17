<?php
define('_IN_JOHNCMS', 1);
require_once('../../incfiles/core.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
$textl = 'BOSS';
require_once('../../incfiles/head.php');
$sql = mysql_query("SELECT * FROM `sieuanhhung`");
while ($hp = mysql_fetch_array($sql)) {
if ($hp['hp'] <= 0 && $hp['timehoiphuc'] < time())
{
mysql_query("UPDATE `sieuanhhung` SET `hp` = `hpfull`, `timehoiphuc` = '".(time() + 10800)."' WHERE `id` = '".$hp['id']."'");
}
}
switch ($act) {
case 'thor':
$post = mysql_fetch_array(mysql_query("SELECT * FROM `sieuanhhung` WHERE `name` = 'thor'"));
echo '<div class="phdr">Đấu với Dark Dragon [<a href="sieuanhhung.php">Quay lại</a>]</div>';
echo '<div class="gmenu"> -Tên thor tuy sức tấn công mạnh nhưng phòng thủ yếu nên bạn cần lên nhiều trang bị có lượng HP cao<br/> -Sát thương bạn gây ra càng lớn càng nhận được nhiều phần quà hấp dẫn<br/>-Click vào hình đế đánh hắn</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">Siêu anh hùng đã kiệt sức hãy quay lại sau</div>';
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
		$mayman = rand(1,5);
		
		if ($user_id == 391) $mayman = rand(1,2);
		$tien = $sd2 * $nhan;
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `sieuanhhung` SET `hp` = `hp` - '".$sd1."' WHERE `name` = 'thor'");
		echo '<div class="rmenu">Bạn đánh Dark dragon mất <b>'.$sd2.' HP</b>, Dark dragon phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '46' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://i.imgur.com/vCGprNG.png"> Bạn nhận được 1 kem ly</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 300px;">

<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act=thor&danh"><img src="http://orig11.deviantart.net/9aba/f/2015/021/1/3/monster_hunter___gore_magala_by_zedotagger-d8ew38a.gif" class="xavt"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>
</div>';
break;
case 'hulk':
$post = mysql_fetch_array(mysql_query("SELECT * FROM `sieuanhhung` WHERE `name` = 'hulk'"));
echo '<div class="phdr">Đấu với Tank Dragon [<a href="sieuanhhung.php">Quay lại</a>]</div>';
echo '<div class="gmenu"> -Hãy lên nhiều trang bị có khả năng tấn công cao<br/> -Sát thương bạn gây ra càng lớn càng nhận được nhiều phần quà hấp dẫn<br/>-Click vào hình đế đánh hắn</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">Siêu anh hùng đã kiệt sức hãy quay lại sau</div>';
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
		$nhan = rand(1,3);
		$mayman = rand(1,5);
		
		if ($user_id == 391) $mayman = rand(1,2);
		$tien = $sd2 * $nhan;
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `sieuanhhung` SET `hp` = `hp` - '".$sd1."' WHERE `name` = 'hulk'");
		echo '<div class="rmenu">Bạn đánh Tank Dragon mất <b>'.$sd2.' HP</b>, Tank dragon phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '46' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://i.imgur.com/vCGprNG.png"> Bạn nhận được 1 Kem ly</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 300px;">

<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act=hulk&danh"><img src="http://orig06.deviantart.net/6801/f/2015/031/8/d/monster_hunter___zinogre_by_zedotagger-d8g4usb.gif" class="xavt"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>
</div>';
break;
case 'ironman':
$post = mysql_fetch_array(mysql_query("SELECT * FROM `sieuanhhung` WHERE `name` = 'ironman'"));
echo '<div class="phdr">Đấu với Hunter dragon</div>';
echo '<div class="gmenu"> -Hắn khá nguy hiểm nên bạn cần phải chuẩn bị thật kĩ trước khi đánh nhau vơi hắn<br/> -Sát thương bạn gây ra càng lớn càng nhận được nhiều phần quà hấp dẫn<br/>-Click vào hình đế đánh hắn</div>';
if (isset($_GET['danh'])) {
	if ($post['hp'] <=0) {
		echo '<div class="rmenu">Siêu anh hùng đã kiệt sức hãy quay lại sau</div>';
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
		$mayman = rand(1,5);
		
		if ($user_id == 391) $mayman = rand(1,2);
		$tien = $sd2 * $nhan;
		mysql_query("UPDATE `users` SET `lastpost` = '".(time() + 3)."', `xu`= `xu` + '".$tien."', `hp` = `hp` - '".$sd1."' WHERE `id` = '".$user_id."'");
		mysql_query("UPDATE `sieuanhhung` SET `hp` = `hp` - '".$sd1."' WHERE `name` = 'ironman'");
		echo '<div class="rmenu">Bạn đánh Hunter dragon mất <b>'.$sd2.' HP</b>, Hunter dragon phản công khiến bạn mất <b>'.$sd1.' HP</b>, bạn nhận được <b>'.$tien.' xu</b></div>';
		if ($mayman == 1) {
			mysql_query("UPDATE `vatpham` SET `soluong` = `soluong` + '1' WHERE `id_shop` = '46' AND `user_id` = '".$user_id."'");
			echo '<div class="rmenu"><img src="http://i.imgur.com/vCGprNG.png"> Bạn nhận được 1 kemly</div>';
		}
	}
}
echo '<div class="menu" style="position: relative; min-height: 300px;">

<div style="position: absolute; left: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$post['hp'].' / '.$post['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$post['sucmanh'].'</font></center><br/><a href="?act=ironman&danh"><img src="http://40.media.tumblr.com/aa63d522ceddaa1e5d9d0716a9b06adb/tumblr_nt6dyplA8d1r9y1sco4_1280.png" class="xavt" width="300px"></a></center></label></div>

<div style="position: absolute; right: 10px; top: 10px;"><label><center><font color="red" size="1"><b>HP:</b> '.$datauser['hp'].' / '.$datauser['hpfull'].'</font><br/><font color="blue" size="1"><b>SM:</b> '.$datauser['sucmanh'].'</font></center><br/><img src="/avatar/'.$user_id.'.png" style="margin-left:10px;" class="xavt"></center></label></div>
</div>';
break;
default:
echo '<div class="phdr">'.$textl.' [<a href="/index.php">Quay lại</a>]</div>';
echo '<div class="lucifer">
-<font color="red">Nơi đây hội tụ những BOSS KHỦNG</font>
<br>-Đánh cái siêu anh hùng sẽ nhận được nhiều <b>phần quà giá trị</b>
<br>-Tuy vậy nhưng sẽ gặp rất <b>nhiều khó khăn</b>
<br>-<b>Click</b> vào nhân vật bạn muốn đánh?</div>';
echo '<div class="rmenu"><center><img src="/avatar/'.$user_id.'.png" style="margin-right: 25px;"> <img src="/icon/iconxoan/iconpk.png" style="margin-bottom:20px;"> <a href="?act=thor"><img src="http://orig11.deviantart.net/9aba/f/2015/021/1/3/monster_hunter___gore_magala_by_zedotagger-d8ew38a.gif" style="margin-left: 25px;"></a> <a href="?act=hulk"><img src="http://orig06.deviantart.net/6801/f/2015/031/8/d/monster_hunter___zinogre_by_zedotagger-d8g4usb.gif"></a> <a href="?act=ironman"><img src="http://40.media.tumblr.com/aa63d522ceddaa1e5d9d0716a9b06adb/tumblr_nt6dyplA8d1r9y1sco4_1280.png" width="300px"></center></div>';
break;
}
echo'<div><div>';
require_once('../../incfiles/end.php');
?>