<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Argent
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'No Portfolio Items Found', 'argent' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
	
			<p><?php _e( 'Sorry, but we did not find any content at this address. Try again from the <a href=" ' . site_url() . '">home of this site</a> or the <a href="' . get_post_type_archive_link( 'twu-portfolio' ) . '">main portfolio index</a>? Perhaps check the URL and try afain?', 'argent' ); ?></p>

	</div><!-- .page-content -->
</section><!-- .no-results -->
