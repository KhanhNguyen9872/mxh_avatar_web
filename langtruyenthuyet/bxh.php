<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$headmod = 'Làng cổ';
$textl='Bảng xếp hạng';
require('../incfiles/head.php');
echo '<div class="box_forums"><br/><div class="homeforum"><div class="icon-home"><div class="home">Bảng Xếp Hạng</div></div></div></div>';
echo'
<div class="phdr">TOP CAO THỦ BOSS</div>';
$top= mysql_query("SELECT * FROM users WHERE `tichluy`=`tichluy` >= 0 AND `rights` < 9 ORDER BY `tichluy` DESC LIMIT 5");
$i=1;
while
($res=mysql_fetch_array($top)) {
echo'<div class="list1"><img src="/avatar/'.$res['id'].'.png">
<br/>-TOP: '.$i.' ';
if($i == 1)
echo'<span style="padding-right:7px;"><img src="http://4rumvn.net/icon/top/no1.png"></span>';
else
if($i == 2)
echo'<span style="padding-right:7px;"><img src="http://4rumvn.net/icon/top/no2.png"></span>';
else
if($i == 3)
echo'<span style="padding-right:7px;"><img src="http://4rumvn.net/icon/top/no3.png"></span>';
echo'<br/>
<a href="/member/'.$res['id'].'.html"><b><font color="003366">'.nick($res['id']).'</b></font></a><br/>
-Tích lũy: '.$res['tichluy'].'</div>';
++$i;
}
Echo'<div><div>';
require('../incfiles/end.php');
?>