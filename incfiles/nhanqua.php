

<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');


ob_start();
session_start();
$headmod = isset($headmod) ? mysql_real_escape_string($headmod) : '';
$textl = isset($textl) ? $textl : $set['copyright'];
/*
-----------------------------------------------------------------
Выводим HTML заголовки страницы, подключаем CSS файл
-----------------------------------------------------------------
*/

header("Expires: " . date("r",  time() + 60));
?>
<!-- Code By ID Thiên Ân, Ý Tưởng Và Bản Quyền Bởi Nguyễn Tráng -->
<?php
echo '<?xml version="1.0" encoding="utf-8"?> ' . "\n" .
"\n" . '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">' .
"\n" . '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vn"  lang="vn">' .
"\n" . '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">' .
"\n" . '' .
"\n" . '<meta name="robots" content="index,follow" />' .
"\n" . '<meta name="geo.region" content="vn" />' .
"\n" . '<meta http-equiv="Content-Style-Type" content="text/css" />' .
"\n" . '<meta name="design" content="developer =>, fb.com/idthienan" />' . // ВНИМАНИЕ!!! Данный копирайт удалять нельзя
(!empty($set['meta_key']) ? "\n" . '<meta name="keywords" content="' . $set['meta_key'] . '" />' : '') .
(!empty($set['meta_desc']) ? "\n" . '<meta name="description" content="' . $set['meta_desc'] . '" />' : '') .
"\n" . '<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="http://4rumvn.net/giaodien/style4.css" />
<link rel="stylesheet" type="text/css" href="http://4rumvn.net/giaodien/teamobi/template.css" />
<link type="text/css" rel="stylesheet" href="http://4rumvn.net/giaodien/teamobi/emoji.css">
' .
"\n" . '<link rel="shortcut icon" href="http://4rumvn.net/4r.png" />' .
"\n" . '<link rel="alternate" type="application/rss+xml" title="RSS | ' . $lng['site_news'] . '" href="' . $set['homeurl'] . '/rss/rss.php" />' .
"\n" . '<title>' . $textl . '</title>' .
"\n" . '</script><script type="text/javascript" src="/idthienan_dichuyen/node.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script><script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script><script src="http://4rumvn.net/mod/js214.js"></script><link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
'.
"\n" . '</head><body>' . core::display_core_errors();

