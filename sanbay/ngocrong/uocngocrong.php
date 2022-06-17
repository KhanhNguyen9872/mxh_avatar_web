<?php
define('_IN_JOHNCMS',1);
require('../../incfiles/core.php');
$textl='Rồng Thần';
require('../../incfiles/head.php');
echo '<div class="mainblok">';
if (!$user_id) {
header('Location: /login.php');
exit;
}
if ($rights == 9) {
if (isset($_GET['add'])) {
	echo '<div class="phdr">Thêm vật phẩm</div>';
	if (isset($_POST['submit'])) {
		if (empty($_POST['vatpham'])) {
			echo '<div class="menu">Không được để trống</div>';
		} else {
			$vp = intval($_POST['vatpham']);
			mysql_query("INSERT INTO `item_nro` (vatpham) VALUES ($vp)");
			$bot='[b]Ironman[/b] đã thêm item vào ước ngọc rồng từ 1 - 7 sao';
mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($bot) . "', `time`='".time()."'");
			echo '<div class="menu">Thêm thành công</div>';
		}
	}
	echo '<form method="post"><div class="rmenu">
	ID shop: <input type="text" size="3" name="vatpham"> <input type="submit" value="Thêm" name="submit">
	</div></form></div>';
	require('../../incfiles/end.php');
	exit;
}
}
echo '<div class="phdr"><center>Rồng thần</center></div><div class="lucifer">';
echo'</br><center><img src="/images/rongthan.png"></center>';
echo '<div class="login"><center><font color="brown"><b> Nói ta nghe ngươi muốn ước gì ?    <img src="http://l.yimg.com/us.yimg.com/i/mesg/emoticons7/19.gif"></font></b></center></div>';
//hướng dẫn kiếm ngọc rồng
echo '<a id="c"><div class="menu"><img src="/icon/next.png"><b> Cách kiếm ngọc rồng</b></div></a><div id="cc" style="display: none;">
<img src="/images/vatpham/13.png"> ngọc rồng 1 sao kiếm từ dò rada cấp 2</br>
<img src="/images/vatpham/14.png"> ngọc rồng 2 sao kiếm từ khai thác kim cương , dò rada cấp 1</br>
<img src="/images/vatpham/15.png"> ngọc rồng 3 sao kiếm từ khai thác kim cương , dò rada cấp 1</br>
<img src="/images/vatpham/16.png"> ngọc rồng 4 sao kiếm từ thu hoạch farm</br>
<img src="/images/vatpham/17.png"> ngọc rồng 5 sao kiếm từ thu hoạch farm</br>
<img src="/images/vatpham/18.png"> ngọc rồng 6 sao kiếm từ câu cá</br>
<img src="/images/vatpham/19.png"> ngọc rồng 7 sao kiếm từ câu cá</br>
</div>';
//ước ngọc rồng từ 1 đến 7 sao
echo '<a id="p"><div class="menu"><img src="/icon/next.png"><b> ước ngọc rồng từ 1 đến 7 sao</b></div></a><div id="pp" style="display: none;">
<div class="bautroiboss"><center><img src="/icon/rongthan.png" width="120px">
<div class="login"><a href="1-7.php?act=item"><font color="red"><b>Ước Item</font></b></a></div>
<div class="login"><a href="1-7.php?act=sucmanh"><font color="green"><b>Ước Sức Mạnh</font></b></a></div>
<div class="login"><a href="1-7.php?act=HP"><font color="blue"><b>Ước Hp</font></b></a></div>
</center></div></div>';
//ước ngọc rồng từ 2 đến 7 sao
echo '<a id="b"><div class="menu"><img src="/icon/next.png"><b> ước ngọc rồng từ 2 đến 7 sao</b></div></a><div id="bb" style="display: none;">
<div class="bautroiboss"><center><img src="/images/rongthan.png">
<div class="login"><a href="2-7.php?act=sucmanh"><font color="green"><b>Ước Sức Mạnh</font></b></a></div>
<div class="login"><a href="2-7.php?act=HP"><font color="blue"><b>Ước Hp</font></b></a></div>
</center>';
echo '</div></div>';
include 'xuli.php';
require('../../incfiles/end.php');
?>