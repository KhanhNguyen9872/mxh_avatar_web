<?PHP
Define('_IN_JOHNCMS', 1);
Require('../incfiles/core.php');
$headmod = 'Làng cổ';
$textl = 'Làng Truyền Thuyết';
Require('../incfiles/head.php');
Include('hoisinh.php');
if (!$user_id){
header("Location: /");
exit;
}
Echo '<div class="box_forums"><br/><div class="homeforum"><div class="icon-home"><div class="home">Làng Truyền Thuyết</div></div></div></div><div class="phdr">Làng Truyền Thuyết</div>';
Echo'<link rel="stylesheet" href="game.css" type="text/css" />';
switch ($act){
case 'muahpmp':
$giahp = '1000';
$giamp = '1000';
$u = $user_id;
$s = (int)$_POST['s'];
$thp = $s * $giahp;
$tmp = $s * $giamp;
Echo'<div class="omenu"><form method="post">1 HP <img src="http://4rumvn.net/icon/vao.png"> = '.$giahp.' xu<br> <input type="number" name="s" placeholder="Nhập số lượng 00 - 99"><br> <input type="submit" name="muahp" value="Mua"></form></div>';
Echo'<div class="omenu"><form method="post">1 MP <img src="http://4rumvn.net/icon/vao.png"> = '.$giamp.' xu<br> <input type="number" name="s" placeholder="Nhập số lượng 00 - 99"><br> <input type="submit" name="muamp" value="Mua"></form></div>';
if(isset($_POST['muahp'])){
if($s < 1 || $t > $datauser['xu'] || $s > 99){
Echo'<div class="omenu">Giao dịch
thất bại !! <a href="index.php">Trở về '.$textl.'</a></div>';
}else{
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$thp."' WHERE `id`='".$u."'");
//Vật phẩm HP
Echo'<div class="omenu">Giao dịch
thành công !! <a href="index.php">Trở về '.$textl.'</a></div>';
}
}
if(isset($_POST['muamp'])){
if($s < 1 || $t > $datauser['xu'] || $s > 99){
Echo'<div class="omenu">Giao dịch
thất bại !! <a href="index.php">Trở về '.$textl.'</a></div>';
}else{
mysql_query("UPDATE `users` SET `xu`=`xu`-'".$thp."' WHERE `id`='".$u."'");
//Vật phẩm MP
Echo'<div class="omenu">Giao dịch
thành công !! <a href="index.php">Trở về '.$textl.'</a></div>';
}
}
break;
default:
Echo'<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;"><tr><td width="50px;" class="blog-avatar"><img src="img/npcsoi.png"/></td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0"><tbody><tr><td class="current-blog" rowspan="2" style=""><div class="blog-bg-left"><img src="/giaodien/images/left-blog.png"></div><img src="/images/on.png" alt="online"/><font color="red"> <b> NPC Katana </b></font><div class="text"><div class="omenu"><img src="http://4rumvn.net/icon/vao.png"><a href="vao.php"> Vào Làng Truyền Thuyết </a></div><div class="omenu"><img src="http://4rumvn.net/icon/vao.png"><a href="lathinh.php"> Lật hình </a></div><div class="omenu"><img src="http://4rumvn.net/icon/vao.png"><a href="doiqua.php"> Đổi quà </a></div><div class="omenu"><img src="http://4rumvn.net/icon/vao.png"><a href="bxh.php"> Bảng Xếp Hạng </a></div></div></div></td></tr></tbody></table></td></tr></tbody></table><div><div>';
break;
}
Require('../incfiles/end.php');
?> 