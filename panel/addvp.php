<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Thêm vật phẩm';
require('../incfiles/head.php');
if (!$user_id||$rights!=9) {
header('Location: /login.php');
}
?>
<script language="javascript">
	$(document).ready(function(){
		$('#form-vp').hide();
		$('#form-do').hide();
		$('#btn').click(function(){
			if ($('#loaido').val()=='vatpham') {
				$('#form-vp').slideDown(500);
				$('#form-do').slideUp(200);
			} else if ($('#loaido').val()=='do') {
				$('#form-do').slideDown(500);
				$('#form-vp').slideUp(200);
			} else {
				alert('Chưa chọn loại đồ kìa...');
			}
		});
	});
</script>
<?php
echo '<div class="mainblok">';
echo '<div class="phdr">'.$textl.'</div>';
echo '<div class="gmenu"><select id="loaido"><option>--Chọn loại đồ--</option><option value="vatpham"> Vật phẩm</option><option value="do"> Đồ</option></select> <input type="button" id="btn" value="Chọn"></div>';
if (isset($_POST['submit'])) {
if ($_POST['loaido']=='vatpham') {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$_POST['soluong']."' WHERE `user_id`='".$_POST['user']."' AND `id_shop`='".$_POST['vp']."'");
echo '<div class="menu">Thêm đồ thành công</div>';
} else if ($_POST['loaido']=='do') {
if (empty($_POST['shopid'])) {
$res=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$_POST['vp']."'"));
} else {
$res=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$_POST['shopid']."'"));
}
mysql_query("INSERT INTO `khodo` SET
`user_id`='".$_POST['user']."',
`id_shop`='".$res['id']."',
`id_loai`='".$res['id_loai']."',
`loai`='".$res['loai']."',
`tenvatpham`='".$res['tenvatpham']."'
");
echo '<div class="menu">Thêm đồ thành công</div>';
}
}
echo '<form id="form-vp" method="post">
<table>
<input type="hidden" value="vatpham" name="loaido">
<tr><td>User ID:</td><td><input type="text" name="user"></td></tr><tr><td>Vật phẩm:</td><td><select name="vp">';
$rvp=mysql_query("SELECT * FROM `shopvatpham`");
while($vp=mysql_fetch_array($rvp)) {
echo '<option value="'.$vp['id'].'"> '.$vp['tenvatpham'].'</option>';
}
echo '</td></select></tr><tr><td>Số lượng:</td><td><input type="text" size="2" name="soluong"></td></tr>
<tr><td></td><td><input type="submit" name="submit" value="Thêm"></td></tr>
</table>
</form>';
echo '<form id="form-do" method="post">
<table>
<input type="hidden" value="do" name="loaido">
<tr><td>User ID:</td><td><input type="text" name="user"></td></tr>
<tr class="rmenu"><td>Vật phẩm:</td><td><select name="vp">';
$rvp=mysql_query("SELECT * FROM `shopdo`");
while($vp=mysql_fetch_array($rvp)) {
echo '<option value="'.$vp['id'].'"> '.$vp['tenvatpham'].'</option>';
}
echo '</td></select></tr><tr class="rmenu"><td>ID shop:</td> <td><input type="text" name="shopid" size="2"></td></tr>
<tr><td></td><td><input type="submit" name="submit" value="Thêm"></td></tr>
</table>
</form>';
echo '<div>';
require('../incfiles/end.php');

?>