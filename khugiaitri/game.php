<?php
define('_IN_JOHNCMS', 1);
require ('../incfiles/core.php');
$textl = 'Mini Game';
require ('../incfiles/head.php');
if (!$user_id) {
header('Location: '.$home.'');
require('../incfiles/end.php');
exit;
} else {
?>
<div><div class="lucifer">
<div class="main-xmenu">
<div class="danhmuc">Mini Game</div>
 <div class="menu"><img src="/icon/oantuti.png" alt="icon" style="vertical-align: -3px;"/> <a href="taixiu.php">Tài Xỉu </a></div>
 <div class="menu list-top"><img src="/icon/baucua.png" alt="icon" style="vertical-align: -3px;"/> <a href="baucua.php">Bầu Cua</a></div>
<div class="menu list-top"><img src="/images/ball.png" width="17px" alt="icon" style="vertical-align: -3px;"/> <a href="sutphat.php">Sút Phạt</a></div>
<div class="menu list-top"><img src="/khugiaitri/quayso/8.gif" width="17px" alt="icon" style="vertical-align: -3px;"/> <a href="/khugiaitri/quayso/index.php">Quay Xèng</a></div>
<br>
<div class="danhmuc">Tiện ích</div>
<div class="menu"><img src="/icon/icontraitimnho.png" alt="icon" style="vertical-align: -3px;"/> <a href="/khugiaitri/fs">Tạo F.s</a></div>
<div class="menu"><img src="/icon/icontraitimnho.png" alt="icon" style="vertical-align: -3px;"/> <a href="/khugiaitri/maydotinhyeu">Máy đo tình yêu</a></div>
<div class="menu"><img src="/icon/icontraitimnho.png" alt="icon" style="vertical-align: -3px;"/> <a href="/upanh/index.php">Upload ảnh</a></div>
</div>
<br>
<?php
}
require ('../incfiles/end.php');