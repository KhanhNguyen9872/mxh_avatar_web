<?php
$demnha=mysql_num_rows(mysql_query("SELECT * FROM `gamemini_house_chat` WHERE `nha_id`=".$user_id." AND `view`='0' AND `user_id`!='".$user_id."'"));
$house=mysql_query("SELECT * FROM `gamemini_house_chat` WHERE `nha_id`=".$user_id." AND `view`='0'");
if ($demnha>0) {
echo '<div class="thongbaomini">';
echo '<img src="/icon/iconhome.gif"> ';
echo '<a href="/sanbay/dancu/house.php?id='.$user_id.'">';
echo 'Có người đang chat trong nhà bạn';
echo '</a>';
}
echo '</div>';
?>