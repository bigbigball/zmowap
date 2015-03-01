$(document).ready(function() {
//tab切换
function tab(){
	$(this).addClass("curr").siblings().removeClass("curr");
	var tabName=$(this).attr("rel");	
	$("#"+tabName).show().siblings().hide();
}
$(".tab a").mousedown(tab);    
});