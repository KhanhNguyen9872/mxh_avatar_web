<?php
if($areanonline['wait'] == 0) {
if(isset($_GET['thamgia']) && $user_id!=$areanonline['user_id']) {
$thongtinhp = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$user_id."'"));
if($thongtinhp[hp] <= 0) {
echo '<div class="menu">Bạn không thể sẵn sàng khi không còn HP!</div>';
echo'<a href="/boss/"><input type="button" value="Trở về"/></a>';
echo '</div>';
require('../incfiles/end.php');
exit;
} 
if ($areanonline['user_id']!=$user_id) {
if (empty($areanonline['nguoichoi']) && $areanonline['nguoichoi2']!=$user_id && $areanonline['nguoichoi3']!=$user_id) {
mysql_query("UPDATE `boss` SET `nguoichoi`='$user_id' WHERE `id`='$id'");
header("Location: /boss/$id");
} else {
if (empty($areanonline['nguoichoi2']) && $areanonline['nguoichoi']!=$user_id && $areanonline['nguoichoi3']!=$user_id) {
mysql_query("UPDATE `boss` SET `nguoichoi2`='$user_id' WHERE `id`='$id'");
header("Location: /boss/$id");
} else {
if (empty($areanonline['nguoichoi3']) && $areanonline['nguoichoi']!=$user_id && $areanonline['nguoichoi2']!=$user_id) {
mysql_query("UPDATE `boss` SET `nguoichoi3`='$user_id' WHERE `id`='$id'");
header("Location: /boss/$id");
}
}
}
}
}

if(isset($_GET['bothamgia']) && $areanonline['wait']!=3) {
if ($areanonline['nguoichoi']==$user_id) {
mysql_query("UPDATE `boss` SET `nguoichoi`='0' WHERE `id`='$id'");
mysql_query("DELETE FROM `boss_notice` WHERE `phong`='".$id."' LIMIT 1;");
header("Location:/boss/$id");
}
if ($areanonline['nguoichoi2']==$user_id) {
mysql_query("UPDATE `boss` SET `nguoichoi2`='0' WHERE `id`='$id'");
mysql_query("DELETE FROM `boss_notice` WHERE `phong`='".$id."' LIMIT 1;");
header("Location: /boss/$id");
}
if ($areanonline['nguoichoi3']==$user_id) {
mysql_query("UPDATE `boss` SET `nguoichoi3`='0' WHERE `id`='$id'");
mysql_query("DELETE FROM `boss_notice` WHERE `phong`='".$id."' LIMIT 1;");
header("Location: /boss/$id");
}
}
if ($areanonline['nguoichoi'] == '0') {
mysql_query("DELETE FROM `boss_notice` WHERE `phong`='".$id."' LIMIT 1;");
}

if(isset($_GET['nhuong'])) {
if ($user_id == $areanonline['user_id']) {
mysql_query("UPDATE `boss` SET `user_id`='0' WHERE `id`='$id'");
mysql_query("UPDATE `boss` SET `post`='0' WHERE `id`='".$id."'");
}
header("Location: /boss/");
}
}
if(isset($_GET['newboss']) && $areanonline['wait'] == 3) {
$thongtinboss = mysql_fetch_array(mysql_query("SELECT `hpfull` FROM `boss_chien` WHERE `idboss`='".$areanonline[boss]."'"));
mysql_query("UPDATE `boss_chien_arena` SET `hp`= '".$thongtinboss[hpfull]."' WHERE `phong`='".$id."'");
mysql_query("UPDATE `boss` SET `wait`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `win`= '0' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `luotdi`= '".$areanonline['user_id']."' WHERE `id`='".$id."'");
mysql_query("UPDATE `boss` SET `cuaai`= '1' WHERE `id`='".$id."'");
mysql_query("DELETE FROM `boss_noidung` WHERE `phong`='".$id."'");
mysql_query("DELETE FROM `boss_notice` WHERE `phong`='".$id."'");
header("Location: /boss/$id");
}
if(isset($_GET['quit']) && $areanonline['wait']== 3) {
if ($areanonline['user_id']==$user_id) {
mysql_query("DELETE FROM `boss` WHERE `id`='".$id."'");
mysql_query("DELETE FROM `boss_chien_arena` WHERE `phong`='".$id."'");
mysql_query("DELETE FROM `bosscmt` WHERE `sid`='".$id."'");
mysql_query("DELETE FROM `boss_noidung` WHERE `phong`='".$id."'");
}
if ($areanonline['nguoichoi']==$user_id) {
mysql_query("UPDATE `boss` SET `nguoichoi`= '' WHERE `id`='".$id."'");
}
if ($areanonline['nguoichoi2']==$user_id) {
mysql_query("UPDATE `boss` SET `nguoichoi2`= '' WHERE `id`='".$id."'");
}
if ($areanonline['nguoichoi3']==$user_id) {
mysql_query("UPDATE `boss` SET `nguoichoi3`= '' WHERE `id`='".$id."'");
}
header("Location: /boss/");
}

?>