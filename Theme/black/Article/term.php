<?php mc_template_part('header'); ?>
	<div class="container">
		<ol class="breadcrumb mb-20" id="baobei-term-breadcrumb">
			<li class="hidden-xs">
				<a href="<?php echo mc_site_url(); ?>">
					首页
				</a>
			</li>
			<li class="hidden-xs">
				<a href="<?php echo U('article/index/index'); ?>">
					文章
				</a>
			</li>
			<?php if(ACTION_NAME=='term') : ?>
			<li class="active hidden-xs">
				<?php echo mc_get_page_field($id,'title'); ?>
			</li>
			<?php elseif(ACTION_NAME=='tag') : ?>
			<li class="active hidden-xs">
				<?php echo $_GET['tag']; ?>
			</li>
			<?php endif; ?>
			<div class="clearfix"></div>
		</ol>
		<div class="row">
			<div class="col-md-8 col">
				<div id="article-list">
				<?php foreach($page as $val) : ?>
				<div class="media mb-20">
						<a href="<?php echo mc_get_url($val['id']); ?>" class="media-left img-div"><img src="<?php echo mc_fmimg($val['id']); ?>" alt="<?php echo $val['title']; ?>"></a>
						<div class="media-body">
							<h4 class="media-heading mb-20">
								<a class="wto" href="<?php echo mc_get_url($val['id']); ?>"><?php echo $val['title']; ?></a>
							</h4>
							<p>
								<?php echo mc_cut_str(strip_tags(mc_magic_out($val['content'])),100); ?>
							</p>
							<?php if(mc_get_meta($val['id'],'tag',false)) : ?>
							<ul id="tags" class="list-inline">
								<li><i class="glyphicon glyphicon-tags"></i></li>
								<?php foreach(mc_get_meta($val['id'],'tag',false) as $tag) : ?>
								<li><a href="<?php echo U('article/index/tag?tag='.$tag); ?>"><?php echo $tag; ?></a></li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
						<div class="clearfix"></div>
				</div>
				<?php endforeach; ?>
				</div>
				<?php echo mc_pagenavi($count,$page_now); ?>
			</div>
			<div class="col-md-4 col">
				<?php mc_template_part('article-side'); ?>
			</div>
		</div>
	</div>
<?php mc_template_part('footer'); ?>