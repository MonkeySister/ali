<?php
//开启session
session_start();
if(empty($_SESSION['id'])){
	echo '您尚未登录，请登录后使用！';
	header("refresh:2;url=/admin/login.html");
	die();
}
?>