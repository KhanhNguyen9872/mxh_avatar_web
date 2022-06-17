<?php
defined('_IN_JOHNCMS')or die('access denined!!');
$mid=$res['id'];
$a=mysql_query("select * from `forum_tags` where `mid`='$mid'")or die(mysql_error());
if(mysql_num_rows($a)){
$d=mysql_fetch_array($a);
$ar=unserialize($d['text']);

$out='';
foreach($ar as $u =>$v){
if(!empty($out)) $out .=', ';
$out .='@<a href="'.$home.'/member/'.$u.'.html">'.nick($u).'</a>';
}
echo $out;
}
?>