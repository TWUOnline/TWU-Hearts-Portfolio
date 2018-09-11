<?php
/**
 * The template used for displaying Portfolio Archive view
 *
 * @package Argent
 */
?>

<header class="page-header">
	<?php twu_hearts_portfolio_title( '<h1 class="page-title">', '</h1>' ); ?>


	<?php twu_inspire_portfolio_content( '<div class="taxonomy-description">', '</div>' ); ?>
</header><!-- .page-header -->

<div id="portfolio-wrapper">
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'twu-portfolio' ); ?>

	<?php endwhile; ?>
</div><!-- #portfolio-wrapper -->

<?php
	the_posts_navigation( array(
		'prev_text'          => esc_html__( 'Older artifacts', 'argent' ),
		'next_text'          => esc_html__( 'Newer artifacts', 'argent' ),
		'screen_reader_text' => esc_html__( 'Portfolio navigation', 'argent' ),
	) );
?>