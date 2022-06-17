 <?php
$taixiu=mysql_fetch_array(mysql_query("SELECT * FROM `taixiu` ORDER BY `id` DESC LIMIT 1"));
if ($taixiu[time]<time()) {
$kqtx=$taixiu['1']+$taixiu['2']+$taixiu['3'];
if ($kqtx<11) {
$kqtx='xiu';
$xxx='Xỉu';
} else {
$kqtx='tai';
$xxx='Tài';
}
//$noidung='[img]/icon/thongbao.gif[/img][b] Kết quả ra [red] '.$xxx.' [/red]  mọi người mau vào hốt Xu nào !!![/b]';
//mysql_query("INSERT INTO `guest` SET `user_id`='2', `text`='" . mysql_real_escape_string($noidung) . "', `time`='".time()."'");
$abc=mysql_query("SELECT * FROM `cuoctaixiu` WHERE `lan`='".$taixiu['id']."'");
while($mem=mysql_fetch_array($abc)) {
if ($mem['taixiu']==$kqtx) {
$congtien=$mem['tien']*2;
mysql_query("UPDATE `users` SET `xu`=`xu`+'".$congtien."' WHERE `id`='".$mem['user_id']."'");
}
}
$xx1=rand(1,6);
$xx2=rand(1,6);
$xx3=rand(1,6);
$timetx=time()+120;
mysql_query("INSERT INTO `taixiu` SET
`1`='".$xx1."',
`2`='".$xx2."',
`3`='".$xx3."',
`time`='".$timetx."'
");
}
?>