<?php
define('_IN_JOHNCMS',1);
$noionline = 'Ranking';
require '../incfiles/core.php';
if(!$user_id){
Header("Location: $home");
exit;
}
$textl = 'Trận xếp hạng';
require '../incfiles/head.php';
$id = intval($_GET['id']);
$check = mysql_query("SELECT * FROM `ranking` WHERE `id` = $id");
$get = mysql_fetch_array($check);
if(!mysql_num_rows($check)){
echo '<div class="phdr">Trận xếp hạng</div><div class="list1"><center>Phòng không tồn tại hoặc vừa kết thúc!</center></div>';
} else {
if($user_id != $get[user_id]){
echo '<div class="phdr">Khán giả!</div>';
}
$tim = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$get['user_id']."'"));
$vs = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$get['user_vs']."'"));
$p = $tim['point'];
if($p <=500){
if($p <=100)
$n_rank = 'Đồng đoàn V';
if($p <=200 AND $p >100)
$n_rank = 'Đồng đoàn IV';
if($p <=300 AND $p >200)
$n_rank = 'Đồng đoàn III';
if($p <=400 AND $p > 300)
$n_rank = 'Đồng đoàn II';
if($p <=500 AND $p >400)
$n_rank = 'Đồng đoàn I';
}
if($p > 500 AND $p <=1000){
if($p <=600 AND $p >500)
$n_rank = 'Bạc đoàn V';
if($p <=700 AND $p >600)
$n_rank = 'Bạc đoàn IV';
if($p <=800 AND $p >700)
$n_rank = 'Bạc đoàn III';
if($p <=900 AND $p > 800)
$n_rank = 'Bạc đoàn II';
if($p <=1000 AND $p >900)
$n_rank = 'Bạc đoàn I';
}
if($p > 1000 AND $p <=1500){
if($p <=1100 AND $p >1000)
$n_rank = 'Vàng đoàn V';
if($p <=1200 AND $p >1100)
$n_rank = 'Vàng đoàn IV';
if($p <=1300 AND $p >1200)
$n_rank = 'Vàng đoàn III';
if($p <=1400 AND $p > 1300)
$n_rank = 'Vàng đoàn II';
if($p <=1500 AND $p >1400)
$n_rank = 'Vàng đoàn I';
}
if($p > 1500 AND $p <=2000){
if($p <=1600 AND $p >1500)
$n_rank = 'Bạch kim đoàn V';
if($p <=1700 AND $p >1600)
$n_rank = 'Bạch kim đoàn IV';
if($p <=1800 AND $p >1700)
$n_rank = 'Bạch kim đoàn III';
if($p <=1900 AND $p > 1800)
$n_rank = 'Bạch kim đoàn II';
if($p <=2000 AND $p >1900)
$n_rank = 'Bạch kim đoàn I';
}
if($p > 2000 AND $p <=2500){
if($p <=2100 AND $p >2000)
$n_rank = 'Kim cương đoàn V';
if($p <=2200 AND $p >2100)
$n_rank = 'Kim cương đoàn IV';
if($p <=2300 AND $p >2200)
$n_rank = 'Kim cương đoàn III';
if($p <=2400 AND $p > 2300)
$n_rank = 'Kim cương đoàn II';
if($p <=2500 AND $p >2400)
$n_rank = 'Kim cương đoàn I';
}
if($p >2500){
$n_rank = 'Thách đấu <font color=red>(MAX)</font>';
}
echo '<div class="list1"><center><big>'.nick($get['user_id']).' - '.nick($get[user_vs]).'</big><br>Kết thúc sau: <b>'.($get['time']+720 - time()).'</b> giây <div class="menu_hero">';
if(isset($_POST['submit']) AND $tim['id'] == $user_id){
$cm1 = rand(1,100);
$cm2 = rand(1,100);
$mn1 = rand(1,100);
$mn2 = rand(1,100);
$sm1 = $tim['sucmanh'];
$sm2 = $vs['sucmanh'];
$ct1 = $sm1*$tim['n_hutmau']/100;
$ct2 = $sm2*$vs['n_hutmau']/100;
$sm1 = $sm1+$ct1-$ct2;
$sm2 = $sm2+$ct2-$ct1;
$p2 = $sm1*$vs['n_phan']/100;
$p1 = $sm2*$tim['n_phan']/100;
$sm1 = $sm1+$p1;
$sm2 = $sm2+$p2;
if($cm1 <= $tim['n_chimang']){
$ocm1 = 1;
$sm1 = $sm1*3.5;
} 
if($cm2 <= $vs['n_chimang']){
$ocm2 = 1;
$sm2 = $sm2*3.5;
}
if($mn1 <= $tim['n_xxx'])
$omn1 = 1;
if($mn2 <= $vs['n_xxx'])
$omn2 = 1;
$sm1 = ($sm1 <=0 ? 1 : $sm1);
$sm2 = ($sm2 <=0 ? 1 : $sm2);
$sm1 = round($sm1,0);
$sm2 = round($sm2,0);

////Hiển thị u1

if($omn1){
echo '<div class="list1"><font color="gold">NGỌC VÀNG</font> ĐÃ MIỄN NHIỄM SÁT THƯƠNG CHO BẠN</div>';
} else {
@mysql_query("UPDATE `users` SET `hp` = `hp` -$sm2 WHERE `id` = '".$tim['id']."'");
$ss1 .= '<div class="list1">'.nick($vs[user_id]).' đã đánh '.($ocm2 ? '<font color=blue>chí mạng</font> ' : '').'bạn'.($p2 ? ', <font color=purple>ngọc tím</font> <b><font color=red>-'.$p2.' HP</font></b>' : '').''.($ct2 ? ', <font color="orange">Ngọc đồng</font> <b style="color:red">-'.$ct2.'</b> HP' : '').''.($ct1 ? ', <font color="orange">Ngọc đồng</font> <b style="color:green">+'.$ct1.' HP</b>' : '').', tổng cộng mất <b><font color=red>'.$sm2.' HP</font></b></div>';
}


////Hiển thị u2

if($omn2){
echo '<div class="list1"><font color="gold">NGỌC VÀNG</font> ĐÃ MIỄN NHIỄM SÁT THƯƠNG CHO '.nick($vs['user_id']).'</div>';
} else {
@mysql_query("UPDATE `users` SET `hp` = `hp` -$sm1 WHERE `id` = '".$vs['id']."'");
$ss1 .= '<div class="list1">Bạn đã đánh '.($ocm1 ? '<font color=blue>chí mạng</font> ' : '').''.nick($vs['user_id']).''.($p1 ? ', <font color=purple>ngọc tím</font> <b><font color=red>-'.$p1.' HP</font></b>' : '').''.($ct1 ? ', <font color="orange">Ngọc đồng</font> <b style="color:red">-'.$ct1.' HP</b>' : '').''.($ct2 ? ', <font color="orange">Ngọc đồng</font> <b style="color:green">+'.$ct2.' HP</b>' : '').', tổng cộng mất <b><font color=red>'.$sm1.' HP</font></b></div>';
}
$tim = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$get['user_id']."'"));
$vs = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$get['user_vs']."'"));
if($tim['hp'] <= 0 OR $vs['hp'] <=0){
@mysql_query("UPDATE `users` SET `rank` = 1 WHERE `id` = '".$tim['id']."'");
@mysql_query("UPDATE `users` SET `rank` = 1 WHERE `id` = '".$vs['id']."'");

if($tim['hp'] < $vs['hp']){

@mysql_query("UPDATE `users` SET `hp` = '".$vs['hpfull']."' WHERE `id` = '".$vs['id']."'");

$point = 10+$vs['point']+$vs['thang']-$vs['thua'];
$points = 10+$vs['thang']-$vs['thua'];
if($points <0)
$point = 0;
if(!$point >0)
$point = 1;
@mysql_query("UPDATE `users` SET `point` = '".$point."', `thang` = `thang`+1, `chuoi` = `chuoi`+1 WHERE `id` = '".$vs['id']."'");
$point2 = $tim['point']-10-$tim['thua'];
$point2s = $tim['thua']-10;
$tu = mysql_fetch_array(mysql_query("SELECT `name` FROM `users` WHERE `id` = '".$tim[id]."'"),0);
$vu = mysql_fetch_array(mysql_query("SELECT `name` FROM `users` WHERE `id` = '".$vs[id]."'"),0);
if($tim['chuoi'] >=4){
$chuoisd = 'SHUTDOWN';
$bot = '[blue]'.$vu['name'].'[/blue] ĐÃ [red]SHUTDOWN[/red] CHUỖI CHIẾN CÔNG CỦA [blue]'.$tu['name'].'[/blue] TẠI ĐẤU XẾP HẠNG';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
}
@mysql_query("UPDATE `users` SET `point` = '".$point2."', `thua` = `thua`+1, `chuoi` = '' WHERE `id` = '".$tim['id']."'");
$tim = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$get['user_id']."'"));
$vs = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$get['user_vs']."'"));
$p = $tim['point'];
if($p <=500){
$rank = 'cu';
if($p <=100)
$n_rank = 'Đồng đoàn V';
if($p <=200 AND $p >100)
$n_rank = 'Đồng đoàn IV';
if($p <=300 AND $p >200)
$n_rank = 'Đồng đoàn III';
if($p <=400 AND $p > 300)
$n_rank = 'Đồng đoàn II';
if($p <=500 AND $p >400)
$n_rank = 'Đồng đoàn I';
}
if($p > 500 AND $p <=1000){
$rank = 'ag';
if($p <=600 AND $p >500)
$n_rank = 'Bạc đoàn V';
if($p <=700 AND $p >600)
$n_rank = 'Bạc đoàn IV';
if($p <=800 AND $p >700)
$n_rank = 'Bạc đoàn III';
if($p <=900 AND $p > 800)
$n_rank = 'Bạc đoàn II';
if($p <=1000 AND $p >900)
$n_rank = 'Bạc đoàn I';
}
if($p > 1000 AND $p <=1500){
$rank = 'au';
if($p <=1100 AND $p >1000)
$n_rank = 'Vàng đoàn V';
if($p <=1200 AND $p >1100)
$n_rank = 'Vàng đoàn IV';
if($p <=1300 AND $p >1200)
$n_rank = 'Vàng đoàn III';
if($p <=1400 AND $p > 1300)
$n_rank = 'Vàng đoàn II';
if($p <=1500 AND $p >1400)
$n_rank = 'Vàng đoàn I';
}
if($p > 1500 AND $p <=2000){
$rank = 'platium';
if($p <=1600 AND $p >1500)
$n_rank = 'Bạch kim đoàn V';
if($p <=1700 AND $p >1600)
$n_rank = 'Bạch kim đoàn IV';
if($p <=1800 AND $p >1700)
$n_rank = 'Bạch kim đoàn III';
if($p <=1900 AND $p > 1800)
$n_rank = 'Bạch kim đoàn II';
if($p <=2000 AND $p >1900)
$n_rank = 'Bạch kim đoàn I';
}
if($p > 2000 AND $p <=2500){
$rank = 'dinamon';
if($p <=2100 AND $p >2000)
$n_rank = 'Kim cương đoàn V';
if($p <=2200 AND $p >2100)
$n_rank = 'Kim cương đoàn IV';
if($p <=2300 AND $p >2200)
$n_rank = 'Kim cương đoàn III';
if($p <=2400 AND $p > 2300)
$n_rank = 'Kim cương đoàn II';
if($p <=2500 AND $p >2400)
$n_rank = 'Kim cương đoàn I';
}
if($p >2500){
$rank = 'thachdau';
$n_rank = 'Thách đấu <font color=red>(MAX)</font>';
}

