<?php mc_template_part('header'); ?>
	<div class="container">
		<ol class="breadcrumb mb-10" id="baobei-term-breadcrumb">
			<li class="hidden-xs">
				<a href="<?php echo mc_site_url(); ?>">
					首页
				</a>
			</li>
			<?php if(MODULE_NAME=='Home') : ?>
			<li class="hidden-xs">
				商品
			</li>
			<li class="active hidden-xs">
				搜索 - <?php echo $_GET['keyword']; ?>
			</li>
			<?php else : ?>
			<li class="active hidden-xs">
				商品
			</li>
			<?php endif; ?>
			<div class="clearfix"></div>
		</ol>
		<?php 
			$args_id = M('meta')->where("meta_key='parent' AND meta_value>'0' AND type='term'")->getField('page_id',true);
			if($args_id) :
			$condition['id']  = array('not in',$args_id);
			endif;
			$condition['type']  = 'term_pro';
			$terms_pro = M('page')->where($condition)->order('id desc')->select(); 
			if($terms_pro) :
		?>
		<ul class="nav nav-pills mb-10 term-list" role="tablist">
		<?php foreach($terms_pro as $val) : ?>
			<li role="presentation">
				<a href="<?php echo U('pro/index/term?id='.$val['id']); ?>">
					<?php echo $val['title']; ?>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
		<?php endif; ?>
		<div class="row" id="pro-list-t">
			<?php foreach($page as $val) : ?>
			<div class="col-sm-6 col-md-4 col-lg-3 col">
				<div class="thumbnail">
					<?php $fmimg_args = mc_get_meta($val['id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<a class="img-div" href="<?php echo mc_get_url($val['id']); ?>"><img src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo $val['title']; ?>"></a>
					<div class="caption">
						<h4>
							<a class="wto" href="<?php echo mc_get_url($val['id']); ?>"><?php echo $val['title']; ?></a>
						</h4>
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
		<?php echo mc_pagenavi($count,$page_now); ?>
	</div>
<?php mc_template_part('footer'); ?>