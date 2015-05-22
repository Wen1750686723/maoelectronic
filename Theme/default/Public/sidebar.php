<?php if(MODULE_NAME=='Home' && CONTROLLER_NAME=='Index' && ACTION_NAME=='index') : ?>
<?php else : ?>
<div class="mb-20"><?php echo mc_option('sidebar'); ?></div>
<?php endif; ?>
<div class="home-side">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-th-list"></i> 热门商品
							<a class="pull-right" href="<?php echo U('pro/index/index'); ?>"><i class="fa fa-angle-right"></i></a>
						</div>
						<ul class="list-group">
							<?php 
							$Model = new \Think\Model();
							$newprob = $Model->query("select page_id from __PREFIX__meta where meta_key='views' and page_id in (select id from __PREFIX__page where type='pro') order by meta_value desc limit 0,3");
							?>
							<?php foreach($newprob as $val) : ?>
							<li class="list-group-item">
								<div class="media">
									<a class="media-left" href="<?php echo mc_get_url($val['page_id']); ?>">
										<?php $fmimg_args = mc_get_meta($val['page_id'],'fmimg',false); $fmimg_args = array_reverse($fmimg_args); ?>
										<div class="img-div">
											<img class="media-object" src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($val['page_id'],'title'); ?>">
										</div>
									</a>
									<div class="media-body">
										<h4 class="media-heading">
											<a href="<?php echo mc_get_url($val['page_id']); ?>"><?php echo mc_get_page_field($val['page_id'],'title'); ?></a>
										</h4>
										<p><span><?php echo mc_price_now($val['page_id']); ?></span> <small>元</small></p>
									</div>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-th-list"></i> 最新文章
							<a class="pull-right" href="<?php echo U('article/index/index'); ?>"><i class="fa fa-angle-right"></i></a>
						</div>
						<?php $newarticle = M('page')->where("type='article'")->order('id desc')->page(1,5)->select(); if($newarticle) : ?>
						<div class="list-group">
							<?php foreach($newarticle as $val) : ?>
							<a href="<?php echo mc_get_url($val['id']); ?>" class="list-group-item">
								<?php echo $val['title']; ?>
							</a>
							<?php endforeach; ?>
						</div>
						<?php else : ?>
						<div class="panel-body">
							暂时没有任何文章，现在就去
							<br>
							<a href="<?php echo U('article/index/index'); ?>">写下网站的第一篇文章!</a>
						</div>
						<?php endif; ?>
					</div>
					<?php if(MODULE_NAME=='Home' && CONTROLLER_NAME=='Index' && ACTION_NAME=='index') : ?>
					<div class="panel panel-default home-post">
						<div class="panel-heading">
							<i class="fa fa-comments"></i> 最新话题
							<a class="pull-right" href="<?php echo U('post/group/index'); ?>"><i class="fa fa-angle-right"></i></a>
						</div>
						<div class="list-group">
							<?php $page_post = M('page')->where("type='publish'")->order('date desc')->page(1,5)->select(); foreach($page_post as $val) : ?>
							<li class="list-group-item" id="mc-page-<?php echo $val['id']; ?>">
								<?php $author = mc_get_meta($val['id'],'author',true); ?>
								<h4 class="media-heading">
									<a href="<?php echo mc_get_url($val['id']); ?>"><?php echo $val['title']; ?></a>
								</h4>
								<p class="post-info mb-0 wto">
									<i class="glyphicon glyphicon-user"></i><a href="<?php echo mc_get_url($author); ?>"><?php echo mc_user_display_name($author); ?></a>
									<i class="glyphicon glyphicon-home"></i><a href="<?php echo mc_get_url(mc_get_meta($val['id'],'group')); ?>"><?php echo mc_get_page_field(mc_get_meta($val['id'],'group'),'title'); ?></a>
									<span class="hidden-md"><i class="glyphicon glyphicon-time"></i><?php echo date('m月d日',mc_get_meta($val['id'],'time')); ?></span>
								</p>
							</li>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-th-list"></i> 网站公告
						</div>
						<div class="panel-body">
							<?php echo mc_option('gonggao'); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>