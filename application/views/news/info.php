<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/detail.css" />
<div class="cmbody">
 <ol class="breadcrumb">
 当前位置：
  <li><a href="<?php echo site_url('home/index')?>">首页</a></li>
  <li><a href="<?php echo site_url('news/news/show')?>">资讯</a></li>
  <li class="active"><?php echo $info['title'];?></li>
</ol>
 </div>
<div class="cmbody">
	<div class="newsInfo">
		<h4><?php echo $info['title'];?></h4>
		<p class="time"><?php echo date('Y年m月d日' , $info['ctime']);?>&emsp;by：<?php echo $info['author'];?></p>
		<div class="conBox">
			<?php echo $info['content'];?>
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