<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');
$textl='Giới thiệu';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
$id=(int)$_GET['id'];
echo '<div class="mainblok">';
if (isset($_GET[id])) {
$us=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` ='".$id."'"));
$get = mysql_query("SELECT * FROM `users` WHERE `gioithieu`= '".$id."'");
$getrow=mysql_num_rows($get);
echo '<div class="phdr">Thông tin giới thiệu</div>';
echo '<div class=gmenu"><b>'.$us['name'].'</b> giới thiệu được '.$getrow.' member</div>';
$i=1;
if ($getrow>=1) {
while ($res=mysql_fetch_array($get)) {
echo '<div class="list1"><b>#'.$i.' - <a href="/member/'.$res['id'].'.html">'.$res['name'].'</a></b>'.($rights>=3 ? ' <b>-</b> <a href="/panel/index.php?act=search_ip&ip='.long2ip($res['ip']).'">'.long2ip($res['ip']).'</a>':'').'</div>';
$i++;
}
}
} else {
echo '<div class="phdr">Giới thiệu</div>';
echo '<div class="news">Link giới thiệu: <input type="text" value="'.$home.'/reg/'.$user_id.'"></div>';
echo '<div class="gmenu"><b>Mẫu quảng cáo:</b><br/><textarea rows="6">Link 8vui.top : '.$home.'/reg/'.$user_id.'
Chào các bạn.
Hôm nay mình sẽ chia sẻ cho các bạn 1 MXH cực hay và hấp dẫn đó là  '.$home.'/reg/'.$user_id.' 
MXH với nhiều chức năng mới và đặc biệt mà các MXH khác không có.
1. Phương thức đăng ký mới lạ bạn có thể đăng ký bằng nick KH hoặc bằng SMS rất tiện ích .
2. Hệ thống đồ họa, item giống game Avatar ngoài ra còn có thêm nhiều item mới do BQT sưu tầm và thiết kế. Đáp ứng nhu cầu làm đẹp của mọi người. Shop tuyệt đẹp cũng như chức năng quay số và nâng cấp item dùng đá như Avatar rất cuốn hút có tỉ lệ rõ ràng. Có thể nói chưa có MXH nào làm được như vậy. Ngoài ra các item trong shop cũng như nâng cấp và quay số đều được các admin thêm mới mỗi ngày.
3. Hệ thống nông trại phong phú với nhiều cây trồng và vật nuôi khác nhau để bạn lựa chọn nuôi trồng để kiếm thêm thu nhập. Bạn có thể dùng nông sản để chế biến trong nhà bếp để bán được nhiều tiền hơn. Để thêm nhiều nông sản bạn có thể mua thêm ô đất để trồng cây tối đa là 60ô và khi đạt số ô đất tối đa bạn có thể nâng cấp đất lên lv2. Ngoài ra để tăng tính hấp dẫn hàng tuần BQT còn tổ chức đua top phú nông và thánh trộm cho mọi người những bạn đứng top sẽ có phần thưởng rất lớn
4. Hệ thống Game Mini đa dạng hấp dẫn như: Phá khóa , Đập trứng ra item , Đoán số được lượng , Xổ số và Oản tù tì bằng xu giữa các người chơi với nhau.
5. Hệ thống mới chưa từng có đó là chợ trời giúp bạn có thể trao đổi buôn bán item giữa các người chơi.
6. Ngoài chơi game ngay trên diễn dàn bạn còn có thể lập ra các topic để chia sẽ những điều mới lạ cho nhau như diễn đàn Team , hay hơn nữa nếu đóng góp nhiều bài viết cũng như được like nhiều , bạn sẽ được lên cấp và đạt cấp độ mới sẽ đẹp hơn còn được nhận quà theo mốc. Các event mini như Đuổi hình bắt chữ, Đoán tên bài hát..sẽ diễn ra thường xuyên. Và còn có chatbox để tán gẫu với nhau.
7. Hệ thống tường nhà theo dõi và lịch sử giao dịch mới lạ giúp bạn biết được các hoạt động của mình và lý do được hoặc mất item.. Để khuyến khích khi online nhiều sẽ đạt được mốc quà tặng khác nhau.
8. Chức vụ như MXH Team full chức năng giao diện đẹp. Đặc biệt MXH hỗ trợ tất cả các loại điện thoại. Chỉ cần kết nối Internet bạn đã có thể tham gia và tận hưởng sự thú vị của MXH này. Hãy ghi nhớ tên wap là: '.$home.'/reg/'.$user_id.'
Rất vui được đón chào các bạn tham gia MXH '.$home.'/reg/'.$user_id.' Thân mời
</textarea></div>';
}
echo '<div class="phdr">Thông tin</div>';
echo '<div class="list1">
Bạn đã giới thiệu được : <b>'.$gt.' người </b><br/>
</div>';
echo '<div class="login"><details><summary><font color="red">Xem phần quà giới thiệu</font></summary><div class="list1">Quà giới thiệu 10 người :</br>
+ xu = 500.000</br>
+ lượng = 5</br>
+ item = <img src="http://8vui.top/images/shop/787.png">
</div><div class="list1">Quà giới thiệu 25 người :</br>
+ xu = 2.000.000</br>
+ lượng = 10</br>
+ item = <img src="http://8vui.top/images/shop/788.png">
</div><div class="list1">Quà giới thiệu 50 người :</br>
+ xu = 5.000.000</br>
+ lượng = 15</br>
+ item = <img src="http://8vui.top/images/shop/789.png">
</div><div class="list1">Quà giới thiệu 80 người :</br>
+ xu = 10.000.000</br>
+ lượng = 15</br>
+ item = <img src="http://8vui.top/images/shop/790.png">
</div><div class="list1">Quà giới thiệu 100 người :</br>
+ xu = 20.000.000</br>
+ lượng = 25</br>
+ item = <img src="http://8vui.top/images/shop/791.png">
</div>';
echo '</details></div></div>';
require('../incfiles/end.php');
?>
                            
                            
                            
                            