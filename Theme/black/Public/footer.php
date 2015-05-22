<footer>
	<div class="container text-center">
		<p><img src="<?php if(mc_option('logo')) echo mc_option('logo'); else echo mc_theme_url().'/img/logo3.png'; ?>"></p>
		由<a target="_blank" href="http://www.mao10.com/">Mao10CMS V3.2.1</a>强力驱动
	</div>
</footer>
<a id="backtotop" class="goto" href="#site-top"><i class="glyphicon glyphicon-upload"></i></a>
</body>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo mc_theme_url(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo mc_theme_url(); ?>/js/placeholder.js"></script>
<script type="text/javascript">
	$(function() {
		$('input, textarea').placeholder();
	});
</script>
<script src="<?php echo mc_theme_url(); ?>/js/cat.js"></script>
<?php echo mc_xihuan_js(); ?>
<?php echo mc_shoucang_js(); ?>
<?php echo mc_guanzhu_js(); ?>
</html>