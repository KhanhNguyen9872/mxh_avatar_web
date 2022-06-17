<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Mã quà tặng';
require('../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /index.php');
exit;
}
switch($act) {
case 'addgift':
?>
<script language="javascript">
	$(document).ready(function(){
		$('#one').hide();
		$('#two').hide();
		$('#btn').click(function(){
			if ($('#typeGift').val()=='one') {
				$('#one').slideDown(500);
				$('#two').slideUp(200);
			} else if ($('#typeGift').val()=='two') {
				$('#two').slideDown(500);
				$('#one').slideUp(200);
			} else {
				alert('Chưa chọn loại gift kìa!!!');
			}
		});
	});
</script>
<?php
if ($rights>=7) {
echo '<div class="phdr">Tạo gift code</div><div class="da"><div class="lucifer">';
if (isset($_POST[tao])) {
//random ma gift
function rand_string($length) {
$chars ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$size = strlen($char);
for($i = 0; $i<$length; $i++) {
$str .= $chars[rand(0, $size -1)];
$str=substr(str_shuffle($chars), 0, $length);
}
return $str;
}

if ($_POST['typegift'] == 'two')
{
if ($_POST[soluong]>50) {
$_POST[soluong]=50;
} else if (empty($_POST['soluong']))
{
$_POST['soluong'] = 1;
}
$i=1;
while ($i<=$_POST[soluong]) {
$random = rand_string(8);
mysql_query("INSERT INTO `giftcode` SET
`code`='".$random."',
`danhmuc`='".$_POST[mucgift]."'
");
echo '<div class="news">Tạo thành công. Mã: <b>'.$random.'</b></div>';
$i++;
}
}
else if ($_POST['typegift'] == 'one')
{
if (empty($_POST['code']))
{
echo '<div class="rmenu">Bạn không được bỏ trống</div>';
}
else
{
mysql_query("INSERT INTO `giftcode` SET
`code`='".$_POST['code']."',
`danhmuc`='".$_POST[mucgift]."'
");
echo '<div class="news">Tạo thành công. Mã: <b>'.$_POST['code'].'</b></div>';
}
}
}
echo 'Type gift: <select id="typeGift">
<option value="other"> --Chọn loại gift-- </option>
<option value="one">One</option>
<option value="two">Two</option>
</select> <input id="btn" value="Chọn" type="button">';
echo '<form id="one" method="post"><input type="hidden" name="typegift" value="one">';
$rip=mysql_query("SELECT * FROM `mucgift` WHERE `loaigift` = 'only'");
echo 'Mục Gift: <select name="mucgift">';
while($code=mysql_fetch_array($rip)) {
echo '<option value="'.$code[id].'"> '.$code[tenmuc].'</option>';
}
echo '</select><br/>
Mã code: <input type="text" maxlength="8" size="8" name="code">';
echo '<input type="submit" name="tao" value="Tạo">';
echo '</form>';
echo '<form id="two" method="post"><input type="hidden" name="typegift" value="two">';
$rip=mysql_query("SELECT * FROM `mucgift` WHERE `loaigift` = 'many'");
echo 'Mục Gift: <select name="mucgift">';
while($code=mysql_fetch_array($rip)) {
echo '<option value="'.$code[id].'"> '.$code[tenmuc].'</option>';
}
echo '</select> x <input type="text" size="1" name="soluong">';
echo '<input type="submit" name="tao" value="Tạo">';
echo '</form>';
}
break;
default:
echo '<div class="phdr">Nhận quà từ mã Gift</div><div class="da"><div class="lucifer">';
if (isset($_POST[submit])) {
$code=functions::checkout($_POST[gift]);
$check=mysql_num_rows(mysql_query("SELECT * FROM `giftcode` WHERE `code`='".$code."'"));
$cross=mysql_fetch_array(mysql_query("SELECT * FROM `giftcode` WHERE `code`='".$code."'"));
if ($check<1) {
echo '<div class="rmenu">Code không tồn tại hoặc đã sử dụng!</div>';
} else {
$pro=mysql_fetch_array(mysql_query("SELECT * FROM `mucgift` WHERE `id`='".$cross[danhmuc]."'"));
$query=$pro[query];
$query = str_replace('$user_id', $user_id, $query);
$num_log=mysql_num_rows(mysql_query("SELECT * FROM `log_gift` WHERE `user_id`='".$user_id."' AND `danhmuc`='".$cross[danhmuc]."'"));
if ($num_log>0) {
$log_gift=mysql_fetch_array(mysql_query("SELECT * FROM `log_gift` WHERE `user_id`='".$user_id."' AND `danhmuc`='".$cross[danhmuc]."'"));
if ($log_gift[code]=='only') {
echo '<div class="rmenu">Bạn đã nhận quà 1 lần bằng gift code loại này rồi nhé!</div>';
} else {
mysql_query($query);
//mysql_query("DELETE FROM `giftcode` WHERE `code`='".$code."'");
mysql_query("INSERT INTO `log_gift` SET `user_id`='".$user_id."',`code`='".$pro[loaigift]."',`danhmuc`='".$cross[danhmuc]."'");
echo '<div class="gmenu">Nhận quà thành công!!!</div>';
}
} else {
mysql_query($query);
if ($pro['loaigift'] == 'many')
{
mysql_query("DELETE FROM `giftcode` WHERE `code`='".$code."'");
}
mysql_query("INSERT INTO `log_gift` SET `user_id`='".$user_id."',`code`='".$pro[loaigift]."',`danhmuc`='".$cross[danhmuc]."'");
echo '<div class="gmenu">Nhận quà thành công!</div>';
}
}
}
echo '<div class="menu congdong">';
echo '<form method="post">';
echo 'Nhập mã: <input type="text" name="gift">';
echo '<input type="submit" name="submit" value="Nhận quà">';
echo '</form>';
echo '</div>';
if ($rights>=9) {
echo '<br><br><div class="phdr">Tools Admin</div>';
echo '<div class="omenu"><a href="?act=addgift">Thêm mã gift</a></div>';
if ($rights>=9) {
echo '<div class="omenu"><a href="?act=danhmuc">Thêm danh mục</a></div>';
}
echo '<div class="omenu"><a href="?act=allgift">All gift</a></div>';
//echo '<div class="omenu"><a href="?act=info">Info danh mục</a></div>';
}
break;
case 'danhmuc':
if ($rights==9) {
echo '<div class="phdr">Mục Gift</div><div class="da"><div class="lucifer">';
if (isset($_POST[submit])) {
mysql_query("INSERT INTO `mucgift` SET
`tenmuc`='".$_POST[danhmuc]."',
`loaigift`='".$_POST[loaigift]."'
");
}
echo '<form method="post">';
echo '<table>';
echo '<tr><td>Tên mục:</td> <td><input type="text" name="danhmuc"></td><tr>';
echo '<tr><td>Loại gift:</td> <td>
<select name="loaigift"><option value="only"> Loại dùng chung 1 lần</option><option value="many"> Loại khác</option></select>
</td></tr>';
echo '<tr><td></td><td><input type="submit" name="submit" value="Tạo"></td></tr>';
echo '</table>';
echo '</form>';
}
break;
case 'info':
echo '<div class="phdr">Thông tin mục gift</div>';
break;
case 'allgift':
echo '<div class="phdr">Chọn danh mục';
$dm=mysql_query("SELECT * FROM `mucgift`");
?>
<select name="url"size="1"onChange="window.open(this.options [this.selectedIndex].value,'_top')" style="border: 0;">
<?php
echo '<option value="">---Chọn---</option>';
while($pdm=mysql_fetch_array($dm)) {
echo '<option value="?act=allgift&id='.$pdm[id].'"  '.($_GET[id] == $pdm[id] ? 'selected="selected"' : '').'> '.$pdm[tenmuc].'</option>';
}
echo '</select>';
echo '</div>';
$lg=mysql_query("SELECT * FROM `giftcode` WHERE `danhmuc`='".$_GET[id]."' LIMIT $start, $kmess");
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `giftcode` WHERE `danhmuc`='".$_GET[id]."'"),0);
while($plg=mysql_fetch_array($lg)) {
echo '<div class="list1">'.$plg[code].'</div>';
}
if ($tong==0) {
echo '<div class="rmenu">Không có gift</div>';
}
if ($tong>$kmess) {
echo '<div class="menu">'.functions::pages('code.php?act=allgift&id='.$_GET[id].'&page=',$start,$tong,$kmess).'</div>';
}
break;
}
echo '</div>';
require('../incfiles/end.php');
?>