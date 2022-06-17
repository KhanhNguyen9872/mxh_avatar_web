<?php
define('_IN_JOHNCMS', 1);
if(preg_match('|#Avatar|',$msg) ||preg_match('|#avatar|',$msg) ||preg_match('|#AVATAR|',$msg)) {
$puarudz= explode(" ",$msg);
$puarudz2= $puarudz[1];
file_get_contents('http://27.0.14.78/services/avatar/image2/'.$puarudz2.'.gif');
//Code Check Tài Khoản
echo $http_response_header[0];
if($http_response_header[0] == 'HTTP/1.1 200 OK'){
$msg2 = 'Nhân Vật Avatar [b][red]'.$puarudz2.'[/b][/red] Là:
[img]http://27.0.14.78/services/avatar/image2/'.$puarudz2.'.gif[/img]';} else {
$msg2 = 'Nhân Vật Avatar [b][red]'.$puarudz2.'[/b][/red] Có Tồn Tại Ở TeaMobi Đéo Đâu? :D';}
$time = time()+10;
     mysql_query("INSERT INTO `guest` SET

                `adm` = '0',

                `time` = '" . $time . "',

                `user_id` = '2',

                `name` = 'BOT',

                `text` = '" . mysql_real_escape_string($msg2) . "',

                `ip` = '11111',

                `browser` = 'I-Pad'

            ");
}


?>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/logfile.php');
////// Vipgun98s2 - writed
?>