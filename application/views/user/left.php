<ul class="leftMenu">
	<li <?php if($action == 'order'){?> class="active" <?php }?>>
		<h3>我的订单</h3>
		<ul>
			<li><a
				href="<?php echo site_url('user/user/order',array('action' => 'my_order_pay'));?>">已支付</a></li>
			<li><a
				href="<?php echo site_url('user/user/order',array('action' => 'my_order_nopay'));?>">未支付</a></li>
			<li><a
				href="<?php echo site_url('user/user/order',array('action' => 'my_order_error'));?>">支付异常</a></li>
		</ul>
	</li>
	<li <?php if($action == 'collect'){?> class="active" <?php }?>>
		<h3>我的收藏</h3>
		<ul>
			<li><a
				href="<?php echo site_url('user/user/collect',array('action' => 'collect_lesson'));?>">课程</a></li>
			<li><a
				href="<?php echo site_url('user/user/collect',array('action' => 'collect_active'));?>">活动</a></li>
			<li><a
				href="<?php echo site_url('user/user/collect',array('action' => 'collect_tutor'));?>">导师</a></li>
		</ul>
	</li>
	<!--li <?php if($action == 'sms'){?>class="active"<?php }?>>
        <h3>我的消息</h3>
        <ul>
            <li><a href="<?php echo site_url('user/user/sms',array('action' => 'sms_contacts'));?>">人脉消息</a></li>
            <li><a href="<?php echo site_url('user/user/sms',array('action' => 'sms_order'));?>">订单消息</a></li>
            <li><a href="<?php echo site_url('user/user/sms',array('action' => 'sms_push'));?>">推送消息</a></li>
        </ul>
    </li>
    <li <?php if($action == 'other'){?>class="active"<?php }?>>
        <h3>其他</h3>
        <ul>
            <li><a href="<?php echo site_url('user/user/other',array('action' => 'bind_phone'));?>">绑定手机</a></li>
            <li><a href="<?php echo site_url('user/user/other',array('action' => 'verify_mail'));?>">验证邮箱</a></li>
            <li><a href="<?php echo site_url('user/user/other',array('action' => 'passwd_manage'));?>">密码管理</a></li>
        </ul>
    </li-->
</ul>