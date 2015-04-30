<?php
/**
 * Core functions
 * 
 * @package	wind
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
if ( ! defined('ABSPATH') ) exit;

if ( ! function_exists( 'wind_setup' ) ):
function wind_setup() {
	global $wind_options;
	// Featured Image
	add_theme_support( 'post-thumbnails' );
	// Feed Links required by WordPress
	add_theme_support( 'automatic-feed-links' );
	// Post Formats	
	add_theme_support( 'post-formats', array( 'aside', 'link', 'quote', 'gallery', 'status', 'quote', 'image', 'video', 'audio', 'chat' ) );

	// Load Text Domain
	load_theme_textdomain( 'wind', get_template_directory() . '/core/languages' );
	// Editor Style
	add_editor_style();
	// Custom Background
	add_theme_support( 'custom-background', array(
		'default-color' => '', //Default background color
	) );
	//HTML5 support
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	// Jetpack Featured Content
	add_theme_support( 'featured-content', array(
			'filter' => 'wind_get_featured_posts',
			'max_posts' => $wind_options['fp_posnum'],
		) );
	remove_filter( 'term_description', 'wpautop' );
	// Image Sizes
	add_image_size( 'wind-ticker', 255, 155, true);
	add_image_size( 'wind-featured', apply_filters( 'wind_featured_height', 1080),  apply_filters( 'wind_featured_width', 400) , true);
	add_image_size( 'wind-thumb', 300, 186, true);
	
	do_action( 'wind_after_setup_theme' );
}
endif;
add_action( 'after_setup_theme', 'wind_setup' );

// Get Theme Options
if ( ! function_exists( 'wind_get_options' ) ):
function wind_get_options() {
	$defaults = wind_default_options();
	$options = wp_parse_args( get_option( WIND_THEME_ID . '_options' ),  $defaults );
	return $options;
}
endif;

if ( ! function_exists( 'wind_body_classes' ) ):
function wind_body_classes( $classes ) {
	global $wind_options, $wind_layout;
			
	if ( ! is_single() )
		$classes[] = 'multi';
	if ( ( 2 == $wind_layout ) || is_page_template( 'pages/fullwidth.php') )
		$classes[] = 'fullwidth';
	if ( 2 == $wind_options['slider_type'] && wind_has_featured_content() )
		$classes[] = 'fullwidth-slider';	
	return $classes;
}
endif;
add_filter( 'body_class', 'wind_body_classes' );

if ( ! function_exists( 'wind_post_classes' ) ):
function wind_post_classes( $class ) {
	if ( ( is_sticky() || wind_is_featured() ) )
		$class[] = 'wind-featured';
	return $class;
}
endif;
add_filter('post_class', 'wind_post_classes' );

function wind_scripts_method() {
	global $wind_options;

	$wind_options = wind_get_options();
	$theme_uri = get_template_directory_uri();
// Loading Web Fonts
	$wind_fonts = wind_font_list();

	$fonts = array();
	$font_elements = wind_font_elements();
	foreach ( $font_elements as $option_id => $element ) {
		if ( ! empty( $wind_options[ $option_id ]) && 'default' != $wind_options[ $option_id ]
				&& ! in_array( $wind_options[ $option_id ], $fonts) )
			$fonts[] = $wind_options[ $option_id ];		
	}

	foreach ( $fonts as $font ) {
		if ( ! empty( $wind_fonts[ $font ]['url'] ) )
			wp_enqueue_style( str_replace(' ', '-', $wind_fonts[ $font ]['label']), $wind_fonts[ $font ]['url'], false, '1.0' );
	}
// Foundation CSS
	wp_enqueue_style('wind-addons', $theme_uri . '/core/css/addons.min.css', null, WIND_VERSION );
	wp_enqueue_style('wind-fontawesome', $theme_uri . '/core/css/font-awesome.min.css', null, '4.1.0' );
	wp_enqueue_style('wind-foundation', $theme_uri . '/core/css/foundation.min.css', null, '5.2.2');
// Javascript
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'wind-modernizr' , $theme_uri . '/core/js/modernizr.js', null, true );
	wp_enqueue_script( 'wind-foundation' , $theme_uri . '/core/js/foundation.min.js', array( 'jquery'), '5.2.2', true );

	wp_register_script( 'wind-bxslider', $theme_uri . '/core/js/jquery.bxslider.min.js', array( 'jquery'), '4.1.1', true );		
	wp_enqueue_script( 'wind-bxslider' );
	
	do_action( 'wind_enqueue_scripts' );
}
if ( ! is_admin() )
	add_action( 'wp_enqueue_scripts', 'wind_scripts_method' ); 

function wind_core_sidebars() {
	$sidebars = array (
		'full-widget-area' => array(
			'name' => __( 'Blog Widget Area (Full)', 'wind' ),
			'description' => __( 'Available for Left or Right sidebar layout.', 'wind' ),
		),
		'first-widget-area' => array(
			'name' => __( 'Blog Widget Area 1', 'wind' ),
			'description' => __( 'Blog Widget Area 1', 'wind' ),
		),
		'second-widget-area' => array(
			'name' => __( 'Blog Widget Area 2', 'wind' ),
			'description' => __( 'Blog Widget Area 2', 'wind' ),
		),
		'first-home-widget-area' => array(
			'name' => __( 'Home Widget Area 1', 'wind' ),
			'description' => __( 'Home Widget Area 1', 'wind' ),
		),
		'second-home-widget-area' => array(
			'name' => __( 'Home Widget Area 2', 'wind' ),
			'description' => __( 'Home Widget Area 2', 'wind' ),
		),
		'third-home-widget-area' => array(
			'name' => __( 'Home Widget Area 3', 'wind' ),
			'description' => __( 'Home Widget Area 3', 'wind' ),
		),
		'fourth-home-widget-area' => array(
			'name' => __( 'Home Widget Area 4', 'wind' ),
			'description' => __( 'Home Widget Area 4', 'wind' ),
		),
		'fifth-home-widget-area' => array(
			'name' => __( 'Home Widget Area 5', 'wind' ),
			'description' => __( 'Home Widget Area 5', 'wind' ),
		),
		'first-footer-widget-area' => array(
			'name' => __( 'Footer Widget Area 1', 'wind' ),
			'description' => __( 'Footer Widget Area 1', 'wind' ),
		),
		'second-footer-widget-area' => array(
			'name' => __( 'Footer Widget Area 2', 'wind' ),
			'description' => __( 'Footer Widget Area 2', 'wind' ),
		),
		'third-footer-widget-area' => array(
			'name' => __( 'Footer Widget Area 3', 'wind' ),
			'description' => __( 'Footer Widget Area 3', 'wind' ),
		),
		'fourth-footer-widget-area' => array(
			'name' => __( 'Footer Widget Area 4', 'wind' ),
			'description' => __( 'Footer Widget Area 4', 'wind' ),
		),
	);
	return apply_filters( 'wind_core_sidebars', $sidebars );
}

function wind_widgets_init() {
	register_widget( 'Wind_Recent_Post' );
	register_widget( 'Wind_Navigation' );

	$sidebars = wind_core_sidebars();
	foreach ( $sidebars as $id => $sidebar ) {
		register_sidebar( array(
			'id'   			=> $id,
			'name' 			=> $sidebar['name'],
			'description'   => $sidebar['description'],
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );		
	}	
}
add_action( 'widgets_init', 'wind_widgets_init' );

function wind_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );
	
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'xinwp' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wind_wp_title', 10, 2 );

// Add <p> tag to WordPress the_excerpt()
function wind_excerpt_filter( $content ) {
	return '<p>' . $content . '</p>';
}
remove_filter('the_excerpt', 'wpautop');
add_filter( 'the_excerpt', 'wind_excerpt_filter' );

/** 
* Add span to category/archive count
*/
function wind_category_count_span($links) {
  $links = str_replace( '</a> (', '</a> <span>(', $links );
  $links = str_replace( ')', ')</span>', $links );
  return $links;
}
add_filter( 'wp_list_categories', 'wind_category_count_span' );

