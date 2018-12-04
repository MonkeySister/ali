<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<title>Categories &laquo; Admin</title>
		<link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
		<link rel="stylesheet" href="/assets/css/admin.css">
		<script src="/assets/vendors/nprogress/nprogress.js"></script>
	</head>
	<body>
		<?php include_once '../include/checksession.php';?>
		<script>NProgress.start()</script>

		<div class="main">
			<nav class="navbar">
				<button class="btn btn-default navbar-btn fa fa-bars"></button>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="profile.html">
							<i class="fa fa-user"></i>个人中心
						</a>
					</li>
					<li>
						<a href="login.html">
							<i class="fa fa-sign-out"></i>退出
						</a>
					</li>
				</ul>
			</nav>
			<div class="container-fluid">
				<div class="page-title">
					<h1>分类目录</h1>
				</div>
				<!-- 有错误信息时展示 -->
				<!-- <div class="alert alert-danger">
				<strong>错误！</strong>发生XXX错误
				</div> -->
				<div class="row">
					<div class="col-md-4">
						<?php
						 $name = $_GET['name'];
						 //创建sql语句
						$sql = "select * from ali_cate where cate_name='$name'";
						include_once '../include/mysqli.php';
						$result = execSql ($sql, $type = 'One');
						//print_r($result);
						?>
						<form action="edit_deal.php" method="post">
							<h2>修改分类目录</h2>
							<div class="form-group">
								<label for="name">id</label>
								<input id="name" class="form-control" name="id" type="text" readonly value="<?php echo $result['cate_id'];?>"/>
							</div>
							<div class="form-group">
								<label for="name">名称</label>
								<input id="name" class="form-control" name="name" type="text" value="<?php echo $result['cate_name'];?>"/>
							</div>
							<div class="form-group">
								<label for="slug">别名</label>
								<input id="slug" class="form-control" name="slug" type="text" value="<?php echo $result['cate_slug'];?>">
							</div>
							<div class="form-group">
								<label for="name">图标</label>
								<input id="name" class="form-control" name="icon" type="text" value="<?php echo $result['cate_icon'];?>">
							</div>
							<div class="form-group">
								<label>栏目状态</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php if($result['cate_state'] == 1){?>
								<input id="allow"  name="state" type="radio" value="1" checked><label for="allow">允许</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="unable" name="state" type="radio" value="2"><label for="unable">禁止</label>
								<?php }else{ ?>
								<input id="allow"  name="state" type="radio" value="1"><label for="allow">允许</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="unable" name="state" type="radio" value="2" checked><label for="unable">禁止</label>
								<?php } ?>
							</div>
							<div class="form-group">
								<label>是否显示</label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<?php if($result['cate_show'] == 1){ ?>
								<input id="shows" name="show" type="radio" value="1" checked><label for="shows">显示</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="hide" name="show" type="radio" value="2"/><label for="hide">隐藏</label>
								<?php }else{ ?>	
								<input id="shows" name="show" type="radio" value="1"><label for="shows">显示</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="hide" name="show" type="radio" value="2" checked/><label for="hide">隐藏</label>
								<?php } ?>
							</div>
							<p class="help-block">
								https://zce.me/category/<strong>slug</strong>
							</p>
							<div class="form-group">
								<button class="btn btn-primary" type="submit">
								提交
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="aside">
			<?php
			include_once '../include/aside.php';
			?>
		</div>

		<script src="/assets/vendors/jquery/jquery.js"></script>
		<script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
		<script>NProgress.done()</script>
	</body>
</html>
