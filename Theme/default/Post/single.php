<?php mc_template_part('header'); ?>
	<?php foreach($page as $val) : ?>
	<?php $author = mc_author_id($val['id']); $group_id = mc_get_meta($val['id'],'group'); ?>
	<header id="group-head" class="hidden-xs">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h1>
						<a id="logo" class="pull-left img-div" href="<?php echo mc_get_url(mc_get_meta($val['id'],'group')); ?>"><img src="<?php echo mc_fmimg(mc_get_meta($val['id'],'group')); ?>"></a>
						<a href="<?php echo U('post/group/single?id='.mc_get_meta($val['id'],'group')); ?>" class="pull-left title"><?php echo mc_get_page_field(mc_get_meta($val['id'],'group'),'title'); ?></a>
					</h1>
				</div>
				<div class="col-sm-4">
					
				</div>
			</div>
		</div>
	</header>
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
			<li>
				<a href="<?php echo U('post/group/single?id='.$group_id); ?>">
					<?php echo mc_get_page_field($group_id,'title'); ?>
				</a>
			</li>
			<li class="active">
				<?php echo $val['title']; ?>
			</li>
			<div class="pull-right">
				<a href="javascript:;"><i class="glyphicon glyphicon-time"></i> <?php echo date('Y-m-d H:i:s',mc_get_meta($val['id'],'time')); ?>
				<a href="javascript:;" class="publish"><i class="glyphicon glyphicon-eye-open"></i> <?php echo mc_views_count($val['id']); ?></a>
			</div>
		</ol>
		<div class="row">
			<div class="col-sm-8 col-lg-9">
			<h1 id="single-title" class="mt-0"><?php echo $val['title']; ?></h1>
			<div id="single">
				<?php if(mc_get_meta($val['id'],'number')) : $parameter = mc_get_meta($val['id'],'parameter',false); ?>
				<div class="wishbox">
					<?php $fmimg_args = mc_get_meta($group_id,'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<div class="row">
						<div class="col-sm-7">
							<div class="media">
								<a class="pull-left" href="<?php echo mc_get_url($group_id); ?>">
									<img width="100" src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($group_id,'title'); ?>">
								</a>
								<div class="media-body">
									<h4 class="media-heading mb-20">
										我想要 <a href="<?php echo mc_get_url($group_id); ?>"><?php echo mc_get_page_field($group_id,'title'); ?></a>
									</h4>
									<?php if($parameter) : foreach($parameter as $par) : list($key,$par_value) = explode('|',$par); $par_name = M('option')->where("id='$key'")->getField('meta_value'); ?><p><?php echo $par_name.' : '.$par_value; ?></p><?php endforeach; endif; ?>
									<p class="mb-0">数量 : <?php echo mc_get_meta($val['id'],'number'); ?></p>
								</div>
							</div>
						</div>
						<div class="col-sm-5 text-right">
							<?php if(mc_get_meta($val['id'],'wish_done')==1) : ?>
							<a href="javascript:;" rel="nofollow" class="btn btn-lg btn-warning"><i class="icon-heart"></i> 心愿已达成</a>
							<?php else : ?>
							<p class="mb-20">
								目标：<span><?php echo mc_total_wish_for($val['id']); ?></span>元 &nbsp; &nbsp; 
								已完成：<span><?php echo mc_total_wish($val['id']); ?></span>元
							</p>
							<a href="#" rel="nofollow" class="btn btn-lg btn-warning" data-toggle="modal" data-target="<?php if(mc_user_id()) : ?>#myModalWish<?php else : ?>#loginModal<?php endif; ?>"><i class="icon-key"></i> 帮助TA达成心愿</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php $wish_done_100 = round(mc_total_wish($val['id'])/mc_total_wish_for($val['id'])*100,2); ?>
				<div class="wish-bottom pr text-center mb-20">
					已完成 <?php if($wish_done_100>100) : echo 100; else : echo $wish_done_100; endif; ?>%<span style="width:<?php if($wish_done_100>100) : echo 100; else : echo $wish_done_100; endif; ?>%;"></span>
				</div>
				<?php
					$wish = M('action')->where("page_id='".$val['id']."' AND action_key='wish'")->select();
					if($wish) :	
				?>
				<div class="panel-group" id="accordion-wish" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title text-center">
								<a data-toggle="collapse" data-parent="#accordion-wish" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<?php echo mc_total_count_wish($val['id']); ?>人支持了这个心愿 [点击查看]
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse" role="tabpanel"aria-labelledby="headingOne">
							<ul class="list-group">
								<?php foreach($wish as $val_w) : ?>
								<li class="list-group-item">
									<a href="<?php echo U('user/index/index?id='.$val_w['user_id']); ?>"><?php echo mc_user_display_name($val_w['user_id']); ?></a> 支持了 <?php echo $val_w['action_value']; ?>元 <a class="btn btn-default btn-xs btn-huifu pull-right" href="#comment-textarea" huifu-data="@<?php echo mc_user_display_name($val_w['user_id']); ?> ">@TA</a>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="modal fade" id="myModalWish" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
					
							</div>
							<div class="modal-body">
								<div class="input-group">
									<span class="input-group-addon">
										支持金额
									</span>
									<input type="text" class="form-control input-lg" name="total" placeholder="单位：元">
									<a href="#" class="input-group-addon last">
										立即支付
									</a>
								</div>
								<script>
									$('#myModalWish .last').hover(function(){
										var price = $('#myModalWish input').val();
										if(price>0) {
										<?php if(C('URL_MODEL')==2) : ?>
											$(this).attr('href','<?php echo mc_site_url().'/post-index-checkout.html'; ?>?id=<?php echo $val['id']; ?>&price='+price);
										<?php else : ?>
											$(this).attr('href','<?php echo U('post/index/checkout?id='.$val['id'].'&price='); ?>'+price);
										<?php endif; ?>
										} else {
											$(this).attr('href','javascript:;');
										};
									});
								</script>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div id="entry">
					<?php echo mc_magic_out($val['content']); ?>
				</div>
				<?php if(mc_get_meta($val['id'],'number')) : $parameter = mc_get_meta($val['id'],'parameter',false); ?>
				<hr>
				<div class="bdsharebuttonbox" id="wish-share">
					<a href="#" class="bds_qzone btn btn-default" data-cmd="qzone" title="分享到QQ空间">
						分享到QQ空间
					</a>
					<a href="#" class="bds_tsina btn btn-default" data-cmd="tsina" title="分享到新浪微博">
						分享到新浪微博
					</a>
					<a href="#" class="bds_weixin btn btn-default" data-cmd="weixin" title="分享到微信">
						分享到微信
					</a>
				</div>
				<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"大家一起来帮助TA实现这个心愿吧！","bdMini":"2","bdMiniList":false,"bdPic":"<?php echo $fmimg_args[0]; ?>","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
				<?php endif; ?>
				<hr>
				<div class="text-center">
					<?php if(mc_get_page_field($val['id'],'type')=='publish') : ?>
						<?php if(mc_is_admin() || mc_is_bianji()) : ?>
							<a href="<?php echo U('home/perform/zhiding?id='.$val['id']); ?>" class="btn btn-danger btn-sm">
								<i class="glyphicon glyphicon-open"></i> 置顶
							</a> 
							<?php if(mc_option('home_mode')=='post') : ?>
								<?php if(mc_get_meta($val['id'],'tuisong')) : ?>
									<a href="<?php echo U('home/perform/remts?id='.$val['id']); ?>" class="btn btn-default btn-sm">
										<i class="glyphicon glyphicon-bookmark"></i> 取消推送
									</a> 
								<?php else : ?>
									<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tsModal">
										<i class="glyphicon glyphicon-bookmark"></i> 推送至首页
									</a> 
								<?php endif; ?>
							<?php endif; ?>
						<?php else : ?>
							<?php echo mc_xihuan_btn($val['id']); ?> 
							<?php echo mc_shoucang_btn($val['id']); ?> 
						<?php endif; ?>
					<?php else : ?>
					<?php if(mc_is_admin() || mc_is_bianji()) : ?>
					<form method="post" action="<?php echo U('home/perform/review'); ?>" class="inline">
					<button type="submit" class="btn btn-danger">
						<i class="icon-ok-circle"></i> 通过审核
					</button> 
					<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
					</form>
					<?php endif; ?>
					<?php endif; ?>
					<?php if(mc_is_admin() || mc_is_bianji() || $author==mc_user_id()) : ?>
					<a href="<?php echo U('publish/index/edit?id='.$val['id'].'&group='.$group_id); ?>" class="btn btn-info btn-sm">
						<i class="glyphicon glyphicon-edit"></i> 编辑
					</a> 
					<button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
						<i class="glyphicon glyphicon-trash"></i> 删除
					</button>
					<?php endif; ?>
				</div>
				<hr>
				<div class="media">
					<div class="media-left">
						<a class="img-div img-circle" style="width:60px; height:60px;" href="<?php echo mc_get_url($author); ?>">
							<img class="media-object" src="<?php echo mc_user_avatar($author); ?>" alt="<?php echo mc_user_display_name($author); ?>">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading mb-10">
							<a href="<?php echo mc_get_url($author); ?>"><?php echo mc_user_display_name($author); ?></a>
							<span class="label label-default">作者</span>
						</h4>
						<?php echo mc_get_page_field($author,'content'); ?>
					</div>
				</div>
				<hr>
				<?php echo W("Comment/index",array($val['id'])); ?>
			</div>
			</div>
			<div class="col-sm-4 col-lg-3 hidden-xs" id="group-side">
				<ul class="nav nav-pills nav-stacked text-center mb-20">
					<li><a href="<?php echo U('publish/index/add_post?group='.$group_id); ?>">发起话题</a></li>
				</ul>
				<?php if(mc_get_page_field(mc_get_meta($val['id'],'group'),'type')=='pro') : //商品版块 ?>
				<div class="thumbnail">
					<?php $fmimg_args = mc_get_meta(mc_get_meta($val['id'],'group'),'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
					<a class="img-div" href="<?php echo mc_get_url($group_id); ?>"><img src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($group_id,'title'); ?>"></a>
					<div class="caption">
						<h4>
							<a href="<?php echo mc_get_url($group_id); ?>"><?php echo mc_get_page_field($group_id,'title'); ?></a>
						</h4>
						<p class="price pull-left">
							<span><?php echo mc_price_now($group_id); ?></span> <small>元</small>
						</p>
						<div class="clearfix"></div>
					</div>
				</div>
				<?php else : ?>
				<?php mc_template_part('sidebar'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php if(mc_is_admin() || mc_is_group_admin(mc_get_meta($val['id'],'group'))) : ?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					
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
	<div class="modal fade" id="tsModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					
				</div>
				<form method="post" action="<?php echo U('home/perform/tuisong'); ?>">
				<div class="modal-body text-center">
					<div id="pub-imgadd">
						<img class="default-img" id="default-img" src="<?php echo mc_theme_url(); ?>/img/upload.jpg">
						<input type="hidden" name="fmimg" id="pub-input" value="">
						<input type="file" id="picfile" onchange="readFile(this,1)" />
					</div>
					<script>
						function readFile(obj,id){ 
					        var file = obj.files[0]; 	
					        //判断类型是不是图片
					        if(!/image\/\w+/.test(file.type)){   
					                alert("请确保文件为图像类型"); 
					                return false; 
					        } 
					        var reader = new FileReader(); 
					        reader.readAsDataURL(file); 
					        reader.onload = function(e){ 
					        	$('#pub-imgadd img').attr('src',this.result);
					        	$('#pub-imgadd #pub-input').val(this.result);
					            //alert(this.result);
					        } 
					} 
					</script>
				</div>
				<div class="modal-footer" style="text-align:center;">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						<i class="glyphicon glyphicon-remove"></i> 取消
					</button>
					<button type="submit" class="btn btn-danger">
						<i class="glyphicon glyphicon-ok"></i> 确定
					</button>
				</div>
				<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<?php endif; ?>
	<?php endforeach; ?>
	<?php if(mc_prev_page_id($val['id'])) : ?>
	<a class="prev_btn np_page_btn" href="<?php echo mc_get_url(mc_prev_page_id($val['id'])); ?>">
		<i class="fa fa-chevron-circle-left"></i>
	</a>
	<?php endif; ?>
	<?php if(mc_next_page_id($val['id'])) : ?>
	<a class="next_btn np_page_btn" href="<?php echo mc_get_url(mc_next_page_id($val['id'])); ?>">
		<i class="fa fa-chevron-circle-right"></i>
	</a>
	<?php endif; ?>
<?php mc_template_part('footer'); ?>