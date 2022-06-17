<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Khu Công Viên';
require('../incfiles/head.php');
echo'<div class="main-xmenu">';
echo'<div class="phdr"><center>Khu Công Viên</center></div>';
if (empty($datauser['mibile'])) {
	if(isset($_POST['active_sub'])) {
		$code = intval($_POST['active']);
		$check_code = mysql_num_rows(mysql_query("SELECT * FROM `kichhoat` WHERE `code` = '".$code."' AND `user_id` = '".$user_id."' AND `time` >= '".time()."'"));
		if ($check_code < 1) {
			echo '<div class="rmenu">Mã kích hoạt không tồn tại hoặc hết hạn sử dụng!</div>';
		} else {
			$info_code = mysql_fetch_assoc(mysql_query("SELECT * FROM `kichhoat` WHERE `code` = '".$code."'"));
			mysql_query("UPDATE `users` SET `mibile` = '".$info_code['sdt']."', `xu` = `xu` + '5000000', `vnd`= `vnd` + '5' WHERE `id` ='".$user_id."'");
			echo '<div class="list1">Kích hoạt tài khoản thành công. Bạn được cộng <b>5,000,000 xu</b> và <b>5 lượng</b></div>';
		}
	}
	
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="menu"><div class="nencay" style="min-height:140px"><marquee behavior="scroll" direction="left" scrollamount="1" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee><marquee behavior="scroll" direction="left" scrollamount="2" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee></div><div class="cola" style="min-height: 100px;margin:0"><div class="buico"></div><a href="/congvien/bxh.php"><img src="/icon/bxh.png"></a><a href="nhiemvu.php"><img src="/icon/npcnhiemvu.gif"></a><img src="/icon/cay.png"><a href="daugia.php"><img src="/icon/daugia2.png" style="float:right"></a><a href="daugia.php"><img src="/icon/daugia.gif" style="float:right"></a><center>';

Echo'<a href="cogiaotienganh"><img src="http://4rumvn.net/images/npc/TA.gif"></a><br><br>';

echo'<a href="quayso.php"><img src="/icon/quayso.gif" style="margin-top: -120px;margin-bottom: -120px;"><img src="/icon/quayso.png" style="margin-top: -120px;margin-bottom: -120px;"></a><a href="/khugiaitri/honnhan.php"><img style="margin-top: -120px;margin-bottom: -120px;" src="http://4rumvn.net/congvien/images/leduong.png" alt="icon" style="position:absolute;margin:41px 0 0 200px;z-index:0;"/></a>'; 
echo'<a href="code.php"><img src="/icon/gc.gif"></a>';
echo'<br/>';
//--code này copy để hiện avatar by cRoSsOver--//
//update nơi đang online và tọa độ
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
    
    



?>
<style>
.xe1{height:100px;}
</style>
<br>

<div class="xe1">

<div id="wrapper">
    <div id="content">
   
   </div>
   <center>
    <img src="https://realtimeapi.io/wp-content/uploads/2018/06/0_P-Qpk_dV1vLSutGq.gif" width="25%" id="loading" alt="loading" style="display:none;" />
    

</center>
   </div></div>
 

<?php
      
    }
    
     
echo'

 <center><a id="myImage" href="/member/'.$user_id.'.html"><label style="display: inline-block;text-align: center;"><b style="font-size: 9px;color:red;font-weight:bold;text-align: center;">'.$login.'</b><br><img src="/avatar/'.$user_id.'.png"></label></a></center>'; 
echo'<br><form>
<center><input type="button" class="nut" name="len" onclick="Len();" value="↑↑"></br><div class="xd"></div>
<input type="button" class="nut" name="trai" onclick="Trai();" value="<<">
<input type="button" class="nut" name="ok" onclick="ok" value="Oki">
<input type="button" class="nut" name="phai" onclick="Phai();" value=">>"><br><div class="xd"></div>
<input type="button" class="nut" name="xuong" onclick="Xuong();" value="↓↓">  
</center>
</form>
 ';
    
