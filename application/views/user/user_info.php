<div class="userInfo clearfix">
	<div class="avastar">
    	<?php if(!empty($user_info)){?>
        <?php if($user_info['from'] == 1){?>
        <img
			src="http://tb.himg.baidu.com/sys/portrait/item/<?php echo $user_info['portrait'];?>"
			alt="" title="" height="154px" width="187px;" />
        <?php }else{?>
        <img src="<?php echo $user_info['photo'];?>" alt="" title="" />
        <?php }?>
        <?php }else{?>
         <img src="/zmo/static/img/avastarTmp.jpg" alt="" title="" />
        <?php }?>
        <!--<div class="shadow"></div>-->
		<!--a href="" class="uploadBtn">上传头像</a-->
	</div>
	<div class="info">
    	<?php if(!empty($user_info)){?>
        <h2><?php echo $user_info['nick_name'];?></h2>
		<p>职业：<?php echo $user_info['occu']?></p>
        <?php }?>
    </div>
</div>
