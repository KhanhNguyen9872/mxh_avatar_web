<?php
/*///////////////////////
//@Tac gia: Nguyen Ary
//@Site: gochep.net
//@Facebook: facebook.com/tia.chophht
///////////////////////*/
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl= 'Chỉnh sửa nhóm';
require('../incfiles/head.php');
include_once('func.php');
$id= intval(abs($_GET['id']));
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `id`='$id'"),0);
if(!isset($id) || $dem == 0) {
echo '<br/><div class="menu">Nhóm không tồn tại hoặc đã bị xoá!</div>';
require('../incfiles/end.php');
exit;
}
$nhom = nhom($id);

if($nhom['user_id']!=$user_id) {
echo '<br/><div class="menu">Bạn không đủ quyền!</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="mainblok"><div class="phdr"><b>Chỉnh sửa nhóm</b></div>';
$ten = $_POST['ten'];
$mota = $_POST['mota'];
$riengtu = intval($_POST['riengtu']);
$dem = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom` WHERE `name`='$ten'"),0);

$kt = mysql_result(mysql_query("SELECT COUNT(*) FROM `nhom_user` WHERE `id`='".$id."'AND `user_id`='".$user_id."' AND `duyet`='1'") ,0);
if(isset($_POST['sub'])) {
if(empty($ten)) {
echo '<div class="menu">Bạn phải nhập tên nhóm!</div>';
} else if(strlen($ten) > 50) {
echo '<div class="tb">Tên nhóm quá dài!</div>';
} else if($dem==1 && $nhom['name']!=$ten) {
echo '<div class="menu">Tên nhóm quá dài!</div>';
} else if(empty($mota)) {
echo '<div class="tb">Bạn phải nhập mô tả về nhóm!</div>';
} else if(strlen($mota) > 300) {
echo '<div class="menu">Mô tả quá dài!</div>';
} else {
mysql_query("UPDATE `nhom` SET `name`='$ten', `gt`='$mota', `set`='$riengtu' WHERE `id`='$id'");
echo '<div class="menu">Sửa thành công! <a href="page.php?id='.$id.'">Về nhóm >></a></div>';
}
}
echo '<form method="post"><div class="menu">Tên nhóm: (Max. 50 kí tự)<br/><input type="text" name="ten" value="'.$nhom['name'].'" /></div><div class="menu">Mô tả: (Max. 300 kí tự)<br/ ><textarea rows="3" name="mota">'.$nhom['gt'].'</textarea><br/ >Lưu ý: Mô tả phải viết bằng tiếng việt có dấu, không sử dụng ngôn ngữ teen, nghiêm cấm spam nếu không nhóm có thể bị xoá mà không báo trước.</div><div class="menu">Quản lý riêng tư:<br/><input type="radio"'.($nhom['set']==0 ? ' checked="checked"':'').' name="riengtu" value="0" /><b>Mở:</b> Ai cũng có thể nhìn thấy nhóm, những thành viên trong nhóm và bài đăng của các thành viên.<br/><input type="radio"'.($nhom['set']==1 ? ' checked="checked"':'').' name="riengtu" value="1" /><b>Đã đóng:</b> Ai cũng có thể nhìn thấy nhóm và những thành viên trong nhóm. Nhưng chỉ thành viên mới có thể thấy các bài đăng.<br/><input type="radio"'.($nhom['set']==2 ? ' checked="checked"':'').' name="riengtu" value="2" /><b>Bí mật:</b> Chỉ thành viên mới có thể thấy nhóm, những thành viên khác trong nhóm và bài đăng của các thành viên.<br/></div><div class="menu"><input type="submit" name="sub" value="Chỉnh sửa" /></div></form>';
echo '</div>';
require('../incfiles/end.php');
?>
