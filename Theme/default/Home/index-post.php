<?php mc_template_part('header'); ?>
	<div class="container">
		<div class="row mb-20 hidden-xs" id="home-top">
			<div class="col-md-12 col">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<?php if(mc_option('homehdimg2')) : ?>
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active">
						</li>
						<li data-target="#carousel-example-generic" data-slide-to="1">
						</li>
						<?php if(mc_option('homehdimg3')) : ?>
						<li data-target="#carousel-example-generic" data-slide-to="2">
						</li>
						<?php endif; ?>
					</ol>
					<?php endif; ?>
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<div class="item active">
							<a class="img-div" href="<?php echo mc_option('homehdlnk1'); ?>" style="background-image: url(<?php echo mc_option('homehdimg1'); ?>);"></a>
						</div>
						<?php if(mc_option('homehdimg2')) : ?>
						<div class="item">
							<a class="img-div" href="<?php echo mc_option('homehdlnk2'); ?>" style="background-image: url(<?php echo mc_option('homehdimg2'); ?>);"></a>
						</div>
						<?php endif; ?>
						<?php if(mc_option('homehdimg3')) : ?>
						<div class="item">
							<a class="img-div" href="<?php echo mc_option('homehdlnk3'); ?>" style="background-image: url(<?php echo mc_option('homehdimg3'); ?>);"></a>
						</div>
						<?php endif; ?>
					</div>
					<?php if(mc_option('homehdimg2')) : ?>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left fa fa-angle-left">
						</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right fa fa-angle-right">
						</span>
					</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="home-main" id="home-main-3">
			<div class="row">
				<div class="col-md-8 col-lg-9">
					<h4 class="title">
						<i class="fa fa-comments-o"></i> 推荐主题
						<a class="pull-right" href="<?php echo U('post/group/index'); ?>"><i class="fa fa-angle-right"></i></a>
					</h4>
					<?php if($page) : ?>
					<div id="article-list">
						<?php foreach($page as $val) : ?>
							<div class="thumbnail">
									<a href="<?php echo mc_get_url($val); ?>" class="img-div"><img src="<?php if(mc_get_meta($val,'tuisong')) : echo mc_get_meta($val,'tuisong'); else : echo mc_fmimg($val); endif; ?>" alt="<?php echo mc_get_page_field($val,'title'); ?>"></a>
									<div class="caption">
										<h3>
											<a href="<?php echo mc_get_url($val); ?>"><?php echo mc_get_page_field($val,'title'); ?></a>
										</h3>
										<p>
											<?php echo mc_cut_str(strip_tags(mc_magic_out(mc_get_page_field($val,'content'))),200); ?>
										</p>
										<ul class="list-inline">
											<li><i class="glyphicon glyphicon-heart-empty"></i> <?php echo mc_xihuan_count($val); ?></li>
											<li><i class="glyphicon glyphicon-star-empty"></i> <?php echo mc_shoucang_count($val); ?></li>
											<li><i class="glyphicon glyphicon-time"></i> <?php if(mc_get_page_field($val,'type')=='article') : echo mc_format_date(mc_get_page_field($val,'date')); else : echo mc_format_date(mc_get_meta($val,'time')); endif; ?></li>
										</ul>
									</div>
							</div>
						<?php endforeach; ?>
					</div>
					<?php echo mc_pagenavi($count,$page_now); ?>
					<?php else : ?>
					<div id="nothing">
						暂无任何推荐主题
					</div>
					<?php endif; ?>
				</div>
				<div class="col-md-4 col-lg-3 hidden-xs hidden-sm">
					<?php mc_template_part('sidebar'); ?>
				</div>
			</div>
		</div>
	</div>
<?php mc_template_part('footer'); ?>