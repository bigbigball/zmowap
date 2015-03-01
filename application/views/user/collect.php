<?php $this->load->view('public/header.php');?>
<link
	rel="stylesheet" type="text/css" href="/zmo/static/style/order.css" />
<div class="cmbody">
<div class="mt40 order clearfix">
<div class="left"><?php $this->load->view('user/left.php');?></div>
<div class="content"><?php $this->load->view('user/user_info.php');?>
<div class="orderList">
<div class="title clearfix">
<div style="text-align: center;"><?php
if (! empty ( $otype )) {
	switch ($otype) {
		case 2 :
			echo '收藏的课程';
			break;
		case 3 :
			echo '收藏的活动';
			break;
		case 4 :
			echo '收藏的导师';
			break;
	}
} else {
	echo '收藏的内容';
}
?></div>
</div>
<ul>
<?php if(!empty($infos) && $otype == 2){ foreach($infos as $info){?>
	<li style="height: 138px">
	<div class="clearfix info"
		style="height: 162px; line-height: 162px; text-align: center;">
	<div class="name" style="width: 610px; margin-right: 0px;">
	
		<div class="left productImg">
		<img width="121px" height="121px" src="<?php echo $info['img']?>"/>
	</div>
	<?php echo $info['title']?>
	</div>
	<div class="status"><a href="<?php echo site_url('lesson/lesson/info/'.$info['id']);?>" class="btn">去查看</a></div>
	</div>
	</li>
<?php }}else if(!empty($infos) && $otype == 4){ foreach($infos as $info){?>
	<li style="height: 138px">
	<div class="clearfix info"
		style="height: 162px; line-height: 162px; text-align: center;">
	<div class="name" style="width: 610px; margin-right: 0px;">
	
		<div class="left productImg">
		<img height="121px" src="<?php echo $info['portrait']?>"/>
	</div>
	<?php echo $info['name']?>
	</div>
	<div class="status"><a href="<?php echo site_url('teacher/teacher/info/'.$info['id']);?>" class="btn">去查看</a></div>
	</div>
	</li>
<?php }}else if(!empty($infos) && $otype == 3){ foreach($infos as $info){?>
	<li style="height: 138px">
	<div class="clearfix info"
		style="height: 162px; line-height: 162px; text-align: center;">
	<div class="name" style="width: 610px; margin-right: 0px;">
		<div class="left productImg">
		<img width="121px" height="121px" src="<?php echo $info['img']?>"/>
		</div>
		<?php echo $info['title']?>
	</div>
	<div class="status"><a href="<?php echo site_url('active/active/info/'.$info['id']);?>" class="btn">去查看</a></div>
	</div>
	</li>
	<?php }}else{?>
	<li
		style="height: 38px; text-align: center; line-height: 38px; font-size: 18px;">
	没有相关内容</li>
	<?php } ?>
</ul>
</div>
<!-- 分页开始 --> <!--div class="pagination">
                <a href="" class="prev">上一页</a>
                <a class="current" href="">1</a>
                <a href="">2</a>
                <a href="">3</a>
                <a href="">4</a>
                <a href="">5</a>
                <a href="">6</a>
                <span>...</span>
                <a href="">10</a>
                <a href="" class="next">下一页</a>
            </div--></div>
</div>
</div>
<script>
$(document).ready(function(){

})
</script>

	<?php $this->load->view('public/footer.php');?>