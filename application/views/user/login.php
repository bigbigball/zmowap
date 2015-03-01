<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/login.css" />
<div class="cmbody">
	<div class="block clearfix">
		<div class="left">
			<img src="/zmo/static/img/login_img.png" />
		</div>
		<div class="right">
			<form action="<?php echo site_url('user/user/login');?>"
				method="post" enctype="multipart/form-data" id="post_form">
				<div class="action">
					<div class="action_info">
						<div class="action_title">使用邮箱、手机登陆</div>
						<div class="action_text">
							<div>
								<input type="text" placeholder="知家注册邮箱" name="mail" id="mail" />
							</div>
							<div class="mt20">
								<input type="password" name="pwd" id="pwd" placeholder="密码">
							</div>
						</div>
						<div class="remember clearfix">
							<div class="left clearfix">
								<div class="rember_option active left"></div>
								<div class="rember_text left">记住我</div>
							</div>
							<div class="right">
								<a href="<?php echo site_url('user/user/find_pwd');?>"">忘记密码？</a>
							</div>
						</div>
						<div class="action_do clearfix">
							<div class="left">
								<input type="button" value="登陆" onclick="login();" />
							</div>
							<div class="left areg">
								<a href="<?php echo site_url('user/user/regist');?>">没有账号？立即注册</a>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="third_login">
		<div class="third_header clearfix">
			<div class="third_line left"></div>
			<div class="third_title left">其他方式登录</div>
			<div class="third_line left"></div>
		</div>
		<div class="third_icon clearfix">
			<div class="left" onclick="qq_login();">
				<img src="/zmo/static/img/qqlogin.png" />
			</div>
			<div class="left">
				<img src="/zmo/static/img/weixinlogin.png" />
			</div>
			<div class="left" onclick="bd_login();">
				<img src="/zmo/static/img/baidulogin.png" />
			</div>
		</div>
	</div>
</div>
<script>
function qq_login(){
	 var A=window.open("<?php echo site_url('user/user/qq_login')?>","TencentLogin", "width=450,height=320,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=1");
}
function bd_login(){
	window.location.href = "http://openapi.baidu.com/oauth/2.0/authorize?response_type=code&client_id=<?php echo $config['bd']['key'];?>&redirect_uri=<?php echo $config['bd']['rurl'];?>&scope=basic&display=popup";	
}
function login(){
	var mail = $("#mail").val();
	var pwd = $("#pwd").val();

	var mail_reg = /^[-,_,A-Z,a-z,0-9]+@([_,A-Z,a-z,0-9]+\.)+[A-Za-z0-9]{2,3}$/;
	var mail_reg = new RegExp(mail_reg); 
    var is_mail = (mail != '知家注册邮箱' && mail_reg.test(mail));

    phone_reg = /^1[3,5,7,8]\d{9}$/;
    phone_reg = new RegExp(phone_reg);
    var is_phone = (mail != '知家注册邮箱' && phone_reg.test(mail));

	if(!is_phone && !is_mail){
		alert('请填写您正确的邮箱或手机号');
		return false;	
	}

	if(pwd == '密码'){
		alert('请填写您的密码');
		return false;	
	}
	$("#post_form").submit();	
}
$(document).ready(function(){
	$(".top_menu li").each(function(){
		$(this).mouseover(function(){
			$(".top_menu li").each(function(){$(this).removeClass('check_menu');});
			$(this).addClass('check_menu');	
		});	
	});
	$(".footer_menu li").each(function(){
		$(this).mouseover(function(){
			$(".footer_menu li").each(function(){$(this).removeClass('check_menu');});
			$(this).addClass('check_menu');	
		});	
	});
	//login
	$("#mail").click(function(){
		var name = $("#mail").val();
		if(name ==  '知家注册邮箱'){
			$("#mail").val('');	
		}
	}).blur(function(){
		var name = $("#mail").val();
		if(name ==  ''){
			$("#mail").val('知家注册邮箱');				
			$("#mail").css("color" , "#666");
		}
	}).focus(function(){
		var name = $("#mail").val();
		if(name ==  '知家注册邮箱'){
			$("#mail").val('');	
		}
		$("#mail").css("color" , "#000");	
	});
	
	$("#pwd").click(function(){
		var pwd = $("#pwd").val();
		if(pwd ==  '密码'){
			$("#pwd").val('');	
		}
	}).blur(function(){
		var pwd = $("#pwd").val();
		if(pwd ==  ''){
			$("#pwd").val('密码');				
			$("#pwd").css("color" , "#666");
		}
	}).focus(function(){
		var pwd = $("#pwd").val();
		if(pwd ==  '密码'){
			$("#pwd").val('');	
		}
		$("#pwd").css("color" , "#000");	
	});
	$(".rember_option").click(function(){
		if( $(this).hasClass('active') ){
			$(this).removeClass('active');	
		}else{
			$(this).addClass('active');	
		}
	});
});
</script>

<?php $this->load->view('public/footer.php');?>
