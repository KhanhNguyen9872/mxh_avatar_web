<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Trạm tàu vũ trụ';
require('../../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}

echo '<div class="phdr"><center>'.$textl.'</center></div><div class="lucifer">';
echo '<center><img src="https://video.bts47.com/icon/npc1.png"><br/></center>
<center><font color="brown"><b> Bây giờ , hãy chọn 1 nơi mà ngươi muốn tới <img src="/icon/devil.gif"></font></b></center>
<div class="menu class"><img src="/icon/next.png"><a href="/sanbay/"><font color="red"> <b> XayDa</b></font> </a></div>
<div class="menu class"><img src="/icon/next.png"><a href="/sanbay/"><font color="red"> <b> Namek </b></font></a> </div>
<div class="menu class"><img src="/icon/next.png"><a href="/sanbay/"><font color="red"> <b> Trái Đất </b></font></a> </div>';
Echo'<div>';
require('../../incfiles/end.php');
?>