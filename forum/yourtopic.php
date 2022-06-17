<?php
define('_IN_JOHNCMS', 1);
$headmod = 'users';
require ('../incfiles/core.php');
$lng_forum = core::load_lng('forum');
$textl = 'Bài viết của bạn';
require ('../incfiles/head.php');
echo '<div class="phdr"><b>Chủ đề của bạn</b></div>';
if($user_id)

{

	$total=mysql_result(mysql_query("select count(*) from forum where type='t' and user_id='$user_id';"),0);

	if($total > 0)

	{

		$i=0;

		$sql=mysql_query("select * from forum where type='t' and user_id='$user_id' order by time desc limit $start,$kmess;");

		while($za=mysql_fetch_array($sql))

		{

			echo $i % 2 ? '<div class="list1">' : '<div class="list2">';

			echo '» <a href="/forum/'.$za[id].'.html">' . bbcode::tags($za[text]) . '</a> <span style="font-size:11px;color:#777;">(' . functions::thoigian($za['time']) . ')</span>';
			echo '</div>';
++$i;
		}

	}

if ($total > $kmess) {

                    echo '<div class="topmenu">' . functions::display_pagination('yourtopic.php?', $start, $total, $kmess) . '</div>';

                } else {

                   

                }

}

else

{

	echo 'Truy cập thất bại';

}
require('../incfiles/end.php');

?>