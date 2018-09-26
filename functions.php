<?php
/* Functions to modify parent theme for TRU portfolios
                                                                 */
# -----------------------------------------------------------------
# Theme Setup
# -----------------------------------------------------------------



add_action( 'after_setup_theme', 'twu_hearts_setup');

function twu_hearts_setup() {
	
	//register support for portfolio features
	add_theme_support( 'twu-portfolio' );
}


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


# -----------------------------------------------------------------
# General TWU Portfolio Stuff
# -----------------------------------------------------------------


/* stop jetpack nags with css for admin
	h/t https://gist.github.com/digisavvy/174a8a65accce24d9bc8c8f2441e9bdb     */
	
function twu_portfolio_admin_theme_style() {

	wp_register_style( 'custom_wp_admin_css', get_stylesheet_directory_uri() . '/style-admin.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );

}

add_action('admin_enqueue_scripts', 'twu_portfolio_admin_theme_style');


/* Clean up the +New menu to put "Artifacts" at top, remove "Media" / "User"
   Add a custom menu for TWU (hard wired for now)                            */
   
function twu_portfolio_adminbar() {

	// admin bar needs to be known globally
	global $wp_admin_bar;
	
	// remove all items from New Content menu
	$wp_admin_bar->remove_node('new-post');
	$wp_admin_bar->remove_node('new-media');
	$wp_admin_bar->remove_node('new-page');
	$wp_admin_bar->remove_node('new-user');
	
	// add back the new Post link
	$args = array(
		'id'     => 'new-post',    
		'title'  => 'Blog Post', 
		'parent' => 'new-content',
		'href'  => admin_url( 'post-new.php' ),
		'meta'  => array( 'class' => 'ab-item' )
	);
	$wp_admin_bar->add_node( $args );

	// add back the new Page 
	$args = array(
		'id'     => 'new-page',    
		'title'  => 'Page', 
		'parent' => 'new-content',
		'href'  => admin_url( 'post-new.php?post_type=page' ),
		'meta'  => array( 'class' => 'ab-item' )
	);
	$wp_admin_bar->add_node( $args );


	// add a top menu for the TWU Create links
	$args = array(
		'id'    => 'twu-portfolio',
		'title' => 'TWU Create',
		'href'  => 'https://create.twu.ca/',
		'meta'  => array(
			'title' => __('TWU Create'),            
		),
	);
	
	$wp_admin_bar->add_menu( $args );

	$args = array(
		'id'    => 'portfolio',
		'parent' => 'twu-portfolio',
		'title' => 'E-Portfolio Help',
		'href'  => 'http://create.twu.ca/eportfolios',
		'meta'  => array(
			'title' => __('TWU E-Portfolio information and documentation'),
			'target' => '_blank',
			'class' => ''
		),
	);
	
	$wp_admin_bar->add_menu( $args );

	$args = array(
		'id'    => 'wordpress-guide',
		'parent' => 'twu-portfolio',
		'title' => 'WordPress Guide',
		'href'  => 'http://create.twu.ca/eportfolios/wordpress/',
		'meta'  => array(
			'title' => __('TWU Eportfolio WordPress Guide'),
			'target' => '_blank',
			'class' => ''
		),
	);
	
	$wp_admin_bar->add_menu( $args );
	
	$args = array(
		'id'    => 'wordpress-glossary',
		'parent' => 'twu-portfolio',
		'title' => 'WordPress Glossary',
		'href'  => 'https://www.wpglossary.net/',
		'meta'  => array(
			'title' => __('Definitions of words that you come in contact with when you use WordPress'),
			'target' => '_blank',
			'class' => ''
		),
	);

	$wp_admin_bar->add_menu( $args );	
	
	$args = array(
		'id'    => 'theme-guide',
		'parent' => 'twu-portfolio',
		'title' => 'TWU Hearts Theme',
		'href'  => 'http://create.twu.ca/eportfolios/portfolio-themes/twu-hearts/',
		'meta'  => array(
			'title' => __('Using the TWU Hearts theme'),
			'target' => '_blank',
			'class' => ''
		),
	);
	
	$wp_admin_bar->add_menu( $args );
}

add_action( 'wp_before_admin_bar_render', 'twu_portfolio_adminbar', 99 );

function twu_portfolio_dashboard_widgets() {
	wp_add_dashboard_widget('twu_portfolio_admin', 'Your TWU Portfolio', 'twu_portfolio_make_dashboard_widget');
}

function twu_portfolio_make_dashboard_widget() {
	echo '<p>There are currently <strong>' . twu_artifact_count() . '</strong> artifacts in your portfolio.</p>
	<ul>
		<li><a href="' . get_post_type_archive_link( 'twu-portfolio' ) . '" target="_blank">See all artifacts</a><li>
		<li><a href="' . admin_url( 'edit.php?post_type=twu-portfolio') . '">Manage your artifacts</a></li>	
		<li><a href="' . admin_url( 'post-new.php?post_type=twu-portfolio') . '">Create a new artifact</a></li>
	
	 </ul>';
}

add_action('wp_dashboard_setup', 'twu_portfolio_dashboard_widgets');

function twu_artifact_count() {
	return wp_count_posts('twu-portfolio')->publish;
}


# -----------------------------------------------------------------
# Portfolio Functions
# -----------------------------------------------------------------


// content for the archives
function twu_hearts_portfolio_content( $before = '', $after = '' ) {

	if ( is_tax() && get_the_archive_description() ) {
		echo $before . get_the_archive_description() . $after;
	} else {
		$content = twu_hearts_portfolio_tagline('get');
		echo $before . $content . $after;
	}
}

function twu_portfolio_tax_count ( $taxonomy, $term, $p_type='twu-portfolio' ) {
	// find the number of items in custom post type that use the term in a taxonomy
	
	$args = array(
		'post_type' =>  $p_type,
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $term,
			),
		),
	);
	
	$tax_query = new WP_Query( $args );
	
	return ($tax_query->found_posts);

}

