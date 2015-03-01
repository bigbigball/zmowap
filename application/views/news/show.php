<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/list.css" />
<div class="cmbody">
 <ol class="breadcrumb">
 当前位置：
  <li><a href="<?php echo site_url('home/index')?>">首页</a></li>
  <li class="active">资讯</li>
</ol>
 </div>
<div class="cmbody">
	<div class="list">
		<div class="tag clearfix">
			<div class="left ltat clearfix">
				<a
					href="<?php echo site_url('news/news/show' , array('type' => 0));?>"><div
						class="left <?php if($type == 0){ echo 'check';}?>">全部</div></a> <a
					href="<?php echo site_url('news/news/show' , array('type' => 1));?>"><div
						class="mr1 <?php if($type == 1){ echo 'check';}?>"
						style="margin-left: 1px;">人物</div></a> <a
					href="<?php echo site_url('news/news/show' , array('type' => 2));?>"><div
						class="mr1 <?php if($type == 2){ echo 'check';}?>">热点</div></a> <a
					href="<?php echo site_url('news/news/show' , array('type' => 3));?>"><div
						class="<?php if($type == 3){ echo 'check';}?>">行业</div></a>
			</div>
		</div>
		<div class="info">
        	<?php if(!empty($list['info'])){foreach($list['info'] as $k => $v){?>
            <div class="newslist">
				<ul>
					<li>
                         <?php if(!empty($v['img'])){?>
                        <a
						href="<?php echo site_url('news/news/info/' . $v['id']);?>"><img
							src="<?php echo $v['img'];?>" /></a>
                        <?php }else{?>
                        <a
						href="<?php echo site_url('news/news/info/' . $v['id']);?>"><img
							src="/zmo/static/tmp/list.png" /></a>
                        <?php }?>  
                        <div class="news_info">
							<a href="<?php echo site_url('news/news/info/' . $v['id']);?>"><div
									class="ititle"><?php echo $v['title'];?></div></a>
							<p><?php echo $v['desc'];?></p>
							<div class="label">
								<span>By <?php echo $v['author']?></span>&emsp;<?php echo date('Y年m月d日' , $v['utime']);?>&emsp;<?php echo date('H:i' , $v['utime']);?>&emsp;&emsp;阅读(<?php echo $v['rnum']?>)</div>
						</div>
					</li>
				</ul>
			</div>
			<?php }}?>
             <!-- 分页开始 -->
			<div class="pagination">
                <?php echo $page;?>
            </div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".ltat div").each(function(){
		$(this).click(function(){
			$(".ltat div").each(function(){$(this).removeClass('check');});
			$(this).addClass('check');
		});
	});
	$(".rtag div").each(function(){
		$(this).click(function(){
			$(".rtag div").each(function(){$(this).removeClass('check');});
			$(this).addClass('check');	
		});	
	});
});
</script>
<?php $this->load->view('public/footer.php');?>