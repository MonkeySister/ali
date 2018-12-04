<h1 class="logo"><a href="index.php"><img src="assets/img/logo.png" alt=""></a></h1>
<ul class="nav">
<?php
	//从数据库中查询数据，动态展现栏目列表
	$sql = "select * from ali_cate";
	//连接数据库
	$conn = mysqli_connect('localhost', 'root', 'root', 'study');
	//改变字符集
	mysqli_query($conn, 'set names utf8');
	//运行查询语句
	$result = mysqli_query($conn, $sql);
	while($arr = mysqli_fetch_assoc($result)){?>
	<li>
		<a href="list.php?cate_id=<?php echo $arr['cate_id'];?>&cate_name=<?php echo $arr['cate_name'];?>">
			<i class="fa <?php echo $arr['cate_icon']?>"></i><?php echo $arr['cate_name'];?>		
		</a>
	</li>
	<?php };?>
</ul>

