<?php
/* 
Code pokemon được viết bởi Châu Huỳnh
Vui Lòng Để Bản Quyền Nếu Bạn Là Người Có Học
Site : DanChoiViet.Me
*/
define('_IN_JOHNCMS',1);
$rootpath ='../../';
include'../incfiles/core.php';
include'../incfiles/head.php';
if($datauser['id']>1){
echo'OH NO';
include'../incfiles/end.php';
exit;
}
echo'<div class="da"><div class="lucifer"><form action=""method="post">
Tên : <input type="text"name="name"><br/>
Sức Mạnh : <input type="text"name="sm"><br/>
HP : <input type="text"name="hp"><br/>
Giá : <input type="text"name="gia"><br/>
Link Ảnh : <input type="text"name="img"><br/>
IDPKM : <input type="text"name="id"><br/><input type="submit"name="submit"value="ADD"></form>
';
if(isset($_POST['submit'])){
mysql_query("INSERT INTO `pkmchien` SET 
`name`='".$_POST['name']."',
`img`='".$_POST['img']."',
`hp` = '".$_POST['hp']."',
`sm` = '".$_POST['sm']."',
`time` ='" . time() . "'
");
}
include'../incfiles/end.php';