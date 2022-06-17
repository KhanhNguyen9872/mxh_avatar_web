<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
$textl='Nạp tiền';
require('../incfiles/head.php');
echo '<div class="mainblok">';
if ($set[khuyenmai]!=0) {
echo '<div class="news"><marquee behavior="alternate"><font color="red" size="1"><h3>Hiện tại wap đang khuyến mãi <b>'.$set[khuyenmai].'%</b> thẻ nạp ^^ </h3></font></marquee><br>';
}
echo '<div class="phdr">Để Đảm Bảo An Toàn Khi Nạp Thẻ Vui Lòng Liên Hệ FB ID Thiên Ân (Admin). - <a href="//fb.com/idthienan"><font size="3px"><b>[Nạp ngay]</b></font></a></div><img src="https://www.upsieutoc.com/images/2019/12/18/Screenshot_20191218-163540.jpg" width="100%"><br>';
echo '<div class="phdr">Nạp xu - <a href="//fb.com/idthienan"><font size="3px"><b>[Nạp ngay]</b></font></a></div>';
$rx=mysql_query("SELECT * FROM `napthe` WHERE `loai`='xu'");
while ($xu=mysql_fetch_array($rx)) {
$km=$xu[tien]*$set[khuyenmai]/100;
$tongxu=$xu[tien]+$km;
echo '<div class="list1"><b style="color:red;">'.$xu[menhgia].'đ</b> <b style="color:black;">=</b> <b style="color:blue;">'.$tongxu.' xu</b>'.($set[khuyenmai]!=0?' <font color="green">(+<b>'.$km.' xu</b>)</font>':'').'</div>';
}
echo '<div class="phdr">Nạp lượng - <a href="//fb.com/idthienan"><font size="3px"><b>[Nạp ngay]</b></a></font></div>';
$rv=mysql_query("SELECT * FROM `napthe` WHERE `loai`='vnd'");
while ($vnd=mysql_fetch_array($rv)) {
$kmvnd=$vnd[tien]*$set[khuyenmai]/100;
$tongvnd=$vnd[tien]+$kmvnd;
echo '<div class="list1"><b style="color:red;">'.$vnd[menhgia].'đ</b> <b style="color:black;">=</b> <b style="color:blue;">'.$tongvnd.' Lượng</b>'.($set[khuyenmai]!=0?' <font color="green">(+<b>'.$kmvnd.' Lượng</b>)</font>':'').'</div>';
}
echo '';
require('../incfiles/end.php');
?>