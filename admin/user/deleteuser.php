<?php
//获取发送的id
$id = $_GET['id'];
//echo $id;
$sql = "delete from ali_admin where admin_id=$id";
include_once '../include/mysqli.php';
$result_obj = execSql($sql, $type = 'idu');
echo $result_obj;
?>