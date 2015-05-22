<?php mc_template_part('header'); ?>
	<?php foreach($page as $val) : ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col">
				<ol class="breadcrumb mb-20" id="baobei-term-breadcrumb">
					<li>
						<a href="<?php echo mc_site_url(); ?>">
							首页
						</a>
					</li>
					<li>
						<a href="<?php echo U('article/index/index'); ?>">
							文章
						</a>
					</li>
					<li>
						<a href="<?php echo U('article/index/term?id='.mc_get_meta($val['id'],'term')); ?>">
							<?php echo mc_get_page_field(mc_get_meta($val['id'],'term'),'title'); ?>
						</a>
					</li>
					<li class="active hidden-xs">
						<?php echo $val['title']; ?>
					</li>
					<div class="pull-right hidden-xs">
						<a href="javascript:;"><i class="icon-time"></i> <?php echo date('Y-m-d H:i:s',$val['date']); ?>
						<a href="javascript:;" class="publish"><?php echo mc_views_count($val['id']); ?></a>
					</div>
				</ol>
				<div id="single">
				<h1 class="title mt-0 mb-20"><?php echo $val['title']; ?></h1>
				<div id="entry">
					<?php echo mc_magic_out($val['content']); ?>
				</div>
				<?php if(mc_get_meta($val['id'],'tag',false)) : ?>
				<ul id="tags" class="list-inline">
					<li><i class="glyphicon glyphicon-tags"></i></li>
					<?php foreach(mc_get_meta($val['id'],'tag',false) as $tag) : ?>
					<li><a href="<?php echo U('article/index/tag?tag='.$tag); ?>"><?php echo $tag; ?></a></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
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
				<hr>
				<?php echo W("Comment/index",array($val['id'])); ?>
				</div>
			</div>
			<div class="col-md-4 col">
				<?php mc_template_part('article-side'); ?>
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