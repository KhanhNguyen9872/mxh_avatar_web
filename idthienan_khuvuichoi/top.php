<?PHP
Define('_IN_JOHNCMS', 1);
Require('../incfiles/core.php');
$headmod = 'PK';
$textl = 'PK';
Require('../incfiles/head.php');
IF($datauser['rights']<9){
Header("Location: /");
Exit;
}
Echo'<div class="box_forums"><br/><div class="homeforum"><div class="icon-home"><div class="home">Chiến trường</div></div></div></div><div class="phdr">Chiến trường</div>';
$s=$_POST['s'];
$u=$_POST['u'];
IF(Isset($_POST['top'])){
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$s."' WHERE `id_shop`='45' AND `user_id`='".$u."'");
mysql_query("UPDATE `vatpham` SET `soluong`=`soluong`+'".$s."' WHERE `id_shop`='46' AND `user_id`='".$u."'"); 
}
IF(Isset($_POST['reset'])){
mysql_query("UPDATE `users` SET `pk`='0'");
}
Echo'<form method="POST">SL:<input type="text" name="s"><br>ID:<input type="text" name="u"> <br><input type="submit" name="top" value="TOP"> <input type="submit" name="reset" value="RESET"></form>';
Require('../incfiles/end.php');
?>