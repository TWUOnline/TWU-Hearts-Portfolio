<?php
/**
 * @package Argent
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<?php
		if ( has_post_thumbnail() ) { 
			 the_post_thumbnail( 'argent-single-thumbnail' );
	    }

	?>
	
	
	<div class="entry-body">
		<div class="entry-meta">
			<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_term_list( $post->ID, 'twu-portfolio-type', '', __( ', ', 'argent' ) );
			if ( $categories_list && argent_categorized_blog() ) {
				printf( '<span class="cat-links">' . __( 'Organized in %1$s', 'argent' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_term_list( $post->ID, 'twu-portfolio-tag', '', __( ', ', 'argent' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">'. __( 'Tagged %1$s', 'argent' ) . '</span>', $tags_list );
			}
			?>
		</div><!-- .entry-meta -->

		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
	</div><!-- .entry-body -->

	<footer class="entry-footer entry-meta">

		<?php edit_post_link( __( 'Edit', 'argent' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
