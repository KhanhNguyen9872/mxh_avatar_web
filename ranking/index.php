<?php
define('_IN_JOHNCMS',1);
$noionline = 'Ranking';
require '../incfiles/core.php';
if(!$user_id){
Header("Location: $home");
exit;
}
$check = mysql_fetch_array(mysql_query("SELECT `user_id`,`user_vs`,`id` FROM `ranking`"));
if($check['user_id'] == $user_id OR $check['user_vs'] == $user_id){
Header('Location: tranxephang.php?id='.$check[id]);
exit;
}
$textl = 'Đấu xếp hạng';
require '../incfiles/head.php';
switch($act){
default:
echo '<div class="phdr">Thông tin xếp hạng</div><div class="da"><div>';
echo '<div class="lucifer">Lưu ý : <a href="#ngoc">Ngọc bổ trợ</a> sẽ giúp tăng kỹ năng của bạn! (duy nhất trong xếp hạng)</a>';
$thongtinnhanvat = $datauser;
$p = $thongtinnhanvat['point'];
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
echo'
<table><tbody><tr><td><img src="/ranking/'.$rank.'.png" width="85px;"></td><td><b><big>'.$n_rank.'</big></b><br><font color=green>Point: <b>'.$thongtinnhanvat['point'].'</b></font><br>Thắng: <b>'.$thongtinnhanvat['thang'].'</b> trận<br>
Thua: <b>'.$thongtinnhanvat['thua'].'</b> trận</td></tr></tbody></table></div>
<div class="list1"><big><center><b>THAM GIA XẾP HẠNG</b><br><a href="index.php?act=join"><button><i class="fa fa-hand-o-right" aria-hidden="true"></i> Tìm trận đấu <i class="fa fa-hand-o-left" aria-hidden="true"></i></button></a><br>Quy định đóng cửa phòng: mỗi phòng tồn tại tối đa 12 phút hết thời gian chưa đánh xong người tìm trận coi như AFK, bị xử thua và trừ điểm! Point được tính theo công thức: <font color=green>10 + trận thắng - trận thua</font> nếu nhỏ hơn hoặc bằng 0, point sẽ trở thành 1</center></big></div>';
if(isset($_POST['vang'])){
@mysql_query("UPDATE `users` SET `rank` = '' WHERE `user_id` = $user_id");
} else {
echo ($thongtinnhanvat['rank'] ? '<div class="rmenu"><center><form method="post"><input type="submit" name="vang" value="Tạm vắng"></form>
Nếu bạn chọn tạm vắng người chơi đấu hạng sẽ không thể đấu với bạn cho đến khi bạn trực tuyến!<br><b>Ngược lại, người khác có thể chiến đấu với bạn ngay cả khi bạn OFFLINE</b></center></div>' : '');
}
echo '<div class="phdr" id="ngoc">Ngọc bổ trợ xếp hạng</div>';
echo '<div class="lucifer"><table><tbody><tr><td><img src="https://lienminh.garena.vn/images/rune/bl_3_1.png"></td><td><b style="font-size: big; color:blue;">Ngọc phản dame <font color=red>(nội tại)</font></b><br>
Tối đa: '.$thongtinnhanvat['n_phan'].'/30 viên<br>
Miêu tả: mỗi đòn đánh phản lại địch <b>'.$thongtinnhanvat['n_phan'].'%</b> sát thương mà họ gây ra!</td></tr></tbody></table></div>';
echo '<div class="lucifer"><table><tbody><tr><td><img src="https://lienminh.garena.vn/images/rune/y_4_3.png"></td><td><b style="font-size: big; color:blue;">Ngọc miễn nhiễm sát thương</b><br>
Tỉ lệ xuất hiện '.$thongtinnhanvat['n_xxx'].' %<br>
Max: '.$thongtinnhanvat['n_xxx'].'/25 viên<br>
Miêu tả: Khi xuất hiện mọi kỹ năng ngọc, sức mạnh của địch bị <b>vô hiệu hóa</b> với bạn!</td></tr></tbody></table></div>';
echo '<div class="lucifer"><table><tbody><tr><td><img src="https://lienminh.garena.vn/images/rune/r_2_3.png"></td><td><b style="font-size: big; color:blue;">Ngọc chí mạng</b><br>
Tỉ lệ xuất hiện: %<br>
Max: '.$thongtinnhanvat['n_chimang'].'/100 viên<br>
Miêu tả: khi xuất hiện gây <b>'.($thongtinnhanvat['sucmanh']*3.5).'</b> sát thương (tương đương <b>350%</b> sức mạnh của bạn)!</td></tr></tbody></table></div>';
echo '<div class="lucifer"><table><tbody><tr><td><img src="https://lienminh.garena.vn/images/rune/bl_2_3.png"></td><td><b style="font-size: big; color:blue;">Ngọc hút máu <font color=red>(nội tại)</font></b><br>
Max: '.$thongtinnhanvat['n_hutmau'].'/45 viên<br>
Miêu tả: mỗi đòn đánh thường gây ra thêm <b>'.(($thongtinnhanvat['sucmanh']*$thongtinnhanvat['n_hutmau']/100)).'</b> sát thương cho địch và hồi lại số máu tương ứng cho bạn!</td></tr></tbody></table></div>';
echo '<div class="phdr" id="shop">Cửa hàng xếp hạng</div>';
if(isset($_POST['mua'])){
$sl = intval($_POST['sl']);
$ngoc = intval($_POST['ngoc']);
if($sl <=0){
echo '<div class="rmenu">Số lượng ngọc không hợp lệ!</div>';
} else {
if($ngoc < 1 OR $ngoc >4){
echo '<div class="rmenu">Không nhận diện được loại ngọc</div>';
} else {
if($ngoc ==1){
$data = 'n_phan';
$tien = 4;
$max = 30;
}
if($ngoc ==2){
$data = 'n_xxx';
$tien = 5;
$max = 25;
}
if($ngoc ==4){
$data = 'n_hutmau';
$tien = 4;
$max = 45;
}
if($ngoc ==3){
$data = n_chimang;
$tien = 10;
$max = 100;
}
$tien = $tien*$sl*1;
if($datauser['vnd'] >= $tien){
if(($thongtinnhanvat[$data] +$sl) >$max){
echo '<div class="rmenu">Vui lòng giảm bớt số lượng!</div>';
} else {
@mysql_query("UPDATE `users` SET `vnd` = `vnd` -$tien WHERE `id` = $user_id");
@mysql_query("UPDATE users SET $data = $data +$sl WHERE user_id = $user_id");
echo '<div class="bmenu_hero">Bạn đã mua thành công!</div>';
}
} else {
echo '<div class="rmenu">Bạn không đủ lượng!</div>';
}
}
}
}
echo '<div class="lucifer"><form method="post" action="/ranking/index.php#shop"><b>Chọn ngọc cần mua:</br></b>
<select name="ngoc"><option value="1">Ngọc phản dame [4 lượng]</option><option value="2">Ngọc miễn nhiễm... [5 lượng]</option><option value="3">Ngọc chí mạng [10 lượng]</option><option value="4">Ngọc hút máu [4 lượng]</option></select><br>
<b>Số lượng:</b><br>
<input type="number" name="sl" value="'.(intval($_POST['sl']) ? intval($_POST['sl']) : 1).'"><div class="clearfix"></div>
<button name="mua"><i class="fa fa-usd" aria-hidden="true"></i> Mua <i class="fa fa-usd" aria-hidden="true"></i></button></form></div>';
echo '<div class="phdr">TOP 15 XẾP HẠNG</div>';
$req = mysql_query("SELECT * FROM `users` WHERE `thang` != 0 ORDER BY `thang` DESC LIMIT 15");
if(!mysql_num_rows($req)){
echo '<div class="list1"><center>Chưa có dữ liệu!</center></div>';
} else {
while($thongtinnhanvat = mysql_fetch_array($req)){
$p = $thongtinnhanvat['point'];
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
echo'<div class="lucifer">
<table><tbody><tr><td><img src="/avatar/'.$thongtinnhanvat[id].'.png"></td><td><b><big>'.$n_rank.'</big></b><br><font color=green>Point: <b>'.($thongtinnhanvat['point'] > 0 ? $thongtinnhanvat['point'] : 0).'</b></font><br>Thắng: <b>'.$thongtinnhanvat['thang'].'</b>/<b>'.$thongtinnhanvat['thua'].'</b> trận<br>
'.nick($thongtinnhanvat[id]).'</td></tr></tbody></table></div>';
}
}
break;
case 'join':
if(isset($_POST['submit'])){
if($datauser['xu'] >= 3000)
{
mysql_query("UPDATE users SET xu = xu -3000 WHERE id = $user_id");
mysql_query("UPDATE users SET hp = hpfull WHERE id = $user_id");
header('Location: index.php?act=join');
exit;
}
}
$thongtinnhanvat = $datauser;
echo '<div class="phdr">Tham gia trận đấu</div>';
if($thongtinnhanvat['hp'] <=0){
echo '<div class="list1"><b><i class="fa fa-hand-o-right" aria-hidden="true"></i> Bạn chưa có Sức mạnh hoặc HP , hãy đi cường hóa</br><i class="fa fa-hand-o-right" aria-hidden="true"></i> Nếu bạn đã kiệt sức, hãy click vào npc bác sĩ để hồi máu đi !</b><form method="post"><img src="http://8vui.top/boss/img/bs.gif"> <input type="submit" value="Hồi phục" name="hoiphuc"></form></div>';
} else {
if(!$thongtinnhanvat['rank'])
@mysql_query("UPDATE `users` SET `rank` = 1 WHERE `id` = $user_id");
$pointmin = $thongtinnhanvat['point']-5000;
$pointmax = $thongtinnhanvat['point']+5000;
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `point` > $pointmin AND `point` < $pointmax AND `rank` = 1 AND `id` != '".$user_id."' AND `hp` > 0"),0);
if(!$check){
echo '<div class="list1"><center>Không tìm được thành viên thi đấu thích hợp! Hoặc họ đang bận trong trận đấu khác!<br><a href="index.php?act=join"><button>Tìm lại</button></a><br>Tổng số thành viên đang thi đấu: <b>'.mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `rank` >= 2"),0).'</b></div>';
} else {
$get = mysql_fetch_array(mysql_query("SELECT `id` FROM `users` WHERE `rank` = 1 AND `id` != $user_id AND `hp` > 0 ORDER BY RAND() LIMIT 1"));
@mysql_query("UPDATE `users` SET `rank` = 3 WHERE `id` = $user_id");
@mysql_query("UPDATE `users` SET `rank` = 2 WHERE `id` = '".$get['id']."'");
@mysql_query("INSERT INTO `ranking` SET `time` = '".time()."', `user_id` = '".$user_id."', `user_vs` = '".$get['id']."'");
$xin = mysql_insert_id();
Header("Location: tranxephang.php?id=$xin");
}
}
break;
}
require '../incfiles/end.php';