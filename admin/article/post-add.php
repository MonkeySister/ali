<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
	<link href="/assets/vendors/ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
  <script type="text/javascript" src="/assets/vendors/ueditor/third-party/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/vendors/ueditor/umeditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="/assets/vendors/ueditor/umeditor.min.js"></script>
  <script type="text/javascript" src="/assets/vendors/ueditor/lang/zh-cn/zh-cn.js"></script>
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/assets/vendors/template-web.js"></script>
</head>
<body>
	<?php include_once '../include/checksession.php';?>
  <script>NProgress.start()</script>

  <div class="main">
  	<?php include_once '../include/header-nav.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">摘要</label>
            <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="2" placeholder="摘要"></textarea>
          </div>
          <div class="form-group">
            <label for="text">文章</label>
            <textarea id="myEditor"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
            <input id="hidden_path" type="hidden" name="path" value=""></input>
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              <script type="text/template" id="cateTpl">
								{{each cateList value}}
									<option value="{{value.cate_id}}">{{value.cate_name}}</option>
								{{/each}}
							</script>
            </select>
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">保存</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
  	<?php include_once '../include/aside.php' ?>
  </div>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/plain" id="myEditor" style="width:1000px;height:240px;">
    <p>这里我可以写一些输入提示</p>
	</script>

	<script type="text/javascript">
		//编辑器的设置
		var um = UM.getEditor('myEditor',{
			initialFrameWidth:'100%', //初始化编辑器宽度,默认500
      initialFrameHeight:300,  //初始化编辑器高度,默认500
      initialContent:'编写文章具体内容',
      isShow : true ,   //默认显示编辑器
      autoClearinitialContent:true //是否自动清除编辑器初始内容
		});
		//所属栏目的设置，文档一加载自动获取
		//发送ajax请求
		$.ajax({
			type:"post",
			url:"getCate.php",
			dataType:'json',
			success: function(data){
				//console.log(data);
				//转化为json对象
				var catejson = {"cateList":data};
				//console.log(cateStr);
				var cateStr = template('cateTpl',catejson);
				$('#category').html(cateStr);
			},			
			async:true
		});
		//特设图像，为feature设置onchange事件（通常用在select改变和文件域）
		$('#feature').change(function(){
			//files是文件域对象的一个属性（伪数组类型），保存了所有选中的文件对象
			var file = document.getElementById('feature').files[0];
			//console.log(file);
			//创建一个空的formData对象
			var fd = new FormData();
			//将文件追加近fd 
			fd.append('f',file)
			//调用ajax方法
			$.ajax({
				type:"post",
				url:"uploadCateImg.php",
				data:fd,
				dataType:'text',
				processData:false,
				contentType:false,
				success: function(data){
					console.log(data);
					$('#hidden_path').val(data);
				},
				async:true
			});
		});
	</script>
  <script>NProgress.done()</script>
</body>
</html>
