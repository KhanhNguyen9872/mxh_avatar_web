<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Shop vật phẩm';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /404.php');
exit;
}
echo '<div class="mainblok">';
switch ($act) {
case 'add':
if ($rights==9) {
echo '<div class="phdr">Thêm vật phẩm</div>';
if (isset($_POST[submit])) {
mysql_query("INSERT INTO `shopvatpham` SET
`loaitien`='".$_POST[loaitien]."',
`gia`='".$_POST[gia]."',
`thongtin`='".$_POST[thongtin]."',
`hienthi`='".$_POST[hienthi]."',
`tenvatpham`='".$_POST[tenvp]."'");
}
echo '<form method="post">';
echo 'Tên: <input type="text" name="tenvp"><br/>';
echo 'Loại: <select name="loaitien">
<option value="xu"> Xu</option>
<option value="vnd"> lượng</option>
</select><br/>';
echo 'Giá: <input type="text" name="gia"><br/>';
echo 'Info: <textarea name="thongtin"></textarea><br/>';
echo 'Ko hiển thị:<input type="checkbox" name="hienthi" value="1"><br/>';
echo '<input type="submit" name="submit" value="Add">';
echo '</form>';
}
break;
default:
echo '<div class="phdr">'.$textl.' </div>';
?>
<div class="lucifer"><b>Chọn loại vật phẩm muốn mua : </b><select class="btn btn-light" name="url"size="1"onChange="window.open(this.options [this.selectedIndex].value,'_top')" style="border: 0;">
<?php
echo '<option value="">---Chọn---</option>';
echo '<option value="?loai=all"> Tất cả</option>';
echo '<option value="?loai=nangcap"> Nâng cấp</option>';
echo '<option value="?loai=cuonghoa"> Cường hóa</option>';
echo '<option value="?loai=cauca"> Câu cá</option>';
echo '<option value="?loai=ngocrong"> Ngọc rồng</option>';
echo '</select>';
echo '';
if ($_GET[loai]=='all'||empty($_GET[loai])) {
$req=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0'");
} else {
$req=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `loai`='" . mysql_real_escape_string(htmlspecialchars($_GET[loai])) . "'");
}
echo '<table>';
while($res=mysql_fetch_array($req)) {
echo'<tr>
<td><img src="/images/vatpham/'.$res[id].'.png"></td>
<td><b><font color="blue">'.$res[tenvatpham].'</font></b><br/>'.$res[thongtin].'<br/><b>Giá: '.$res[gia].' '.($res[loaitien]=='xu'?'Xu':'lượng').'</b><br/><button class="btn btn-dark"><a href="?act=mua&id='.$res[id].'"><i class="fa fa-usd" aria-hidden="true"></i> Mua <i class="fa fa-usd" aria-hidden="true"></i></a></button></td>
</tr>';
}
echo '</table>';
break;
case 'mua':
$id=(int)$_GET[id];
$query=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `id`='".$id."'");
$check=mysql_num_rows($query);
if ($check<1) {
header('Location: vatpham.php');
} else {
$info=mysql_fetch_array($query);
echo '<div class="phdr">Mua '.$info[tenvatpham].'</div>';
if (isset($_POST[mua])) {
$soluong=(int)$_POST[soluong];
$tien=$soluong*$info[gia];
if ($soluong<1) {
echo '<div class="rmenu">Vui lòng xem lại số lượng!</div>';
} else {
if ($info[loaitien]==xu) {
if ($datauser[xu]<$tien) {
echo '<div class="gmenu">Bạn cần có đủ <b>'.$tien.' xu</b> để mua <b>'.$soluong.' '.$info[tenvatpham].'</b></div>';
} else {
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$tien."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$soluong."' WHERE `user_id`='".$user_id."' AND `id_shop`='".$id."'");
echo '<div class="gmenu">Mua thành công <b>'.$soluong.' '.$info[tenvatpham].'</b>, tài khoản của bạn bị trừ <b>'.$tien.' xu</b></div>';
}
} else {
if ($datauser[vnd]<$tien) {
echo '<div class="gmenu">Bạn cần có đủ <b>'.$tien.' lượng</b> để mua <b>'.$soluong.' '.$info[tenvatpham].'</b></div>';
} else {
mysql_query("UPDATE `users` SET `vnd`=`vnd`-'".$tien."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$soluong."' WHERE `user_id`='".$user_id."' AND `id_shop`='".$id."'");
echo '<div class="gmenu">Mua thành công <b>'.$soluong.' '.$info[tenvatpham].'</b>, tài khoản của bạn bị trừ <b>'.$tien.' lượng</b></div>';
}
}
}
}
echo '<form method="post">';
echo '<div class="menu list-bottom"><table>
<tr>
<td><img src="/images/vatpham/'.$info[id].'.png"></td>
<td><b><font color="green">'.$info[tenvatpham].'</font></b><br/>Giá: <b>'.$info[gia].'</b> '.($info[loaitien]=='xu'?'Xu':'lượng').'/1 item</td>
</tr>
</table></div>';
echo'Số lượng:<input type="number" name="soluong">';
echo'<input type="submit" name="mua" value="Mua">';
echo'</form>';
}
break;
}
echo '';
require('../incfiles/end.php');
?>