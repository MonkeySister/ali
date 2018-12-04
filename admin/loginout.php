<?php
header("content-type:text/html;charset=utf-8;");
session_start();
session_destroy();
echo '退出成功！';
header("refresh:2;url=/admin/login.html");
?>