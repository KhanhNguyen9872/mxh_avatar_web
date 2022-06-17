

<?php
	if (empty($datauser['password_2'])) {
		echo '<div class="tmn">Xin mời các bạn vào thiết lập <a href="/users/password_2.php"><b style="color:red">Mật khẩu cấp 2</b></a></div>';
	} else {
		$_SESSION['password_2'] = isset($_SESSION['password_2']) ? $_SESSION['password_2'] : '';
		if (empty($_SESSION['password_2']) || $_SESSION['password_2'] != $datauser['password_2']) {
			//$_SESSION['count_false'] = 0;
			echo '<div class="menu">';
			/*if ($_SESSION['count_false'] >= 10) {
				//xử lý check
			}*/
			if (isset($_POST['xacthuc'])) {
				$password_2 = functions::checkout($_POST['password_2']);
				$password_2 = md5(md5($password_2));
				if (empty($password_2) || $password_2 != $datauser['password_2']) {
					//$_SESSION['count_false']++;
					echo '<div class="rmenu">Sai mật khẩu cấp 2</div>';
				} else {
					$_SESSION['password_2'] = $password_2;
					header('Location: /index.php');
					exit;
				}
			}
			
			echo'</div><style>
			.mk2{background-image:url("https://i.pinimg.com/originals/1d/15/6b/1d156ba96aad977429de6ea678ae1228.gif")};
			</style><div>';
			
			echo '<div class="lucifer"><center><img src="https://nhandaovadoisong.com.vn/wp-content/uploads/2019/05/hinh-nen-dien-thoai-de-thuong-42.gif" width="30%"><form method="post"><input type="password" name="password_2" placeholder="Nhập mật khẩu cấp 2"> <input name="xacthuc" type="submit" value="Xác thực"></form><br><br><div>
			 ';
			include_once('incfiles/end.php');
			exit;
		}
	}
	
?>