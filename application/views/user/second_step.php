<div class="passwordSure">
	<form action="<?php echo site_url('user/user/do_update_pwd')?>"
		method="post" enctype="multipart/form-data" id="post_form">
		<div class="detail-title mb60">
			<span>确认密码</span>
		</div>
		<p class="tips">验证成功，请设置您的新密码并确认</p>
		<div class="mb50">
			<input type="password" placeholder="密码" class="input-text" id="pwd"
				name="pwd" />
		</div>
		<div class="mb50">
			<input type="password" placeholder="确认密码" class="input-text"
				id="ver_pwd" name="ver_pwd" />
		</div>
		<input type="button" class="input-text submit" value="确认" />
	</form>
</div>
<script>
$(document).ready(function(){
	$(".submit").click(function(){
		var pw1 = $("#pwd").val();
		var pw2 = $("#ver_pwd").val();
		if(pw1 === pw2){
			$("#post_form").submit();
		}else{
			alert('两次密码不一致');	
		}
	});
});
</script>