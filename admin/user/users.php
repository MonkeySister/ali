<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
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
		<?php include_once '../include/header-nav.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户信息</h1>
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
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
							<!--数据库掉取数据动态插入-->
            </tbody>
          </table>
          <input type="button" value="添加新用户" id="add-admin"/>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
  	<?php include_once '../include/aside.php'?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/template-web.js"></script>
  <script src="/assets/vendors/layer/layer.js"></script>

  <script type="text/template" id="t">
		{{each list value}}
		<tr>
      <td class="text-center"><input type="checkbox"></td>
      <td class="text-center"><img class="avatar" src="/assets/img/default.png"></td>
      <td>{{value.admin_email}}</td>
      <td>{{value.admin_slug}}</td>
     	<td>{{value.admin_nickname}}</td>
      <td>{{value.admin_state}}</td>
      <td class="text-center">
        <a href="javascript:;" class="btn btn-default btn-xs edit" a-index="{{value.admin_id}}">编辑</a>
        <a href="javascript:;" class="btn btn-danger btn-xs del" a-index="{{value.admin_id}}">删除</a>
      </td>
    </tr>
    {{/each}}
	</script>
	<script type="text/javascript">
		//请求数据库中的用户信息显示再页面上
  	$.post('getAdminList.php',function(msg){
  		var json = {"list":msg};
  		var tbodyStr = template('t',json);
  		$('tbody').html(tbodyStr);
  	},'json');
  	$('#add-admin').click(function(){
  		layer.ready(function(){
  			layer.open({
  				title: '添加新用户',
  				type: 2,
  				content: 'adduser.php',
  				area: ['600px','500px'],
  				maxmin:false,
  			});
  		});
  	});
  	//事件委托绑定删除事件
  	$('tbody').on('click','.del',function(){
  		_this = $(this);
  		layer.confirm('您确定删除吗？',function(){
  			//获取每个a的代表当前行的id
	  		var $id = _this.attr('a-index');
	  		//console.log($id);
	  		//发送ajax请求
	  		$.get('deleteuser.php?_='+Math.random(),{id:$id},function(msg){
	  			//console.log(msg);
	  			if(msg == 1){
	  				//等于1时删除成功提示删除成功，移出当前行的tr
	  				layer.alert('删除成功！');
	  				_this.parent().parent().remove();
	  			}else{
	  				layer.alert('删除失败！');
	  			};
	  		});
  		});
  	}).on('click','.edit',function(){//事件委托编辑事件
  		_this = $(this);
  		//每个用户的编辑索引
  		var $id = _this.attr('a-index');
  		//弹层编辑用户
  		layer.ready(function(){
  			layer.open({
  				title: '编辑用户',
  				type: 2,
  				content: 'edituser.php?id='+$id,
  				area: ['600px','500px'],
  				maxmin:false,
  			})
  		});
  	});
  </script>
  <script>NProgress.done()</script>
</body>
</html>
