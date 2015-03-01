<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/detail.css" />
<div class="cmbody">
 <ol class="breadcrumb">
 当前位置：
  <li><a href="<?php echo site_url('home/index')?>">首页</a></li>
  <li><a href="<?php echo site_url('active/active/show')?>">活动</a></li>
  <li class="active"><?php echo $info['title'];?></li>
</ol>
 </div>
<div class=" cmbody ">
	<form action="<?php echo site_url('buy/sign_up');?>" method="post"
		enctype="multipart/form-data" id="post_form">
		<div class="clearfix mt40 ">
			<img src="<?php echo $info['img'];?>" title="" alt=""
				class="left mr40" />
			<div>
				<p class="f24 mb20" style="line-height: 35px;"><?php echo $info['title'];?></p>

				<p class="f16 mb20">主题：<?php echo $info['theme']?></p>

				<p class="f16 mb30">地址：<?php echo $info['address'];?></p>

				<p class="f18 mb50">剩余名额：<?php echo ($info['quota'] - $info['sign_num']);?>个</p>

				<div class="btn-box">
				<?php if($is_join){?>
                <a href="javascript:void(0);" class="btn mr30">已报名</a>
                <?php }else{?>
            	<a href="javascript:void(0);" class="btn mr30"
						onclick="sign_up();">报名</a>
                <?php }?>
				<input type="hidden" name="id" id="tid" value="<?php echo $info['id'];?>" />
					<input type="hidden" name="type" value="4">
                 <?php if($is_collect){?>
                <a style="color: #000; font-size: 20px;">已收藏</a>
                <?php }else{?>
                <a href="javascript:void(0);" class="btn"
						style="margin-top: 15px;" onclick="collection('3');">收藏</a>
                <?php }?>
            </div>
			</div>
		</div>
	</form>
	<div class="item-title mt60">

		<div class="title">

			<h2>活动简介</h2>

			<div>INTRODUCTION</div>

		</div>

	</div>

	<div class="introduction" style="margin-top: 90px;">
		<?php echo $info['content'];?>
    </div>

</div>
<script>
function collection(type){
	tid = $("#tid").val();
	if(!tid){
		alert('您没有选择要收藏的活动');	
	}
	if(!type){
		alert('参数错误，请刷新页面');	
	}
	if(tid && type){
		$.ajax({
			type: "POST",
		    url: "<?php echo site_url('collection/collect')?>",
		    data: "type=" + type + "&id=" + tid,
		    success: function(msg){
			  var info = eval("(" + msg + ")");
			  alert(info.msg);
			 window.location.reload();
		    }	
		});	
	}
}
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
$(document).ready(function(){
});
</script>

<?php $this->load->view('public/footer.php');?>
