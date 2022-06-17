<?PHP
Define('_IN_JOHNCMS', 1);
Require('../incfiles/core.php');
$headmod = 'PK';
$textl = 'PK';
Require('../incfiles/head.php');
IF(!$user_id){
Header("Location: /");
Exit;
}
$time=time()+100;
mysql_query("UPDATE `users` SET `timepk`='".$time."' WHERE `id`='".$user_id."'");
Echo'<div class="box_forums"><br/><div class="homeforum"><div class="icon-home"><div class="home">Chiến trường</div></div></div></div><div class="phdr"><a href="bxh.php">Bảng xếp hạng</a></div>';
Echo'<div class="nenshop">';
switch($act){
case'del':
mysql_query("DELETE FROM `pk`");
echo'</div>';
break;
default:
$c=mysql_fetch_array(mysql_query("SELECT * FROM `pk` ORDER BY `id` DESC LIMIT 1"));
$h=time()-$c['time'];
IF($h<=300){
Echo'<center>'.bbcode::tags(functions::smileys(htmlspecialchars($c['text']))).'</center>';
}
Echo'</div><div class="nenda">';
$req=mysql_query("SELECT * FROM `users` WHERE `timepk`>'".time()."'");
while($pr=mysql_fetch_array($req)){
$name=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$pr[id]."'"));
$id=mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='3'"));
$hp=$id[hp]/$id[hpfull]*100;
$aa=rand(-200,200);$bb=rand(0,100);IF($name[id]==3){Echo''.($id[hp]<=0 ? '<script>alert("Hộp quà đã xuất hiện mau mau nhận quà nào!!");</script><a href="qua.php"><img src="/icon/quavip.png"></a>':'<link rel="stylesheet" href="game.css" type="text/css"/>'.$hp.'%<div id="exp" class="rate" style=" width:'.$hp.'%;"></div><a href="pk.php?id=3"><img src="images/boss.png" style="position:absolute;vertical-align:0px;margin:'.$aa.'px 0 0 '.$bb.'px;"></a>').'';}
Echo'<a href="pk.php?id='.$pr['id'].'"><label style="display: inline-block;text-align: center;">'.($name[hp]<=0 ? '<img src="/mod/kietsuc.png">':'<img src="/avatar/'.$pr[id].'.png">').'</label></a>';
}
unset($_SESSION['PK']);
Echo'</div><div class="nenda"></div><div class="nenda"></div>';
break;
}
echo'<div><div>';
Require('../incfiles/end.php');
?>