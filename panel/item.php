<?php
echo '<html><head><title>Tools Leech</title><meta charset="utf-8"></head><body>';
if (isset($_GET[ok])) {
$i=$_GET[batdau];
while($i<=$_GET[het]) {
/*
$file_path = 'http://trung.pw/images/'.$_GET[loai].'/'.$i.'.png';
$url = getimagesize($file_path);
$file_path_load = 'http://trung.pw/images/'.$_GET[loai].'/ken/n-'.$i.'.png';
$url_load = getimagesize($file_path_load);
if (is_array($url)&&is_array($url_load)) {
echo '<a href="http://trung.pw/images/'.$_GET[loai].'/'.$i.'.png"><img src="http://trung.pw/images/'.$_GET[loai].'/'.$i.'.png"></a>';
echo '<a href="http://trung.pw/images/'.$_GET[loai].'/ken/n-'.$i.'.png"><img src="http://trung.pw/images/'.$_GET[loai].'/ken/n-'.$i.'.png"></a>';
} else {
echo '<a href="http://trung.pw/images/'.$_GET[loai].'/'.$i.'.png"><img src="http://trung.pw/images/'.$_GET[loai].'/'.$i.'.png"></a>';
}
*/
if (file_get_contents('http://trung.pw/images/'.$_GET[loai].'/'.$i.'.png')) {
echo '<a href="http://vnteenviet.com/images/'.$_GET[loai].'/'.$i.'.png"><img src="http://vnteenviet.com/images/'.$_GET[loai].'/'.$i.'.png"></a>';
}
if (file_get_contents('http://trung.pw/images/'.$_GET[loai].'/'.$i.'.png')) {
echo '<a href="http://vnteenviet.com/images/'.$_GET[loai].'/'.$i.'.png"><img src="http://vnteenviet.com/images/'.$_GET[loai].'/'.$i.'.png"></a>';
}
echo '<br/>';
$i++;
}
}
echo '<form method="get">Từ:<input type="text" name="batdau" value="10" size="1" placeholder="1"> đến 
<input type="text" name="het" size="1" value="30" placeholder="???">
<select name="loai">
<option value="ao"> Áo</option>
<option value="quan"> Quần</option>
<option value="canh"> Cánh</option>
<option value="thucung"> Thú cưng</option>
<option value="matna"> Mặt nạ</option>
<option value="haoquang"> Hào quang</option>
<option value="kinh"> Kính</option>
<option value="toc"> Tóc</option>
<option value="mat"> Mắt</option>
<option value="matna"> Mặt nạ</option>
<option value="non"> Nón</option>
<option value="docamtay"> Đồ cầm tay</option>
</select>
<input type="submit" value="Leech" name="ok">
</form>';
echo '</body></html>';
?>