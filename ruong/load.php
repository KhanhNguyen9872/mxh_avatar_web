<?php
define('_IN_JOHNCMS',1);
header('Content-Type: text/html; charset=utf-8');
require('../incfiles/core.php');
$vp=(int)$_POST[vp];
$q=mysql_query("SELECT * FROM `khodo` WHERE `id`='".$vp."' AND `user_id`='".$user_id."'");
$check=mysql_num_rows($q);
if ($check<1) {
echo '<div class="rmenu">Bạn không có vật phẩm này!</div>';
} else {
$ok=mysql_fetch_array($q);
$dch=mysql_num_rows(mysql_query("SELECT * FROM `vatpham` WHERE (`id_shop`='8' OR `id_shop`='9' OR `id_shop`='10' OR `id_shop`='11') AND `soluong`>'0' AND `user_id`='".$user_id."'"));
echo '<div class="phdr">Cường hóa vật phẩm</div>';
if (isset($_POST[submit])) {
$da=(int)$_POST[dch];
$que=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id`='".$da."'");
$bug=mysql_num_rows($que);
$pro=mysql_fetch_array($que);
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopvatpham` WHERE `id`='".$pro[id_shop]."'"));
if ($bug<1) {
echo '<div class="rmenu">ERROR!!!</div>';
} else if ($pro[id_shop]!=8&&$pro[id_shop]!=9&&$pro[id_shop]!=10&&$pro[id_shop]!=11) {
echo '<div class="rmenu">Đây không phải là đá cường hóa</div>';
} else if ($pro[soluong]<=0) {
echo '<div class="rmenu">Hết đá cường hóa rồi nhé!</div>';
} else {
$rand=(1+$ok[cong])*2;
$randhp=(1+$ok[conghp])*2;
$tile=rand(1,$rand);
$tilehp=rand(1,$randhp);
if ($pro[id_shop]==8||$pro[id_shop]==9) {
$smchia = $shop['tangsucmanh']/2;
$smchianho = $smchia/2;
$sm = $shop['tangsucmanh']-$smchia+$smchianho;
$randsm=rand($sm,$shop[tangsucmanh]);
$thanhcongsm=round($tile/2);
if ($tile==$thanhcongsm) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$pro[id_shop]."'");
mysql_query("UPDATE `khodo` SET `sucmanh`=`sucmanh`+'".$randsm."',`cong`=`cong`+'1' WHERE `user_id`='".$user_id."' AND `id`='".$vp."'");
echo '<div class="gmenu">Chúc mừng bạn đã cường hóa thành công vật phẩm <b>'.$ok[tenvatpham].'</b>, vật phẩm tăng thêm <b>'.$randsm.' SM</b></div>';
} else {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$pro[id_shop]."'");
echo '<div class="rmenu">Cường hóa thất bại!</div>';
}
} else if ($pro[id_shop]==10||$pro[id_shop]==11) {
$hpchia = $shop['tanghp']/2;
$hpchianho = $hpchia/2;
$hp = $shop['tanghp']-$hpchia+$hpchianho;
$randhp=rand($hp,$shop[tanghp]);
$thanhconghp=round($tilehp/2);
if ($tilehp==$thanhconghp) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$pro[id_shop]."'");
mysql_query("UPDATE `khodo` SET `hp`=`hp`+'".$randhp."',`conghp`=`conghp`+'1' WHERE `user_id`='".$user_id."' AND `id`='".$vp."'");
echo '<div class="gmenu">Chúc mừng bạn đã cường hóa thành công vật phẩm <b>'.$ok[tenvatpham].'</b>, vật phẩm tăng thêm <b>'.$randhp.' HP</b></div>';
} else {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$pro[id_shop]."'");
echo '<div class="rmenu">Cường hóa thất bại!</div>';
}
}
}
}
echo '<form method="post"><input type="hidden" id="item" value="'.$vp.'"><img src="/images/shop/'.$ok[id_shop].'.png" class="avatar_vina"><b><font color="green">['.$ok[tenvatpham].']</font></b><br/>';
if ($dch<1) {
echo '<select disabled="disabled">
<option selected="selected">Không có đá cường hóa!</option>
</select><br/>';
echo '<input type="button" value="Cường hóa">';
} else {
$lay=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `soluong`>'0' AND (`id_shop`='8' OR `id_shop`='9' OR `id_shop`='10' OR `id_shop`='11')");
echo '<select name="dacuonghoa">';
while ($in=mysql_fetch_array($lay)) {
$n=mysql_fetch_array(mysql_query("SELECT * FROM `shopvatpham` WHERE `id`='".$in[id_shop]."'"));
echo '<option value="'.$in[id].'" '.($da==$in[id]?'selected="selected"':'').'"> '.$n[tenvatpham].' ['.$in[soluong].' viên]</option>';
}
echo '</select><br/>';
echo '<input type="submit" name="submit" id="cuonghoa" value="Cường hóa">';
}
echo '</form>';
}
?>