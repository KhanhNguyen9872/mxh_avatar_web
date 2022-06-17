<?PHP
Define('_IN_JOHNCMS', 1);
Require('../incfiles/core.php');
$headmod = 'Làng cổ';
$textl = 'Làng Truyền Thuyết';
Require('../incfiles/head.php');
Include('hoisinh.php');
if (!$user_id){
Header("Location: /");
exit;
}
Echo '<div class="box_forums"><br/><div class="homeforum"><div class="icon-home"><div class="home">Làng Truyền Thuyết</div></div></div></div><div class="phdr">Đổi quà</div>';
if(isset($_POST['doiqua'])){
if($datauser['tichluy'] >= 300){
mysql_query("UPDATE `users` SET `tichluy` = `tichluy` - '300' WHERE `id` = $user_id");
$randqua = rand(8,11);
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$randqua."'");
$query=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `id`='".$randqua."'");
$info=mysql_fetch_array($query);
echo'<div class="omenu"><img src="/images/qua.png" alt="Nhận quà"/> Bạn đã đổi quà và nhận được '.$info[tenvatpham].' !</div>';
}else{
echo'<div class="omenu">Bạn không đủ 300 điểm tích lũy để đổi !!</div>';
}
}
echo'<div class="menu">Bạn có muốn đổi 300 điểm tích lũy lấy 1 ngọc cường hóa không !!</div>
<div class="menu"><form method="post"><input type="submit" name="doiqua" value="Đổi quà" /></form></div>';
echo'<div><div>';
Require('../incfiles/end.php');
?>