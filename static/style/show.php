<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/teacher.css" />
<div class="cmbody">
 <ol class="breadcrumb">
 当前位置：
  <li><a href="<?php echo site_url('home/index')?>">首页</a></li>
  <li class="active">导师</li>
</ol>
 </div>
<div class=" cmbody">
	<div class="block mt61">
		<ul class="teacherList clearfix">
			<?php if(!empty($list['info'])){foreach($list['info'] as $k => $v){?>
        	<li class="item"><a
				href="<?php echo site_url('teacher/teacher/info/' . $v['id']);?>"> <img
					src="<?php echo $v['portrait']?>" alt="" title="" height="290px" />
					<div class="shadow"></div>
					<div class="shadowAll"></div>
					<div class="detail">
						<h4><?php echo $v['name']?></h4>
						<p><?php echo $v['desc'];?></p>
					</div>
			</a></li>
			<?php }}?>
        </ul>
		<div class="pagination">
			<?php echo $page ;?>
            <!--a href="" class="prev">上一页</a>
            <a class="current" href="">1</a>
            <a href="">2</a>
            <a href="">3</a>
            <a href="">4</a>
            <a href="">5</a>
            <a href="">6</a>
            <span>...</span>
            <a href="">10</a>
            <a href="" class="next">下一页</a-->
		</div>
	</div>
</div>
<script src="/zmo/static/js/teacher.js"></script>
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