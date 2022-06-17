<?php
if ($datauser[id]==$user_id) {
if (isset($_POST[thao])) {
$vatpham=(int)$_POST[vatpham];
if (empty($vatpham)) {
header('Location: /ruong');
}
$check=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `id`='".$vatpham."' AND `user_id`='".$user_id."'"));
if ($check<1) {
echo '<div class="news">Bạn không có Vật Phẩm này!</div>';
} else {
$info=mysql_fetch_array(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `id`='".$vatpham."'"));
$dangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `id_ruong`='".$info[id]."'"));
if ($dangmac<1) {
echo '<div class="news">Chưa mặc mà đòi cởi à!</div>';
} else {
@mysql_query("UPDATE `users` SET `{$info['loai']}`='' WHERE `id`='".$user_id."'");
@mysql_query("UPDATE `dangmac` SET `id_ruong`='', `id_loai` = ''  WHERE `user_id`='".$user_id."' AND `loai`='".$info[loai]."'");
header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}");
exit;
}
}
}
}
?>