<?php mc_template_part('header'); ?>
	<div class="container-admin">
		<form class="mb-20" role="form" method="post" action="<?php echo U('user/index/site_nav'); ?>">
			<div class="form-group">
				<input type="text" name="nav_text" class="form-control" placeholder="新增导航文本">
			</div>
			<div class="form-group">
				<input type="text" name="nav_link" class="form-control" placeholder="新增导航链接">
			</div>
			<input name="nav_control" type="hidden" value="ok">
			<button type="submit" class="btn btn-warning btn-block">
				<i class="glyphicon glyphicon-ok-circle"></i> 保存
			</button>
		</form>
		<?php $nav = M('option')->where("type='nav'")->order('id asc')->select(); ?>
		<?php foreach($nav as $val) : ?>
		<div class="input-group mb-10">
			<input type="text" class="form-control" value="<?php echo $val['meta_key']; ?>" disabled>
			<span class="input-group-addon" data-dismiss="modal" data-toggle="modal" data-target="#delnavModal" data-nav-id="<?php echo $val['id']; ?>">
				<i class="glyphicon glyphicon-remove-circle"></i>
			</span>
		</div>
		<?php endforeach; ?>
	</div>
<div class="modal fade" id="delnavModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				
			</div>
			<div class="modal-body">
				删除操作无法撤销，请务必谨慎！
			</div>
			<div class="modal-footer">
				<form method="post" action="<?php echo U('home/perform/nav_del'); ?>">
					<button type="submit" class="btn btn-warning btn-block">
						<i class="glyphicon glyphicon-ok"></i> 确认删除
					</button>
					<input type="hidden" name="id" value="">
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<script>
	$('.input-group-addon').click(function(){
		var id = $(this).attr('data-nav-id');
		$('#delnavModal input').val(id);
	})
</script>
<?php mc_template_part('footer'); ?>