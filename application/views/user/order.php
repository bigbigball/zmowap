<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/order.css" />
<div class="cmbody">
	<div class="mt40 order clearfix">
		<div class="left">
        	<?php $this->load->view('user/left.php');?>
        </div>
		<div class="content">
			<?php $this->load->view('user/user_info.php');?>
            <div class="orderList">
				<div class="title clearfix">
					<div class="name">名称</div>
					<div class="pay">实付款（元）</div>
					<div class="status">状态</div>
				</div>
				<ul>
                	<?php if(!empty($order['order'])){foreach($order['order'] as $k => $v){?>
                	<li>
						<div class="detail">
                        	<?php echo date('Y年m月d日' , $v['ctime']);?>
                            <span class="ml30">编号：<?php echo $v['order_sn']?></span>
						</div>
						<div class="clearfix info">
							<div class="name">
								<div class="left productImg">
									<img src="/zmo/static/img/orderTmp.jpg" alt="" title="" />
									<!--span>视频课程</span-->
								</div><?php echo $order['order_goods'][$v['id']]['goods_title'];?>
                            </div>
							<div class="pay"><p><?php echo $v['price'];?></p></div>
							<div class="status">
                            	<?php if($v['status'] == 2){?>
                                <p>已支付</p>
                                <?php }else if($v['status'] == 0){?>
								<p><a href="<?php echo
                                site_url('order/order/buy',array('oid' => $v['id']));?>"
                                class="btn">支付</a></p>
                                <?php }?>
                            </div>
						</div>
					</li>
                    <?php }}else{?>
					<li style="border: 0px;">
						<div style="text-align: center; font-size: 18px;">没有相关数据</div>
					</li>
					<?php }?>
                </ul>
			</div>
			<!-- 分页开始 -->
			<!--div class="pagination">
                <a href="" class="prev">上一页</a>
                <a class="current" href="">1</a>
                <a href="">2</a>
                <a href="">3</a>
                <a href="">4</a>
                <a href="">5</a>
                <a href="">6</a>
                <span>...</span>
                <a href="">10</a>
                <a href="" class="next">下一页</a>
            </div-->
		</div>
	</div>
</div>
<script>
$(document).ready(function(){

})
</script>

<?php $this->load->view('public/footer.php');?>
