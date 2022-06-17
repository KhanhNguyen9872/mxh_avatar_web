<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Nhiệm vụ hằng ngày';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="mainblok">';
switch($act) {
default:
echo '<div class="phdr">'.$textl.'</div>';
echo '<table>';
echo '<tr>';
echo '<td>';
echo '<img src="/icon/npcnhiemvu.gif">';
echo '</td>';
echo '<td>';
echo '<div class="login"><a href="?act=nhiemvu"><b><font color="brown">Nhận nhiệm vụ</b></font</a></div>';
echo '<div class="login"><a href="?act=my"><b><font color="brown">Nhiệm vụ đã nhận</font></b></a></div>';
echo '</td>';
echo '</tr>';
echo '</table>';
break;
case 'add':
if (!$user_id||$rights<9) {
header('Location: /login.php');
exit;
}
echo '<div class="phdr">Thêm nhiệm vụ</div>';
if (isset($_POST['submit'])) {
$tennv=$_POST['tennv'];
$chitiet=$_POST['chitiet'];
$chitietphanthuong=$_POST['chitietphanthuong'];
$hoanthanh=(int)$_POST['hoanthanh'];
$query=$_POST['query'];
if (empty($tennv)||empty($chitiet)||empty($chitietphanthuong)||empty($hoanthanh)||empty($query)) {
echo '<div class="rmenu">Nhập đầy đủ đi!</div>';
} else {
mysql_query("INSERT INTO `nhiemvu` SET
`tennhiemvu`='".$tennv."',
`chitiet`='".$chitiet."',
`hoanthanh`='".$hoanthanh."',
`query`='".$query."',
`phanthuong`='".$chitietphanthuong."'");
echo '<div class="rmenu">Thêm thành công!</div>';
}
}
echo '<form method="post">
Tên nhiệm vụ: <input type="text" name="tennv"><br/>
Chi tiết: <input type="text" name="chitiet"><br/>
Chi tiết phần thưởng: <input type="text" name="chitietphanthuong"><br/>
Hoàn thành: <input type="number" name="hoanthanh"><br/>
Query: <textarea name="query"></textarea><br/>
<input type="submit" name="submit" value="Thêm">
</form>';
break;
case 'chitiet':
$id=(int)$_GET['id'];
$check=mysql_fetch_array(mysql_query("SELECT * FROM `nhiemvu` WHERE `id`='".$id."'"));
if ($check<1) {
echo '<div class="rmenu">Không có nhiệm vụ này!</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="phdr">Chi tiết nhiệm vụ</div>';
$res=mysql_fetch_array(mysql_query("SELECT * FROM `nhiemvu` WHERE `id`='".$id."'"));
if (isset($_POST['nhan'])) {
$checknhan=mysql_num_rows(mysql_query("SELECT * FROM `nhiemvu_user` WHERE `user_id`='".$user_id."' AND `id_nv`='".$res['id']."'"));
if ($checknhan>0) {
echo '<div class="rmenu">Bạn đã nhận nhiệm vụ này rồi!</div>';
} else {
mysql_query("INSERT INTO `nhiemvu_user` SET
`user_id`='".$user_id."',
`id_nv`='".$res['id']."'");
echo '<div class="gmenu">Nhận thành công nhiệm vụ <b>'.$res['tennhiemvu'].'</b> <a href="nhiemvu.php"><input type="button" value="Quay lại"></a></div>';
}
}
echo '<div class="list1">Tên nhiệm vụ: <b><img src="/congvien/img/'.$res['id'].'.png">'.$res['tennhiemvu'].'</b></div>';
echo '<div class="list1">Phần thưởng: <b>'.$res['phanthuong'].'</b></div>';
echo '<div class="list1">Chi tiết nhiệm vụ: <b>'.$res['chitiet'].'</b></div>';
echo '<form method="post">
<input type="submit" name="nhan" value="Nhận nhiệm vụ">
</form>';
break;
case 'nhiemvu':
echo '<div class="phdr">Nhận nhiệm vụ</div>';
$req=mysql_query("SELECT * FROM `nhiemvu`");
while ($res=mysql_fetch_array($req)) {
echo '<img src="/congvien/img/'.$res['id'].'.png" class="avatar_vina">
<b><font color="blue">'.$res['tennhiemvu'].'</font></b><br/>
<font color="green"><b>Phần thưởng:</b> '.$res['phanthuong'].'</font><br/>
<a href="?act=chitiet&id='.$res['id'].'"><input type="submit" value="Chi tiết"></a><br/>
';
}
break;
case 'nhanthuong':
$id=(int)$_GET['id'];
$check=mysql_fetch_array(mysql_query("SELECT * FROM `nhiemvu` WHERE `id`='".$id."'"));
if ($check<1) {
echo '<div class="rmenu">Không có nhiệm vụ này!</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="phdr">Nhận thưởng nhiệm vụ</div>';
$res=mysql_fetch_array(mysql_query("SELECT * FROM `nhiemvu_user` WHERE `id_nv`='".$id."' AND `user_id`='".$user_id."'"));
$nv=mysql_fetch_array(mysql_query("SELECT * FROM `nhiemvu` WHERE `id`='".$id."'"));
$nhan=mysql_num_rows(mysql_query("SELECT * FROM `nhiemvu_user` WHERE `id_nv`='".$id."' AND `user_id`='".$user_id."'"));
if ($res['nhanthuong']==1) {
echo '<div class="rmenu">Bạn đã nhận thưởng nhiệm vụ <b>'.$nv['tennhiemvu'].'</b> rồi nhé <a href="nhiemvu.php"><input type="button" value="Quay lại"></a></div>';
} else if ($nhan<1) {
echo '<div class="rmenu">Bạn chưa nhận nhiệm vụ này nhé <a href="nhiemvu.php"><input type="button" value="Quay lại"></a></div>';
} else if($res['tiendo']<$nv['hoanthanh']) {
echo '<div class="rmenu">Bạn chưa hoàn thành nhiệm vụ <a href="nhiemvu.php"><input type="button" value="Quay lại"></a></div>';
} else {
$query=$nv['query'];
$query = str_replace('$user_id', $user_id, $query);
//Thực hiện đoạn query trong data
mysql_query($query);
//Check vào
mysql_query("UPDATE `nhiemvu_user` SET `nhanthuong`='1' WHERE `user_id`='".$user_id."' AND `id_nv`='".$res['id_nv']."'");
echo '<div class="gmenu">Nhận thưởng thành công nhiệm vụ <b>'.$nv['tennhiemvu'].'</b> <a href="nhiemvu.php"><input type="button" value="Quay lại"></a></div>';
}
break;
case 'my':
echo '<div class="phdr">Nhiệm vụ của tôi</div>';
$req=mysql_query("SELECT * FROM `nhiemvu_user` WHERE `user_id`='".$user_id."'");
while ($res=mysql_fetch_array($req)) {
$nv=mysql_fetch_array(mysql_query("SELECT * FROM `nhiemvu` WHERE `id`='".$res['id_nv']."'"));
echo '<img src="/congvien/img/'.$res['id_nv'].'.png" class="avatar_vina">
<b>'.$nv['tennhiemvu'].'</b><br/>
Tiến độ: '.$res['tiendo'].'/'.$nv['hoanthanh'].' '.($res['tiendo']<$nv['hoanthanh']?'<font color="red">(Chưa hoàn thành)</font>':'<font color="green">(Đã hoàn thành)</font>').'<br/>
'.($res['tiendo']<$nv['hoanthanh']?'<input type="button" value="Chưa hoàn thành">':'<a href="?act=nhanthuong&id='.$res['id_nv'].'"><input type="submit" value="Nhận thưởng"></a>').'<br/>';
}
break;
}
echo '</div>';
require('../incfiles/end.php');
?>