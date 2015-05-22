<?php mc_template_part('header'); ?>
	<link rel="stylesheet" href="<?php echo mc_site_url(); ?>/editor/summernote.css">
	<script src="<?php echo mc_site_url(); ?>/editor/summernote.min.js"></script>
	<script src="<?php echo mc_site_url(); ?>/editor/summernote-zh-CN.js"></script>
	<div class="container-admin">
		<div class="row">
			<form role="form" method="post" action="<?php echo U('Home/perform/edit'); ?>" onsubmit="return postForm()">
			<div class="col-sm-12">
				<div class="form-group">
					<label>
						标题
					</label>
					<input name="title" type="text" class="form-control" placeholder="" value="<?php echo mc_get_page_field($_GET['id'],'title'); ?>">
				</div>
				<div class="form-group">
					<label>
						内容
					</label>
					<textarea name="content" class="form-control" rows="3" id="summernote"><?php echo mc_magic_out(mc_get_page_field($_GET['id'],'content')); ?></textarea>
				</div>
				<input name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
				<button type="submit" class="btn btn-warning btn-block">
					保存
				</button>
				
			</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
			$(document).ready(function() {
					$('#summernote').summernote({
						height: "500px",
						lang:"zh-CN",
						toolbar: [
						    ['style', ['style']],
						    ['color', ['color']],
						    ['font', ['bold', 'underline', 'clear']],
						    ['para', ['ul', 'paragraph']],
						    ['table', ['table']],
						    ['insert', ['link', 'picture']],
						    ['misc', ['codeview', 'fullscreen']]
						]
					});
				});
				var postForm = function() {
					var content = $('textarea[name="content"]').html($('#summernote').code());
				}
				</script>
<?php mc_template_part('footer'); ?>