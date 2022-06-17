<?PHP
$headmod = 'Làng cổ';
$textl = 'Làng cổ';
switch($act){
case 'danh':
$xyz=mysql_num_rows(mysql_query("SELECT * FROM `langtruyenthuyet_boss` WHERE `id`='".$id."'"));
if($xyz<=0){
header('location: /');
}
$req_id = mysql_query("SELECT * FROM `langtruyenthuyet_boss` WHERE `id`='$id'");
while($res_id = mysql_fetch_assoc($req_id)){
$id=(int)$_GET[id];
$u = $user_id;
$hp = $datauser['hp'];
$sm = $datauser['sucmanh'];
$tenboss = $res_id['tenboss']; 
$hpboss = $res_id['hp'];
$hpbossfull = $res_id['hpfull'];
$smboss = $res_id['sucmanh'];
$timedie = $res_id['timebosschet'];
if($res_id['hienthi'] == 1){
mysql_query("UPDATE `users` SET `hp`=`hp`-'".$smboss."' WHERE `id`='".$u."'");
mysql_query("UPDATE `langtruyenthuyet_boss` SET `hp`=`hp`-'".$sm."' WHERE `id`='".$id."'");
Echo'
HP Boss: '.$hpboss.' <br>
SM Boss: '.$smboss.' <br>
';
if($datauser['level'] >= $res['lvboss'] && $datauser['level'] < $res['lvbossmax']){
}
if($hpboss <=0){
if($res_id['lvboss'] == 10 && $datauser['level'] >= 10){
$tichluy = rand(20,30);
mysql_query("UPDATE `users` SET `tichluy` = `tichluy` + $tichluy WHERE `id` = $user_id");
$randxu = rand(10000, 20000);
mysql_query("UPDATE `users` SET `xu` = `xu` + '".$randxu."' WHERE `id` = '".$user_id."'");
$randexp = rand(1000, 2000);
mysql_query("UPDATE `users` SET `exp` = `exp` + '".$randexp."' WHERE `id` = '".$user_id."'");
mysql_query("UPDATE `users` SET `nhb`=`nhb`+'0' WHERE `id`='{$user_id}'");
mysql_query("UPDATE `users` SET `kcx`=`kcx`+'0' WHERE `id`='{$user_id}'");
$randtmm=rand(28,52);
IF($randtmm==49){
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$randtmm."'");
$query=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `id`='".$randtmm."'");
$info=mysql_fetch_array($query);
Echo'<script type="text/javascript">alert("Bạn đã giết chết '.$tenboss.' và nhận được thẻ may mắn !");</script>';
}
IF($randtmm==50){
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$randtmm."'");
$query=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `id`='".$randtmm."'");
$info=mysql_fetch_array($query);
Echo'<script type="text/javascript">alert("Bạn đã giết chết '.$tenboss.' và nhận được Pokemon !");</script>';
}IF($randtmm==50){
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$randtmm."'");
$query=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `id`='".$randtmm."'");
$info=mysql_fetch_array($query);
Echo'<script type="text/javascript">alert("Bạn đã giết chết '.$tenboss.' và nhận được Pokemon !");</script>';
}
$randch=rand(1,30);
if($randch >= 8 && $randch <=11){
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$randch."'");
$query=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `id`='".$randch."'");
$info=mysql_fetch_array($query);
Echo'<script type="text/javascript">alert("Bạn đã giết chết '.$tenboss.' và nhận được '.$info[tenvatpham].' !");</script>';
}else{
echo'Bạn đã giết chết '.$tenboss.' và nhận được '.$randxu.' xu, '.$randexp.' kinh nghiệm !';
}
//
mysql_query("UPDATE `langtruyenthuyet_boss` SET `hienthi`='0' WHERE `id`='".$id."'");
mysql_query("UPDATE `langtruyenthuyet_boss` SET `timebosschet` = '".time()."' WHERE `id`='".$id."'");
mysql_query("UPDATE `langtruyenthuyet_boss` SET `hoisinh`='0' WHERE `id`='".$id."'");
}else{
Echo'<a href="?act=danh&id='.$res_id['id'].'"><img src="img/boss/'.$res_id['iconboss'].'.png"></a>';
}
if($res_id['lvboss'] == 20 && $datauser['level'] >= 20){
$tichluy = rand(40,60);
mysql_query("UPDATE `users` SET `tichluy` = `tichluy` + $tichluy WHERE `id` = $user_id");
$randxu = rand(30000, 50000);
mysql_query("UPDATE `users` SET `xu` = `xu` + '".$randxu."' WHERE `id` = '".$user_id."'");
$randexp = rand(3000, 5000);
mysql_query("UPDATE `users` SET `exp` = `exp` + '".$randexp."' WHERE `id` = '".$user_id."'");
mysql_query("UPDATE `users` SET `nhb`=`nhb`+'0' WHERE `id`='{$user_id}'");
mysql_query("UPDATE `users` SET `kcx`=`kcx`+'0' WHERE `id`='{$user_id}'");
$randtmm=rand(32,52);
IF($randtmm==49){
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$randtmm."'");
$query=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `id`='".$randtmm."'");
$info=mysql_fetch_array($query);
Echo'<script type="text/javascript">alert("Bạn đã giết chết '.$tenboss.' và nhận được thẻ may mắn !");</script>';
}
IF($randtmm==50){
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$randtmm."'");
$query=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `id`='".$randtmm."'");
$info=mysql_fetch_array($query);
Echo'<script type="text/javascript">alert("Bạn đã giết chết '.$tenboss.' và nhận được Pokemon !");</script>';
}IF($randtmm==50){
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$randtmm."'");
$query=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `id`='".$randtmm."'");
$info=mysql_fetch_array($query);
Echo'<script type="text/javascript">alert("Bạn đã giết chết '.$tenboss.' và nhận được Pokemon !");</script>';
}
$randch=rand(1,25);
if($randch >= 8 && $randch <=11){
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `user_id`='".$user_id."' AND `id_shop`='".$randch."'");
$query=mysql_query("SELECT * FROM `shopvatpham` WHERE `hienthi`='0' AND `id`='".$randch."'");
$info=mysql_fetch_array($query);
 Echo'<script type="text/javascript">alert("Bạn đã giết chết '.$tenboss.' và nhận được '.$info[tenvatpham].' !");</script>'; 
}else{
echo'Bạn đã giết chết '.$tenboss.' và nhận được '.$randxu.' xu, '.$randexp.' kinh nghiệm !';
}
//
mysql_query("UPDATE `langtruyenthuyet_boss` SET `hienthi`='0' WHERE `id`='".$id."'");
mysql_query("UPDATE `langtruyenthuyet_boss` SET `timebosschet` = '".time()."' WHERE `id`='".$id."'");
mysql_query("UPDATE `langtruyenthuyet_boss` SET `hoisinh`='0' WHERE `id`='".$id."'");
}else{
If($datauser['level'] >= 20){
Echo'<a href="?act=danh&id='.$res_id['id'].'"><img src="img/boss/'.$res_id['iconboss'].'.png"></a>';
}
}
}
}
}
break;
}
?>