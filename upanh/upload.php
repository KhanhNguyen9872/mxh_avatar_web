<?php
define('_IN_JOHNCMS', 1);
require_once('../incfiles/core.php');
$textl = 'Upload Ảnh';
require('../incfiles/head.php');
if (!$user_id) {
echo '<div class="list1"><b><font color=red>Chào bạn,nếu muốn sử dụng tool upload ảnh này thì bạn phải là thành viên của diễn đàn,nếu chưa có tài  khoản thì hãy <a href="/registration.php"><font color=blue>Đăng kí</font></a> ngay nào</font></div>';
require('../incfiles/end.php');
exit;
}
echo '<div class="list1" style="background:#FFFF99"><font color=red>•Chỉ cho phép Tải lên các tập tin hình ảnh.<br>•Nghiêm cấm tải lên các hình ảnh chứa nội dung đồi trụy.</font></div>';
echo '<form action="imgur.php" enctype="multipart/form-data" method="POST">
 <div class="phdr">Chọn hình ảnh tải lên</div><div class="lucifer"> <input name="img" size="35" type="file"/><br/>
 <input type="submit" name="submit" value="Upload" class="nut"/></div>
</form>';
echo'<div><div>';
require_once('../incfiles/end.php');
?>