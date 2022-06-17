<?php
define('_IN_JOHNCMS',1);
$textl='Kho sinh thái';
require('../../incfiles/core.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
require('../../incfiles/head.php');
echo '<div class="mainblok">';
switch($act) {
default:
echo '<div class="phdr">'.$textl.'</div><div class="lucifer">';
$req=mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `kg`>'0'");
$dem=mysql_num_rows($req);
if ($dem==0) {
echo '<div class="rmenu">Chưa có gì trong kho!</div>';
}
while($res=mysql_fetch_array($req)) {
$info=mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id`='".$res[id_ca]."'"));
echo '<div class="menu">';
echo '<table>';
echo'<tr>';
echo '<td><img src="img/'.$res[id_ca].'.png"></td>';
echo '<td><b><font color="green">'.$info[name].'</font><br/>Trữ lượng: <b>'.$res[kg].'</b> KG<br/>Giá: <font color="black"><b>'.$info[cena].' Xu/KG</b><br/><a href="?act=sell&id='.$info[id].'"><input type="button" value="Bán"></a></font></td>';
echo '</tr>';
echo '</table>';
echo '</div>';
}
break;
case 'sell':
$id=(int)$_GET[id];
$q=mysql_query("SELECT * FROM `fish_ruong` WHERE `user_id`='".$user_id."' AND `id_ca`='".$id."' AND `kg`>'0'");
$check=mysql_num_rows($q);
if ($check<1) {
echo '<div class="phdr">Lỗi!</div>';
echo '<div class="rmenu">Không thể bán</div>';
} else {
$ca=mysql_fetch_array($q);
$pro=mysql_fetch_array(mysql_query("SELECT * FROM `fish_r` WHERE `id`='".$ca[id_ca]."'"));
echo '<div class="phdr">Bán '.$pro[name].' (Bạn có: <b>'.$ca[kg].' KG</b>)</div>';
if (isset($_POST[ban])) {
$sl=(int)$_POST[soluong];
$tien=$sl*$pro[cena];
if ($sl<=0||empty($sl)) {
echo '<div class="rmenu">Bạn vui lòng xem lại số lượng!</div>';
} else if($ca[kg]<$sl) {
echo '<div class="rmenu">Bạn không đủ cá để bán!</div>';
} else {
mysql_query("UPDATE `fish_ruong` SET `kg`=`kg`-'".$sl."' WHERE `user_id`='".$user_id."' AND `id_ca`='".$pro[id]."'");
mysql_query("UPDATE `users` SET `xu`=`xu`+'".$tien."' WHERE `id`='".$user_id."'");
echo '<div class="gmenu">Bán thành công <b>'.$ca[kg].' KG '.$pro[name].'</b>, bạn thu về <b>'.$tien.' xu</b></div>';
}
}
echo '<form method="post">';
echo '<div class="menu list-bottom congdong"><table>
<tr>
<td><img src="img/'.$pro[id].'.png"></td>
<td><b><font color="blue">'.$pro[name].'</font></b><br/>Giá: <b>'.$pro[cena].'</b> Xu/1 KG</td>
</tr>
</table></div>';
echo'Sản lượng (KG):<input type="number" name="soluong">';
echo'<input type="submit" name="ban" value="Bán">';
echo'</form>';
}
break;
}

require('../../incfiles/end.php');
?>