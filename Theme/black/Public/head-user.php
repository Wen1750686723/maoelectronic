<style>#topnav {margin-bottom: 0;}</style>
<div id="user-header" class="mb-20" style="background-image: url(<?php if(mc_fmimg($_GET['id'])) : echo mc_fmimg($_GET['id']); else : echo mc_theme_url().'/img/user_bg.jpg'; endif; ?>);">
<div class="container">
	<a class="img-div mb-20" href="<?php echo U('user/index/index?id='.$_GET['id']); ?>">
		<img class="media-object" src="<?php echo mc_user_avatar($_GET['id']); ?>" alt="<?php echo mc_user_display_name($_GET['id']); ?>">
	</a>
	<h4 class="title mb-20 mt-0"><?php echo mc_user_display_name($_GET['id']); ?></h4>
	<p class="mb-20"><?php echo mc_cut_str(strip_tags(mc_get_page_field($_GET['id'],'content')), 65); ?></p> 
						<?php echo mc_guanzhu_btn($_GET['id']); ?> 
						<?php if(mc_is_admin() && !mc_is_admin($_GET['id'])) : ?>
						<button class="btn btn-default user-delete" user-data="<?php echo $_GET['id']; ?>" data-toggle="modal" data-target="#myModal">
							<i class="glyphicon glyphicon-trash"></i> 删除
						</button> 
						<button class="btn btn-default user-ip-false" user-data="<?php echo $_GET['id']; ?>" data-toggle="modal" data-target="#myModal2">
							<i class="glyphicon glyphicon-trash"></i> 屏蔽IP并删除
						</button>
						<?php endif; ?>
</div>
<div id="user-header-cover"></div>
</div>
<?php if(mc_is_admin()) : ?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title">
						
					</h4>
				</div>
				<div class="modal-body">
					确认要删除这个用户吗？注意：该用户的全部主题也会被一并删除！
				</div>
				<div class="modal-footer">
					<form method="post" action="<?php echo U('home/perform/delete'); ?>">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="glyphicon glyphicon-remove"></i> 取消
					</button>
					<button type="submit" class="btn btn-danger">
						<i class="glyphicon glyphicon-ok"></i> 确定
					</button>
					<input id="user-delete" type="hidden" name="id" value="">
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<script>
		$('.user-delete').click(function(){
			var duser = $(this).attr('user-data');
			$('#user-delete').val(duser);
		});
	</script>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title">
						
					</h4>
				</div>
				<div class="modal-body">
					确认要永久屏蔽这个用户的全部IP并删除该用户吗？
				</div>
				<div class="modal-footer">
					<form method="post" action="<?php echo U('home/perform/ip_false'); ?>">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="glyphicon glyphicon-remove"></i> 取消
					</button>
					<button type="submit" class="btn btn-danger">
						<i class="glyphicon glyphicon-ok"></i> 确定
					</button>
					<input id="user-ip-false" type="hidden" name="id" value="">
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<script>
		$('.user-ip-false').click(function(){
			var duser = $(this).attr('user-data');
			$('#user-ip-false').val(duser);
		});
	</script>
<?php endif; ?>