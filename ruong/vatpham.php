<?php
$dis=mysql_num_rows(mysql_query("SELECT * FROM `vatpham` WHERE  `user_id`='".$user_id."' AND `soluong`!='0'"));
if ($dis>0) {
echo '<div class="phdr">Rương vật phẩm</div>';
$vatpham=mysql_query("SELECT * FROM `vatpham` WHERE `user_id`='".$user_id."' AND `soluong`!='0'");
echo '<div class="lucifer"><table>';
while($show=mysql_fetch_array($vatpham)) {
$item=mysql_fetch_array(mysql_query("SELECT * FROM `shopvatpham` WHERE `id`='".$show['id_shop']."'"));
echo '<tr>
<td><img src="/images/vatpham/'.$item['id'].'.png"></td>
<td>'.(!empty($item['query'])?'<a href="dung.php?id='.$show['id'].'"><b><font color="red">Sử dụng</font></b></a>':'').'<br/><b><font color="blue">'.$item['tenvatpham'].'</font></b>'.($show['timesudung']!=0?' - <font color="blue">Còn: '.thoigiantinh(floor($show['timesudung'])).'</font>':'').'<br/>Số lượng: <font color="green">'.$show['soluong'].'</font></td>
</tr>';
}
echo '</table>';
echo '</div>';
}
?>