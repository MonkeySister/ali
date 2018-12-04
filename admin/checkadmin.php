<?php
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$sql = "select * from ali_admin where admin_email='$email'";
include_once 'include/mysqli.php';
$result = execSql($sql,'One');
//echo $result;
if(empty($result)){
	echo 1;
}else{
	if(md5($pwd) == $result['admin_pwd']){		
		//登录成功时要注册session
		session_start();
		$_SESSION['id']=$result['admin_id'];
		//$_SESSION['email']=$result['admin_email'];
		$_SESSION['nickname']=$result['admin_nickname'];
		$_SESSION['pic']=$result['admin_pic'];
		echo 2;
	}else{
		echo 3;
	}
}
?>