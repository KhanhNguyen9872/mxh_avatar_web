<?php
session_start();
$url=$_SERVER['HTTP_REFERER'];
if(isset($_POST['submit'])){
	$_SESSION['firewall'] = 'ok';
}
if (empty($url))
{
$_SESSION['firewall'] = 'no';
}
else
{
header('Location: '.$url.'');
}
exit;
?>