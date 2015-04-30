<?php
/**
 * Passion Functions
 * 
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */

//Load Core functions
require_once( get_template_directory() . '/inc/theme-settings.php' );
require_once( get_template_directory() . '/core/core-functions.php' );

add_action( 'after_setup_theme', 'passion_theme_setup' );
if ( ! function_exists( 'passion_theme_setup' ) ):
function passion_theme_setup() {
	// Global variable for content width
	if ( ! isset( $content_width ) ) 
		$content_width = 690; // pixels

	load_theme_textdomain( 'passion', get_template_directory() . '/core/languages' );
	
	register_nav_menus( array(
		'top-bar' => __( 'Top Menu' , 'passion' ),
		'section' => __( 'Section Menu' , 'passion' ),
		'footer'  => __( 'Footer Menu', 'passion' ),
	));
}
endif;

function passion_theme_scripts_method() {
	global $wind_options;
	
	$theme_uri = get_template_directory_uri();		

	wp_enqueue_style( 'passion', $theme_uri . '/css/passion.css', array( 'wind-foundation' ), WIND_VERSION );
	$child_pre = array( 'passion' );
	
    $option_css = wind_option_css();
	if ( ! empty( $option_css ) )
	    wp_add_inline_style( 'passion', htmlspecialchars_decode( $option_css ) );
    if ( ! empty( $wind_options['inline_css'] ) )
     	wp_add_inline_style( 'passion', htmlspecialchars_decode( $wind_options['inline_css'] ) );
    if ( wind_has_featured_content() )
     	wp_add_inline_style( 'passion', htmlspecialchars_decode( wind_featured_fullwidth_css() ) );
    if ( 'default' != $wind_options['scheme'] ) {
		$schemes = apply_filters( 'wind_scheme_options', NULL );		
		wp_enqueue_style( 'passion-scheme', $schemes[ $wind_options['scheme'] ]['css'], $child_pre, WIND_VERSION );
 		$child_pre = array( 'passion-scheme' );
	}
	
	//Load child theme's style.css
    if ( $theme_uri != get_stylesheet_directory_uri() )
		wp_enqueue_style('passion-child', get_stylesheet_uri(), $child_pre, WIND_VERSION );

	// Load Javascript
	wp_enqueue_script( 'passion' , $theme_uri . '/js/passion.js', array( 'wind-foundation', 'wind-bxslider'), WIND_VERSION, true );

	$options = array( 'fixedmenu' => $wind_options['fixedmenu'] );
	wp_localize_script( 'passion', 'windData', $options );
}
if ( ! is_admin() )
	add_action( 'wp_enqueue_scripts', 'passion_theme_scripts_method' ); 

// Post Meta Below Title
if ( ! function_exists( 'passion_meta_top' ) ) :
function passion_meta_top() {
	if ( 'post' == get_post_type() ) {
		$sep = apply_filters( 'wind_meta_seperator', __( '<li class="meta-sep">/</li>', 'passion' ) );
		wind_jetpack_sharing( 'top' );
		$author = wind_meta_author();
		$date = wind_meta_date();
		
		$html = '<ul class="entry-meta">';
		if ( is_sticky() || wind_is_featured() ) {
			$html .= sprintf( '<li class="entry-featured">%1$s</li>', __( 'Featured', 'passion' ) );
			if ( !empty( $author ) || ! empty( $date ) )
				$html .= $sep;
		}

		$html .= $author;
		if ( !empty( $author ) && ! empty( $date ) )
			$html .= $sep;
		$html .= $date;
		$html .= '</ul>';
		echo apply_filters( 'passion_meta_top', $html );	
	}
}
endif;

// Post Meta Above Title
if ( ! function_exists( 'passion_meta_bottom' ) ) :
function passion_meta_bottom() {
	if ( 'post' == get_post_type() ) {
		$html = '<ul class="entry-meta entry-meta-bottom clearfix">';		
		$html .= wind_meta_category();	
		$html .= wind_meta_tag();
		$html .= wind_meta_comment();
		$html .= '</ul>';
		echo apply_filters( 'passion_meta_bottom', $html );
	}
}
endif;

function passion_scheme_options( $scheme  ) {
	$theme_uri = get_template_directory_uri();
	$schemes = array(
		'default' 	=> array(
			'label' => __('Default','passion'),
			'css'   => '',
		),
		'rose' 	=> array(
			'label' => __('Rose','passion'),
			'css'   => $theme_uri . '/css/rose.css',
		),
	);
	return $schemes;
}
add_filter( 'wind_scheme_options', 'passion_scheme_options');

