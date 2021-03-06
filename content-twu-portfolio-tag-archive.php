<?php
/**
 * The template used for displaying Portfolio Archive view
 *
 * @package Argent
 */
?>

<header class="page-header">

		<h1><?php
				// the term we need for this taxonomy
				$term_obj =	get_queried_object(); 

				// get the term object
				$term = get_term( $term_obj->term_id, 'twu-portfolio-tag' );

				// get a count of content with this term
				$tax_count = twu_portfolio_tax_count('twu-portfolio-tag', $term->slug);

				$plural = ( $tax_count == 1) ? '' : 's';

				echo $tax_count . ' Artifact' . $plural . ' Tagged "' . $term->name . '"';
			?></h1>



	<?php twu_hearts_portfolio_content( '<div class="taxonomy-description">', '</div>' ); ?>
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