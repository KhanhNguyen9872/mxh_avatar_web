<?PHP
Define('_IN_JOHNCMS', 1);
Require('../incfiles/core.php');
$headmod = 'PK';
$textl = 'PK';
Require('../incfiles/head.php');
IF(!$user_id){
Header("Location: /");
Exit;
}
Echo'<div class="box_forums"><br/><div class="homeforum"><div class="icon-home"><div class="home">Chiến trường</div></div></div></div><div class="phdr">Chiến trường</div>';
session_start();
$id=(int)$_GET[id];
$uid=mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'");
$num=mysql_num_rows($uid);
$x=mysql_fetch_array($uid);
IF($datauser['hp']<=0&&$x[hp]<=0&&$num<1&&$id=$user_id&&$_SESSION['PK']>time()){Header('Location:/vuichoi');Exit;}
IF($x['timepk']>time()){
$time=time()-300;
$v=mysql_fetch_assoc(mysql_query("SELECT * FROM `vitri` WHERE `id`='".$id."' AND `time`>'".$time."'"));
$d=rand($datauser[sucmanh]/10*10,($datauser[sucmanh]/10*15));
mysql_query("UPDATE `users` SET `hp`=`hp`-'".$d."' WHERE `id`='".$x[id]."'");
$s=rand(1,30);
IF($x[id]==3){
$pk_user=mysql_num_rows(mysql_query("SELECT * FROM `pk_user` WHERE `user_id`='".$user_id."'"));
IF($Check <= 0 && $x[hp] > 0){
mysql_query("INSERT INTO `pk_user` SET `user_id`='".$user_id."'");
}
}
IF($d>=$x[hp]&&$x[hp]>0){
mysql_query("UPDATE `users` SET `pk`=`pk`+'1' WHERE `id`='".$user_id."'");
}
$m='[blue]'.$datauser[name].'[/blue] vừa đánh [blue]'.$x[name].'[/blue] mất [red]'.$d.'[/red] HP';
mysql_query("INSERT INTO `pk` SET `user_id`='2', `text`='".mysql_real_escape_string($m)."', `time`='".time()."'");
$_SESSION['PK']=time()+999;
Header('Location: /vuichoi');
}Else{
Echo'<div class="omenu"><center><b><font color="red">LỖI !<br>ĐỐI THỦ ĐÃ RỜI TRẬN</font></b></center></div>';
}
Require('../incfiles/end.php');
