<?php mc_template_part('header'); ?>
<div class="container" id="login">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<form role="form" method="post" action="<?php echo U('user/register/submit'); ?>">
				<h4><i class="glyphicon glyphicon-user"></i> 注册账号</h4>
				<div class="form-group">
					<input type="text" name="user_name" class="form-control bb-0 input-lg" placeholder="账号">
					<input type="email" name="user_email" class="form-control bb-0 input-lg" placeholder="邮箱">
					<input type="text" name="user_pass" class="form-control bb-0 input-lg password" placeholder="密码">
					<input type="text" name="user_pass2" class="form-control input-lg password" placeholder="重复密码">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-lg">
						立即注册
					</button>
				</div>
				<?php if(mc_option('loginqq')==2) : ?>
				<div class="form-group">
					<a href="<?php echo mc_site_url(); ?>/connect-qq/oauth/index.php"><img src="<?php echo mc_site_url(); ?>/connect-qq/qq_logo.png"></a>
				</div>
				<?php endif; ?>
				<div class="form-group">
					<p class="help-block">
						已有账号<a href="<?php echo U('user/login/index'); ?>">请此登陆</a>
					</p>
				</div>
			</form>
		</div>
	</div>
</div>
<?php mc_template_part('footer'); ?>