<?php
//Đừng quên cRoSsOver nhé!
//Code by cRoSsOver
//Facebook: https://web.facebook.com/duyloc.2001
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Khu nâng cấp';
require('../incfiles/head.php');
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
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /index.php');
exit;
}
$kcx=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='1'"));
$kchv=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='2'"));
$kct=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='3'"));
$nhb=mysql_fetch_array(mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='4'"));
switch($act) {
default:
echo '<div class="phdr"><font color="white"> Nâng cấp vật phẩm [<a href="?act=index">Thợ kim hoàn</a>]'.($rights==9?'- [<a href="?act=add"><b>Thêm đồ</b></a>]':'').' </font></div>';
echo '<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tbody><tr><td width="50px;" class="blog-avatar"><a href="?act=index"><img src="/icon/kimhoan.gif"></a></td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0"><tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left"><img src="/giaodien/images/left-blog.png"></div><img src="/images/on.png" alt="online"><a href="?act=index"><font color="red"><b> Thợ kim hoàn</b></font></a><div class="text">';

$tong =mysql_result(mysql_query("SELECT COUNT(*) FROM `nangcap` WHERE `type` IN ('none', 'parent')"),0);
$req=mysql_query("SELECT * FROM `nangcap` WHERE `type` IN ('none', 'parent') LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
echo '<div class="omenu">';
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$res['vatpham']."'"));
echo '<img src="/images/shop/'.$res['vatpham'].'.png" class="avatar_vina">
<b><font color="blue">'.$shop['tenvatpham'].'</font></b><br/>
<b>Tỉ lệ: <font color="red">'.$res['tile'].'%</font></b><br/>
'.($res['type'] == 'none' ? '<a href="?act=dap&id='.$res['id'].'"><input type="submit" value="Đập"></a>' : '<a href="?act=list&id='.$res['id'].'"><input type="submit" value="Đập"></a>').'';
echo '</div>';
}
echo '</div></td></tr></tbody></table></td></tr></tbody></table>';
if ($tong > $kmess){
echo '<div class="topmenu">' . functions::pages('nangcap.php?page=', $start, $tong, $kmess) . '</div>';
}
break;
case 'list':
$id = intval($_GET['id']);
$check = mysql_num_rows(mysql_query("SELECT * FROM `nangcap` WHERE `id` = '".$id."'"));
if ($check < 1) {
header('Location: nangcap.php');
exit;
} else {
echo '<div class="phdr">NÂNG CẤP > VẬT PHẨM [<a href="nangcap.php">Quay lại</a>]</div>';
$req = mysql_query("SELECT * FROM `nangcap` WHERE `refid` = '".$id."'");
while ($res = mysql_fetch_assoc($req)) {
$shop = mysql_fetch_assoc(mysql_query("SELECT * FROM `shopdo` WHERE `id` ='".$res['vatpham']."'"));
echo '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">
<tbody><tr>
<td class="left-info"><img src="/images/shop/'.$shop['id'].'.png">
</td>
<td class="right-info"><b> <font color="blue">['.$shop['tenvatpham'].']</font></b><br>
<b>Tỉ lệ: <font color="red">'.$res['tile'].'%</font></b><br>
<a href="?act=dap&id='.$res['id'].'"><input type="submit" value="Nâng cấp"></a></td>
</tr></tbody></table>';
}
}
break;
case 'add':
if ($rights>=9) {
echo '<div class="phdr">Thêm đồ nâng cấp</div>';
if (isset($_POST['add'])) {
$vatpham=(int)$_POST['vatpham'];
$vnd=(int)$_POST['vnd'];
$xu=(int)$_POST['xu'];
$tile=(int)$_POST['tile'];
if (empty($vatpham) or empty($vnd) or empty($xu) or empty($tile)) {
echo '<div class="news">Không được bỏ trống!</div>';
} else {
mysql_query("INSERT INTO `nangcap` SET
`vatpham`='".$vatpham."',
`canvp`='".$_POST['canvp']."',
`kcx`='".$_POST['kcx']."',
`kchv`='".$_POST['kchv']."',
`kct`='".$_POST['kct']."',
`vnd`='".$vnd."',
`xu`='".$xu."',
`tile`='".$tile."'");
$tenvatpham=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$vatpham."'"));
$bot='[b]'.$login.' vừa thêm [red]'.$tenvatpham['tenvatpham'].' [/red] vào nâng cấp![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
echo '<div class="rmenu">Thêm thành công</div>';
}
}
echo '<form method="post">';
echo 'Cần vật phẩm: <select name="canvp">';
$cvp=mysql_query("SELECT * FROM `shopdo`");
while ($showcvp=mysql_fetch_array($cvp)) {
echo '<option value="'.$showcvp['id'].'"> '.$showcvp['tenvatpham'].'</option>';
}
echo '</select><br/>';
echo 'Vật phẩm: <select name="vatpham">';
$nc=mysql_query("SELECT * FROM `shopdo` WHERE `hienthi`='1'");
while ($show=mysql_fetch_array($nc)) {
echo '<option value="'.$show['id'].'"> '.$show['tenvatpham'].'</option>';
}
echo '</select><br/>';
echo 'Lượng: <input type="text" name="vnd" size="3"> Lượng<br/>';
echo 'Xu: <input type="text" name="xu" size="3"> xu<br/>';
echo 'Kim cương xanh: <input type="text" name="kcx" size="1"> viên<br/>';
echo 'Kim cương hi vọng: <input type="text" name="kchv" size="1"> viên<br/>';
echo 'Kim cương tím: <input type="text" name="kct" size="1"> viên<br/>';
echo 'Ngọn huyền bí: <input type="text" name="nhb" size="1"> viên<br/>';
echo 'Tỉ lệ trúng: <input type="text" name="tile" size="1">%<br/>';
echo '<input type="submit" name="add" value="Thêm">';
echo '</form>';
}
break;
case 'index':
echo '<div class="phdr">Thợ kim hoàn [<a href="nangcap.php">Quay lại</a>]</div>';
echo '<table>';
echo '<tr>';
echo '<td>';
echo '<img src="/icon/kimhoan.gif">';
echo '</td>';
echo '<td>';
echo '<div class="login"><a href="/shop/vatpham.php"><b><font color="brown">Chợ mua bán vật phẩm</b></font</a></div>';
echo '<div class="login"><a href="/shop/nangcap.php"><b><font color="brown">Nâng cấp Item</font></b></a></div>';
echo '<div class="login"><a href="/sanbay/vet.php"><b><font color="brown">Biến hình Vẹt</font></b></a></div>';
echo '<div class="login"><a href="/sanbay/kirby.php"><b><font color="brown">Biến hình Kirby</font></b></a></div>';
echo '</td>';
echo '</tr>';
echo '</table>';
break;
case 'dap':
echo '<div id="content-load">';
$id=(int)$_GET[id];
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
echo '</div>';
break;
}
echo '</div>';
require('../incfiles/end.php');
?>
                            