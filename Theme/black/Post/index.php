<?php mc_template_part('header'); ?>
	<div class="container">
		<ol class="breadcrumb mb-20 mt-20" id="baobei-term-breadcrumb">
			<li>
				<a href="<?php echo mc_site_url(); ?>">
					首页
				</a>
			</li>
			<li class="active">
				社区
			</li>
			<div class="pull-right">
				<a href="javascript:;" class="publish">共有<?php echo M('page')->where("type = 'publish'")->count('id'); ?>主题</a>
			</div>
		</ol>
		<div class="row">
			<div class="col-sm-12" id="group">
				<?php $groups = M('page')->where('type="group"')->order('date desc')->select(); if($groups) : ?>
				<ul class="nav nav-pills mb-0 term-list" role="tablist">
					<li role="presentation" class="active">
						<a href="javascript:;">
							全部
						</a>
					</li>
				<?php foreach($groups as $val) : ?>
					<li role="presentation">
						<a href="<?php echo U('post/group/single?id='.$val['id']); ?>">
							<?php echo $val['title']; ?>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<hr class="mt-10">
				<?php if($page) : ?>
				<div id="post-list-default">
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
				</div>
				<?php else : ?>
				<div id="post-list-default">
					<ul class="list-group">
						<li class="list-group-item text-center" style="padding:120px 0;">
							暂无任何话题！
						</li>
					</ul>
				</div>
				<?php endif; ?>
				<link rel="stylesheet" href="<?php echo mc_site_url(); ?>/editor/summernote.css">
				<script src="<?php echo mc_site_url(); ?>/editor/summernote.min.js"></script>
				<script src="<?php echo mc_site_url(); ?>/editor/summernote-zh-CN.js"></script>
				<form role="form" method="post" action="<?php echo U('home/perform/publish'); ?>" onsubmit="return postForm()">
					<div class="row">
						<div class="col-sm-4 col-lg-3">
							<div class="form-group">
								<label>
									版块
								</label>
								<select class="form-control" name="group">
								<?php $group = M('page')->where('type="group"')->order('date asc')->select(); if($group) : foreach($group as $val) : $num++; ?>
									<option value="<?php echo $val['id']; ?>" <?php if($num==1) echo 'selected'; ?>><?php echo $val['title']; ?></option>
								<?php endforeach; endif; ?>
								</select>
							</div>
						</div>
						<div class="col-sm-8 col-lg-9">
							<div class="form-group">
								<label>
									标题
								</label>
								<input name="title" type="text" class="form-control" placeholder="" value="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>
							主题内容
						</label>
						<textarea name="content" class="form-control" id="summernote" rows="3"></textarea>
					</div>
					<button type="submit" class="btn btn-primary btn-block">
						<i class="glyphicon glyphicon-ok"></i> 提交
					</button>
				</form>
				<script type="text/javascript">
				$(document).ready(function() {
					$('#summernote').summernote({
						height: "300px",
						lang:"zh-CN",
						toolbar: [
						    ['style', ['style']],
						    ['color', ['color']],
						    ['font', ['bold', 'underline', 'clear']],
						    ['para', ['ul', 'paragraph']],
						    ['table', ['table']],
						    ['insert', ['link', 'picture', 'video']],
						    ['misc', ['codeview', 'fullscreen']]
						]
					});
				});
				var postForm = function() {
					var content = $('textarea[name="content"]').html($('#summernote').code());
				}
				</script>
			</div>
		</div>
	</div>
<?php mc_template_part('footer'); ?>