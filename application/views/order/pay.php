<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/order.css" />
<div class="cmbody">
	<form action="<?php echo site_url('order/order/create_order')?>"
		method="post" enctype="multipart/form-data" id="post_form">
		<div class="mt40 payOnline clearfix">
			<a href="" class="right link">支付遇到问题？</a>
			<div class="procedure clearfix">
				<div class=" step step1 ">确认订单</div>
				<div class=" step step2 active">在线支付</div>
				<div class=" step step2">支付完成</div>
			</div>
			<div class="item-title mt60">
				<div class="title">
					<h2>购买人信息</h2>
					<div>INTRODUCTION</div>
				</div>
			</div>
			<div class="userInfo mt20">
        	<?php if(!empty($uinfo)){?>
        	<p>姓名：<?php echo $uinfo['info']['nick_name'];?></p>
			<p>邮箱：<?php echo $uinfo['info']['email'];?></p>
			<p>手机：<?php echo $uinfo['info']['mobile'];?></p>
            <?php }?>
        	</div>
        	<p>&nbsp;</p>
			<p class="price mt30">
				价格：<span class="blue f40"><?php echo $info['price'];?>元</span>
			</p>
			<div class="tip">选择您的支付方式</div>
			<ul class="paymentList mt45 clearfix" id="paymentList">
				<li class="active"><span class="radio active"> <input type="radio" id="alipay"
						class="dishide" />
				</span> <label for="alipay"> <img src="/zmo/static/img/alipay.jpg"
						alt="" title="" />
				</label></li>
			</ul>
			<div class="btn-box mt20 mb80">
				<input type="hidden" name="oid" value="<?php echo $info['oid'];?>">
				<a href="javascript:void(0);" class="payNowBtn" id="payNow">点此支付</a>
			</div>
		</div>
	</form>
</div>
<script>
$(document).ready(function(){
// 	$(".ltat div").each(function(){
// 		$(this).click(function(){
// 			$(".ltat div").each(function(){$(this).removeClass('check');});
// 			$(this).addClass('check');
// 		});
// 	});
// 	$(".rtag div").each(function(){
// 		$(this).click(function(){
// 			$(".rtag div").each(function(){$(this).removeClass('check');});
// 			$(this).addClass('check');	
// 		});	
// 	});
	$("#payNow").click(function(){
		$("#post_form").submit();	
	});
});
</script>

<?php $this->load->view('public/footer.php');?>