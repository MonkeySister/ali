<?php
//接收表单发来的数据
//print_r($_POST);
$email = $_POST['email'];
$nickname = $_POST['nickname'];
$tel = $_POST['tel'];
$gender = $_POST['gender'];
$slug = $_POST['slug'];
$state = $_POST['state'];
$pwd = md5($_POST['pwd']);
$time = time();
$sql = "insert into ali_admin(admin_id,admin_email,admin_nickname,admin_tel,admin_gender,admin_slug,admin_pwd,admin_state,admin_addtime) 
											    values(null,'$email','$nickname','$tel','$gender','$slug','$pwd','$state','$time')";
include_once '../include/mysqli.php';
$result = execSql($sql,'idu');
if($result == 1){
	$sql = "SELECT * from ali_admin ORDER BY admin_id DESC LIMIT 0,1";
	$result_obj = execSql($sql,'One');
	print_r( json_encode($result_obj));
}else{
	echo 2;
}

?>