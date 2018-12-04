<?php
//接收img文件并打印
//print_r($_FILES);
//接收到图片后为图片命名
//strrpos函数找到.最后一次出现的下标，substr从.开始截取到最后，获得图片后缀
//随机为图片设置图片名
$imgName = time() . rand(10000, 90000) . substr($_FILES['f']['name'], strrpos($_FILES['f']['name'], '.'));
//改变图片路径，由临时路径上传到服务器能找到的文件中
if(move_uploaded_file($_FILES['f']['tmp_name'], '../upload/' . $imgName)){
	//如果成功将文件路径及文件名返回给前端
	$imgSrc = '../upload/' . $imgName;
	echo $imgSrc;
/*	//同时将此路径写入数据库
	//引入session
	include_once '../include/checksession.php';
	$id = $_SESSION['id'];
	$sql = "UPDATE ali_admin set admin_pic='$imgSrc' WHERE admin_id=$id";
	include_once '../include/mysqli.php';
	$result = execSql($sql,'idu');
	if($result){
		//如果成功，将图片路经包装成绝对路径返回给前端用于显示
		echo '/admin/upload/' . $imgName;
	}else{
		echo 0;
	}*/
}else{
	//如果失败返回0
	echo 0;
}
?>