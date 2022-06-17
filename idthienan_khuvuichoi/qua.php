<?PHP
Define('_IN_JOHNCMS', 1);
Require('../incfiles/core.php');
$headmod = 'Nhận quà';
$textl = 'Nhận quà';
Require('../incfiles/head.php');
$x=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='3'"));
IF(!$user_id || $x[hp]>0){
Header("Location: /");
Exit;
}
Echo'<div class="box_forums"><br/><div class="homeforum"><div class="icon-home"><div class="home">Nhận quà</div></div></div></div><div class="phdr">Nhận Quà</div>';
IF(time() < $datauser['timequa']){
$t=($datauser['timequa']-time())/60;
Echo'<div class="omenu"><b><font color="red"><center>BẠN ĐÃ NHẬN RỒI<br>VUI LÒNG QUAY LẠI SAU</center></font></b></div>';
Require('../incfiles/end.php');
Exit;
}
$pk_user=mysql_num_rows(mysql_query("SELECT * FROM `pk_user` WHERE `user_id`='".$user_id."'"));
IF($pk_user){
$id=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='3'"));
$time=time()+5000;
$t=($datauser['timequa']-time())/60;
IF(time() > $datauser['timequa']){
$x=rand(1000000,1500000);
$l=rand(500,600);
$e=$datauser['level']*100000;
$q=rand(30,60);
$z=rand(5,10);
mysql_query("DELETE FROM `pk_user` WHERE `user_id` = '$user_id'");
mysql_query("UPDATE `users` SET `xu` = `xu` + '".$x."', `timequa` = '".$time."' WHERE `id` = '".$user_id."'");
mysql_query("UPDATE `users` SET `vnd` = `vnd` + '".$l."', `timequa` = '".$time."' WHERE `id` = '".$user_id."'");
mysql_query("UPDATE `users` SET `exp` = `exp` + '".$e."', `timequa` = '".$time."' WHERE `id` = '".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$q."' WHERE `id_shop`='45' AND `user_id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$q."' WHERE `id_shop`='46' AND `user_id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$z."' WHERE `user_id`='".$user_id."' AND `id_shop`='49'");
$bot='[b][red]'.$login.' đã nhận được '.$x.' xu, '.$l.' lượng, '.$e.' exp, '.$q.' hộp quà may mắn và siêu may mắn và '.$z.' thẻ may mắn[/red][/b]';
mysql_query("INSERT INTO `chatthegioi` SET `user_id`='3', `text`='" . mysql_real_escape_string($bot) . "', `time`='".$time."'");
Echo'<div class="omenu"><b><font color="red"><center>Bạn nhận được '.$x.' xu. '.$l.' lượng, '.$e.' exp '.$q.' hộp quà may mắn và siêu may mắn và '.$z.' thẻ may mắn</center></font></b></div>';
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'20' WHERE `user_id`='".$user_id."' AND `id_shop`='50'");Echo'<script type="text/javascript">alert("Bạn nhận được 20 Pokemon !");</script>';
}Else{
Echo'<div class="omenu"><b><font color="red"><center>BẠN ĐÃ NHẬN RỒI<br>VUI LÒNG QUAY LẠI SAU '.number_format($t).' PHÚT NỮA</center></font></b></div>';
}
}Else{
Echo'<div class="omenu"><b><font color="red"><center>Bạn có đánh Boss đâu mà đòi nhận!!</center></font></b></div>';
}
Require('../incfiles/end.php');
?>