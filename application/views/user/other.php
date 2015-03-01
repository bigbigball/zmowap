<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/order.css" />
<div class="cmbody">
	<div class="mt40 order clearfix">
		<div class="left">
        	<?php $this->load->view('user/left.php');?>
        </div>
		<div class="content">
        	<?php $this->load->view('user/' . $file);?>
        </div>
	</div>
</div>
<script>
$(document).ready(function(){

})
</script>

<?php $this->load->view('public/footer.php');?>