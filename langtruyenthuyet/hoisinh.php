<?PHP
$headmod = 'Làng cổ';
$textl = 'Làng cổ';
$req = mysql_query("SELECT * FROM `langtruyenthuyet_boss`");
while($res = mysql_fetch_assoc($req)){
if($datauser['level'] >= $res['lvboss'] || $datauser['level'] < $res['lvbossmax']){
if($res['hienthi'] == 0){
if(time() > $res['timebosschet'] + 60 ){
mysql_query("UPDATE `langtruyenthuyet_boss` SET `hienthi`='1'");
mysql_query("UPDATE `langtruyenthuyet_boss` SET `hp`=`hpfull`");
}
}
}
}
?>