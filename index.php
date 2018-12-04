<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <!--连接网页字体库-->
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <div class="header">
    	<!--这里面打开过数据库，以后就不用再打开了-->
    	<?php include_once 'left.php'; ?>
    </div>
    <div class="aside">
      <?php include_once 'right.php';?>
    </div>
    <div class="content">
      <div class="swipe">
        <ul class="swipe-wrapper">
        	<?php
						//轮播图查询
						$sql = "select * from ali_pic";
						$result = mysqli_query($conn, $sql);
						//$arr = mysqli_fetch_assoc($result);
						//print_r($arr);
						while($arr = mysqli_fetch_assoc($result)){
					?>
          <li>
            <a href="#">
              <img src="<?php echo $arr['pic_url'];?>">
              <span><?php echo $arr['pic_text'];?></span>
            </a>
          </li>
          <?php };?>
        </ul>
        <p class="cursor">
        	<span class="active"></span>
        	<span></span>
        	<span></span>
        </p>
        <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
        <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
        <h3>焦点关注</h3>
        <ul>
        	<?php
						//从数据库中查询数据，动态展现栏目列表
						$sql = "select * from ali_article where article_focus=1
										order by article_addtime desc
										limit 0,5";
						//运行查询语句
						$result = mysqli_query($conn, $sql);
						$i = 0;
						while($arr = mysqli_fetch_assoc($result)){?>
          <li class="<?php if($i == 0){echo 'large';}?>">
            <a href="detail.php?articleid=<?php echo $arr['article_id'];?>">
              <img src="/admin/upload/<?php echo $arr['article_file'];?>" alt="">
              <span><?php echo $arr['article_title'];?></span>
            </a>
          </li>
          <?php $i++; }?>
        </ul>
      </div>
      <div class="panel top">
        <h3>一周热门排行</h3>
        <ol>
        	<?php
						//从数据库中查询数据，动态展现栏目列表
						$sql = "select * from ali_article
										order by article_click desc
										limit 0,5";
						//运行查询语句
						$result = mysqli_query($conn, $sql);
						$i = 0;
						while($arr = mysqli_fetch_assoc($result)){?>
          <li>
            <i><?php echo $i;?></i>
            <a href="detail.php?articleid=<?php echo $arr['article_id'];?>"><?php echo $arr['article_title'];?></a>
            <a href="javascript:;" class="like">赞(<?php echo $arr['article_good'];?>)</a>
            <span>阅读 (<?php echo $arr['article_click'];?>)</span>
          </li>
          <?php $i++; }?>
        </ol>
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
      <div class="panel new">
        <h3>最新发布</h3>
        <?php
					//从数据库中查询数据，动态展现栏目列表
					$sql = "select ali_article.*,ali_cate.cate_name,ali_admin.admin_nickname
									from ali_article
									JOIN ali_admin on article_adminid=admin_id
									JOIN ali_cate ON article_cateid=cate_id
									order by article_addtime desc
									limit 0,5";
					//运行查询语句
					$result = mysqli_query($conn, $sql);
					while($arr = mysqli_fetch_assoc($result)){?>
        <div class="entry">
          <div class="head">
            <span class="sort"><?php echo $arr['cate_name'];?></span>
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
                分类：<span><?php echo $arr['cate_name'];?></span>
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
  <script src="assets/vendors/jquery/jquery.js"></script>
  <script src="assets/vendors/swipe/swipe.js"></script>
  <script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
      auto: 3000,
      transitionEnd: function (index) {
        // index++;

        $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
      }
    });

    // 上/下一张
    $('.swipe .arrow').on('click', function () {
      var _this = $(this);

      if(_this.is('.prev')) {
        swiper.prev();
      } else if(_this.is('.next')) {
        swiper.next();
      }
    });
    //有关主页轮播图
    //发送ajax请求，查询数据库动态添加图片
    
  </script>
</body>
</html>
