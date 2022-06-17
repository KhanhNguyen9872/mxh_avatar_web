<?php
define('_IN_JOHNCMS', 1);
$textl = 'Khu câu cá';
require_once ('../../incfiles/core.php');
require_once ('../../incfiles/head.php');
?>
<script language="javascript">
$(document).ready(function(){
	$('.gmenu').on('click','#tung_3',function(){
		$.ajax({
			url: 'load.php?tung_3',
			type: 'GET',
			dataType: 'text',
			data: {},
			success: function(result){
				$('.gmenu').html(result);
			}
		});
		return false;
	});
	$('.gmenu').on('click','#tung_2',function(){
		$.ajax({
			url: 'load.php?tung_2',
			type: 'GET',
			dataType: 'text',
			data: {},
			success: function(result){
				$('.gmenu').html(result);
			}
		});
		return false;
	});
	$('.gmenu').on('click','#tung_1',function(){
		$.ajax({
			url: 'load.php?tung_1',
			type: 'GET',
			dataType: 'text',
			data: {},
			success: function(result){
				$('.gmenu').html(result);
			}
		});
		return false;
	});
	
	$('.gmenu').on('click', '#sub_3',function(){
		$.ajax({
			url: 'load.php',
			type: 'POST',
			dataType: 'text',
			data: {
				sub_3 : ''
			},
			success: function(result) {
				$('.gmenu').html(result);
			}
		});
		return false;
	});
	$('.gmenu').on('click', '#sub_2',function(){
		$.ajax({
			url: 'load.php',
			type: 'POST',
			dataType: 'text',
			data: {
				sub_2 : ''
			},
			success: function(result) {
				$('.gmenu').html(result);
			}
		});
		return false;
	});
	$('.gmenu').on('click', '#sub_1',function(){
		$.ajax({
			url: 'load.php',
			type: 'POST',
			dataType: 'text',
			data: {
				sub_1 : ''
			},
			success: function(result) {
				$('.gmenu').html(result);
			}
		});
		return false;
	});
	$('.gmenu').on('click','#clickme_1',function(){
		$.ajax({
			url: 'load.php?reload1',
			type: 'GET',
			dataType: 'text',
			data: {},
			success: function(result){
				$('.gmenu').html(result);
			}
		});
	});
	$('.gmenu').on('click','#clickme_2',function(){
		$.ajax({
			url: 'load.php?reload2',
			type: 'GET',
			dataType: 'text',
			data: {},
			success: function(result){
				$('.gmenu').html(result);
			}
		});
	});
	$('.gmenu').on('click','#clickme_3',function(){
		$.ajax({
			url: 'load.php?reload3',
			type: 'GET',
			dataType: 'text',
			data: {},
			success: function(result){
				$('.gmenu').html(result);
			}
		});
	});
});
</script>
<?php
if (!$user_id) {
    echo display_error('Dành cho thành viên hoặc đang bảo trì nhá !');
    require_once ('../../incfiles/end.php');
    exit;
}
mysql_query("UPDATE `users` SET `cancau`='".$datauser[savecancau]."',`docamtay`='0' WHERE `id`='".$user_id."'");
$res = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id` = '".$user_id."' AND `id_shop`='5' LIMIT 1"));
$rescc2 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id` = '".$user_id."' AND `id_shop`='6' LIMIT 1"));
$rescc3 = mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id` = '".$user_id."' AND `id_shop`='7' LIMIT 1"));
switch ($act) {

case '1':
$kiemtra1 = mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id` = '1' LIMIT 1"));
if($kiemtra1['soluong'] > 0  || $datauser['rights'] == 9){

if($datauser['cancau'] == 1 && $res['soluong'] >0){
echo '<div class="phdr"><img src="img/ve1.png"> <b>Khu câu cá rô</b></div>';
$checkcc1=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='cancau' AND `id_loai`='1'"));
if($checkcc1 < 1){
    echo '<div><div class="lucifer"><div class="rmenu">Bạn chưa mua cần câu tre hoặc đã hết hạn!</div>';
    echo '<div class="list2"><a href="index.php">Thoát khu câu cá</a></div>';
    require_once ('../../incfiles/end.php');
    exit;
}

if($res['soluong'] <= 0){
    echo '<div class="rmenu">Bạn đã hết mồi rồi, hãy quay lại <br/><a href="cuahang.html"><b>Cửa Hàng</b></a> để mua thêm mồi nhé!</div>';
    echo '<div class="list2"><a href="index.php">Thoát khu câu cá</a></div>';
    require_once ('../../incfiles/end.php');
    exit;
}

echo '<style>.oz2 {
    background-image: url(img/caucaronen.png);
	margin: -2px -5px -1px -5px;
	padding: 6px;
	max-width: 100%;
	margin: auto;
	height: 325px;
	border-bottom: 2px solid #e7e7e7;
	}
	.nendacaro{
	background: url("img/caucaro.png") no-repeat bottom left;
	max-width: 100%;
	height: 330px;
	border-bottom: 2px solid #e7e7e7;
	margin: -2px -5px -1px -5px;
	}
	.chongoi1
	{
		text-align: left;
		padding: 90px 0px 60px 45px;
	}
	.chongoi2
	{
		text-align: left;
		padding: 10px 0px 60px 38px;
	}
</style>

<div class="oz2">
<div class="nendacaro">';
mysql_query("UPDATE `vitri` SET `time`='".time()."',`online`='caro' WHERE `user_id`='".$user_id."'");
//bắt đầu cho hiện avatar
$time=time()-300;
$rtg=rand(5,10);
$req=mysql_query("SELECT * FROM `vitri` WHERE `online`='caro' AND `time`>'".$time."'");
echo '<div class="chongoi1">';
while($pr = mysql_fetch_array($req))
    {

    if ($pr[user_id]==$user_id) {
       echo '<img style="line-height: 1px;" alt="user" src="/avatar/'.$pr[user_id].'.png">';
    if (isset($_GET[giang])||isset($_GET[giat])) {
    echo '<img alt="icon" src="img/giangcau.gif"/>';
    } else if (isset($_GET[ok])) {
    echo'<img src="/icon/cacancau.png" alt="icon" style="vertical-align: -6px;"/>';
    }
        echo '<br/>';
        } else {
        echo '<a href="/member/'.$pr['user_id'].'.html"><img style="line-height: 1px;" src="/avatar/'.$pr[user_id].'.png"><br/></a>';
        }
    }
echo '</div></div></div>';
if (isset($_GET[giang])) {
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'".$rtg."' WHERE `id`='".$user_id."'");
header('Location: fish.php?act=1&giat');
}
echo '<div class="gmenu">';
if(!isset($_GET[giang])&&!isset($_GET[giat])) {
if (isset($_GET[ok])) {
if ($datauser[lastpost]<=time()) {
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
echo '<img src="img/1.png"> Bạn đã câu được 1 con cá lóc nặng '.$kg.' KG';
} else {
header('Location: fish.php?act=1&giang');
}
}
if (isset($_GET[no])) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='5'");
echo 'Trình độ của bạn kém quá, nó chạy mất rồi!';
}
 echo '<a id="tung_1" href="#"><button class="btn btn-light">[Tung cầncâu]</button></a>';
}
if(isset($_GET[giat])) {
echo '<div id="result">';
if ($datauser[lastpost]>time()) {
$wait=$datauser[lastpost]-time();
echo '<div class="lucifer">- Đợi <b>'.$wait.' s</b> nữa để cá cắn câu rồi giật lên! <input type="button" value="Reload" id="clickme_1"></div>';
} else {
if (isset($_POST[giat_1])) {
if ($datauser[lastpost]>time()) {
header('Location: fish.php?act=1&giang');
exit;
}
$rcl=rand(1,2);
if ($rcl==1) {
@mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'5' WHERE `id`='".$user_id."'");
header('Location: fish.php?act=1&no');
} else {
header('Location: fish.php?act=1&ok');
}
} else {
echo '<form method="post"><b><input type="submit" id="sub_1" name="giat_1" value="Giật cá lên">. "Nhanh tay không nó đi mất"</b></form>';
}
}
echo '</div>';
}

