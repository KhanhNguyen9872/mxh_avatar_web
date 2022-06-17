<?php
$kh=mysql_query("SELECT * FROM `kethon` WHERE `nguoi_ay`='".$user_id."' AND `dongy`='0' ORDER BY `time` LIMIT 1");
while($kethon=mysql_fetch_array($kh)) {
$cc=mysql_fetch_array(mysql_query("SELECT * FROM  `users` WHERE `id`='".$kethon[user_id]."'"));
if (isset($_POST['dongy'])) {
if ($datauser['nguoiyeu']!=0) {
echo '<div class="rmenu">Bạn đã có người yêu!</div>';
} else if ($cc['nguoiyeu']!=0) {
echo '<div class="rmenu">Bạn đã đến chậm 1 bước... người ấy đã trờ thành hoa đã có chậu</div>';
} else {
if ($kethon['dongy']==0) {
$top=385;
$ten ='Lễ Thành Hôn Của '.$datauser['name'].' và '.$cc['name'].'';
$noidung ='Hôm nay không nắng không mưa, nhiệt độ không thấp không cao, nói chung là mát mẻ, ruồi không có, muỗi cũng không.
Ngày thì lành mà tháng cũng tốt. Được sự chứng kiến của anh em trong wap, đôi bạn '.$datauser['name'].' và '.$cc['name'].' đã cùng nhau xây dựng thành một gia đình. Một đám cưới thật hoành tá tràng. Mọi người vào trung vui và Comment đề mừng cho đôi bạn trẻ nhé!. Hai con có hứa sau khi trở thành vợ chồng thì sẽ yêu thương nhau, có phúc cùng hưởng, có họa cùng chịu, bảo vệ lẫn nhau?';
mysql_query("INSERT INTO `forum` SET
`refid` = '".$top."',
`type` = 't',
`time` = '" . time() . "',
`user_id` = '2',
`from` = 'Cha Xứ',
`text` = '".$ten."'
");
$rid = mysql_insert_id();
mysql_query("INSERT INTO `forum` SET
`refid` = '".$rid."',
`type` = 'm',
`time` = '" . time() . "',
`user_id` = '2',
`from` = 'Cha Xứ',
`text` = '".$noidung."'
");
$postid = mysql_insert_id();

//dong y vo chong
$dongyvc = '[b]Con đồng ý![/b] ';

mysql_query("INSERT INTO `forum` SET
`refid` = '".$rid."',
`type` = 'm',
`time` = '" . time() . "',
`user_id` = '".$datauser['id']."',
`from` = '".$datauser['name']."',
`ip` = '',
`ip_via_proxy` = '',
`soft` = 'Thành Hôn',
`text` = '".$dongyvc."'
");
$postid = mysql_insert_id();

///tiep
$dongyt ='[b]Con vạn lần đồng ý![/b]';
mysql_query("INSERT INTO `forum` SET
`refid` = '".$rid."',
`type` = 'm',
`time` = '" . time() . "',
`user_id` = '".$cc['id']."',
`from` = '".$cc['name']."',
`ip` = '',
`ip_via_proxy` = '',
`soft` = 'Thành Hôn',
`text` = '".$dongyt."'
");
$postid = mysql_insert_id();
//tuyen bo
$tuyenb = '[b]Ta tuyên bố hai con chính thức trở thành vợ chồng!
Hai con phải hạnh phúc đấy nhé![/b]';
mysql_query("INSERT INTO `forum` SET
`refid` = '".$postid."',
`type` = 'm',
`time` = '" . time() . "',
`user_id` = '2',
`from` = 'Cha Xứ',
`ip` = '1.0.1.0.1.0',
`ip_via_proxy` = '123456',
`soft` = 'Galaxy',
`text` = '".$tuyenb."'
");
}
mysql_query("UPDATE `kethon` SET `dongy`='1' WHERE `id`='".$kethon[id]."'");
mysql_query("UPDATE `users` SET `nguoiyeu`='".$kethon[user_id]."' WHERE `id`='".$user_id."'");
mysql_query("UPDATE `users` SET `nguoiyeu`='".$user_id."' WHERE `id`='".$kethon[user_id]."'");
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : core::$system_set['homeurl'];
header('Location '.$referer.'');
}
}
if (isset($_POST['tuchoi'])) {
mysql_query("UPDATE `kethon` SET `dongy`='2' WHERE `id`='".$kethon[id]."'");
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : core::$system_set['homeurl'];
header('Location '.$referer.'');
}
if (!isset($_POST['dongy'])&&!isset($_POST['tuchoi'])) {
$name = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$kethon['user_id']."'"));
echo '<div class="gmenu"><center><b><form method="post"><img src="/icon/tinhyeu.png"> Bạn <a href="/member/'.$kethon['user_id'].'.html">'.$name['name'].'</a> đã gửi đến bạn 1 lời cầu hôn...Bạn có đồng ý không?<br/><button name="dongy"  style="margin:10px"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Đồng ý</button><button name="tuchoi"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Từ chối</button></form></b></center></div>';
}
}
$xyz=mysql_query("SELECT * FROM `kethon` WHERE `user_id`='".$user_id."' AND `dongy`!='0' AND `view`='0' ORDER BY `time` DESC LIMIT 1");
while($zzz=mysql_fetch_array($xyz)) {
$name = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = '".$zzz['nguoi_ay']."'"));
mysql_query("UPDATE `kethon` SET `view`='1' WHERE `id`='".$zzz[id]."'");
if ($zzz['dongy']==1) {
echo '<div class="gmenu"><img src="/icon/tinhyeu.png"> Bạn <a href="/member/'.$zzz['nguoi_ay'].'.html">'.$name['name'].'</a> đã đồng ý làm người yêu của bạn. Xin chúc mừng</div>';
}
if ($zzz['dongy']==2) {
echo '<div class="gmenu"><img src="/icon/tinhyeu.png"> đừng buồn nữa, nỗi buồn gì rồi cũng sẽ phai... Tin buồn đến với bạn: <a href="/member/'.$zzz['nguoi_ay'].'.html">'.$name['name'].'</a> đã khướt từ lời kết hôn của bạn</div>';
}
}
?>
                            
                            