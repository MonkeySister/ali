<?php 
	//引入session
	//include_once 'checksession.php';
	$arr = explode('/', $_SERVER['PHP_SELF']);
	print_r($arr);
?>
<div class="profile">
	<img class="avatar" src="<?php echo $_SESSION['pic']?>">
	<h3 class="name"><?php echo $_SESSION['nickname'] ?></h3>
</div>
<ul class="nav">
	<li class="<?php if($arr[2] == 'index.php') echo 'active';?>">
		<a href="/admin/index.php">
			<i class="fa fa-dashboard"></i>仪表盘
		</a>
	</li>
	<li>
		<a href="#menu-posts" class="collapsed" data-toggle="collapse">
			<i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
		</a>
		<ul id="menu-posts" class="collapse <?php if($arr[2] == 'cate' || $arr[2] == 'article') echo 'in';?>">
			<li class="<?php if($arr[3] == 'posts.php') echo 'active';?>">
				<a href="/admin/article/posts.php">
					所有文章
				</a>
			</li>
			<li class="<?php if($arr[3] == 'post-add.php') echo 'active';?>">
				<a href="/admin/article/post-add.php">
					写文章
				</a>
			</li>
			<li class="<?php if($arr[3] == 'categories.php') echo 'active';?>">
				<a href="/admin/cate/categories.php">
					分类目录
				</a>
			</li>
			<li class="<?php if($arr[3] == 'addcate.php') echo 'active';?>">
				<a href="/admin/cate/addcate.php">
					添加新目录
				</a>
			</li>
		</ul>
	</li>
	<li class="<?php if($arr[2] == 'comments.php') echo 'active';?>">
		<a href="/admin/comments.php">
			<i class="fa fa-comments"></i>评论
		</a>
	</li>
	<li class="<?php if($arr[3] == 'users.php') echo 'active';?>">
		<a href="/admin/user/users.php">
			<i class="fa fa-users"></i>用户
		</a>
	</li>
	<li>
		<a href="#menu-settings" class="collapsed" data-toggle="collapse">
			<i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
		</a>
		<ul id="menu-settings" class="collapse <?php if($arr[2] == 'slides' || $arr[2] == 'settings.php') echo 'in';?>">
			<li >
				<a href="nav-menus.html">
					导航菜单
				</a>
			</li>
			<li class="<?php if($arr[3] == 'slides.php') echo 'active';?>">
				<a href="/admin/slides/slides.php">
					图片轮播
				</a>
			</li>
			<li class="<?php if($arr[2] == 'settings.php') echo 'active';?>">
				<a href="/admin/settings.php">
					网站设置
				</a>
			</li>
		</ul>
	</li>
</ul>