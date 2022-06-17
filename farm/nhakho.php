<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
require_once('../incfiles/func.php');
$textl = 'Nhà kho';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="phdr">Nhà Kho</div>';
echo'<div class="menu list-bottom congdong">'.nick($user_id).' bạn có '.$datauser['xu'].' xu</div>';
if($user_id){
if(isset($_GET['id'])){
$int=intval($_GET['id']);
$sql=mysql_query("SELECT `id` FROM `fermer_sclad` WHERE `id`='$int' AND `id_user` = $user_id ");
$row=mysql_fetch_assoc($sql);
if(!mysql_num_rows($sql)){
echo '<div class="menu">Vật Phẩm Không Tồn Tại!</div>';
echo "&laquo; <a href='nhakho.php'>[ <b>Nhà Kho</a></b> ]";
echo "</div>";
require('../incfiles/end.php');

exit;
}
$post=mysql_fetch_array(mysql_query("select * from `fermer_sclad` WHERE `id`= '$int' LIMIT 1"));
$semen=mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1"));
$dohod=$post['kol']*$semen['dohod'];
if(isset($_GET['sell']))
{
mysql_query("UPDATE `users` SET `xu` = `xu`+ $dohod WHERE `id` = $user_id LIMIT 1");
mysql_query("DELETE FROM `fermer_sclad` WHERE `id` = $_GET[id] ");
header('Location: nhakho.php?sell_ok');
}
echo'<div class="menu">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;width: 30px;">';
echo '<img id="raucu" src="icon/shop/'.$post['semen'].'.png" alt="*" />';
echo'&#160;</td><td style="width: 500px;">';
echo'[ <b>'.htmlspecialchars($semen['name']).'</b> ]<br />';
echo "[ Số lượng thu hoạch: <b>".$post['kol']."</b> ]<br/>
[ Giá cho mỗi đơn vị: <b>".$semen['dohod']."</b> ]<br/>
[ Tổng doanh thu: <b>".$dohod." xu</b> ]<br/>";
echo "<form method='post' action='?id=".$int."&amp;sell'>\n";
echo "<input type='submit' name='save' value='Bán' />\n";
echo "</form>";
echo'</td></tr></table></div>';
}else{
$k=mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_sclad` WHERE `id_user` = '$user_id'"),0);

if($k == 0) {
echo "<div class='menu'>Hiện tại nhà kho của bạn chưa có vật phẩm nào !</div>";
} else {
$res = mysql_query("select * from `fermer_sclad` WHERE `id_user` = '$user_id' LIMIT $start, $kmess");
while ($post = mysql_fetch_array($res)){
$semen=mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$post[semen]'  LIMIT 1"));
echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="vertical-align: top;">';
echo'<img src="icon/shop/'.$post['semen'].'.png" alt="*" class="portrait" />';
echo'&#160;</td><td>';
echo'<a href="?id='.$post[id].'">[ <b>'.htmlspecialchars($semen['name']).'</b> ]</a><br/>';
echo'Số lượng: '.$post['kol'].'';
echo'</td></tr></table></div>';
}
}
}
echo "<div class='menu'>";
if(isset($_GET['id']))
echo "&laquo; <a href='nhakho.php'>[ <b>Nhà Kho</a></b> ]";
else
echo "&laquo; <a href='/farm/'>[ <b>Nông trại</b> ]</a>";
echo "</div></div>";
}else{
msg('Bạn Chưa Đăng Nhập!');
}require('../incfiles/end.php');


?>