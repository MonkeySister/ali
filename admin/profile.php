<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
	<?php include_once './include/checksession.php';?>
  <script>NProgress.start()</script>
	<?php
		//根据session搜索相关用户信息
		$id = $_SESSION['id'];
		$sql = "select * from ali_admin where admin_id=$id";
		include_once './include/mysqli.php';
		$result = execSql($sql,'One');
	?>
  <div class="main">
  	<?php include_once './include/header-nav.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal" id="fm">
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" type="file">
              <img src="<?php echo $result['admin_pic'];?>">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email" class="form-control" name="email" type="type" value="<?php echo $result['admin_email']; ?>" placeholder="email" readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
            <input id="slug" class="form-control" name="slug" type="type" value="<?php echo $result['admin_slug']; ?>" placeholder="slug">
            <p class="help-block">https://zce.me/author/<strong>zce</strong></p>
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="<?php echo $result['admin_nickname']; ?>" placeholder="昵称">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" class="form-control" name="sign" placeholder="Bio" cols="30" rows="6"><?php echo $result['admin_sign']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <button type="button" class="btn btn-primary" id="btnUpdate">更新</button>
            <a class="btn btn-link" href="password-reset.php">修改密码</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
		<?php include_once './include/aside.php'?>
  </div>
  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="../assets/vendors/layer/layer.js"></script>
  <script type="text/javascript">
  	//头像上传,为文件设置改变事件
  	$('#avatar').change(function(){
  		//files是文件域对象的一个属性（伪数组类型），保存了所有选中的文件对象
  		var file = document.getElementById('avatar').files[0];
  		//console.log(file);
  		//当实例化FormData时，不给参数就会实例化一个空的FormData对象
    	var fd = new FormData();
    	//将文件对象加入到FormData中，利用FormData的一个方法 -- append
    	fd.append('f', file);
    	//调用ajax方法发送请求
    	$.ajax({    		
    		url:"uploadImg.php",
    		type:"post",
    		data:fd,
    		dataType:'text',
    		contentType:false,
    		processData:false,
    		success: function(data){
    			//console.log(data);
    			if(data == 2){
    				layer.msg('头像上传失败！');
    			}else{
    				layer.msg('头像上传成功!');
    				$('.form-image img').attr('src',data);
    				$('.avatar').attr('src',data);
    			}
    		},
    		async:true
    	});
  	});
  	//更新事件
  	$('#btnUpdate').click(function(){
  		//获取表单内容，不包含头像，头像已经提前保存过
  		var fm = new FormData($('#fm')[0]);
  		//发送ajax请求
  		$.ajax({
  			type:"post",
  			url:"updateAdmin.php",
  			data:fm,
  			dataType:'text',
  			contentType:false,
  			processData:false,
  			success: function(msg){
  				//console.log(msg);
  				if(msg == 1){
  					layer.alert('更新成功!',function(){
  						location.reload();
  					});
  					
  				}else{
  					layer.alert('更新失败!');
  				}
  			},
  			async:true
  		});
  	});
  </script>
  <script>NProgress.done()</script>
</body>
</html>
