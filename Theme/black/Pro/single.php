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
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col">
				<div id="single-top">
					<div class="mb-40">
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
								<h3>
									<div class="row">
										<div class="col-xs-6 col">
											<span id="price" price-data="<?php echo mc_get_meta($val['id'],'price'); ?>"><?php echo mc_price_now($val['id']); ?></span> 元
										</div>
										<div class="col-xs-6 col text-right">
											<small>库存：<?php echo mc_get_meta($val['id'],'kucun'); ?></small>
											<small>销量：<?php echo mc_get_meta($val['id'],'xiaoliang'); ?></small>
										</div>
									</div>
								</h3>
								<form method="post" action="<?php echo U('home/perform/add_cart'); ?>" id="pro-single-form">
								<?php $parameter = M('option')->where("meta_key='parameter' AND type='pro'")->select(); if($parameter) : foreach($parameter as $par) : ?>
								<?php $pro_parameter = mc_get_meta($val['id'],$par['id'],false,'parameter'); if($pro_parameter) : ?>
								<h4 class="pro-par-list-title"><?php echo $par['meta_value']; ?></h4>
								<ul class="list-inline pro-par-list" id="par-list-<?php echo $par['id']; ?>">
								<?php $num=0; ?>
								<?php foreach($pro_parameter as $pro_par) : $num++; ?>
									<?php 
										$price = M('meta')->where("page_id='".$val['id']."' AND meta_key='$pro_par' AND type ='price'")->getField('meta_value');
									?>
									<li>
										<label <?php if($num==1) echo 'class="active"'; ?> price-data="<?php if($price) : echo $price; else : echo '0'; endif; ?>">
											<span><?php echo $pro_par; ?></span>
											<input type="radio" name="parameter[<?php echo $par['id']; ?>]" value="<?php echo $pro_par; ?>"  <?php if($num==1) echo 'checked'; ?>>
										</label>
									</li>
								<?php endforeach; ?>
								<script>
									$('#par-list-<?php echo $par['id']; ?> label').click(function(){
										$('#par-list-<?php echo $par['id']; ?> label').removeClass('active');
										$(this).addClass('active');
										var price_now = $('#price').attr('price-data')*1;
										$.each($('.pro-par-list label.active'),function(){
											price_now += parseInt($(this).attr('price-data'));
										});
										$('#price').text(price_now);
									});
								</script>
								</ul>
								<?php endif; ?>
								<?php endforeach; endif; ?>
								<div class="form-group">
									<?php if(mc_get_meta($val['id'],'kucun')<=0) : ?>
									<button type="button" class="btn btn-default">
										<i class="icon-umbrella"></i> 暂时缺货
									</button>
									<?php else : ?>
									<div class="btn-group">
										<div class="btn-group">
											<button type="button" class="btn btn-warning dropdown-toggle select-number" data-toggle="dropdown">
												购买数量：<span id="buy-num">1</span>
												<span class="caret">
												</span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<?php do { $i++; ?>
												<li>
													<a href="javascript:;">
														<?php echo $i; ?>
													</a>
												</li>
												<?php } while ($i < 10); ?>
											</ul>
										</div>
										<?php if(mc_user_id()) : ?>
										<button type="submit" class="btn btn-warning add-cart">
											<i class="glyphicon glyphicon-plus"></i> 加入购物车
										</button>
										<?php else : ?>
										<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#loginModal">
											<i class="glyphicon glyphicon-plus"></i> 加入购物车
										</button>
										<?php endif; ?>
									</div>
									<?php endif; ?>
								</div>
								<div class="form-group">
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
								</script>
								<input id="buy-num-input" type="hidden" name="number" value="1">
								<input type="hidden" value="<?php echo $val['id']; ?>" name="id">
								</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="pro-single" class="mb-40">
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
								<a href="<?php echo U('publish/index/edit?id='.$val['id']); ?>" class="btn btn-primary">
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
				<h4 class="title">商品评论</h4>
				<?php echo W("Comment/index",array($val['id'])); ?>
			</div>
			<div class="col-sm-3 col">
				<div id="post-list-side">
					<h4 class="title mb-10 mt-0">
						<i class="glyphicon glyphicon-bookmark"></i> 推荐商品
						<a class="pull-right" href="<?php echo U('pro/index/term?id='.$term_id); ?>">
							更多 <i class="fa fa-angle-right"></i>
						</a>
					</h4>
					<?php 
					$condition['type'] = 'pro';
			        $args_id = M('meta')->where("meta_key='term' AND meta_value='$term_id' AND page_id<>'".$val['id']."' AND type='basic'")->getField('page_id',true);
			        $condition['id']  = array('in',$args_id);
				    $page_pro = M('page')->where($condition)->order('date desc')->limit(0,4)->select();
					if($page_pro) :
					?>
					<ul class="list-group mb-20">
					<?php foreach($page_pro as $val_pro) : ?>
					<?php $fmimg_args = mc_get_meta($val_pro['id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<li class="list-group-item" id="mc-page-<?php echo $val_pro['id']; ?>">
						<a href="<?php echo mc_get_url($val_pro['id']); ?>" class="wto">
							<div class="img-div mb-10">
								<img src="<?php echo $fmimg_args[0]; ?>">
							</div>
							<p><?php echo $val_pro['title']; ?></p>
							<?php echo mc_price_now($val_pro['id']); ?>元
						</a>
					</li>
					<?php endforeach; ?>
					</ul>
					<?php else : ?>
					<div class="nothing">
						没有任何相关商品
					</div>
					<?php endif; ?>
					<h4 class="title mb-10 mt-0">
						<i class="glyphicon glyphicon-comment"></i> 相关话题
						<a class="pull-right" href="<?php echo U('post/group/single?id='.$val['id']); ?>">
							更多 <i class="fa fa-angle-right"></i>
						</a>
					</h4>
					<?php 
					$condition['type'] = 'publish';
			        $args_id = M('meta')->where("meta_key='group' AND meta_value='".$val['id']."'")->getField('page_id',true);
			        $condition['id']  = array('in',$args_id);
				    $page_group = M('page')->where($condition)->order('date desc')->limit(0,5)->select();
					if($page_group) :
					?>
					<ul class="list-group mb-0">
					<?php foreach($page_group as $val_group) : ?>
					<li class="list-group-item" id="mc-page-<?php echo $val_group['id']; ?>">
						<a class="wto" href="<?php echo mc_get_url($val_group['id']); ?>"><?php echo $val_group['title']; ?></a>
					</li>
					<?php endforeach; ?>
					</ul>
					<?php else : ?>
					<div class="nothing">
						<a rel="nofollow" href="<?php echo U('post/group/single?id='.$val['id']); ?>">发表新话题</a>
					</div>
					<?php endif; ?>
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
<?php mc_template_part('footer'); ?>