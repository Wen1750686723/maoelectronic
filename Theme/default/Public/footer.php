<footer>
	<p>
		<img src="<?php if(mc_option('logo')) echo mc_option('logo'); else echo mc_theme_url().'/img/logo-s.png'; ?>">
	</p>
	由<a target="_blank" href="http://www.mao10.com/">Mao10CMS V3.3.4</a>强力驱动
</footer>
<a id="backtotop" class="goto" href="#site-top"><i class="glyphicon glyphicon-upload"></i></a>
</body>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo mc_site_url(); ?>/Theme/default/js/bootstrap.min.js"></script>
<?php if(mc_option('homehdys')==2 && MODULE_NAME=='Home') : ?>
<?php else : ?>
<script src="<?php echo mc_site_url(); ?>/Theme/default/js/headroom.min.js"></script>
<script>
(function() {
    var header = new Headroom(document.querySelector("#topnav"), {
        tolerance: 5,
        offset : 205,
        classes: {
          initial: "animated",
          pinned: "slideDown",
          unpinned: "slideUp"
        }
    });
    header.init();
}());
</script>
<?php endif; ?>
<script src="<?php echo mc_site_url(); ?>/Theme/default/js/placeholder.js"></script>
<script type="text/javascript">
	$(function() {
		$('input, textarea').placeholder();
	});
</script>
<script src="<?php echo mc_site_url(); ?>/Theme/default/js/cat.js"></script>
<?php echo mc_xihuan_js(); ?>
<?php echo mc_shoucang_js(); ?>
<?php echo mc_guanzhu_js(); ?>
</html>