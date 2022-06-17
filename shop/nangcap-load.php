<?php
header('Content-Type: text/html; charset="utf-8');
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
if (!$user_id) {
header('Location: /index.php');
exit;
}
$kcx=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='1'"));
$kchv=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='2'"));
$kct=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='3'"));
$nhb=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='4'"));
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#btn-dap').click(function(){
		var idvp = $('#idvp').val();
		var typedap=$('select option:selected').val();
		var url = "nangcap-load.php";
		var data = {"dap": "", "idvp": idvp, "type": typedap};
		$('#content-load').load(url, data);
		return false;
	});
});
</script>
<?php
$id=(int)$_POST[idvp];
$check=mysql_num_rows(mysql_query("SELECT * FROM `nangcap` WHERE `id`='".$id."'"));
if ($check<1) {
header('Location: nangcap.php');
exit;
} else {
$item=mysql_fetch_array(mysql_query("SELECT * FROM `nangcap` WHERE `id`='".$id."'"));
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$item['vatpham']."'"));
$canvp=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$item['canvp']."'"));
$ruong=mysql_fetch_array(mysql_query("SELECT * FROM `khodo` WHERE `loai`='".$canvp['loai']."' AND `user_id`='".$user_id."' AND `id_loai`='".$canvp['id_loai']."' AND `timesudung` = '0'"));
$ktruong=mysql_num_rows(mysql_query("SELECT * FROM `khodo` WHERE `loai`='".$canvp['loai']."' AND `id_loai`='".$canvp['id_loai']."' AND `user_id`='".$user_id."' AND `timesudung` = '0'"));
echo '<div class="phdr"><b>Nâng item : '.$shop['tenvatpham'].' - [<a href="nangcap.php">Quay lại</a>]</b></div>';
if (isset($_POST['dap'])) {
$tile=$item['tile'];
$tile=200/$tile;
$tile=floor($tile);
$rand=rand(1,$tile+1);
$type=(int)$_POST[type];
if ($type!=1&&$type!=2) {
echo '<div class="list1">NoNo...!!!!</div>';
} else {
if ($type==1) {
if ($datauser['xu']<$item['xu'] || $ktruong<1 || $kcx['soluong']<$item['kcx'] || $kchv['soluong']<$item['kchv'] || $kct['soluong']<$item['kct']) {
echo '<div class="rmenu">Chưa đủ điều kiện đập đồ!</div>';
} else {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$item['kcx']."' WHERE `user_id`='".$user_id."' AND `id_shop`='1'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$item['kchv']."' WHERE `user_id`='".$user_id."' AND `id_shop`='2'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$item['kct']."' WHERE `user_id`='".$user_id."' AND `id_shop`='3'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$item['nhb']."' WHERE `user_id`='".$user_id."' AND `id_shop`='4'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$item['xu']."' WHERE `id`='".$user_id."'");
/////
if ($rand==1) {
mysql_query("DELETE FROM `khodo` WHERE `id`='".$ruong['id']."' LIMIT 1");
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`loai`='".$shop['loai']."',
`id_loai`='".$shop['id_loai']."',
`timesudung`='".$ruong['timesudung']."',
`tenvatpham`='".$shop['tenvatpham']."',
`id_shop`='".$shop['id']."'
");
$bot='[b]Chúc mừng [blue]'.$login.'[/blue] vừa nâng cấp thành công [red]'.$shop['tenvatpham'].' [/red]![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
echo '<div class="rmenu">Đập thành công: <font color="red"><b>'.$shop['tenvatpham'].'</b></font></div>';
} else {
echo '<div class="rmenu">Thất bại rồi, Thử lại nhé ^^</div>';
}
}
/////
} else if ($type==2) {
if ($datauser['vnd']<$item['vnd'] || $ktruong<1 || $kcx['soluong']<$item['kcx'] || $kchv['soluong']<$item['kchv'] || $kct['soluong']<$item['kct']) {
echo '<div class="rmenu">Chưa đủ điều kiện đập đồ!</div>';
} else {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$item['kcx']."' WHERE `user_id`='".$user_id."' AND `id_shop`='1'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$item['kchv']."' WHERE `user_id`='".$user_id."' AND `id_shop`='2'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$item['kct']."' WHERE `user_id`='".$user_id."' AND `id_shop`='3'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'".$item['nhb']."' WHERE `user_id`='".$user_id."' AND `id_shop`='4'");
mysql_query("UPDATE `users` SET `vnd`=`vnd`-'".$item['vnd']."' WHERE `id`='".$user_id."'");
///
if ($rand==1) {
mysql_query("DELETE FROM `khodo` WHERE `id`='".$ruong['id']."' LIMIT 1");
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`loai`='".$shop['loai']."',
`id_loai`='".$shop['id_loai']."',
`timesudung`='".$ruong['timesudung']."',
`tenvatpham`='".$shop['tenvatpham']."',
`id_shop`='".$shop['id']."'
");
$bot='[b]Chúc mừng [blue]'.$login.'[/blue] vừa nâng cấp thành công [red]'.$shop['tenvatpham'].' [/red]![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
echo '<div class="rmenu">Đập thành công: <font color="red"><b>'.$shop['tenvatpham'].'</b></font></div>';
} else {
echo '<div class=rmenu">Thất bại rồi, thử lại nhé ^^</div>';
}
}
}
}
}
echo '<form method="post">';
echo '<input type="hidden" id="idvp" name="idvp" value="'.$id.'">';
echo '<div class="list1">';
echo '<center><img src="/images/shop/'.$shop['id'].'.png"></br>
<b>Cần : <font color="blue">'.$canvp['tenvatpham'].'</font> '.($ktruong>0?'<font color="green">(Đã có)</font>':'<font color="red">(Chưa có)</font>').'<br/>
'.($item['kcx']>0?'<img src="/images/vatpham/1.png">'.$kcx['soluong'].'/'.$item['kcx'].' '.($kcx['soluong']>=$item['kcx']?'<font color="green">(Đã đủ)</font>':'<font color="red">(Chưa đủ)</font>').'<br/>':'').'
'.($item['kchv']>0?'<img src="/images/vatpham/2.png">'.$kchv['soluong'].'/'.$item['kchv'].' '.($kchv['soluong']>=$item['kchv']?'<font color="green">(Đã đủ)</font>':'<font color="red">(Chưa đủ)</font>)').'<br/>':'').'
'.($item['kct']>0?'<img src="/images/vatpham/3.png">'.$kct['soluong'].'/'.$item['kct'].' '.($kct['soluong']>=$item['kct']?'<font color="green">(Đã đủ)</font>':'<font color="red">(Chưa đủ)</font>').'<br/>':'').'
'.($item['nhb']>0?'<img src="/images/vatpham/4.png">'.$nhb['soluong'].'/'.$item['nhb'].' '.($nhb['soluong']>=$item['nhb']?'<font color="green">(Đã đủ)</font>':'<font color="red">(Chưa đủ)</font>').'<br/>':'').'
<b>Tỉ Lệ :</b> (<font color="red">'.$item['tile'].'%</font>)</b><br/></br>
<select name="type">
<option '.($type==1?'selected="selected"':'').' value="1"> Đập bằng '.$item['xu'].' xu</option>
<option '.($type==2?'selected="selected"':'').' value="2"> Đập bằng '.$item['vnd'].' Lượng</option>
</select><br/></br>
<button id="btn-dap" name="dap"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Đập <i class="fa fa-hand-o-left" aria-hidden="true"></i></button>
</center>';
echo '</div>';
echo '</form>';
/*echo '<div class="login"><details><summary><b><font color="green">Menu</font></b></summary><a href="/shop/vatpham.php"><b><font color="brown"><img src="/icon/next.png"> Chợ mua bán vật phẩm</b></font</a></br>
<a href="/shop/nangcap.php"><b><font color="brown"><img src="/icon/next.png"> Nâng cấp Item</font></b></a></br>
<a href="/sanbay/vet.php"><b><font color="brown"><img src="/icon/next.png"> Biến hình Vẹt</font></b></a></br>
<a href="/sanbay/kirby.php"><b><font color="brown"><img src="/icon/next.png"> Biến hình Kirby</font></b></a></details></div>';*/
}
?>