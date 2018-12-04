
<?php
$sql = 'select * from ali_admin';
include_once '../include/mysqli.php';
$result = execSql ($sql, $type = 'All');
echo json_encode($result);
?>