<div class="emailValidate">
	<div class="detail-title mb60">
		<span>验证邮箱</span>
	</div>
	<div class="mb50">
		<input type="text" placeholder="请输入邮箱地址" class="input-text emailBox" />
	</div>
	<div class="mb50">
		<a class="input-text codeNumber" href="javascript:void(0);">获取验证码</a>
		<a href="javascript:void(0);" class="blue f22 ml65">点击进入邮箱>></a>
	</div>
	<div class="mb50">
		<input type="text" placeholder="请输入邮箱验证码" class="input-text codeBox" />
	</div>
	<input type="button" class="input-text submit" value="确定" />
</div>
<script>
$(document).ready(function(){
	$(".codeNumber").click(function(){
		alert('已将验证码发送到您的邮箱请查收');	
	});
	$(".submit").click(function(){
		var mail = $(".emailBox").val();
		if(mail == '' || mail == null || mail =="手机" ){
			alert('请填写邮箱帐号');
			return false;
		}
		var email_reg = /^[-,_,A-Z,a-z,0-9]+@([_,A-Z,a-z,0-9]+\.)+[A-Za-z0-9]{2,3}$/; ;
		var email_reg = new RegExp(email_reg);  
		if(email_reg.test(mail)){
			
		}else{
			alert('请填写正确的邮箱帐号');	
		} 
	});
});
</script>