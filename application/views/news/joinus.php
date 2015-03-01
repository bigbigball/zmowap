<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/list.css" />
<div class="cmbody">
	<div class="list">
		<div class="tag clearfix">
			<div class="left ltat clearfix">
				<div class="left <?php if($type == 0){ echo 'check';}?>">
					<a
						href="<?php echo site_url('news/news/show' , array('type' => 0));?>">全部</a>
				</div>
				<div class="mr1 <?php if($type == 1){ echo 'check';}?>"
					style="margin-left: 1px;">
					<a
						href="<?php echo site_url('news/news/show' , array('type' => 1));?>">人物</a>
				</div>
				<div class="mr1 <?php if($type == 2){ echo 'check';}?>">
					<a
						href="<?php echo site_url('news/news/show' , array('type' => 2));?>">热点</a>
				</div>
				<div class="<?php if($type == 3){ echo 'check';}?>">
					<a
						href="<?php echo site_url('news/news/show' , array('type' => 3));?>">行业</a>
				</div>
			</div>
		</div>
		<div class="info">
        	<?php if(!empty($list['info'])){foreach($list['info'] as $k => $v){?>
            	<div class="iblock clearfix">
				<div class="left iimg">
                    	<?php if(!empty($list['img'][$v['id']])){?>
                        <div>
						<a href="<?php echo site_url('news/news/info/' . $v['id']);?>"><img
							src="/<?php echo $list['img'][$v['id']]?>" /></a>
					</div>
                        <?php }else{?>
                        <div>
						<a href="<?php echo site_url('news/news/info/' . $v['id']);?>"><img
							src="/zmo/static/tmp/news_list1.png" /></a>
					</div>
                        <?php }?>                        
                    </div>
				<div class="left iinfo">
					<div class="ititle">
						<a href="<?php echo site_url('news/news/info/' . $v['id']);?>"><?php echo $v['title'];?></a>
					</div>
					<div class="idesc mt15">
                           <?php echo $v['desc'] . '-';?>[详细]
                        </div>
					<div class="iauthor mt10 clearfix">
						<div class="left author"><?php echo $v['author'] . '-' ;?></div>
						<div class="left ml10"><?php echo date('Y年m月d日 H:i' , $v['ntime']);?></div>
						<div class="left ml10">阅读(<?php echo $v['rnum'];?>)</div>
					</div>
				</div>
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