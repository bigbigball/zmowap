<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/order.css" />
<div class="cmbody">
	<div class="mt40 orderSure">
		<div class="clearfix">
			<a href="" class="right link">支付遇到问题？</a>
			<div class="procedure clearfix">
				<div class=" step step1 active">确认订单</div>
				<div class=" step step2">在线支付</div>
				<div class=" step step2">支付完成</div>
			</div>
		</div>
		<form action="<?php echo site_url('order/order/pay')?>" method="post"
			enctype="multipart/form-data" id="post_form">
			<div class="orderContent mt50">
				<div class="title"><?php echo $goods['title']?></div>
            <?php if(!empty($goods['tutor'])){?>
            <p class="subTitle">导师：<?php echo $goods['tutor']['name'];?></p>
            <?php }?>
            <div class="content">课程简介<?php echo $goods['desc'];?></div>
				<div class="price">
					价格：<span class=" f40 blue"><?php echo $goods['price'];?>元</span>
				</div>
				<div class="btn-box">
					<input type="hidden" value="<?php echo $order['info']['oid'];?>"
						name="oid" /> <a href="javascript:void(0);" class="btn">提交订单</a>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".btn").click(function(){
		$("#post_form").submit();	
	});
});
</script>

<?php $this->load->view('public/footer.php');?>