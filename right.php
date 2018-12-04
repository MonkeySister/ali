<div class="widgets">
  <h4>搜索</h4>
  <div class="body search">
    <form>
      <input type="text" class="keys" placeholder="输入关键字">
      <input type="submit" class="btn" value="搜索">
    </form>
  </div>
</div>
<div class="widgets">
  <h4>随机推荐</h4>
  <ul class="body random">
		<?php
			//随机推荐查询
			$sql = "select * from ali_article order by rand() limit 0, 5";
			$result = mysqli_query($conn, $sql);
			//$arr = mysqli_fetch_assoc($result);
			while($arr = mysqli_fetch_assoc($result)){
		?>

    <li>
      <a href="detail.php?articleid=<?php echo $arr['article_id'];?>" articleIndex="<?php echo $arr['article_id'];?>">
        <p class="title"><?php echo $arr['article_title'];?></p>
        <p class="reading"><?php echo $arr['article_click'];?>阅读(819)</p>
        <div class="pic">
          <img src="/admin/upload/<?php echo $arr['article_file'];?>" alt="">
        </div>
      </a>
    </li>
    <?php };?>
  </ul>
</div>
<div class="widgets">
  <h4>最新评论</h4>
  <ul class="body discuz">
  	<?php
  		//评论添加
  		$sql = "select ali_comment.*,ali_member.member_nickname,ali_member.member_pic
							from ali_comment 
							JOIN ali_member ON cmt_memid=member_id
							order by rand() 
							limit 0, 5";
			$result = mysqli_query($conn, $sql);
			//$arr = mysqli_fetch_assoc($result);
			while($arr = mysqli_fetch_assoc($result)){ 
  	?>
    <li>
      <a href="javascript:;">
        <div class="avatar">
          <img src="<?php echo $arr['member_pic'];?>" alt="">
        </div>
        <div class="txt">
          <p>
            <span><?php echo $arr['member_nickname'];?></span><?php echo $arr['cmt_addtime'];?>说:
          </p>
          <p><?php echo $arr['cmt_content'];?></p>
        </div>
      </a>
    </li>
    <?php };?>
  </ul>
</div>
