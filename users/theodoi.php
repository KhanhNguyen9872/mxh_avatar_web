<?php
/*////mod theo dõi chủ đề cho johncms//////
@tác giả: Hoàng Anh              /////
@hỗ trợ: tuoitre4u.com           /////
//////code theo dõi////////////////*/
define('_IN_JOHNCMS',1);
require_once('../incfiles/core.php');
$textl='Chủ đề đang theo dõi';
require_once('../incfiles/head.php');
echo '<div class="tborder"><div class="phdr">Chủ đề đang theo dõi</div>';
if(!$user_id){
echo 'chức năng chỉ dành cho thành viên đăng kí';
require_once('../incfiles/end.php');
exit;
}
$tong=mysql_result(mysql_query("select count(*) from `theodoi` where `user_id`='$user_id'"),0);
if($tong > 0){
$i=0;
$z=mysql_query("select * from `theodoi`  where `user_id`='$user_id' order by `time` desc limit $start,5;");
while($za=mysql_fetch_array($z)){
echo $i % 2 ? '<div class="list1">' : '<div class="list1">';
echo '<a href="../forum/?id='.$za['topic'].'"><b><font color="2c5170">'.$za['text'].'</font></b></a><br><span color-size="#333:10px;">Bởi : Admin - trả lời : 1 - xem : 1</span> <a href="../forum/theodoi.php?t='.$za['topic'].'"><input type="button" value="Bỏ theo dõi"/></a></div>';
}
if ($tong > 5) {
echo '<div class="menu">' . functions::display_pagination('theodoi.php?', $start, $tong, $kmess) . '</div>' .
'<p><form action="theodoi.php" method="post">' .
'<input type="text" name="page" size="2"/>' .
'<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/>' .
'</form></p>';
} else {
}
} else {
echo '<div class="menu">Không có chủ đề nào đang theo dõi<br/> <br/> <br/></div>';
}
echo '</div>';
require_once('../incfiles/end.php');
?>
