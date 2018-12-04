<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
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
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
        <ul class="pagination pagination-sm pull-right">
        	<!--此处调用分页插件-->
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
        	<script type="text/template" id="trTpl">
        		{{each trList value}}
	        		<tr>
		            <td class="text-center"><input type="checkbox"></td>
		            <td>{{value.article_title}}</td>
		            <td>{{value.admin_nickname}}</td>
		            <td>{{value.cate_name}}</td>
		            <td class="text-center">{{value.article_addtime}}</td>
		            <td class="text-center">{{value.article_state}}</td>
		            <td class="text-center">
		              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
		              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
		            </td>
		          </tr>
	        	{{/each}}
        	</script>
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php' ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <!--引入分页插件-->
  <script src="/assets/vendors/esimakin-twbs-pagination/jquery.twbsPagination.js"></script>
  <script src="/assets/vendors/template-web.js"></script>
  <!--引入模板引擎-->
  <script type="text/template" id="trTpl">
  	
  </script>
  <?php 
  	//发送ajax请求获取数据库中所有文章的数目
  	$sql = "select count(*) as num from ali_article";
		include_once '../include/mysqli.php';
		$result = execSql($sql,'One');
		//echo $totalPages;
		//自定义每页显示的条数
		$pageSize = 3;
		//总页数等于总数据条数除以每页显示的条数
		$totalPages = ceil($result['num']/$pageSize);
  	?>
  <script type="text/javascript">
  	//分页引入
  	$(function () {
      window.pagObj = $('.pagination').twbsPagination({
      	first:'首页',
      	prev:'上一页',
      	next:'下一页',
      	last:'尾页',
        totalPages: <?php echo $totalPages;?>,//总页数,
        visiblePages: 3,//显示出的页数
        onPageClick: function (event, page) {
            //console.info(page + ' (from options)');
            $.post('getContent.php',{pageno:page},function(data){
            	//console.log(data);
            	//转化为json对象，调用模板引擎动态展示数据
            	var trJson = {"trList":data};
            	console.log(trJson);
            	var trStr = template('trTpl',trJson);
            	//插入到tbody
            	$('tbody').html(trStr);
            },'json');
        }
      }).on('page', function (event, page) {
          //console.info(page + ' (from event listening)');
      });
    });
  </script>
  <script>NProgress.done()</script>
</body>
</html>
