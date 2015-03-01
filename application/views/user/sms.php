<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/order.css" />
<div class="cmbody">
	<div class="mt40 order clearfix">
		<div class="left">
        	<?php $this->load->view('user/left.php');?>
        </div>
		<div class="content">
			<?php $this->load->view('user/user_info.php');?>
            <div class="message">
				<ul class="nav-title mb30">
					<li <?php if($file == 'sms_contacts'){?> class="active" <?php }?>
						nav-target="#friends"><a
						href="<?php echo site_url('user/user/sms' , array('action' => 'sms_contacts'))?>">人脉消息</a></li>
					<li <?php if($file == 'sms_order'){?> class="active" <?php }?>
						nav-target="#orders"><a
						href="<?php echo site_url('user/user/sms' , array('action' => 'sms_order'))?>">订单消息</a></li>
					<li <?php if($file == 'sms_push'){?> class="active" <?php }?>
						nav-target="#pushMsg"><a
						href="<?php echo site_url('user/user/sms' , array('action' => 'sms_push'))?>">推送消息</a></li>
				</ul>
				<div class="nav-content">
					<div id="friends">
						<ul class="friendList">
                        	<?php if(!empty($sms)){foreach($sms as $k => $v){?>
                        	<li>
								<div class="avastar">
									<img src="/zmo/static/img/msg_avastar.png" alt="头像"
										class="avastarImg" /> <img
										src="/zmo/static/img/icon_hot_circle.png" alt="hot" class="hot" />
								</div>
								<div class="info">
									<div>
										<span class="time"><?php echo date('Y年m月d日 H:m' , $v['ctime'])?></span>
										<p class="title"><?php echo $v['send_name'];?></p>
									</div>
									<p class="detail"><?php echo $v['content'];?></p>
								</div>
							</li>
                            <?php }}?>
                        </ul>
					</div>
					<div id="orders"></div>
					<div id="pushMsg"></div>
				</div>
			</div>
			<!-- 分页开始 -->
			<div class="pagination">
				<a href="" class="prev">上一页</a> <a class="current" href="">1</a> <a
					href="">2</a> <a href="">3</a> <a href="">4</a> <a href="">5</a> <a
					href="">6</a> <span>...</span> <a href="">10</a> <a href=""
					class="next">下一页</a>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){

})
</script>

<?php $this->load->view('public/footer.php');?>