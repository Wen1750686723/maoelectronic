<?php mc_template_part('header'); ?>
	<div class="container home-main">
		<h4 class="title">
			<i class="glyphicon glyphicon-search"></i> 搜索结果
		</h4>
		<div class="row">
			<div class="col-sm-12" id="post-list-default">
				<?php if($page) : ?>
				<table class="table table-striped table-bordered table-hover mb-40">
						<thead>
							<tr>
								<th class="group-post-title">主题</th>
								<th>作者</th>
								<th>所属板块</th>
								<th>时间</th>
								<th>点击</th>
								<th>回复</th>
								<th>最后发表</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($page as $val) : ?>
							<?php $author = mc_get_meta($val['id'],'author',true); ?>
							<tr id="mc-page-<?php echo $val['id']; ?>">
								<th class="group-post-title"><a href="<?php echo mc_get_url($val['id']); ?>"><?php echo $val['title']; ?><?php if($val['date']>strtotime("now")) : ?><span class="label label-danger">置顶</span><?php endif; ?></a></th>
								<th><a href="<?php echo mc_get_url($author); ?>"><?php echo mc_user_display_name($author); ?></a></th>
								<th><a href="<?php echo mc_get_url(mc_get_meta($val['id'],'group')); ?>"><?php echo mc_get_page_field(mc_get_meta($val['id'],'group'),'title'); ?></a></th>
								<th><?php echo date('Y-m-d H:i:s',$val['date']); ?></th>
								<th><?php echo mc_views_count($val['id']); ?></th>
								<th><?php echo mc_comment_count($val['id']); ?></th>
								<th><?php if(mc_last_comment_user($val['id'])) : ?><?php echo mc_user_display_name(mc_last_comment_user($val['id'])); ?><?php else : ?><?php echo mc_user_display_name($author); ?><?php endif; ?></th>								
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php echo mc_pagenavi($count,$page_now); ?>
				<?php else : ?>
				<div id="nothing">没有搜索到任何东东！</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php mc_template_part('footer'); ?>