if($vs['chuoi'] ==1)
$chuoi = 'FIRST BLOOD';
if($vs['chuoi'] ==2)
$chuoi = 'DOUBLE KILL';
if($vs['chuoi'] ==3)
$chuoi = 'TRIPLE KILL';
if($vs['chuoi'] ==4)
$chuoi = 'QUARDA KILL';
if($vs['chuoi'] ==5)
$chuoi = 'PENTAKILL';
if($vs['chuoi'] ==6)
$chuoi = 'DONT STOPABLE';
if($vs['chuoi'] ==7)
$chuoi = 'GODLIKE';
if($vs['chuoi'] >=8)
$chuoi = 'LEGENDARY';

if($vs['chuoi'] >=4){
$bot = '[blue]'.$vu['name'].'[/blue] ĐÃ [red]ĐÁNH BẠI[/red] [blue]'.$tu['name'].'[/blue] ĐƯỢC [green]'.$chuoi.'[/green] TẠI ĐẤU XẾP HẠNG';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
}
$content = 'Bạn đã đánh thắng <a href="/member/'.$tim['id'].'.html">'.$tu['name'].'</a> tại rank';
@mysql_query("INSERT INTO `thongbao` SET `time` = '".time()."', `text` = '".$content."', `user` = '".$vs['id']."'");
$s1 = '<div class="list1"><table><tbody><tr><td><img src="/ranking/defeat.png"></td><td><table><tbody><tr><td><img src="/ranking/'.$rank.'.png" style="width:85px;"></td><td><b>'.$n_rank.'</b><br>
Point: <b>'.$tim['point'].'</b> <font color="red">(-'.$point2s.')</font><br>Thua: <b>'.$tim['thua'].'</b> <font color="red">(+1)</font><br>Chuỗi:<b>0</b></td></tr></tbody></table>'.($chuoisd ? '<big><font color="red">'.$chuoisd.'</font></big><br>' : '').'<a href="index.php?act=join"><button>Trận khác</button></a> <a href="index.php"><button>Thông tin xếp hạng</button></a></td></tr></tbody></table></div>';
@mysql_query("DELETE FROM `ranking` WHERE `id` = $id");
}

