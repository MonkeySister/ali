<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="header">
      <?php include_once 'left.php'; ?>
    </div>
    <div class="aside">
      <?php include_once 'right.php';?>
    </div>
    <div class="content">
    	<?php
      		//根据传参来搜索分类数据
      		$article_id = $_GET['articleid'];
      		$sql = "select ali_article.*,ali_cate.cate_name,ali_admin.admin_nickname
									from ali_article
									JOIN ali_admin on article_adminid=admin_id
									JOIN ali_cate ON article_cateid=cate_id
									where article_id=$article_id";
					$result = mysqli_query($conn, $sql);
					while($arr=mysqli_fetch_assoc($result)){
				?>
      <div class="article">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><?php echo $arr['cate_name'];?></a></dd>
            <dd><?php echo $arr['article_title'];?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?php echo $arr['article_title'];?></a>
        </h2>
        <div class="meta">
          <span><?php echo $arr['admin_nickname'];?> 发布于 <?php echo $arr['article_addtime'];?></span>
          <span>分类: <a href="javascript:;"><?php echo $arr['cate_name'];?></a></span>
          <span>阅读: (<?php echo $arr['article_click'];?>)</span>
          <span>评论: (<?php echo $arr['article_cmt'];?>)</span>
        </div>
        <?php }?>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
        	<?php
						//从数据库中查询数据，动态展现栏目列表
						$sql = "select * from ali_article
										order by article_good desc
										limit 0,4";
						//运行查询语句
						$result = mysqli_query($conn, $sql);
						while($arr = mysqli_fetch_assoc($result)){?>
          <li>
            <a href="detail.php?articleid=<?php echo $arr['article_id'];?>" articleIndex="<?php echo $arr['article_id'];?>">
              <img src="/admin/upload/<?php echo $arr['article_file'];?>" alt="">
              <span><?php echo $arr['article_title'];?></span>
            </a>
          </li>
          <?php }?>
        </ul>
      </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
