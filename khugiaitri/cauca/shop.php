<?php
define('_IN_JOHNCMS',1);

if (!$user_id) {
header('Location: /login.php');
exit;
}
$textl='Shop sinh thái';

echo '<div><div class="mainblok">';
echo '<link rel="stylesheet" type="text/css" href="/khumuasam/stylexoan.css">';
echo '<div class="phdr"><center>'.$textl.'</center></div>';
echo '<div class="lucifer">';
$cc1=10000;
$cc2=5;
$cc3=20;
$time=7*24*3600+time();
if (isset($_POST[buy_cc])) {
$cancau=(int)$_POST[cancau];
if (empty($_POST[cancau])) {
echo '<div class="rmenu">Chọn 1 loại và mua!</div>';
} else if($cancau!=1&&$cancau!=2&&$cancau!=3) {
echo '<div class="rmenu">Ko bug đc đâu</div>';
} else {
if ($cancau==1) {
if ($datauser[xu]<$cc1) {
echo '<div class="rmenu">Không đủ tiền!</div>';
} else {
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$cc1."' WHERE `id`='".$user_id."'");
mysql_query("INSERT INTO `khodo` SET
 `id_shop`='759',
 `user_id`='".$user_id."',
 `id_loai`='1',
 `tenvatpham` ='Cần câu tre',
  `timesudung` ='".$time."',
 `loai`='cancau'");
mysql_query("UPDATE `fish_ruong` SET `doben`='100' WHERE `user_id`='".$user_id."' AND `loai`='cancau' AND `id_loai`='1'");
echo '<div class="rmenu">Mua thành công!</div><div class="login"><a href="/khugiaitri/cauca/index.php"><i class="fa fa-reply" aria-hidden="true"></i> Trở lại khu câu cá</a></div>';
}
}
if ($cancau==2) {
if ($datauser[vnd]<$cc2) {
echo '<div class="rmenu">Không đủ tiền!</div>';
} else {
mysql_query("UPDATE `users` SET `vnd`=`vnd`-'".$cc2."' WHERE `id`='".$user_id."'");
mysql_query("INSERT INTO `khodo` SET
 `id_shop`='760',
 `user_id`='".$user_id."',
 `id_loai`='2',
 `tenvatpham` ='Cần câu sắt',
 `timesudung` ='".$time."',
 `loai`='cancau'");
mysql_query("UPDATE `fish_ruong` SET `doben`='100' WHERE `user_id`='".$user_id."' AND `loai`='cancau' AND `id_loai`='2'");
echo '<div class="rmenu">Mua thành công!</div><div class="login"><a href="/khugiaitri/cauca/index.php"><i class="fa fa-reply" aria-hidden="true"></i> Trở lại khu câu cá</a></div>';
}
}
if ($cancau==3) {
if ($datauser[vnd]<$cc3) {
echo '<div class="rmenu">Không đủ tiền!</div>';
} else {
mysql_query("UPDATE `users` SET `vnd`=`vnd`-'".$cc3."' WHERE `id`='".$user_id."'");
mysql_query("INSERT INTO `khodo` SET
 `id_shop`='761',
 `user_id`='".$user_id."',
 `id_loai`='3',
 `tenvatpham` ='Cần câu VIP',
  `timesudung` ='".$time."',
 `loai`='cancau'");
mysql_query("UPDATE `fish_ruong` SET `doben`='100' WHERE `user_id`='".$user_id."' AND `loai`='cancau' AND `id_loai`='3'");
echo '<div class="rmenu">Mua thành công!</div><div class="login"><a href="/khugiaitri/cauca/index.php"><i class="fa fa-reply" aria-hidden="true"></i> Trở lại khu câu cá</a></div>';
}
}
}
}
echo '<form method="post">';
$qcc=mysql_query("SELECT * FROM `shopdo` WHERE `loai`='cancau'");
while($rcc=mysql_fetch_array($qcc)) {
echo '<div class="list1"><img src="/images/shop/'.$rcc[id].'.png" class="avatar_vina"><input type="radio" name="cancau" value="'.$rcc[id_loai].'"><br/><b>'.$rcc[tenvatpham].'</b><br/>Giá: '.$rcc[gia].' '.($rcc[loaitien]==xu?'Xu':'Lượng').'<br/></div>';
}
echo '<input type="submit" name="buy_cc" value="Mua" class="buttonxoan">';
echo '</form>';
echo '</br><font color="brown"><b>Shop mồi</b></font>';
$moi1=500;
$moi2=1500;
$moi3=3000;
if (isset($_POST[buy_moi])) {
$moicau=(int)$_POST[moicau];
if (empty($_POST[moicau])) {
echo '<div class="rmenu">Chọn 1 loại và mua!</div>';
} else if($moicau!=1&&$moicau!=2&&$moicau!=3) {
echo '<div class="rmenu">Ko bug đc đâu</div>';
} else {
if ($moicau==1) {
if ($datauser[xu]<$moi1) {
echo '<div class="rmenu">Không đủ tiền!</div>';
} else {
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$moi1."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'100' WHERE `user_id`='".$user_id."' AND `id_shop`='5'");
echo '<div class="list1">Mua thành công!</div><div class="login"><a href="/khugiaitri/cauca/index.php"><i class="fa fa-reply" aria-hidden="true"></i> Trở lại khu câu cá</a></div>';
}
}
if ($moicau==2) {
if ($datauser[xu]<$moi2) {
echo '<div class="rmenu">Không đủ tiền!</div>';
} else {
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$moi2."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'100' WHERE `user_id`='".$user_id."' AND `id_shop`='6'");
echo '<div class="list1">Mua thành công!</div><div class="login"><a href="/khugiaitri/cauca/index.php"><i class="fa fa-reply" aria-hidden="true"></i> Trở lại khu câu cá</a></div>';
}
}
if ($moicau==3) {
if ($datauser[xu]<$moi3) {
echo '<div class="rmenu">Không đủ tiền!</div>';
} else {
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$moi3."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'100' WHERE `user_id`='".$user_id."' AND `id_shop`='7'");
echo '<div class="list1">Mua thành công!</div><div class="login"><a href="/khugiaitri/cauca/index.php"><i class="fa fa-reply" aria-hidden="true"></i> Trở lại khu câu cá</a></div>';
}
}
}
}
echo '<form method="post">';
echo '<div class="list1"><img src="/images/moicau/1.png" class="avatar_vina"><input type="radio" name="moicau" value="1"><br/><b>100 Mồi cơm</b><br/>Giá: '.$moi1.' xu<br/></div>';
echo '<div class="list1"><img src="/images/moicau/2.png" class="avatar_vina"><input type="radio" name="moicau" value="2"><br/><b>100 Mồi trùng</b><br/>Giá: '.$moi2.' xu<br/></div>';
echo '<div class="list1"><img src="/images/moicau/3.png" class="avatar_vina"><input type="radio" name="moicau" value="3"><br/><b>100 Mồi trứng kiến</b><br/>Giá: '.$moi3.' xu<br/></div>';
echo '<input type="submit" name="buy_moi" value="Mua" class="buttonxoan">';
echo '</form>';
echo '</div>';

?>
                            
                            