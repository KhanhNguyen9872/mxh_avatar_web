<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Quản lí mail';
require('../incfiles/head.php');
$kiemtra = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$datauser["id"]."'"));
if($kiemtra['rights'] >= 7){
$res3 = mysql_query("SELECT * FROM `cms_mail` ORDER BY `time` DESC LIMIT $start,$kmess");
$post1 = mysql_fetch_array($res3);
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail`"), 0);

echo "<div class='main-xmenu'><div class='danhmuc'><b>Tin mới nhất</b></div>";
$int=intval($_GET['id']);
while ($post = mysql_fetch_array($res3)){
$res1 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$post["user_id"]."'"));
$res2 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$post["from_id"]."'"));
$timkiem = array( 
				'<script>' => '<b>Bắn đê</b>',
				'</script>' => '<b>Bắn đê</b>',
				); 
            $msg = str_replace(array_keys($timkiem), $timkiem,$post['text']);
echo '
	<div class="list1" style="padding: 20px;"><b style="font-size: 16px;">Nick: <a href="/users/'.$res1['name'].'_'.$post['user_id'].'.html">'.$res1['name'].'</a> gửi tin nhắn đến <a style="font-size: 10px;" href="/users/'.$res2['name'].'_'.$post['from_id'].'.html">'.$res2['name'].'</a> có nội dung là:</br>
	</b>	

	<div class="stream_container">'.$msg.'</div>
';
if($post['file_name'] != ''){
	echo '<br/>Hình ảnh gửi<br/>';
	echo '<img src="/files/mail/'.$post['file_name'].'"/>';
}else{
	echo 'Không có ảnh';
}
echo '</div>';
}
if ($tong > $kmess) {
echo '<div class="menu">' . functions::pages('/mail/quanli-mail.php?page=', $start, $tong, $kmess) . '</div>';
}
}else{
	echo '<div class="list1">Định làm gì thế hả, xem nội dung mật forum sao, Không được đâu sói ạ</div>';
}
echo '</div>';
require('../incfiles/end.php');
?>