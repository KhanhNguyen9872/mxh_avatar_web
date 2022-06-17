<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
if (isset($_COOKIE['the']))
{
$the = $_COOKIE['the'];
}
elseif (!$is_mobile)
{
$the = 'web';
} else {
$the = 'wap';
}
////////CODE WEB Ở ĐÂY
if ($the == 'web')
{
$id=(int)$_GET[id];
$q=mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'");
$num=mysql_num_rows($q);
$post=mysql_fetch_array($q);
if ($num>0) {
$textl='Đánh nhau với '.$post[name].'';
}
require('../incfiles/head.php');
echo '<div class="newsss" style="height:155px">';
if ($num<1) {
echo '<div class="phdr">Lỗi</div>';
echo '<div class="rmenu">Thành viên không tồn tại</div>';
} else if($id==$user_id) {
echo '<div class="phdr">Lỗi</div>';
echo '<div class="rmenu">Bạn không thể tự đánh chính mình</div>';
} else {
echo '<div class="phdr"><center>'.$textl.'</center></div>';
echo'<label style="display: inline-block;text-align: center;"><img src="'.$home.'/avatar/'.$user_id.'.png" style="position:absolute;margin:10px 0 0 250px"/>';
echo' <img src="/icon/iconxoan/iconpk.png" alt="icon" style="position:absolute;margin:30px 0 0 310px"/> ';
echo'<img src="'.$home.'/avatar/'.$post[id].'.png" class="xavt" style="position:absolute;margin:10px 0 0 350px"/>';
if (isset($_POST[submit])) {
if ($post[hp]<=0) {
echo '<div class="list1">Đối thủ đã kiệt sức!</div>';
} else if ($datauser[hp]<=0) {
echo '<div class="list1">Bạn đã hết HP hãy hồi phục!</div>';
} else {
$sd1=rand($post[sucmanh]/100*10,($post[sucmanh] + ($post[hpfull]*10/100)));
$sd2=rand($datauser[sucmanh]/100*10,($datauser[sucmanh] + ($datauser[hpfull]*10/100)));
$nd=array("tát","đá","thông","đấm vào mặt","hét","ném dép","đạp","quất");
$rnd=rand(0,7);
$rnd2=rand(0,7);
mysql_query("UPDATE `users` SET `hp`=`hp`-'".$sd1."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `users` SET `hp`=`hp`-'".$sd2."' WHERE `id`='".$post[id]."'");
if ($sd1>$datauser[hp]) {
$nd='[img]/icon/iconxoan/iconpk.png[/img][b][red]'.$post[name].'[/red][/b] [blue]đã hạ gục[/blue] [b][red]'.$datauser[name].'[/red][/b] ';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($nd) . "', `time`='".time()."'");
}
if ($sd2>$post[hp]) {
$nd='[img]/icon/iconxoan/iconpk.png[/img][b][red]'.$datauser[name].'[/red][/b] [blue]đã hạ gục[/blue] [b][red]'.$post[name].'[/red][/b] ';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($nd) . "', `time`='".time()."'");
}
echo '<br/><img src="/images/danhnhau.gif" style="position:absolute;margin:-8px 0 0 300px"/><br/>';
echo '<div class="newss"><img src="/icon/iconxoan/iconpk.png"> Bạn đã <font color="blue"><b>'.$nd[$rnd].'</b></font> '.nick($post[id]).' làm '.nick($post[id]).' mất <font color="red">'.$sd2.' HP</font></div>';
echo '<div class="newss"><img src="/icon/iconxoan/iconpk.png"> '.nick($post[id]).' <font color="green"><b>'.$nd[$rnd2].'</b></font> lại bạn, làm bạn mất <font color="red">'.$sd1.' HP</font></div>';
/*
$randsk=rand(1,3);
if ($randsk==1) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='38' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/38.png"> <b>Bạn đã nhận được <b>ngọc ánh sáng</b>';
}
*/
}
}
echo '<form method="post"><input type="submit" name="submit" value="Đánh" class="buttonxoan"/></form></label>'; 
}
echo '</div>';
}
////////CODE WAP Ở ĐÂY
if ($the == 'wap')
{
$id=(int)$_GET[id];
$q=mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'");
$num=mysql_num_rows($q);
$post=mysql_fetch_array($q);
if ($num>0) {
$textl='Đánh nhau với '.$post[name].'';
}
require('../incfiles/head.php');
echo '<div class="newsss" style="height:155px">';
if ($num<1) {
echo '<div class="phdr">Lỗi</div>';
echo '<div class="rmenu">Thành viên không tồn tại</div>';
} else if($id==$user_id) {
echo '<div class="phdr">Lỗi</div>';
echo '<div class="rmenu">Bạn không thể tự đánh chính mình</div>';
} else {
echo '<div class="phdr"><center>'.$textl.'</center></div>';
echo'<label style="display: inline-block;text-align: center;"><img src="'.$home.'/avatar/'.$user_id.'.png"/>';
echo' <img src="/icon/iconxoan/iconpk.png" alt="icon"/> ';
echo'<img src="'.$home.'/avatar/'.$post[id].'.png" class="xavt"/>';
if (isset($_POST[submit])) {
if ($post[hp]<=0) {
echo '<div class="list1">Đối thủ đã kiệt sức!</div>';
} else if ($datauser[hp]<=0) {
echo '<div class="list1">Bạn đã hết HP hãy hồi phục!</div>';
} else {
$sd1=rand($post[sucmanh]/100*10,($post[sucmanh] + ($post[hpfull]*10/100)));
$sd2=rand($datauser[sucmanh]/100*10,($datauser[sucmanh] + ($datauser[hpfull]*10/100)));
$nd=array("tát","đá","thông","đấm vào mặt","hét","ném dép","đạp","quất");
$rnd=rand(0,7);
$rnd2=rand(0,7);
mysql_query("UPDATE `users` SET `hp`=`hp`-'".$sd1."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `users` SET `hp`=`hp`-'".$sd2."' WHERE `id`='".$post[id]."'");
if ($sd1>$datauser[hp]) {
$nd='[img]/icon/iconxoan/iconpk.png[/img][b][red]'.$post[name].'[/red][/b] [blue]đã hạ gục[/blue] [b][red]'.$datauser[name].'[/red][/b] ';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($nd) . "', `time`='".time()."'");
}
if ($sd2>$post[hp]) {
$nd='[img]/icon/iconxoan/iconpk.png[/img][b][red]'.$datauser[name].'[/red][/b] [blue]đã hạ gục[/blue] [b][red]'.$post[name].'[/red][/b] ';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($nd) . "', `time`='".time()."'");
}
echo '<br/><img src="/images/danhnhau.gif" style="position:absolute;margin:-8px 0 0 300px"/><br/>';
echo '<div class="newss"><img src="/icon/iconxoan/iconpk.png"> Bạn đã <font color="blue"><b>'.$nd[$rnd].'</b></font> '.nick($post[id]).' làm '.nick($post[id]).' mất <font color="red">'.$sd2.' HP</font></div>';
echo '<div class="newss"><img src="/icon/iconxoan/iconpk.png"> '.nick($post[id]).' <font color="green"><b>'.$nd[$rnd2].'</b></font> lại bạn, làm bạn mất <font color="red">'.$sd1.' HP</font></div>';
/*
$randsk=rand(1,3);
if ($randsk==1) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='38' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/38.png"> <b>Bạn đã nhận được <b>ngọc ánh sáng</b>';
}
*/
}
}
echo '<form method="post"><input type="submit" name="submit" value="Đánh" class="buttonxoan"/></form></label>'; 
}
echo '</div>';
}
require('../incfiles/end.php');
?>
                            