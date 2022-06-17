<?php

if($areanonline['wait'] == 3) {
echo'<div class="menu list-top">';
echo'<table cellpadding="0" cellspacing="0" style="width:100%;"><tbody><tr><td style="text-align:center;padding:4px;" width="48">';
echo''.($areanonline['win'] == 1 ? '<img src="/icon/cup.png" alt="icon"/> ':'').'<b>'.nick($areanonline['user_id']).'</b><br/>';
echo'<div class="menu">';
echo'<img src="'.$home.'/avatar/'.$areanonline['user_id'].'.png" alt="Avatar"/>';
echo'</div>';
if(!empty($areanonline['nguoichoi'])) {
echo'</td><td style="text-align:center;padding:4px;" width="48">';
echo''.($areanonline['win'] == 1 ? '<img src="/icon/cup.png" alt="icon"/> ':'').'<b>'.nick($areanonline['nguoichoi']).' </b><br/>';
echo'<div class="menu">';
echo'<img src="'.$home.'/avatar/'.$areanonline[nguoichoi].'.png" alt="Avatar"/>';
echo'</div>';
}
if(!empty($areanonline['nguoichoi2'])) {
echo'</td><td style="text-align:center;padding:4px;" width="48">';
echo''.($areanonline['win'] == 1 ? '<img src="/icon/cup.png" alt="icon"/> ':'').'<b>'.nick($areanonline['nguoichoi2']).'</b><br/>';
echo'<div class="menu">';
echo'<img src="'.$home.'/avatar/'.$areanonline[nguoichoi2].'.png" alt="Avatar"/>';
echo'</div>';
}
if(!empty($areanonline['nguoichoi3'])) {
echo'</td><td style="text-align:center;padding:4px;" width="48">';
echo''.($areanonline['win'] == 1 ? '<img src="/icon/cup.png" alt="icon"/> ':'').'<b>'.nick($areanonline['nguoichoi3']).'</b>';
echo'<div class="menu">';
echo'<img src="'.$home.'/avatar/'.$areanonline[nguoichoi3].'.png" alt="Avatar"/>';
echo'</div>';
}
echo'</td></tr></tbody></table>';
echo'</div>';
if($areanonline['win'] == 0) {
echo'<div class="menu">';
$nick = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['user_id']."'"));
$capnick = mysql_fetch_array(mysql_query("SELECT `level`,`chisolevel` FROM `users` WHERE `id`='".$areanonline['user_id']."'"));
$thongtinsucmanh = $nick['sucmanh'];
$phantramnick = floor(($nick['hp']*100)/$nick['hpfull']); 
if ($nick['hp'] <= '0') {
mysql_query("UPDATE `users` SET `hp` = '0'  WHERE `id` = '".$areanonline['user_id']."'");
mysql_query("UPDATE `users` SET `mat` = '100'  WHERE `id` = '".$areanonline['user_id']."' LIMIT 1");
}
echo'"'.nick($areanonline['user_id']).'" <span style="font-size:12px;color:green;">('.$capnick[level].'+'.$capnick[chisolevel].'%)</span>';
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> '.($nick['hp'] == 0 ? '<span style="font-size:12px;color:red;">Ngỏm</span>':'Máu: '.$nick['hp'].' <span style="font-size:12px;color:green;">('.$phantramnick.'%)</span>').'';
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> SM: '.$thongtinsucmanh.'';
echo'</div>';


if(!empty($areanonline['nguoichoi'])) {
echo'<div class="menu list-top">';
$nick1 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$capnick1 = mysql_fetch_array(mysql_query("SELECT `level`,`chisolevel` FROM `users` WHERE `id`='".$areanonline['nguoichoi']."'"));
$thongtinsucmanh1 = $nick1['sucmanh'];
$phantramnick1 = floor(($nick1['hp']*100)/$nick1['hpfull']); 
if ($nick1['hp'] < '-1') {
mysql_query("UPDATE `users` SET `hp` = '0'  WHERE `user_id` = '".$areanonline['nguoichoi']."'");
mysql_query("UPDATE `users` SET `mat` = '100'  WHERE `id` = '".$areanonline['nguoichoi']."' LIMIT 1");
} 
echo'"'.nick($areanonline['nguoichoi']).'" <span style="font-size:12px;color:green;">('.$capnick1[level].'+'.$capnick1[chisolevel].'%)</span>';
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> '.($nick1['hp'] == 0 ? '<span style="font-size:12px;color:red;">Ngỏm</span>':'Máu: '.$nick1['hp'].' <span style="font-size:12px;color:green;">('.$phantramnick1.'%)</span>').'';
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> SM: '.$thongtinsucmanh1.'';
echo'</div>';
}

