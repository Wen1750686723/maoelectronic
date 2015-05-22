<?php if(mc_user_id()) : ?>
<form role="form" method="post" action="<?php echo U('home/perform/comment'); ?>">
	<div class="form-group">
		<textarea id="comment-textarea" name="content" class="form-control" rows="3" placeholder="请输入评论内容"></textarea>
	</div>
	<div class="text-center">
		<button type="submit" class="btn btn-block btn-primary">
			<i class="glyphicon glyphicon-ok"></i> 提交
		</button>
	</div>
	<input type="hidden" name="id" value="<?php echo $page_id; ?>">
</form>
<?php else : ?>
<form role="form">
	<div class="form-group">
		<textarea id="comment-textarea" name="content" class="form-control" rows="3" placeholder="请输入评论内容" disabled></textarea>
		<p class="help-block">您必须在<a href="#" data-toggle="modal" data-target="#loginModal">登陆</a>或<a href="#" data-toggle="modal" data-target="#registerModal">注册</a>后，才可以发表评论！</p>
	</div>
</form>
<?php endif; ?>
<?php if(mc_comment_count($page_id)) : ?>
<hr>
<h4 class="title">全部评论（<?php echo mc_comment_count($page_id); ?>）</h4>
<hr>
<div id="comment">
	<?php foreach($comment as $val) : ?>
	<div class="media" id="comment-<?php echo $val['id']; ?>">
		<div class="media-left">
			<a class="img-div" href="<?php echo U('user/index/index?id='.$val['user_id']); ?>">
				<img class="media-object" src="<?php echo mc_user_avatar($val['user_id']); ?>" alt="<?php echo mc_user_display_name($val['user_id']); ?>">
			</a>
		</div>
		<div class="media-body">
			<h4 class="media-heading">
				<a href="<?php echo U('user/index/index?id='.$val['user_id']); ?>"><?php echo mc_user_display_name($val['user_id']); ?></a>
				<?php if(mc_get_meta($val['user_id'],'user_level',true,'user')==10) : ?><span class="btn btn-danger btn-xs">管理员</span><?php elseif(mc_get_meta($val['user_id'],'user_level',true,'user')==6) : ?><span class="btn btn-info btn-xs">网站编辑</span><?php endif; ?>
				<small class="pull-right"><?php echo date('Y-m-d H:i:s',$val['date']); ?></small>
				<?php if(mc_get_meta(mc_user_id(),'user_level',true,'user')>5) : ?>
				<form class="inline" method="post" action="<?php echo U('home/perform/comment_delete'); ?>">
					<button type="submit" class="btn btn-danger btn-xs pull-right">删除</button>
					<input type="hidden" name="id" value="<?php echo $val['id']; ?>">
				</form>
				<?php endif; ?>
			</h4>
			<p><?php echo mc_magic_out($val['action_value']); ?></p>
			<a class="btn btn-default btn-xs btn-huifu" href="#comment-textarea" huifu-data="@<?php echo mc_user_display_name($val['user_id']); ?> ">回复</a>	
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>