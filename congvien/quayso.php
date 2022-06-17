<?php
//Đừng quên cRoSsOver nhé!
//Code by cRoSsOver
//Facebook: https://web.facebook.com/duyloc.2001
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Khu quay số';
require('../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /index.php');
}
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#btn-quay').click(function(){
		var idvp = $('#idvp').val();
		var typequay=$('select option:selected').val();
		var url = "quayso-load.php";
		var data = {"quay": "", "idvp": idvp, "type": typequay};
		$('#content-load').load(url, data);
		return false;
	});
});
</script>
<?php
$tqs=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `id_shop`='12'");
$nqs=mysql_num_rows($tqs);
$pqs=mysql_fetch_array($tqs);
switch($act) {
default:
echo '<div class="news"><b><font color="brown"><marquee behavior="alternate" scrollamount="2" position: absolute; width: 500px;" onmouseover="this.stop();" onmouseout="this.start();">Trong lúc quay số có thể nhận được item ngẫu nhiên có thời hạn là ngày nhé ^^ </marquee></font></b></div>';
echo '<div class="phdr"><center><font color="white"> Quay số '.($rights==9?'- [<a href="?act=add"><b>Thêm đồ</b></a>]':'').' </font></center></div>';
echo '<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tbody><tr><td width="50px;" class="blog-avatar"><img src="/icon/quayso.gif"></td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0"><tbody>
<tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left"><img src="/giaodien/images/left-blog.png"></div><img src="/images/on.png" alt="online"><font color="red"> <b> Quay số</b></font><div class="text">
';
$tong =mysql_result(mysql_query("SELECT COUNT(*) FROM `quayso` "),0);
$req=mysql_query("SELECT * FROM `quayso` LIMIT $start,$kmess");
while($res=mysql_fetch_array($req)) {
echo '<div class="omenu">';
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$res[vatpham]."'"));
echo '<img src="/images/shop/'.$res[vatpham].'.png" class="avatar_vina">
<b><font color="blue">'.$shop[tenvatpham].'</font></b><br/>
<b>Tỉ lệ: <font color="red">'.$res[tile].'%</font></b><br/>
<a href="?act=quay&id='.$res[id].'"><input type="submit" value="Quay"></a>';
echo '</div>';
}
echo '</div></td></tr></tbody></table></td></tr></tbody></table>';
if ($tong > $kmess){
echo '<div class="topmenu">' . functions::pages('quayso.php?page=', $start, $tong, $kmess) . '</div>';
}
break;
case 'add':
if ($rights>=9) {
echo '<div class="phdr">Thêm đồ quay số</div>';
if (isset($_POST[add])) {
$vatpham=(int)$_POST[vatpham];
$vnd=(int)$_POST[vnd];
$xu=(int)$_POST[xu];
$tile=(int)$_POST[tile];
if (empty($vatpham) or empty($vnd) or empty($xu) or empty($tile)) {
echo '<div class="news">Không được bỏ trống chỗ nào hết!</div>';
} else {
mysql_query("INSERT INTO `quayso` SET
`vatpham`='".$vatpham."',
`vnd`='".$vnd."',
`xu`='".$xu."',
`tile`='".$tile."'");
$tenvatpham=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$vatpham."'"));
$bot='[b]'.$login.' vừa thêm [red]'.$tenvatpham[tenvatpham].' [/red] vào quay số![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
echo '<div class="rmenu">Thêm thành công</div>';
}
}
echo '<form method="post">';
echo 'Vật phẩm: <select name="vatpham">';
$qs=mysql_query("SELECT * FROM `shopdo` WHERE `hienthi`='1'");
while ($show=mysql_fetch_array($qs)) {
echo '<option value="'.$show[id].'"> '.$show[tenvatpham].'</option>';
}
echo '</select><br/>';
echo 'Quay bằng Lượng: <input type="text" name="vnd" size="3"> Lượng<br/>';
echo 'Quay bằng xu: <input type="text" name="xu" size="3"> xu<br/>';
echo 'Tỉ lệ trúng: <input type="text" name="tile" size="1">%<br/>';
echo '<input type="submit" name="add" value="Thêm">';
echo '</form>';
}
break;
case 'quay':
echo '<div id="content-load">';
$id=(int)$_GET[id];
$check=mysql_num_rows(mysql_query("SELECT * FROM `quayso` WHERE `id`='".$id."'"));
if ($check<1) {
header('Location: quayso.php');
exit;
} else {
$item=mysql_fetch_array(mysql_query("SELECT * FROM `quayso` WHERE `id`='".$id."'"));
$shop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$item[vatpham]."'"));
echo '<div class="phdr"><b>Quay Item : '.$shop[tenvatpham].'</b></div>';
if (isset($_POST[quay])) {
$tile=$item[tile];
$tile=100/$tile;
$tile=floor($tile);
$rand=rand(1,$tile+2);
$type=(int)$_POST[type];
if ($type!=1&&$type!=2&&$type!=3) {
echo '<div class="rmenu">NoNo...!!!!</div>';
} else {
if ($type==1) {
if ($datauser[xu]<$item[xu]) {
echo '<div class="rmenu">Bạn không đủ tiền!</div>';
} else {
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$item[xu]."' WHERE `id`='".$user_id."'");
/////
if ($rand==1) {
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`loai`='".$shop[loai]."',
`id_loai`='".$shop[id_loai]."',
`tenvatpham`='".$shop[tenvatpham]."',
`id_shop`='".$shop[id]."'
");
$bot='[b]Chúc mừng [blue]'.$login.'[/blue] vừa quay trúng [red]'.$shop['tenvatpham'].' [/red]![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
echo '<div class="rmenu">Bạn đã quay trúng: <font color="red"><b>'.$shop[tenvatpham].'</b></font></div>';
} else {
$mayman=rand(1,2);
if ($mayman==1) {
$all=mysql_fetch_array(mysql_query("SELECT max(id) FROM `shopdo`"));  
$rando=rand(1,$all['max(id)']);
$checkrand=mysql_num_rows(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$rando."'"));
if ($checkrand<1) {
echo '<div class="rmenu">Không Trúng Rồi , Bạn Hãy Thử Lại Nhé ^^</div>';
} else {
$cross=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$rando."'"));
$ngay=rand(1,3);
$time=$ngay*24*3600+time();
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`loai`='".$cross[loai]."',
`id_loai`='".$cross[id_loai]."',
`tenvatpham`='".$cross[tenvatpham]."',
`id_shop`='".$cross[id]."',
`timesudung`='".$time."'
");
echo '<div class="omenu">Bạn đã quay trúng: <b><font color="red">'.$cross[tenvatpham].'</font> có Hạn sử dụng là: <font color="green">'.$ngay.' ngày</font></b></div>';
}
} else {
echo '<div class="rmenu">Không Trúng Rồi , Bạn Hãy Thử Lại Nhé ^^</div>';
}
}
}
/////
} else if ($type==2) {
if ($datauser[vnd]<$item[vnd]) {
echo '<div class="rmenu">Bạn không đủ tiền!</div>';
} else {
mysql_query("UPDATE `users` SET `vnd`=`vnd`-'".$item[vnd]."' WHERE `id`='".$user_id."'");
///
if ($rand==1) {
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`loai`='".$shop[loai]."',
`id_loai`='".$shop[id_loai]."',
`tenvatpham`='".$shop[tenvatpham]."',
`id_shop`='".$shop[id]."'
");
$bot='[b]Chúc mừng [blue]'.$login.'[/blue] vừa quay trúng [red]'.$shop['tenvatpham'].' [/red]![/b]';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
echo '<div class="omenu">Bạn đã quay trúng: <font color="red"><b>'.$shop[tenvatpham].'</b></font></div>';
} else {
$mayman=rand(1,2);
if ($mayman==1) {
$all=mysql_fetch_array(mysql_query("SELECT max(id) FROM `shopdo`"));  
$rando=rand(1,$all['max(id)']);
$checkrand=mysql_num_rows(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$rando."'"));
if ($checkrand<1) {
echo '<div class="rmenu">Không Trúng Rồi , Bạn Hãy Thử Lại Nhé ^^</div>';
} else {
$cross=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$rando."'"));
$ngay=rand(1,3);
$time=$ngay*24*3600+time();
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`loai`='".$cross[loai]."',
`id_loai`='".$cross[id_loai]."',
`tenvatpham`='".$cross[tenvatpham]."',
`id_shop`='".$cross[id]."',
`timesudung`='".$time."'
");
echo '<div class="omenu">Bạn đã quay trúng : <b><font color="red">'.$cross[tenvatpham].'</font> có Hạn sử dụng là: <font color="green">'.$ngay.' ngày</font></b></div>';
}
} else {
echo '<div class="rmenu">Không Trúng Rồi , Bạn Hãy Thử Lại Nhé ^^</div>';
}
}
}
// thẻ free
} else if ($type==3) {
if ($pqs[soluong]<1) {
echo '<div class="rmenu">Bạn đã hết thẻ quay số free!</div>';
} else {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`-'1' WHERE `user_id`='".$user_id."' AND `id_shop`='12'");
///
if ($rand==1) {
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`loai`='".$shop[loai]."',
`id_loai`='".$shop[id_loai]."',
`tenvatpham`='".$shop[tenvatpham]."',
`id_shop`='".$shop[id]."'
");
echo '<div class="omenu">Bạn đã quay trúng: <font color="red"><b>'.$shop[tenvatpham].'</b></font></div>';
} else {
$mayman=rand(1,2);
if ($mayman==1) {
$all=mysql_fetch_array(mysql_query("SELECT max(id) FROM `shopdo`"));  
$rando=rand(1,$all['max(id)']);
$checkrand=mysql_num_rows(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$rando."'"));
if ($checkrand<1) {
echo '<div class="rmenu">Không Trúng Rồi , Bạn Hãy Thử Lại Nhé ^^</div>';
} else {
$cross=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$rando."'"));
$ngay=rand(1,3);
$time=$ngay*24*3600+time();
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$user_id."',
`loai`='".$cross[loai]."',
`id_loai`='".$cross[id_loai]."',
`tenvatpham`='".$cross[tenvatpham]."',
`id_shop`='".$cross[id]."',
`timesudung`='".$time."'
");
echo '<div class="omenu">Bạn đã quay trúng : <b><font color="red">'.$cross[tenvatpham].'</font> có Hạn sử dụng là: <font color="green">'.$ngay.' ngày</font></b></div>';
}
} else {
echo '<div class="rmenu">Không Trúng Rồi , Bạn Hãy Thử Lại Nhé ^^</div>';
}
}
}
}
// end
}
}
echo '<form method="post">';
echo '<input type="hidden" id="idvp" name="idvp" value="'.$id.'">';
echo '<div class="list1"><center>';
echo '<img src="/images/shop/'.$shop[id].'.png"></br>';
echo '<b>Item : <font color="blue">'.$shop[tenvatpham].'</font><br/><b>Tỉ Lệ :</b> (<font color="red">'.$item[tile].'%</font>)</b><br/></br>';
echo '<select name="type">
<option '.($type==1?'selected="selected"':'').' value="1"> Quay bằng '.$item[xu].' xu</option>
<option '.($type==2?'selected="selected"':'').' value="2"> Quay bằng '.$item[vnd].' Lượng</option>
'.($pqs[soluong]>0?'<option '.($type==3?'selected="selected"':'').' value="3"> Quay bằng thẻ free</option>':'').'
</select><br/></br>';
echo '<button id="btn-quay" name="quay"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Quay <i class="fa fa-hand-o-left" aria-hidden="true"></i></button>';
echo '</center></div>';
echo '</form>';
echo '</div>';
}
break;
}
echo '</div>';
require('../incfiles/end.php');
?>
                            