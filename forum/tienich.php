<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl='Chú thích BQT - VNTeenViet.Com';
require('../incfiles/head.php');
if(!$user_id) {
header('Location: dangnhap.html');
}
echo'
<div class="phdr">Thông tin - chú thích</div>
<div class="list1"><img src="/forum/images/admin.gif"> - <b><font color="FF4444">Admin</font></b><br/>
<img src="/forum/images/smod.gif"> - <b><font color="green">SMod</font></b><br/>
<img src="/forum/images/mod.gif"> - <b><font color="9932CC">Mod</font></b><br/>
<img src="/forum/images/gm.gif"> - <b><font color="EA9415">Game Master</font></b><br/>
<img src="/forum/images/tmod.gif"> - <b><font color="008080">Trial Mod</font></b><br/></div>
<div class="phancach"><div class="phdr">Thuộc về VnTeenViet</div></div>';
require('../incfiles/end.php');
?>
