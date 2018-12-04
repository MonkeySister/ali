<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Slides &laquo; Admin</title>
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
        <h1>图片轮播</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form id="fm">
            <h2>添加新轮播内容</h2>
            <div class="form-group">
              <label for="image">图片</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none">
              <input id="image" class="form-control" name="image" type="file">
            </div>
            <div class="form-group">
              <label for="text">文本</label>
              <input id="text" class="form-control" name="text" type="text" placeholder="文本">
            </div>
            <div class="form-group">
              <label for="link">链接</label>
              <input id="link" class="form-control" name="link" type="text" placeholder="链接">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="button" id="btnImg">添加</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center">图片</th>
                <th>文本</th>
                <th>链接</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
            	<script type="text/template" id="trTpl">
            		{{each trList value}}
            		  <tr>
		                <td class="text-center"><input type="checkbox"></td>
		                <td class="text-center"><img class="slide" src="{{value.pic_url}}"></td>
		                <td>{{value.pic_text}}</td>
		                <td>{{value.pic_link}}</td>
		                <td class="text-center">
		                  <a href="javascript:;" class="btn btn-danger btn-xs del" delIndex="{{value.pic_id}}">删除</a>
		                </td>
		              </tr>
            		{{/each}}
            	</script>
            </tbody>
          </table>
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
  <script type="text/javascript">
  	//发送ajax请求，显示轮播列表
  	$.post('/admin/api/pic/getPic.php',function(msg){
  		console.log(msg.data);
  		var trJson = {"trList":msg.data};
  		var trStr = template('trTpl',trJson);
  		$('tbody').html(trStr);
  	},'json');
  	//删除事件
  	$('tbody').on('click','.del',function(){
  		var _this = $(this);
  		var $slideId = $(this).attr('delIndex');
  		layer.confirm("您确定删除此图片吗?",function(){
  			$.post('/admin/api/pic/delPic.php',{id:$slideId},function(msg){
  				if(msg.code == 302){
  					layer.alert(msg.message);
  					//删除成功后dom操作删除此项
  					_this.parent().parent().remove();
  				}else{
  					layer.alert(msg.message);
  				}
  			},'json');
  		})
  	});
  	//添加轮播图
  	$('#btnImg').click(function(){
  		//获取表单域的值
  		var fm = new FormData($('#fm')[0]);
  		$.ajax({
  			type:"post",
  			url:"/admin/api/pic/addPic.php",
  			data:fm,
  			dataType:'json',
  			contentType:false,
  			processData:false,
  			success: function(msg){
  				//console.log(msg);
  				if(msg.code == 306){
  					var tr = $('<tr></tr>');
  					var str='';
  					str += '<td class="text-center"><input type="checkbox"></td>';
		        str += '<td class="text-center"><img class="slide" src="'+msg.data.pic_url+'"></td>';
            str += '<td>'+msg.data.pic_text+'</td>';
            str += '<td>'+msg.data.pic_link+'</td>';
            str += '<td class="text-center">';
              str += '<a href="javascript:;" class="btn btn-danger btn-xs del" delIndex="'+msg.data.pic_id+'">删除</a>';
            str += '</td>';
            tr.html(str);
            $('tbody').append(tr);
  					layer.alert(msg.message);
  					$('#image').val('');
  					$('#text').val('');
  					$('#link').val('');
  				}else{
  					layer.alert(msg.message);
  				};
  			},
  			async:true
  		});
  	});
  </script>
  <script>NProgress.done()</script>
</body>
</html>
