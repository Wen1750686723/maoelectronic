<?php mc_template_part('header'); ?>
	<div class="container">
		<ol class="breadcrumb mb-20" id="baobei-term-breadcrumb">
			<li>
				<a href="<?php echo mc_site_url(); ?>">
					首页
				</a>
			</li>
			<?php if(MODULE_NAME=='Home') : ?>
			<li>
				文章
			</li>
			<li class="active hidden-xs">
				搜索 - <?php echo $_GET['keyword']; ?>
			</li>
			<?php else : ?>
			<li class="active">
				文章
			</li>
			<?php endif; ?>
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