<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Tools Admin';
require('../incfiles/head.php');
if ($rights!=9) {
header('Location: /404.php');
exit;
}
$id=$_GET[id];
$res=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$_GET[id]."'"));
echo '<div class="mainblok">';
echo '<div class="phdr"><b>'.$res[tenvatpham].'</b></div>';
if (isset($_POST[submit])) {
@mysql_query("UPDATE `shopdo` SET
`tenvatpham`='".$_POST[vatpham]."',
`loaitien`='".$_POST[loaitien]."',
`gia`='".$_POST[gia]."',
`gioitinh`='".$_POST[gioitinh]."',
`hienthi`='".$_POST[hienthi]."'
WHERE `id`='".$id."'
");
echo '<div class="rmenu">Edit thành công! 
<a href="gift.php"><input type="button" value="Shop gift"></a> - <a href="pet.php"><input type="button" value="Shop PET"></a> - <a href="list.php"><input type="button" value="Shop đồ"></a> - <a href="myvien.php"><input type="button" value="Mỹ viện"></a></div>';
}
echo '<img src="/images/'.$res[id_shop].'.png">';
echo '<form method="post">';
echo 'Tên vật phẩm: <input type="text" name="vatpham" value="'.$res[tenvatpham].'"><br/>';
echo 'Loại tiền: <select name="loaitien">
<option value="xu" '.($res[loaitien]==xu?'selected="selected"':'').'> Xu</option>
<option value="vnd" '.($res[loaitien]==vnd?'selected="selected"':'').'> Lượng</option>
</select><br/>';
echo 'Giá: <input type="text" name="gia" size="3" value="'.$res[gia].'"><br/>';
echo 'Giới tính: <select name="gioitinh">
<option value="" '.($res[gioitinh]==''?'selected="selected"':'').'> Dùng chung</option>
<option value="nam" '.($res[gioitinh]==nam?'selected="selected"':'').'> Nam</option>
<option value="nu" '.($res[gioitinh]==nu?'selected="selected"':'').'> Nữ</option>
</select><br/>';
echo 'Hiển thị: <select name="hienthi">
<option value="0" '.($res[hienthi]==0?'selected="selected"':'').'> Hiển thị</option>
<option value="1" '.($res[hienthi]==1?'selected="selected"':'').'> Ẩn</option>
</select><br/>';
echo '<input type="submit" name="submit" value="Lưu">';
echo '</form>';
echo  '</div>';
require('../incfiles/end.php');
?>