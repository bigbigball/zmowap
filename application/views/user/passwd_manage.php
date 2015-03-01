<div class="passwordEdit">
	<form action="<?php echo site_url('user/user/change_password')?>"
		method="post" enctype="multipart/form-data" id="post_form">
		<div class="detail-title mb60">
			<span>修改密码</span>
		</div>
		<div class="select mb50">
			<span class="default">请选择验证方式</span>
			<ul>
				<li>请选择验证方式</li>
				<li>邮箱验证</li>
				<li>手机验证</li>
			</ul>
		</div>
		<div class="f24 pl25 black mb50">------</div>
		<div class="codeModule mb50">
			<input type="text" class="input-text code" placeholder="验证码" /> <a
				href="javascript:void(0);" class="input-text codeNumber">获取验证码</a>
		</div>
		<input type="button" class="input-text submit" value="下一步" />
	</form>
</div>
<script type="text/javascript" src="/zmo/static/js/passwordEdit.js"></script>
<script>
function get_phone_number(){
	$.ajax({      
		type: "POST",       
		url: "<?php echo site_url('user/user/get_phone_number')?>",       
		data: "_r=" + Math.random() ,       
		success: function(msg){       
			var info = eval("(" + msg + ")");       
			if(info.ret == 200){         
				$(".black").html('手机号:' + info.info);            
			}     
		}   
	})  		
}

function get_mail(){
	$.ajax({      
		type: "POST",       
		url: "<?php echo site_url('user/user/get_mail')?>",       
		data: "_r=" + Math.random() ,       
		success: function(msg){       
			var info = eval("(" + msg + ")");       
			if(info.ret == 200){         
				$(".black").html('邮箱帐号:' + info.info);    
			}     
		}   
	}) 
}
$(document).ready(function(){
	$(".code").click(function(){
		alert('已发送验证码，请注意查收');
	});
	$(".submit").click(function(){
		$("#post_form").submit();	
	});	
});
</script>