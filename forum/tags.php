<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='tags b&#7841;n b�';
require('../incfiles/head.php');
$mid=intval($_GET['mid']);
$a=mysql_query("select `id` from `forum` where `id`='$mid' and `user_id`='$user_id' limit 1")or die(mysql_error());
if(!mysql_num_rows($a)){
echo functions::display_error('bạn không có quyền vào đây');
require('../incfiles/end.php');
exit;
}
$a=mysql_query("select `text` from `forum_tags` where `mid`='$mid' ")or die(mysql_error());
if(!mysql_num_rows($a)){ $ar=array();
}else{
$d=mysql_fetch_array($a);
$ar=unserialize($d['text']);
}
$frsql = mysql_query("SELECT * FROM `cms_contact` WHERE `user_id`='$user_id' and `type`='2' and `friends`='1'");
if(!mysql_num_rows($frsql)){
echo functions::display_error('B&#7841;n kh�ng c� b&#7841;n b� &#273;&#7875; tag t�n!');
require('../incfiles/end.php');
exit;
}
echo'<div class="phdr">List Friends</div>';
if(isset($_POST['submit'])){
$array=$_POST['fid'];
while($a1=mysql_fetch_array($frsql)){
if($a1['user_id']==$user_id) $fid=$a1['from_id'];
else $fid=$a1['user_id'];
if($array[$fid]==1){
if(!isset($ar[$fid])){
$nd=mysql_query("select `refid` from `forum` where `id`='$mid' limit 1");
$tf=mysql_fetch_array($nd);
$t=mysql_fetch_array(mysql_query("select `text` from `forum` where `id`='".$tf['refid']."' limit 1"));
$dem=mysql_num_rows(mysql_query("select `id` from `forum` where `refid`='".$tf['refid']."' and `id`<=$mid "));
$p=CEIL($dem/$kmess);
$text=' <b>'.nick($user_id).' </b> <font color="black">nhắc đến bạn trong một bình luận tại</font> <a href="'.$home.'/forum/'.$tf['refid'].'-p'.$p.'.html#'.$mid.'"><font color="2c5170">
'.$t['text'].'</font></a>';
$text=(mysql_real_escape_string($text));

$check=mysql_num_rows(mysql_query("select `id1` from `thongbao` where `user`='$fid' and `id`='$user_id' and `text`='$text' limit 1"));
if(!$check) mysql_query("insert into `thongbao` set `user`='$fid', `id`='$user_id', `text`='{$text}',`ok`='1',`time`='".time()."'" )or die(mysql_error());
$ar[$fid]= true;
}
} ///tags
else{
if(isset($ar[$fid])) unset($ar[$fid]);
} ///ko tags
}

$ada=serialize($ar);
if(mysql_num_rows(mysql_query("select `id` from `forum_tags` where `mid`='$mid' limit 1")))
mysql_query("update `forum_tags` set `text`='$ada' where `mid`='$mid' limit 1")or die(mysql_error());
else mysql_query("insert into `forum_tags` set `text`='$ada',`mid`='$mid'")or die(mysql_error());
echo'<div class="lable-success">success!!!</div>';
}
echo'<form method="post">';
$frsql = mysql_query("SELECT * FROM `cms_contact` WHERE `user_id`='$user_id' and `type`='2' and `friends`='1'");
while($a1=mysql_fetch_array($frsql)){
if($a1['user_id']==$user_id) $fid=$a1['from_id'];
else $fid=$a1['user_id'];
echo'<div class="list1"><input type="checkbox" name="fid['.$fid.']" value="1" ',(($ar[$fid]))? 'checked':'','> <a href="'.$home.'/member/'.$fid.'.html">'.nick($fid).'</a></div>';
}
if(mysql_num_rows($frsql)>$kmess) echo'<div class="omenu">'.display_pagination('tags.php?mid='.$mid.'&page=',mysql_num_rows($frsql),$start,$kmess).'</div>';
echo'<div class="menu"><input type="submit" name="submit" value="Tags"></form></div>';
require('../incfiles/end.php');
?>
