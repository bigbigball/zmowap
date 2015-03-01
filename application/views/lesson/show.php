<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/list.css" />

<div class="cmbody">
 <ol class="breadcrumb">
 当前位置：
  <li><a href="<?php echo site_url('home/index')?>">首页</a></li>
  <li class="active">课程</li>
</ol>
 </div>

<div class="cmbody">
	<div class="list">
		<div class="tag clearfix">
			<div class="left ltat clearfix">
				<a href="<?php echo site_url('lesson/lesson/show')?>"><div
						class="left <?php if($type == 0 ){ echo 'check';}?>">全部</div></a>
				<a
					href="<?php echo site_url('lesson/lesson/show',array('type' => 1))?>"><div
						class=" <?php if($type == 1 ){ echo 'check';}?>">线上课程</div></a> <a
					href="<?php echo site_url('lesson/lesson/show',array('type' => 2))?>"><div
						class=" <?php if($type == 2 ){ echo 'check';}?>">线下课程</div></a>
			</div>
		</div>
		<div class="info">
        	<?php  if(!empty($list['info'])){foreach($list['info'] as $k => $v){?>
            <div class="iblock clearfix">
				<div class="left iimg">
					<div>
                    <?php if(!empty($v['thumb'])){?>
                    <img src="<?php echo $v['thumb'];?>" />
                    <?php }else{?>
                    <img src="/zmo/static/tmp/list.png" />
                    <?php }?>
                    </div>
					<div class="itag"><?php if($v['type'] == 1){ echo '视频课程';}elseif($v['type'] == 2){ echo '线下课程';}?></div>
				</div>
				<div class="left iinfo">
					<div class="ititle"><?php echo $v['title'];?></div>
					<div class="iteachter mt20">导师：<?php if(!empty($list['tutor'][$v['guest_id']])){ echo $list['tutor'][$v['guest_id']];}?></div>
					<div class="ctag clearfix mt10">
						<div class="left">标签：</div>
                        <?php if(!empty($v['tag'])){$tags = explode('|',trim($v['tag'] , '|'));?>
                        <?php if(!empty($tags)){foreach($tags as $tv){?>
                        <div class="left ctags"><?php echo $tv ;?></div>
                        <?php }}}?>
                    </div>
					<div class="idesc mt15">
                    课程简介：<?php echo $v['desc'];?>
                    </div>
					<div class="iprice mt10">
						价格：<span class="price"><?php if($v['is_price'] == 1){ echo $v['price'];}else{ echo '免费';}?></span>
					</div>
					<div class="clearfix">
						<div class="ibutton mt20 left">
							<a href="javascript:void(0);"
								onclick="buy_lesson('<?php echo $v['id'];?>');">购买</a>
						</div>
					</div>
				</div>
			</div>
            <?php }}?>
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
</div>
<script>
function buy_lesson(id){
	window.location.href="<?php echo site_url('lesson/lesson/info/" +id+ "')?>";	
}
$(document).ready(function(){

});
</script>

<?php $this->load->view('public/footer.php');?>