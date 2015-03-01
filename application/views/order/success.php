<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/order.css" />
<div class="cmbody">
	<div class="success">
		<div class="result">恭喜您购买成功！</div>
		<ul class="resultTip">
			<li>您的订单号为：<?php echo $info['info']['order_sn']?></li>
			<li>请凭此号参加活动</li>
		</ul>
		<div class="link">
			<!--a href="<??>">去我的订单查看详情</a-->
		</div>
		<!--div class="btn-box">
        	<a href=""></a>
        </div-->
	</div>
</div>
<script>
var s = 3, t;
function settime(){
	s--;
	t = setTimeout('settime()', 1000);
	if ( s <= 0 ){
		s = 5;
	 	clearTimeout(t);
		window.location.href="<?php echo site_url('user/user/center')?>";
	}
}
$(document).ready(function(){
	setTimeout("settime()", 1000);
});
</script>

<?php $this->load->view('public/footer.php');?>
