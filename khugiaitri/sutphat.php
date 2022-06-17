<?php
error_reporting(0);
define('_IN_JOHNCMS', 1);
$headmod = 'sutphat';
require_once('../incfiles/core.php');
$textl = 'Sút Phạt';
require('../incfiles/head.php');
echo'<div class="lucifer"><div class="main-xmenu">';
echo'<div class="danhmuc">Sút Phạt</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
if ($user_id) {
echo' <div class="menu list-bottom congdong">'.nick($user_id).' bạn có '.$datauser['xu'].' xu</div>';
echo'<div class="menu">';
$goal = ($_SESSION['goal'] ? $_SESSION['goal'] : '0');
$attempt = ($_SESSION['attempt'] ? $_SESSION['attempt'] : '0');
$graph = $_SESSION['graph'];
switch ($act){

case 'sut':
if ($_POST['dir']){
$dir = rand(2, 4);
$_SESSION['attempt'] = $attempt + 1;
if ($dir == $_POST['dir']){
$_SESSION['goal'] = $goal + 1;
$goal2 = $datauser['xu'] + 20000;
mysql_query("UPDATE `users` SET `xu`= '$goal2', `lastpost` = '$realtime' WHERE `id` = '$user_id'");
echo '<div class="memu">Sút vào rồi bạn được cộng 30000 xu !<br /><a href="/khugiaitri/sutphat.php/">Tiếp tục</a></div>';
}else{
$goal2 = $datauser['xu'] - 10000;
mysql_query("UPDATE `users` SET `xu`= '$goal2', `lastpost` = '$realtime' WHERE `id` = '$user_id'");
echo '<div class="menu">Rất tiết thủ môn đã bắt bóng bạn sẽ bị trừ 10000 xu<br /><a href="/khugiaitri/sutphat.php/">Tiếp tục</a></div>';
}
}else{
echo display_error('Bạn không chọn hướng để sút bóng!<br /><a href="?">Quay lại</a>');
}
break;

default:
if ($datauser['xu'] > 10000){
echo '<form action="?act=sut" method="post">';
echo '<div class="menu"><center><table width="108" height="100" style="color: white; background-image: url(/images/gate.gif);" border="0"><tr align="center"><td><input type="radio" value="1" name="dir" /> <b>1</b></td><td><b>2</b> <input type="radio" value="2" name="dir" /></td></tr><tr align="center"><td><input type="radio" value="3" name="dir" /> <b>3</b></td><td><b>4</b> <input type="radio" value="4" name="dir" /></td></tr><tr><td colspan="2" align="center" valign="bottom"><input type="image" name="submit" src="/images/ball.png" /></td></tr></table></center></div>';
echo '<div class="menu">Bạn hãy chọn hướng rồi ấn vào hình "quả bóng" để ghi điểm nha, mỗi lần sút mất 10000 xu và cộng 30000 xu nhé !</div>';
echo '</form>';
}else{
echo '<div class="menu">Bạn phải trên 10000 xu để chơi!</div>';
echo '<div class="menu"><a href="/">Tiếp tục</a></div>';
}
}
}
echo '</div>';
require('../incfiles/end.php');
?>