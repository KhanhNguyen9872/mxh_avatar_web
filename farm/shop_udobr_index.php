<?php
$res = mysql_query("select * from `fermer_udobr_name` LIMIT 10");
while ($post = mysql_fetch_array($res)){
$timediff=$post['time'];
$oneMinute=60;
$oneHour=60*60;
$oneDay=60*60*24;
$dayfield=floor($timediff/$oneDay);
$hourfield=floor(($timediff-$dayfield*$oneDay)/$oneHour);
$minutefield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour)/$oneMinute);
$secondfield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour-$minutefield*$oneMinute));
if($dayfield>0)$day=$dayfield.' ngày ';
if($minutefield>0)$minutefield=$minutefield." phút";else$minutefield='';
$time_1=$day.$hourfield." giờ ".$minutefield;
echo '<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="width: 40px;">';
echo'<img id="raucu" src="icon/vatpham/'.$post['id'].'.png" alt="*"/>';
echo'&#160;</td><td style="width: 500px;">';
echo'<a href="/farm/shop_udobr.php?id='.$post['id'].'">[ <b>'.htmlspecialchars($post['name']).'</b> ]</a><br/>
Giá: [ <b>'.$post['cena'].'</b> xu]<br/>';
echo'</td></tr></table></div>';
}
?>