echo '</div>';
$post=mysql_fetch_array(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='cancau' AND `id_loai`='1'"));
$tinhthoigian = $post['timesudung'] - time();
$tinhgio = $tinhthoigian/3600;
$tinhgiotron = (int)$tinhgio;
echo '<div class="menu list-bottom congdong">
</b>Cần câu Thuê: '.$tinhgiotron.' Tiếng<br/>
Số mồi còn lại: : '.$res['soluong'].'.
</div>';}else{
	echo '<div class="phdr"><img src="img/ve1.png"> <b>Khu câu cá rô</b></div>';
	echo '<div class="list1">Bạn không có cần câu tre hoặc không có mồi cơm để câu ở đây, Hay bạn mua cần tre rồi mà chưa đeo cần vào hãy vào <a href="/ruong/"><b>Kho Đồ</b></a> để đeo cần vào đi câu nhé!</div>';
}
}else{

	echo '<div class="phdr"><img src="img/ve1.png"> <b>Khu câu cá rô</b></div>';
	echo '<div class="list1">Khu vực đã hết cá rồi, sang khu vực khác câu nhé...</div>';
}
break;

case '2':
$kiemtra1 = mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id` = '1' LIMIT 1"));
if($kiemtra1['soluong'] > 0  || $datauser['rights'] == 9){

if($datauser['cancau'] == 2 && $rescc2['soluong'] >0){
echo '<div class="phdr"><img src="img/ve1.png"> <b>Khu câu cá lòng tong</b></div>';
$checkcc1=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='cancau' AND `id_loai`='2'"));
if($checkcc1 < 1){
    echo '<div class="rmenu">Bạn chưa mua cần câu tre hoặc đã hết hạn!</div>';
    echo '<div class="list2"><a href="index.php">Thoát khu câu cá</a></div>';
    require_once ('../../incfiles/end.php');
    exit;
}

if($res['soluong'] <= 0){
    echo '<div class="rmenu">Bạn đã hết mồi rồi, hãy quay lại <br/><a href="shop.php"><b>Cửa Hàng</b></a> để mua thêm mồi nhé!</div>';
    echo '<div class="list2"><a href="index.php">Thoát khu câu cá</a></div>';
    require_once ('../../incfiles/end.php');
    exit;
}

echo '<style>.oz2 {
    background-image: url(img/caucaronen.png);
	margin: -2px -5px -1px -5px;
	padding: 6px;
	max-width: 100%;
	margin: auto;
	height: 325px;
	border-bottom: 2px solid #e7e7e7;
	}
	.nendacaro{
	background: url("img/caucaro.png") no-repeat bottom left;
	max-width: 100%;
	height: 330px;
	border-bottom: 2px solid #e7e7e7;
	margin: -2px -5px -1px -5px;
	}
	.chongoi1
	{
		text-align: left;
		padding: 90px 0px 60px 45px;
	}
	.chongoi2
	{
		text-align: left;
		padding: 10px 0px 60px 38px;
	}
</style>

<div class="oz2">
<div class="nendacaro">';
mysql_query("UPDATE `vitri` SET `time`='".time()."',`online`='calongtong' WHERE `user_id`='".$user_id."'");
//bắt đầu cho hiện avatar
$time=time()-300;
$rtg=rand(5,10);
$req=mysql_query("SELECT * FROM `vitri` WHERE `online`='calongtong' AND `time`>'".$time."'");
echo '<div class="chongoi1">';
while($pr = mysql_fetch_array($req))
    {

    if ($pr[user_id]==$user_id) {
       echo '<img style="line-height: 1px;" alt="user" src="/avatar/'.$pr[user_id].'.png">';
    if (isset($_GET[giang])||isset($_GET[giat])) {
    echo '<img alt="icon" src="img/giangcau.gif"/>';
    } else if (isset($_GET[ok])) {
    echo'<img src="/icon/cacancau.png" alt="icon" style="vertical-align: -6px;"/>';
    }
        echo '<br/>';
        } else {
        echo '<a href="/member/'.$pr['user_id'].'.html"><img style="line-height: 1px;" src="/avatar/'.$pr[user_id].'.png"><br/></a>';
        }
    }
echo '</div></div></div>';
if (isset($_GET[giang])) {
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'".$rtg."' WHERE `id`='".$user_id."'");
header('Location: fish.php?act=2&giat');
}
echo '<div class="gmenu">';
if(!isset($_GET[giang])&&!isset($_GET[giat])) {
if (isset($_GET[ok])) {
if ($datauser[lastpost]<=time()) {
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
echo '<img src="img/2.png"> Bạn đã câu được 1 con cá lòng tong nặng '.$kg.' KG';
} else {
header('Location: fish.php?act=2&giang');
}
}
if (isset($_GET[no])) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='6'");
echo 'Trình độ của bạn kém quá, nó chạy mất rồi!';
}
 echo '<a id="tung_2" href="#"><button class="btn btn-light">[Tung cần câu]</button></a>';
}
if(isset($_GET[giat])) {
echo '<div id="result">';
if ($datauser[lastpost]>time()) {
$wait=$datauser[lastpost]-time();
echo '<div class="lucifer">- Đợi <b>'.$wait.' s</b> nữa để cá cắn câu rồi giật lên! <input type="button" value="Reload" id="clickme_2"></div>';
} else {
if (isset($_POST[giat_2])) {
if ($datauser[lastpost]>time()) {
header('Location: fish.php?act=2&giang');
exit;
}
$rcl=rand(1,2);
if ($rcl==1) {
@mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'5' WHERE `id`='".$user_id."'");
header('Location: fish.php?act=2&no');
} else {
header('Location: fish.php?act=2&ok');
}
} else {
echo '<form method="post"><b><input type="submit" id="sub_2" name="giat_2"  value="Giật cá lên">. "Nhanh tay không nó đi mất"</b></form>';
}
}
echo '</div>';
}

echo '</div>';
$post=mysql_fetch_array(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='cancau' AND `id_loai`='2'"));
$tinhthoigian = $post['timesudung'] - time();
$tinhgio = $tinhthoigian/3600;
$tinhgiotron = (int)$tinhgio;
echo '<div class="menu list-bottom congdong">
</b>Cần câu Thuê: '.$tinhgiotron.' Tiếng<br/>
Số mồi còn lại: : '.$rescc2['soluong'].'.
</div>';}else{
	echo '<div class="phdr"><img src="img/ve2.png"> <b>Khu câu cá lòng tong</b></div>';
	echo '<div><div class="lucifer"><div class="list1">Bạn không có cần câu sắt hoặc không có mồi cơm để câu ở đây, Hay bạn mua cần sắt rồi mà chưa đeo cần vào hãy vào <a href="/ruong/"><b>Kho Đồ</b></a> để đeo cần vào đi câu nhé!</div>';
}
}else{

	echo '<div class="phdr"><img src="img/ve2.png"> <b>Khu câu cá lòng tong</b></div>';
	echo '<div class="list1">Khu vực đã hết cá rồi, sang khu vực khác câu nhé...</div>';
}
break;
////****
case '3':
$kiemtra3 = mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id` = '3' LIMIT 1"));
if($kiemtra3['soluong'] > 0  || $datauser['rights'] == 9){

if($datauser['cancau'] == 3 && $rescc3['soluong'] >0){
echo '<div class="phdr"><img src="img/ve1.png"> <b>Khu câu cá lòng mập</b></div>';
$checkcc1=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='cancau' AND `id_loai`='3'"));
if($checkcc1 < 1){
    echo '<div class="rmenu">Bạn chưa mua cần câu VIP hoặc đã hết hạn!</div>';
    echo '<div class="list2"><a href="index.php">Thoát khu câu cá</a></div>';
    require_once ('../../incfiles/end.php');
    exit;
}

if($rescc3['soluong'] <= 0){
    echo '<div class="rmenu">Bạn đã hết mồi rồi, hãy quay lại <br/><a href="shop.php"><b>Cửa Hàng</b></a> để mua thêm mồi nhé!</div>';
    echo '<div class="list2"><a href="">Thoát khu câu cá</a></div>';
    require_once ('../../incfiles/end.php');
    exit;
}

echo '<style>.oz2 {
    background-image: url(img/caucaronen.png);
	margin: -2px -5px -1px -5px;
	padding: 6px;
	max-width: 100%;
	margin: auto;
	height: 325px;
	border-bottom: 2px solid #e7e7e7;
	}
	.nendacaro{
	background: url("img/caucaro.png") no-repeat bottom left;
	max-width: 100%;
	height: 330px;
	border-bottom: 2px solid #e7e7e7;
	margin: -2px -5px -1px -5px;
	}
	.chongoi1
	{
		text-align: left;
		padding: 90px 0px 60px 45px;
	}
	.chongoi2
	{
		text-align: left;
		padding: 10px 0px 60px 38px;
	}
</style>

<div class="oz2">
<div class="nendacaro">';
mysql_query("UPDATE `vitri` SET `time`='".time()."',`online`='camap' WHERE `user_id`='".$user_id."'");
//bắt đầu cho hiện avatar
$time=time()-300;
$rtg=rand(5,10);
$req=mysql_query("SELECT * FROM `vitri` WHERE `online`='camap' AND `time`>'".$time."'");
echo '<div class="chongoi1">';
while($pr = mysql_fetch_array($req))
    {

    if ($pr[user_id]==$user_id) {
       echo '<img style="line-height: 1px;" alt="user" src="/avatar/'.$pr[user_id].'.png">';
    if (isset($_GET[giang])||isset($_GET[giat])) {
    echo '<img alt="icon" src="img/giangcau.gif"/>';
    } else if (isset($_GET[ok])) {
    echo'<img src="/icon/cacancau.png" alt="icon" style="vertical-align: -6px;"/>';
    }
        echo '<br/>';
        } else {
        echo '<a href="/member/'.$pr['user_id'].'.html"><img style="line-height: 1px;" src="/avatar/'.$pr[user_id].'.png"><br/></a>';
        }
    }
echo '</div></div></div>';
if (isset($_GET[giang])) {
mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'".$rtg."' WHERE `id`='".$user_id."'");
header('Location: fish.php?act=3&giat');
}
echo '<div class="gmenu">';
if(!isset($_GET[giang])&&!isset($_GET[giat])) {
if (isset($_GET[ok])) {
if ($datauser[lastpost]<=time()) {
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
} else {
header('Location: fish.php?act=3&giang');
}
}
if (isset($_GET[no])) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='7'");
echo 'Trình độ của bạn kém quá, nó chạy mất rồi!';
}
 echo '<a id="tung_3" href="#"><button class="btn btn-light">[Tung cần câu]</button></a>';
}
if(isset($_GET[giat])) {
echo '<div class="lucifer"><div id="result">';
if ($datauser[lastpost]>time()) {
$wait=$datauser[lastpost]-time();
echo '- Đợi <b>'.$wait.' s</b> nữa để cá cắn câu rồi giật lên! <input type="button" value="Reload" id="clickme_3"></div>';
} else {
if (isset($_POST[giat_3])) {
if ($datauser[lastpost]>time()) {
header('Location: fish.php?act=3&giang');
exit;
}
$rcl=rand(1,2);
if ($rcl==1) {
@mysql_query("UPDATE `users` SET `lastpost`='".time()."'+'5' WHERE `id`='".$user_id."'");
header('Location: fish.php?act=3&no');
} else {
header('Location: fish.php?act=3&ok');
}
} else {
echo '<form method="post"><b><input type="submit" id="sub_3" name="giat_3" value="Giật cá lên">. "Nhanh tay không nó đi mất"</b></form>';
}
}
echo '</div>';
}

