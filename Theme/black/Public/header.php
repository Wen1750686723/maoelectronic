<!DOCTYPE html>
<html>
<head>
<title><?php echo mc_title(); ?></title>
<?php echo mc_seo(); ?>
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo mc_site_url(); ?>/favicon.ico" mce_href="<?php echo mc_site_url(); ?>/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo mc_site_url(); ?>/favicon.ico" mce_href="<?php echo mc_site_url(); ?>/favicon.ico" type="image/x-icon">
<!-- Bootstrap -->
<link rel="stylesheet" href="<?php echo mc_theme_url(); ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo mc_theme_url(); ?>/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo mc_theme_url(); ?>/style.css" type="text/css" media="screen" />
<?php $site_color = mc_option('site_color'); if($site_color!='') : ?>

<?php endif; ?>
<?php if(mc_option('logo')) : ?>
<style>
	.modal .modal-header {background-image:url(<?php echo mc_option('logo'); ?>);}
</style>
<?php endif; ?>
<link href="<?php echo mc_theme_url(); ?>/css/media.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo mc_theme_url(); ?>/js/jquery.min.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo mc_theme_url(); ?>/js/html5shiv.min.js"></script>
<script src="<?php echo mc_theme_url(); ?>/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<a id="site-top"></a>
<div class="container">
	<header>
		<div class="row">
			<div class="col-md-3 col">
				<a class="logo" href="<?php echo mc_option('site_url'); ?>">
					<img src="<?php if(mc_option('logo')) echo mc_option('logo'); else echo mc_theme_url().'/img/logo.png'; ?>">
				</a>
			</div>
			<div class="col-md-5 col">
			</div>
			<div class="col-md-4 col">
				<form id="searchform" role="form" method="get" action="<?php echo mc_option('site_url'); ?>">
					<input id="search-type" type="hidden" name="type" value="<?php if(mc_option('pro_close')!=1) : echo 'pro'; elseif(mc_option('baobei_close')!=1) : echo 'baobei'; elseif(mc_option('article_close')!=1) : echo 'article'; else : echo 'post'; endif; ?>">
					<div class="form-group mb-0">
						<div class="input-group">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span id="search-type-text"><?php if(mc_option('pro_close')!=1) : echo '商品'; elseif(mc_option('article_close')!=1) : echo '文章'; else : echo '主题'; endif; ?></span>
									<span class="caret">
									</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<?php if(mc_option('pro_close')!=1) : ?>
									<li>
										<a href="javascript:search_type('pro','商品');">
											商品
										</a>
									</li>
									<?php endif; ?>
									<?php if(mc_option('article_close')!=1) : ?>
									<li>
										<a href="javascript:search_type('article','文章');">
											文章
										</a>
									</li>
									<?php endif; ?>
									<?php if(mc_option('group_close')!=1) : ?>
									<li>
										<a href="javascript:search_type('post','主题');">
											主题
										</a>
									</li>
									<?php endif; ?>
								</ul>
							</div>
							<!-- /btn-group -->
							<input name="keyword" type="text" class="form-control input-lg" placeholder="请输入搜索内容～～">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-search"></i>
							</span>
						</div>
					</div>
				</form>
			</div>
		</div>
	</header>
