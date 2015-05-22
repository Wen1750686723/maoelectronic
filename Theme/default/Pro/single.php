<?php mc_template_part('header'); ?>
	<?php foreach($page as $val) : ?>
	<div class="container">
		<ol class="breadcrumb" id="baobei-breadcrumb">
			<li>
				<a href="<?php echo mc_site_url(); ?>">
					首页
				</a>
			</li>
			<li>
				<a href="<?php echo U('pro/index/index'); ?>">
					商品
				</a>
			</li>
			<?php $term_id = mc_get_meta($val['id'],'term'); $parent = mc_get_meta($term_id,'parent',true,'term'); if($parent) : ?>
			<li class="hidden-xs">
				<a href="<?php echo U('pro/index/term?id='.$parent); ?>">
					<?php echo mc_get_page_field($parent,'title'); ?>
				</a>
			</li>
			<?php endif; ?>
			<li>
				<a href="<?php echo U('pro/index/term?id='.$term_id); ?>">
					<?php echo mc_get_page_field($term_id,'title'); ?>
				</a>
			</li>
			<li class="active hidden-xs">
				<?php echo $val['title']; ?>
			</li>
		</ol>
	</div>
	<div id="single-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-6" id="pro-index-tl">
					<div id="pro-index-tlin">
					<?php $fmimg_args = mc_get_meta($val['id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php foreach($fmimg_args as $fmimg) : ?>
							<?php $fmimg_num++; ?>
							<li data-target="#carousel-example-generic" data-slide-to="<?php echo $fmimg_num-1; ?>" class="<?php if($fmimg_num==1) echo 'active'; ?>"></li>
							<?php endforeach; ?>
						</ol>
						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<?php $fmimg_num=0; ?>
							<?php foreach($fmimg_args as $fmimg) : ?>
							<?php $fmimg_num++; ?>
							<div class="item <?php if($fmimg_num==1) echo 'active'; ?>">
								<div class="imgshow"><img src="<?php echo $fmimg; ?>" alt="<?php echo $val['title']; ?>"></div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					</div>
				</div>
				<div class="col-sm-6" id="pro-index-tr">
					<div id="pro-index-trin">
					<h1>
						<?php echo $val['title']; ?>
					</h1>
					<div class="h3s">
						<div class="row">
							<div class="col-xs-8 col">
								<div class="pull-left mr-20">现价：<span id="price" price-data="<?php echo mc_get_meta($val['id'],'price'); ?>"><?php echo mc_price_now($val['id']); ?></span> 元</div>
								<?php if(mc_get_meta($val['id'],'price-old')) : ?>
								<del class="pull-left" id="price-old">原价：<?php echo mc_get_meta($val['id'],'price-old'); ?> 元</del>
								<?php endif; ?>
								<div class="clearfix"></div>
								<div class="pull-left">库存：<span id="kucun"><?php echo mc_kucun_now($val['id']); ?></span></div>
							</div>
							<div class="col-xs-4 col text-right">
								<small>总销量：<?php echo mc_get_meta($val['id'],'xiaoliang'); ?></small>
							</div>
						</div>
					</div>
					<form method="post" action="<?php echo U('home/perform/add_cart'); ?>" id="pro-single-form">
					<?php $parameter = M('option')->where("meta_key='parameter' AND type='pro'")->select(); if($parameter) : $parameter = array_reverse($parameter); foreach($parameter as $par) : ?>
					<?php $pro_parameter = mc_get_meta($val['id'],$par['id'],false,'parameter'); if($pro_parameter) : ?>
					<h4 class="pro-par-list-title"><?php echo $par['meta_value']; ?></h4>
					<ul class="list-inline pro-par-list" id="par-list-<?php echo $par['id']; ?>">
					<?php $num=0; ?>
					<?php foreach($pro_parameter as $pro_par) : $num++; ?>
						<?php 
							$price = M('meta')->where("page_id='".$val['id']."' AND meta_key='$pro_par' AND type ='price'")->getField('meta_value');
							$kucun = M('meta')->where("page_id='".$val['id']."' AND meta_key='$pro_par' AND type ='kucun'")->getField('meta_value');
						?>
						<li>
							<label <?php if($num==1) echo 'class="active"'; ?> price-data="<?php if($price) : echo $price; else : echo '0'; endif; ?>" kucun-data="<?php if($kucun) : echo $kucun; else : echo '0'; endif; ?>">
								<span><?php echo $pro_par; ?></span>
								<input type="radio" name="parameter[<?php echo $par['id']; ?>]" value="<?php echo $pro_par; ?>"  <?php if($num==1) echo 'checked'; ?>>
							</label>
						</li>
					<?php endforeach; ?>
					<script>
						$('#par-list-<?php echo $par['id']; ?> label').click(function(){
							$('#par-list-<?php echo $par['id']; ?> label').removeClass('active');
							$(this).addClass('active');
							//价格
							var price_now = $('#price').attr('price-data')*1;
							$.each($('.pro-par-list label.active'),function(){
								price_now += parseInt($(this).attr('price-data'));
							});
							$('#price').text(price_now);
							//库存
							var kucun_now = 0;
							$.each($('.pro-par-list label.active'),function(){
								kucun_now1 = parseInt($(this).attr('kucun-data'));
								if(kucun_now==0) {
									kucun_now = kucun_now1;
								} else if(kucun_now1<kucun_now) {
									kucun_now = kucun_now1;
								};
							});
							$('#kucun').text(kucun_now);
							if(kucun_now>0) {
								$('.buy-btn-1').css('display','block');
								$('.buy-btn-2').css('display','none');
							} else {
								$('.buy-btn-1').css('display','none');
								$('.buy-btn-2').css('display','block');
							};
						});
					</script>
					</ul>
					<?php endif; ?>
					<?php endforeach; endif; ?>
					<div class="form-group">
						<label>选择数量</label>
						<div class="row mb-20">
							<div class="col-md-6">
								<div class="input-group input-group-lg">
									<span class="input-group-addon select-number num-minus">
										-
									</span>
									<input type="text" id="buy-num-input" class="form-control text-center" value="1" name="number">
									<span class="input-group-addon select-number num-plus">
										+
									</span>
								</div>
							</div>
						</div>
						<div class="btn-group buy-btn-2" style="display:<?php if(mc_kucun_now($val['id'])<=0) : ?>block<?php else : ?>none<?php endif; ?>">
							<button type="button" class="btn btn-default">
								<i class="fa fa-umbrella"></i> 暂时缺货
							</button>
						</div>
						<div class="btn-group buy-btn-1" style="display:<?php if(mc_kucun_now($val['id'])<=0) : ?>none<?php else : ?>block<?php endif; ?>">
							<?php if(mc_user_id()) : ?>
							<button type="submit" class="btn btn-warning add-cart">
								<i class="glyphicon glyphicon-plus"></i> 加入购物车
							</button>
							<?php else : ?>
							<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#loginModal">
								<i class="glyphicon glyphicon-plus"></i> 加入购物车
							</button>
							<?php endif; ?>
							<?php if(mc_get_meta($val['id'],'tb_name') && mc_get_meta($val['id'],'tb_url')) : ?>
							<a class="btn btn-default ml-10" target="_blank" rel="nofollow" href="<?php echo mc_get_meta($val['id'],'tb_url'); ?>">
								<i class="glyphicon glyphicon-send"></i> 去<?php echo mc_get_meta($val['id'],'tb_name'); ?>购买
							</a>
							<?php endif; ?>
						</div>
					</div>
					<div class="clearfix"></div>
					<?php if(mc_kucun_now($val['id'])>0) : ?>
					<div class="form-group buy-btn-1">
						<button type="submit" class="wish">
							<i class="fa fa-heart-o"></i> 我想要
						</button>
					</div>
					<script>
						$('.add-cart').hover(function(){
							$('#pro-single-form').attr('action','<?php echo U('home/perform/add_cart'); ?>');
						});
						$('.wish').hover(function(){
							$('#pro-single-form').attr('action','<?php echo U('publish/index/add_post?group='.$val['id'].'&wish=1'); ?>');
						});		
						$('#pro-index-trin .num-minus').click(function(){
							var num = $('#buy-num-input').val()*1;
							if(num>1) {
								$('#buy-num-input').val(num-1);
							};
						});	
						$('#pro-index-trin .num-plus').click(function(){
							var num = $('#buy-num-input').val()*1;
							var kucun = $('#kucun').text()*1;
							if(num<kucun) {
								$('#buy-num-input').val(num+1);
							};
						});
						$('#buy-num-input').keyup(function(){
							var num = $(this).val()*1;
							var kucun = $('#kucun').text()*1;
							if(num<1) {
								$(this).val(1);
							} else if(num>kucun) {
								$(this).val(kucun);
							};
						});
					</script>
					<?php endif; ?>
					<input type="hidden" value="<?php echo $val['id']; ?>" name="id">
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		
	<div id="pro-single" class="mb-20">
		<div class="row">
			<div class="col-sm-12" id="single">
				<div id="entry">
					<?php echo mc_magic_out($val['content']); ?>
				</div>
				<hr>
				<div class="text-center">
					<?php echo mc_xihuan_btn($val['id']); ?> 
					<?php echo mc_shoucang_btn($val['id']); ?> 
					<?php if(mc_is_admin() && mc_is_bianji()) : ?>
					<a href="<?php echo U('publish/index/edit?id='.$val['id']); ?>" class="btn btn-info">
						<i class="glyphicon glyphicon-edit"></i> 编辑
					</a>
					<button class="btn btn-default" data-toggle="modal" data-target="#myModal">
						<i class="glyphicon glyphicon-trash"></i> 删除
					</button>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="home-main">
		<h4 class="title mb-10">
			<i class="glyphicon glyphicon-star"></i> 推荐商品
		</h4>
	</div>
	
	<?php 
		$args_id = M('meta')->where("meta_key='term' AND meta_value='$term_id' AND type='basic' AND page_id!='".$val['id']."'")->getField('page_id',true);
		if($args_id) :
		$condition['id']  = array('in',$args_id);
		$condition['type'] = 'pro';
	    $page_term = M('page')->where($condition)->order('date desc')->page(1,4)->select();
	    endif;
	?>
		<div class="row mb-20" id="pro-list">
			<?php foreach($page_term as $val_term) : ?>
			<div class="col-sm-6 col-md-4 col-lg-3 col">
				<div class="thumbnail">
					<?php $fmimg_args = mc_get_meta($val_term['id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<a class="img-div" href="<?php echo mc_get_url($val_term['id']); ?>"><img src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo $val_term['title']; ?>"></a>
					<div class="caption">
						<h4>
							<a href="<?php echo mc_get_url($val_term['id']); ?>"><?php echo $val_term['title']; ?></a>
						</h4>
						<p class="price pull-left">
							<span><?php echo mc_price_now($val_term['id']); ?></span> <small>元</small>
						</p>
						<?php if(mc_kucun_now($val_term['id'])<=0) : ?>
						<button type="button" class="btn btn-default btn-xs pull-right">
							<i class="icon-umbrella"></i> 暂时缺货
						</button>
						<?php else : ?>
							<?php if(mc_user_id()) : ?>
							<a href="<?php echo U('home/perform/add_cart','id='.$val_term['id'].'&number=1'); ?>" class="btn btn-warning btn-xs pull-right">
								<i class="glyphicon glyphicon-plus"></i> 加入购物车
							</a>
							<?php else : ?>
							<a href="#" class="btn btn-warning btn-xs pull-right" data-toggle="modal" data-target="#loginModal">
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
	<div class="home-main">
		<div class="row mb-20">
			<div class="col-sm-12" id="post-list-default">
				<h4 class="title mb-10">
					<i class="fa fa-globe"></i> 相关话题 
					<a class="pull-right" href="<?php echo U('post/group/single?id='.$val['id']); ?>">
						<i class="fa fa-angle-right"></i>
					</a>
				</h4>
				<?php 
				
		        $args_id = M('meta')->where("meta_key='group' AND meta_value='$id'")->getField('page_id',true);
		        if($args_id) :
		        $condition['type'] = 'publish';
		        $condition['id']  = array('in',$args_id);
			    $page_group = M('page')->where($condition)->order('date desc')->page(1,5)->select();
			    endif;
				if($page_group) :
				?>
				<ul class="list-group mb-0">
				<?php foreach($page_group as $val_group) : ?>
				<li class="list-group-item" id="mc-page-<?php echo $val_group['id']; ?>">
					<div class="row">
						<div class="col-sm-6 col-md-7 col-lg-8">
							<div class="media">
								<?php $author_group = mc_get_meta($val_group['id'],'author',true); ?>
								<a class="media-left" href="<?php echo mc_get_url($author_group); ?>">
									<div class="img-div">
										<img class="media-object" src="<?php echo mc_user_avatar($author_group); ?>" alt="<?php echo mc_user_display_name($author_group); ?>">
									</div>
								</a>
								<div class="media-body">
									<h4 class="media-heading">
										<a href="<?php echo mc_get_url($val_group['id']); ?>"><?php echo $val_group['title']; ?></a>
									</h4>
									<p class="post-info">
										<i class="glyphicon glyphicon-user"></i><a href="<?php echo mc_get_url($author_group); ?>"><?php echo mc_user_display_name($author_group); ?></a>
										<i class="glyphicon glyphicon-time"></i><?php echo date('Y-m-d H:i:s',$val_group['date']); ?>
									</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-5 col-lg-4 text-right">
							<ul class="list-inline">
							<?php if(mc_last_comment_user($val_group['id'])) : ?>
							<li>最后：<?php echo mc_user_display_name(mc_last_comment_user($val_group['id'])); ?></li>
							<?php endif; ?>
							<li>点击：<?php echo mc_views_count($val_group['id']); ?></li>
							</ul>
						</div>
					</div>
				</li>
				<?php endforeach; ?>
				</ul>
				<div class="text-center">
					<a rel="nofollow" class="btn btn-default btn-sm mt-10" href="<?php echo U('post/group/single?id='.$val['id']); ?>">发表新话题</a>
				</div>
				<?php else : ?>
				<div id="nothing">
					没有任何相关话题！<a rel="nofollow" href="<?php echo U('post/group/single?id='.$val['id']); ?>">发表新话题</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<h4 class="title mb-0">
			<i class="fa fa-comments"></i> 商品评论
		</h4>
	</div>
	<div id="pro-single">
		<div class="row">
			<div class="col-sm-12 pt-0" id="single">
				<?php echo W("Comment/index",array($val['id'])); ?>
			</div>
		</div>
	</div>
	</div>
	<?php if(mc_is_admin()) : ?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						
					</h4>
				</div>
				<div class="modal-body text-center">
					确认要删除这篇文章吗？
				</div>
				<div class="modal-footer" style="text-align:center;">
					<form method="post" action="<?php echo U('home/perform/delete'); ?>">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="glyphicon glyphicon-remove"></i> 取消
					</button>
					<button type="submit" class="btn btn-danger">
						<i class="glyphicon glyphicon-ok"></i> 确定
					</button>
					<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<?php endif; ?>
	<?php endforeach; ?>
	<?php if(mc_prev_page_id($val['id'])) : ?>
	<a class="prev_btn np_page_btn" href="<?php echo mc_get_url(mc_prev_page_id($val['id'])); ?>">
		<i class="fa fa-chevron-circle-left"></i>
	</a>
	<?php endif; ?>
	<?php if(mc_next_page_id($val['id'])) : ?>
	<a class="next_btn np_page_btn" href="<?php echo mc_get_url(mc_next_page_id($val['id'])); ?>">
		<i class="fa fa-chevron-circle-right"></i>
	</a>
	<?php endif; ?>
<?php mc_template_part('footer'); ?>