if($tim['hp'] >= $vs['hp']){

@mysql_query("UPDATE `users` SET `hp` = '".$tim['hpfull']."' WHERE `id` = '".$tim['id']."'");

$point = 10+$tim['point']+$tim['thang']-$tim['thua'];
$points = 10+$tim['thang']-$tim['thua'];
if($points <0)
$point = 0;
if(!$point >0)
$point = 1;
@mysql_query("UPDATE `users` SET `point` = '".$point."', `thang` = `thang`+1, `chuoi` = `chuoi`+1 WHERE `id` = '".$tim['id']."'");
$point2 = $vs['point']-10-$vs['thua'];
$tu = mysql_fetch_array(mysql_query("SELECT `name` FROM `users` WHERE `id` = '".$tim[id]."'"),0);
$vu = mysql_fetch_array(mysql_query("SELECT `name` FROM `users` WHERE `id` = '".$vs[id]."'"),0);
if($vs['chuoi'] >=4){
$bot = '[blue]'.$tu['name'].'[/blue] ĐÃ [red]SHUTDOWN[/red] CHUỖI CHIẾN CÔNG CỦA [blue]'.$vu['name'].'[/blue] TẠI ĐẤU XẾP HẠNG';
$time = time() + 18;
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
}
@mysql_query("UPDATE `users` SET `point` = '".$point2."', `thua` = `thua`+1, `chuoi` = '' WHERE `id` = '".$vs['id']."'");
$tim = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$get['user_id']."'"));
$vs = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `user_id` = '".$get['user_vs']."'"));
$p = $tim['point'];
if($p <=500){
$rank = 'cu';
if($p <=100)
$n_rank = 'Đồng đoàn V';
if($p <=200 AND $p >100)
$n_rank = 'Đồng đoàn IV';
if($p <=300 AND $p >200)
$n_rank = 'Đồng đoàn III';
if($p <=400 AND $p > 300)
$n_rank = 'Đồng đoàn II';
if($p <=500 AND $p >400)
$n_rank = 'Đồng đoàn I';
}
if($p > 500 AND $p <=1000){
$rank = 'ag';
if($p <=600 AND $p >500)
$n_rank = 'Bạc đoàn V';
if($p <=700 AND $p >600)
$n_rank = 'Bạc đoàn IV';
if($p <=800 AND $p >700)
$n_rank = 'Bạc đoàn III';
if($p <=900 AND $p > 800)
$n_rank = 'Bạc đoàn II';
if($p <=1000 AND $p >900)
$n_rank = 'Bạc đoàn I';
}
if($p > 1000 AND $p <=1500){
$rank = 'au';
if($p <=1100 AND $p >1000)
$n_rank = 'Vàng đoàn V';
if($p <=1200 AND $p >1100)
$n_rank = 'Vàng đoàn IV';
if($p <=1300 AND $p >1200)
$n_rank = 'Vàng đoàn III';
if($p <=1400 AND $p > 1300)
$n_rank = 'Vàng đoàn II';
if($p <=1500 AND $p >1400)
$n_rank = 'Vàng đoàn I';
}
if($p > 1500 AND $p <=2000){
$rank = 'platium';
if($p <=1600 AND $p >1500)
$n_rank = 'Bạch kim đoàn V';
if($p <=1700 AND $p >1600)
$n_rank = 'Bạch kim đoàn IV';
if($p <=1800 AND $p >1700)
$n_rank = 'Bạch kim đoàn III';
if($p <=1900 AND $p > 1800)
$n_rank = 'Bạch kim đoàn II';
if($p <=2000 AND $p >1900)
$n_rank = 'Bạch kim đoàn I';
}
if($p > 2000 AND $p <=2500){
$rank = 'dinamon';
if($p <=2100 AND $p >2000)
$n_rank = 'Kim cương đoàn V';
if($p <=2200 AND $p >2100)
$n_rank = 'Kim cương đoàn IV';
if($p <=2300 AND $p >2200)
$n_rank = 'Kim cương đoàn III';
if($p <=2400 AND $p > 2300)
$n_rank = 'Kim cương đoàn II';
if($p <=2500 AND $p >2400)
$n_rank = 'Kim cương đoàn I';
}
if($p >2500){
$rank = 'thachdau';
$n_rank = 'Thách đấu <font color=red>(MAX)</font>';
}