if ($user_id) {
//--- Mod Chatbox v3 ---//
echo "<script>
$(document).ready(function(){
$(\"#datachat\").load(\"chemgio.php\");
var refreshId = setInterval(function() {
$(\"#datachat\").load('/chemgio.php');
$(\"#datachat\").slideDown(\"slow\");
}, 15000);
$(\"#shoutbox\").validate({
debug: false,
submitHandler: function(form) {
$.post('/chemgio.php', $(\"#shoutbox\").serialize(),function(chatoutput) {
$(\"#datachat\").html(chatoutput);
});
$(\"#msg\").val(\"\");
}
});
});
</script>";
}
/*
-----------------------------------------------------------------
Рекламный модуль
-----------------------------------------------------------------
*/










$cms_ads = array();
if (!isset($_GET['err']) && $act != '404' && $headmod != 'admin') {
$view = $user_id ? 2 : 1;
$layout = ($headmod == 'mainpage' && !$act) ? 1 : 2;
$req = mysql_query("SELECT * FROM `cms_ads` WHERE `to` = '0' AND (`layout` = '$layout' or `layout` = '0') AND (`view` = '$view' or `view` = '0') ORDER BY  `mesto` ASC");
if (mysql_num_rows($req)) {
while (($res = mysql_fetch_assoc($req)) !== FALSE) {
$name = explode("|", $res['name']);
$name = htmlentities($name[mt_rand(0, (count($name) - 1))], ENT_QUOTES, 'UTF-8');
if (!empty($res['color'])) $name = '<span style="color:#' . $res['color'] . '">' . $name . '</span>';
$font = $res['bold'] ? 'font-weight: bold;' : FALSE;
$font .= $res['italic'] ? ' font-style:italic;' : FALSE;
$font .= $res['underline'] ? ' text-decoration:underline;' : FALSE;
if ($font) $name = '<span style="' . $font . '">' . $name . '</span>';
@$cms_ads[$res['type']] .= '<a href="' . ($res['show'] ? functions::checkout($res['link']) : $set['homeurl'] . '/go.php?id=' . $res['id']) . '">' . $name . '</a><br/>';
if (($res['day'] != 0 && time() >= ($res['time'] + $res['day'] * 3600 * 24)) || ($res['count_link'] != 0 && $res['count'] >= $res['count_link']))
mysql_query("UPDATE `cms_ads` SET `to` = '1'  WHERE `id` = '" . $res['id'] . "'");
}
}
}
if (isset($cms_ads[0])) echo $cms_ads[0];



?> 


<?php
$taixiu=mysql_fetch_array(mysql_query("SELECT * FROM `taixiu` ORDER BY `id` DESC LIMIT 1"));
$fuck=$taixiu[id]+1;
$kqtx=$taixiu[1]+$taixiu[2]+$taixiu[3];
if ($kqtx<11) {
$kqtx=xiu;
$xxx='Xỉu';
} else {
$kqtx=tai;
$xxx='Tài';
}

if ($user_id) {


echo'<body><div class="body_body"><div class="left_top"></div><div class="bg_top"><div class="right_top"></div></div><div class="body-content"><div class="a" align="center"><a href="/"><img src="https://i.imgur.com/nloP2Lz.png" alt="4Rum.Pro" alt="4Rum.Pro"></a></div><br><br><div class="link-more"><div class="h"><div><div><div>';
}














if (!$user_id){

echo'

<body>


<div class="body_body">




<div class="left_top">



</div>



<div class="bg_top">
<div class="right_top"></div></div><div class="body-content"><div class="a" align="center"><a href="/"><img src="https://i.imgur.com/nloP2Lz.png" ></a><br><div style="font-size: 12px">
 '; 
 
 ?>
 <script type="text/javascript">
farbbibliothek = new Array();
farbbibliothek[0] = new Array("#FF0000","#FF1100","#FF2200","#FF3300","#FF4400","#FF5500","#FF6600","#FF7700","#FF8800","#FF9900","#FFaa00","#FFbb00","#FFcc00","#FFdd00","#FFee00","#FFff00","#FFee00","#FFdd00","#FFcc00","#FFbb00","#FFaa00","#FF9900","#FF8800","#FF7700","#FF6600","#FF5500","#FF4400","#FF3300","#FF2200","#FF1100");

farbbibliothek[1] = new Array("#FFF","#FF0000","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF","#FFF");
farbbibliothek[2] = new Array("#FF0000","#FF4000","#FF8000","#FFC000","#FFFF00","#C0FF00","#80FF00","#40FF00","#00FF00","#00FF40","#00FF80","#00FFC0","#00FFFF","#00C0FF","#0080FF","#0040FF","#0000FF","#4000FF","#8000FF","#C000FF","#FF00FF","#FF00C0","#FF0080","#FF0040");
farbbibliothek[3] = new Array("#FF0000","#EE0000","#DD0000","#CC0000","#BB0000","#AA0000","#990000","#880000","#770000","#660000","#550000","#440000","#330000","#220000","#110000","#000000","#110000","#220000","#330000","#440000","#550000","#660000","#770000","#880000","#990000","#AA0000","#BB0000","#CC0000","#DD0000","#EE0000");
farben = farbbibliothek[1];
function farbschrift(){for(var b=0;b<Buchstabe.length;b++){document.all["a"+b].style.color=farben[b]}farbverlauf()}function string2array(b){Buchstabe=new Array();while(farben.length<b.length){farben=farben.concat(farben)}k=0;while(k<=b.length){Buchstabe[k]=b.charAt(k);k++}}function divserzeugen(){for(var b=0;b<Buchstabe.length;b++){document.write("<span id='a"+b+"' class='a"+b+"'>"+Buchstabe[b]+"</span>")}farbschrift()}var a=1;function farbverlauf(){for(var b=0;b<farben.length;b++){farben[b-1]=farben[b]}farben[farben.length-1]=farben[-1];setTimeout("farbschrift()",30)}var farbsatz=1;function farbtauscher(){farben=farbbibliothek[farbsatz];while(farben.length<text.length){farben=farben.concat(farben)}farbsatz=Math.floor(Math.random()*(farbbibliothek.length-0.0001))}setInterval("farbtauscher()",900);

text= "Mạng Xã Hội Avatar Hàng Đầu Việt Nam"; //h
string2array(text);
divserzeugen();
//document.write(text);
</script></div>
</div>
 <?php
 
 echo'

 <div class="link-more"><div class="h"><div class="body">

<div class="da"><div class="nendn" align="center"><marquee behavior="scroll" direction="left" scrollamount="5" style="margin-top: 5px"><img src="/icon/iconxoan/dammaynho.png"></marquee> <marquee behavior="scroll" direction="left" scrollamount="7" style="margin-top: 10px"><img src="/icon/iconxoan/dammaylon.png"></marquee>
';
 
 } ?>

  
 

<style>
input[type="text"],input[type="password"]{background:#FDFDFD;color:#000;border:1px solid #d1d1d1;border-radius:1px;padding:1px 1px}
.nut {font-size: 12px;background-color: #3688c7;border: #e5e5e5 1px solid;color: #fff;width: auto;height: 25px;}
</style>

<style>
.xd{ height:5px };
</style>

<?php
if (!$user_id){

echo'
<br><br>
'; }
?>
<center>
 
 <?php


if ($user_id) {


echo'<table width="100%" border="0" cellspacing="0"><tbody><tr class="menu"><td  width="33%">';
echo'<a href="/nhom">Clan</a>';
echo'</td>
<td width="34%">';
$a = mysql_query("SELECT * FROM `thongbao` WHERE `ok` = '1' and `user` = '" . $user_id . "'");
$c = mysql_num_rows($a);
echo'<a href="' . $set['homeurl'] . '/thongbao.html">Thông báo';
if($c >=1){
echo ' <span class="label label-success">'.$c.'</span>';
}
echo'</a>';
echo'</td><td width="33%"">';
$new_mail = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` LEFT JOIN `cms_contact` ON `cms_mail`.`user_id`=`cms_contact`.`from_id` AND `cms_contact`.`user_id`='$user_id' WHERE `cms_mail`.`from_id`='$user_id' AND `cms_mail`.`sys`='0' AND `cms_mail`.`read`='0' AND `cms_mail`.`delete`!='$user_id' AND `cms_contact`.`ban`!='1' AND `cms_mail`.`spam`='0'"), 0);
echo'<a href="' . $set['homeurl'] . '/mail/new.html">Hộp thư';
if ($new_mail) $list[] = ' <span class="label label-success">' . $new_mail . ' </span>';
if (!empty($list)) echo '' . functions::display_menu($list, ', ') . '';
echo'</a>';
echo'</td></tr></table></div></div>';

}
if (!$user_id) {


}

if ($user_id) {
$hienluotboss = 1;
$hienluotboss2 = 2;
$time = time();
//--SYS--//


include 'sys/daugia.php';
include 'sys/taixiu.php';
include 'sys/pet.php';
include 'sys/check.php';
include 'sys/password_2.php';
include 'sys/hsd.php';
include 'sys/vitri.php';
include 'sys/kethon.php';
include 'sys/gioithieu.php';
include 'sys/house.php';
include 'sys/thongbaovatnuoi.php';
include 'sys/thongbaolambanh.php';
include 'sys/luotchoi.php';
include 'sys/luotbatdau.php';

?>
      <?php echo'        
 <div class="body"><div id="box_login_ads"> <div class="lucifer"><div style="text-align:center"><table width="100%" border="0" cellspacing="0"><tr class="">
<td width="32%"><center><a href="/member/'.$user_id.'.html">
<b> <font  color="#003366">'.$login.'</i>   </font></i></span></span></b><br><img src="/avatar/'.$user_id.'.png" width="45px"></a><br>0 <img src="http://4rumvn.net/img/vang.png"> vàng<br><a href="#"><b><font color="red">[Đổi Vàng]</font></b></a><br><font color="red"><img src="/icon/hp.png">HP Full:'.number_format($datauser['hpfull']).' HP</b></font></center></td>
<td width="32%"><div style="margin:3px;"><b><font color="#08f">
<img src="/icon/xu.png">  '.number_format($datauser['xu']).'&#160;Xu </font></div>
<div style="margin:3px;"><font color="#ff9800"> <img src="/icon/vnd.png"> '.number_format($datauser['vnd']).'&#160;Lượng</font></b></div>
<div style="margin:3px;"><b><font color="green"><img src="/icon/sao.png"> LV: '.number_format($datauser['level']).'+ '.number_format($datauser['chisolevel']).'% </font></b></div>
<div style="margin:3px;"><font color="blue"><img src="/icon/sm.png">  <b>'.number_format($datauser['sm']).' SM</font></b></div>
<div style="margin:3px;"><font color="red"><img src="/icon/hp.png"> <b>'.number_format($datauser['hp']).' HP</b></font></div></div>
</div></td>
<td width="32%"><div style="margin:3px;"><img src="/icon/icontuido.png"> <a href="/ruong"><font color="#006666">Rương đồ</font></a></div><div style="margin:3px;"><img src="/icon/iconthongtin.png"> <a href="/member/edit-'.$user_id.'.html"> <font color="#336600">Thiết Lập</font> </a></div>
<div style="margin:3px;"><img src="http://4rumvn.net/icon/iconshop.png"> <a href="/shop/myvien.php"> <font color="#336600">Shop đồ</font> </a></div>
<div style="margin:3px;"><img src="/icon/vip.png"> <a href="/sanbay/hawaii"> <font color="red">Khu Vip</font><img src="http://4rumvn.net/img/hot.gif"></a> </div>
<div style="margin:3px;"><img src="http://4rumvn.net/icon/vao.png"> <a href="/exit.php"><font color="#006600"> Thoát</font> </a></div></div></td></tr></table></div></div><div id="box_forums"><br><script>
document.write(unescape("%3Cdiv%20style%3D%22position%3A%20fixed%3B%20top%3A%200%3B%20%20padding%3A%205px%3B%20font-weight%3A%20bold%3B%20max-width%3A%20610px%3B%20width%3A%20100%25%3B%20z-index%3A%201000%3B%20-moz-box-sizing%3A%20inherit%3B%20box-sizing%3A%20inherit%3B%22%3E"));
</script>
 </div> </div> 
';

if ($rights>=6) {
$donhang=mysql_num_rows(mysql_query("SELECT * FROM `chotroi` WHERE `duyet`='0'"));
if ($donhang) {
echo '<div class="menu"><center><a href="/shop/chotroi.php?act=duyet"><font color="green">Có <b>'.$donhang.'</b> đơn hàng cần được phê duyệt</font></a></center></div>  ';
}
}
}
echo'<center>';
/////////////////////////////
if ($user_id) {


if (time()>$datauser['timehopqua']+3600*24) {
echo '<a href="/index.php?hopqua"><img src="http://4rumvn.net/icon/qua.png" width="20" height="20" alt="Nhận quà"></a>';
if (isset($_GET['hopqua'])) {
$randxu = rand(50000, 500000);
mysql_query("UPDATE `users` SET `xu` = `xu` + '".$randxu."', `timehopqua` = '".time()."' WHERE `id` = '".$user_id."'");
echo '<br/><b>Chúc Mừng Bạn Nhận Được Quà Điểm Danh <font color="red">'.$randxu.' Xu</font> Từ ID Thiên Ân</b>';
}
echo '&emsp;&emsp; ';
}
if (time()>$datauser['timequaon']+60*15) {


echo ' <a href="/index.php?quaonline"><img src="http://4rumvn.net/icon/qua.png" width="20" height="20" alt="Nhận quà"></a>';
if (isset($_GET['quaonline'])) {
$randxu = rand(10000, 200000);
mysql_query("UPDATE `users` SET `xu` = `xu` + '".$randxu."', `timequaon` = '".time()."' WHERE `id` = '".$user_id."'");
echo '<br/><b>Chúc Mừng Bạn Nhận Được Quà Online <font color="red">'.$randxu.' Xu</font> Từ ID Thiên Ân</b>';
}

};
Echo' <br><br> ';
};





?>


<style>.ancute{height:100px;}</style>
</center>


<?php


$sql = '';
$set_karma = unserialize($set['karma']);
if ($user_id) {
// Фиксируем местоположение авторизованных
if (!$datauser['karma_off'] && $set_karma['on'] && $datauser['karma_time'] <= (time() - 86400)) {
$sql .= " `karma_time` = '" . time() . "', ";
}
$movings = $datauser['movings'];
if ($datauser['lastdate'] < (time() - 300)) {
$movings = 0;
$sql .= " `sestime` = '" . time() . "', ";
}
if ($datauser['place'] != $headmod) {
$movings;
$sql .= " `place` = '" . mysql_real_escape_string($headmod) . "', ";
}
if ($datauser['browser'] != $agn)
$sql .= " `browser` = '" . mysql_real_escape_string($agn) . "', ";
$totalonsite = $datauser['total_on_site'];
if ($datauser['lastdate'] > (time() - 300))
$totalonsite = $totalonsite + time() - $datauser['lastdate'];
mysql_query("UPDATE `users` SET $sql
`movings` = '$movings',
`total_on_site` = '$totalonsite',
`lastdate` = '" . time() . "'
WHERE `id` = '$user_id'
");
} else {
// Фиксируем местоположение гостей
$movings = 0;
$session = md5(core::$ip . core::$ip_via_proxy . core::$user_agent);
$req = mysql_query("SELECT * FROM `cms_sessions` WHERE `session_id` = '$session' LIMIT 1");
if (mysql_num_rows($req)) {

// Если есть в базе, то обновляем данные
$res = mysql_fetch_assoc($req);
$movings = ++$res['movings'];
if ($res['sestime'] < (time() - 300)) {
$movings = 1;
$sql .= " `sestime` = '" . time() . "', ";
}
if ($res['place'] != $headmod) {
$sql .= " `place` = '" . mysql_real_escape_string($headmod) . "', ";
}
mysql_query("UPDATE `cms_sessions` SET $sql
`movings` = '$movings',
`lastdate` = '" . time() . "'
WHERE `session_id` = '$session'
");
} else {
// Если еще небыло в базе, то добавляем запись
mysql_query("INSERT INTO `cms_sessions` SET
`session_id` = '" . $session . "',
`ip` = '" . core::$ip . "',
`ip_via_proxy` = '" . core::$ip_via_proxy . "',
`browser` = '" . mysql_real_escape_string($agn) . "',
`lastdate` = '" . time() . "',
`sestime` = '" . time() . "',
`place` = '" . mysql_real_escape_string($headmod) . "'
");
}
}
/* BOT ONLINE */
mysql_query("UPDATE `users` SET $sql `total_on_site` = '$totalonsite', `lastdate` = ". time() . " WHERE `id` = '2'");
mysql_query("UPDATE `users` SET $sql `total_on_site` = '$totalonsite', `lastdate` = ". time() . " WHERE `id` = '11'");
mysql_query("UPDATE `users` SET $sql `total_on_site` = '$totalonsite', `lastdate` = ". time() . " WHERE `id` = '22'");
mysql_query("UPDATE `users` SET $sql `total_on_site` = '$totalonsite', `lastdate` = ". time() . " WHERE `id` = '33'");
mysql_query("UPDATE `users` SET $sql `total_on_site` = '$totalonsite', `lastdate` = ". time() . " WHERE `id` = '44'");
mysql_query("UPDATE `users` SET $sql `total_on_site` = '$totalonsite', `lastdate` = ". time() . " WHERE `id` = '908'");
/* END BOT ONLINE */
if(empty($datauser['timethuhoachkhe'])) {
mysql_query("UPDATE `users` SET `timethuhoachkhe` = '".$time."' where `id` = '" . $user_id . "'");
}
if ($ban){
if ($textl!='Nhà Tù') {
header('Location: /ngoaio/nhatu.php');
exit;
}
}
?>
                
          
<!-- Code By ID Thiên Ân, Ý Tưởng Và Bản Quyền Bởi Nguyễn Tráng -->
                        
                            
            
                            
                            
                            