<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Mua vật phẩm cho nhóm';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
$neptune=mysql_num_rows(mysql_query("SELECT * FROM `nhom` WHERE `user_id`='".$user_id."'"));
if (!$neptune) {
echo '<div class="phdr">Lỗi!</div>';
echo '<div class="rmenu">Bạn không có quyền thực hiện điều này</div>';
} else {
switch($act) {
case 'mua':
	$query=mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$id."' AND `clan`='1'");
	$num=mysql_num_rows($query);
	$tontai=mysql_num_rows(mysql_query("SELECT * FROM `clan_kho` WHERE `vp`='".$id."' AND `clan`=".$neptune[id]."'"));
	$post=mysql_fetch_array($query);
	echo '<div class="phdr">Mua '.$post[tenvatpham].'</div>';
	if (!$num) {
		echo '<div class="rmenu">Không tồn tại vât phẩm này!</div>';
	} else if ($tontai) {
		echo '<div class="rmenu">Nhóm bạn đã có vật phầm này</div>';
	} else {
		$nhom=mysql_fetch_array(mysql_query("SELECT * FROM `nhom` WHERE `user_id`='".$user_id."'"));
		if ($post[loaitien]==xu) {
			if ($nhom[xu]<$post[gia]) {
				echo '<div class="rmenu">Không đủ tiền</div>';
			} else {
				mysql_query("INSERT INTO `clan_kho` SET `clan`='".$nhom[id]."',`vp`='".$post[id]."'");
				mysql_query("UPDATE `nhom` SET `xu`=`xu`-'".$post[gia]."' WHERE `user_id`='".$user_id."'");
				echo '<div class="menu">Mua thành công</div>';
			}
		} else {
			if ($nhom[luong]<$post[gia]) {
				echo '<div class="rmenu">Không đủ tiền</div>';
			} else {
				mysql_query("INSERT INTO `clan_kho` SET `clan`='".$nhom[id]."',`vp`='".$post[id]."'");
				mysql_query("UPDATE `nhom` SET `luong`=`luong`-'".$post[gia]."' WHERE `user_id`='".$user_id."'");
				echo '<div class="menu">Mua thành công</div>';
			}
		}
	}
break;
default:
echo '<div class="phdr">Mua vật phẩm</div>';
$tong=mysql_result(mysql_query("SELECT COUNT(*) FROM `shopdo` WHERE `clan`='1'"));
$req=mysql_query("SELECT * FROM `shopdo` WHERE `clan`='1'");
while($res=mysql_fetch_array($req)) {
echo '<div class="omenu"><img src="/images/shop/'.$res[id].'.png" class="avatar_vina">
<b><font color="green">['.$res[tenvatpham].']</font></b><br/>';
echo 'Giá: <font color="black"><b>'.$res[gia].'</b> '.($res[loaitien]=='xu'?'Xu':'Lượng').'</font><br/>';
echo '<a href="?act=mua&id='.$res[id].'"><input type="button" class="nut" value="Mua"></a><br/><br/></div>';
}
break;
}
}
require('../incfiles/end.php');
?>