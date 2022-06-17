<?php
define('_IN_JOHNCMS',1);
require('../incfiles/core.php');

$err=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'"));
if (!$err) {
$id=$user_id;
}
$user=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$id."'"));
$textl='Thông tin thành viên '.$user[name].'';
require('../incfiles/head.php');
echo '<div class="phdr">'.$textl.'</div>';
echo'<table border="0" cellpadding="0" cellspacing="0" width="100%" class="profile-info">
</tr>
<tr>
<td class="left-info">ID tài khoản</td>
<td class="right-info"><span>' . $user['id'] . '</span></td>
</tr>
<tr>
<td class="left-info">Tên nick</td>
<td class="right-info"><span>' . htmlspecialchars($user['name']). '</span></td>
</tr>
<tr>
<td class="left-info">Tên thật</td>
<td class="right-info"><span>' . $user['imname'] . '</span></td>
</tr>
<tr>
<td class="left-info">Giới tính</td>
<td class="right-info">
<span>
' . ($user['sex'] == 'm' ? 'Con trai' : 'Con gái') . '</span>
</td>
</tr>
<tr>
<td class="left-info">Sức Mạnh</td>
<td class="right-info"><span>' . $user['sucmanh'] . ' Sức Mạnh</span></td>
</tr>
<tr>
<td class="left-info">Xu</td>
<td class="right-info"><span>' . $user['xu'] . ' Xu</span></td>
</tr>
<tr>
<td class="left-info">Lượng</td>
<td class="right-info"><span>' . $user['vnd'] . ' Lượng</span></td>
</tr>
<tr>
<td class="left-info">Bài viết</td>
<td class="right-info"><span>' . $user['postforum'] . ' Bài</span></td>
</tr>
<tr>
<td class="left-info">Lượt thích</td>
<td class="right-info"><span>' . $user['thank_di'] . ' Lượt</span></td>
</tr>
<tr>
<td class="left-info">Tỉnh thành</td>
<td class="right-info"><span>' . $user['live'] . '</span></td>
</tr>
<tr>
<td class="left-info">Điện thoại</td>
<td class="right-info"><span>' . $user['mibile'] . '</span></td>
</tr>
<tr>
<td class="left-info">Sở thích</td>
<td class="right-info"><span>' . $user['about'] . '</span></td>
</tr>
</table>';

<div class="list1">
if (!functions::is_contact($user['id'])) {
echo'<a href="edit-' . $user['id'] . '.html">Thiết lập</a> - ';
}
echo'<a href="/users/profile.php?act=activity&mod=topic&user=' . $user['id'] . '">Tìm kiếm chủ đề từ ' . htmlspecialchars($user['name']). '</a>';
echo' - <a href="/users/profile.php?act=activity&user=' . $user['id'] . '">Tìm kiếm bài gửi từ ' . htmlspecialchars($user['name']). '</a>';
echo'</div>';

require('../incfiles/end.php');
?>