# -----------------------------------------------------------------
# Customizer Additions 
# -----------------------------------------------------------------


add_action( 'customize_register', 'twu_hearts_register_theme_customizer' );

// register custom customizer stuff

function twu_hearts_register_theme_customizer( $wp_customize ) {

	// Add section in customizer for this stuff
	$wp_customize->add_section( 'twu_portfolio' , array(
		'title'    => __('TWU Portfolio', 'argent'),
		'priority' => 10
	) );



	// setting for title label
	$wp_customize->add_setting( 'front_artifact_title', array(
		 'default'           => __( 'Recent Artifacts', 'argent'),
		 'type' => 'theme_mod',
		 'sanitize_callback' => 'sanitize_text'
	) );
	
	// Control for title 
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'front_artifact_title',
		    array(
		        'label'    => __( 'Front Artifact Title', 'argent'),
		        'priority' => 2,
		        'description' => __( 'The heading for artifacts displayed on your front page' ),
		        'section'  => 'twu_portfolio',
		        'settings' => 'front_artifact_title',
		        'type'     => 'text'
		    )
	    )
	);

		
	// setting for count of artifacts to show
	$wp_customize->add_setting( 'front_artifact_count', array(
		'default'           => '3',
		'sanitize_callback' => 'absint',
	) );

	// Control for title 
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'front_artifact_count',
		    array(
		        'label'    => __( 'Number of Artifacts to Show', 'argent'),
		        'priority' => 4,
		        'description' => __( 'How many artifacts to display on front page' ),
		        'section'  => 'twu_portfolio',
		        'settings' => 'front_artifact_count',
				'type'              => 'select',
					'choices' 		=> array(
						'3'	=> '3',
						'4'	=> '4',
						'5' => '5',
						'6' => '6',	
						'7' => '7',	
						'8' => '8',	
						'9' => '9',
						'10' => '10',	
						'11' => '11',
						'12' => '12',							
					),

		    )
	    )
	);

	// setting for categories  prompt
	$wp_customize->add_setting( 'portfolio_tagline', array(
		 'default'           => __( 'Please explore and provide feedback on my artifacts!', 'argent'),
		 'type' => 'theme_mod',
		 'sanitize_callback' => 'sanitize_text'
	) );
	
	// Control for categories prompt
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'portfolio_tagline',
		    array(
		        'label'    => __( 'Tagline for Main Portfolio Page', 'argent'),
		        'priority' => 8,
		        'description' => __( 'Text below the header on  <a href="' . get_post_type_archive_link( 'twu-portfolio' ) . '" target="_blank">Main Portfolio Index</a>' ),
		        'section'  => 'twu_portfolio',
		        'settings' => 'portfolio_tagline',
		        'type'     => 'textarea'
		    )
	    )
	);
	


 	// Sanitize text
	function sanitize_text( $text ) {
	    return sanitize_text_field( $text );
	}	
}

function twu_hearts_front_artifact_title() {
	 if ( get_theme_mod( 'front_artifact_title') != "" ) {
	 	echo get_theme_mod( 'front_artifact_title');
	 }	else {
	 	echo 'Recent Artifacts';
	 }
}

function twu_hearts_front_artifact_count() {
	 if ( get_theme_mod( 'front_artifact_count') != "" ) {
	 	return get_theme_mod( 'front_artifact_count');
	 }	else {
	 	return 6;
	 }
}

function twu_hearts_portfolio_tagline( $mode = 'echo' ) {
	 if ( get_theme_mod( 'portfolio_tagline') != "" ) {
	 	if ($mode == 'echo' ) {
	 		echo get_theme_mod( 'portfolio_tagline');
	 	} else {
	 		return get_theme_mod( 'portfolio_tagline');
	 	}
	 	
	 }	else {
	 
	 	if ($mode == 'echo' ) {
	 		echo 'Please explore and provide feedback on my artifacts!';
	 	} else {
	 		return 'Please explore and provide feedback on my artifacts!';
	 	
	 	}
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


// Load enhancement file to display admin notices.
require get_stylesheet_directory() . '/inc/twu-hearts-enhancements.php';



?>