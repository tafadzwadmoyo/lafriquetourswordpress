<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
						<div class="site-info">
					<div id="copyright">
						<p><?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'L\'Afrique Tours' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); echo sprintf( __( ' Designed By: %1$s.', 'L\'Afrique Tours' ), '<a href="mailto:tmdewah@gmail.com?Subject=Website%20Design">Tafadzwa  Moyo</a>' ); ?>
						</p>
					</div>
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
