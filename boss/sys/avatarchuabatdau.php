<?php
if($areanonline['wait'] == 0) {
echo'<div class="menu list-bottom list-top">';
$ban = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline[user_id]."'"));
$phantramban = floor(($datauser['hp']*100)/$datauser['hpfull']);
$thongtinsucmanh = $datauser['sucmanh'];
echo'<img src="'.$home.'/avatar/'.$areanonline[user_id].'.png" alt="" class="avatar_vina"/>
<b>'.nick($areanonline[user_id]).'</b> <span style="font-size:12px;color:green;">Chủ Phòng</span><br>
HP '.$datauser['hp'].' <span style="font-size:12px;color:green;">('.$phantramban.'%)</span><br/>
SM '.$thongtinsucmanh.'';
echo '</div>';

if (!empty($areanonline['nguoichoi'])) {
echo'<div class="menu list-bottom">';
$nguoichoi = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline[nguoichoi]."'"));
$thongtinsucmanhnguoichoi = $nguoichoi['sucmanh'];
$phantramnguoichoi = floor(($nguoichoi['hp']*100)/$nguoichoi['hpfull']);
echo'<img src="'.$home.'/avatar/'.$areanonline[nguoichoi].'.png" alt="" class="avatar_vina"/>
<b>'.nick($areanonline[nguoichoi]).'</b> <span style="font-size:12px;color:green;">Sẵn Sàng</span>';
echo' '.($areanonline['user_id']==$user_id && $areanonline['wait']!=3 && $areanonline['wait']!=4 ? ' [<a href="/boss/'.$id.'/kick/1" style="color:red;">Đuổi</a>]':'').'';
echo'<br>
HP '.$nguoichoi['hp'].' <span style="font-size:12px;color:green;">('.$phantramnguoichoi.'%)</span><br/>
SM '.$thongtinsucmanhnguoichoi.'';
echo '</div>';
}

if (!empty($areanonline['nguoichoi2'])) {
echo'<div class="menu list-bottom">';
$nguoichoi2 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline[nguoichoi2]."'"));
$thongtinsucmanhnguoichoi2 = $nguoichoi2['sucmanh'];
$phantramnguoichoi2 = floor(($nguoichoi2['hp']*100)/$nguoichoi2['hpfull']);
echo'<img src="'.$home.'/avatar/'.$areanonline[nguoichoi2].'.png" alt="" class="avatar_vina"/>
<b>'.nick($areanonline[nguoichoi2]).'</b> <span style="font-size:12px;color:green;">Sẵn Sàng</span>';
echo''.($areanonline['user_id']==$user_id && $areanonline['wait']!=3 && $areanonline['wait']!=4 ? ' [<a href="/boss/'.$id.'/kick/2" style="color:red;">Đuổi</a>]':'').'';
echo'<br>
HP '.$nguoichoi2['hp'].' <span style="font-size:12px;color:green;">('.$phantramnguoichoi2.'%)</span><br/>
SM '.$thongtinsucmanhnguoichoi2.'';
echo '</div>';
}

if (!empty($areanonline['nguoichoi3'])) {
echo'<div class="menu list-bottom">';
$nguoichoi3 = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$areanonline[nguoichoi3]."'"));
$thongtinsucmanhnguoichoi3 = $nguoichoi3['sucmanh'];
$phantramnguoichoi3 = floor(($nguoichoi3['hp']*100)/$nguoichoi3['hpfull']);
echo'<img src="'.$home.'/avatar/'.$areanonline[nguoichoi3].'.png" alt="" class="avatar_vina"/>
<b>'.nick($areanonline[nguoichoi3]).'</b> <span style="font-size:12px;color:green;">Sẵn Sàng</span>';
echo''.($areanonline['user_id']==$user_id && $areanonline['wait']!=3 && $areanonline['wait']!=4 ? ' [<a href="/boss/'.$id.'/kick/3" style="color:red;">Đuổi</a>]':'').'';
echo'<br>
HP '.$nguoichoi3['hp'].' <span style="font-size:12px;color:green;">('.$phantramnguoichoi3.'%)</span><br/>
SM '.$thongtinsucmanhnguoichoi3.'';
echo '</div>';
}
}
?>