if(!empty($areanonline['nguoichoi2'])) {
echo'<div class="menu list-top">';
$nick2 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi2']."'"));
$capnick2 = mysql_fetch_array(mysql_query("SELECT `level`,`chisolevel` FROM `users` WHERE `id`='".$areanonline['nguoichoi2']."'"));
$thongtinsucmanh2 = $nick2['sucmanh'];
$phantramnick2 = floor(($nick2['hp']*100)/$nick2['hpfull']); 
if ($nick2['hp'] <= '0') {
mysql_query("UPDATE `users` SET `hp` = '0'  WHERE `id` = '".$areanonline['nguoichoi2']."'");
mysql_query("UPDATE `users` SET `mat` = '100'  WHERE `id` = '".$areanonline['nguoichoi2']."' LIMIT 1");
}
echo'"'.nick($areanonline['nguoichoi2']).'" <span style="font-size:12px;color:green;">('.$capnick2[level].'+'.$capnick2[chisolevel].'%)</span>';
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> '.($nick2['hp'] == 0 ? '<span style="font-size:12px;color:red;">Ngỏm</span>':'Máu: '.$nick2['hp'].' <span style="font-size:12px;color:green;">('.$phantramnick2.'%)</span>').'';
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> SM: '.$thongtinsucmanh2.'';
echo'</div>';
}

if(!empty($areanonline['nguoichoi3'])) {
echo'<div class="menu list-top">';
$nick3 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline['nguoichoi3']."'"));
$capnick3 = mysql_fetch_array(mysql_query("SELECT `level`,`chisolevel` FROM `users` WHERE `id`='".$areanonline['nguoichoi3']."'"));
$thongtinsucmanh3 = $nick3['sucmanh'];
$phantramnick3 = floor(($nick3['hp']*100)/$nick3['hpfull']); 
if ($nick3['hp'] <= '0') {
mysql_query("UPDATE `users` SET `hp` = '0'  WHERE `id` = '".$areanonline['nguoichoi3']."'");
mysql_query("UPDATE `users` SET `mat` = '100'  WHERE `id` = '".$areanonline['nguoichoi3']."' LIMIT 1");
}
echo'"'.nick($areanonline['nguoichoi3']).'" <span style="font-size:12px;color:green;">('.$capnick3[level].'+'.$capnick3[chisolevel].'%)</span>';
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> '.($nick3['hp'] == 0 ? '<span style="font-size:12px;color:red;">Ngỏm</span>':'Máu: '.$nick3['hp'].' <span style="font-size:12px;color:green;">('.$phantramnick3.'%)</span>').'';
echo' <span style="font-size:11px;color:#e2e2e2;">|</span> SM: '.$thongtinsucmanh3.'';
echo'</div>';
}
}
if ($areanonline['user_id']==$user_id || $areanonline['nguoichoi']==$user_id || $areanonline['nguoichoi2']==$user_id || $areanonline['nguoichoi3']==$user_id) {
if($areanonline['win'] == 1 || $areanonline['win'] == 3) {
echo'<div class="menu list-top">';
if ($areanonline['user_id']==$user_id) {
echo'<a href="/boss/phong.php?id='.$id.'&newboss"><input type="button" value="Trận đấu mới" /></a>';
}
echo'<a href="/boss/phong.php?id='.$id.'&quit"><input type="button" value="Nghỉ trận" /></a>';
echo '</div>';
}
}
}
?>