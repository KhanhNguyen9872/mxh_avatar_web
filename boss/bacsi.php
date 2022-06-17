<?php
$text1 = 'Phòng khám';

define('_IN_JOHNCMS', 1);

require('../incfiles/core.php');

        require('../incfiles/head.php');







echo '<div class="danhmuc">Bác sĩ</div>';
If ($user_id){
echo '<form method="post"><div class="list1"><font color=red>Phục hồi máu! 3000 xu/lần!</font><br><input type="submit" name="submit" value="Hồi phục"></div></form>';
if(isset($_POST['submit'])){
if($datauser['xu'] <3000){
echo 'Không đủ tiền';
} else {
mysql_query("UPDATE users SET xu = xu -3000 WHERE id = $user_id");
mysql_query("UPDATE users SET hp = hpfull WHERE id = $user_id");
echo 'Hồi phục thành công!';
}
}

}
Else {
Echo '<div class="rmenu">Đăng nhập đy thím!</div>';
}





        require('../incfiles/end.php');
?>