<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Argent
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
		
		<?php printf( __( '<strong>TWU Hearts</strong>- a Wordpress Portfolio Theme based on: %1$s', 'argent' ), '<a href="http://wordpress.com/themes/argent/" rel="designer">Argent</a>' ); ?>
		
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