if($tim['chuoi'] ==1)
$chuoi = 'FIRST BLOOD';
if($tim['chuoi'] ==2)
$chuoi = 'DOUBLE KILL';
if($tim['chuoi'] ==3)
$chuoi = 'TRIPLE KILL';
if($tim['chuoi'] ==4)
$chuoi = 'QUARDA KILL';
if($tim['chuoi'] ==5)
$chuoi = 'PENTAKILL';
if($tim['chuoi'] ==6)
$chuoi = 'DONT STOPABLE';
if($tim['chuoi'] ==7)
$chuoi = 'GODLIKE';
if($tim['chuoi'] >=8)
$chuoi = 'LEGENDARY';

if($tim['chuoi'] >=4){
$bot = '[blue]'.$tu['name'].'[/blue] ĐÃ [red]ĐÁNH BẠI[/red] [blue]'.$vu['name'].'[/blue] ĐƯỢC [green]'.$chuoi.'[/green] TẠI ĐẤU XẾP HẠNG';
$time = time() + 18;
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
}

$content = 'Bạn đã thất bại trong trận đánh với <a href="/member/'.$tim['id'].'.html">'.$tu['name'].'</a> tại rank';
@mysql_query("INSERT INTO `thongbao` SET `time` = '".time()."', `text` = '".$content."', `user` = '".$vs['id']."'");
$s1 = '<div class="list1"><table><tbody><tr><td><img src="/ranking/victory.png"></td><td><table><tbody><tr><td><img src="/ranking/'.$rank.'.png" style="width:85px;"></td><td><b>'.$n_rank.'</b><br>
Point: <b>'.$tim['point'].'</b> <font color="green">(+'.$points.')</font><br>Thắng: <b>'.$tim['thang'].'</b> <font color="green">(+1)</font><br>Chuỗi: <b>'.$tim['chuoi'].'</b> <font color="green">(+1)</font></td></tr></tbody></table>'.($chuoi ? '<big><font color="blue">'.$chuoi.'</font></big><br>' : '').'<a href="index.php?act=join"><button>Trận khác</button></a> <a href="index.php"><button>Thông tin xếp hạng</button></a></td></tr></tbody></table></div>';
@mysql_query("DELETE FROM `ranking` WHERE `id` = $id");
}
}
echo (!$s1 ? $ss1 : $s1);
if($s1){
echo '</div></div>';
require '../incfiles/end.php';
exit;
}
}

