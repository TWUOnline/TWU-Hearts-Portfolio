<?php
/* Functions to modify parent theme for TRU portfolios
                                                                 */


# -----------------------------------------------------------------
# Enqueue Scripts 'n Styles
# -----------------------------------------------------------------

function twu_portfolio_enqueues() {	 
 
    $parent_style = 'argent_style'; 
    
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );

}

add_action('wp_enqueue_scripts', 'twu_portfolio_enqueues');

/* stop jetpack nags 
	h/t https://gist.github.com/digisavvy/174a8a65accce24d9bc8c8f2441e9bdb     */
	
function twu_portfolio_admin_theme_style() {

	wp_register_style( 'custom_wp_admin_css', get_stylesheet_directory_uri() . '/style-admin.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );

}

add_action('admin_enqueue_scripts', 'twu_portfolio_admin_theme_style');


# -----------------------------------------------------------------
# Portfolio Functions, taken off the jetpack
# -----------------------------------------------------------------

// headings for archives
function twu_inspire_portfolio_title( $before = '', $after = '', $is_archive=false ) {
	$title = '';

	if ( is_post_type_archive( 'twu-portfolio' ) ) {
		
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax( 'twu-portfolio-type' ) || is_tax( 'twu-portfolio-tag' ) ) {
		$title = ( is_tax( 'twu-portfolio-tag' ) ) ? 'Artifacts Tagged "' : 'Artifacts of Type "';
		$title .= single_term_title( '', false ) . '"';
	}

	echo $before . $title . $after;
}

// content for the archives
function twu_inspire_portfolio_content( $before = '', $after = '' ) {

	if ( is_tax() && get_the_archive_description() ) {
		echo $before . get_the_archive_description() . $after;
	} else {
		$content = 'Please explore and provide feedback on my artifacts!';
		echo $before . $content . $after;
	}
}



# -----------------------------------------------------------------
# Misc Stuff
# useful wrenches and hammers
# -----------------------------------------------------------------


// remove the page template placed there for jetpack portfolios
// h/t https://gist.github.com/rianrietveld/11245571

function twu_hearts_remove_page_template( $pages_templates ) {
    unset( $pages_templates['page-templates/front-page.php'] );
return $pages_templates;
}

add_filter( 'theme_page_templates', 'twu_hearts_remove_page_template' );
?>