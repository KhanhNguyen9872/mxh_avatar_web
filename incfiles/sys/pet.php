 <?php
$pet = mysql_fetch_array(mysql_query("SELECT * FROM `ketquapet` ORDER BY `id` DESC LIMIT 1"));
if ($pet[time]<time()) {
$kqpet = $pet['vitri1'];
$abc=mysql_query("SELECT * FROM `cuocpet` WHERE `lan`='".$pet['id']."'");
while($mem=mysql_fetch_array($abc)) {
if ($mem['pet']==$kqpet) {
$congtien=$mem['tien']*3;
mysql_query("UPDATE `users` SET `xu`=`xu`+'".$congtien."' WHERE `id`='".$mem['user_id']."'");
}
}
$win = rand(1,7);
switch ($win) {
case 1:
$next = rand(1,6);
if ($next == 1) {
$vt2 = 7;
$vt3 = 5;
$vt4 = 2;
$vt5 = 4;
$vt6 = 3;
$vt7 = 6;
} else if ($next == 2) {
$vt2 = 4;
$vt3 = 7;
$vt4 = 2;
$vt5 = 5;
$vt6 = 3;
$vt7 = 6;
} else if ($next == 3) {
$vt2 = 6;
$vt3 = 7;
$vt4 = 4;
$vt5 = 2;
$vt6 = 3;
$vt7 = 5;
} else if ($next == 4) {
$vt2 = 2;
$vt3 = 4;
$vt4 = 7;
$vt5 = 3;
$vt6 = 5;
$vt7 = 6;
} else if ($next == 5) {
$vt2 = 3;
$vt3 = 2;
$vt4 = 5;
$vt5 = 4;
$vt6 = 7;
$vt7 = 6;
} else if ($next == 6) {
$vt2 = 5;
$vt3 = 2;
$vt4 = 6;
$vt5 = 4;
$vt6 = 3;
$vt7 = 7;
}
break;
$next = rand(1,6);
if ($next == 1) {
$vt2 = 7;
$vt3 = 5;
$vt4 = 2;
$vt5 = 4;
$vt6 = 3;
$vt7 = 6;
} else if ($next == 2) {
$vt2 = 4;
$vt3 = 7;
$vt4 = 3;
$vt5 = 5;
$vt6 = 3;
$vt7 = 6;
} else if ($next == 3) {
$vt2 = 6;
$vt3 = 3;
$vt4 = 4;
$vt5 = 2;
$vt6 = 3;
$vt7 = 5;
} else if ($next == 4) {
$vt2 = 2;
$vt3 = 4;
$vt4 = 7;
$vt5 = 3;
$vt6 = 5;
$vt7 = 6;
} else if ($next == 5) {
$vt2 = 3;
$vt3 = 2;
$vt4 = 5;
$vt5 = 4;
$vt6 = 7;
$vt7 = 6;
} else if ($next == 6) {
$vt2 = 5;
$vt3 = 2;
$vt4 = 6;
$vt5 = 4;
$vt6 = 3;
$vt7 = 7;
}
case 2:
$next = rand(1,6);
if ($next == 1) {
$vt2 = 1;
$vt3 = 3;
$vt4 = 4;
$vt5 = 5;
$vt6 = 6;
$vt7 = 7;
} else if ($next == 2) {
$vt2 = 3;
$vt3 = 1;
$vt4 = 7;
$vt5 = 5;
$vt6 = 4;
$vt7 = 6;
} else if ($next == 3) {
$vt2 = 4;
$vt3 = 7;
$vt4 = 6;
$vt5 = 1;
$vt6 = 3;
$vt7 = 5;
} else if ($next == 4) {
$vt2 = 5;
$vt3 = 4;
$vt4 = 7;
$vt5 = 1;
$vt6 = 5;
$vt7 = 6;
} else if ($next == 5) {
$vt2 = 6;
$vt3 = 1;
$vt4 = 5;
$vt5 = 4;
$vt6 = 7;
$vt7 = 3;
} else if ($next == 6) {
$vt2 = 7;
$vt3 = 1;
$vt4 = 6;
$vt5 = 4;
$vt6 = 3;
$vt7 = 7;
}
break;
case 3:
$next = rand(1,6);
if ($next == 1) {
$vt2 = 1;
$vt3 = 2;
$vt4 = 4;
$vt5 = 5;
$vt6 = 6;
$vt7 = 7;
} else if ($next == 2) {
$vt2 = 2;
$vt3 = 7;
$vt4 = 4;
$vt5 = 5;
$vt6 = 1;
$vt7 = 6;
} else if ($next == 3) {
$vt2 = 4;
$vt3 = 1;
$vt4 = 6;
$vt5 = 2;
$vt6 = 7;
$vt7 = 5;
} else if ($next == 4) {
$vt2 = 5;
$vt3 = 4;
$vt4 = 7;
$vt5 = 1;
$vt6 = 2;
$vt7 = 6;
} else if ($next == 5) {
$vt2 = 6;
$vt3 = 2;
$vt4 = 5;
$vt5 = 4;
$vt6 = 7;
$vt7 = 1;
} else if ($next == 6) {
$vt2 = 7;
$vt3 = 2;
$vt4 = 6;
$vt5 = 4;
$vt6 = 1;
$vt7 = 5;
}
break;
case 4:
$next = rand(1,6);
if ($next == 1) {
$vt2 = 1;
$vt3 = 2;
$vt4 = 3;
$vt5 = 5;
$vt6 = 6;
$vt7 = 7;
} else if ($next == 2) {
$vt2 = 2;
$vt3 = 3;
$vt4 = 1;
$vt5 = 4;
$vt6 = 7;
$vt7 = 6;
} else if ($next == 3) {
$vt2 = 3;
$vt3 = 7;
$vt4 = 4;
$vt5 = 2;
$vt6 = 1;
$vt7 = 5;
} else if ($next == 4) {
$vt2 = 5;
$vt3 = 1;
$vt4 = 7;
$vt5 = 3;
$vt6 = 2;
$vt7 = 6;
} else if ($next == 5) {
$vt2 = 6;
$vt3 = 2;
$vt4 = 5;
$vt5 = 1;
$vt6 = 7;
$vt7 = 6;
} else if ($next == 6) {
$vt2 = 7;
$vt3 = 2;
$vt4 = 6;
$vt5 = 1;
$vt6 = 3;
$vt7 = 5;
}
break;
case 5:
$next = rand(1,6);
if ($next == 1) {
$vt2 = 1;
$vt3 = 2;
$vt4 = 3;
$vt5 = 4;
$vt6 = 6;
$vt7 = 7;
} else if ($next == 2) {
$vt2 = 2;
$vt3 = 7;
$vt4 = 3;
$vt5 = 4;
$vt6 = 1;
$vt7 = 6;
} else if ($next == 3) {
$vt2 = 3;
$vt3 = 1;
$vt4 = 4;
$vt5 = 2;
$vt6 = 3;
$vt7 = 7;
} else if ($next == 4) {
$vt2 = 4;
$vt3 = 1;
$vt4 = 7;
$vt5 = 3;
$vt6 = 4;
$vt7 = 6;
} else if ($next == 5) {
$vt2 = 6;
$vt3 = 2;
$vt4 = 4;
$vt5 = 1;
$vt6 = 7;
$vt7 = 7;
} else if ($next == 6) {
$vt2 = 7;
$vt3 = 2;
$vt4 = 6;
$vt5 = 4;
$vt6 = 3;
$vt7 = 1;
}
break;
case 6:
$next = rand(1,6);
if ($next == 1) {
$vt2 = 1;
$vt3 = 2;
$vt4 = 3;
$vt5 = 4;
$vt6 = 5;
$vt7 = 7;
} else if ($next == 2) {
$vt2 = 2;
$vt3 = 7;
$vt4 = 3;
$vt5 = 5;
$vt6 = 3;
$vt7 = 1;
} else if ($next == 3) {
$vt2 = 3;
$vt3 = 1;
$vt4 = 4;
$vt5 = 2;
$vt6 = 3;
$vt7 = 5;
} else if ($next == 4) {
$vt2 = 4;
$vt3 = 2;
$vt4 = 7;
$vt5 = 3;
$vt6 = 5;
$vt7 = 1;
} else if ($next == 5) {
$vt2 = 5;
$vt3 = 2;
$vt4 = 1;
$vt5 = 4;
$vt6 = 7;
$vt7 = 6;
} else if ($next == 6) {
$vt2 = 7;
$vt3 = 2;
$vt4 = 6;
$vt5 = 4;
$vt6 = 3;
$vt7 = 1;
}
break;
case 7:
$next = rand(1,6);
if ($next == 1) {
$vt2 = 1;
$vt3 = 2;
$vt4 = 3;
$vt5 = 4;
$vt6 = 5;
$vt7 = 6;
} else if ($next == 2) {
$vt2 = 2;
$vt3 = 5;
$vt4 = 3;
$vt5 = 1;
$vt6 = 4;
$vt7 = 6;
} else if ($next == 3) {
$vt2 = 3;
$vt3 = 1;
$vt4 = 4;
$vt5 = 2;
$vt6 = 3;
$vt7 = 5;
} else if ($next == 4) {
$vt2 = 4;
$vt3 = 1;
$vt4 = 7;
$vt5 = 3;
$vt6 = 5;
$vt7 = 6;
} else if ($next == 5) {
$vt2 = 5;
$vt3 = 2;
$vt4 = 1;
$vt5 = 4;
$vt6 = 7;
$vt7 = 6;
} else if ($next == 6) {
$vt2 = 6;
$vt3 = 2;
$vt4 = 5;
$vt5 = 4;
$vt6 = 3;
$vt7 = 1;
}
break;
}
$timepet=time()+180;
mysql_query("INSERT INTO `ketquapet` SET
`vitri1`='".$win."',
`vitri2`='".$vt2."',
`vitri3`='".$vt3."',
`vitri4`='".$vt4."',
`vitri5`='".$vt5."',
`vitri6`='".$vt6."',
`vitri7`='".$vt7."',
`time`='".$timepet."'
");
}
?>