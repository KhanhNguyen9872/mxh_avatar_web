<?php
define('_IN_JOHNCMS', 1);
session_name("SESID");
session_start();
$textl = 'Bầu Cua';
$headmod = 'baucua';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
$act = isset($_GET['act']) ? $_GET['act'] : '';
echo'';
echo'<div class="lucifer"><div class="danhmuc">Bầu Cua</div>';
if (!$user_id){
echo'<div class="menu">Bạn phải đăng nhập để chơi game này nhé !</div>';
echo'</div>';
require('../incfiles/end.php');
exit;
}
echo' <div class="menu list-bottom congdong">'.nick($user_id).' bạn có '.$datauser['xu'].' xu</div>';
$rand = mt_rand(100, 999);
$money_plus = "600";
$money_minus = "100";

if (!empty($_SESSION['uid'])) {

    switch ($act) {

        case "go":
                    $thimble = intval($_POST['thimble']);
                    $cuoc = intval($_POST['cuoc']);
echo '<div class="menu">';
if(isset($_POST['submit'])) {
            if ($datauser['xu'] >= $cuoc) {
if ($cuoc >= 100) {

                if (!empty($thimble)) {

 $rand_thimble = mt_rand(1, 6);
echo '<table bgcolor="lightyellow" width="100%" border="1"><tr>';

                    if ($rand_thimble == "1") {
                        echo '<td width="33%" align="center"><img src="img/baucua/4.gif" alt=""/></td>';
                    } else {
                        echo '<td width="33%" align="center"><img src="img/baucua/1.gif" alt=""/></td>';
                    }

                    if ($rand_thimble == "2") {
                        echo '<td width="33%" align="center"><img src="img/baucua/4.gif" alt=""/></td>';
                    } else {
                        echo '<td width="33%" align="center"><img src="img/baucua/2.gif" alt=""/></td>';
                    }

                    if ($rand_thimble == "3") {
                        echo '<td width="34%" align="center"><img src="img/baucua/4.gif" alt=""/></td>';
                    } else {
                        echo '<td width="34%" align="center"><img src="img/baucua/3.gif" alt=""/></td>';
                    }
echo '</tr><tr>';
                    if ($rand_thimble == "4") {
                        echo '<td width="33%" align="center"><img src="img/baucua/4.gif" alt=""/></td>';
                    } else {
                        echo '<td width="33%" align="center"><img src="img/baucua/5.gif" alt=""/></td>';
                    }

                    if ($rand_thimble == "5") {
                        echo '<td width="33%" align="center"><img src="img/baucua/4.gif" alt=""/></td>';
                    } else {
                        echo '<td width="33%" align="center"><img src="img/baucua/6.gif" alt=""/></td>';
                    }

                    if ($rand_thimble == "6") {
                        echo '<td width="34%" align="center"><img src="img/baucua/4.gif" alt=""/></td>';
                    } else {
                        echo '<td width="34%" align="center"><img src="img/baucua/7.gif" alt=""/></td>';
                    }

echo '</tr></table>';
                    if ($thimble == $rand_thimble) {
                       $money_plus_c = ($datauser['xu'] + $cuoc*3);
                        mysql_query("update `users` set `xu` ='" . $money_plus_c . "' WHERE `id` = '$user_id'");
                        echo '<div class="menu">Bạn đã <b>thắng</b> bạn sẽ nhận được '.($cuoc*3).' xu</div>';
                    } else {

                       $money_minus_с = ($datauser['xu'] - $cuoc);
                        mysql_query("update `users` set `xu`='" . $money_minus_с . "' WHERE `id` = '$user_id'");
                        echo '<div class="menu">Bạn đã <b>thua</b> bạn bị trừ '.$cuoc.' xu</div>';
                    }


                } else {
                    echo '<div class="menu">Bạn phải chọn một trong sáu con</div>';
                }


                echo '<div class="menu"><a href="/khugiaitri/baucua.php">Tiếp tục chơi</a></div>';

} else {
                echo '<div class="menu">Số tiền đặt cược phải trên 100 xu</b></div>';
}
            } else {
                echo '<b>Bạn không đủ tiền để chơi</b>';
            }
            } else{
            echo '<div class="menu" align="center"><b>Có lỗi xảy ra!</b></div>';
}
            echo '</div>';
            break;

        default:
echo '<div class="menu list-bottom"><form action="?act=go" method="post"><table bgcolor="lightyellow" width="100%"><tr><td width="33%" align="center"><img src="img/baucua/1.gif" alt=""/><br/><input type="radio" name="thimble" value="1"></td><td width="33%" align="center"><img src="img/baucua/2.gif" alt=""/><br/><input type="radio" name="thimble" value="2"></td><td width="34%" align="center"><img src="img/baucua/3.gif" alt=""/><br/><input type="radio" name="thimble" value="3"></td></tr><tr><td width="33%" align="center"><img src="img/baucua/5.gif" alt=""/><br/><input type="radio" name="thimble" value="4"></td><td width="33%" align="center"><img src="img/baucua/6.gif" alt=""/><br/><input type="radio" name="thimble" value="5"></td><td width="34%" align="center"><img src="img/baucua/7.gif" alt=""/><br/><input type="radio" name="thimble" value="6"></a></td></tr></table></div>
<div class="menu"><b>Chọn một một trong sáu con ở trên</b></div>
<div class="menu  list-bottom">Nhập số tiền cược:<br><input type="text" name="cuoc" value=""><br><input type="submit" name="submit" value="Chơi"></form></div>';
echo '<div class="menu"><b>Luật "chơi":</b><br/>
Bạn sẽ chọn 1 trong 6 con là "Bầu", "Cua", "Tôm", "Cá", "Nai" và "Gà".<br/>
Nếu bạn chọn đúng bạn sẽ nhận được Gấp 3 số xu bằng số xu đã cược<br/><br/>
Nếu bạn chọn sai bạn sẽ bị trừ số xu bằng số xu đã cược<br/>
Chúc bạn may mắn!</div>';
            break;
    }


} else {
    echo '<div class="rmenu">Bạn cần <a href="' . $home . '/login.php">Đăng Nhập</a> mới có thể bắt đầu cuộc chơi.<br/>';
    echo 'Đăng Ký Tại: <a href="' . $home . '/registration.php">Đây</a></div>';
}
echo '</div><div><div>';
require_once ("../incfiles/end.php");
?>