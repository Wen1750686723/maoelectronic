<?php mc_template_part('header'); ?>
	<div class="container">
		<div class="panel panel-default" id="cart">
			<?php if($page) : ?>
			<table class="table hidden-xs">
				<thead>
					<tr>
						<th class="th1">
							<i class="glyphicon glyphicon-shopping-cart"></i> 购物车
						</th>
						<th class="th2">参数</th>
						<th class="th3">单价</th>
						<th class="th4">数量</th>
						<th class="th5">操作</th>
					</tr>
				</thead>
				<?php foreach($page as $val) : ?>
				<tbody>
					<tr>
						<th class="th1">
							<div class="media">
								<div class="pull-left">
									<a class="img-div" href="<?php echo mc_get_url($val['page_id']); ?>">
										<?php $fmimg_args = mc_get_meta($val['page_id'],'fmimg',false); ?>
										<img class="media-object" src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($val['page_id'],'title'); ?>">
									</a>
								</div>
								<div class="media-body">
									<h4 class="media-heading">
										<a href="<?php echo mc_get_url($val['page_id']); ?>"><?php echo mc_get_page_field($val['page_id'],'title'); ?></a>
									</h4>
								</div>
							</div>
						</th>
						<th class="th2">
							<?php $parameter = M('action')->where("page_id='".$val['id']."' AND action_key='parameter'")->order('id asc')->getField('action_value',true); if($parameter) : ?>
							<ul class="list-inline mt-10">
							<?php foreach($parameter as $par) : list($par_name,$par_value) = explode('|',$par); ?>
							<li><span class="btn-cart"><?php echo $par_name; ?>：<?php echo $par_value; ?></span></li>
							<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</th>
						<th class="th3">
							<div class="mt-10"><?php echo mc_cart_price($val['id']); ?> 元</div>
						</th>
						<th class="th4">
							<div class="input-group input-group-sm mt-10">
								<a href="<?php echo U('home/perform/cart_number?id='.$val['id'].'&number=1&for=1'); ?>" class="input-group-addon">-</a>
								<input type="text" class="form-control text-center" placeholder="0" value="<?php echo $val['action_value']; ?>">
								<a href="<?php echo U('home/perform/cart_number?id='.$val['id'].'&number=1'); ?>" class="input-group-addon">+</a>
							</div>
						</th>
						<th class="th5">
							<form method="post" action="<?php echo U('home/perform/cart_delete'); ?>">
							<button type="submit" class="delete-cart">
								删除
							</button>
							<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
							</form>
						</th>
					</tr>
				</tbody>
				<?php endforeach; ?>
			</table>
			<ul class="list-group visible-xs-block">
			<?php foreach($page as $val) : ?>
			<li class="list-group-item pr">
				<div class="media">
					<a class="pull-left img-div" href="<?php echo mc_get_url($val['page_id']); ?>">
						<?php $fmimg_args = mc_get_meta($val['page_id'],'fmimg',false); ?>
						<img class="media-object" src="<?php echo $fmimg_args[0]; ?>" alt="<?php echo mc_get_page_field($val['page_id'],'title'); ?>">
					</a>
					<div class="media-body">
						<h4 class="media-heading">
							<a href="<?php echo mc_get_url($val['page_id']); ?>"><?php echo mc_get_page_field($val['page_id'],'title'); ?></a>
						</h4>
						<span class="btn-cart">单价：<?php echo mc_cart_price($val['id']); ?> 元</span>
						<span class="btn-cart">数量：<?php echo $val['action_value']; ?></span>
						<?php $parameter = M('action')->where("page_id='".$val['id']."' AND action_key='parameter'")->order('id asc')->getField('action_value',true); if($parameter) : ?>
						<ul class="list-inline mt-10">
						<?php foreach($parameter as $par) : list($par_name,$par_value) = explode('|',$par); ?>
						<li><span class="btn-cart"><?php echo $par_name; ?>：<?php echo $par_value; ?></span></li>
						<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</div>
				</div>
				<form method="post" action="<?php echo U('home/perform/cart_delete'); ?>">
				<button type="submit" class="delete-cart">
					删除
				</button>
				<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
				</form>
			</li>
			<?php endforeach; ?>
			</ul>
			<div class="panel-footer">
				<div class="row">
					<div class="col-xs-6">
						<div class="btn btn-link" id="total">商品总价：<span><?php echo mc_total(); ?></span> 元</div>
					</div>
					<div class="col-xs-6 text-right">
						<a target="_blank" href="<?php echo U('pro/cart/checkout'); ?>" class="btn btn-warning">
							<i class="glyphicon glyphicon-circle-arrow-right"></i> 下一步
						</a>
					</div>
				</div>
			</div>
			<?php else : ?>
			<div class="panel-body text-center">购物车里没有任何商品</div>
			<?php endif; ?>
		</div>
	</div>
<?php mc_template_part('footer'); ?>