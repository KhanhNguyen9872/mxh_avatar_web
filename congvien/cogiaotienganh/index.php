<?php
define('_IN_JOHNCMS',1);
$rootpath='../';
require_once ("../../incfiles/core.php");
require_once ("../../incfiles/head.php");
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM `cogiaota` where `id`"), 0);

$check=intval(abs($_GET['check']));
if($datauser['xu']<=0){
echo'<div class="list2">Bạn không đủ xu</div>';
include'../incfiles/end.php';
exit;
}
?>
<script>
var i=23;
function timeend() {
i--;
if(i>=0) {$("#time").html('<b style="color:red">'+i+'</b>');setTimeout("timeend()",1000);}
else {window.location="?reload";}
}
timeend();
</script>
<?php
?>
<style>
.newss {
    background-color: #fffaf0;
    border: 2px dashed #ffcf66;
    margin-bottom: 5px;
    padding: 5px;
width: 96%;
}
.hangraota{
background: url('http://i.imgur.com/76dejvF.png') repeat-x; 
height: 130px;
width: 99%;
}
.datta{
background: url('http://i.imgur.com/psJm7tm.png') repeat-x; 
height: 100px;
width: 99%;
}
</style>

<style>

.traloi {
    background-color: #FFFFFF;
    border-radius: 5px;
    border: 1px solid #FFC9D6;
    color: #000000;
    margin: 5px 0px;
    padding: 10px;
width: 94%;
}
.cotcung{
background-color: #3688c7;
color: #fff;
font-weight: bold;
padding: 4px 4px 5px 11px;
width: 94%;
}
</style>

<?php
echo'<div class="phdr">Khu Cô Giáo Tiếng Anh'.($rights >= 7 ? ' [<a href="?act=add">Thêm câu hỏi</a>]':'').'</div><center><div class="lucifer">';
switch($_GET['act']) {
default:
echo'<div class="hangraota"></div><div class="datta"></br>';
mysql_query("UPDATE `vitri` SET `time`='".time()."',`online`='".$textl."',`toado`='".$toado."' WHERE `user_id`='".$user_id."'");
$time=time()-300;
//bắt đầu cho hiện avatar
$req=mysql_query("SELECT * FROM `vitri` WHERE `online`='".$textl."' AND `time`>'".$time."'");
while($pr = mysql_fetch_array($req))
    {
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$pr[user_id]."'"));
$flip=rand(1,2);
if($flip==1) {$flip=' class="flip"';}
else {$flip='';}
        echo '<a href="/member/'.$pr['user_id'].'.html" ><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$name[name].'</b><br><img src="/avatar/'.$pr[user_id].'.png" ></label></a>';
    }
echo'<br><img src="ta.png" style="position:absolute;margin:-100px 0 0 -20px;z-index:1;"></div><div class="buico"></div>';

$rand = rand(1,$tong);

$tl=@mysql_fetch_array(mysql_query("select * from `cogiaota` where `id` = '{$rand}'"));
$dentu = $_SERVER['HTTP_REFERER'];

if(empty($dentu) && $check>=1){
echo'<div class="newss"><b>Lỗi</b> : Không Thể Kết Nối Tới Server Anh Việt</div>';
include'../incfiles/end.php';
exit;
}
echo'<div class="traloi"><font color="red"><b>Cô Giáo</b></font> : Từ '.$tl['cauhoi'].' Tiếng Anh Đọc Là Gì? Còn: <span id="time"></span>s</div>
<div class="traloi"><form action="?check='.$rand.'"method="post"><b>'.nick($user_id).'</b>: <input type="text"name="dapan"><input type="submit"name="submit"value="Trả Lời"></form></div>';

if(isset($_POST['submit'])){
$timecam = $datauser['timetienganh']+23- time();
$cam =time();
if($datauser['timetienganh']+23>=$cam){
echo'<div class="news">Hết Thời Gian Cho Câu Trả Lời. Vui Lòng Đợi '.date('s', $timecam).' Giây Nữa Mới Trả Lời Được. </div>';
include'../incfiles/end.php';
Exit;
}

$tll=@mysql_fetch_array(mysql_query("select * from `cogiaota` where `id` = '{$check}'"));
$dapan = $tll['dapan'];
$traloi = addslashes($_POST['dapan']);
if(empty($traloi)){
echo'<div class="newss">Em không muốn trả lời thì thôi</div>';
}else
if($dapan!=$traloi){
mysql_query("UPDATE `users` SET `timetienganh`='".time()."' WHERE `id`='".$user_id."'");
echo'<div class="newss">Bạn Trả Lời Sai Rồi. Câu Trả Lời Chính Xác Phải Là '.$dapan.'</div>';
}else
if($dapan==$traloi && $datauser['vip']>=10000){
mysql_query("UPDATE `users` SET `xu`=`xu`+'10000' ,`timetienganh`='".time()."' WHERE `id`='".$user_id."'");
echo'<div class="newss">Chúc Mừng Bạn '.$login.' Đã Trả Lời Chính Xác. Bạn Nhận Được 10000 xu</div>';
}else
if($dapan==$traloi && $datauser['vip']<10000){
mysql_query("UPDATE `users` SET `timetienganh`='".time()."',`xu`=`xu`+5000 WHERE `id`='".$user_id."'");
echo'<div class="newss">Chúc Mừng Bạn '.$login.' Đã Trả Lời Chính Xác. Bạn Nhận Được 5000 xu</div>';
}
}
break;
case 'add':
if($datauser['rights']<7) {echo '<div class="menu">Lỗi truy cập!</div>';}
else {
if($_POST['submit']) {
if(!$_POST['a']) {echo '<div class="menu">Cần nhập câu trả lời đầy đủ</div>';}
else {
@mysql_query("INSERT into cogiaota SET  cauhoi='".addslashes($_POST['cauhoi'])."',
dapan='".$_POST['a']."'");
echo '<div class="rmenu">Thêm thành công!</div>';
}
}


echo '<div class="menu">Thêm câu hỏi</div>';
echo '<form action="" method="post">
Câu hỏi: <input type="text" name="cauhoi" /><br/>
Đáp án: <input type="text" name="a" /><br/>

<input type="submit" name="submit" value="Tạo"/>
</form>';
}
break;
}
Echo'</div><div><div>';
require_once ("../../incfiles/end.php");
?>
