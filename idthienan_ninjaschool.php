<?php
/*//////////////////////////////////VUI LÒNG TÔN TRỌNG BẢN QUYỀN TÁC GIẢ KHÔNG XOÁ DÒNG NÀY/////////////////////////////
// Game Ninja School
//  Tác giả: ID Thiên Ân
// Support: fb.com/idthienan
//  Sinh Năm : 2K5 /////////////////////*/

define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
$textl = 'Thành Phố Của Rồng';
require('../incfiles/head.php');
include 'r_level.php';
$dragon = dlevel($user_id);
$dra = explode('|', $dragon);
echo '<div class="mainblok"><div class="phdr"><b>Thành Phố Của Rồng</b></div>';
$time = time();
$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `rong_city` WHERE `user_id`='{$user_id}'"), 0);
if($kt == 0) {
$kt1 = mysql_result(mysql_query("SELECT COUNT(*) FROM `rong_city` WHERE `user_id`='{$user_id}'"), 0);
if($kt1 == 1) {
echo 'Bạn đã có rồng rồi. Nếu muốn đổi con khác. Bạn cần hủy con rồng đang có!';
require('../incfiles/end.php');
exit;
}
echo '<div class="newsx">';
if(isset($_POST['submit'])) {
$dragon = intval($_POST['dragon']);
if(empty($dragon)) {
echo 'Bạn chưa chọn rồng!';
} else if($datauser['xu'] < 10000000) {
echo 'Bạn cần có >= 10.000.000xu để có thể mua rồng!</div>';
} else {
mysql_query("INSERT INTO `rong_city` SET `user_id`='{$user_id}', `dragon`='{$dragon}',`hp`='100', `level`='1', `mp`='50', `time`='{$time}', `time_an`='{$time}'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'10000000' WHERE `id`='{$user_id}'");

echo 'Mua rồng thành công. <a href="rongcity.php">Trở về</a>!</div>';
}
} else {
echo 'Bạn chưa có rồng. Để mua rồng tài khoản bạn cần có ít nhất 10.000.000 Xu<br/><form method="post">';
for($i=1; $i<=9; $i++){
echo '<input type="radio" name="dragon" value="'.$i.'" /> <img src="img/rong/'.$i.'/1.gif" alt="" /><br/>';
}
echo '<input type="submit" name="submit" value="Mua" /></form></div>';
}
} else {
$dr = mysql_fetch_array(mysql_query("SELECT * FROM `rong_city` WHERE `user_id`='{$user_id}'"));
switch($act) {
default:
if($dr['level'] != $dra[1]) {
mysql_query("UPDATE `rong_city` SET `level`='{$dra[1]}', `hp`='{$dra[2]}', `mp`='{$dra[3]}' WHERE `user_id`='{$user_id}'");
}
//time trung no
$dratime = $dr['time'] + 43200 - time();
$timetrung = date('H:i', $dratime);
//time cho an
$draan = $dr['time_an'] + 43200 - time();
$timean = date('H:i', $draan);

echo '<div class="list1">'.($dr['time'] > (time() - 43200) ? 'Trứng của bạn còn '.$timetrung.' phút nữa sẽ nở.':''.(($dr['time_an'] + 43200) < time() ? 'Rồng của bạn đang đói!':'Cậu chủ ơi! Em no quá rồi. :))<br/>» '.$timean.' phút nữa bạn có thể cho rồng ăn tiếp!').'').'';
echo '<table width="100%"><tr><td align="center" width="40%">'.($dr['time'] > (time() - 43200) ? '<img src="img/rong/trung.gif" alt="Trứng" />':'<img src="img/rong/'.$dr['dragon'].'/'.tienhoa($user_id).'.gif" alt="Dragon" />').'</td><td align="left"><span style="padding:6px;"><font color="blue"><b>Level: '.$dr['level'].'</b></font> id rồng '.$dr['id'].'<br/>Tiến hoá: <b>'.tienhoa($user_id).'</b><br/>EXP: <b>'.$dr['exp'].'</b>/'.$dra[0].'<br/>HP: <b>'.$dr['hp'].'</b>/'.$dra[2].'<br/>MP: <b>'.$dr['mp'].'</b>/'.$dra[3].'<br><b>Dame: '.$dr['dame'].'</b><br><b>Phản Dame: '.$dr['phandame'].'</b><br><b>Phòng Thủ: '.$dr['thu'].'</b></span></td></tr></table>';
echo '<div style="padding:6px;"><a href="rongcity.php?act=choan" style="background-color: #cc9933; padding: 3px; margin-right: 5px;"><b>Cho ăn</b></a><a href="tapluyen.php" style="background-color: #9999ff; padding: 3px; margin-right:5px;"><b>Luyện Tập</b></a><a href="rongcity.php?act=shop" style="background-color: #ffcc00; padding: 3px; margin-right:5px;"><b>Shop</b></a><a href="rongcity.php?act=del" style="background-color: #cccccc; padding: 3px;"><b>Xoá</b></a><br/><br/><center><a href="rongcity.php?act=kill" style="background-color: #52d017; margin-right: 6px; padding: 3px;"><b>Đấu trường</b></a><a href="rongcity.php?act=nhiemvu" style="background-color: #ff9999; padding: 3px;"><b>Nhiệm vụ</b></a>  <a href="rongcity.php?act=top" style="background-color: #52d017; margin-right: 6px; padding: 3px;"><b>TOP Lever</b></a><br/><br><div style="padding:6px;"><a href="shop.php" style="background-color: #9999ff; padding: 3px; margin-right:5px;"><b>Cửa Hàng Ngọc</b></a> <a href="cuonghoa.php" style="background-color: #52d017; margin-right: 6px; padding: 3px;"><b>Cường Hoá</b></a></center></div>';
echo '</div>';
break;
case 'choan':
if($dr['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng rồng đã nở đâu mà bạn cho ăn! :D</div></div>';
require('../incfiles/end.php');
exit;
}
if(($dr['time_an'] + 43200) > time()) {
echo '<div class="list1" style="padding:6px;">Rồng của bạn chưa đói!</div></div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="list1" style="padding:4px;">';
if(isset($_POST['sub'])) {
if($datauser['xu'] < 10000) {
echo 'Bạn không đủ 10.000 Xu!</div>';
} else {
mysql_query("UPDATE `rong_city` SET `exp`= `exp`+'500', `time_an`='{$time}' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `users` SET `xu`= `xu`-'10000' WHERE `id`='{$user_id}'");
mysql_query("UPDATE `users` SET `dach`= `dach`+'20' WHERE `id`='{$user_id}'");
if($dr['nvan'] == 100) {
echo '<b>Chúc mừng bạn đã hoàn thành nhiệm vụ cho ăn 100 lần bạn được 100 đá cường hoá </b></div>';
mysql_query("UPDATE `users` SET `dach`= `dach`+'100' WHERE `id`='{$user_id}'");
} else if($dr['nvan'] < 100) {
mysql_query("UPDATE `rong_city` SET `nvan`= `nvan`+'1' WHERE `user_id`='{$user_id}'");
}

echo 'Cho ăn thành công! <a href="rongcity.php">Trở về</a></div>';
}
} else {
echo 'Cho rồng ăn bạn sẽ mất 10.000 Xu và nhận được 500 exp và 20 đá cường hoá!<br/><form method="post"><input type="submit" name="sub" value="Cho ăn" />&#160;&#160;<a href="rongcity.php"><input type="button" value="Hủy" /></a></form>';
}
echo '</div>';
break;
case 'play':
if($dr['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng rồng đã nở đâu mà bạn cho đi chơi! :D</div></div>';
require('../incfiles/end.php');
exit;
}

//time cho choi
$drachoi = $dr['time_ball'] + 3600 - time();
$timechoi = date('H:i', $drachoi);
if(($dr['time_ball'] + 3600) > time()) {
echo '<div class="list1" style="padding:6px;">Cậu chủ ơi! Em vừa mới chơi lúc nãy. Giờ em hơi mệt mỏi. Sau '.$timechoi.' phút nữa em mới chơi tiếp được! <a href="rongcity.php">Trở về</a></div></div>';
require('../incfiles/end.php');
exit;
}
mysql_query("UPDATE `rong_city` SET `exp`= `exp`+'20', `time_ball`='{$time}' WHERE `user_id`='{$user_id}'");
if($dr['nvchoi'] == 100) {
mysql_query("UPDATE `users` SET `xu`= `xu`+'500000' WHERE `id`='{$user_id}'");
echo '<b>Chúc mừng bạn đã hoàn thành nhiệm vụ cho chơi 100 lần!</b>';
} else if($dr['nvchoi'] < 100) {
mysql_query("UPDATE `rong_city` SET `nvchoi`= `nvchoi`+'1' WHERE `user_id`='{$user_id}'");
}
echo '<div class="list1" style="padding:3px;">Vui quá...Vui quá cậu chủ ơi! (^_^)<center><img src="img/dragon/ball.png" alt="" /></center>Đá bóng thật là vui. Cậu chủ nhận được 20 exp. 1 tiếng sau chúng ta chơi tiếp nhé! <a href="rongcity.php">Trở về</a></div></div>';
break;
case 'shop':
if($dr['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng chưa nở mà cậu chủ! :D</div></div>';
require('../incfiles/end.php');
exit;
}
if($datauser['kichhoat'] <1 ) {
echo '<div class="list1" style="padding:4px;">Vui lòng kích hoạt tài khoản để sử dụng chức năng!</div></div>';
require('../incfiles/end.php');
exit;
}
echo '<b>Bạn muốn mua gì?</b><br/><div class="list1"><a href="rongcity.php?act=hp">Mua máu (100 Xu/bình/+100 HP)</a><br><br><a href="rongcity.php?act=mp">Mua mana (100 Xu/bình/+50 MP)</a><br/><br><a href="rongcity.php?act=allhp">Hồi phục đầy máu (50.000 Xu/lần)</a><br/><br><a href="rongcity.php?act=allmp">Hồi phục đầy mana (50.000 Xu/lần)</a></div></div>';
break;
case 'hp':
if($dr['hp'] == $dra[2]) {
echo '<div class="list1" style="padding:6px;">Máu của bạn đã đầy không cần nạp thêm!</div></div>';
require('../incfiles/end.php');
exit;
}
if($datauser['xu'] < 100) {
echo '<div class="list1" style="padding:6px;">Bạn không đủ 100 Xu!</div>';
require('../incfiles/end.php');
exit;
}
if(($dr['hp'] + 100) > $dra[2]) {
mysql_query("UPDATE `rong_city` SET `hp`='{$dra[2]}' WHERE `user_id`='{$user_id}'");
} else {
mysql_query("UPDATE `rong_city` SET `hp`= `hp`+'100' WHERE `user_id`='{$user_id}'");
}
mysql_query("UPDATE `users` SET `xu`=`xu`- '100' WHERE `id`='{$user_id}'");
echo '<div class="list1" style="padding:6px;">Mua thành công! Bạn được cộng 100 HP. <a href="rongcity.php">Trở về</a></div>';
break;
case 'mp':
if($dr['mp'] == $dra[3]) {
echo '<div class="list1" style="padding:6px;">Mana của bạn đã đầy không cần nạp thêm!</div>';
require('../incfiles/end.php');
exit;
}
if($datauser['xu'] < 100) {
echo '<div class="list1" style="padding:6px;">Bạn không đủ 100 Xu!</div>';
require('../incfiles/end.php');
exit;
}
if(($dr['mp'] + 50) > $dra[3]) {
mysql_query("UPDATE `rong_city` SET `mp`='{$dra[3]}' WHERE `user_id`='{$user_id}'");
} else {
mysql_query("UPDATE `rong_city` SET `mp`= `mp`+'50' WHERE `user_id`='{$user_id}'");
}
mysql_query("UPDATE `users` SET `xu`=`xu`- '100' WHERE `id`='{$user_id}'");
echo '<div class="list1" style="padding:6px;">Mua thành công! Bạn được cộng 50 MP. <a href="rongcity.php">Trở về</a></div>';
break;
case 'allhp':
if($datauser['kichhoat'] <1 ) {
echo '<div class="list1" style="padding:4px;">Vui lòng kích hoạt tài khoản để sử dụng chức năng!</div></div>';
require('../incfiles/end.php');
exit;
}
if($dr['hp'] == $dra[2]) {
echo '<div class="list1" style="padding:6px;">Máu của bạn đã đầy không cần nạp thêm!</div>';
require('../incfiles/end.php');
exit;
}
if($datauser['xu'] < 50000) {
echo '<div class="list1" style="padding:6px;">Bạn không đủ 50000 Xu!</div>';
require('../incfiles/end.php');
exit;
}
mysql_query("UPDATE `rong_city` SET `hp`='{$dra[2]}' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'50000' WHERE `id`='{$user_id}'");
echo '<div class="list1" style="padding:6px;">Mua thành công! Bạn được nạp đầy HP. <a href="rongcity.php">Trở về</a></div></div>';
break;

case 'allmp':
if($dr['mp'] == $dra[3]) {
echo '<div class="list1" style="padding:6px;">Mana của bạn đã đầy không cần nạp thêm!</div></div>';
require('../incfiles/end.php');
exit;
}
if($datauser['xu'] < 50000) {
echo '<div class="list1" style="padding:6px;">Bạn không đủ 50000 Xu!</div></div>';
require('../incfiles/end.php');
exit;
}
mysql_query("UPDATE `rong_city` SET `mp`='{$dra[3]}' WHERE `user_id`='{$user_id}'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'50000' WHERE `id`='{$user_id}'");
echo '<div class="list1" style="padding:6px;">Mua thành công! Bạn được nạp đầy MP. <a href="rongcity.php">Trở về</a></div></div>';
break;

case 'del':
echo '<div class="list1" style="padding:4px;">';
if(isset($_POST['sub'])) {
mysql_query("DELETE FROM `rong_city` WHERE `user_id`='{$user_id}'");
echo 'Xoá dữ liệu thành công! <a href="rongcity.php">Mua rồng mới!</a></div>';
} else {
echo '<b>Cảnh báo:</b> Chức năng này dùng để xoá dữ liệu mà con rồng bạn đang nuôi và bạn có thể mua con khác. Đồng nghĩa với việc bạn phải bắt đầu lại từ đầu!<br/><form method="post"><input type="submit" name="sub" value="Đồng ý" />&#160;&#160;<a href="rongcity.php"><input type="button" value="Hủy" /></a></form></div>';
}
echo '</div>';
break;
case 'dautruong':
$id = intval(trim(abs($_GET['id'])));
$drag = dlevel($id);
$drb = explode('|', $drag);
$dr2 = mysql_fetch_array(mysql_query("SELECT * FROM `rong_city` WHERE `user_id`='{$id}'"));
$dr3 = mysql_fetch_array(mysql_query("SELECT `name`,`id` FROM `users` WHERE `id`='{$id}'"));
if($dr['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng chưa nở mà cậu chủ! :D</div></div>';
require('../incfiles/end.php');
exit;
}
if($datauser['kichhoat'] <1 ) {
echo '<div class="list1" style="padding:4px;">Vui lòng kích hoạt tài khoản để đi đấu trường!</div></div>';
require('../incfiles/end.php');
exit;
}
if($dr2['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng rồng của đối thủ chưa nở!</div></div>';
require('../incfiles/end.php');
exit;
}
$ktx = mysql_result(mysql_query("SELECT COUNT(*) FROM `rong_city` WHERE `user_id`='{$id}'"), 0);
if($ktx == 0) {
echo '<div class="list1" style="padding:3px;">Đối tượng bạn muốn quyết chiến không nuôi rồng nên không chiến được! <a href="rongcity.php">Quay về</a></div></div>';
require('../incfiles/end.php');
exit;
}

if($dr['hp'] == 0 || $dr['mp'] == 0) {
echo '<div class="list1" style="padding:3px;">Bạn không còn máu hoặc mana. Hãy nạp thêm để có thể tiếp tục chiến đấu! <a href="rongcity.php">Quay về</a></div></div>';
require('../incfiles/end.php');
exit;
}
if($dr2['hp'] == 0) {
echo '<div class="list1" style="padding:3px;">Đối thủ của bạn đã hết máu. Nên không thể chiến tiếp! <a href="rongcity.php">Quay về</a></div></div>';
require('../incfiles/end.php');
exit;
}
if($user_id == $id) {
echo '<div class="list1" style="padding:3px;">Không thể tự mình đánh mình! <a href="rongcity.php">Quay về</a></div></div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="list1"><table width="100%" border="1"><tr><th width="50%" align="center"><a href="/users/profile.php?user='.$user_id.'"><b>'.$login.'</b></a></th><th width="50%" align="center"><a href="/users/profile.php?user='.$dr3['id'].'"><b>'.$dr3['name'].'</b></a></th></tr><tr>
<td width="50%"><span style="padding-left: 3px;"><font color="blue"><b>Level: '.$dr['level'].'</b></font>
<br><b>Dame: '.$dr['dame'].'</b><br><b>Phòng Thủ: '.$dr['thu'].'</b><br/>Tiến hoá: <b>'.tienhoa($user_id).'</b><br/>EXP: <b>'.$dr['exp'].'</b>/'.$dra[0].'<br/>HP: <b>'.$dr['hp'].'</b>/'.$dra[2].'<br/>MP: <b>'.$dr['mp'].'</b>/'.$dra[3].'</span></td>
<td width="50%"><span style="padding-left: 3px;"><font color="blue"><b>Level: '.$dr2['level'].'</b></font><br><b>Dame: '.$dr2['dame'].'</b><br><b>Phòng Thủ: '.$dr2['thu'].'</b><br/>Tiến hoá: <b>'.tienhoa($id).'</b><br/>EXP: <b>'.$dr2['exp'].'</b>/'.$drb[0].'<br/>HP: <b>'.$dr2['hp'].'</b>/'.$drb[2].'<br/>MP: <b>'.$dr2['mp'].'</b>/'.$drb[3].'</span></td>
</tr></table>';
echo '<br/><div align="center">
<img src="img/rong/'.$dr['dragon'].'/'.tienhoa($user_id).'.gif" alt="Dragon" /><font size="4"><span style="color:red;">VS</span></font><img src="img/rong/'.$dr2['dragon'].'/'.tienhoa($id).'.gif" alt="Dragon" />
<br/><form method="post"><input type="submit" name="danh" value="'.(isset($_POST['danh']) ? 'Đánh tiếp':'Tấn công').'" /></form></div><br/>';
echo '</div>';
$dame = $dr['dame'];
$thu = $dr2['thu'];
$damedanh = $dame-$thu;
$tinhexp = $damedanh/10;
$expnhan = $tinhexp;
$phandame = $dr2['phandame'];
$tinhda = $damedanh/500;
$dach = rand(0,$tinhda);
$tinhexpmat = $dame/50;
$expmat = rand(0,$tinhexpmat);
$phan = array("phản dam","dùng chiêu","đánh trả","phản đòn","dùng tabala đánh trả","xuất kill");
$rand = rand(0,5);
$xu = $dame*3;
if(isset($_POST['danh'])) {
$ahp = rand($phandame,$phandame);
$bxu = rand($xu,$xu);
$amp = rand(5,800);
$bhp = rand($damedanh,$damedanh);
$rexp = rand($expd,$expd);
$bexp = rand(1,6);
if($dr['nvkill'] < 100000000000000) {
mysql_query("UPDATE `users` SET `xu`= `xu`+'{$bxu}' WHERE `id`='{$user_id}'");
echo '';
} else if($dr['nvkill'] < 100) {
mysql_query("UPDATE `rong_city` SET `nvkill`= `nvkill`+'1' WHERE `user_id`='{$user_id}'");
}

//ngau nhien hp
if(($dr['hp'] - $ahp) < 0) {
mysql_query("UPDATE `rong_city` SET `hp`='0' WHERE `user_id`='{$user_id}'");
} else {
mysql_query("UPDATE `rong_city` SET `hp`=`hp`-'{$ahp}' WHERE `user_id`='{$user_id}'");
}
//ngau nhien mp
if(($dr['mp'] - $amp) < 0) {
mysql_query("UPDATE `rong_city` SET `mp`='0' WHERE `user_id`='{$user_id}'");
} else {
mysql_query("UPDATE `rong_city` SET `mp`=`mp`-'{$amp}' WHERE `user_id`='{$user_id}'");
}
//rand hp doi thu
if(($dr2['hp'] - $bhp) < 0) {
mysql_query("UPDATE `rong_city` SET `hp`='0' WHERE `user_id`='{$id}'");
} else {
mysql_query("UPDATE `rong_city` SET `hp`=`hp`-'{$bhp}' WHERE `user_id`='{$id}'");
mysql_query("UPDATE `rong_city` SET `exp`=`exp`-'{$expmat}' WHERE `user_id`='{$id}'");
mysql_query("UPDATE `users` SET `xu`= `xu`-'{$bxu}' WHERE `id`='{$id}'");
mysql_query("UPDATE `users` SET `tb_tc`= `tb_tc`+'1' WHERE `id`='{$id}'");
mysql_query("UPDATE `users` SET `id_tc`= '{$user_id}' WHERE `id`='{$id}'");
$text = '<b><font color="003366">'.nick($user_id).'</font></b><font color="000000"> Vừa tấn công rồng của bạn <a href="/game/rongcity.php?act=dautruong&id='.$user_id.'"><font color="003366">Vào Trả Thù Luôn</font></a>';
           mysql_query("INSERT INTO `thongbao` SET
                `id` = '".$user_id."',
                `user` = '{$id}',
                `text` = '$text',
                `ok` = '1',
                `time` = '" . time() . "'
            ");
}
$theme = 'Rồng bị tấn công';
$system = '[b]'.$login.'[/b] đã tấn công rồng của bạn. Khiến rồng của bạn bị thương! Hãy vào xem thế nào.';
$ktm = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` WHERE
`user_id` = '0' AND `from_id` = '".$id."' AND `read` = '0' AND `text` = '" . $system . "' AND `sys` = '1' AND `them` = '" . $theme . "'
"), 0);
if($ktm == 0) {
mysql_query("INSERT INTO `thongbao` SET
`user_id` = '0',
`from_id` = '".$id."',
`text` = '" . mysql_real_escape_string($system) . "',
`time` = '" . time() . "',
`sys` = '1',
`them` = '" . mysql_real_escape_string($theme) . "'
");
}
mysql_query("UPDATE `rong_city` SET `exp`= `exp`+'{$expnhan}' WHERE `user_id`='{$user_id}'");

mysql_query("UPDATE `users` SET `dach`= `dach`+'{$dach}' WHERE `id`='{$user_id}'");

echo '<div class="list1">- Bạn đã đánh <b>'.$dr3['name'].'</b> làm <b>'.$dr3['name'].'</b> mất <b>'.$bhp.'</b> máu. <br>Bạn mất <b>'.$amp.' </b> mana và nhận được<b> '.$bxu.' </b> xu và <b>'.$expnhan.'</b> exp từ <b>'.$dr3['name'].' </b>rớt ra!<br/>- <b>'.$dr3['name'].' '.$phan[$rand].'</b> làm bạn mất<b> '.$ahp.' </b>máu!<br>Bạn nhận được <b>'.$dach.' </b> đá cường hoá</div>';
}
break;
case 'top':
echo '<div class="phdr"><b>TOP Lever</b></div>';
$req1 = mysql_query("SELECT `id`, `level`, `user_id` FROM `rong_city` WHERE level >= 0 ORDER BY `level` DESC LIMIT 20");

while ($res1 = mysql_fetch_assoc($req1)) {

echo '<div class="menu list-top">';
echo '»';
echo '<b> <a href="/users/profile.php?user='.$res1['user_id'].'">'.nick($res1['user_id']).'</a></b> Lever: <b> '.$res1['level'].'</b> [<a href="rongcity.php?act=dautruong&id='.$res1['user_id'].'"><span style="color:red;">Đánh</span></a>]  <a href="rongcity.php?act=info&id='.$res1['user_id'].'">[Thông tin]</a></div>';
++$i;
}
break;
case 'kill':
if($dr['time'] > (time() - 43200)) {
echo '<div class="list1" style="padding:4px;">Trứng rồng đã nở đâu mà bạn cho đi chiến! :D</div></div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="list1"><b>Tất cả rồng chiến</b></div>';
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `rong_city`"), 0);
$req = mysql_query("SELECT `user_id` FROM `rong_city` WHERE `user_id`!='{$user_id}' ORDER BY `id` DESC LIMIT $start, $kmess");
while ($res = mysql_fetch_array($req)) {
echo '<div class="list1">&#187; <a href="/users/profile.php?user='.$res['user_id'].'">'.nick($res['user_id']).'</a></a> [<a href="rongcity.php?act=dautruong&id='.$res['user_id'].'"><span style="color:red;">Đánh</span></a>]  <a href="rongcity.php?act=info&id='.$res['user_id'].'">[Thông tin]</a></div>';
}
if ($dem > $kmess){
echo '<div class="topmenu">' . functions::display_pagination('rongcity.php?act=kill&page=', $start, $dem, $kmess) . '</div></div>';
}
break;
case 'info':
$id = intval(trim(abs($_GET['id'])));
$ktx = mysql_result(mysql_query("SELECT COUNT(*) FROM `rong_city` WHERE `user_id`='{$id}'"), 0);
if($ktx == 0) {
echo '<div class="list1" style="padding:3px;">Đối tượng bạn muốn không tồn tại! <a href="rongcity.php">Quay về</a></div></div>';
require('../incfiles/end.php');
exit;
}


$drag = dlevel($id);
$drb = explode('|', $drag);
$dr2 = mysql_fetch_array(mysql_query("SELECT * FROM `rong_city` WHERE `user_id`='{$id}'"));
$dr3 = mysql_fetch_array(mysql_query("SELECT `name` FROM `users` WHERE `id`='{$id}'"));

if(isset($_GET['id'])) {
echo '<div class="newsx" align="center"><b>Rồng của '.$dr3['name'].'</b></div><div class="list1"><table width="100%"><tr><td align="center" width="40%">'.($dr2['time'] > (time() - 43200) ? '<img src="img/rong/trung.gif" alt="Trứng" />':'<img src="img/rong/'.$dr2['dragon'].'/'.tienhoa($id).'.gif" alt="Dragon" />').'</td><td align="left"><span style="padding:6px;"><font color="blue"><b>Level: '.$dr2['level'].'</b></font><br/>EXP: <b>'.$dr2['exp'].'</b>/'.$drb[0].'<br/>HP: <b>'.$dr2['hp'].'</b>/'.$drb[2].'<br/>MP: <b>'.$dr2['mp'].'</b>/'.$drb[3].'<br><b>Dame: '.$dr2['dame'].'</b><br><b>Phản Dame: '.$dr2['phandame'].'</b><br><b>Phòng Thủ: '.$dr2['thu'].'</b></span></td></tr></table></div></div>';
} else {
header("Location: rongcity.php");
}
break;
case 'nhiemvu':
echo '<div class="list1"><b>Nhiệm vụ 1:</b>Cho rồng ăn 100 lần. Phần thưởng nhận được là 100 đá cường hoá!<br/>'.($dr['nvan'] < 100 ? '<b>Chưa hoàn thành! ('.$dr['nvan'].'/100)</b>':'<span style="color:red; font-weight:bold;">Nhiệm vụ hoàn thành!</span>').'</div>';
echo '<div class="list1"><b>Nhiệm vụ 2:</b>Cho rồng chơi 100 lần. Phần thưởng nhận được là 500k Xu!<br/>'.($dr['nvchoi'] < 100 ? '<b>Chưa hoàn thành! ('.$dr['nvchoi'].'/100)</b>':'<span style="color:red; font-weight:bold;">Nhiệm vụ hoàn thành!</span>').'</div>';
echo '<div class="list1"><b>Nhiệm vụ 3:</b>Cho rồng đi đánh nhau 100 lần. Phần thưởng nhận được là 500k Xu!<br/>'.($dr['nvkill'] < 100 ? '<b>Chưa hoàn thành! ('.$dr['nvkill'].'/100)</b>':'<span style="color:red; font-weight:bold;">Nhiệm vụ hoàn thành!</span>').'</div></div>';
break;
}
}
echo '<div class="phdr"><a href="rongcity.php">Game Mod by pkoolvn</a></div>';
echo '</div>';
require('../incfiles/end.php');
?>