<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Item ẩn';
require('../incfiles/head.php');
echo '<div class="mainblok">';
echo '<div class="phdr">Item ẩn</div>';
$req=mysql_query("SELECT * FROM `shopdo` WHERE `hienthi`='1' LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
echo '<img src="/images/shop/'.$res[id].'.png" class="avatar_vina"><b>ID: <font color="red">'.$res[id].'</font></b><br/><b>Tên vật phẩm: <font color="green">'.$res[tenvatpham].'</font><b/><br/><b>Loại :</b><font color="green"> '.$res[loai].'</font></br><br/>';
}
$total=mysql_result(mysql_query("SELECT COUNT(*) FROM `shopdo` WHERE `hienthi`='1'"),0);
if ($total > $kmess) {
echo '<div class="topmenu">' . functions::pages('/shop/hide.php?page=', $start, $total, $kmess) . '</div>';
}
echo '</div>';
require('../incfiles/end.php');
?>