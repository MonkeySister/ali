<?php

//接收传参
$name = $_GET['name'];
//创建sql语句
$sql = "delete from ali_cate where cate_name='$name'";
include_once '../include/mysqli.php';
$result = execSql ($sql, $type = 'idu');
if($result == 1){
	echo '删除成功';
	header("refresh:2;url=categories.php");
}else{
	echo '删除失败';
	header("refresh:2;url=categories.php");
}
?>