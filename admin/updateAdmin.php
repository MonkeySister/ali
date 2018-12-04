<?php
//print_r($_POST);
$email = $_POST['email'];
$slug = $_POST['slug'];
$nickname = $_POST['nickname'];
$sign = $_POST['sign'];
$sql = "update ali_admin set admin_slug='$slug',admin_nickname='$nickname',admin_sign='$sign' 
					where admin_email='$email'";
include_once './include/mysqli.php';
$result = execSql($sql,'idu');
if($result){
	echo 1;
}else{
	echo 2;
}
?>