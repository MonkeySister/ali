<?php
//接收前端发送的页码数
$pageno = $_POST['pageno'];
//echo $pageno;
//定义每页显示的数据条数
$pagesize = 3;
//查询数据时的限制条件
$start = ($pageno-1)*$pagesize;
$sql = "select ali_article.*,ali_admin.admin_nickname,ali_cate.cate_name from ali_article  
					JOIN ali_admin ON article_adminid=admin_id
					JOIN ali_cate ON article_cateid=cate_id
					limit $start,$pagesize";
include_once '../include/mysqli.php';
$result = json_encode(execSql($sql,'All'));
echo $result;
?>