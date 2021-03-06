<?php
/**
 * The template used for displaying Portfolio  Archive view
 *
 * @package Argent
 */
?>

<header class="page-header">

	<h1 class="page-title"><?php _e( 'All My Artifacts', 'argent' );?> (<?php echo wp_count_posts('twu-portfolio')->publish?> total)</h1>


	<div class="taxonomy-description">
		<?php twu_hearts_portfolio_tagline()?>
	</div>
</header>

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