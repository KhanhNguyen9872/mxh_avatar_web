<?php
if ($datauser[id]==$user_id) {
if (isset($_POST[mac])) {
$vatpham=(int)$_POST[vatpham];
if (empty($vatpham)) {
header("Location: /ruong");
}
$check=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `id`='".$vatpham."' AND `user_id`='".$user_id."'"));
if ($check<1) {
echo '<div class="news">Bạn không có Vật Phẩm này!</div>';
} else {
//Khai báo
$info=mysql_fetch_array(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `id`='".$vatpham."'"));
$dangmac=mysql_num_rows(mysql_query("SELECT * FROM `dangmac` WHERE `user_id`='".$user_id."' AND `loai`='".$info[loai]."'"));
if ($info[loai]=='cancau') {
mysql_query("UPDATE `users` SET `savecancau`='".$info[id_loai]."' WHERE `id`='".$user_id."'");
}
@mysql_query("UPDATE `users` SET `{$info['loai']}`='".$info[id_loai]."' WHERE `id`='".$user_id."'");
@mysql_query("UPDATE `dangmac` SET `id_ruong`='".$info[id]."', `id_loai` = '".$info[id_loai]."',`timesudung`='".$info[timesudung]."'  WHERE `user_id`='".$user_id."' AND `loai`='".$info[loai]."'");
header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}");
exit;
}
}
}
?>