<?php
if ($areanonline['win'] == '0') {
$danh = array("cùi trỏ","tát vào má","cùi vào trym","xiết cổ","nắm tóc","bấu má");
$phan = array("tát","đấm vào mặt","phang trả","chống cự","nắm tóc","đấm vào bụng");
$rand = rand(0,5);
if ($user_id == $luotchoi) {
if(isset($_POST['danh'])) {
echo'<div class="menu list-top">';

###
$chisodanh = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['user_id']."'"));
$chiasucdanh = $chisodanh[sucmanh]/8;
$chiasucdanh2 = $chiasucdanh+$chiasucdanh/2;
$sucdanh = rand($chiasucdanh,$chiasucdanh2);
####
$chisodanh1 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$chiasucdanh1 = $chisodanh1[sucmanh]/8;
$chiasucdanh12 = $chiasucdanh1+$chiasucdanh1/2;
$sucdanh1 = rand($chiasucdanh1,$chiasucdanh12);
####
$chisodanh2 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi2']."'"));
$chiasucdanh2 = $chisodanh2[sucmanh]/8;
$chiasucdanh22 = $chiasucdanh2+$chiasucdanh2/2;
$sucdanh2 = rand($chiasucdanh2,$chiasucdanh22);
####
$chisodanh3 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi3']."'"));
$chiasucdanh3 = $chisodanh3[sucmanh]/8;
$chiasucdanh32 = $chiasucdanh3+$chiasucdanh3/2;
$sucdanh3 = rand($chiasucdanh3,$chiasucdanh32);

$tyleexp = $datauser[level]+3;
$exp = rand(1,$tyleexp);
if ($exp == 1) {
echo '<div class="menu list-bottom hot" style="color:green;">Bạn nhận '.$exp.'%  kinh nghiệm !</div>';
        mysql_query("UPDATE `users` SET
            `chisolevel`='" . ($datauser['chisolevel'] + 1) . "'
            WHERE `id` = '".$user_id."'");
}

if ($user_id == $areanonline['user_id']) {
if ($user_id == $luotchoi) {
mysql_query("UPDATE `boss` SET `luotdi`='".$luotchoi."',`time`='".time()."' WHERE `id`='".$id."'");
echo '<div class="menu">Bạn đã '.$danh[$rand].' '.$boss[tenboss].'  mất '.$sucdanh.' hp.</div>';
mysql_query("UPDATE `boss_chien_arena` SET `hp`= `hp`-'{$sucdanh}'WHERE `phong`='".$ttboss[phong]."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['user_id']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`cachdanh` = '" .$danh[$rand]. "',
`sodanh` = '" .$sucdanh. "',
`type` = '1'
");
} else {
header("Location: /boss/$id");
}
}
if ($user_id == $areanonline['nguoichoi']) {
if ($user_id == $luotchoi) {
mysql_query("UPDATE `boss` SET `luotdi`='".$luotchoi."',`time`='".time()."' WHERE `id`='".$id."'");
echo '<div class="menu">Bạn đã '.$danh[$rand].' '.$boss[tenboss].'  mất '.$sucdanh1.' hp.</div>';
mysql_query("UPDATE `boss_chien_arena` SET `hp`= `hp`-'{$sucdanh1}'WHERE `phong`='".$ttboss[phong]."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`cachdanh` = '" .$danh[$rand]. "',
`sodanh` = '" .$sucdanh1. "',
`type` = '1'
");
} else {
header("Location: /boss/$id");
}
}
if ($user_id == $areanonline['nguoichoi2']) {
if ($user_id == $luotchoi) {
mysql_query("UPDATE `boss` SET `luotdi`='".$luotchoi."',`time`='".time()."' WHERE `id`='".$id."'");
echo '<div class="menu">Bạn đã '.$danh[$rand].' '.$boss[tenboss].'  mất '.$sucdanh2.' hp.</div>';
mysql_query("UPDATE `boss_chien_arena` SET `hp`= `hp`-'{$sucdanh2}'WHERE `phong`='".$ttboss[phong]."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi2']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`cachdanh` = '" .$danh[$rand]. "',
`sodanh` = '" .$sucdanh2. "',
`type` = '1'
");
} else {
header("Location: /boss/$id");
}
}
if ($user_id == $areanonline['nguoichoi3']) {
if ($user_id == $luotchoi) {
mysql_query("UPDATE `boss` SET `luotdi`='".$luotchoi."',`time`='".time()."' WHERE `id`='".$id."'");
echo '<div class="menu">Bạn đã '.$danh[$rand].' '.$boss[tenboss].'  mất '.$sucdanh3.' hp.</div>';
mysql_query("UPDATE `boss_chien_arena` SET `hp`= `hp`-'{$sucdanh3}'WHERE `phong`='".$ttboss[phong]."'");
mysql_query("INSERT INTO `boss_noidung` SET
`nguoidanh1` = '".$areanonline['nguoichoi3']."',
`phong` = '".$id."',
`time` = '" . time() . "',
`cachdanh` = '" .$danh[$rand]. "',
`sodanh` = '" .$sucdanh3. "',
`type` = '1'
");
} else {
header("Location: /boss/$id");
}
}
echo'</div>';
}
}
if ($user_id == $luotchoi) {
echo''.(isset($_POST['danh']) ? '':'<div class="menu list-top"><form method="post"><input type="submit" name="danh" value="Đánh" /></form></div>').'';
}
}
?>