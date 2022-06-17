<?php
$int=intval($_GET['id']);
# проверим на коректность
if(!$int){
echo '<div class="rmenu">Lôi link dẫn!</div>';
echo "<div class='phdr'>";
echo "&laquo; <a href='shop_udobr.php'>Shop Phân Bón</a>";
echo "</div>";
require('../incfiles/end.php');
exit;
}
# проверим товар
$sql=mysql_query("SELECT `id` FROM `fermer_udobr_name` WHERE `id`='$int' ");
$row=mysql_fetch_assoc($sql);
if(!mysql_num_rows($sql)){
echo '<div class="rmenu">Lỗi Link Dẫn!</div>';
echo "<div class='phdr'>";
echo "&laquo; <a href='shop_udobr.php'>Shop Phân Bón</a>";
echo "</div>";require('../incfiles/end.php');
exit;
}
$post = mysql_fetch_array(mysql_query("select * from `fermer_udobr_name` WHERE  `id` = '$int'  LIMIT 1"));
$timediff=$post['time'];
$oneMinute=60;
$oneHour=60*60;
$oneDay=60*60*24;
$dayfield=floor($timediff/$oneDay);
$hourfield=floor(($timediff-$dayfield*$oneDay)/$oneHour);
$minutefield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour)/$oneMinute);
$secondfield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour-$minutefield*$oneMinute));
if($dayfield>0)$day=$dayfield.' ngày ';
if($minutefield>0)$minutefield=$minutefield." phút ";else$minutefield='';
$time_1=$day.$hourfield." giờ. ".$minutefield;
echo'<div class="menu list-bottom">'; 
echo'<table cellpadding="0" cellspacing="0"><tr><td>';
echo'<img id="raucu" src="icon/vatpham/'.$post['id'].'.png" alt="*" />';
echo'&#160;</td><td>';
echo'<b>'.htmlspecialchars($post['name']).'</b><br/>';
echo'<div class="menu"> Giá: <b> '.$post['cena'].'</b> Xu/1 vật phẩm';
echo'</td></tr></table>';
echo'</div>';
echo'<div class="menu list-bottom">';
echo"<form method='post' action='?id=".$int."&amp;$passgen'>\n";
echo'Số lượng <input type="text" name="kupit" size="4"/><input type="submit" name="save" value="Mua" />';
echo'</form>';
echo'</div>';
$kup=$post['cena']*$_POST['kupit'];
$kup=(int)$kup;
if(isset($_POST['kupit']) && $datauser['xu']>=$kup && $_POST['kupit']>0)
{
$remils = mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_udobr` WHERE `id_user` = '$user_id' AND `udobr` = '$int'"),0);
if($remils>0) mysql_query("UPDATE `fermer_udobr` SET `kol` = `kol`+ '".$_POST['kupit']."' WHERE `id_user` = $user_id AND `udobr` = '$int' LIMIT 1");
else mysql_query("INSERT INTO `fermer_udobr` (`kol` , `udobr`, `id_user`) VALUES  ('".$_POST['kupit']."', '".$int."', '".$user_id."') ");
mysql_query("UPDATE `users` SET `xu` = `xu`- $kup WHERE `id` = $user_id LIMIT 1");
header('Location: shop_udobr.php?buy_ok');
}
if(isset($_POST['kupit']) && strlen($_POST['kupit'])==0 || isset($_POST['kupit']) && $_POST['kupit']<1) {
echo'<div style="background-color: #DFF0D8;padding: 5px;margin-top: 5px;margin-bottom: 3px;">Chỉ được phép nhập Số!</div>';
}
if(isset($_POST['kupit']) && $datauser['xu']<$kup)header('Location: shop_udobr.php?buy_no');
?>