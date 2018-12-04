<?php
//接收前端发送的数据
$name = $_POST['name'];
$slug = $_POST['slug'];
$time = date('Y-m-d',time());
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];
//组织sql语句
$sql = "insert into ali_cate values(null,'$name','$slug','$time','$icon',$state,$show)";
include_once '../include/mysqli.php';
$result = execSql ($sql, $type = 'idu');
if($result == 1){
	echo '添加成功';
	header("refresh:2;url=categories.php");
}else{
	echo '添加失败';
	header("refresh:2;url=addcate.php");
}
?>