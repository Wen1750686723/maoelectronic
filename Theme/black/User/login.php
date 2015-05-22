<?php mc_template_part('header'); ?>
<div class="container" id="login">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<form role="form" method="post" action="<?php echo U('user/login/submit'); ?>">
				<h4><i class="glyphicon glyphicon-user"></i> 立即登陆</h4>
				<div class="form-group">
					<input type="text" name="user_name" class="form-control bb-0 input-lg" placeholder="账号">
					<input type="text" name="user_pass" class="form-control input-lg password" placeholder="密码">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-lg">
						立即登陆
					</button>
				</div>
				<?php if(mc_option('loginqq')==2) : ?>
				<div class="form-group">
					<a href="<?php echo mc_site_url(); ?>/connect-qq/oauth/index.php"><img src="<?php echo mc_site_url(); ?>/connect-qq/qq_logo.png"></a>
				</div>
				<?php endif; ?>
				<div class="form-group">
					<p class="help-block">
						<a href="<?php echo U('user/lostpass/index'); ?>">忘记密码？</a>
					</p>
				</div>
				<div class="form-group">
					<a href="<?php echo U('user/register/index'); ?>" class="btn btn-default btn-block btn-lg">
						注册账号
					</a>
				</div>
			</form>
		</div>
	</div>
</div>
<?php mc_template_part('footer'); ?>