<?php
//接收表单发来的数据
//print_r($_POST);
$id = $_POST['id'];
$email = $_POST['email'];
$nickname = $_POST['nickname'];
$tel = $_POST['tel'];
$gender = $_POST['gender'];
$slug = $_POST['slug'];
$state = $_POST['state'];
$sql = "UPDATE ali_admin set admin_email='$email',admin_nickname='$nickname',admin_tel='$tel',
				admin_gender='$gender',admin_slug='$slug',admin_state='$state' WHERE admin_id=$id";
include_once '../include/mysqli.php';
$result = execSql($sql,'idu');
if($result == 1){
	/*$sql = "SELECT * from ali_admin where admin_id=$id";
	$result_obj = execSql($sql,'One');
	print_r( json_encode($result_obj));*/
	echo 1;
}else{
	echo 2;
}

?>