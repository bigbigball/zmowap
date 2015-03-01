<div class="bindPhone">
	<div class="detail-title mb60">
		<span>绑定手机</span>
	</div>
	<div class="warning-tips mb50">
		<i class="icon"></i>
		<div>您还未绑定手机,绑定手机是完全免费的,我们会对您的收集信息严格保密。</div>
	</div>
	<p class="f24 mb30">请输入您的手机号码：</p>
	<div class=" mb25">
		<input type="text" placeholder="手机号" class="input-text phone" />
	</div>
	<div class="mb35">
		<input type="text" placeholder="验证码" class="input-text code" /> <a
			href="javascript:void(0);" class="input-text codeNumber">获取验证码</a>
	</div>
	<input type="button" class="input-text submit" value="开始绑定" />
</div>
<script>
$(document).ready(function(){
	$(".codeNumber").click(function(){
		alert('已将验证码发送到您的手机上请查收');	
	});
	$(".submit").click(function(){
		var phone = $(".phone").val();
		if(phone == '' || phone == null || phone =="手机" ){
			alert('请填写手机号');
			return false;
		}
		var phone_reg = /^1[3,5,7,8]\d{9}$/;
		var phone_re = new RegExp(phone_reg);  
		if(phone_re.test(phone)){
			
		}else{
			alert('请填写正确的手机号码');	
		} 
	});
});
</script>