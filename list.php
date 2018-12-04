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
      <?php include_once 'right.php'; ?>
    </div>
    <div class="content">
      <div class="panel new">
      	<?php
      		//根据传参来搜索分类数据
      		$cate_id = $_GET['cate_id'];
					$cate_name=$_GET['cate_name'];
      		$sql = "select ali_article.*,ali_admin.admin_nickname
									from ali_article
									JOIN ali_admin on article_adminid=admin_id
									where article_cateid=$cate_id";
					$result = mysqli_query($conn, $sql);
				?>
        <h3><?php echo $cate_name;?></h3>
        <?php while($arr = mysqli_fetch_assoc($result)){?>
        <div class="entry">
          <div class="head">
            <a href="detail.php?articleid=<?php echo $arr['article_id'];?>"><?php echo $arr['article_title'];?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $arr['admin_nickname'];?> 发表于 <?php echo $arr['article_addtime'];?></p>
            <p class="brief"><?php echo $arr['article_desc'];?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $arr['article_click'];?>)</span>
              <span class="comment">评论(<?php echo $arr['article_cmt'];?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $arr['article_good'];?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $cate_name;?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/admin/uploads/<?php echo $arr['article_file'];?>" alt="">
            </a>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
