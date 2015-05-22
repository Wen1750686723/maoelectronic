<?php mc_template_part('header'); ?>
	<?php foreach($page as $val) : ?>
	<div class="container">
		<div id="entry" class="mt-20">
			<?php echo mc_magic_out($val['content']); ?>
		</div>
	</div>
	<?php endforeach; ?>
<?php mc_template_part('footer'); ?>