echo'</center><div class="buico"></div></div>';
echo'</div>';
if(isset($_GET['dondep'])){
if ($rights >= 6) {
if(isset($_POST['submit'])) {
header("Location: $home");
mysql_query("DELETE FROM `guest`");
} else {
echo '<div class="menu list-bottom congdong"><form method="post">Bạn có muốn dọn dẹp phòng chát không !<br /><input type="submit" name="submit" value="Dọn dẹp" /></form></div>'; 
}
} else {
header("Location: $home/congvien/");
}
}
if(isset($_POST['submitchat'])) {
$loai=functions::checkout($_POST['loai']);
$noidungchat = bbcode::notags($noidungchat);
$noidungchat = isset($_POST['noidungchat']) ? functions::checkin(trim($_POST['noidungchat'])) : '';
if(empty($_POST['noidungchat'])) {
echo '<div class="menu">Bạn đã nhập nội dung đâu</div>';
} else if(strlen($_POST['noidungchat']) < 2) { // 2 là số kí tự ít nhất
echo '<div class="menu">Bạn phải viết trên 5 kí tự</div>';
} else if(strlen($_POST['noidungchat']) > 4000) {
echo '<div class="menu">Bạn không được viết quá 5000 kí tự</div>';
} else {
if($user_id){
$checknv=mysql_num_rows(mysql_query("SELECT * FROM `nhiemvu_user` WHERE `user_id`='".$user_id."' AND `id_nv`='3'"));
if ($checknv>0) {
mysql_query("UPDATE `nhiemvu_user` SET `tiendo`=`tiendo`+'1' WHERE `user_id`='".$user_id."' AND `id_nv`='3'");
}
mysql_query("INSERT INTO `guest` SET `user_id`='".$user_id."', `text`='" . mysql_real_escape_string($noidungchat) . "', `time`='".time()."'");
header('Location: '.$home.'/congvien/');
}
}
}
if($user_id){
if ($datauser['chanchat'] == 1)
{

}
else
{

/*echo '<table cellpadding="0" cellspacing="0" width="100%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tbody><tr><td width="60px;" class="blog-avatar"><img src="/avatar/'.$user_id.'.png"  align="top">&nbsp;</td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0">
<tbody><tr><td class="current-blog" rowspan="2" style="">
<div class="blog-bg-left"><img src="/giaodien/images/left-blog.png"></div><div class="newsx">
<form name="text" method="POST">
<textarea type="text" placeholder="Chém vui vẻ!" id="postText" name="noidungchat" class="form-control"></textarea>
<button name="submitchat" type="submit" ><i class="fa fa-pencil" aria-hidden="true"></i> Gửi</button>
</form>
</div></td></tr></tbody></table></td></tr></tbody></table>';*/
}
} else {
}

if($tong) {
$req = mysql_query("SELECT * FROM `guest` ORDER BY `time` DESC LIMIT $start, $kmess");
while ($vina4u = mysql_fetch_assoc($req)) {
$gres = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='{$vina4u['user_id']}'"));

$post = functions::checkout($vina4u['text'], 1, 1);
if ($set_user['smileys'])
$post = functions::smileys($post, $vina4u['rights'] ? 1 : 0);
echo''.$post.'<br/><br/>';
echo '<span style="font-size:11px;color:#777;"> (' . functions::thoigian($vina4u['time']) . ')</span>';
echo'</div></div></td></tr></tbody></table></td></tr></tbody></table>';
echo'</div>';
$i++;
}
} else {

}
if ($tong > $kmess) {
echo '<div class="topmenu">' . functions::pages('/congvien/?page=', $start, $tong, $kmess) . '</div>';
}
echo'<div>';
require('../incfiles/end.php');
?>






<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
(function($)
{
    $(document).ready(function()
    {
        $.ajaxSetup(
        {
            cache: false,
            beforeSend: function() {
                $('#content').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                $('#content').show();
            },
            success: function() {
                $('#loading').hide();
                $('#content').show();
            }
        });
        var $container = $("#content");
        $container.load("idthienan_realtime-nv.php");
        var refreshId = setInterval(function()
        {
            $container.load('idthienan_realtime-nv.php');
        }, 15000);
    });
})(jQuery);
</script>