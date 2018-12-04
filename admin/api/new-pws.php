<?php
//引入session
include_once '../include/checksession.php';
//接收发送数据
//print_r($_POST);
$oldpwd = $_POST['oldpwd'];
$newpwd = $_POST['newpwd'];
$newpwdt = $_POST['newpwdt'];
$id = $_SESSION['id'];
$sql = "select admin_pwd from ali_admin where admin_id=$id";
include_once '../include/mysqli.php';
$result = execSql($sql,$type = 'One');
//print_r($result);
if(md5($oldpwd) == $result['admin_pwd']){
	if($newpwd == $newpwdt){
		$admin_pwd = md5($newpwd);
		$sql = "update ali_admin set admin_pwd='$admin_pwd' where admin_id=$id";
		$result_obj = execSql($sql,$type = 'idu');
		if($result_obj){
			echo 1;
		}else{
			echo 4;
		}		
	}else{
		echo 3;
	}
}else{
	echo 2;
}
?>