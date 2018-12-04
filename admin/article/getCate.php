<?php
//查询所有的分类目录
$sql = "SELECT * from ali_cate where cate_state=1";
include_once '../include/mysqli.php';
$result = execSql($sql,'All');
echo json_encode($result);
?>