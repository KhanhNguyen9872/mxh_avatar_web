<?php
/*
Code pokemon được viết bởi ID Thiên Ân
Site : Kenh10s.Com
Demo : DanChoiViet.Xyz
*/
define('_IN_JOHNCMS',1);
$rootpath ='../../';
include'../incfiles/core.php';
include'../incfiles/head.php';
echo'<div><div class="da"><div class="phdr">Bảng Xếp Hạng |<a href="/idthienan_ninja"> Trở Về Làng</a></div>';

$req = mysql_query("SELECT * FROM `tuipkm` WHERE `id` ORDER BY `lv`  DESC LIMIT 5");
while ($res = mysql_fetch_array($req)) {
echo '<div class="lucifer">
<b>Chủ Sở Hữu : <a href="/member/'.$res['user_id'].'.html">'.nick($res['user_id']).'</a><br/>
<img src="'.$res['img'].'"><br/>
Cấp Độ : <font color="green">'.$res['lv'].'</font><br/>
Sức Mạnh : <font color="blue">'.$res['sm'].'</font><br/>
HP Full : <font color="red">'.$res['hpfull'].'</font><br/>
</div>';
}
include'../incfiles/end.php';
/*
Code pokemon được viết bởi Châu Huỳnh
Site : Kenh10s.Com
Demo : DanChoiViet.Xyz
*/
?>
<style>
.nenpkm{background-color:#f5f5f5;border-bottom:1px solid #EBEBEB;padding:5px}
</style>