<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Đổi tên';
require('../../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
echo '<div class="mainblok"><div class="phdr">'.$textl.' - 1 lần đổi là 50 lượng</div><div><div class="lucifer">';
if (isset($_GET['done'])) {
echo '<div class="menu">Tên của bạn đã được đổi thành <b>'.$login.'</b></div>';
}
if (isset($_POST['rename'])) {
if ($datauser['vnd']<50) {
echo '<div class="rmenu">Kiếm đủ 50 lượng để đổi tên bạn nhé</div>';
} else {
$name=trim($_POST['textbox']);
$nameLower=strtolower($name);
$checkName=mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE LCASE(`name`) = '".$nameLower."'"));
if (empty($name)) {
echo '<div class="rmenu">Nhập tên đi chứ...</div>';
} else if(strlen($name)>=25||strlen($name)<=3) {
echo '<div class="rmenu">Tên ít nhất là 3 kí tự và không quá 25 kí tự</div>';
} else if($checkName==1){
echo '<div class="rmenu">Tên đã có người sử dụng...</div>';
} else if(str_word_count($name)>1) {
echo '<div class="rmenu">Tên không được có khoảng trắng...</div>';
} else {
mysql_query("UPDATE `users` SET `name`='".mysql_real_escape_string($name)."',`vnd`=`vnd`-'50' WHERE `id`='".$user_id."'");
header('Location: ?done');
exit;
}
}
}
echo '<form method="post">
<table><tr><input type="text" name="textbox" placeholder="Nhập tên muốn đổi..."> </tr><tr><input type="submit" value="Đổi" name="rename" class="nut"></tr></table>
</form>';
echo '<div class="gmenu">
<b>Lưu ý:</b> Không viết tiếng việt có dấu để tránh lỗi, cảm ơn...<br/>
Mặc dù khi đổi tên thì tên đăng nhập của bạn vẫn là "<b>'.$datauser['name_lat'].'</b>"
</div>';
echo '</div>';
require('../../incfiles/end.php');
?>