<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Argent
 */
 
 // add extra header
 if ( is_tax( 'twu-portfolio-type') ) {
 	$term_obj =	get_queried_object(); // the term we need for this taxonomy
    $term = get_term( $term_obj->term_id, 'twu-portfolio-type' );
    
    $extra = ' for Artifacts of Type "' .   $term->name . '"';

} elseif ( is_tax( 'twu-portfolio-tag') ) {
 	$term_obj =	get_queried_object(); // the term we need for this taxonomy
    $term = get_term( $term_obj->term_id, 'twu-portfolio-tag' );
    
    $extra = ' for Artifacts Tagged  "' .   $term->name . '"';
} else {
	$extra = '';
}
?>



<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'No Portfolio Items Found' . $extra , 'argent' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
	
			<p><?php _e( 'Sorry, but we did not find any content at this address. Try again from the <a href=" ' . site_url() . '">home of this site</a> or the <a href="' . get_post_type_archive_link( 'twu-portfolio' ) . '">main portfolio index</a>? Perhaps check the URL, try again, or try searching?', 'argent' ); ?></p>
			
			 <?php get_search_form(); ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
