<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZMO自媒体平台</title>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/globle.css" />
<link rel="stylesheet" type="text/css" href="/zmo/static/style/home.css" />
<script type="text/javascript" src="/zmo/static/js/jquery.min.js"></script>
</head>

<body>
	<div class="cmheader">
		<div class="header_menu">
			<div class="header_login">
            <?php if(!empty($_SESSION['uid'])){?>
                <a href="<?php echo site_url('user/user/center')?>"><?php echo $_SESSION['uname']?>欢迎您回来～</a><span
					style="margin: 0px 20px; width: 1px; background-color: #fff; height: 15px; display: inline-block;"></span><a
					href="<?php echo site_url('user/user/loginout');?>">退出登陆</a>
            <?php }else{?>
                <a href="<?php echo site_url('user/user/login');?>">登录</a><span
					style="margin: 0px 15px; color: #fff; height: 15px; display: inline-block;"></span>
				<a href="<?php echo site_url('user/user/regist');?>" style="margin-right:19px">注册</a>
            <?php }?>
        </div>
			<div class="clearfix" style="margin-top: 10px;">
				<div class="header_logo left">
					<a href="/zmo/index.php/home/index.html"><img src="/zmo/static/img/logo.png" /></a>
				</div>
				<div class="header_menu_list right">
					<ul class="clearfix top_menu">
						<li <?php if($haction == 'home'){?> class="check_menu" <?php }?>><a
							href="<?php echo site_url('home/index');?>">首页</a></li>
						<li <?php if($haction == 'lesson'){?> class="check_menu" <?php }?>><a
							href="<?php echo site_url('lesson/lesson/show');?>">课程</a></li>
						<li <?php if($haction == 'video'){?> class="check_menu" <?php }?>><a
							href="<?php echo site_url('video/video/show');?>">视频</a></li>
						<li <?php if($haction == 'active'){?> class="check_menu" <?php }?>><a
							href="<?php echo site_url('active/active/show');?>">活动</a></li>
						<li <?php if($haction == 'teacher'){?> class="check_menu"
							<?php }?>><a
							href="<?php echo site_url('teacher/teacher/show');?>">导师</a></li>
						<li <?php if($haction == 'news'){?> class="check_menu" <?php }?>><a
							href="<?php echo site_url('news/news/show');?>">资讯</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>