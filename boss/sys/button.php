<?php

echo '<div class="menu">';
echo '<form method="post">';
if ($areanonline['user_id']!=$user_id) {
if (empty($areanonline['nguoichoi']) && $areanonline['nguoichoi2']!=$user_id && $areanonline['nguoichoi3']!=$user_id) {
echo'<a href="phong.php?id='.$id.'&thamgia"><input type="button" value="Sẵn Sàng"/></a>';
} else {
if (empty($areanonline['nguoichoi2']) && $areanonline['nguoichoi']!=$user_id && $areanonline['nguoichoi3']!=$user_id) {
echo'<a href="phong.php?id='.$id.'&thamgia"><input type="button" value="Sẵn Sàng"/></a>';
} else {
if (empty($areanonline['nguoichoi3']) && $areanonline['nguoichoi']!=$user_id && $areanonline['nguoichoi2']!=$user_id) {
echo'<a href="phong.php?id='.$id.'&thamgia"><input type="button" value="Sẵn Sàng"/></a>';
}
}
}
}

if ($areanonline['nguoichoi']==$user_id) {
echo'<a href="phong.php?id='.$id.'&bothamgia"><input type="button" value="Bỏ Sẵn Sàng"/></a>';
}
if ($areanonline['nguoichoi2']==$user_id) {
echo'<a href="phong.php?id='.$id.'&bothamgia"><input type="button" value="Bỏ Sẵn Sàng"/></a>';
}
if ($areanonline['nguoichoi3']==$user_id) {
echo'<a href="phong.php?id='.$id.'&bothamgia"><input type="button" value="Bỏ Sẵn Sàng"/></a>';
}
if ($areanonline['user_id']==$user_id) {
echo'<a href="phong.php?id='.$id.'&batdau"><input type="button" value="Bắt đầu chơi"/></a><a href="phong.php?id='.$id.'&nhuong"><input type="button" value="Nhường phòng"/></a></form>';
}
echo'</div>';

?>