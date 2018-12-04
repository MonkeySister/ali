<?php
//接收前端发送的数据
$id=$_POST['id'];
$name = $_POST['name'];
$slug = $_POST['slug'];
$time = date('Y-m-d',time());
$icon = $_POST['icon'];
$state = $_POST['state'];
$show = $_POST['show'];
$sql = "update ali_cate set cate_name='$name',cate_slug='$slug',cate_addtime='$time',cate_icon='$icon',cate_state=$state,cate_show=$show where cate_id=$id";
include_once '../include/mysqli.php';
$result = execSql ($sql, $type = 'idu');
if($result == 1){
	echo '修改成功';
	header("refresh:2;url=categories.php");
}else{
	echo '修改失败';
	header("refresh:2;url=editcate.php");
}
?>