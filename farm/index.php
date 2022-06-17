<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
include_once('funfarm.php');
$textl = 'Nông trại Online';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
include'sys/xem.php';

include'autofarm.php';
include'sys/tienhoa.php';
echo'<div class="main-xmenu">';
echo'<div class="phdr"><center>Nông Trại</center></div><div class="cola">';
if ($demvn1 > 0 || $demvn2 > 0 || $demvn3 > 0 || $demvn4 > 0 || $demvn5 > 0) {
if ($timevn1[tinhtrang] == 1 || $timevn2[tinhtrang] == 1 || $timevn3[tinhtrang] == 1 || $timevn4[tinhtrang] == 1 || $timevn5[tinhtrang] == 1) {
echo '<div class="menu list-bottom congdong">';
if ($demvn2 > 0 || $demvn3 > 0 || $demvn4 > 0) {
if ($timevn2[tinhtrang] == 1 || $timevn3[tinhtrang] == 1 || $timevn4[tinhtrang] == 1) {
echo'<a href="/farm/?choheocuuboan"><input type="button" value="Cho Heo, Cừu, Bò ăn" class="nut"/></a>';

}
}
if ($demvn1 > 0) {
if ($timevn1[tinhtrang] == 1) {
echo'<a href="/farm/?chogaan"><input type="button" value="Cho Gà ăn" class="nut"/></a>';
}
}
if ($demvn5 > 0) {
if ($timevn5[tinhtrang] == 1) {
echo'<a href="/farm/?chocaan"><input type="button" value="Cho Cá ăn" class="nut"/></a>';
}
}
echo'</div>';
}
}
include'sys/thuhoachsanluong.php';
include'sys/sanluong.php';
include'sys/thoigiansong.php';
?>
<script type="text/javascript">
    function toggle(source) {
      checkboxes = document.getElementsByName('dattrong[]');
      for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
      }
    }
</script>
<?php
echo'<div class="dat" style="margin-bottom: 3px">';
echo'<a href="/farm/?xem"><img src="icon/farm.png" alt="icon" style="vertical-align: 0px;"/></a>';
echo'<a href="/farm/shop.php"><img src="../icon/cuahangfarm.png" style="vertical-align: -8px;"></a> <a href="nhakho.php"><img src="icon/nhakho.png" alt="icon" style="vertical-align: -5px;"/></a> <a href="/farm/nhabep/"><img src="icon/nhabep.png" alt="icon" style="vertical-align: -5px;"/></a>';  


if (($datauser[timethuhoachkhe] + 3600) < $time) {
echo' <a href="thuhoachkhe.php"><img src="/icon/caykhechin.png" alt="icon" style="vertical-align: -5px;"/></a>'; 

} else {
echo' <a href="thuhoachkhe.php"><img src="/icon/caykhe.png" alt="icon" style="vertical-align: -5px;"/></a>';
} 
 
echo'</div>';
  
