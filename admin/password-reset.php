<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Password reset &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
	<?php include_once './include/checksession.php';?>
  <script>NProgress.start()</script>

  <div class="main">
		<?php include_once './include/header-nav.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>修改密码</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal" id="fm">
        <div class="form-group">
          <label for="old" class="col-sm-3 control-label">旧密码</label>
          <div class="col-sm-7">
            <input id="old" class="form-control" type="password" name="oldpwd" placeholder="旧密码">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">新密码</label>
          <div class="col-sm-7">
            <input id="password" class="form-control" type="password" name="newpwd" placeholder="新密码">
          </div>
        </div>
        <div class="form-group">
          <label for="confirm" class="col-sm-3 control-label">确认新密码</label>
          <div class="col-sm-7">
            <input id="confirm" class="form-control" type="password" name="newpwdt" placeholder="确认新密码">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-7">
            <button type="button" class="btn btn-primary" id="btnPwd">修改密码</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
    <?php include_once './include/aside.php'?>
  </div>
  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/layer/layer.js"></script>
  <script type="text/javascript">
  	//修改密码事件
  	$('#btnPwd').click(function(){
  		//获取表单内容
  		var fm = new FormData($('#fm')[0]);
  		//发送ajax请求
  		$.ajax({
  			type:"post",
  			url:"/admin/api/new-pws.php",
  			data:fm,
  			dataType:'text',
  			contentType:false,
  			processData:false,
  			success: function(msg){
  				console.log(msg);
  				if(msg == 2){
  					layer.alert('旧密码输入错误!');
  				}else if(msg == 3){
  					layer.alert('两次密码不匹配!');
  				}else if(msg == 4){
  					layer.alert('密码修改失败!')
  				}else{
  					layer.alert('密码修改成功!',function(){
  						location.href = 'profile.php';
  					});
  				}; 					
  			},
  			async:true
  		});
  	});
  </script>
  <script>NProgress.done()</script>
</body>
</html>
