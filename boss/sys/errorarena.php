<?php

if(isset($_GET['batdau']) && $user_id==$areanonline['user_id'] && $areanonline['wait']!=3) {
if (!empty($areanonline['nguoichoi'])) {
mysql_query("UPDATE `boss` SET `wait`='3',`time`='".time()."' WHERE `id`='$id'");
mysql_query("DELETE FROM `boss_notice` WHERE `phong`='".$id."'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'200' WHERE `id`='".$areanonline['user_id']."'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'200' WHERE `id`='".$areanonline['nguoichoi']."'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'200' WHERE `id`='".$areanonline['nguoichoi2']."'");
mysql_query("UPDATE `users` SET `xu`=`xu`-'200' WHERE `id`='".$areanonline['nguoichoi3']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '".$id."' WHERE `id`='".$areanonline['user_id']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '".$id."' WHERE `id`='".$areanonline['nguoichoi']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '".$id."' WHERE `id`='".$areanonline['nguoichoi2']."'");
mysql_query("UPDATE `users` SET `phongbossdangchoi`= '".$id."' WHERE `id`='".$areanonline['nguoichoi3']."'");
mysql_query("UPDATE `boss` SET `cuaai`= '1' WHERE `id`='".$id."'");
header("Location: /boss/$id");
} else {
echo '<div class="menu">Trận đấu phải trên 2 người mới có thể bắt đầu !</div>';
echo'<a href="/boss/'.$id.'"><input type="button" value="Trở về"/></a>';
echo '</div>';
require('../incfiles/end.php');
exit;
}
}

?>