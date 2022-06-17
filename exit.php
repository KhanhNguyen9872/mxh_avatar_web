<?php
session_start();
session_name('SESID');
session_destroy();
setcookie('cuid', '');
setcookie('cups', '');
header('Location: dangnhap.html');
?>