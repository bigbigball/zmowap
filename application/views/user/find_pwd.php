<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/login.css" />
<div class="cmbody">
	<div class="block clearfix">
		<div class="left">
			<img src="/zmo/static/img/login_img.png" />
		</div>
		<div class="right">
			<form action="<?php echo site_url('user/user/find_pwd');?>"
				method="post" enctype="multipart/form-data" id="post_form">
				<div class="action tab">
					<div class="reg_type tab-title clearfix">
						<div data-for="#mail" class="left ckleft" ck="1">找回密码</div>
					</div>
					<div class="tab-content">
						<div id="mail" class="tab-pane active">
							<div class="reg_text">
								<div>
									<input type="text" value="手机号" id="p_phone" name="p_phone" />
								</div>
								<div style="margin: 10px 0px;">
									<input type="password" id="p_pwd" name="p_pwd" placeholder="密码" />
								</div>
								<div class="clearfix mt10 phone_code">
									<div class="left">
										<input type="text" value="动态码" class="phone_code_text"
											id="p_dy_code" name="p_dy_code">
									</div>
									<div class="left">
										<a href="javascript:void(0);" class="phone_code_button">获取手机动态码</a>
									</div>
								</div>
								<div style="margin: 10px 0px;">
                                    <br>
								</div>
							</div>
						</div>
					</div>
					<div class="reg_button clearfix phone_reg">
						<div class="left">
							<input type="button" value="提交" onclick="find_pwd();" />
						</div>
					</div>
			
			</form>
		</div>
	</div>
</div>
</div>
<script>
function find_pwd(){
	var phone = $("#p_phone").val();
	var pwd = $("#p_pwd").val();

    phone_reg = /^1[3,5,7,8]\d{9}$/;
    phone_reg = new RegExp(phone_reg);
    var is_phone = (mail != '手机号' && phone_reg.test(phone));

	if(!is_phone){
		alert('请填写您正确的手机号');
		return false;	
	}

	if(pwd == '密码' || pwd == ''){
		alert('请填写您的密码');
		return false;	
	}

	var p_dy_code = $("#p_dy_code").val();
	if(p_dy_code == '动态码' || p_dy_code == ''){
		alert('请填写您的动态码');
		return false;	
	}

	$("#post_form").submit();	
}

$(document).ready(function(){
	$("#p_phone").click(function(){
		var p_phone = $("#p_sphone").val();
		if(p_phone ==  '手机号'){
			$("#p_phone").val('');	
		}
	}).blur(function(){
		var p_phone = $("#p_phone").val();
		if(p_phone ==  ''){
			$("#p_phone").val('手机号');				
			$("#p_phone").css("color" , "#666");
		}
	}).focus(function(){
		var p_phone = $("#p_phone").val();
		if(p_phone ==  '手机号'){
			$("#p_phone").val('');	
		}
		$("#p_phone").css("color" , "#000");	
	});
	$("#p_pwd").click(function(){
		var p_pwd = $("#p_pwd").val();
		if(p_pwd ==  '密码'){
			$("#phone").val('');	
		}
	}).blur(function(){
		var p_pwd = $("#p_pwd").val();
		if(p_pwd ==  ''){
			$("#p_pwd").val('密码');				
			$("#p_pwd").css("color" , "#666");
		}
	}).focus(function(){
		var p_pwd = $("#p_pwd").val();
		if(p_pwd ==  '密码'){
			$("#p_pwd").val('');	
		}
		$("#p_pwd").css("color" , "#000");	
	});
	$("#p_dy_code").click(function(){
		var p_dy_code = $("#p_dy_code").val();
		if(p_dy_code ==  '动态码'){
			$("#phone").val('');	
		}
	}).blur(function(){
		var p_dy_code = $("#p_dy_code").val();
		if(p_dy_code ==  ''){
			$("#p_dy_code").val('动态码');				
			$("#p_dy_code").css("color" , "#666");
		}
	}).focus(function(){
		var p_dy_code = $("#p_dy_code").val();
		if(p_dy_code ==  '动态码'){
			$("#p_dy_code").val('');	
		}
		$("#p_dy_code").css("color" , "#000");	
	});
	$(".phone_code_button").click(function(){
		var phone = $("#p_phone").val();
		phone_reg = /^1[3,5,7,8]\d{9}$/;
		phone_re = new RegExp(phone_reg);
		if(phone_re.test(phone)){
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('pf/send_phone_code');?>",
				data: "phone=" + phone + "&_r=" + Math.random(),
				success: function(msg){
					var info = eval("(" + msg + ")");
					switch(info.ret){
						case 200:
							alert('请您接受验证码短信');
							break;
						case 400:
							alert('参数错误');
							break;
						case 500:
							alert('发送失败，请重新发送');
							break;	
					}
				}
			});
		}else{
			alert('请输入正确的手机号');	
		}
		
	});
});
</script>

<?php $this->load->view('public/footer.php');?>