echo '<table><tbody><tr><td><table><tbody><tr><td><font color=green>SM: '.$tim['sucmanh'].'</font><br>
<b><font color="red">HP: '.$tim['hp'].'</b><br>
HP FULL: '.$tim['hpfull'].'</font><br><small><b>'.$n_rank.'</b></small></td><td><img style="width: 70px;" src="/avatar/'.$tim[id].'.png"></td></tr></tbody></table></td><td>'.(($user_id != $tim['id']) ? '<font size="200%">VS</font>' : '<form method="post"><input type="submit" name="submit" value="PEM"></form>').'</td>';
$p = $vs['point'];
if($p <=500){
if($p <=100)
$n_rank = 'Đồng đoàn V';
if($p <=200 AND $p >100)
$n_rank = 'Đồng đoàn IV';
if($p <=300 AND $p >200)
$n_rank = 'Đồng đoàn III';
if($p <=400 AND $p > 300)
$n_rank = 'Đồng đoàn II';
if($p <=500 AND $p >400)
$n_rank = 'Đồng đoàn I';
}
if($p > 500 AND $p <=1000){
if($p <=600 AND $p >500)
$n_rank = 'Bạc đoàn V';
if($p <=700 AND $p >600)
$n_rank = 'Bạc đoàn IV';
if($p <=800 AND $p >700)
$n_rank = 'Bạc đoàn III';
if($p <=900 AND $p > 800)
$n_rank = 'Bạc đoàn II';
if($p <=1000 AND $p >900)
$n_rank = 'Bạc đoàn I';
}
if($p > 1000 AND $p <=1500){
if($p <=1100 AND $p >1000)
$n_rank = 'Vàng đoàn V';
if($p <=1200 AND $p >1100)
$n_rank = 'Vàng đoàn IV';
if($p <=1300 AND $p >1200)
$n_rank = 'Vàng đoàn III';
if($p <=1400 AND $p > 1300)
$n_rank = 'Vàng đoàn II';
if($p <=1500 AND $p >1400)
$n_rank = 'Vàng đoàn I';
}
if($p > 1500 AND $p <=2000){
if($p <=1600 AND $p >1500)
$n_rank = 'Bạch kim đoàn V';
if($p <=1700 AND $p >1600)
$n_rank = 'Bạch kim đoàn IV';
if($p <=1800 AND $p >1700)
$n_rank = 'Bạch kim đoàn III';
if($p <=1900 AND $p > 1800)
$n_rank = 'Bạch kim đoàn II';
if($p <=2000 AND $p >1900)
$n_rank = 'Bạch kim đoàn I';
}
if($p > 2000 AND $p <=2500){
if($p <=2100 AND $p >2000)
$n_rank = 'Kim cương đoàn V';
if($p <=2200 AND $p >2100)
$n_rank = 'Kim cương đoàn IV';
if($p <=2300 AND $p >2200)
$n_rank = 'Kim cương đoàn III';
if($p <=2400 AND $p > 2300)
$n_rank = 'Kim cương đoàn II';
if($p <=2500 AND $p >2400)
$n_rank = 'Kim cương đoàn I';
}
if($p >2500){
$n_rank = 'Thách đấu <font color=red>(MAX)</font>';
}
echo '<td><table><tbody><tr><td><img style="width: 70px;" src="/avatar/'.$vs['id'].'.png" class="xavt"></td><td><font color=green>SM: '.$vs['sucmanh'].'</font><br>
<b><font color="red">HP: '.$vs['hp'].'</b><br>
HP FULL: '.$vs['hpfull'].'</font><br><small><b>'.$n_rank.'</b></small></td></tr></tbody></table></td></tr></tbody></table></div></center></div>';
}
require '../incfiles/end.php';