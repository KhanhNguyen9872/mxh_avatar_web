<?php
/* 
Code pokemon được viết bởi Châu Huỳnh
Vui Lòng Để Bản Quyền Nếu Bạn Là Người Có Học
Site : DanChoiViet.Me
*/
define('_IN_JOHNCMS',1);
$rootpath='../../';
include'../incfiles/core.php';
include'../incfiles/head.php';
if(!$user_id){
echo'Đăng Nhập Đi';
include'../incfiles/end.php';
exit;
}
echo'<div class="phdr">Danh Sách Quái | <a href="/idthienan_ninja">Trở Về Làng</a></div><div class="da"><div>';
$timepl = time();
if ($datauser['timepkm']+3600 > $timepl) {
$timepl = $datauser['timepkm'] + 3600 - time();
echo'<div class="lucifer">Sau '.date('H:i', $timepl).' Bạn Mới Có Thể Đánh Pokémon Tiếp</div>';
}
$newticker = mysql_query("SELECT * FROM `pkmchien` WHERE `id_user` = '0'");
while ($arr = mysql_fetch_array($newticker)) {
echo'<div class="lucifer"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">
<tbody><tr>
<td style="width: 100px; border: 3px solid #5DBEF7;"><center>
<img src="'.$arr['img'].'"></center></td>
<td style="padding: 5px; vertical-align: top; background: #FFF">Tên: <font color="green">'.$arr['name'].'</font>
</br>Máu: <font color="red">'.$arr['hp'].'/'.$arr['hpfull'].'</font>
</br>Sức Mạnh: <font color="green">'.$arr['sm'].'</font>
</br><a href="tc.php?id='.$arr['id'].'" class="chat"><font color="#FFF">Tấn công</font></a>
</td></tr></tbody></table></div>';
}
include'../incfiles/end.php';
?>
<style>
.chat{font-size:12px;background-color:#3688c7;border:#e5e5e5 1px solid;color:#fff;;width:auto;;height:25px;padding-left:5px;padding-bottom:2px;padding-right:5px;padding-top:2px;font-weight:bold;margin-left:2px;text-decoration:bold;-moz-border-radius:5px;-webkit-border-radius:5px;font-weight:bold}
</style>