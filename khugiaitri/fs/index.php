<?php
define('_IN_JOHNCMS', 1);
require ('../../incfiles/core.php');
$textl = 'Tạo F.S';
$mota = 'Tạo chữ kí đẹp và kute theo ý bạn hãy tạo cho riêng mình chữ kí thật đẹp nhé !';
require ('../../incfiles/head.php');
echo '<form action="img.php" method="get">';
echo '<div class="phdr"><b>Tạo chữ kí Fan Sign, Tạo FS Online</b></div><div class="lucifer">';
echo '<div class="hdr"><b>- B.1: Chọn mẫu ảnh</b></div><br/>';
echo '<div class="menu"><table cellpadding="3" cellspacing="3" width="100%">
<tr>
<td align="center"><img src="img/demo/1.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/2.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/3.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/28.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
</tr>
<tr>
<td align="center"><input name="color" type="radio" value="1" /></td>
<td align="center"><input name="color" type="radio" value="2" /></td>
<td align="center"><input name="color" type="radio" value="3" /></td>
<td align="center"><input name="color" type="radio" value="28" /></td>
</tr>
<tr>
<td align="center"><img src="img/demo/5.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/6.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/7.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/8.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
</tr>
<tr>
<td align="center"><input name="color" type="radio" value="5" /></td>
<td align="center"><input name="color" type="radio" value="6" /></td>
<td align="center"><input name="color" type="radio" value="7" /></td>
<td align="center"><input name="color" type="radio" value="8" /></td>
</tr>
<tr>
<td align="center"><img src="img/demo/9.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/10.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/26.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/12.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
</tr>
<tr>
<td align="center"><input name="color" type="radio" value="9" /></td>
<td align="center"><input name="color" type="radio" value="10" /></td>
<td align="center"><input name="color" type="radio" value="26" /></td>
<td align="center"><input name="color" type="radio" value="12" /></td>
</tr>
<tr>
<td align="center"><img src="img/demo/13.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/14.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/15.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/25.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /><font color="red">New</font></td>
</tr>
<tr>
<td align="center"><input name="color" type="radio" value="13" /></td>
<td align="center"><input name="color" type="radio" value="14" /></td>
<td align="center"><input name="color" type="radio" value="15" /></td>
<td align="center"><input name="color" type="radio" value="25" /></td>
</tr><tr>
<td align="center"><img src="img/demo/17.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/18.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/19.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/20.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /><font color="red">New</font></td>
</tr>
<tr>
<td align="center"><input name="color" type="radio" value="17" /></td>
<td align="center"><input name="color" type="radio" value="18" /></td>
<td align="center"><input name="color" type="radio" value="19" /></td>
<td align="center"><input name="color" type="radio" value="20" /></td>
</tr>
<tr>
<td align="center"><img src="img/demo/21.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/22.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/23.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /></td>
<td align="center"><img src="img/demo/24.jpg" width="60" height="60" alt="Avatar Fan Sign" title="Chọn em đi anh" /><font color="red">New</font></td>
</tr>
<tr>
<td align="center"><input name="color" type="radio" value="21" /></td>
<td align="center"><input name="color" type="radio" value="22" /></td>
<td align="center"><input name="color" type="radio" value="23" /></td>
<td align="center"><input name="color" type="radio" value="24" /></td>
</tr>
<tr>
</tr></table></div>';
echo '<div class="hdr"><b>- B.2: Nhập thông tin!</b></div><div class="menu"><table cellpadding="3" cellspacing="3" width="100%">
<tr>
<td align="left">';
echo '- Nội dung:<br/><input type="text" name="text" value="ID Thiên Ân"/><br/>- Cỡ chữ:<br/><input type="text" name="size" value="28"/></br>- Chọn kiểu chữ: <select name="font">
<option value="agoldfac">1</option>
<option value="antique">2</option>
<option value="brush">3</option>
<option value="corsiva">4</option>
<option value="hopo">5</option>
<option value="isadora">6</option>
<option value="kids">7</option>
<option value="kunmedii">8</option>
<option value="lydiani">9</option>
<option value="slogan">slogan</option>
</select>
<br/>- Màu Đỏ: (0 - 255)<br/><input type="text" name="colo" value="50"/><br/>- Màu Xanh Lá Cây: (0 - 255)<br/><input type="text" name="color1" value="100"/><br/>- Màu Xanh Da Trời: (0 - 255)<br/><input type="text" name="color2" value="100"/>';
echo '<br/><input type="submit" name="sub" value="Xem"/></form>';
echo '<br/>- Ba màu đỏ, xanh lá cây và xanh da trời tiếng anh là Red, Green, Blue là hệ màu RGB, từ ba màu cơ bản này ta có thể pha trộn ra nhiều màu, tính từ 0 đến 255 cho mỗi màu! Để biết thêm truy cập Google.';
echo '</div></td></tr></table>';
echo '</div><div><div class="phdr"><b>Tạo chữ kí Fan Sign, Tạo FS Online</b></div><div class="gmenu"><center><img src="https://video.bts47.com/khugiaitri/fs/img.php?color=17&text=ID Thiên Ân&size=28&font=agoldfac&colo=50&color1=100&color2=100&sub=Xem" alt="8vui.top"/></center></div>';
require ('../../incfiles/end.php');
?>