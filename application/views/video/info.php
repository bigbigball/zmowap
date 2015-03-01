<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/detail.css" />
<div class="cmbody">
 <ol class="breadcrumb">
 当前位置：
  <li><a href="<?php echo site_url('home/index')?>">首页</a></li>
  <li><a href="<?php echo site_url('video/video/show')?>">视频</a></li>
  <li class="active"><?php echo $info['video_info']['video']['title']?></li>
</ol>
 </div>
<div class="cmbody">
	<div class="clearfix mt40 ">
		<div class="f24 mb20"><?php echo $info['video_info']['video']['title']?></div>
		<div class="f16 mb20" style="color:"><?php echo date('Y年m月d日' , $info['ctime'])?></div>
		<div>
        	<?php echo $info['play_info']['video']['playcode'];?>
        </div>
	</div>
	<div class="item-title mt60">
		<div class="title">
			<h2>视频简介</h2>
		</div>
	</div>
	<div class="clearfix" style="margin-top: 80px;">
		<div>
			<p class="f24 mb20"><?php echo $info['video_info']['video']['desp'];?></p>
		</div>
	</div>
	<div class="item-title mt60">
		<div class="title">
			<h2>学员反馈</h2>
			<div>INTRODUCTION</div>
		</div>
	</div>
	<div class="comment" style="margin-top: 80px;">
		<textarea id="comment">不吐不快</textarea>
		<p class="btn_box">
        	<?php if(!empty($_SESSION['uid'])){?>
        	<span>赶紧留下您独特的建议或想法吧~</span>
			<?php }else{?>
            <span>登录之后才能评论哦~</span>
            <?php }?>
            <input type="button" class="input-text" value="发表"
				onclick="comment_submit();">
		</p>
		<ul class="news_comment_user">
		</ul>
		<strong class="bot" id="news_comment_more">展开查看全部</strong>
	</div>
</div>
<script>
function sign_up(){
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('user/user/is_login')?>",
		data: "_r=" + Math.random(),
		success: function(msg){
			var info = eval("(" + msg + ")");
			if(info.ret != 200){
				alert(info.msg);	
			}else{
				$("#post_form").submit();	
			}
		}	
	});	
}

function comment_submit(){
	var comment_val = $("#comment").val();
	if(comment_val && comment_val != '不吐不快'){
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('comment/do_comment')?>",
			data: "comment=" + comment_val +"&id=<?php echo $info['id'];?>&type=3&_r=" + Math.random(),
			success: function(msg){
				var info = eval("(" + msg + ")");
				if(info.ret != 200){
					alert(info.msg);	
				}else{
					alert(info.msg);
					flush_comment();
				}
			}	
		});	
	}else{
		alert('请填写评论内容');	
	}
}

function flush_comment(p = 0){
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('comment/get_comment')?>",
		data: "id=<?php echo $info['id'];?>&type=3&page="+p+"&_r=" + Math.random(),
		success: function(msg){
			var info = eval("(" + msg + ")");
			if(info.ret == 200){
				if(info.info.list.length > 0){
					var html ='';					 
					for(i = 0 ; i < info.info.list.length ; i ++){
						html += '<div class="news_comment_user_block clearfix comment_line">';
                			html += '<div class="left"><img src="'+info.info.user_info[info.info.list[i].user_id].photo+'" /></div>;'
							html += '<div class="left ml10">';
								html += '<div class="nick_name">'+info.info.user_info[info.info.list[i].user_id].nick_name+'</div>';
								html += '<div class="comment_info">'+info.info.list[i].content+'</div>';
                			html +='</div>';
							html += '<div class="right comment_time">';
							html += info.info.list[i].ctime;
							html += '</div>';
						html += '</div>';	
					}
					$(".news_comment_user").html(html);
				}	
			}else{
				if(p != 0){
					alert(info.msg);
				}
			}
		}	
	});		
}
$(document).ready(function(){
	var page = 0 ;
	$("#comment").focus(function(){
		$(this).html('');	
	}).blur(function(){
			
	});
	flush_comment();
	$(".news_comment_more").click(function(){
		page ++ ;
		flush_comment(page);	
	});
});
</script>

<?php $this->load->view('public/footer.php');?>