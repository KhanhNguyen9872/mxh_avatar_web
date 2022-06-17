<?php
if ($user_id) {
$list = array();
$new_sys_mail = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_mail` WHERE `from_id`='$user_id' AND `read`='0' AND `sys`='1' AND `delete`!='$user_id';"), 0);
if ($new_sys_mail) $list[] = '<div class="omenu"><a href="' . $home . '/mail/index.php?act=systems">&nbsp;&nbsp;<img src="/mail/images/thongbaomoi.gif"><font color="red"> <font color="red"> Bạn có </font> ' . $new_sys_mail . ' thông báo mới chưa xem</font></a></div>';
if (!empty($list)) echo'' . functions::display_menu($list, ', ') . '';
}
if ($user_id) {
include('map.php');
}
if ($user_id) {


echo'<div class="phdr"><i class="fa fa-music"></i> Trình Nghe Nhạc</div>
<div class="omenu"> <center>
<b><i class="fa fa-volume-up"></i><font color="blue"> Bài Hát : Để Mị Nói Cho Mà Nghe - Hoàng Thuỳ Linh 
</font></b></br>Nếu chưa có tên bài hát hãy vào chọn lại bài hát ở trên nhé các bạn!</br><audio loop="true" src="http://172.104.188.20/nhachihi.mp3" controls="controls" style="width:100%">  </audio></div>';}
echo'<div class="box_list_parent_index">';




//chat box ajax
if ($user_id) {
echo'<div class="phdr"><i class="fa fa-comments-o"></i> Góc Trò Truyện</div><div class="box_list_parent_index"><div class="da">';
if ($datauser['chanchat'] == 1)
{
echo '<div class="rmenu">Bạn đã bị chặn chat...</div>';
}
else
{
//--Phòng Chát--//

$refer = base64_encode($_SERVER['REQUEST_URI']);
$token = mt_rand(1000, 100000);
$_SESSION['token'] = $token;
echo '<center><div class="da"><form name="shoutbox" id="shoutbox" action="/guestbook/index.php?act=say" method="post"><img src="https://i.imgur.com/nloP2Lz.png"><br><textarea rows="3"  style="border-left:2px solid #44B6AE !important;" id="msg" name="msg" class="form-control"></textarea><input type="hidden" name="ref" value="'.$refer.'"/><input type="hidden" name="token" value="'.$token.'"><br /><button class="btn btn-danger" type="submit" name="submit"><i class="fa fa-pencil" aria-hidden="true"></i> ' . $lng['sent'] . '</button></center></form><br>';
}
echo '<div id="datachat"></div></div></div>';

}
/*
//--Kết thúc Phòng Chát//
echo '<script src="/pages/ajax.js"></script>';
echo '<div class="phdr"><b><i class="glyphicon glyphicon-envelope"></i> Phòng chat • <a href="/pages/faq.php?act=smileys">Smileys</a></b>
</div>';
$refer = base64_encode($_SERVER['REQUEST_URI']);
$token = mt_rand(1000, 100000);
$_SESSION['token'] = $token;
echo '<table cellpadding="0" cellspacing="0" width="99%" border="0" style="table-layout:fixed;word-wrap: break-word;">
<tbody><tr><td width="48px;" class="blog-avatar"><img src="/avatar/'.$user_id.'.png"  align="top">&nbsp;</td><td style="vertical-align: bottom;"><table cellpadding="0" cellspacing="0">
<tbody><tr><td class="current-blog" rowspan="2" style="">
<div class="blog-bg-left"><img src="/giaodien/images/left-blog.png"></div><div class="newsx">
<form id="form" method="POST">
<textarea type="text" placeholder="Chém vui vẻ!" id="postText" name="msg" class="form-control"></textarea>
<button name="submit" type="submit" id="submit" class="nut">Gửi</button>'.($rights >= 3? ' <a href="/congvien/botpanel.php">[BOT]</a> ': '').'
<input type="hidden" name="token" value="' . $token . '"/>
</form>
</div></td></tr></tbody></table></td></tr></tbody></table>';
}
echo '<div id="alert"></div><div id="postText"></div><div id="idChat"></div>';
} */
//--Kết thúc Phòng Chát//
if ($user_id) {
echo'<div class="da"><div class="phdr"><i class="fa fa-book"></i> Bài Viết Mới</div>';
echo'';
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `close`!='1'"), 0);
$req = mysql_query("SELECT * FROM `forum` WHERE `type` = 't' and kedit='0' AND `close`!='1' ORDER BY `time` DESC LIMIT $start, $kmess");
while ($arr = mysql_fetch_array($req)) {
$q3 = mysql_query("select `id`, `refid`, `text` from `forum` where type='r' and id='" .$arr['refid'] . "'");
$razd = mysql_fetch_array($q3);
$q4 = mysql_query("select `id`, `refid`, `text` from `forum` where type='f' and id='" .$razd['refid'] . "'");
$frm = mysql_fetch_array($q4);

$trang4 = mysql_query("SELECT * FROM `forum_thank` WHERE `topic` = '" . ($arr['id'] + 1) . "'");
$trang5 = mysql_num_rows($trang4);

$nikuser = mysql_query("SELECT `from`,`id`, `time` FROM `forum` WHERE `type` = 'm' AND `close` != '1' AND `refid` = '" . $arr['id'] . "'ORDER BY time DESC");
$colmes1 = mysql_num_rows($nikuser);
$cpg = ceil($colmes1 / $kmess);
$nam = mysql_fetch_array($nikuser);

echo is_integer($i / 1) ? '<div class="da"><div class="lucifer">' : '<div class="phdr"><i class="fa fa-book"></i> NHỮNG BÀI VIẾT MỚI NHẤT </div><div class="lucifer">';

echo '<img src="/avatar/'.$arr['user_id'].'.png" alt="'.$gres['name'].'" class="avatar_vina"/></br>';

echo ' <img src="images/' . ($arr['edit'] == 1 ? 'tz' : 'np') . '.gif" alt=""/> ';
if ($arr['vip'] == 1) echo '<b>';
if ($arr['realid'] == 1)
echo ' <img src="images/rate.gif" alt=""/> ';

echo ' <a href="'.$home.'/forum/' . $arr['id'] . '.html">' . functions::smileys($arr['text']) . '</a>';
if ($trang5 !== 0) echo '<font color="red"> [♥' . $trang5. ']</font>';
if ($arr['vip'] == 1) echo '</b> <img src="/images/hot.gif"/>';
if (!empty ($nam['from'])) {
echo ' <br/></br><font style="font-size:11px"> Bình luận mới : <b>' . $nam['from']. '</b> - Tổng : ' . $colmes1 . ' Bình Luận';
echo ' </font>';
}
echo '</div>';

$i++;
}
if ($user_id) {
echo'</div>';
};
//////
$ddvn=mysql_query("SELECT * FROM `forum` WHERE `type`='f' ");
While($f=mysql_fetch_array($ddvn)){
Echo'<div class="phdr"><i class="fa fa-cubes"></i> <b>'.$f['text'].'</b></div><div class="lucifer">';
$ddvn1=mysql_query("SELECT * FROM `forum` WHERE `type`='r' AND `refid`='".$f['id']."' ");
while($r=mysql_fetch_array($ddvn1)){
echo'<div class="menuvj"><i class="fa fa-arrow-circle-right" style="color:#3c763d"></i> <a href="/forums/'.$r['id'].'.html"><b><font color="2c5170">'.$r['text'].'</font></b></a><br/>';
if($r['soft']) echo '<i class="fa fa-hand-o-right" style="color:#3c763d"></i> <small>'.$r['soft'].'</small><div class="sub"></div>';

$ddvn2=mysql_query("SELECT * FROM `forum` WHERE `type`='t' AND `refid`='".$r['id']."' LIMIT 1");
$i=1;
While($t=mysql_fetch_array($ddvn2)){
if ($t['vip'] == 1)
echo '<b>';
if ($t['indam'] == 1)
echo '<b>';
echo '<i class="fa fa-comments" style="color:#3c763d"></i> <a href="'.$home.'/forum/'.$t['id'].'.html"><span style="size:8px;">' .$t['text'] . '</span></a>';
if ($t['indam'] == 1)
echo '</b>';
if ($t['vip'] == 1)
echo '</b> <img src="../images/smileys/simply/hot:.gif"/>';
echo'</br>';
$i=-(-$i-1);
}
echo'</div>';
}

echo'</div>';
}
echo '</div></div>';
} 

if(!$user_id){




echo '<form action="/login.php" method="post">

<b>✔ Tài khoản: </b><br>
<input
type="text" name="n" placeholder="Tài khoản"
value="" maxlength="28" width="100px" class="name"/>
<br/>
<b>✔ Mật Khẩu: </b>
<br/>
<input type="password"
name="p" placeholder="Mật Khẩu"
value="" maxlength="28" width="100px" class="pass">
<br/>
<input
type="hidden" name="mem"
value="1"
checked="checked"><input type="hidden" name="next" value="'.$url.'" />
<br>
<input type="submit"  value="Đăng nhập" /> 


</form> <br>
<a href="/dangki.html" title="Đăng Kí Làm Thành Viên" ><input type="submit" value="Đăng Kí"></a>
<a href="#" title="Lấy Lại Mật Khẩu" ><input type="submit" value="Quên Mật Khẩu"></a>
</div>';
?>
<br><b><div class="lucifer">
<a style="color: #000;font-size:12px;" href="/dangki.html">MXH đã tồn tại hơn 3 năm tạo độ uy tín.<br>Bạn chưa có tài khoản bấm vào <font color="green">đây</font> để<br><font color="red">Đăng kí</font> hoàn toàn miễn phí!</a></b></div><br><div class="lucifer"><img src="http://4rumvn.net/img/xMfsViF.png" height=70>-<img src="http://4rumvn.net/img/ninja.png" height=70><div class="w3-container"><h4><font color="red">Ngũ Long Tranh Bá và Làng Ninja.(Chính Thức PB MXH)</font><br><img src="/avatar/1.png"/><img src="/avatar/2.png"/><img src="/avatar/3.png"/><br><img src="/avatar/4.png"/><img src="/avatar/5.png"/><img src="/avatar/6.png"/><img src="/avatar/7.png"/><br><br><img src="http://4rumvn.net/images/1.png">Chào Đón Sự Kiện Noel Cùng 4RumVN.Net<img src="http://4rumvn.net/images/1.png"><br><img src="http://4rumvn.net/img/hot.gif">Sự kiện Noel 2019 - Giáng Sinh Ấm Áp!<img src="http://4rumvn.net/img/hot.gif"></h4><br>
<button data-toggle="modal" data-target="#4rum" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-home"></span> Xem Chi Tiết...
        </button></center><br> 
         
          
           </div>


     
              
<?php 
}



////////

echo'          <div class="da">  <div class="phdr"><i class="fa fa-bar-chart"></i> THỐNG KÊ DIỄN ĐÀN 2019 </div><div class="lucifer"><div class="lucifer"><i class="fa fa-check-square-o"></i> Thành viên : <b><font color="blue"> ' .number_format(mysql_result(mysql_query("SELECT COUNT(*) FROM `users`"), 0)) . ' </font></b></div><div class="lucifer"><i class="fa fa-check-square-o"></i> Chủ đề : <b><font color="blue"> ' .number_format(mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `close` != '1'"), 0)) . ' </font></b></div><div class="lucifer"><i class="fa fa-check-square-o"></i> Bài viết : <b><font color="blue"> ' .number_format(mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 'm' AND `close` != '1'"), 0)) . '</font></b></div>

<div class="lucifer"><i class="fa fa-check-square-o"></i> Xu : <b><font color="blue"> ' .number_format(mysql_result(mysql_query("SELECT SUM(xu) FROM `users`"), 0)) . ' </font></b><i class="fa fa-check-square-o"></i> Lượng : <b><font color="blue"> ' .number_format(mysql_result(mysql_query("SELECT SUM(vnd) FROM `users`"), 0)) . ' </font></b></div>

</div>';

?>

<center><br><br><img src="http://i.imgur.com/by1LP4n.png" /><img src="http://i.imgur.com/WeS2BOO.png" /></center><div class="buico"></div><div class="da"><div style="text-align:center"><div class="lucifer"><table width="100%" border="0" cellspacing="0"><tr>
<td width="50%"><a href="/"><img src="https://i.imgur.com/TbsHud8.png"/><br/><b><font color="red"> Vision 2.6.0 </b></font></a></td>
<td width="50%"><br/><b><font color="red"><div class="lucifer">-Không Kích Hoạt(Hoàn Toàn Miễn Phí)<br>-5 Giao Diện Mới (Lựa Chọn Member)<br>-Cập Nhập Sự Kiện Theo Tháng<br>-Thành Lập Lâu Đời T.5/2017<br>-Gần 2000 chủ đề,50.000 bài viết</div></b></font></td></tr></table></div></div></div>
<marquee behavior="scroll" direction="left" scrollamount="11" ><img src="http://4rumvn.net/icon/xebuyt.png" width="70"></marquee>

<?php

if ($user_id) {
echo'</div></div></div></div></div></div></div></div></div>';
};

// Thống kê online
$users = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 300) . "'"), 0);
mysql_query("UPDATE `users` SET $sql `total_on_site` = '$totalonsite', `lastdate` = " . time() . " WHERE `id` = '7'");echo'<div class="phdr"><i class="fa fa-line-chart"></i> Đang có '.($user_id || $set['active'] ? '<a href="/users/index.php?act=online"><font color="f8f8ff">'.$users.'' : $users).'</font></a> thành viên online</div>';
echo'<a id="ok"><div class="omenu"><center><font color="red"><b>Xem Ai Online ??</b></font></b><br> 
<font color="red"><b><i class="fa fa-chevron-down"></i></b></font></center></div></a><div id="oke" style="display: none;"><div class="omenu">';
echo'';
include 'incfiles/online.php';
echo '</div>';
echo'</div>';
if(!$user_id){ echo'</div>'; }
include 'xuli.php';

?>  
 
 
 <div id="4rum" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sự Kiện Hè - ĐẠI CHIẾN THANOS 2019 MXH 4RumVN.Net!
</h4>
      </div>
      <div class="modal-body">
        <p><div align="center">Sự Kiện Hè - ĐẠI CHIẾN THANOS 2019 MXH 4RumVN.Net!
</div>Trong d&ograve;ng thời gian kh&aacute;c, t&ecirc;n Si&ecirc;u &aacute;c nh&acirc;n Thanos đ&atilde; t&igrave;m đến Th&agrave;nh phố 4RUMVN.NET v&agrave; quyết t&acirc;m biến v&ugrave;ng đất n&agrave;y th&agrave;nh b&igrave;nh địa, giống như những g&igrave; hắn đ&atilde; g&acirc;y ra ở những v&ugrave;ng đất kh&aacute;c<br />
<br />
H&atilde;y h&oacute;a th&acirc;n th&agrave;nh những Si&ecirc;u anh h&ugrave;ng để đ&aacute;nh bại t&ecirc;n &aacute;c nh&acirc;n, mang lại h&ograve;a b&igrave;nh cho Th&agrave;nh phố<br />
<br />
<span style="font-weight: bold"><span style="color:red">I. THỜI GIAN SỰ KIỆN:</span></span><br />
Dự kiến ra mắt v&agrave;o 10:00 ng&agrave;y 03/05/2019 (C&oacute; thể sớm hơn dự kiến)<br />
Kết th&uacute;c v&agrave;o 10:00 ng&agrave;y 25/07/2019<br />
<br />
<span style="font-weight: bold"><span style="color:red">II. NỘI DUNG SỰ KIỆN:</span></span><br />
<br />
<span style="font-weight: bold">1.Đ&aacute; v&ocirc; cực: Trong suốt thời gian diễn ra sự kiện, tham gia c&aacute;c hoạt động sau sẽ nhận được Tinh thể v&ocirc; cực:</span><br />
<br />
+ Thu hoạch n&ocirc;ng sản sẽ c&oacute; tỉ lệ 100% nhận được Tinh thể v&ocirc; cực<br />
+ Trả lời ch&iacute;nh x&aacute;c c&acirc;u hỏi tiếng Anh của c&ocirc; gi&aacute;o tại c&ocirc;ng vi&ecirc;n nhận 5 Tinh thể v&ocirc; cực<br />
+ C&acirc;u d&iacute;nh c&aacute; sẽ may mắn nhận được Tinh thể v&ocirc; cực <span style="font-weight: bold">(Chỉ Khu C&acirc;u Cá M&acirc;̣p)</span><br />
+ CHAT <span style="color:red">nhanqua</span> nhận 30 Tinh Thể V&ocirc; Cực<br />
+ Nh&acirc;̣p H&ocirc;̣p Quà <img src="https://www.ngostore.net/wp-content/uploads/2019/08/icon-qua-luu-niem.png" width="5%" border="0" /> , cứ m&ocirc;̃i 60 phút nh&acirc;̣n 20 tinh th&ecirc;̉<br />
<br />
Mang tinh thể v&ocirc; cực đến bỏ v&agrave;o Găng tay v&ocirc; cực vào Khu Sự Ki&ecirc;̣n tại Trung T&acirc;m Thành Ph&ocirc;́<br />
<br />
Cứ mỗi 10 Tinh thể v&ocirc; cực sẽ 100% nhận được ngẫu nhi&ecirc;n 1 trong 6 vi&ecirc;n đ&aacute; V&ocirc; cực<br />
<br />
<span style="font-weight: bold">2. Ti&ecirc;u diệt Thanos:</span><br />
+ Mỗi ng&agrave;y v&agrave;o l&uacute;c 10:00 - 13:00 v&agrave; 19:00 - 22:00, Thanos sẽ xuất hiện để g&acirc;y hấn với mọi người<br />
H&atilde;y c&ugrave;ng nhau ti&ecirc;u diệt Thanos<br />
<br />
+ Người chơi mặc full 1 trong những set đồ Si&ecirc;u anh h&ugrave;ng mới được tham chiến ti&ecirc;u diệt Thanos. Người ph&agrave;m kh&ocirc;ng thể chiến đấu lại kẻ &aacute;c nh&acirc;n hung h&atilde;n n&agrave;y.<br />
<br />
+ Trong thời gian đ&aacute;nh Thanos bạn sẽ may mắn nhận được Mảnh Gh&eacute;p Găng Tay. Sử dụng 10 mảnh gh&eacute;p để gh&eacute;p th&agrave;nh Găng Tay.<br />
<br />
+ Mặc Full Set Iron Man (Nạp Card) tỉ lệ rớt mảnh gh&eacute;p l&agrave; 10 %<br />
+ Mặc Full Set Captain(Quay số) tỉ lệ 5 %<br />
<br />
<span style="font-style:italic">+ 1 Găng tay kết hợp c&ugrave;ng 6 vi&ecirc;n Đ&aacute; v&ocirc; cực kh&aacute;c nhau sẽ th&agrave;nh Găng Tay V&ocirc; Cực</span><br />
<br />
<br />
<span style="font-weight: bold">3. Sử dụng Găng tay v&ocirc; cực:</span><br />
+ Đối với găng tay v&ocirc; cực đầu ti&ecirc;n bạn gh&eacute;p th&agrave;nh c&ocirc;ng khi đem đến Dr. Strange để đổi vật phẩm bạn sẽ ngẫu nhi&ecirc;n nhận được C&aacute;nh Nhiệt Huyết<br />
+ Bắt đầu từ găng tay v&ocirc; cực thứ 2, khi đem đến Dr. Strange đổi 1 găng tay v&ocirc; cực bạn sẽ nhận được 50 đi&ecirc;̉m sự ki&ecirc;̣n !!<br />
<br />
<span style="font-weight: bold">4.Đua Top Bắn Pháo</span><br />
+ Bắn pháo hoa: Tích đi&ecirc;̉m đua top bắn pháo<br />
+ Bắn pháo xu m&acirc;́t 30.000 xu: 1 vi&ecirc;n đá cường hóa HP ng&acirc;̃u nhi&ecirc;n hoặc EXP(1 đi&ecirc;̉m) <br />
+ Bắn pháo lượng m&acirc;́t 7 lượng: 1 vi&ecirc;n đá cường hóa SM ng&acirc;̃u nhi&ecirc;n hoặc EXP(2 đi&ecirc;̉m) <br />
+ Bắn pháo li&ecirc;n hoàn m&acirc;́t 500.000 xu và 70 lượng: được 50 vi&ecirc;n đá HP hoặc SM ng&acirc;̃u nhi&ecirc;n + th&ocirc;ng báo chat box. (10 đi&ecirc;̉m) <br />
<br />
<span style="font-weight: bold">Bắn pháo ít nh&acirc;́t 5000 phát mới được tính</span><br />
<br />
<span style="font-weight: bold"><span style="color:red">III.PH&Acirc;̀N THƯỞNG</span></span><br />
<br />
Update vào thời gian sau!<br />
<br />
Cu&ocirc;́i cùng BQT 4Rum.Pro chúc các thành vi&ecirc;n 4Rum.Pro có 1 mùa hè tràn đ&acirc;̀y ni&ecirc;̀m vui! <img src="http://4rumvn.net/images/emoz/14.gif"><br />
<br />
Th&acirc;n and Th&ocirc;ng 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng Thông Tin</button>
      </div>
    </div>

  </div>
</div>

