<?php
$email = $_POST['email'];
$sql = "select * from ali_admin where admin_email='$email'";
include_once './include/mysqli.php';
$result = execSql($sql,'One');
if(empty($result)){
	echo 2;
}else{
	echo $result['admin_pic'];
}
?>