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
echo'<div class="phdr">Danh Sách PoKéMon</div>';
$newticker = mysql_query("SELECT * FROM `tuipkm` WHERE `id` ORDER BY `time` DESC LIMIT $start , $kmess");
while ($arr = mysql_fetch_array($newticker)) {
echo'<div class="list2">'.nick($arr['user_id']).' : <img src="'.$arr['img'].'"> : Level : '.$arr['lv'].' </div>';
}
include'../incfiles/end.php';