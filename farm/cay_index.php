<?php
$res = mysql_query("SELECT * FROM `fermer_name` WHERE `cena` > '0' LIMIT 20");
while ($post = mysql_fetch_array($res)){
$a="<a href='/farm/caycoi.php?id=$post[id]'>[ <b>".htmlspecialchars($post['name'])."</b> ]</a>";
$lev="Giá: $post[cena] xu<br/>";
echo'<div class="menu list-bottom">';
echo'<table cellpadding="0" cellspacing="0"><tr><td style="width: 40px;">';
echo'<img id="raucu" src="icon/item/'.$post['id'].'.png" alt="*"/>';
echo'&#160;</td><td style="width: 500px;">';
echo''.$a.'<br/>';
echo''.$lev.'';
echo'</td></tr></table></div>';
}
?>
