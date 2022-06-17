<?php
/* 
Code pokemon được viết bởi Châu Huỳnh
Vui Lòng Để Bản Quyền Nếu Bạn Là Người Có Học
Site : DanChoiViet.Me
*/
define('_IN_JOHNCMS',1);
$rootpath ='../../';
include'../incfiles/core.php';
include'../incfiles/head.php';
if(!$user_id){
header('location: /login.php');

include'../incfiles/end.php';
exit;
}
echo'<div class="phdr">Tạo Nhân Vật</div>';
$shop1 = mysql_fetch_array(mysql_query("SELECT * FROM `shoppkm1` WHERE `id`='1'"));
$shop2 = mysql_fetch_array(mysql_query("SELECT * FROM `shoppkm1` WHERE `id`='2'"));
$shop3 = mysql_fetch_array(mysql_query("SELECT * FROM `shoppkm1` WHERE `id`='3'"));
$shop4 = mysql_fetch_array(mysql_query("SELECT * FROM `shoppkm1` WHERE `id`='4'"));
$shop5 = mysql_fetch_array(mysql_query("SELECT * FROM `shoppkm1` WHERE `id`='5'"));
$shop6 = mysql_fetch_array(mysql_query("SELECT * FROM `shoppkm1` WHERE `id`='6'"));
$shop7 = mysql_fetch_array(mysql_query("SELECT * FROM `shoppkm1` WHERE `id`='7'"));

echo'<div class="da"><div class="lucifer">Game Này Đang Trong Quá Trình Thử Nghiệm Nên Mỗi Tài Khoản Chỉ Chứa Được 1 Nhân Vật. Tức Là Sau Khi Mua Nhân Vật Mới Thì Nhân Vật Củ Sẽ Mất Đi!
Nhân Vật Đi</div>';
echo'<div class="lucifer">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">
<tbody><tr>

<tbody><tr>
<td style="width: 100px; border: 3px solid #5DBEF7;"><center>
<img src="'.$shop4['img'].'"></center></td>
<td style="padding: 5px; vertical-align: top; background: #FFF">Tên: <font color="green">'.$shop4['name'].'</font>
</br>Giá: '.$shop4['gia'].' lượng
</br>Máu: '.$shop4['hp'].' <font color="red">[+80 máu/mỗi cấp]</font>
</br>Sức Mạnh: '.$shop4['sm'].' <font color="#2b7d7a">[+270 SM/mỗi cấp]</font">
</br><a href="mua.php?id=4" class="chat"><font color="#FFF">Mua</font></a>
</td></tr></tbody></table></br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">
<tbody><tr>
<td style="width: 100px; border: 3px solid #5DBEF7;"><center>
<img src="'.$shop3['img'].'"></center></td>
<td style="padding: 5px; vertical-align: top; background: #FFF">Tên: <font color="green">'.$shop3['name'].'</font>
</br>Giá: '.$shop3['gia'].' lượng
</br>Máu: '.$shop3['hp'].' <font color="red">[+300 máu/mỗi cấp]</font>
</br>Sức Mạnh: '.$shop3['sm'].' <font color="#2b7d7a">[+150 SM/mỗi cấp]</font">
</br><a href="mua.php?id=3" class="chat"><font color="#FFF">Mua</font></a>
</td></tr></tbody></table></br>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">
<tbody><tr>
<td style="width: 100px; border: 3px solid #5DBEF7;"><center>
<img src="'.$shop2['img'].'"></center></td>
<td style="padding: 5px; vertical-align: top; background: #FFF">Tên: <font color="green">'.$shop2['name'].'</font>
</br>Giá: '.$shop2['gia'].' lượng
</br>Máu: '.$shop2['hp'].' <font color="red">[+200 máu/mỗi cấp]</font>
</br>Sức Mạnh: '.$shop2['sm'].' <font color="#2b7d7a">[+150 SM/mỗi cấp]</font">
</br><a href="mua.php?id=2" class="chat"><font color="#FFF">Mua</font></a>
</td></tr></tbody></table></br>

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">
<tbody><tr>
<td style="width: 100px; border: 3px solid #5DBEF7;"><center>
<img src="'.$shop5['img'].'"></center></td>
<td style="padding: 5px; vertical-align: top; background: #FFF">Tên: <font color="green">'.$shop4['name'].'</font>
</br>Giá: '.$shop5['gia'].' lượng
</br>Máu: '.$shop5['hp'].' <font color="red">[+80 máu/mỗi cấp]</font>
</br>Sức Mạnh: '.$shop5['sm'].' <font color="#2b7d7a">[+270 SM/mỗi cấp]</font">
</br><a href="mua.php?id=4" class="chat"><font color="#FFF">Mua</font></a>
</td></tr></tbody></table></br>

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">
<tbody><tr>
<td style="width: 100px; border: 3px solid #5DBEF7;"><center>
<img src="'.$shop1['img'].'"></center></td>
<td style="padding: 5px; vertical-align: top; background: #FFF">Tên: <font color="green">'.$shop1['name'].'</font>
</br>Giá: '.$shop1['gia'].' lượng
</br>Máu: '.$shop1['hp'].'<font color="red">[+200 máu/mỗi cấp]</font>
</br>Sức Mạnh: '.$shop1['sm'].' <font color="#2b7d7a">[+200 SM/mỗi cấp]</font">
</br><a href="mua.php?id=1" class="chat"><font color="#FFF">Mua</font></a>
</td></tr></tbody></table></br>




';
include'../incfiles/end.php';
?>
<style>
.chat{font-size:12px;background-color:#3688c7;border:#e5e5e5 1px solid;color:#fff;;width:auto;;height:25px;padding-left:5px;padding-bottom:2px;padding-right:5px;padding-top:2px;font-weight:bold;margin-left:2px;text-decoration:bold;-moz-border-radius:5px;-webkit-border-radius:5px;font-weight:bold}
</style>
<?php
exit;
?>
