<?php
if(isset($_POST['gieohat'])) {
if (empty($_POST['dattrong'])) {
header("Location: /farm/");
} 
        $_SESSION['dc'] = $dc;
        $_SESSION['prd'] = htmlspecialchars(getenv("HTTP_REFERER"));
        $dc = $_SESSION['dc'];
        $prd = $_SESSION['prd'];
        foreach ($_POST['dattrong'] as $delid) {
$post = mysql_fetch_array(mysql_query("select * from `fermer_gr` WHERE  `id` = '".intval($delid)."'  LIMIT 1")); 
if(isset($_POST['sadit']) && $user_id==$post['id_user']) {
$res = mysql_fetch_array(mysql_query("select * from `fermer_hatgiong` WHERE `id` = '$_POST[sadit]' ")); 
$semen = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE `id` = '$res[semen]' "));
$t = $time+$semen['time'];
if ($res[kol] > 0) {
mysql_query("UPDATE `fermer_gr` SET `semen` = $res[semen] WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time` = '$t' WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time_thuhoach` = '$t' WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time_ki` = '$time' WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_hatgiong` SET `kol` = `kol`-'1' WHERE `id` = $_POST[sadit] LIMIT 1");
}
header("Location: /farm/");
}
}
}


//AUTO - BÓN PHÂN
if(isset($_POST['bonall'])) {
if (empty($_POST['dattrong'])) {
header("Location: /farm/");
} 
        $_SESSION['dc'] = $dc;
        $_SESSION['prd'] = htmlspecialchars(getenv("HTTP_REFERER"));
        $dc = $_SESSION['dc'];
        $prd = $_SESSION['prd'];
        foreach ($_POST['dattrong'] as $delid) {
$post = mysql_fetch_array(mysql_query("select * from `fermer_gr` WHERE  `id` = '".intval($delid)."'  LIMIT 1")); 
if(isset($_POST['udobr']) && $user_id==$post['id_user']) {
$res = mysql_fetch_array(mysql_query("select * from `fermer_udobr` WHERE `id` = '$_POST[udobr]' ")); 
$semen = mysql_fetch_array(mysql_query("select * from `fermer_udobr_name` WHERE `id` = '$res[udobr]' "));
$t = $time+$semen['time'];
if ($res[kol] > 0) {
mysql_query("UPDATE `fermer_gr` SET `time` = `time`- $semen[time] WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_udobr` SET `kol` = `kol`-'1' WHERE `id` = $_POST[udobr] LIMIT 1");
}
header("Location: /farm/");
}
}
}


//
if(isset($_POST['tuoinuoc'])) {
if (empty($_POST['dattrong'])) {
header("Location: /farm/");
} 
        $_SESSION['dc'] = $dc;
        $_SESSION['prd'] = htmlspecialchars(getenv("HTTP_REFERER"));
        $dc = $_SESSION['dc'];
        $prd = $_SESSION['prd'];
        foreach ($_POST['dattrong'] as $delid) {
mysql_query("UPDATE `fermer_gr` SET `woter` = '1' WHERE `id` = '".intval($delid)."' LIMIT 1");
header("Location: /farm/");
}
}

if(isset($_POST['thuhoach'])) {
if (empty($_POST['dattrong'])) {
header("Location: /farm/");
} 
        $_SESSION['dc'] = $dc;
        $_SESSION['prd'] = htmlspecialchars(getenv("HTTP_REFERER"));
        $dc = $_SESSION['dc'];
        $prd = $_SESSION['prd'];
foreach ($_POST['dattrong'] as $delid) {
$post = mysql_fetch_array(mysql_query("select * from `fermer_gr` WHERE  `id` = '".intval($delid)."' LIMIT 1")); 
$semen = mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1")); 
$postauto = mysql_fetch_array(mysql_query("select * from `fermer_gr` WHERE  `id` = '".intval($delid)."' LIMIT 1")); 
if($time>$postauto['time']){
//$dohod = $postauto['kol']*$semen['dohod'];

if($post['woter']==0){
$dohod=$post['kol']/2;
}else { 
$dohod=$post['kol']*$datauser['leveldat'];
}





mysql_query("INSERT INTO `fermer_vor` (`id_user` , `gr`, `time`) VALUES  ('".$user_id."', '".intval($delid)."', '".time()."') ");
$remils = mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id' AND `semen` = '".$post[semen]."'"),0);
if($remils>0) {
mysql_query("UPDATE `fermer_sclad` SET `kol` = `kol`+ '".floor($dohod)."' WHERE `id_user` = $user_id AND `semen` = '".$post[semen]."' LIMIT 1");
} else {
mysql_query("INSERT INTO `fermer_sclad` (`kol` , `semen`, `id_user`) VALUES  ('".floor($dohod)."', '".$post['semen']."', '".$user_id."') ");
}
mysql_query("UPDATE `users` SET `fermer_oput` = `fermer_oput`+ '".$semen['oput']."' WHERE `id` = $user_id LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `semen` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `time` = NULL WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `kol` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `antrom` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
mysql_query("UPDATE `fermer_gr` SET `woter` = '0' WHERE `id` = '".intval($delid)."' LIMIT 1");
$randnro = rand(1,5);
if ($randnro == 1) {
$randv = rand(1,2);
if ($randv == 1) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='17' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/19.png"> Bạn đã nhận được ngọc 5 sao<br/>';
} else if ($randv == 2) {
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'1' WHERE `id_shop`='16' AND `user_id`='".$user_id."'");
echo '<img src="/images/vatpham/18.png"> Bạn đã nhận được ngọc 4 sao<br/>';
}
//nhiệm vụ naruto
$check_nv = mysql_num_rows(mysql_query("SELECT * FROM `naruto_nhiemvu` WHERE `user_id` = '".$user_id."' AND `id_nv` = '1'"));
if ($check_nv > 0) {
mysql_query("UPDATE `naruto_nhiemvu` SET `tiendo` = `tiendo` + '1' WHERE `id_nv` = '1' AND `user_id` = '".$user_id."'");
}
//end nhiệm vụ naruto
$nro = true;
}
}
if (!$nro) {
header("Location: /farm/"); 
}
}
}
?>