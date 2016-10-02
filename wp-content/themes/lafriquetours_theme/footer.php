<div class="clear"></div>
</div>
<footer id="footer" role="contentinfo">
<div id="copyright">

<br>
<?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'L\'Afrique Tours' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); echo sprintf( __( ' Designed By: %1$s.', 'L\'Afrique Tours' ), '<a href="mailto:tmdewah@gmail.com?Subject=Website%20Design">Tafadzwa  Moyo</a>' ); ?>
<br>
</footer>
</div>
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri (); ?>/js/layout.js"></script>
<script src="<?php echo get_template_directory_uri (); ?>/js/grid.js"></script>
<script src="<?php echo get_template_directory_uri (); ?>/bootstrap/js/bootstrap.js"></script>
<script>
	layout();
</script>
</body>
</html>