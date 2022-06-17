<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Thêm đồ vào rồng 1 sao';
require('../../incfiles/head.php');
if (!$user_id||$rights!=9) {
header('Location: /login.php');
exit;
}
echo '<div class="mainblok">';
echo '<div class="phdr">Add đồ vào rồng thần</div><div><div class="lucifer">';
if (isset($_POST['submit'])) {
$vp=(int)$_POST['vatpham'];
if (empty($vp)) {
echo '<div class="rmenu">!!!</div>';
} else {
mysql_query("INSERT INTO `ngocrong` SET `vatpham`='".$vp."'");
echo '<div class="rmenu">Thêm thành công!</div>';
}
}
echo '<form method="post">
Nhập ID vật phẩm: <input type="number" name="vatpham"><br/>
<input type="submit" name="submit" value="Thêm">
</form>';
echo '</div>';
require('../../incfiles/end.php');
?>