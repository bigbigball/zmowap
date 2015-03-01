<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/login.css" />
<div class="cmbody">
	<div class="block clearfix">
		<div class="left">
			<img src="/zmo/static/img/login_img.png" />
		</div>
		<div class="right">
			<form action="<?php echo site_url('user/user/regist');?>"
				method="post" enctype="multipart/form-data" id="post_form">
				<div class="action tab">
					<div class="reg_type tab-title clearfix">
						<div data-for="#mail" class="left ckleft" ck="1">邮箱注册</div>
						<div data-for="#phone" class="left" style="margin-left: 1px;"
							ck="2">手机注册</div>
					</div>
					<div class="tab-content">
						<div id="mail" class="tab-pane active">
							<div class="reg_text">
								<div>
									<input type="text" value="邮箱" id="m_mail" name="mail" />
								</div>
								<div class="mt20 mb20">
									<input type="password" id="m_pwd" name="m_pwd" placeholder="密码" />
								</div>
								<div>
									<input type="text" value="邀请码" id="m_code" name="m_code" />
								</div>
							</div>
						</div>
						<div id="phone" class="tab-pane">
							<div class="reg_text">
								<div>
									<input type="text" value="手机号" id="p_phone" name="p_phone" />
								</div>
								<div style="margin: 10px 0px;">
									<input type="password" id="p_pwd" name="p_pwd" placeholder="密码" />
								</div>
								<div>
									<input type="text" value="邀请码" id="p_code" name="p_code" />
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
							</div>
						</div>
					</div>
					<div class="reg_button clearfix phone_reg">
						<div class="left">
							<input type="hidden" name="reg_type" value="1" id="reg_type" /><input
								type="button" value="注册" onclick="regist();">
						</div>
						<div class="left">
							<a href="<?php echo site_url('user/user/login');?>"
								class="alogin">已有账号，去登录</a>
						</div>
					</div>
			
			</form>
		</div>
	</div>
</div>
</div>
<script>
$(document).ready(function(){
	//reg
	$(".reg_type div").each(function(){
		$(this).click(function(){
			$(this).addClass("ckleft").siblings().removeClass('ckleft');
			var id = $(this).attr('data-for');
			$(id).addClass('active').siblings('.tab-pane').removeClass('active');
			if($(this).attr('ck') == 1){
				$("#post_form").attr("action" , "<?php echo site_url('user/user/regist')?>")	;
			}else if($(this).attr('ck') == 2){
				$("#post_form").attr("action" , "<?php echo site_url('user/user/phone_regist')?>")	;
			}
		});	
	});
	$("#m_mail").click(function(){
		var m_mail = $("#m_mail").val();
		if(m_mail ==  '邮箱'){
			$("#m_mail").val('');	
		}
	}).blur(function(){
		var m_mail = $("#m_mail").val();
		if(m_mail ==  ''){
			$("#m_mail").val('邮箱');				
			$("#m_mail").css("color" , "#666");
		}
	}).focus(function(){
		var m_mail = $("#m_mail").val();
		if(m_mail ==  '邮箱'){
			$("#m_mail").val('');	
		}
		$("#m_mail").css("color" , "#000");	
	});
	$("#m_pwd").click(function(){
		var m_pwd = $("#m_pwd").val();
		if(m_pwd ==  '密码'){
			$("#m_pwd").val('');	
		}
	}).blur(function(){
		var m_pwd = $("#m_pwd").val();
		if(m_pwd ==  ''){
			$("#m_pwd").val('密码');				
			$("#m_pwd").css("color" , "#666");
		}
	}).focus(function(){
		var m_pwd = $("#m_pwd").val();
		if(m_pwd ==  '密码'){
			$("#m_pwd").val('');	
		}
		$("#m_pwd").css("color" , "#000");	
	});
	$("#m_code").click(function(){
		var m_code = $("#m_code").val();
		if(m_code ==  '邀请码'){
			$("#m_code").val('');	
		}
	}).blur(function(){
		var m_code = $("#m_code").val();
		if(m_code ==  ''){
			$("#m_code").val('邀请码');				
			$("#m_code").css("color" , "#666");
		}
	}).focus(function(){
		var m_code = $("#m_code").val();
		if(m_code ==  '邀请码'){
			$("#m_code").val('');	
		}
		$("#m_code").css("color" , "#000");	
	});
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
	$("#p_code").click(function(){
		var p_code = $("#p_code").val();
		if(p_code ==  '邀请码'){
			$("#p_code").val('');	
		}
	}).blur(function(){
		var p_code = $("#p_code").val();
		if(p_code ==  ''){
			$("#p_code").val('邀请码');				
			$("#p_code").css("color" , "#666");
		}
	}).focus(function(){
		var p_code = $("#p_code").val();
		if(p_code ==  '邀请码'){
			$("#p_code").val('');	
		}
		$("#p_code").css("color" , "#000");	
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
function regist(){
	var mail = $("#m_mail").val();
	if(mail == '邮箱'){
		$("#m_mail").val('');	
	}
	var m_pwd = $("#m_pwd").val();
	if(m_pwd ==  '密码'){
		$("#m_pwd").val('');	
	}
	var m_code = $("#m_code").val();
	if(m_code ==  '邀请码'){
		$("#m_code").val('');	
	}
	
	var p_phone = $("#p_phone").val();
	if(p_phone == '手机号'){
		$("#p_phone").val('');	
	}
	var p_pwd = $("#p_pwd").val();
	if(p_pwd ==  '密码'){
		$("#p_pwd").val('');	
	}
	var p_code = $("#p_code").val();
	if(p_code ==  '邀请码'){
		$("#p_code").val('');	
	}
	var p_dy_code = $("#p_dy_code").val();
	if(p_dy_code ==  '动态码'){
		$("#p_code").val('');	
	}
	$("#post_form").submit();
}
</script>

<?php $this->load->view('public/footer.php');?>