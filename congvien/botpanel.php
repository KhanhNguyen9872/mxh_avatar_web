<?php
/*
////////////////////////////////////////////////////////////////////////////////
// GocMaster Community
// Home: http://gocmaster.com
// Developer: Ari(Tuan)
// Development Team: GMT
////////////////////////////////////////////////////////////////////////////////
*/
define('_IN_JOHNCMS', 1);

$headmod = 'guestbook';
$textl = 'Quản lý BOT';
require('../incfiles/core.php');
require('../incfiles/head.php');
$id = $_GET['id'];
if ($rights >= 3) {
switch($act) {
default:
echo '<div class="phdr"><b>Thêm từ khóa cho BOT</b></div>';
echo '<div class="gmenu"><form action="botpanel.php?act=say" method="post">Từ khóa<span class="red">*</span>:<br><input type="text" name="key"><br>Trả lời<span class="red">*</span>:<br><input type="text" name="text"><br>Trả lời 1<br><input type="text" name="txt1"><br>Trả lời 2<br><input type="text" name="txt2"><br>Trả lời 3<br><input type="text" name="txt3"><br>Trả lời 4<br><input type="text" name="txt4"><br>Trả lời 5<br><input type="text" name="txt5"><br><input type="submit" value="ADD"></form></div>';
echo '<div class="topmenu"><span class="red">*</span>: điền vào trường bắt buộc.<br><b>{user}</b> hiển thị tên nick người dùng.<br><b>{text}</b> dán lại đoạn text vừa gửi đi của t.viên<br><b>{reply}</b> trích dẫn</div>';
echo '<div class="phdr"><b>Danh sách từ khoá</b></div>';
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `bot`;"), 0);
if($total == 0) {
echo 'Từ khoá trống rỗng!';
} else {
$req = mysql_query("SELECT * FROM `bot` ORDER BY `time` DESC LIMIT $start, $kmess");
$i=0;
while ($bot = mysql_fetch_assoc($req)) {
echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
echo '<b>Từ khóa:</b> '.$bot['key'].'<br><b>Trả lời(*):</b> '.$bot['text'].'<br>'.($bot['txt1'] ? '<b>Trả lời 1:</b> '.$bot['txt1'].'<br>' : '').''.($bot['txt2'] ? '<b>Trả lời 2:</b> '.$bot['txt2'].'<br>' : '').''.($bot['txt3'] ? '<b>Trả lời 3:</b> '.$bot['txt3'].'<br>' : '').''.($bot['txt4'] ? '<b>Trả lời 4:</b> '.$bot['txt4'].'<br>' : '').''.($bot['txt5'] ? '<b>Trả lời 5:</b> '.$bot['txt5'].'<br>' : '').'<b>Người add:</b> '.$bot['user'].'<br><b>Gửi lúc:</b> '.functions::display_date($bot['time']).'';
if($login = $bot['user']|| $rights >= 3) {
echo '<br><a href="?act=edit&id='.$bot['id'].'">Sửa</a><br><a href="?act=del&id='.$bot['id'].'">Xóa</a>';
}
echo '</div>';
++$i;
}
        echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
        // Навигация по страницам
        if ($total > $kmess) {
            echo '<p>' . functions::display_pagination('botpanel.php?', $start, $total, $kmess) . '</p>';
            echo '<p><form action="botpanel.php" method="get"><input type="text" name="page" size="2"/><input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/></form></p>';
        }
}
break;
case 'say':
$key = $_POST['key'];
$text = $_POST['text'];
$txt1 = $_POST['txt1'];
$txt2 = $_POST['txt2'];
$txt3 = $_POST['txt3'];
$txt4 = $_POST['txt4'];
$txt5 = $_POST['txt5'];
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `bot` WHERE `key`='$key';"), 0);
if(!$key) {
$error .= 'Không được bỏ trống giá trị.';
}
if(!$text) {
$error .= 'Không được bỏ trống giá trị.';
}
if($check > 0) {
$error .= 'Từ khoá đã tồn tại.';
}
if(!$error) {
mysql_query("INSERT INTO `bot` SET
  `time` = '".time()."',
  `user` = '$login',
  `text` = '" . mysql_real_escape_string($text) . "',
  `txt1` = '" . mysql_real_escape_string($txt1) . "',
  `txt2` = '" . mysql_real_escape_string($txt2) . "',
  `txt3` = '" . mysql_real_escape_string($txt3) . "',
  `txt4` = '" . mysql_real_escape_string($txt4) . "',
  `txt5` = '" . mysql_real_escape_string($txt5) . "',
  `key` = '" . mysql_real_escape_string($key) . "'");
echo 'Thêm thành công! <a href="botpanel.php">Tiếp tục >>></a>';
header("Location: botpanel.php");
} else {echo '<div class="rmenu">Lỗi: '.$error.'</div>';}
break;
case 'del':
$exist = mysql_result(mysql_query("SELECT COUNT(*) FROM `bot` WHERE `id`='$id';"), 0);
$uexist = mysql_result(mysql_query("SELECT COUNT(*) FROM `bot` WHERE `id`='$id' AND `user`='$login';"), 0);
if($exist == 0) {
$err .= 'Không tồn tại!';
}
if($uexist == 0 && $rights < 3) {
$err .= 'Bạn không có quyền truy cập!';
}
if(!$err) {
mysql_query("DELETE FROM `bot` WHERE `id`='" . $id . "'");
echo 'Xóa thành công! <a href="botpanel.php">Tiếp tục >></a>';
} else {
echo '<div class="rmenu">'.$err.'</div>';
}
break;
case 'edit':
$ekey = $_POST['key'];
$etext = $_POST['text'];
$etxt1 = $_POST['etxt1'];
$etxt2 = $_POST['etxt2'];
$etxt3 = $_POST['etxt3'];
$etxt4 = $_POST['etxt4'];
$etxt5 = $_POST['etxt5'];
$echeck = mysql_result(mysql_query("SELECT COUNT(*) FROM `bot` WHERE `key`='$key';"), 0);
$edit = mysql_fetch_array(mysql_query("SELECT * FROM `bot` WHERE `id`='$id' LIMIT 1"));
$euexist = mysql_result(mysql_query("SELECT COUNT(*) FROM `bot` WHERE `id`='$id' AND `user`='$login';"), 0);
$eexist = mysql_result(mysql_query("SELECT COUNT(*) FROM `bot` WHERE `id`='$id';"), 0);
if($euexist == 0 && $rights < 3) {
$err .= 'Bạn không có quyền truy cập!';
}
if(!$ekey) {
$error1 .= 'Không được bỏ trống giá trị.';
}
if($echeck > 0) {
$error1 .= 'Từ khoá đã tồn tại.';
}
if(!$error1 && $_GET['act'] == 'edit' && $_GET['id'] && $_GET['ok']) {
mysql_query("UPDATE `bot` SET
  `time` = '".time()."',
  `text` = '" . mysql_real_escape_string($etext) . "',
  `txt1` = '" . mysql_real_escape_string($etxt1) . "',
  `txt2` = '" . mysql_real_escape_string($etxt2) . "',
  `txt3` = '" . mysql_real_escape_string($etxt3) . "',
  `txt4` = '" . mysql_real_escape_string($etxt4) . "',
  `txt5` = '" . mysql_real_escape_string($etxt5) . "',
  `key` = '" . mysql_real_escape_string($ekey) . "' WHERE `id`='$id' LIMIT 1");
echo 'Sửa thành công! <a href="botpanel.php">Tiếp tục >>></a>';
header("Location: botpanel.php");
} else {
if($_GET['act'] == 'edit' && $_GET['id'] && $_GET['ok']) {
echo '<div class="rmenu">Lỗi: '.$error1.'</div>';}}
if($_GET['act'] == 'edit' && $_GET['id'] && !$_GET['ok']) {
echo '<div class="phdr"><b>Chỉnh sửa từ khóa cho BOT</b></div>';
echo '<div class="gmenu"><form action="botpanel.php?act=edit&&id='.$id.'&&ok=1" method="post">Từ khóa<br><input type="text" name="key" value="'.$edit['key'].'"><br>Trả lời<br><input type="text" name="text" value="'.$edit['text'].'"><br>Trả lời 1<br><input type="text" name="etxt1" value="'.$edit['txt1'].'"><br>Trả lời 2<br><input type="text" name="etxt2" value="'.$edit['txt2'].'"><br>Trả lời 3<br><input type="text" name="etxt3" value="'.$edit['txt3'].'"><br>Trả lời 4<br><input type="text" name="etxt4" value="'.$edit['txt4'].'"><br>Trả lời 5<br><input type="text" name="etxt5" value="'.$edit['txt5'].'"><br><input type="submit" value="Sửa"></form></div>';
}
break;
}
} else {
echo 'Bạn ko đc vào đây!';
}
require('../incfiles/end.php');
?>