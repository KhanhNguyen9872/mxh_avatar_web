<?php
$loaixu = $_POST['tien'];
if($tongodat==5){
$xu=7050;
$vnd=7;
}else if($tongodat==6){
$xu=10800;
$vnd=10;
}else if($tongodat==7){
$xu=14700;
$vnd=14;
}else if($tongodat==8){
$xu=19200;
$vnd=19;
}else if($tongodat==9){
$xu=24300;
$vnd=24;
}else if($tongodat==10){
$xu=30000;
$vnd=30;
}else if($tongodat==11){
$xu=36300;
$vnd=36;
}else if($tongodat==12){
$xu=43200;
$vnd=43;
}else if($tongodat==13){
$xu=50700;
$vnd=50;
}else if($tongodat==14){
$xu=58800;
$vnd=58;
}else if($tongodat==15){
$xu=67500;
$vnd=67;
}else if($tongodat==16){
$xu=76800;
$vnd=76;
}else if($tongodat==17){
$xu=86700;
$vnd=86;
}else if($tongodat==18){
$xu=97200;
$vnd=97;
}else if($tongodat==19){
$xu=108300;
$vnd=108;
}else if($tongodat==20){
$xu=120000;
$vnd=120;
}else if($tongodat==21){
$xu=132300;
$vnd=132;
}else if($tongodat==22){
$xu=145200;
$vnd=145;
}else if($tongodat==23){
$xu=158700;
$vnd=158;
}else if($tongodat==24){
$xu=172800;
$vnd=172;
}else if($tongodat==25){
$xu=187500;
$vnd=187;
}else if($tongodat==26){
$xu=202800;
$vnd=202;
}else if($tongodat==27){
$xu=218700;
$vnd=218;
}else if($tongodat==28){
$xu=235200;
$vnd=235;
}else if($tongodat==29){
$xu=252300;
$vnd=252;
}else if($tongodat==30){
$xu=270000;
$vnd=270;
}else if($tongodat==31){
$xu=288300;
$vnd=288;
}else if($tongodat==32){
$xu=307200;
$vnd=307;
}else if($tongodat==33){
$xu=326700;
$vnd=326;
}else if($tongodat==34){
$xu=346800;
$vnd=346;
}else if($tongodat==35){
$xu=367500;
$vnd=367;
}else if($tongodat==36){
$xu=388800;
$vnd=388;
}else if($tongodat==37){
$xu=410700;
$vnd=410;
}else if($tongodat==38){
$xu=433200;
$vnd=433;
}else if($tongodat==39){
$xu=456300;
$vnd=456;
}else if($tongodat==40){
$xu=480000;
$vnd=480;
}else if($tongodat==41){
$xu=504300;
$vnd=504;
}else if($tongodat==42){
$xu=529200;
$vnd=529;
}else if($tongodat==43){
$xu=554700;
$vnd=554;
}else if($tongodat==44){
$xu=580800;
$vnd=580;
}else if($tongodat==45){
$xu=607500;
$vnd=607;
}else if($tongodat==46){
$xu=634800;
$vnd=634;
}else if($tongodat==47){
$xu=662700;
$vnd=662;
}else if($tongodat==48){
$xu=691200;
$vnd=691;
}else if($tongodat==49){
$xu=721300;
$vnd=721;
}else if($tongodat==50){
$xu=752500;
$vnd=752;
}else if($tongodat==51){
$xu=784700;
$vnd=784;
}else if($tongodat==52){
$xu=817900;
$vnd=817;
}else if($tongodat==53){
$xu=851200;
$vnd=851;
}else if($tongodat==54){
$xu=886300;
$vnd=886;
}else if($tongodat==55){
$xu=992500;
$vnd=992;
}else if($tongodat==56){
$xu=959700;
$vnd=959;
}else if($tongodat==57){
$xu=997800;
$vnd=997;
}else if($tongodat==58){
$xu=1036200;
$vnd=1036;
}else if($tongodat==59){
$xu=1076300;
$vnd=1076;
}

if (isset($_POST['muadat'])) {



//////////////
if($loaixu == 'xu'){

if ($datauser['xu']>=$xu) {
mysql_query("UPDATE `users` SET `xu` = `xu`- $xu WHERE `id` = $user_id LIMIT 1");
mysql_query("INSERT INTO `fermer_gr` (`semen`, `id_user`) VALUES  ( '0', '".$user_id."') ");
header('Location: /farm/');
} else {
echo '<div class="omenu">Bạn chưa đủ số Xu để mua đất!</div>';
}


}

if($loaixu == 'vnd'){


if ($datauser['vnd']>=$vnd) {
mysql_query("UPDATE `users` SET `vnd` = `vnd`- $vnd WHERE `id` = $user_id LIMIT 1");
mysql_query("INSERT INTO `fermer_gr` (`semen`, `id_user`) VALUES  ( '0', '".$user_id."') ");
header('Location: /farm/');
} else {
echo '<div class="omenu">Bạn chưa đủ số lượng để mua đất!</div>';
}




}



/////////////
}
if(isset($_GET['muadat'])){
if ($tongodat <= 60) {
echo'</div><div class="out-tab space">';

echo'<div class="danhsach bold green">Mua đất</div>';
echo '<div class="danhsach phancach">';
echo "Giá để mở ô đất thứ <b class='green'>".($tongodat+1)."</b> là <b>".$xu."</b> xu hoặc <b class='green'>".$vnd."</b> Lượng !";
echo "<br/><form method='post'>\n";

echo'<select name="tien">
<option value = "xu">'.$xu.' Xu</option>
<option value = "vnd">'.$vnd.' Lượng</option>
</select><br/>';
echo "<input type='submit' name='muadat' value='Mở' />";
echo'</div>';
}else {

echo'</div><div class="out-tab space">';

echo'<div class="danhsach bold green">Mua đất</div>';
echo '<div class="danhsach phancach">';
echo "Bạn đã hết lượt mua đất!";
echo'</div>';

}
}
?>