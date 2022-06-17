                                                                 <?php
$gt=mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `gioithieu`='".$user_id."'"));
//Cột mốc 1 -- 10 người
if ($gt>=10) {
	$cotmoc=mysql_num_rows(mysql_query("SELECT * FROM `lichsuqua_gioithieu` WHERE `user_id`='".$user_id."' AND `cotmoc`='1' AND `nhan`='1'"));
	if (!$cotmoc) {
		$xu=500000; $vnd=5;
		mysql_query("UPDATE `users` SET `xu`=`xu`+'".$xu."',`vnd`=`vnd`+'".$vnd."' WHERE `id`='".$user_id."'"); //Quà tiền 
		$idshop=787; //->Thay id shop
		$quashop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$idshop."'"));
		mysql_query("INSERT INTO `khodo` SET 
		`user_id`='".$user_id."', 
		`id_shop`='".$idshop."',
		`id_loai`='".$quashop['id_loai']."',
		`loai`='".$quashop['loai']."',
		`tenvatpham`='".$quashop['tenvatpham']."'
		");
		mysql_query("INSERT INTO `lichsuqua_gioithieu` SET `user_id`='".$user_id."', `nhan`='1' , `cotmoc`='1'");
	}
}
//Cột mốc 2 -- 25 người
if ($gt>=25) {
	$cotmoc=mysql_num_rows(mysql_query("SELECT * FROM `lichsuqua_gioithieu` WHERE `user_id`='".$user_id."' AND `cotmoc`='2' AND `nhan`='1'"));
	if (!$cotmoc) {
		$xu=2000000; $vnd=10;
		mysql_query("UPDATE `users` SET `xu`=`xu`+'".$xu."',`vnd`=`vnd`+'".$vnd."' WHERE `id`='".$user_id."'"); //Quà tiền 
		$idshop=788; //->Thay id shop
		$quashop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$idshop."'"));
		mysql_query("INSERT INTO `khodo` SET `user_id`='".$user_id."', `id_shop`='".$idshop."',`id_loai`='".$quashop['id_loai']."',`loai`='".$quashop['loai']."',`tenvatpham`='".$quashop['tenvatpham']."'"); //quà item
		mysql_query("INSERT INTO `lichsuqua_gioithieu` SET `user_id`='".$user_id."', `nhan`='1' , `cotmoc`='2'");
	}
}
//Cột mốc 3 -- 50 người
if ($gt>=50) {
	$cotmoc=mysql_num_rows(mysql_query("SELECT * FROM `lichsuqua_gioithieu` WHERE `user_id`='".$user_id."' AND `cotmoc`='3' AND `nhan`='1'"));
	if (!$cotmoc) {
		$xu=5000000; $vnd=15;
		mysql_query("UPDATE `users` SET `xu`=`xu`+'".$xu."',`vnd`=`vnd`+'".$vnd."' WHERE `id`='".$user_id."'"); //Quà tiền 
		$idshop=789; //->Thay id shop
		$quashop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$idshop."'"));
		mysql_query("INSERT INTO `khodo` SET `user_id`='".$user_id."', `id_shop`='".$idshop."',`id_loai`='".$quashop['id_loai']."',`loai`='".$quashop['loai']."',`tenvatpham`='".$quashop['tenvatpham']."'"); //quà item
		mysql_query("INSERT INTO `lichsuqua_gioithieu` SET `user_id`='".$user_id."', `nhan`='1' , `cotmoc`='3'");
	}
}
//Cột mốc 4 -- 80 người
if ($gt>=80) {
	$cotmoc=mysql_num_rows(mysql_query("SELECT * FROM `lichsuqua_gioithieu` WHERE `user_id`='".$user_id."' AND `cotmoc`='4' AND `nhan`='1'"));
	if (!$cotmoc) {
		$xu=1000000; $vnd=15;
		mysql_query("UPDATE `users` SET `xu`=`xu`+'".$xu."',`vnd`=`vnd`+'".$vnd."' WHERE `id`='".$user_id."'"); //Quà tiền 
		$idshop=790; //->Thay id shop
		$quashop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$idshop."'"));
		mysql_query("INSERT INTO `khodo` SET `user_id`='".$user_id."', `id_shop`='".$idshop."',`id_loai`='".$quashop['id_loai']."',`loai`='".$quashop['loai']."',`tenvatpham`='".$quashop['tenvatpham']."'"); //quà item
		mysql_query("INSERT INTO `lichsuqua_gioithieu` SET `user_id`='".$user_id."', `nhan`='1' , `cotmoc`='4'");
	}
}
//Cột mốc 5 -- 100 người
if ($gt>=100) {
	$cotmoc=mysql_num_rows(mysql_query("SELECT * FROM `lichsuqua_gioithieu` WHERE `user_id`='".$user_id."' AND `cotmoc`='5' AND `nhan`='1'"));
	if (!$cotmoc) {
		$xu=20000000; $vnd=25;
		mysql_query("UPDATE `users` SET `xu`=`xu`+'".$xu."',`vnd`=`vnd`+'".$vnd."' WHERE `id`='".$user_id."'"); //Quà tiền 
		$idshop=791; //->Thay id shop
		$quashop=mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='".$idshop."'"));
		mysql_query("INSERT INTO `khodo` SET `user_id`='".$user_id."', `id_shop`='".$idshop."',`id_loai`='".$quashop['id_loai']."',`loai`='".$quashop['loai']."',`tenvatpham`='".$quashop['tenvatpham']."'"); //quà item
		mysql_query("INSERT INTO `lichsuqua_gioithieu` SET `user_id`='".$user_id."', `nhan`='1' , `cotmoc`='5'");
	}
}
?>                                                      
                            
                            
                            
                            