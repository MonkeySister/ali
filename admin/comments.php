<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
	<?php include_once 'include/checksession.php';?>
  <script>NProgress.start()</script>

  <div class="main">
		<?php include_once 'include/header-nav.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <!--<ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>-->
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
        	<!--这里使用模板引擎从后端传数据来创建tr-->
        	<script type="text/template" id="trTpl">
        		{{each trList value}}
	        		<tr class="danger">
		            <td class="text-center"><input type="checkbox"></td>
		            <td>{{value.member_name}}</td>
		            <td>{{value.cmt_content}}</td>
		            <td>{{value.article_title}}</td>
		            <td>{{value.cmt_addtime}}</td>
		            <td>{{value.cmt_state}}</td>
		            <td class="text-center">
		              <a href="post-add.html" class="btn btn-info btn-xs state" stateIndex="{{value.cmt_id}}">批准</a>
		              <a href="javascript:;" class="btn btn-danger btn-xs del" delIndex="{{value.cmt_id}}">删除</a>
		            </td>
		          </tr>
						{{/each}}
        	</script>
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once 'include/aside.php'; ?>
  </div>
  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/assets/vendors/template-web.js"></script>
  <script src="/assets/vendors/layer/layer.js"></script>
  <script type="text/javascript">
  	//根据接口提示发送相应的请求
  	$.post('/admin/api/comments/getCmt.php',function(data){
  		console.log(data);
  		console.log(data.data);
  		//转化为json对象
  		var trJson = {"trList":data['data']};
  		console.log(trJson);
  		var trStr = template('trTpl',trJson);
  		//加入tbody
  		$('tbody').html(trStr);
  	},'json');
  	//删除事件
  	$('tbody').on('click','.del',function(){
  		var $delIndex = $(this).attr('delIndex');
  		var _this = $(this);
  		//console.log($delIndex);
  		layer.confirm("您确定删除该评论吗？",function(){
  			$.post('/admin/api/comments/delCmt.php',{id:$delIndex},function(msg){
  				//console.log(msg);
  				//console.log(msg.code);
  			  if(msg.code==202){
  			  	layer.msg(msg.message);
  			  	_this.parent().parent().remove();
  			  }else{
  			  	layer.msg(msg.message);
  			  }
  			},'json');
  		});	    	
  	});
  </script>
  <script>NProgress.done()</script>
</body>
</html>