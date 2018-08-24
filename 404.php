<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Argent
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h2 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'argent' ); ?></h2>
				</header><!-- .page-header -->

				<div class="page-content">
				<p><?php _e( 'Sorry, but we did not find any content at this location. Try starting again from the <a href=" ' . site_url() . '">home of this site</a> or the <a href="' . get_post_type_archive_link( 'twu-portfolio' ) . '">main portfolio index</a>. Please check the web address or try searching for what you were looking for?', 'argent' ); ?></p>
					

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
