<?php

define('_IN_JOHNCMS', 1);
$headmod = 'journal';
require ('../incfiles/core.php');
$textl = 'Thông báo của bạn';
require ('../incfiles/head.php');

if (!$user_id) {
    echo 'Bạn vui lòng đăng nhập để thực hiện việc này';
    require ('../incfiles/end.php');
    exit;
}
echo '<div class="phdr"><b>Thông báo của bạn</b></div>';
echo '<div class="phdrbox">';
$a = mysql_query("SELECT * FROM `thongbao` WHERE `ok` = '1' and `user` = '" . $user_id . "'");
$b = mysql_fetch_assoc($a);

$c = mysql_num_rows($a);	
/////////	
$sort = isset($_GET['sort']) ? trim($_GET['sort']) : '';



///

$req = mysql_query("SELECT COUNT(*) FROM `thongbao`");
$total = mysql_result($req, 0);
$req = mysql_query("SELECT * FROM `thongbao` WHERE `user` = '".$user_id."' ORDER BY `time` DESC LIMIT  $start, $kmess");
$i = 0;
while (($res = mysql_fetch_assoc($req)) !== false) {
    $link = '';
    $t = mysql_result($req, $i, "text");
    echo $res['ok']==1 ? '<div class="omenu">':'<div class="omenu">';

    echo bbcode::tags(functions::smileys($t));
    echo' ' . functions::thoigian($res['time']) . '';
    echo '</div>';
    ++$i;
}
mysql_query("UPDATE `thongbao` SET `ok`='0' WHERE `user` = '$user_id'");
$q = mysql_query("SELECT * FROM `thongbao` WHERE `user` = '" . $user_id . "'");
$w = mysql_num_rows($q);

if($w ==0){echo '<div class="omenu">Không có thông báo mới nào</div>';}
switch ($act) {
case "del":
       
              if ($user_id) 
              {
                $del = mysql_query("DELETE FROM `thongbao` WHERE `user` = '".$user_id."' and `ok` = '0' ");
                
              echo $del;
          header("location: thongbao.html");
              }
break;
}

///////
echo '<div class="list1"><a href="?act=del"><i class="fa fa-times" aria-hidden="true"></i><b> Xóa tất cả thông báo</b></a></div>';
echo'</div>';
require_once ('../incfiles/end.php');
?>