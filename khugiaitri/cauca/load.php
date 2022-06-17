<?php
define('_IN_JOHNCMS',1);
header('Content-Type: text/html; charset=utf-8');
require('../../incfiles/core.php');
$rescc1 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id` = '".$user_id."' AND `id_shop`='5' LIMIT 1"));
$rescc2 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id` = '".$user_id."' AND `id_shop`='6' LIMIT 1"));
$rescc3 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id` = '".$user_id."' AND `id_shop`='7' LIMIT 1"));
$rtg=rand(5,10);
if (isset($_GET['tung_3'])) {
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'".$rtg."' WHERE `id`='".$user_id."'");
header('Location: load.php?reload3');
exit;
}
if (isset($_GET['tung_2'])) {
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'".$rtg."' WHERE `id`='".$user_id."'");
header('Location: load.php?reload2');
exit;
}
if (isset($_GET['tung_1'])) {
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'".$rtg."' WHERE `id`='".$user_id."'");
header('Location: load.php?reload1');
exit;
}
if (isset($_POST['sub_3'])) {
if ($rescc3['soluong']<1) {
echo '<div class="rmenu">Bạn đã hết mồi rồi, hãy quay lại <br/><a href="shop.php"><b>Cửa Hàng</b></a> để mua thêm mồi nhé!</div>';
} else {
if ($datauser[lastpost]>time()) {
$wait=$datauser[lastpost]-time();
echo '- Đợi <b>'.$wait.' s</b> nữa để cá cắn câu rồi giật lên! <input type="button" value="Reload" id="clickme_3">';
} else {
$mayman=rand(1,3);
if ($mayman==1) {
$ca=mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id`='3'"));
$kg=rand($ca[kg_min],$ca[kg_max]);
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='7'");
mysql_query("UPDATE `fish_ruong` SET `kg`=`kg`+'".$kg."' WHERE `user_id`='".$user_id."' AND `id_ca`='".$ca[id]."'");
mysql_query("UPDATE `fish_r` SET `soluong`=`soluong`-'1' WHERE `id`='".$ca[id]."'");
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'".$rtg."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `users` SET `soca` = `soca` + '1' WHERE `id` = '".$user_id."'");
$checknv=mysql_num_rows(mysql_query("SELECT * FROM `nhiemvu_user` WHERE `user_id`='".$user_id."' AND `id_nv`='1'"));
if ($checknv>0) {
mysql_query("UPDATE `nhiemvu_user` SET `tiendo`=`tiendo`+'1' WHERE `user_id`='".$user_id."' AND `id_nv`='1'");
}

$randsk=rand(1,3);
if ($randsk==1) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='47' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/47.png"> Bạn đã câu trúng 1 Shuriken<br/>';
}

$randnro = rand(1,5);
if ($randnro == 1) {
$randv = rand(1,2);
if ($randv == 1) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='19' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/19.png"> Bạn đã nhận được ngọc 7 sao<br/>';
} else if ($randv == 2) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='18' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/18.png"> Bạn đã nhận được ngọc 6 sao<br/>';
}
}
echo '<img src="img/3.png"> Bạn đã câu được 1 con cá mập nặng '.$kg.' KG';
?>
<script language="javascript">
	$(document).ready(function(){
		$('img[alt="icon"]').attr('src','/icon/cacancau.png').css('verticalAlign','-6px');
	});
