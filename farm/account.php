<?php
define('_IN_JOHNCMS', 1);
$headmod = 'farm-mem';
require_once('../incfiles/core.php');
include_once('funfarm.php');
$idnick = $_GET[id];
$nick = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='{$idnick}'"));
$textl = 'Khu vườn của '.$nick[name].'!';
require('../incfiles/head.php');
if ($user_id == $idnick) {
header('Location: /farm/');
}
if (!$user_id) {
header('Location: /');
}
echo'<div class="main-xmenu">';
echo'<div class="phdr">Khu Vườn Của '.$nick[name].'!</div>';
$thongtin = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='{$idnick}'"));
if(empty($thongtin[id])) {
header('Location: '.$home.'');
}
echo'<div class="dat">';
echo'<img src="icon/farm.png" alt="icon" style="vertical-align: 0px;"/>';
echo'<img src="/avatar/'.$idnick.'.png" alt="icon" style="vertical-align: 0px;"/>';
if($user_id) {
$k=mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_gr` WHERE `id_user` = '$idnick'"),0);
$res = mysql_query("select * from `fermer_gr` WHERE `id_user` = '$idnick' LIMIT 60"); 
echo'<div class="cola">';
while ($post = mysql_fetch_array($res)){
$semen=mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1"));
$p = mysql_fetch_array(mysql_query("select * from `fermer_gr` WHERE  `id` = '$post[id]'  LIMIT 1")); 
if($p['semen']!=0 && $time>$p['time'] && $p['kol']==0)
{
$pt=rand($semen['rand1'],$semen['rand2']);
if($post['woter']==0)$pt=floor($pt/2);
mysql_query("UPDATE `fermer_gr` SET `kol` = $pt WHERE `id` = '$post[id]' LIMIT 1");
}
if($post['semen']!=0)
echo "".$time_1."";
$nuatimeitem = $post['time_thuhoach']-$post['time_ki'];
$nuatime = $nuatimeitem/2;
$nuatimechin = $post['time']-$time;
$nuatimeitem2 = $nuatimeitem;
$timegieohat2 = $nuatimeitem2/2;
$timegieohat3 = $nuatimeitem2/4;
$timegieohat = $timegieohat2+$timegieohat3;
if($post['time']>0 && $post['time']<=$time){
echo'<a href="?id='.$idnick.'&view='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'-chin.png" alt="*" /></a>';
} else {
if ($post['semen'] == 0) {
echo'<a href="?id='.$idnick.'&view='.$post['id'].'#menu"><img id="raucu" src="icon/0.png" alt="*" /></a>';
} else {
if ($nuatime >= $nuatimechin) {
echo'<a href="?id='.$idnick.'&view='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'-uong.png" alt="*" /></a>';
} else {
if ($timegieohat <= $nuatimechin) {
echo'<a href="?id='.$idnick.'&view='.$post['id'].'#menu"><img id="raucu" src="icon/gieohat.png" alt="*" /></a>';
} else {
echo'<a href="?id='.$idnick.'&view='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'.png" alt="*" /></a>';
}
}
}
}
}
$muacho = mysql_fetch_array(mysql_query("SELECT * FROM `fermer_dog` WHERE `id_user`='{$idnick}'"));
if(!empty($muacho[id_user])) {
echo' <img src="icon/thunuoi/cho.png" alt="icon" style="vertical-align: 0px;"/></a>';
}
echo'</div>';
echo'</div>';
echo'</div>';
if(isset($_GET['muadat'])){
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Mua đất</div>';
if($datauser['xu']>=10000) {
echo '<div class="menu">';
echo "Mở thêm 1 đất bạn mất 10000 xu";
echo "<form method='post' action='?gr_add'>\n";
echo "<input type='submit' name='save' value='Mua!' />";
echo'</div>';
} else {
echo '<div class="menu list-top">Bạn phải đủ 10000 xu để mở ô đất mới</div>';
}
echo'</div>';
}
$int = intval($_GET['view']);
if ($int > 0) {
$muacho = mysql_fetch_array(mysql_query("SELECT * FROM `fermer_dog` WHERE `id_user`='{$idnick}'"));
echo'<div class="main-xmenu">';
echo'<div class="danhmuc">Thông tin rau củ</div>';
$post = mysql_fetch_array(mysql_query("select * from `fermer_gr` WHERE  `id` = '$int'  LIMIT 1")); 
if(isset($_GET['ok'])) {
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;border: 1px solid #e0e0e0;">Thành công !</div>';
}
if(isset($_GET['thuhoachxong'])) {
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;">Cây trồng đã được thu hoạch thành công !</div>';
}
if(isset($_GET['bonphan'])) {
echo'<div style="background-color: #DFF0D8;padding: 5px;margin-top: 5px;margin-bottom: 3px;">Bón phân thành công!</div>';
}
if(isset($_POST['sadit']) && $post['semen']==0)
{
$res = mysql_fetch_array(mysql_query("select * from `fermer_hatgiong` WHERE `id` = '$_POST[sadit]' ")); 
$semen = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE `id` = '$res[semen]' "));
$t=$time+$semen['time'];
mysql_query("UPDATE `fermer_gr` SET `semen` = $res[semen] WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time` = '$t' WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time_thuhoach` = '$t' WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time_ki` = '$time' WHERE `id` = $int LIMIT 1");
if($res['kol']>=2){
mysql_query("UPDATE `fermer_hatgiong` SET `kol` = `kol`-'1' WHERE `id` = $_POST[sadit] LIMIT 1");
}else{
mysql_query("DELETE FROM `fermer_hatgiong` WHERE `id` = $_POST[sadit] ");
}
header('Location: /farm/account.php?id='.$idnick.'&view='.$post['id'].'&ok');
}