function wind_archive_count_span($links) {
  $links = str_replace( '</a>&nbsp;(', '</a> <span>(', $links );
  $links = str_replace( ')', ')</span>', $links );
  return $links;
}
add_filter( 'get_archives_link', 'wind_archive_count_span' );

if ( ! function_exists( 'wind_comment' ) ) :
function wind_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'wind' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( '<i class="fa fa-pencil"></i>'); ?></p>
	</li>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-meta">
<?php 				echo get_avatar( $comment, 40 );
					printf( '<cite class="fn">%1$s</cite>', get_comment_author_link() );  ?>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php
						printf( __( '%1$s at %2$s', 'wind' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<span class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<i class="fa fa-reply"></i>') ) ); ?>
					</span>					
					<?php edit_comment_link( '<i class="fa fa-pencil"></i>' );					
					if ( $comment->comment_approved == '0' ) { ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'wind' ); ?></em>
<?php 				}; ?>
				</div>
			</footer>
			<div class="comment-content"><?php comment_text(); ?></div>

		</article>
	<?php
			break;
	}
}
endif;

function wind_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'wind_excerpt_length' );

function wind_auto_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'wind_auto_excerpt_more' );

function wind_custom_excerpt_more( $output ) {
	if ( ! is_attachment() ) {
		$output .= wind_readmore_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'wind_custom_excerpt_more' );

/**
 * Replace rel="category tag" with rel="tag"
 * For W3C validation purposes only.
 */
function wind_replace_rel_category ($output) {
    $output = str_replace(' rel="category tag"', ' rel="tag"', $output);
    return $output;
}
add_filter('wp_list_categories', 'wind_replace_rel_category');
add_filter('the_category', 'wind_replace_rel_category');

require( get_template_directory() . '/core/general.php' );
require( get_template_directory() . '/core/fonts.php' );
require( get_template_directory() . '/core/lib-foundation.php' );
require( get_template_directory() . '/core/widgets.php' );
require( get_template_directory() . '/core/hooks.php' );
require( get_template_directory() . '/core/extras.php' );
require( get_template_directory() . '/core/lib-content.php' );
require( get_template_directory() . '/core/lib-formats.php' );
require( get_template_directory() . '/core/lib-featured.php' );
require( get_template_directory() . '/core/lib-social.php' );
require( get_template_directory() . '/core/theme-options.php' );
require( get_template_directory() . '/core/theme-customize.php' );

if ( is_admin() ) {
	require( get_template_directory() . '/core/meta-box.php' );
	require( get_template_directory() . '/core/core-admin.php' );
}
