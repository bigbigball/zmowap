<div class="cmfooter">
	<div class="footer_menu clearfix">
		<ul class="clearfix">
			<li class="check_menu"><a href="<?php echo site_url('news/news/aboutus')?>">关于我们</a></li>
			<li><a href="<?php echo site_url('news/news/joinus')?>">加入我们</a></li>
			<li><a href="<?php echo site_url('news/news/help')?>">帮助</a></li>
			<li id="feedback"><a href="javascript:void(0);">意见反馈</a></li>
		</ul>
	</div>
	<div class="footer">
		<div class="clearfix code">
			<div class="weixin">
				<div>
					<img src="/zmo/static/img/weixin.jpg" />
				</div>
				<div class="word">微信公共帐号</div>
			</div>
			<div class="weixin ml40">
				<div>
					<img src="/zmo/static/img/weibo.jpg" />
				</div>
				<div class="word">微博公共帐号</div>
			</div>
		</div>
	</div>
	<div class="site_info">Copyright2014-2015 知识有家 zhishiyoujia.com All rights reserved.京I</div>
</div>
<!--反馈弹框-->
<div class="pop_box" id="pop_feedback" style="display: none">
	<h4>请填写您的反馈意见</h4>
	<a href="javascript:;" class="close"
		onclick="$(this).parent('#pop_feedback').hide()"></a> <input
		type="text" placeholder="请输入您注册时的E－mail" class="text feedbackmail"
		onfocus="if($(this).val()=='请输入您注册时的E－mail'){$(this).val('');}"
		onblur="if($(this).val()==''){$(this).val('请输入您注册时的E－mail');}" />
	<textarea onfocus="if($(this).html()=='请输入您的反馈意见'){$(this).html('');}"
		onblur="if($(this).html()==''){$(this).html('请输入您的反馈意见');}"
		class="feedbackinfo">请输入您的反馈意见</textarea>
	<span class="tip">最多输入200字</span> <input type="button" value="提交"
		class="btn" id="popfeedback" />
</div>
<!--反馈弹框-->
<!--登陆弹框-->
<div class="pop_box" id="pop_login"
	<?php if(!empty($_SESSION['uid'])){?> style="display: none" <?php }?>>
	<a href="javascript:;" class="close"
		onclick="$(this).parent('#pop_login').hide()"></a>
	<div class="tab">
		<img src="/zmo/static/img/logo2.png" class="logo" /> <a
			href="javascript:;" rel="logintab" class="curr">会员登录</a>
		<a href="javascript:;" rel="regtab">会员注册</a>
	</div>
	<div class="login_con">
		<div id="logintab">
			<input type="text" class="text" placeholder="请输入您注册时的E－mail"
				id="floginmail" /> <input class="text" type="password"
				placeholder="您的密码" id="floginpwd" />
			<div class="bot">
				<label><input type="checkbox" />&emsp;记住密码</label> <a
					href="javascript:void(0);">忘记密码</a>
			</div>
			<input type="button" class="btn" value="登录" onclick="flogin();" />
		</div>
	</div>
</div>
<!--登陆弹框-->
</body>
<script>
function flogin(){
	var mail = $("#floginmail").val();
	var pwd = $("#floginpwd").val();
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('user/user/ajax_login')?>",
		data: "mail="+mail+"&pwd="+pwd+"&_r=" + Math.random(),
		success: function(msg){
			var info = eval("(" + msg + ")");
			alert(info.message);
			window.location.href=window.location.href;
		}	
	});
}
$(document).ready(function(){
	$("#feedback").click(function(){
		$("#pop_feedback").show();
	});
	$("#popfeedback").click(function(){
		var mail = $(".feedbackmail").val();
		var info = $(".feedbackinfo").val();
		var mail_reg = /^[-,_,A-Z,a-z,0-9]+@([_,A-Z,a-z,0-9]+\.)+[A-Za-z0-9]{2,3}$/;
		var mail_reg = new RegExp(mail_reg);
		if(!mail_reg.test(mail)){
			alert('请填写正确的邮箱');
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('sms/message/feedback')?>",
				data: "mail="+mail+"&info="+info+"&_r=" + Math.random(),
				success: function(msg){
					var info = eval("(" + msg + ")");
					alert(info.message);
					window.location.href=window.location.href;
				}	
			});
		}
	});
	$(".teacher").children(".teacher_info").each(function(){
		$(this).mouseover(function(){
			$(".teacher").children(".teacher_info").each(function(){
				$(this).children(".teacher_photo").removeClass("check_phone");	
				$(this).children(".teacher_name").removeClass("check_name");
				$(this).children(".teacher_photo").children("img").animate({width:"117px" , height:"117px"} , 0);
				$(this).children(".teacher_name").children(".teacher_desc").removeClass("check_desc");
			});
			$(this).children(".teacher_photo").addClass("check_phone");	
			$(this).children(".teacher_name").addClass("check_name");
			$(this).children(".teacher_photo").children("img").animate({width:"130px" , height:"131px"} , 0);
			$(this).children(".teacher_name").children(".teacher_desc").addClass("check_desc");
		});
		$(this).mouseout(function(){
			$(this).children(".teacher_photo").removeClass("check_phone");	
			$(this).children(".teacher_name").removeClass("check_name");
			$(this).children(".teacher_photo").children("img").animate({width:"117px" , height:"117px"} , 0);
			$(this).children(".teacher_name").children(".teacher_desc").removeClass("check_desc");
		});
	});
//轮播
	var $bigImg=$(".lunbo_img div");
	var i=0;
	var iNow=0;
	function tab(){
		for(i=0; i<$bigImg.length; i++){
			$bigImg.stop().animate({opacity:0}).removeClass("curr");
		}
		$bigImg.eq(iNow).stop().animate({opacity:1}).addClass("curr");
	}
	function turnNext(){
		iNow++;
		if(iNow>=$bigImg.length){
			iNow=0;	
		}
		tab();
	}
	function turnPrev(){
		iNow--;
		if(iNow==0){
			iNow=$bigImg.length-1;	
		}
		tab();
	}		
	var timer=setInterval(turnNext,3000);
	$(".left_button").click(function(){
		clearInterval(timer);
		turnPrev();
		timer=setInterval(turnNext,3000);
	});
	$(".right_button").click(function(){
		clearInterval(timer);
		turnNext();
		timer=setInterval(turnNext,3000);
	});

});
</script>
</html>