function passion_option_tabs( $tabs  ) {
	$tabs['homepage'] = array( 
		'label' => __( 'Home Page', 'passion' ),
		'desc'  => __( 'The options in this section are used in Home Template. See instruction <a href="http://www.rewindcreation.com/how-to-use-page-template/" target="_blank"><strong>here</strong></a>.', 'passion' ),
		'priority' => 25 );
	return $tabs;
}
add_filter( 'wind_option_tabs', 'passion_option_tabs');

function passion_theme_sidebars( $sidebars ) {
	$sidebars['header-widget-area'] = array(
			'name' => __( 'Header Widget Area', 'passion' ),
			'description' => __( 'Header Widget Area', 'passion' ),
	);
	return $sidebars;
}
add_filter( 'wind_core_sidebars', 'passion_theme_sidebars');

function passion_theme_default_options( $defaults ) {
	$defaults['sitetitlefont'] = 'Lobster';
	$defaults['slider_type'] = '2';	
	$defaults['sectionmenu'] = 'after';

	$defaults['cta_active'] = 1;
	$defaults['headline'] = __( 'This is your H1 headline', 'passion');	
	$defaults['tagline'] = __( 'Change Headline, Tagline and Call To Action in theme options', 'passion');	
	$defaults['cta_label'] = __( 'Act Now', 'passion');	
	$defaults['cta_url'] = '';	
	
	$defaults['home_cat'] = '';	
	$defaults['home_columns'] = 4;
	$defaults['home_postnum'] = 5;
	
	$defaults['home_widget'] = 1;

	return $defaults;		
}
add_filter( 'wind_default_options', 'passion_theme_default_options' );

function passion_theme_options( $options ) {
	$options['cta_active'] = array(
			'name'	=> 'cta_active',
			'section'	=> 'homepage',
			'heading' => __( 'Active', 'passion' ),
			'label' => __( 'Call To Action', 'passion' ),
			'desc' => __( 'Check to display Call To Action', 'passion' ),
			'type'	=> 'checkbox',
	);
	$options['headline'] = array(
			'name'	=> 'headline',
			'section'	=> 'homepage',
			'label' => __( 'H1 Headline', 'passion' ),
			'type'	=> 'text',
	);
	$options['tagline'] = array(
			'name'	=> 'tagline',
			'section'	=> 'homepage',
			'label' => __( 'Tagline', 'passion' ),
			'type'	=> 'text',
	);
	$options['cta_label'] = array(
			'name'	=> 'cta_label',
			'section'	=> 'homepage',
			'label' => __( 'Call To Action (Label)', 'passion' ),
			'type'	=> 'text',
	);
	$options['cta_url'] = array(
			'name'	=> 'cta_url',
			'section'	=> 'homepage',
			'label' => __( 'Call To Action (URL)', 'passion' ),
			'type'	=> 'url',
	);
	$options['home_cat'] = array(
			'name'	=> 'home_cat',
			'section'	=> 'homepage',
			'heading' => __( 'Home Categories', 'passion' ),
			'label' => __( 'Home Categories', 'passion' ),
			'type'	=> 'category',
			'helptext' => __( 'Drag the categories from Available to Active section and arrange the sequence. A category will only be Available if it has at least 5 posts.', 'passion' ),
	);
	$options['home_columns'] = array(
			'name'	=> 'home_columns',
			'section'	=> 'homepage',
			'label' => __( 'Layout', 'passion' ),
			'type'	=> 'radio',
			'choices' => array(
					'2'		=> __( '2 Columns', 'passion' ),
					'3' 	=> __( '3 Columns', 'passion' ),
					'4'		=> __( '4 Columns', 'passion' )
			),
	);
	$options['home_postnum'] = array(
			'name'	=> 'home_postnum',
			'section'	=> 'homepage',
			'label' => __( '# of Posts to display', 'passion' ),
			'desc' => __( 'for each category', 'passion' ),
			'type'	=> 'number',
	);
	$options['home_widget'] = array(
			'name'	=> 'home_widget',
			'section'	=> 'homepage',
			'heading' => __( 'Home Widgets', 'passion' ),
			'label' => __( 'Home Widgets', 'passion' ),
			'desc' => __( 'Include Home Widgets', 'passion' ),
			'type'	=> 'checkbox',
	);

	return 	$options;
}
add_filter( 'wind_theme_options', 'passion_theme_options' );

$wind_options = wind_get_options(); //Global Theme Options

