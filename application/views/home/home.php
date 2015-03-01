<?php $this->load->view('public/header.php');?>
<div class="cmlunbo">
    <div class="lunbo_img">
        <div style="display:block"><img src="<?php if(isset($carousel[0]['path']))echo $carousel[0]['path'];?>" /></div>
        <div><img src="<?php if(isset($carousel[1]['path']))echo $carousel[1]['path'];?>" /></div>
        <div><img src="<?php if(isset($carousel[2]['path']))echo $carousel[2]['path'];?>" /></div>
        <div><img src="<?php if(isset($carousel[3]['path']))echo $carousel[3]['path'];?>" /></div>
    </div>
    <div class="button clearfix">
        <div class="left_button"></div>
        <div class="right_button"></div>
    </div>
</div>
<div class="cmbody">
    <!---block start------>
    <div class="block"> 
        <div class="title clearfix">
            <div class="title_line"></div>
            <div class="title_text title1"></div>
            <div class="title_line"></div>
        </div>
        <div class="info">
            <?php $first = array_shift($lesson);?>
            <input id="bigimg_path" type="hidden" value="<?php if(!empty($first))echo $first['img']?>"></input>
            <div class="bigimg">
            <a href="<?php echo site_url('lesson/lesson/info/'.$first['id'])?>">
            <span class="bigimgtext"><div class="bigimgspan">第<?php if(!empty($first))echo $first['sequence']?>期</div><?php echo $first['title']?></span>
            </a>
                <a href="<?php echo site_url('lesson/lesson/info/'.$first['id'])?>"><div class="desc"></div></a>
            </div>
            <div class="imgtab clearfix">
                <?php if(!empty($lesson)){foreach($lesson as $k => $v){?>
                <div class="imgblock imgleft">
                    <a href="<?php echo site_url('lesson/lesson/info/'.$v['id']);?>">
                    <div class="tabimg">
                    <?php if(!empty($v['thumb'])){?>
                    <img src="<?php echo $v['thumb'];?>" />
                    <?php }else{?>
                    <img src="/static/tmp/news1.png" />
                    <?php }?>
                    </div>
                    <div class="tabtitle clearfix">
                        <div class="left number">第<?php echo $v['sequence']?>期</div>
                        <div class="left content_title"><?php echo $v['title'];?></div>
                    </div>
                    </a>
                </div>
                <?php }}?>
            </div>
        </div>
    </div>
    <!---block end---->
    <!---block start------>
    <div class="block">
    	<div class="title clearfix">
        	<div class="title_line"></div>
            <div class="title_text title2"></div>
            <div class="title_line"></div>
        </div>
        <div class="info">
        	<div class="video_img clearfix">
				<?php if(!empty($video)){foreach($video as $k => $v){?>
                <div class="video <?php if($k == 1){ echo 'imglr';}?>">
                	<div class="videoimg">
                        <a href="<?php echo site_url('video/video/info' , array('id' => $v['id']))?>">
                            <img src="<?php echo $v['img'];?>" width="325px"/>
                        </a>
                    </div>
                    <div class="videoname"><?php echo $v['title'];?></div>
                </div>
                <?php }}?>
            </div>
        </div>
    </div>
    <!----block end---->
    
    <!---block start------>
    <div class="block">
    	<div class="title clearfix">
        	<div class="title_line"></div>
            <div class="title_text title3"></div>
            <div class="title_line"></div>
        </div>
        <div class="active clearfix">
        	<a href="<?php echo site_url('active/active/info/'.$active[0]['id']);?>">
        	<div class="active_block acitve_relative">
            	<div>
            	<?php if(!empty($active[0]['img'])){?>
                <img src="<?php echo $active[0]['img'];?>" width="325px" height="450px"/>
                <?php }else{?>
                <img src="/static/tmp/active1.png" width="325px;" height="450px"/>
                <?php }?>
            	</div>
                <div class="active_info">
                	<div class="active_title"><?php echo $active[0]['title'];?></div>
                    <div class="active_desc">
                    	<span class="active_tag"><?php echo $active[0]['theme'];?></span>
                        <?php echo date('m月d日 H:i' , $active[0]['stime']);?>-
                        <?php echo date('H:i' , $active[0]['etime']);?>
                    </div>
                </div>
            </div>
            </a>
            <div class="active_block clearfix activelr">
            	<a href="<?php echo site_url('active/active/info/'.$active[1]['id']);?>">
            	<div class="acitve_relative">
            	<?php if(!empty($active[1]['img'])){?>
                <img src="<?php echo $active[1]['img'];?>" width="325px" height="224px"/>
                <?php }else{?>
                <img src="/static/tmp/active2.png" width="325px;" height="224px"/>
                <?php }?>
                    <div class="active_info">
                        <div class="active_title"><?php echo $active[1]['title'];?></div>
                        <div class="active_desc">
                            <span class="active_tag"><?php echo $active[1]['theme'];?></span>
                            <?php echo date('m月d日 H:i' , $active[1]['stime']);?>-
                        	<?php echo date('H:i' , $active[1]['etime']);?>
                        </div>
                    </div>
                </div>
                </a>
                <a href="<?php echo site_url('active/active/info/'.$active[2]['id']);?>">
                <div style=" margin-top:2px;" class="acitve_relative">
                <?php if(!empty($active[2]['img'])){?>
                <img src="<?php echo $active[2]['img'];?>" width="325px" height="224px"/>
                <?php }else{?>
                <img src="/static/tmp/active3.png" width="325px;" height="224px"/>
                <?php }?>
                    <div class="active_info">
                        <div class="active_title"><?php echo $active[2]['title'];?></div>
                        <div class="active_desc">
                            <span class="active_tag"><?php echo $active[2]['theme'];?></span>
                            <?php echo date('m月d日 H:i' , $active[2]['stime']);?>-
                        	<?php echo date('H:i' , $active[2]['etime']);?>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <a href="<?php if(isset($active[3]['id'])) echo site_url('active/active/info/'.$active[3]['id']);?>">
            <div class="active_block acitve_relative">
            <div>
            	<?php if(!empty($active[3]['img'])){?>
                <img src="<?php echo $active[3]['img'];?>" width="325px" height="450px"/>
                <?php }else{?>
                <img src="/static/tmp/active4.png" width="325px;" height="450px"/>
                <?php }?>
            	</div>
               	<div class="active_info">
                    <div class="active_title"><?php if(isset($active[3]['title']))echo $active[3]['title'];?></div>
                    <div class="active_desc">
                        <span class="active_tag"><?php if(isset($active[3]['theme']))echo $active[3]['theme'];?></span>
                         <?php if(isset($active[3]['stime'])) echo date('m月d日 H:i' , $active[3]['stime']);?>-
                        	<?php if(isset($active[3]['etime'])) echo date('H:i' , $active[3]['etime']);?>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <!----block end---->
    <!---block start------>
    <div class="block">
        <div class="title clearfix">
            <div class="title_line"></div>
            <div class="title_text title4"></div>
            <div class="title_line"></div>
        </div>
        <div class="teacher clearfix">
            <?php if(!empty($teacher)){foreach($teacher as $k=> $v){?>
			<a href="<?php echo site_url('teacher/teacher/info/'.$v['id']);?>">
            <div class="teacher_info">
                <div class="teacher_photo">
                     <img src="<?php echo $v['portrait'];?>" width="250" height="225"/>
                    <span></span>
                </div>
                <div class="teacher_name">
                    <div><?php echo $v['name'];?></div>
                    <div class="teacher_desc" style="margin-left:-10px"><?php echo $v['occ'];?></div>
                </div>
            </div>
			</a>
            <?php }}?>
        </div>
    </div>
    <!----block end---->
    <!---block start------>
    <div class="block">
        <div class="title clearfix">
            <div class="title_line"></div>
            <div class="title_text title5"></div>
            <div class="title_line"></div>
        </div>
        <div class="newinfo clearfix">
            <?php if(!empty($news)){foreach($news as $k => $v){?>
            <a href="<?php echo site_url('news/news/info/'.$v['id']);?>"><div class="newinfo_block">
                <div class="newinfo_img">
                <?php if(!empty($v['img'])){?>
                <img src="<?php echo $v['img'];?>" />
                <?php }else{?>
                <img src="tmp/newinfo1.png" />
                <?php }?>
                </div>
                <div class="newinfo_title"><?php echo $v['title'] ;?></div>
                <div class="newinfo_border"></div>
                <div class="newinfo_desc">
                    <p><?php echo $v['desc'];?></p>
                </div>
                <div class="newinfo_us">BY <?php echo $v['author'] . ' '. date('Y-m-d H:i' , $v['ctime']);?></div>
                <a href="<?php echo site_url('news/news/info/'.$v['id']);?>" class="more">查看详情&gt;&gt;</a>
            </div></a>
            <?php }}?>
        </div>
    </div>
    <!----block end---->
    <!---bg img---->
</div>
<?php $this->load->view('public/footer.php');?>
<script>
$(document).ready(function(){
	var path = $("#bigimg_path").val();
	$(".bigimg").css("background-image","url(" + path + ")");
});
</script>
