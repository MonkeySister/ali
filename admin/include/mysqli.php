<?php 
define('HOST', 'localhost');
define('NAME', 'root');
define('PWD', 'root');
define('DBNAME', 'study');

/**
 * 功能: 链接MySQL并执行SQL语句，等到对应的结果
 * 参数1: 要执行的SQL语句，增删改查都行
 * 参数2: 执行类型，
 *     如果执行查询SQL语句，并且查询结果会返回多条数据，则设置为 All
 *     如果执行查询SQL语句，并且查询结果会返回一条数据，则设置为 One
 *     如果执行增删改SQL语句，则设置为 idu 或者 不设置
 * 返回值:
 *     当参数2为All时，返回二维数组
 *     当参数2为One时，返回一维数组
 *     当参数2为idu时，返回布尔值
 */
function execSql ($sql, $type = 'idu') {
    //链接MySQL服务器 & 选择数据库
    $conn = mysqli_connect(HOST, NAME, PWD, DBNAME);
    //设置字符集
    mysqli_query($conn, 'set names utf8');
    //执行SQL语句
    $result = mysqli_query($conn, $sql);
    //判断$type的类型,不同类型返回不同数据
    if ($type == 'All') {
        $arr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
        return $arr;
    } else if ($type == 'One') {
        return mysqli_fetch_assoc($result);
    } else if ($type == 'idu') {
        return $result;
    }
}

//功能测试
/*$list = execSql('select * from ali_admin', 'All');
print_r($list);*/

/*$sql = 'select * from ali_cate where cate_id=1';
$arr = execSql($sql, 'One');
print_r($arr);*/

/*$sql = 'delete from ali_cate where cate_id=5';
echo execSql($sql);*/


//设置默认值
/*function  add (x = 10,y = 20) {
    echo x + y;
}

add(3,5); //8
add(); //30*/
?>