echo '</div>';
$post=mysql_fetch_array(mysql_query("SELECT * FROM `khodo` WHERE `user_id`='".$user_id."' AND `loai`='cancau' AND `id_loai`='3'"));
$tinhthoigian = $post['timesudung'] - time();
$tinhgio = $tinhthoigian/3600;
$tinhgiotron = (int)$tinhgio;
echo '<div><div class="lucifer"><div class="menu list-bottom congdong">
</b>Cần câu Thuê: '.$tinhgiotron.' Tiếng<br/>
Số mồi còn lại: : '.$rescc3['soluong'].'.
</div>';}else{
	echo '<div class="phdr"><img src="img/ve3.png"> <b>Khu câu cá lòng mập</b></div>';
	echo '<div> <div class="lucifer"><div class="list1">Bạn không có cần câu VIP hoặc không có mồi cơm để câu ở đây, Hay bạn mua cần VIP rồi mà chưa đeo cần vào hãy vào <a href="/ruong/"><b>Kho Đồ</b></a> để đeo cần vào đi câu nhé!</div>';
}
}else{

	echo '<div class="phdr"><img src="img/ve3.png"> <b>Khu câu cá lòng mập</b></div>';
	echo '<div class="list1">Khu vực đã hết cá rồi, sang khu vực khác câu nhé...</div>';
}
break;
//
default:
mysql_query("UPDATE `fish` SET `time` = '0', `rand_time` = '0', `status` = '0' WHERE `user_id` = '".$user_id."' LIMIT 1");
echo '<div class="phdr">CHỌN KHU CÂU CÁ</div><div><div class="lucifer">';
$hienthisoluong1 = mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id` = '1' LIMIT 1"));
echo '<div class="gmenu"><table><tr><td><img src="img/khu1.png"></td><td> <b>[<a href="fish.php?act=1">Khu câu cá rô</a>]</b>';
if($hienthisoluong1['soluong'] > 0){
echo '<br/> (<span style="color: red;">Hiện còn <b>'.$hienthisoluong1['soluong'].'</b> con cá rô trong khu</span>)';
}else{
	echo '<br/> (<span style="color: red;">Khu vực đã hết cá rồi AE câu ác quá đi</span>)';
	// Mod tự động thêm số lượng cá
	if($hienthisoluong1['time'] == 0){
	mysql_query("UPDATE `fish_r` SET `time` = '".time()."' WHERE `id` = '1'");
	}else{
	$tinhtime = $hienthisoluong1['time'] + 14400;
	$timeht = time();
	if($tinhtime <= $timeht){
		mysql_query("UPDATE `fish_r` SET `soluong` = '5000' WHERE `id` = '1'");
		mysql_query("UPDATE `fish_r` SET `time` = '0' WHERE `id` = '1'");
	}else{
			$tinhtimeconlai = ($hienthisoluong1['time']+14400) - time();
			$tinhphutconlai = floor($tinhtimeconlai/60);
			$tinhgioconlai = floor($tinhphutconlai/60);
			$tinhgioconlaidu = floor($tinhphutconlai%60);
			if($tinhgioconlai > 0){
			echo '<br/>- Cá rô phi sẽ được nhập khẩu  từ <b>Thái Lan</b> trong '.$tinhgioconlai.' giờ '.$tinhgioconlaidu.' phút nữa. AE vui lòng kiên nhẫn đợi!';
			}else{
			echo '<br/>- Cá rô phi sẽ được nhập khẩu  từ <b>Thái Lan</b> trong '.$tinhphutconlai.' phút nữa. AE vui lòng kiên nhẫn đợi!';
			}

		}
	}
}
echo '</td></tr></table></div>';
$hienthisoluong2 = mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id` = '2' LIMIT 1"));
echo '<div class="gmenu"><table><tr><td><img src="img/khu2.png"></td><td> <b>[<a href="fish.php?act=2">Khu câu lòng tong</a>]</b>';
if($hienthisoluong2['soluong'] > 0){
echo '<br/> (<span style="color: red;">Hiện còn <b>'.$hienthisoluong2['soluong'].'</b> con cá lòng tong trong khu</span>)';
}else{
	echo '<br/> (<span style="color: red;">Khu vực đã hết cá rồi AE câu ác quá đi</span>)';
	// Mod tự động thêm số lượng cá
	if($hienthisoluong2['time'] == 0){
	mysql_query("UPDATE `fish_r` SET `time` = '".time()."' WHERE `id` = '2'");
	}else{
	$tinhtime = $hienthisoluong2['time'] + 14400;
	$timeht = time();
	if($tinhtime <= $timeht){
		mysql_query("UPDATE `fish_r` SET `soluong` = '1000' WHERE `id` = '2'");
		mysql_query("UPDATE `fish_r` SET `time` = '0' WHERE `id` = '2'");
	}else{
			$tinhtimeconlai = ($hienthisoluong2['time']+14400) - time();
			$tinhphutconlai = floor($tinhtimeconlai/60);
			$tinhgioconlai = floor($tinhphutconlai/60);
			$tinhgioconlaidu = floor($tinhphutconlai%60);
			if($tinhgioconlai > 0){
			echo '<br/>- Cá lòng tong sẽ được nhập khẩu  từ <b>Hoàng Xa</b> trong '.$tinhgioconlai.' giờ '.$tinhgioconlaidu.' phút nữa. AE vui lòng kiên nhẫn đợi!';
			}else{
			echo '<br/>- Cá lòng tong sẽ được nhập khẩu  từ <b>Hoàng Xa</b> trong '.$tinhphutconlai.' phút nữa. AE vui lòng kiên nhẫn đợi!';
			}
	}
	}
}
echo '</td></tr></table></div>';
$hienthisoluong3 = mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id` = '3' LIMIT 1"));
echo '<div class="gmenu"><table><tr><td><img src="img/khu3.png"></td><td> <b>[<a href="fish.php?act=3">Khu câu cá mập</a>]</b>';
if($hienthisoluong3['soluong'] > 0){
echo '<br/> (<span style="color: red;">Hiện còn <b>'.$hienthisoluong3['soluong'].'</b> con cá mập trong khu</span>)';
}else{
	echo '<br/> (<span style="color: red;">Khu vực đã hết cá rồi AE câu ác quá đi</span>)';
	// Mod tự động thêm số lượng cá
	if($hienthisoluong3['time'] == 0){
	mysql_query("UPDATE `fish_r` SET `time` = '".time()."' WHERE `id` = '3'");
	}else{
	$tinhtime = $hienthisoluong3['time'] + 14400;
	$timeht = time();
	if($tinhtime <= $timeht){
		mysql_query("UPDATE `fish_r` SET `soluong` = '500' WHERE `id` = '3'");
		mysql_query("UPDATE `fish_r` SET `time` = '0' WHERE `id` = '3'");
	}else{
		$tinhtimeconlai = ($hienthisoluong3['time']+14400) - time();
		$tinhphutconlai = floor($tinhtimeconlai/60);
		$tinhgioconlai = floor($tinhphutconlai/60);
		$tinhgioconlaidu = floor($tinhphutconlai%60);
			if($tinhgioconlai > 0){
			echo '<br/>- Cá mập sẽ được nhập khẩu  từ <b>Nhật Bổn</b> trong '.$tinhgioconlai.' giờ '.$tinhgioconlaidu.' phút nữa. AE vui lòng kiên nhẫn đợi!';
			}else{
			echo '<br/>- Cá mập sẽ được nhập khẩu  từ <b>Nhật Bổn</b> trong '.$tinhphutconlai.' phút nữa. AE vui lòng kiên nhẫn đợi!';
			}
		
		}
	}
	
}
echo '</td></tr></table></div>';
}

require_once ("../../incfiles/end.php");

?>
                            