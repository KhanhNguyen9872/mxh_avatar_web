<?php
define('_IN_JOHNCMS', 1);
$headmod = 'farm';
$qrc = 'farm';
require_once('../incfiles/core.php');
$textl = 'Nâng Cấp Đất';
require('../incfiles/func.php');
require('../incfiles/head.php');
$tongodat =mysql_result(mysql_query("SELECT COUNT(*) FROM `fermer_gr` WHERE `id_user` = '$user_id'"),0);
echo'<div class="da">';
if(isset($_GET['buy_ok'])) {
echo'<div class="phdr">Trạng Thái</div><div class="lucifer">Thao tác thành công</div>';
}
if(isset($_GET['buy_err'])) {
echo'<div class="phdr">Kết Quả</div><div class="lucifer">Thao tác thất bại</div>';
}

if(isset($_GET['nangcap'])) {

if($datauser['leveldat']>=4)
{
header('Location: ?buy_err');
exit;
}


/* Check số đất */
if($tongodat<60){
header('Location: ?buy_err');
exit;
}else{

/* Check cấp farm */
if($datauser['leveldat']==1){
$vnd=100;
$cap=2;
}else if($datauser['leveldat']==2){
$vnd=500;
$cap=3;
}else if($datauser['leveldat']==3){
$vnd=1000;
$cap=4;
}


if($datauser['vnd']<$vnd)
{
header('Location: ?buy_err');
exit;
}

/* End check*/

mysql_query("UPDATE `users` SET `vnd` = `vnd`- '".$vnd."' WHERE `id` = $user_id ");

mysql_query("UPDATE `users` SET `leveldat` = '".$cap."' WHERE `id` = $user_id ");

header('Location: ?buy_ok');


}
/* End check */
}
echo'<div class="out-tab space">';
echo'<div class="phdr">Nâng cấp đất  [<a class="small" href="/farm">Quay lại</a>]</div>';

echo'<div class="lucifer">Bạn đã đạt cấp độ <b class="green">'.$datauser['leveldat'].'</b> và sở hữu <b class="green">'.$tongodat.'</b>/<b>60</b> ô đất, khi nâng cấp nông sản sẽ được nhân với cấp ô đất.';
echo'<br><a href="?nangcap" title="Nâng cấp toàn bộ ô đất"><input type="submit" name="submit" value="Nâng Cấp" /></a>';

echo'</div>';


echo'<div class="phdr">Điều kiện</div>';
echo'<div class="lucifer"><span class="bblist">Nâng lên cấp <b class="green">2</b> cần <b class="green">100 lượng</b></span><br>';
echo'<span class="bblist">Nâng lên cấp <b class="green">3</b> cần <b class="green">500 lượng</b></span><br>';
echo'<span class="bblist">Nâng lên cấp <b class="green">4</b> cần <b class="green">1000 lượng</b></span></div>';
echo'</div><div><div></div>';

require('../incfiles/end.php');
?>