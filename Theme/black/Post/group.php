<?php mc_template_part('header'); ?>
	<div class="container">
		<ol class="breadcrumb mb-20 mt-20" id="baobei-term-breadcrumb">
			<li>
				<a href="<?php echo U('home/index/index'); ?>">
					首页
				</a>
			</li>
			<li>
				<a href="<?php echo U('post/group/index'); ?>">
					社区
				</a>
			</li>
			<li class="active">
				<?php echo mc_get_page_field($_GET['id'],'title'); ?>
			</li>
			<div class="pull-right">
				<a href="javascript:;" class="publish"><?php echo $count; ?></a>
			</div>
		</ol>
		<div class="row">
			<div class="col-sm-12" id="group">
				<?php $groups = M('page')->where('type="group"')->order('date desc')->select(); if($groups) : ?>
				<ul class="nav nav-pills mb-0 term-list" role="tablist">
					<li role="presentation">
						<a href="<?php echo U('post/group/index'); ?>">
							全部
						</a>
					</li>
				<?php foreach($groups as $valg) : ?>
					<li role="presentation" <?php if($_GET['id']==$valg['id']) : ?>class="active"<?php endif; ?>>
						<a href="<?php echo U('post/group/single?id='.$valg['id']); ?>">
							<?php echo $valg['title']; ?>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<hr class="mt-10">
				<?php if(mc_get_page_field($_GET['id'],'type')=='pro') : //商品版块 ?>
				<?php else : //普通版块 ?>
				<div class="panel panel-default">
					<div class="panel-body">
						<?php echo mc_magic_out(mc_get_page_field($_GET['id'],'content')); ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if($page) : ?>
				<div id="post-list-default">
					<table class="table table-striped table-bordered table-hover mb-40">
						<thead>
							<tr>
								<th class="group-post-title">主题</th>
								<th>作者</th>
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
				<div class="text-center">
					<?php if(!mc_is_admin()) : ?>
					<?php echo mc_xihuan_btn($_GET['id']); ?>
					<?php echo mc_shoucang_btn($val['id']); ?>
					<?php endif; ?>
					<?php if(mc_get_page_field($_GET['id'],'type')=='pro') : //商品版块 ?>
					<?php else : //普通版块 ?>
					<?php if(mc_is_admin() || mc_is_bianji()) { ?>
					<a href="<?php echo U('publish/index/edit?id='.$_GET['id']); ?>" class="btn btn-info">
						<i class="glyphicon glyphicon-edit"></i> 编辑
					</a>
					<button class="btn btn-default" data-toggle="modal" data-target="#myModal">
						<i class="glyphicon glyphicon-trash"></i> 删除
					</button>
					<?php } ?>
					<?php endif; ?>
				</div>
				<link rel="stylesheet" href="<?php echo mc_site_url(); ?>/editor/summernote.css">
				<script src="<?php echo mc_site_url(); ?>/editor/summernote.min.js"></script>
				<script src="<?php echo mc_site_url(); ?>/editor/summernote-zh-CN.js"></script>
				<form role="form" method="post" action="<?php echo U('home/perform/publish'); ?>" onsubmit="return postForm()">
					<div class="form-group">
						<label>
							标题
						</label>
						<input name="title" type="text" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label>
							主题内容
						</label>
						<textarea name="content" class="form-control" id="summernote" rows="3"></textarea>
					</div>
					<button type="submit" class="btn btn-warning btn-block">
						<i class="glyphicon glyphicon-ok"></i> 提交
					</button>
					<input type="hidden" name="group" value="<?php echo $id; ?>">
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
			<div class="col-sm-4 col-lg-3 hidden-xs" id="group-side">
				<ul class="nav nav-pills nav-stacked text-center mb-20">
					<li class="active"><a href="<?php echo U('post/group/single?id='.$_GET['id']); ?>">全部主题</a></li>
					<li><a href="<?php echo U('publish/index/add_post?group='.$_GET['id']); ?>">发起话题</a></li>
				</ul>
				<?php if(mc_get_page_field($_GET['id'],'type')=='pro') : //商品版块 ?>
				<div class="thumbnail">
					<?php $fmimg_args = mc_get_meta($_GET['id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<a class="img-div" href="<?php echo mc_get_url($_GET['id']); ?>"><img src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($_GET['id'],'title'); ?>"></a>
					<div class="caption">
						<h4>
							<a href="<?php echo mc_get_url($_GET['id']); ?>"><?php echo mc_get_page_field($_GET['id'],'title'); ?></a>
						</h4>
						<p class="price pull-left">
							<span><?php echo mc_price_now($_GET['id']); ?></span> <small>元</small>
						</p>
						<?php if(mc_get_meta($_GET['id'],'kucun')<=0) : ?>
						<button type="button" class="btn btn-default btn-xs pull-right">
							<i class="icon-umbrella"></i> 暂时缺货
						</button>
						<?php else : ?>
						<form method="post" action="<?php echo U('home/perform/add_cart'); ?>">
						<button type="submit" class="btn btn-warning btn-xs pull-right">
							<i class="glyphicon glyphicon-plus"></i> 加入购物车
						</button>
						<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
						<input type="hidden" name="number" value="1">
						</form>
						<?php endif; ?>
						<div class="clearfix"></div>
					</div>
				</div>
				<?php else : ?>
				<?php mc_template_part('sidebar'); ?>
				<?php endif; ?>
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
					<p>确认要删除此版块吗？</p>
					注意：当前版块下的所有话题都会被删除！
				</div>
				<div class="modal-footer" style="text-align:center;">
					<form method="post" action="<?php echo U('home/perform/delete'); ?>">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="glyphicon glyphicon-remove"></i> 取消
					</button>
					<button type="submit" class="btn btn-danger">
						<i class="glyphicon glyphicon-ok"></i> 确定
					</button>
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<?php endif; ?>
<?php mc_template_part('footer'); ?>