if($user_id) {

echo'<form method="post">';
$tongodat =mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_gr` WHERE `id_user` = '$user_id'"),0);
$res = mysql_query("select * from `fermer_gr` WHERE `id_user` = '$user_id' LIMIT 60"); 
echo'<div class="cola" style="margin-top: 5px">';
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
 

 
echo'<label style="display: inline-block;text-align: center;">';
if($post['time']>0 && $post['time']<=$time){
echo'<a href="?id='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'-chin.png" alt="*" /></a>';
} else {
if ($post['semen'] == 0) {
echo'<img id="raucu" src="icon/0.png" alt="*" />';
} else {
if ($nuatime >= $nuatimechin) {
//echo'<a href="?id='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'-uong.png" alt="*" /></a>';
echo'<img id="raucu" src="icon/'.$post['semen'].'-uong.png" alt="*" />';
} else {
if ($timegieohat <= $nuatimechin) {
//echo'<a href="?id='.$post['id'].'#menu"><img id="raucu" src="icon/gieohat.png" alt="*" /></a>';
echo'<img id="raucu" src="icon/gieohat.png" alt="*" />';
} else {
//echo'<a href="?id='.$post['id'].'#menu"><img id="raucu" src="icon/'.$post['semen'].'.png" alt="*" /></a>';
echo'<img id="raucu" src="icon/'.$post['semen'].'.png" alt="*" />';
}
}
}
} 
 

  
echo'<br /><input type="checkbox" name="dattrong[]" value="'.$post['id'].'" id="checkItem"></label>';
}
if ($tongodat <= 60) {
if(!isset($_GET['muadat'])){
echo' <a href="?muadat"><img src="/icon/muadat.png" alt="icon" style="vertical-align: 0px;"/></a>';
}

}
  echo '<a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a>';   
echo'</div>';
include'sys/nuoigiasuc.php';
include'sys/choan.php'; 
  
     

echo'<center><form> 

<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br>
<div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br>
<div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form>';
 
echo'</div>'; 

  
echo'</div>';
include'sys/muadat.php'; 
 
echo'<div><div class="main-xmenu">';
echo'<div class="phdr">Auto Nông Trại</div>';
echo'<div class="lucifer"><div class="menu"><input type="checkbox" onclick="toggle(this)">Tất cả ';
echo '<select name="sadit">';
$res = mysql_query("select * from `fermer_hatgiong` WHERE `id_user` = '$user_id' ORDER BY `id` "); 
while ($post = mysql_fetch_array($res)){
$semen=mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[semen]' LIMIT 1")); 
$name_gr= $semen['name'];
echo "<option value='".$post['id']."'>".$name_gr." [".$post['kol']."]</option>";
}
echo'</select>
<input type="submit" name="gieohat" value="Gieo hạt"><input type="submit" name="tuoinuoc" value="Tưới nước"><input type="submit" name="thuhoach" value="Thu hoạch">';
$k2=mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_udobr` WHERE `id_user` = '$user_id'"),0);
if($k2!=0){
$res2 = mysql_query("select * from `fermer_udobr` WHERE `id_user` = '$user_id' "); 
echo '
<select name="udobr">';
while ($post2 = mysql_fetch_array($res2)){
$semen2=mysql_fetch_array(mysql_query("select * from `fermer_udobr_name` WHERE  `id` = '$post2[udobr]'  LIMIT 1")); 
echo "<option value='".$post2['id']."'>".htmlspecialchars($semen2['name'])." [".$post2['kol']."]</option>";
}
echo "</select>\n";
echo "<input type='submit' name='bonall' value='Bón phân' />\n";
}else{
echo '<select name="cad" disabled="disabled" >
<option value="0" selected="selected">Không có phân bón!</option>
</select>';
}
echo'</form>';
echo'</div>';
echo'</div>';

$int = intval($_GET['id']);
if ($int > 0) {
echo'<div class="main-xmenu">';
echo'<div class="phdr">Thông tin rau củ</div>';
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
if(isset($_POST['sadit']) && $post && $user_id==$post['id_user'] && $post['semen']==0)
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
header("Location: ?id=".$int."");
}

if(isset($_POST['udobr']) && $post && $user_id==$post['id_user'] && $post['semen']!=0)
{
$res = mysql_fetch_array(mysql_query("select * from `fermer_udobr` WHERE `id` = '$_POST[udobr]' ")); 
$semen = mysql_fetch_array(mysql_query("select * from `fermer_udobr_name` WHERE `id` = '$res[udobr]' "));
mysql_query("UPDATE `fermer_gr` SET `time` = `time`- $semen[time] WHERE `id` = $int LIMIT 1");
if($res['kol']>=2){
mysql_query("UPDATE `fermer_udobr` SET `kol` = `kol`-'1' WHERE `id` = $_POST[udobr] LIMIT 1");
}else{
mysql_query("DELETE FROM `fermer_udobr` WHERE `id` = $_POST[udobr] ");
}
header("Location: ?id=".$int."&bonphan#menu");
}
if($post){
if($user_id == $post['id_user']){
//--Bắt đầu--//
$semen=mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1")); 
if($post['semen']==0){$name_gr='Ô đất trống';}else{$name_gr=$semen['name'];}
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
if($time>$post['time']){
echo '<a href="/farm/?id='.$int.'&amp;thuhoach">[ <b>Thu hoạch</b> ]</a>';
}
if($time<$post['time']){
echo' <b>'.htmlspecialchars($semen['name']).'</b>&#160;';
echo'Còn '.$time_1.' thu hoạch';
if($post['woter']==0){
echo'&#160;<a href="/farm/?id='.$int.'&amp;woter">[<b>Tưới nước</b>]</a>';
} else { 
echo'&#160;<span style="color:#008000;">[Đã tưới nước]</span><br/>';
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
<form method="post" action="/farm/?id='.$int.'">
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
if(isset($_GET['thuhoach']) && $user_id==$post['id_user'] && $post['semen']!=0 && $post['time']<$time) {
mysql_query("UPDATE `users` SET `xu` = `xu`+ $dohod WHERE `id` = $user_id LIMIT 1");
mysql_query("UPDATE `users` SET `fermer_oput` = `fermer_oput`+ '".$semen['oput']."' WHERE `id` = $user_id LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `semen` = '0' WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time` = NULL WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `kol` = '0' WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `antrom` = '0' WHERE `id` = $int LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = $int LIMIT 1");
header("Location: ?id=".$int."&thuhoachxong");
}
echo "<div class='menu'>";
echo'[ <b>'.htmlspecialchars($semen['name']).'</b> ]<br/>';
echo"Sản lượng: <b>".$post['kol']."</b> <br/>";
if($post['woter']==0)echo "*Bạn đã bị mất một nửa sản lượng do không chịu tưới nước cho cây phát triển! <br/>";
echo "Giá cho mỗi sản lượng: <b>".$semen['dohod']."</b> <br/>";
echo "Tổng doanh thu: <b>".$dohod."</b> xu</div>";
echo '<a href="/farm/?id='.$int.'&amp;thuhoach">[ <b>Thu hoạch</b> ]</a>';
}
}else{
$k=mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_hatgiong` WHERE `id_user` = '$user_id'"),0);
if($k!=0){
$res = mysql_query("select * from `fermer_hatgiong` WHERE `id_user` = '$user_id' ORDER BY `id` "); 
echo "<div class='menu'>";
echo "<form method='post' action='/farm/?id=".$int."&amp;ok'>\n";
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
//--END--//
} else {
echo "<div class='menu'>Đây không phải là đất của bạn";}
}
echo'</div>';
}
}
echo'';
require('../incfiles/end.php');
?>
                            