</script>
<?php
} else {
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'5' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='7'");
echo 'Trình độ của bạn kém quá, nó chạy mất rồi!';
}
}
echo '<a id="tung_3" href="#"><b>[Tung cần câu]</b></a>';
}
}
//
if (isset($_POST['sub_2'])) {
if ($rescc2['soluong']<1) {
echo '<div class="rmenu">Bạn đã hết mồi rồi, hãy quay lại <br/><a href="shop.php"><b>Cửa Hàng</b></a> để mua thêm mồi nhé!</div>';
} else {
if ($datauser[lastpost]>time()) {
$wait=$datauser[lastpost]-time();
echo '- Đợi <b>'.$wait.' s</b> nữa để cá cắn câu rồi giật lên! <input type="button" value="Reload" id="clickme_2">';
} else {
$mayman=rand(1,3);
if ($mayman==1) {
$ca=mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id`='2'"));
$kg=rand($ca[kg_min],$ca[kg_max]);
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='6'");
mysql_query("UPDATE `fish_ruong` SET `kg`=`kg`+'".$kg."' WHERE `user_id`='".$user_id."' AND `id_ca`='".$ca[id]."'");
mysql_query("UPDATE `fish_r` SET `soluong`=`soluong`-'1' WHERE `id`='".$ca[id]."'");
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'".$rtg."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `users` SET `soca` = `soca` + '1' WHERE `id` = '".$user_id."'");
$checknv=mysql_num_rows(mysql_query("SELECT * FROM `nhiemvu_user` WHERE `user_id`='".$user_id."' AND `id_nv`='1'"));
if ($checknv>0) {
mysql_query("UPDATE `nhiemvu_user` SET `tiendo`=`tiendo`+'1' WHERE `user_id`='".$user_id."' AND `id_nv`='1'");
}

$randsk=rand(1,3);
if ($randsk==1) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='47' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/47.png"> Bạn đã câu trúng 1 Shuriken<br/>';
}

$randnro = rand(1,5);
if ($randnro == 1) {
$randv = rand(1,2);
if ($randv == 1) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='19' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/19.png"> Bạn đã nhận được ngọc 7 sao<br/>';
} else if ($randv == 2) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='18' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/18.png"> Bạn đã nhận được ngọc 6 sao<br/>';
}
}
echo '<img src="img/2.png"> Bạn đã câu được 1 con lòng tong nặng '.$kg.' KG';
?>
<script language="javascript">
	$(document).ready(function(){
		$('img[alt="icon"]').attr('src','/icon/cacancau.png').css('verticalAlign','-6px');
	});
</script>
<?php
} else {
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'5' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='6'");
echo 'Trình độ của bạn kém quá, nó chạy mất rồi!';
}
}
echo '<a id="tung_2" href="#"><b>[Tung cần câu]</b></a>';
}
}
//
if (isset($_POST['sub_1'])) {
if ($rescc1['soluong']<1) {
echo '<div class="rmenu">Bạn đã hết mồi rồi, hãy quay lại <br/><a href="shop.php"><b>Cửa Hàng</b></a> để mua thêm mồi nhé!</div>';
} else {
if ($datauser[lastpost]>time()) {
$wait=$datauser[lastpost]-time();
echo '- Đợi <b>'.$wait.' s</b> nữa để cá cắn câu rồi giật lên! <input type="button" value="Reload" id="clickme_1">';
} else {
$mayman=rand(1,3);
if ($mayman==1) {
$ca=mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id`='1'"));
$kg=rand($ca[kg_min],$ca[kg_max]);
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='5'");
mysql_query("UPDATE `fish_ruong` SET `kg`=`kg`+'".$kg."' WHERE `user_id`='".$user_id."' AND `id_ca`='".$ca[id]."'");
mysql_query("UPDATE `fish_r` SET `soluong`=`soluong`-'1' WHERE `id`='".$ca[id]."'");
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'".$rtg."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `users` SET `soca` = `soca` + '1' WHERE `id` = '".$user_id."'");
$checknv=mysql_num_rows(mysql_query("SELECT * FROM `nhiemvu_user` WHERE `user_id`='".$user_id."' AND `id_nv`='1'"));
if ($checknv>0) {
mysql_query("UPDATE `nhiemvu_user` SET `tiendo`=`tiendo`+'1' WHERE `user_id`='".$user_id."' AND `id_nv`='1'");
}

$randsk=rand(1,3);
if ($randsk==1) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='47' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/47.png"> Bạn đã câu trúng 1 Shuriken<br/>';
}

$randnro = rand(1,5);
if ($randnro == 1) {
$randv = rand(1,2);
if ($randv == 1) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='19' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/19.png"> Bạn đã nhận được ngọc 7 sao<br/>';
} else if ($randv == 2) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='18' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/18.png"> Bạn đã nhận được ngọc 6 sao<br/>';
}
}
echo '<img src="img/1.png"> Bạn đã câu được 1 con cá rô nặng '.$kg.' KG';
?>
<script language="javascript">
	$(document).ready(function(){
		$('img[alt="icon"]').attr('src','/icon/cacancau.png').css('verticalAlign','-6px');
	});
</script>
<?php
} else {
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'5' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='5'");
echo 'Trình độ của bạn kém quá, nó chạy mất rồi!';
}
}
echo '<a id="tung_1" href="#"><b>[Tung cần câu]</b></a>';
}
}
if (isset($_GET['reload3'])) {
?>
<script language="javascript">
	$(document).ready(function(){
		$('img[alt="icon"]').remove();
		$('img[alt="user"]').after('<img alt="icon" src="img/giangcau.gif"/>');
	});
</script>
<?php
if ($datauser[lastpost]>time()) {
$wait=$datauser[lastpost]-time();
echo '- Đợi <b>'.$wait.' s</b> nữa để cá cắn câu rồi giật lên! <input type="button" value="Reload" id="clickme_3">';
} else {
echo '<form method="post"><b><input type="submit" id="sub_3" name="giat_3" value="Giật cá lên">. "Nhanh tay không nó đi mất"</b></form>';
}
}
if (isset($_GET['reload2'])) {
?>
<script language="javascript">
	$(document).ready(function(){
		$('img[alt="icon"]').remove();
		$('img[alt="user"]').after('<img alt="icon" src="img/giangcau.gif"/>');
	});
</script>
<?php
if ($datauser[lastpost]>time()) {
$wait=$datauser[lastpost]-time();
echo '- Đợi <b>'.$wait.' s</b> nữa để cá cắn câu rồi giật lên! <input type="button" value="Reload" id="clickme_2">';
} else {
echo '<form method="post"><b><input type="submit" id="sub_2" name="giat_2" value="Giật cá lên">. "Nhanh tay không nó đi mất"</b></form>';
}
}
if (isset($_GET['reload1'])) {
?>
<script language="javascript">
	$(document).ready(function(){
		$('img[alt="icon"]').remove();
		$('img[alt="user"]').after('<img alt="icon" src="img/giangcau.gif"/>');
	});
</script>
<?php
if ($datauser[lastpost]>time()) {
$wait=$datauser[lastpost]-time();
echo '- Đợi <b>'.$wait.' s</b> nữa để cá cắn câu rồi giật lên! <input type="button" value="Reload" id="clickme_1">';
} else {
echo '<form method="post"><b><input type="submit" id="sub_1" name="giat_1" value="Giật cá lên">. "Nhanh tay không nó đi mất"</b></form>';
}
}
?>