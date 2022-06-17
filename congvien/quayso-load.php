<?php
header('Content-Type: text/html; charset="utf-8');
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
if (!$user_id) {
header('Location: /index.php');
exit;
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
$id=(int)$_POST[idvp];
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
?>