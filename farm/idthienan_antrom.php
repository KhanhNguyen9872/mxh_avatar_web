<?php
define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl='Lái buôn';
require('../incfiles/head.php');
if (!$user_id) {
header('Location: /login.php');
exit;
}
/* ID Thiên Ân */
echo '<div class="phdr">Trộm Nông Trại </div>';
echo'<div class="lucifer"><br>
<form method="get" action="/farm/account.php">

<input name="id" value="" placeholder="Nhập ID Cần Ăn Trộm!" type="text">
<br><br>
<button type="submit"   >Trộm Ngay</button>
<br><br>

<font color="red"><b>
Lưu ý: Nếu id của user chưa đăng kí thì sẽ tự động chuyển về trang chủ.
</b></font>

</form>
</div>


';

echo '<div><div>';




require('../incfiles/end.php');
?>
                            
                            
                            
                            