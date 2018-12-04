<?php
//接收img文件并打印
//print_r($_FILES);
//接收到图片后为图片命名
//strrpos函数找到.最后一次出现的下标，substr从.开始截取到最后，获得图片后缀
//随机为图片设置图片名
$imgName = time() . rand(10000, 90000) . substr($_FILES['f']['name'], strrpos($_FILES['f']['name'], '.'));
//改变图片路径，由临时路径上传到服务器能找到的文件中
if(move_uploaded_file($_FILES['f']['tmp_name'], './upload/' . $imgName)){
	echo '/admin/upload/' . $imgName;
}else{
	//如果失败返回0
	echo 0;
}
?>