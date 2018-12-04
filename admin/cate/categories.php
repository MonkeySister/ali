<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <!--以/开头的路径会自动补全域名，就变为http://php-workspace.ali.com/assets/vendors/bootstrap/css/bootstrap.css，成为了绝对路径，-->
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
	<?php include_once '../include/checksession.php';?>
  <script>NProgress.start()</script>
	<!--页面主体-->
  <div class="main">
		<?php
		include_once '../include/header-nav.php'; 
			?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>图标</th>
                <th>添加时间</th>
                <th>栏目状态</th>
                <th>是否显示</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
            	<!--php文件从数据库中读取-->
            	<?php
            		$sql = 'select * from ali_cate';
            		include_once '../include/mysqli.php';
            		$cate_list = execSql($sql,$type='All');
            		//print_r($cate_list);
            		foreach($cate_list as $value){
            		?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td><?php echo $value['cate_name']; ?></td>
                <td><?php echo $value['cate_slug']; ?></td>               
                <td><?php echo $value['cate_icon']; ?></td>
                <td><?php echo $value['cate_addtime']; ?></td>
                <td><?php echo $value['cate_state']==1? '允许':"禁止"; ?></td>
                <td><?php echo $value['cate_show']==1? '显示':"隐藏"; ?></td>
                <td class="text-center">
                	<a href="editcate.php?name=<?php echo $value['cate_name']; ?>" class="btn btn-info btn-xs" >编辑</a>
                  <a href="deletecate.php?name=<?php echo $value['cate_name']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('确定删除<?php echo $value['cate_name']; ?>栏目吗？')">删除</a>
                </td>
              </tr>
             	<?php } ?>
            </tbody>
          </table>
          <input type="button" onclick="location.href = 'addcate.php'" value="添加新栏目"/>
        </div>
      </div>
    </div>
  </div>
	<!--左侧列表导航栏-->
  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