if(isset($_POST['udobr'])) {
$res = mysql_fetch_array(mysql_query("select * from `fermer_udobr` WHERE `id` = '$_POST[udobr]' ")); 
$semen = mysql_fetch_array(mysql_query("select * from `fermer_udobr_name` WHERE `id` = '$res[udobr]' "));
mysql_query("UPDATE `fermer_gr` SET `time` = `time`- $semen[time] WHERE `id` = $int LIMIT 1");
if($res['kol']>=2){
mysql_query("UPDATE `fermer_udobr` SET `kol` = `kol`-'1' WHERE `id` = $_POST[udobr] LIMIT 1");
}else{
mysql_query("DELETE FROM `fermer_udobr` WHERE `id` = $_POST[udobr] ");
}
header("Location: /farm/account.php?id=".$idnick."&view=".$post[id]."&bonphan#menu");
}
if(isset($_GET['woter']) && $nickmem['woter']!=1){
mysql_query("UPDATE `fermer_gr` SET `woter` = '1' WHERE `id` = $int LIMIT 1");
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;border: 1px solid #e0e0e0;">Tưới nước thành công !</div>';
}
if($post){
//--Bắt đầu--//
if(isset($_GET['antromxong'])) {
echo'<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;">Cây trồng đã được ăn trộm thành công !</div>';
if(!empty($muacho[id_user])) {
$rand=rand(1,1000);
mysql_query("UPDATE `users` SET `tienxu` = `tienxu` - $rand WHERE `id` = $user_id LIMIT 1");
mysql_query("UPDATE `users` SET `tienxu` = `tienxu` + $rand WHERE `id` = $ank[id] LIMIT 1");
echo '<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;"><img src="icon/thunuoi/cho.png" alt="icon" style="vertical-align: 0px;"/> Bạn vừa bị một con chó tấn công đánh rơi mất '.$rand.' xu!</div>';
}
}
$semen=mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1")); 
$vremja= $post['time']-$time;
$timediff=$vremja;
$oneMinute=60; 
$oneHour=60*60; 
$oneDay=60*60*24; 
$dayfield=floor($timediff/$oneDay); 
$hourfield=floor(($timediff-$dayfield*$oneDay)/$oneHour); 
$minutefield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour)/$oneMinute); 
$secondfield=floor(($timediff-$dayfield*$oneDay-$hourfield*$oneHour-$minutefield*$oneMinute)); 
if($dayfield>0)$day=$dayfield.' ngày ';
if($post['semen']!=0){ 
if($time<$post['time'])$time_1=$day.$hourfield." giờ ".$minutefield." phút";
else$time_1=0;
}
$nuatimeitem = $post['time_thuhoach']-$post['time_ki'];
$nuatime = $nuatimeitem/2;
$nuatimechin = $post['time']-$time;
$nuatimeitem2 = $nuatimeitem;
$timegieohat2 = $nuatimeitem2/2;
$timegieohat3 = $nuatimeitem2/4;
$timegieohat = $timegieohat2+$timegieohat3;
if ($post['semen'] > 0) {
if($post['time']>0 && $post['time']<=$time){
echo'<img id="raucu" src="icon/'.$post['semen'].'-chin.png" alt="*" />';
} else {
if ($post['semen'] == 0) {
} else {
if ($nuatime >= $nuatimechin) {
echo'<img id="raucu" src="icon/'.$post['semen'].'-uong.png" alt="*" />';
} else {
if ($timegieohat <= $nuatimechin) {
echo'<img id="raucu" src="icon/gieohat.png" alt="*" />';
} else {
echo'<img id="raucu" src="icon/'.$post['semen'].'.png" alt="*" />';
}
}
}
echo'&#160;</td><td>';

if($time>$post['time']){
echo '<a href="/farm/?id='.$int.'&amp;thuhoach">[ <b>Thu hoạch</b> ]</a>';
}
if($time<$post['time']){
if($post['woter']==0){
echo '<a href="/farm/account.php?id='.$idnick.'&view='.$post[id].'&amp;woter"><img src="/icon/tuoinuoc.gif" alt="*" /></a><br/>';
} else { 
echo'Đã tưới nước<br/>';
}
echo'[ <b>'.htmlspecialchars($semen['name']).'</b> ]&#160;';
echo'Còn '.$time_1.' thu hoạch';
}
echo'</td></tr></table>';
}
}
if($post['semen']!=0){
if($post['semen']!=0 && $time>$post['time'] && $post['kol']==0)
{
$pt=rand($semen['rand1'],$semen['rand2']);
if($post['woter']==0)$pt=floor($pt/2);
mysql_query("UPDATE `fermer_gr` SET `kol` = $pt WHERE `id` = $int LIMIT 1");
}
if($time<$post['time']){
$k2=mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_udobr` WHERE `id_user` = '$user_id'"),0);
if($k2!=0){
$res2 = mysql_query("select * from `fermer_udobr` WHERE `id_user` = '$user_id' "); 
echo '<div class="menu">
<form method="post" action="/farm/account.php?id='.$idnick.'&view='.$post[id].'">
<select name="udobr">';
while ($post2 = mysql_fetch_array($res2)){
$semen2=mysql_fetch_array(mysql_query("select * from `fermer_udobr_name` WHERE  `id` = '$post2[udobr]'  LIMIT 1")); 
echo "<option value='".$post2['id']."'>".htmlspecialchars($semen2['name'])." [".$post2['kol']."]</option>";
}
echo "</select><br />\n";
echo "<input type='submit' name='save' value='Bón phân' />\n";
echo "</form>\n";
echo "</div>";
}else{
echo "<div class='menu'>";
echo '<select name="cad" disabled="disabled" >
<option value="0" selected="selected">Không có phân bón!</option>
</select>';
echo "</div>";
}
}else{
$dohod=$post['kol']*$semen['dohod'];
if(isset($_GET['thuhoach']) && $idnick==$post['id_user'] && $post['semen']!=0 && $post['time']<$time) {
mysql_query("UPDATE `users` SET `tienxu` = `tienxu`+ $dohod WHERE `id` = $id_user LIMIT 1");
mysql_query("UPDATE `users` SET `fermer_oput` = `fermer_oput`+ '".$semen['oput']."' WHERE `id` = $id_user LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `semen` = '0' WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time` = NULL WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `kol` = '0' WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = $int LIMIT 1");
header("Location: ?id=".$int."&thuhoachxong");
}
echo'<b>'.htmlspecialchars($semen['name']).'</b><br/>';
echo"Sản lượng: <b>".$post['kol']."</b> <br/>";
if(!isset($_GET['antromxong'])) {
$idtrom =intval($_GET['trom']);
$trom = mysql_fetch_assoc(mysql_query("SELECT * FROM `fermer_vor` WHERE `gr` = '".$post[id]."' LIMIT 1"));
if($trom['time']<$time){
if(!isset($_GET['antromxong'])) {
if ($post['antrom'] == '1') {
echo '<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;border: 1px solid #f0f0f0;">Cây đã bi ăn trộm rồi !</div>';
} else {
echo '<a href="/farm/account.php?id='.$idnick.'&view='.$post['id'].'&trom='.$post['id'].'">[ <b>Ăn trộm</b> ]</a>';
}
}
}else{
echo '<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;border: 1px solid #f0f0f0;">Bạn đã ăn trộm nông sản của bạn này rồi !</div>';
}
}
}
}else{
$k=mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_hatgiong` WHERE `id_user` = '$user_id'"),0);
if($k!=0){
$res = mysql_query("select * from `fermer_hatgiong` WHERE `id_user` = '$user_id' ORDER BY `id` "); 
echo "<div class='menu'>";
echo "<form method='post' action='/farm/account.php?id=".$idnick."&view=".$post[id]."'>\n";
echo "<select name='sadit'>";
while ($post = mysql_fetch_array($res)){
$semen=mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[semen]' LIMIT 1")); 
$name_gr=$semen['name'];
echo "<option value='".$post['id']."'>".$name_gr." [".$post['kol']."]</option>";
}
echo "</select><br />\n";
echo "<input type='submit' name='save' value='Gieo hạt giống' />\n";
echo "</form>\n";
echo "</div>";
}else{
echo '<div class="menu">
<select name="cad" disabled="disabled" ><br />
<option value="0" selected="selected">Không có hạt giống nào!</option>
</select></div>';
}
}





$ank = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='$idnick' LIMIT 1"));
if(isset($_GET['trom'])){
$vor=intval($_GET['trom']);
if($user_id) {
# Ham xac thuc
if(!$vor){
echo '<div class="ferma_menu">Chưa có người chơi nào!</div>';
echo "<div class='ferma_rekl'>";
echo "&laquo; <a href='fermers.php'>Hàng xóm</a><br/>";
echo "&laquo; <a href='index.php'>Trang chủ</a><br/>";
echo "</div>";
require('../incfiles/end.php');
exit;
}
# Kiem tra cac item
$sql=mysql_query("SELECT `id` FROM `fermer_gr` WHERE `id`='$vor' ");
$row=mysql_fetch_assoc($sql);
if(!mysql_num_rows($sql)){
echo '<div class="ferma_menu">Không có bản vá đó!</div>';
echo "<div class='ferma_rekl'>";
echo "&laquo; <a href='fermers.php'>Hàng xóm</a><br/>";
echo "&laquo; <a href='index.php'>Trang chủ</a><br/>";
echo "</div>";require('../incfiles/end.php');
exit;
}
$gr = mysql_fetch_array(mysql_query("select * from `fermer_gr` WHERE `id` ='$vor' "));
$semen = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE `id` = '$gr[semen]' "));
$qi = mysql_fetch_assoc(mysql_query("SELECT * FROM `fermer_vor` WHERE `id_user` = '$user_id'  AND `gr` = '$vor' LIMIT 1"));
if($qi['time']<$time){
$rand1=floor($semen['rand1']/5);
$rand2=floor($semen['rand2']/5);
$rand=rand($rand1,$rand2);
mysql_query("INSERT INTO `fermer_vor` (`id_user` , `gr`, `time`) VALUES  ('".$user_id."', '".$vor."', '".$t."') ");
mysql_query("UPDATE `users` SET `fermer_oput` = `fermer_oput`- '10' WHERE `id` = $user_id LIMIT 1");
if($gr['kol']>$rand){
mysql_query("UPDATE `fermer_gr` SET `kol` = `kol`- $rand WHERE `id` = $vor LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `antrom` = '1' WHERE `id` = '".$post['id']."' LIMIT 1");
$remils = mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '$gr[semen]'"),0);
if($remils>0) mysql_query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".$rand."' WHERE `id_user` = $user_id AND `semen` = '$gr[semen]' LIMIT 1");
else mysql_query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".$rand."', '".$gr['semen']."', '".$user_id."') ");
}else{
$rand=mysql_result(mysql_query("SELECT `kol` FROM `fermer_gr` WHERE `id` = $_GET[vor] "),0);
mysql_query("UPDATE `fermer_gr` SET `semen` = '0' WHERE `id` = $vor LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time_ki` = NULL WHERE `id` = $vor LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time` = NULL WHERE `id` = $vor LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `kol` = NULL WHERE `id` = $vor LIMIT 1");
$remils = mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '$gr[semen]'"),0);
if($remils>0) mysql_query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".$rand."' WHERE `id_user` = $user_id AND `semen` = '$gr[semen]' LIMIT 1");
else mysql_query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".$rand."', '".$gr['semen']."', '".$user_id."') ");
}
$se=mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$gr[semen]'  LIMIT 1"));
$noticearena = 
mysql_result(mysql_query("SELECT COUNT(*) 
FROM `notice` WHERE
`user_id` = '".$idnick."' AND 
`user_fr` = '".$user_id."' AND 
`sid` = '".$idnick."' AND 
`view` = '0' AND 
`type` = 'h'
"), 0);

if($noticearena == 0) {
mysql_query("INSERT INTO `notice` SET
`user_id` = '$idnick',
`user_fr` = '".$user_id."',
`sid` = '".$idnick."',
`time` = '" . time() . "',
`type` = 'h'
");
mysql_query("UPDATE `users` SET `thongbaocanhan`= `thongbaocanhan` + '1' WHERE `id`='".$idnick."'");
}
header('Location: /farm/account.php?id='.$idnick.'&view='.$post[id].'&antromxong#menu');
require('../incfiles/end.php');
exit;
}
}else{
echo '<div style="background-color: #DFF0D8;padding: 3px;margin-top: 5px;margin-bottom: 3px;border: 1px solid #f0f0f0;">Bạn đã ăn trộm nông sản của bạn này rồi !</div>';
}
}
//--END--//
echo'</div>';
}
}

} else {
header('Location: /');
}
echo'<a name="menu" id="menu"></a>';

echo'<div><div>';
require('../incfiles/end.php');

?>