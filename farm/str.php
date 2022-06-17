<?php
if($datauser['fermer_oput']>=0 && $datauser['fermer_oput']<=100){$level=1;}
elseif($datauser['fermer_oput']>=101 && $datauser['fermer_oput']<=300){$level=2;$need=301;}
elseif($datauser['fermer_oput']>=301 && $datauser['fermer_oput']<=800){$level=3;$need=801;}
elseif($datauser['fermer_oput']>=801 && $datauser['fermer_oput']<=1300){$level=4;$need=1301;}
elseif($datauser['fermer_oput']>=1301 && $datauser['fermer_oput']<=2000){$level=5;$need=2001;}
elseif($datauser['fermer_oput']>=2001 && $datauser['fermer_oput']<=3000){$level=6;$need=3001;}
elseif($datauser['fermer_oput']>=3001 && $datauser['fermer_oput']<=4500){$level=7;$need=4501;}
elseif($datauser['fermer_oput']>=4501 && $datauser['fermer_oput']<=6000){$level=8;$need=6001;}
elseif($datauser['fermer_oput']>=6001 && $datauser['fermer_oput']<=9000){$level=9;$need=9001;}
elseif($datauser['fermer_oput']>=9001 && $datauser['fermer_oput']<=12000){$level=10;$need=12001;}
elseif($datauser['fermer_oput']>=12001 && $datauser['fermer_oput']<=16000){$level=11;}
if($datauser['level']<$level){
mysql_query("UPDATE `users` SET `level` = '".$level."', `fermer_oput` = '0', `farm_oput_need` = $need WHERE `id` = $user_id LIMIT 1");
}

$i = mysql_query("select * from `fermer_gr` WHERE `kol` = '0' ");
while ($ii = mysql_fetch_array($i)){
$semenk=mysql_fetch_array(mysql_query("select * from `fermer_name` WHERE  `id` = '$ii[semen]'  LIMIT 1"));
$pt=rand($semenk['rand1'],$semenk['rand2']);
if($ii['woter']==0)$pt=floor($pt/2);
mysql_query("UPDATE `fermer_gr` SET `kol` = $pt WHERE `id` = '$ii[id]' LIMIT 1");
}


?>
