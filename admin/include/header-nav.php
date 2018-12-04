<nav class="navbar">
  <button class="btn btn-default navbar-btn fa fa-bars"></button>
  <ul class="nav navbar-nav navbar-right">
    <li><a href="/admin/profile.php"><i class="fa fa-user"></i>个人中心</a></li>
    <li><a href="javascript:;" id="loginOut"><i class="fa fa-sign-out"></i>退出</a></li>
  </ul>
</nav>
<script src="/assets/vendors/jquery/jquery.js"></script>
<script src="/assets/vendors/layer/layer.js"></script>
<script type="text/javascript">
	$('#loginOut').click(function(){
		layer.confirm('您确定退出吗？',function(){
			location.href='/admin/loginout.php';
		});
	});
</script>