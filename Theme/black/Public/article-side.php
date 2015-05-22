<div id="article-side" class="mb-20">
	<?php $newpro = M('page')->where('type="pro" AND date > '.strtotime("now").'')->order('date desc')->limit(0,4)->select(); if($newpro) : ?>
	<div id="pro-list">
	<h4 class="title">
						<i class="glyphicon glyphicon-bookmark"></i> 推荐商品
						<a class="pull-right" href="<?php echo U('pro/index/index'); ?>">更多 <i class="fa fa-angle-right"></i></a>
					</h4>
					<div class="row mb-20">
					<?php foreach($newpro as $val) : ?>
					<?php $num_newproa++; ?>
						<div class="col-sm-6 col">
							<div class="thumbnail">
								<?php $fmimg_args = mc_get_meta($val['id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
								<a class="img-div" href="<?php echo mc_get_url($val['id']); ?>"><img src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($val['id'],'title'); ?>"></a>
								<div class="caption">
									<h5>
										<a class="wto" href="<?php echo mc_get_url($val['id']); ?>"><?php echo mc_get_page_field($val['id'],'title'); ?></a>
									</h5>
									<p class="price pull-left">
										<span><?php echo mc_price_now($val['id']); ?></span> <small>元</small>
									</p>
									<?php if(mc_get_meta($val['id'],'kucun')<=0) : ?>
									<button type="button" class="btn btn-default btn-xs pull-right">
										<i class="icon-umbrella"></i> 暂时缺货
									</button>
									<?php else : ?>
										<?php if(mc_user_id()) : ?>
										<a href="<?php echo U('home/perform/add_cart','id='.$val['id'].'&number=1'); ?>" class="btn btn-primary btn-xs pull-right">
											<i class="glyphicon glyphicon-plus"></i> 加入购物车
										</a>
										<?php else : ?>
										<a href="#" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#loginModal">
											<i class="glyphicon glyphicon-plus"></i> 加入购物车
										</a>
										<?php endif; ?>
									<?php endif; ?>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
	</div>
	<?php endif; ?>
	<h4 class="title mb-10 mt-0">
						<i class="glyphicon glyphicon-comment"></i> 热门文章
					</h4>
					<ul class="list-group mb-0">
					<?php 
							$Model = new \Think\Model();
							$newarticle = $Model->query("select page_id from __PREFIX__meta where meta_key='views' and page_id in (select id from __PREFIX__page where type='pro') order by meta_value desc limit 0,4");
					?>
					<?php foreach($newarticle as $valart) : ?>
					<li class="list-group-item" id="mc-page-<?php echo $valart['page_id']; ?>">
						<a class="wto" href="<?php echo mc_get_url($valart['page_id']); ?>"><?php echo mc_get_page_field($valart['page_id'],'title'); ?></a>
					</li>
					<?php endforeach; ?>
					</ul>
	
</div>
<?php echo mc_option('sidebar'); ?>