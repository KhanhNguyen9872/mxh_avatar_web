<?php
$int = intval($_GET['id']);
if(!$int){
echo '<div class="list1">Lỗi Link dẫn!</div>';
require('../incfiles/end.php');
exit;
}
$sql=mysql_query("SELECT `id` FROM `fermer_name` WHERE `id`='$int' ");
$row=mysql_fetch_assoc($sql);
if(!mysql_num_rows($sql)){
echo '<div class="menu">Rau củ không tồn tại</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
$post = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$int'  LIMIT 1"));
$timediff=$post['time'];
$oneMinute=60;
$oneHour=60*60;
$oneDay=60*60*24;
$dayfield=floor($timediff/$oneDay);
$hourfield=floor(($timediff-$dayfield*$oneDay)/$oneHour);
$minutefield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour)/$oneMinute);
$secondfield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour-$minutefield*$oneMinute));
if($dayfield>0)$day=$dayfield.' ngày. ';
if($minutefield>0)$minutefield=$minutefield." phút.";else$minutefield='';
$time_1=$day.$hourfield." giờ. ".$minutefield;
echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr><td>';
echo'<img id="raucu" src="icon/item/'.$post['id'].'.png" alt="*" />';
echo'&#160;</td><td>';
echo'[ <b>'.htmlspecialchars($post['name']).'</b> ]<br/>';
echo 'Giá: <b>'.$post['cena'].'</b> xu/1 cây<br />';
echo'</td></tr></table>';
echo'</div>';
echo'<div class="menu">';
echo 'Thời Gian Sinh truởng: [ <b>'.$time_1.'</b> ]<br/>
Số Lượng Thu hoạch: [ tầm <b>'.$post['rand2'].'</b> cây ]<br/>';
$dohod=$post['rand2']*$post['dohod'];
echo '
Tổng thu nhập [ <b>'.$dohod.'</b> Xu ]';
echo '<form method="post" action="?id='.$int.'&amp;'.$passgen.'">
Số Luợng Mua <input type="text" name="kupit" size="4"/><input type="submit" name="save" value="Mua" />
</form>
</div>';
$kup=$post['cena']*$_POST['kupit'];
if(isset($_POST['kupit']) && $datauser['xu']>=$kup && $_POST['kupit']>0)
{
$remils = mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_hatgiong` WHERE `id_user` = '$user_id' AND `semen` = '$int'"),0);
if($remils>0) mysql_query("UPDATE `fermer_hatgiong` SET `kol` = `kol`+ '".$_POST['kupit']."' WHERE `id_user` = $user_id AND `semen` = '$int' LIMIT 1");
else mysql_query("INSERT INTO `fermer_hatgiong` (`kol` , `semen`, `id_user`) VALUES  ('".$_POST['kupit']."', '".$int."', '".$user_id."') ");
mysql_query("UPDATE `users` SET `xu` = `xu`- $kup WHERE `id` = $user_id LIMIT 1");
header('Location: shop.php?buy_ok');
}
if(isset($_POST['kupit']) && strlen($_POST['kupit'])==0 || isset($_POST['kupit']) && $_POST['kupit']<1){
echo'<div style="background-color: #DFF0D8;padding: 5px;margin-top: 5px;margin-bottom: 3px;">Chỉ được phép nhập Số!</div>';
}
if(isset($_POST['kupit']) && $datauser['xu']<$kup)header('Location: shop.php?buy_no');
?>