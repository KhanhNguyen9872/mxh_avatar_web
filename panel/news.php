<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Tin tức';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="mainblok">';
echo '<div class="phdr">Thông báo</div>';
switch($act) {
default:
if ($rights==9) {
echo '<div class="topmenu"><a href="?act=add">Thêm</a> | <a href="?act=delall">Xóa all</a></div>';
$req=mysql_query("SELECT * FROM `news` ORDER BY `time` DESC limit $start,$kmess");
while($res=mysql_fetch_array($req)) {
echo '<div class="menu">';
if (!empty($res[noidung])&&!empty($res[chude])) {
echo '<b>'.functions::checkout($res[chude]).'</b><br/>';
echo '<small>'.functions::smileys(functions::checkout($res[noidung])).''.($rights>=7?'<br/><a href="?act=xoa&id='.$res[id].'">Xóa</a> | <a href="?act=edit&id='.$res[id].'">Edit</a>':'').'</small>';
} else {
$banghoi=mysql_fetch_array(mysql_query("SELECT * FROM `soo_forum` WHERE `id`='".$res[id_baiviet]."'"));
$pit=$res[id_baiviet]+1;
$baiviet=mysql_fetch_array(mysql_query("SELECT * FROM `soo_forum` WHERE `id`='".$pit."'"));
$sid=$banghoi[refid];
echo '<b>'.functions::checkout($banghoi[text]).'</b><br/>';
echo '<small>'.functions::smileys(bbcode::tags(functions::checkout($baiviet[text]))).''.($rights>=7?'<br/><a href="?act=xoa&id='.$res[id].'">Xóa</a> | <a href="?act=edit&id='.$res[id].'">Edit</a>':'').'</small> <a href="/forum/'.$sid.'/'.$banghoi[id].'.html">Tới bài viết</a>';
}
echo '</div>';
}
}
break;
case 'add':
if ($rights==9) {
if (isset($_POST[add])) {
if (empty($_POST[loai])) {
echo '<div class="rmenu">Chọn loại tin tức đi!</div>';
}
if ($_POST[loai]==addid) {
$shit=mysql_fetch_array(mysql_query("SELECT * FROM `soo_forum` WHERE `id`='".$_POST[idbaiviet]."'"));
if (empty($_POST[idbaiviet])) {
echo '<div class="rmenu">Nhập ID đi!</div>';
} else if($shit[type]!='t') {
echo '<div class="rmenu">Đây không phải là 1 chủ đề!</div>';
} else {
mysql_query("INSERT INTO `news` SET `id_baiviet`='".$_POST[idbaiviet]."',`time`='".time()."'");
echo '<div class="gmenu">Thêm thành công!</div>';
}
} else {
if (empty($_POST[chude])&&empty($_POST[noidung])) {
echo '<div class="rmenu">Nhập nội dung với tiêu đề đi!</div>';
} else {
mysql_query("INSERT INTO `news` SET `chude`='".$_POST[chude]."',`time`='".time()."',`noidung`='".$_POST[noidung]."'");
echo '<div class="gmenu">Thêm thành công!</div>';
}
}
}
echo '<form method="post">';
echo '<input type="radio" name="loai" value="addid"> <b>Nhập ID bài viết:</b> <input type="text" size="3" name="idbaiviet"><br/>';
echo '<input type="radio" name="loai" value="input"> <b>Nhập thông tin News</b><br/>';
echo 'Tiêu đề: <input type="text" name="chude"><br/>';
echo '<textarea name="noidung" placeholder="Nhập nội dung"></textarea><br/>';
echo '<input type="submit" name="add" value="Thêm">';
echo '</form>';
}
break;
case 'delall':
if ($rights==9) {
if (isset($_POST[delall])) {
mysql_query("DELETE FROM `news`");
header('Location: news.php');
}
echo '<form method="post">';
echo '<div class="list1">Bạn muốn xóa tất cả?</div>';
echo '<input type="submit" name="delall" value="Xóa">';
echo '</form>';
}
break;
case 'xoa':
if ($rights>=7) {
$id=(int)$_GET[id];
if (isset($_POST[xoa])) {
mysql_query("DELETE FROM `news` WHERE `id`='".$id."'");
header('Location: news.php');
}
echo '<form method="post">Bạn muốn xóa tin này?<br/><input type="submit" name="xoa" value="Xóa"> <a href="news.php"><input type="button" value="Hủy"></a></form>';
}
break;
case 'edit':
if ($rights>=7) {
$id=(int)$_GET[id];
$res=mysql_fetch_array(mysql_query("SELECT * FROM `news` WHERE `id`='".$id."'"));
if (isset($_POST[edit])) {
if (!empty($res[noidung])&&!empty($res[chude])) {
mysql_query("UPDATE `news` SET
`chude` = '" . mysql_real_escape_string($_POST[chude]) . "',
`noidung` = '" . mysql_real_escape_string($_POST[noidung]) . "' WHERE `id`='".$id."'");
header('Location: news.php');
} else {
mysql_query("UPDATE `news` SET `idbaiviet` = '" . mysql_real_escape_string($_POST[addid]) . "' WHRE `id`='".$id."'");
header('Location: news.php');
}
}
echo '<form method="post">';
if (!empty($res[noidung])&&!empty($res[chude])) {
echo 'Tiêu đề: <input type="text" name="chude" value="'.$res[chude].'"><br/>';
echo '<textarea name="noidung" placeholder="Nhập nội dung">'.$res[noidung].'</textarea><br/>';
} else {
echo 'Nhập ID bài viết: <input type="text" name="addid" value="'.$res[idbaiviet].'">';
}
echo '<input type="submit" name="edit" value="Edit"> <a href="news.php"><input type="button" value="Hủy"></a>';
echo '</form>';
}
break;
}
echo '</div>';
require('../incfiles/end.php');
?>