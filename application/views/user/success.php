<div class="passwordSuccess">
	<p class="mb75">
		<img src="/zmo/static/img/icon_success.png" alt="密码修改成功" />
	</p>
	<p class="successTip mb50"><?php echo $msg ;?>，跳转中（<span id="seconde">3</span>秒）……
	</p>
	<p class="f26">
		页面未跳转请您<a href="javascript:void();" class="blue f26">点击刷新</a>
	</p>
</div>
<script>
var s = 3, t;
function settime(){
	s--;
	$("#seconde").html(s);
	t = setTimeout('settime()', 1000);
	if ( s <= 0 ){
		s = 5;
		clearTimeout(t);
		window.location.href="<?php echo $url ;?>";
	}
}
$(document).ready(function(){
	$(document).ready(function(){
		setTimeout("settime()", 1000);
	});
	$(".blue").click(function(){
			
	});
});
</script>