</div>
<nav id="topnav" class="navbar navbar-inverse" role="navigation">	
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-top-navbar-collapse">
				<span class="sr-only">
					Toggle navigation
				</span>
				<span class="icon-bar">
				</span>
				<span class="icon-bar">
				</span>
				<span class="icon-bar">
				</span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="bs-top-navbar-collapse">
			<ul class="nav navbar-nav" id="bs-top-navbar-nav">
				<li>
					<a href="<?php echo mc_site_url(); ?>">
						首页
					</a>
				</li>
				<?php 
					if(mc_option('pro_close')!=1) :
					$args_id = M('meta')->where("meta_key='parent' AND meta_value>'0' AND type='term'")->getField('page_id',true);
					if($args_id) :
					$condition['id']  = array('not in',$args_id);
					endif;
					$condition['type']  = 'term_pro';
					$terms_pro = M('page')->where($condition)->order('id desc')->select(); 
					if($terms_pro) :
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						商品
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="<?php echo U('pro/index/index'); ?>">全部</a>
						</li>
						<?php foreach($terms_pro as $val) : ?>
						<li>
							<a href="<?php echo U('pro/index/term?id='.$val['id']); ?>"><?php echo $val['title']; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</li>
				<?php else : ?>
				<li>
					<a href="<?php echo U('pro/index/index'); ?>">
						商品
					</a>
				</li>
				<?php endif; endif; ?>
				<?php if(mc_option('group_close')!=1) : ?>
				<li>
					<a href="<?php echo U('post/group/index'); ?>">
						社区
					</a>
				</li>
				<?php endif; ?>
				<?php if(mc_option('article_close')!=1) : $terms_article = M('page')->where('type="term_article"')->order('id desc')->select(); if($terms_article) : ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						文章
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="<?php echo U('article/index/index'); ?>">全部</a>
						</li>
						<?php foreach($terms_article as $val) : ?>
						<li>
							<a href="<?php echo U('article/index/term?id='.$val['id']); ?>"><?php echo $val['title']; ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</li>
				<?php else : ?>
				<li>
					<a href="<?php echo U('article/index/index'); ?>">
						文章
					</a>
				</li>
				<?php endif; endif; ?>
				<?php $nav = M('option')->where("type='nav'")->order('id asc')->select(); foreach($nav as $val) : ?>
				<li>
					<a href="<?php echo $val['meta_value']; ?>">
						<?php echo $val['meta_key']; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if(mc_user_id()) { ?>
				<li>
					<a href="<?php echo U('user/index/index?id='.mc_user_id()); ?>">
						<i class="fa fa-user"></i>
						<?php if(mc_user_trend_count()) : ?><span class="count"><?php echo mc_user_trend_count(); ?></span><?php endif; ?>
					</a>
				</li>
				<!--li>
					<a href="<?php //echo U('user/reffer/index?id='.mc_user_id()); ?>">
						<i class="fa fa-trophy"></i>
					</a>
				</li-->
				<?php if(mc_is_admin()) : ?>
				<li>
					<a target="_blank" href="<?php echo U('control/index/index'); ?>">
						<i class="fa fa-cogs"></i>
					</a>
				</li>
				<?php endif; ?>
				<li class="dropdown">
					<a href="#" data-toggle="modal" data-target="#qiandaoModal">
						<i class="fa fa-money"></i>
					</a>
				</li>
				<?php if(mc_option('pro_close')!=1) : ?>
				<li>
					<a href="<?php echo U('pro/cart/index'); ?>">
						<i class="fa fa-shopping-cart"></i>
						<span class="count"><?php echo mc_cart_count(); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<li>
					<a href="javascript:;" id="head-logout-btn">
						<i class="fa fa-power-off"></i>
					</a>
				</li>
				<?php } else { ?>
				<li>
					<a href="#" data-toggle="modal" data-target="#loginModal">
						登陆
					</a>
				</li>
				<li>
					<a href="#" data-toggle="modal" data-target="#registerModal">
						注册
					</a>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>
<!-- Modal -->
<?php if(mc_user_id()) : ?>
<div class="modal fade" id="qiandaoModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				
			</div>
			<div class="modal-body">
				<div id="mycoins" class="text-center">
					<h4>我的积分：<span id="mycoinscount"><?php echo mc_coins(mc_user_id()); ?></span></h4>
					<p><a href="<?php echo U('user/index/coins?id='.mc_user_id()); ?>">查看积分记录</a></p>
					<p>每日签到最多可获得<span class="text-danger">3</span>积分！</p>
					<?php if(mc_is_qiandao()) : ?>
					<a href="javascript:;" id="qiandao" class="btn btn-primary mb-10">已签到</a>
					<?php else : ?>
					<a href="javascript:mc_qiandao();" id="qiandao" class="btn btn-primary mb-10">签到</a>
					<script>
					function mc_qiandao() {
						$.ajax({
							url: '<?php echo U('home/perform/qiandao'); ?>',
							type: 'GET',
							dataType: 'html',
							timeout: 9000,
							error: function() {
								alert('提交失败！');
							},
							success: function(html) {
								var count = $('#mycoinscount').text()*1+3;
								$('#mycoinscount').text(count);
								$('#qiandao').attr('href','javascript:;');
								$('#qiandao').text('已签到');
							}
						});
					};
					</script>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php else : ?>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				
			</div>
			<div class="modal-body">
				<form role="form" method="post" action="<?php echo U('user/login/submit'); ?>">
					<div class="form-group">
						<input type="text" name="user_name" class="form-control bb-0 input-lg" placeholder="账号" value="<?php echo cookie('user_name'); ?>">
						<input type="text" name="user_pass" class="form-control input-lg password" placeholder="密码">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning btn-block btn-lg">
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
					<input type="hidden" name="comefrom" value="<?php echo mc_page_url(); ?>">
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				
			</div>
			<div class="modal-body">
				<form role="form" method="post" action="<?php echo U('user/register/submit'); ?>">
					<div class="form-group">
						<input type="text" name="user_name" class="form-control bb-0 input-lg" placeholder="账号">
						<input type="email" name="user_email" class="form-control bb-0 input-lg" placeholder="邮箱">
						<input type="text" name="user_pass" class="form-control bb-0 input-lg password" placeholder="密码">
						<input type="text" name="user_pass2" class="form-control input-lg password" placeholder="重复密码">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-warning btn-block btn-lg">
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
					<input type="hidden" name="comefrom" value="<?php echo mc_page_url(); ?>">
				</form>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<!-- Modal -->
<form method="post" class="inline" id="head-logout" action="<?php echo U('user/login/logout'); ?>">
	<input type="hidden" name="logout" value="ok">
</form>
<script>
	$('#head-logout-btn').click(function(){
		$('#head-logout').submit();
	});
</script>