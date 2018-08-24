<?php
/**
 * Template Name: TWU Portfolio Front Page
 *
 * @package Argent
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php if ( '' != get_the_content() ) : ?>
			<div class="page-content">
				<?php the_content(); ?>
			</div>
			<?php endif; ?>
		<?php endwhile; // end of the loop. ?>

		<?php get_template_part( 'content', 'front-portfolio' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
