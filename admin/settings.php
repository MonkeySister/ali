<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Settings &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
	<?php include_once 'include/checksession.php';?>
  <script>NProgress.start()</script>

  <div class="main">
		<?php include_once 'include/header-nav.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>网站设置</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal">
        <div class="form-group">
          <label for="site_logo" class="col-sm-2 control-label">网站图标</label>
          <div class="col-sm-6">
            <input id="site_logo" name="site_logo" type="hidden">
            <label class="form-image">
              <input id="logo" type="file">
              <img src="../assets/img/logo.png" id="logoImg" >
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="site_name" class="col-sm-2 control-label">站点名称</label>
          <div class="col-sm-6">
            <input id="site_name" name="site_name" class="form-control" type="text" placeholder="站点名称">
          </div>
        </div>
        <div class="form-group">
          <label for="site_description" class="col-sm-2 control-label">站点描述</label>
          <div class="col-sm-6">
            <textarea id="site_description" name="site_description" class="form-control" placeholder="站点描述" cols="30" rows="6"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="site_keywords" class="col-sm-2 control-label">站点关键词</label>
          <div class="col-sm-6">
            <input id="site_keywords" name="site_keywords" class="form-control" type="text" placeholder="站点关键词">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">评论</label>
          <div class="col-sm-6">
            <div class="checkbox">
              <label><input id="comment_status" name="comment_status" type="checkbox">开启评论功能</label>
            </div>
            <div class="checkbox">
              <label><input id="comment_reviewed" name="comment_reviewed" type="checkbox">评论必须经人工批准</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-6">
            <button type="submit" class="btn btn-primary" id="updateSite">保存设置</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
		<?php include_once 'include/aside.php'; ?>
  </div>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/layer/layer.js"></script>
  <script type="text/javascript">
  	function serch(){
  		//发送ajax请求，查询网站信息并返回
	  	$.post('/admin/api/site/getSite.php',function(msg){
	  		//console.log(msg);
	  		$('#logoImg').attr('src',msg.data.site_logo);
	  		$('#site_name').val(msg.data.site_name);
	  		$('#site_description').text(msg.data.site_desc);
	  		$('#site_keywords').val(msg.data.site_keys);
	  		if(msg.data.site_status == 1){
	  			$('#comment_status').prop('checked','checked');
	  		};
	  		if(msg.data.site_review ==1){
	  			$('#comment_reviewed').prop('checked','checked');
	  		};
	  	},'json');
  	}
  	serch();
  	//logo文件问题解决
  	$('#logo').change(function(){
  		//获取文件
  		var file = document.getElementById('logo').files[0];
  		//console.dir(file);
  		//创建一个空的formData对象
  		var fm = new FormData();
  		//将图片文件追加进去
  		fm.append('f',file);
  		//console.log(fm);
  		//发送ajax请求，获取图片保存路径
  		$.ajax({
  			type:"post",
  			url:"uploadLogoImg.php",
  			data:fm,
  			dataType:'text',
  			contentType:false,
  			processData:false,
  			success: function(msg){
  				console.log(msg);
  				if(msg == 0){
  					layer.alert('图片更新失败!');
  				}else{  					
  					$('#logoImg').attr('src',msg);
  					$('#site_logo').val(msg);
  					//layer.alert('图片上传成功!');
  				}
  			},
  			async:true
  		});
  	});
  	//保存设置事件
  	$('#updateSite').click(function(){
  		//获取表单内容
  		var loge = $('#site_logo').val();
  		var name = $('#site_name').val();
  		var description = $('#site_description').text();
  		var keywords = $('#site_keywords').val();
  		var status = $('#comment_status').prop();
  		var reviewed = $('#comment_reviewed').prop();
  		
  		//发送ajax请求
  		$.post('/admin/api/site/setSite.php',{site_logo:loge,site_name:name,site_description:description,
  																					comment_status:status,comment_reviewed:reviewed},
  					function(msg){
  						console.log(msg);
  					},'text');
  	});
  </script>
  <script>NProgress.done()</script>
</body>
</html>
