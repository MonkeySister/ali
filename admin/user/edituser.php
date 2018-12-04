<link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
<link rel="stylesheet" href="/assets/css/admin.css">
<script src="/assets/vendors/nprogress/nprogress.js"></script>
<!-- 有错误信息时展示 -->
<!-- <div class="alert alert-danger">
<strong>错误！</strong>发生XXX错误
</div> -->
<div class="col-md-4">
	<?php
		//接收此用户的id
		$id = $_GET['id'];
		//根据此id查找此用户
		$sql = "select * from ali_admin where admin_id=$id";
		include_once '../include/mysqli.php';
		$result = execSql($sql,'One');
		//print_r($result);
		?>
	<form>
		<h2>编辑用户</h2>
		<div class="form-group">
			<label for="id">id</label>
			<input id="id" class="form-control" name="id" type="text" readonly value="<?php echo $result['admin_id'];?>" />
		</div>
		<div class="form-group">
			<label for="email">邮箱</label>
			<input id="email" class="form-control" name="email" type="email" value="<?php echo $result['admin_email'];?>">
		</div>
		<div class="form-group">
			<label for="nickname">昵称</label>
			<input id="nickname" class="form-control" name="nickname" type="text" value="<?php echo $result['admin_nickname'];?>">
		</div>
		<div class="form-group">
			<label for="tel">电话</label>
			<input id="tel" class="form-control" name="tel" type="text" value="<?php echo $result['admin_tel'];?>">
		</div>
		<div class="form-group">
			<label for="state">状态</label>
			<input id="state" class="form-control" name="state" type="text" value="<?php echo $result['admin_state'];?>">
		</div>
		<div class="form-group">
			<label for="gender">性别</label>
			<input id="man" name="gender" type="radio" value="男" checked>
			<label for="man">男</label>
			<input id="women" name="gender" type="radio" value="女" />
			<label for="women">女</label>
		</div>
		<div class="form-group">
			<label for="slug">别名</label>
			<input id="slug" class="form-control" name="slug" type="text" value="<?php echo $result['admin_slug'];?>">
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="button">
			修改
			</button>
		</div>
	</form>
</div>
<script src="/assets/vendors/jquery/jquery.js"></script>
<script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
<script src="/assets/vendors/layer/layer.js"></script>
<script type="text/javascript">
	//为修改设置点击事件
	$('.btn-primary').click(function(){
		//提交时获取表单中的所有数据,表单数据必须为DOM对象
		var fm = new FormData($('form')[0]);
		//提交时发送ajax请求，
		$.ajax({		
			url: 'edituser_deal.php',
			data: fm,
			type:'post',
			dataType: 'text',
			//使用ajax提交表单数据时必须设置项
			contentType: false,
			processData: false,
			//timeout:5000,
			//回调函数
			success: function(msg){
				//console.log(msg);
				if(msg == 2){
					parent.layer.alert('修改用户失败');
				}else{
					var data = JSON.parse(msg);
					console.log(data);
					parent.layer.alert('修改成功',function(i){
						var index = parent.layer.getFrameIndex(window.name);
						//关闭第一层弹窗
						parent.layer.close(index);
						//关闭本次弹窗
						parent.layer.close(i);
						//重新载入页面，缺点：浪费浏览器资源，反应不及时
						parent.location.reload();
						//如果成功将新的数据追加到页面中，使用模板对象
						/*var $tr = $('<tr></tr>');
						var str='';
						str += '<td class="text-center"><input type="checkbox"></td>';
						str +='<td class="text-center"><img class="avatar" src="/assets/img/default.png"></td>';
						str +='<td>'+data.admin_email+'</td>';
			      str +='<td>'+data.admin_slug+'</td>';
			     	str +='<td>'+data.admin_nickname+'</td>';
			      str +='<td>'+data.admin_state+'</td>';
			      str +='<td class="text-center">';
			      str +='<a href="javascript:;" class="btn btn-default btn-xs edit" a-index="{{value.admin_id}}">编辑</a>';
			      str +='<a href="javascript:;" class="btn btn-danger btn-xs del" a-index="{{value.admin_id}}">删除</a>';
			      str +='</td>';	
					  console.log(str);
						$tr.html(str);
						parent.$('tbody').append($tr);*/
					});
				}
			}
		})
	});	
</script>