<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
require_once('../incfiles/head.php');
$headmod='theo dõi chủ đề';
$t=intval($_GET['t']);
$checktop=mysql_num_rows(mysql_query("select `id` from `forum` where `id`='$t' and `type`='t'"));
if(!$checktop){
echo functions::display_error('tình trạng dữ liệu');
require_once('../incfiles/end.php');
exit;
}
$sql=mysql_query("select * from `forum_theodoi` where `uid`='$user_id' and `tid`='$t'");
$input1=mysql_num_rows($sql);
if($_POST['submit'])
{
if($input1){
mysql_query("delete from `forum_theodoi` where `uid`='$user_id' and `tid`='$t'")or die(mysql_error());
}else{
mysql_query("insert into `forum_theodoi` set `uid`='$user_id', `tid`='$t'")or die(mysql_error());
}
header('Location: /forum/'.$t.'.html');
} else {
if($input1)
$te='B&#7887; '; else $te='';
echo '<div class="mainblok"><div class="phdr">'.$te.'Theo dõi</div><div class="menu">Bạn muối '.$te.' theo dõi bài viết này?</div><p align="center"><form method="post"><input type="submit" name="submit" value="Đồng ý"></form></div>';
}
require_once('../incfiles/end.php');
?>
