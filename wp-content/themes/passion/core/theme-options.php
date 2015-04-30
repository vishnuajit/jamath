<?php
/**
 * Wind Options
 * 
 * @package	wind
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
if ( ! defined('ABSPATH') ) exit;

function wind_default_options() {
	$defaults = array(
		'currenttab' => 0,	
		'gridwidth' => 1080,
		'content' => 8,
		'sidebar1' => 2,
		'sidebar2' => 2,
		'sidebarpos' => 1,
		'column_content' => 3,
		'logo' => '',
		'brandname' => '',
		'brandurl' => '',
		'menupos' => 'right',
		'fixedmenu' => 0,
		'searchbox' => 1,
		'column_home1' => 4,	
		'column_home2' => 4,	
		'column_home3' => 4,	
		'column_home4' => 0,	
		'column_home5' => 0,	
		'column_footer1' => 4,
		'column_footer2' => 4,		
		'column_footer3' => 4,		
		'column_footer4' => 0,		
		'inline_css' => '',
		'fp_option' => 1,
		'fp_category' => 0,
		'fp_posnum' => 4,
		'fp_tspeed' => 100000,
		'slider_home' => 1,
		'slider_blog' => 1,
		'slider_post' => 0,
		'slider_page' => 0,
		'slider_type' => 1,		
		'slider_mode' => 'horizontal',
		'slider_height' => 400,
		'ticker_speed' => 100,
		'slider_speed' => 10,
		'ticker_min' => 2,
		'ticker_max' => 4,
		'bodyfont' => 'default',
		'headingfont' => 'default',
		'titlefont' => 'default',
		'sitetitlefont' => 'default',
		'share_top' => 0,
		'share_bottom' => 1,
		'showauthor' => 1,
		'showthumb' => 1,
		'sectionmenu' => 'before',
		'scheme' => 'default',
		'hidecredit' => 0,
	);
	return apply_filters( 'wind_default_options', $defaults);
}

function wind_option_tabs() {	
	$tabs = array(
		'layout'	=> array( 'label'	=> __( 'Layout', 'wind' ), 'priority' => 10 ),
		'featured'	=> array( 'label'	=> __( 'Featured', 'wind' ), 'priority' => 20 ),
		'css'		=> array( 'label'	=> __( 'Custom CSS', 'wind'), 'priority' => 99 ),
	);
	$sorted_tab = apply_filters( 'wind_option_tabs', $tabs );
	wind_sort_array( $sorted_tab, 'priority' );
	return $sorted_tab;
}

function wind_customize_sections() {	
	$sections = array(
		'title_tagline'	=> array(  // WordPress Standard Sections
			'priority' => 10 ),	
		'header'	=> array( 
			'label' => __( 'Header', 'wind' ), 
			'description' => '', 
			'priority' => 30 ),
		'nav'	=> array(  // WordPress Standard Sections
			'priority' => 30 ),
		'colors'	=> array( // WordPress Standard Sections
			'priority' => 31 ),
		'fonts'	=> array( 
			'label' => __( 'Fonts', 'wind' ), 
			'description' => __( '* indicates web fonts', 'wind' ), 
			'priority' => 31 ),
		'posts'	=> array( 
			'label' => __( 'Posts', 'wind' ), 
			'description' => '',
			'priority' => 32 ),
	);
	return apply_filters( 'wind_customize_sections', $sections );
}

function wind_theme_options() {
	$fonts = wind_font_choices();
	
	$theme_options = array(
		'currenttab'	=> array(
			'name'  => 'currenttab',
			'section'	=> 'hidden',
			'type'	=> 'hidden',			
		),	
// Layout
		'gridwidth'	=> array(
			'name'  => 'gridwidth',
			'section'	=> 'layout',
			'label'	=> __( 'Grid Width', 'wind' ),
			'heading' => __( 'Site Layout (12 Columns)', 'wind' ),
			'type'	=> 'number',
			'desc'	=> __( 'Pixels', 'wind' ),
		),
		'content'	=> array(
			'name'  => 'content',		
			'section'	=> 'layout',
			'grouplabel'	=> __( 'Content and Sidebar Width', 'wind' ),
			'label' => __( 'Content', 'wind' ),
			'type'	=> 'number',
			'group'	=> '1',
		),
		'sidebar1'	=> array(
			'name'  => 'sidebar1',
			'section'	=> 'layout',
			'label'	=> __( 'Sidebar 1', 'wind' ),
			'type'	=> 'number',
			'group'	=> '2',
		),
		'sidebar2'	=> array(
			'name'  => 'sidebar2',
			'section'	=> 'layout',
			'label'	=> __( 'Sidebar 2', 'wind' ),
			'type'	=> 'number',
			'desc' => __( 'Columns', 'wind' ),
			'group'	=> '3',
		),
		'sidebarpos'	=> array(
			'name'  => 'sidebarpos',
			'section'	=> 'layout',
			'label'	=> __( 'Sidebar Position', 'wind' ),
			'type'	=> 'radio',		
			'choices' => array(
					'1'		=> __( 'Right', 'wind' ),
					'2' 	=> __( 'Left', 'wind' ),
					'3'		=> __( 'Left & Right', 'wind' )
			),
			'helptext' => __( 'For Left & Right layout, Blog Widget Area (Full) will not be displayed. The total number of columns must be 12.', 'wind' ),
		),
		'column_content'	=> array(
			'name'  => 'column_content',
			'section'	=> 'layout',
			'label'	=> __( 'Content Columns', 'wind' ),
			'type'	=> 'na',		
			'choices' => array(
					'2'		=> __( '2 Columns', 'wind' ),
					'3'		=> __( '3 Columns', 'wind' ),
					'4'		=> __( '4 Columns', 'wind' ),
			),
		),
// Branding
		'logo'	=> array(
			'name'  => 'logo',
			'section'	=> 'layout',
			'heading' => __( 'Branding', 'wind' ),
			'label'	=> __( 'Logo', 'wind' ),
			'type'	=> 'image',
		),
		'brandname'	=> array(
			'name'  => 'brandname',
			'section'	=> 'layout',
			'label'	=> __( 'Brand Name', 'wind' ),
			'type'	=> 'text',
		),
		'brandurl'	=> array(
			'name'  => 'brandurl',
			'section'	=> 'layout',
			'label'	=> __( 'Brand URL', 'wind' ),
			'type'	=> 'url',
		),
// Header
		'menupos'	=> array(
			'name'  => 'menupos',
			'section'	=> 'nav',
			'label'	=> __( 'Top Menu Position', 'wind' ),
			'type'	=> 'radio',
			'choices' => array(
				'left'		=> __( 'Left', 'wind' ),
				'right'		=> __( 'Right', 'wind' ),
			),
		),
		'fixedmenu'	=> array(
			'name'  => 'fixedmenu',
			'section'	=> 'nav',
			'label'	=> __( 'Fixed Menu on Top', 'wind' ),
			'type'	=> 'checkbox',
		),
		'searchbox'	=> array(
			'name'  => 'searchbox',
			'section'	=> 'nav',
			'label'	=> __( 'Search Box', 'wind' ),
			'type'	=> 'checkbox',
		),
		'sectionmenu'	=> array(
			'name'	=> 'sectionmenu',
			'section'	=> 'nav',
			'label'	=> __( 'Section Menu Location', 'wind' ),
			'type'	=> 'radio',
			'choices' => array(
				'before'	=> __( 'Above Slider', 'wind' ),
				'after'		=> __( 'Below Slide', 'wind' ),
			),
		),
// Home Widget Area
		'column_home1'	=> array(
			'name'	=> 'column_home1',
			'section'	=> 'layout',
			'heading' => __( 'Home Page', 'wind' ),
			'grouplabel'	=> __( 'Home Widget Area Width', 'wind' ),
			'type'	=> 'number',
			'group'	=> '1',
		),
		'column_home2'	=> array(
			'name'	=> 'column_home2',
			'section'	=> 'layout',
			'type'	=> 'number',
			'group'	=> '2',
		),
		'column_home3'	=> array(
			'name'	=> 'column_home3',
			'section'	=> 'layout',
			'type'	=> 'number',
			'group'	=> '2',
		),
		'column_home4'	=> array(
			'name'	=> 'column_home4',
			'section'	=> 'layout',
			'type'	=> 'number',
			'group'	=> '2',
		),
		'column_home5'	=> array(
			'name'	=> 'column_home5',
			'section'	=> 'layout',
			'type'	=> 'number',
			'desc' => __( 'Columns', 'wind' ),
			'group'	=> '3',
		),
// Footer Widget Area
		'column_footer1'	=> array(
			'name'	=> 'column_footer1',
			'section'	=> 'layout',
			'heading' => __( 'Footer', 'wind' ),			
			'grouplabel'	=> __( 'Footer Widget Area Width', 'wind' ),
			'type'	=> 'number',
			'group'	=> '1',
		),
		'column_footer2'	=> array(
			'name'	=> 'column_footer2',
			'section'	=> 'layout',
			'type'	=> 'number',
			'group'	=> '2',
		),
		'column_footer3'	=> array(
			'name'	=> 'column_footer3',
			'section'	=> 'layout',
			'type'	=> 'number',
			'group'	=> '2',
		),
		'column_footer4'	=> array(
			'name'	=> 'column_footer4',
			'section'	=> 'layout',
			'type'	=> 'number',
			'desc' => __( 'Columns', 'wind' ),
			'group'	=> '3',
		),
		'hidecredit'	=> array(
			'name'	=> 'hidecredit',
			'section'	=> 'layout',
			'label' => __( 'Design Credit', 'wind' ),
			'desc' => __( 'Hide Design Credit', 'wind' ),
			'type'	=> 'checkbox',
		),
// Featured Posts
		'fp_option'	=> array(
			'name'	=> 'fp_option',
			'section'	=> 'featured',
			'heading'	=> __( 'Featured Content Selection', 'wind' ),
			'label'	=> __( 'Content for Slider', 'wind' ),
			'type'	=> 'radio',
			'choices' => array(
				'1'		=> __( 'Featured Category', 'wind' ),
				'2'		=> __( 'Featured Posts', 'wind' ),
				'3'		=> __( 'Jetpack Featured Content', 'wind' ),
			),
			'helptext' => __( '<a href="http://www.rewindcreation.com/featured-content/" target="_blank">Read instruction</a>', 'wind' ),
		),
		'fp_category'	=> array(
			'name'	=> 'fp_category',
			'section'	=> 'featured',
			'label'	=> __( 'Featured Category', 'wind' ),
			'type'	=> 'select',
			'choices' => wind_category_choices(),
		),
		'fp_posnum'	=> array(
			'name'	=> 'fp_posnum',
			'section'	=> 'featured',
			'label'	=> __( 'Number of Posts', 'wind' ),
			'type'	=> 'number',	
		),
// Carousel
		'slider_home'	=> array(
			'name'	=> 'slider_home',
			'section'	=> 'featured',
			'heading'	=> __( 'Carousel', 'wind' ),			
			'grouplabel'	=> __( 'Carousel Location', 'wind' ),
			'desc'	=> __( 'Home Page', 'wind' ),
			'type'	=> 'checkbox',
			'group' => '1',	
		),
		'slider_blog'	=> array(
			'name'	=> 'slider_blog',
			'section'	=> 'featured',
			'desc'	=> __( 'Blog Index', 'wind' ),
			'type'	=> 'checkbox',
			'group' => '2',	
		),		
		'slider_post'	=> array(
			'name'	=> 'slider_post',
			'section'	=> 'featured',
			'desc'	=> __( 'Post', 'wind' ),
			'type'	=> 'checkbox',
			'group' => '2',	
		),
		'slider_page'	=> array(
			'name'	=> 'slider_page',
			'section'	=> 'featured',
			'desc'	=> __( 'Page', 'wind' ),
			'type'	=> 'checkbox',
			'group' => '3',	
		),
		'slider_type'	=> array(
			'name'	=> 'slider_type',
			'section'	=> 'featured',
			'label'	=> __( 'Carousel Type', 'wind' ),
			'type'	=> 'radio',
			'choices' => array(
				'1'		=> __( 'Ticker', 'wind' ),
				'2'		=> __( 'Full Width Slider', 'wind' ),
				'3'		=> __( 'Grid Width Slider', 'wind' ),
			),
		),
// Ticker
		'ticker_min'	=> array(
			'name'	=> 'ticker_min',
			'section'	=> 'featured',
			'heading'	=> __( 'Ticker', 'wind' ),	
			'grouplabel' => __( 'Ticker Items', 'wind' ),
			'label'	=> __( 'Min', 'wind' ),
			'type'	=> 'number',
			'group' => '1',	
		),
		'ticker_max'	=> array(
			'name'	=> 'ticker_max',
			'section'	=> 'featured',
			'label'	=> __( 'Max', 'wind' ),
			'type'	=> 'number',
			'group' => '3',	
		),	
		'ticker_speed'	=> array(
			'name'	=> 'ticker_speed',
			'section'	=> 'featured',
			'label'	=> __( 'Speed', 'wind' ),
			'type'	=> 'number',
			'desc'	=> __( 'seconds', 'wind' ),
		),
// Slider
		'slider_mode'	=> array(
			'name'	=> 'slider_mode',
			'section'	=> 'featured',
			'heading'	=> __( 'Slider', 'wind' ),
			'label'	=> __( 'Animation', 'wind' ),
			'type'	=> 'radio',
			'choices' => array(
				'horizontal'	=> __( 'Horizontal', 'wind' ),
				'vertical'			=> __( 'Vetical', 'wind' ),
				'fade'			=> __( 'Fade', 'wind' ),
			),
		),
		'slider_height'	=> array(
			'name'	=> 'slider_height',
			'section'	=> 'featured',
			'label'	=> __( 'Height', 'wind' ),
			'desc' => __( 'Relevant to Full Width Slider only', 'wind' ),
			'type'	=> 'number',
		),	
// Fonts
		'sitetitlefont'	=> array(
			'name'	=> 'sitetitlefont',
			'section'	=> 'title_tagline',
			'label'	=> __( 'Site Title Font', 'wind' ),
			'type'	=> 'font',	
			'choices' => $fonts,
		),
		'bodyfont'	=> array(
			'name'	=> 'bodyfont',
			'section'	=> 'fonts',
			'label'	=> __( 'Body / Paragraph', 'wind' ),
			'type'	=> 'font',
			'choices' => $fonts,
		),
		'headingfont'	=> array(
			'name'	=> 'headingfont',
			'section'	=> 'fonts',
			'label'	=> __( 'Heading', 'wind' ),
			'type'	=> 'font',	
			'choices' => $fonts,
		),
		'titlefont'	=> array(
			'name'	=> 'titlefont',
			'section'	=> 'fonts',
			'label'	=> __( 'Post Title', 'wind' ),
			'type'	=> 'font',	
			'choices' => $fonts,
		),
		'slider_speed'	=> array(
			'name'	=> 'slider_speed',
			'section'	=> 'featured',
			'label'	=> __( 'Speed', 'wind' ),
			'type'	=> 'number',
			'desc'	=> __( 'seconds', 'wind' ),
		),
// Posts
		'showthumb'	=> array(
			'name'	=> 'showthumb',
			'section'	=> 'posts',
			'label'	=> __( 'Display Featured Image', 'wind' ),
			'type'	=> 'checkbox',	
		),
		'share_top'	=> array(
			'name'	=> 'share_top',
			'section'	=> 'posts',
			'label'	=> __( 'Show Jetpack Sharing On Top', 'wind' ),
			'type'	=> 'checkbox',	
		),
		'share_bottom'	=> array(
			'name'	=> 'share_bottom',
			'section'	=> 'posts',
			'label'	=> __( 'Show Jetpack Sharing At Bottom', 'wind' ),
			'type'	=> 'checkbox',	
		),
		'showauthor'	=> array(
			'name'	=> 'showauthor',
			'section'	=> 'posts',
			'label'	=> __( 'Display Author', 'wind' ),
			'type'	=> 'checkbox',	
		),		
// Custom CSS
		'inline_css'	=> array(
			'name'  => 'inline_css',
			'section'	=> 'css',
			'label'	=> __( 'Custom CSS Style', 'wind' ),
			'type'	=> 'textarea',
			'row'   => 40,
		),
//Colors
		'scheme'	=> array(
			'name'	=> 'scheme',
			'section'	=> 'colors',
			'label'	=> __( 'Color Scheme', 'wind' ),
			'type'	=> 'select',
			'choices' => wind_scheme_choices(),
		),	
	);
	return apply_filters( 'wind_theme_options', $theme_options );
}

function wind_scheme_choices() {
	$schemes = apply_filters( 'wind_scheme_options', NULL);
	$choices = array();
	foreach ($schemes as $key => $scheme )
		$choices[ $key ] = $scheme['label'];
	return $choices;
}

function wind_admin_enqueue_scripts( $hook_suffix ) {			
	$template_uri = get_template_directory_uri();
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'wind-admin-options', $template_uri . '/core/css/theme-options.css', false, WIND_VERSION );

	wp_enqueue_media();	
	wp_enqueue_script( 'wind-admin-options', $template_uri . '/core/js/theme-options.js', array('jquery', 'wp-color-picker', 'jquery-ui-sortable'), WIND_VERSION );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'wind_admin_enqueue_scripts' );

function wind_options_init() {
    register_setting( WIND_THEME_ID . '_options', WIND_THEME_ID . '_options', 'wind_options_validate' );
}
add_action( 'admin_init', 'wind_options_init' );

function wind_theme_options_admin_menu() {
    add_theme_page( __( 'Theme Options', 'wind' ), __('Theme Options', 'wind' ), 'edit_theme_options', 'theme_options', 'wind_theme_options_display_page' );
}
add_action( 'admin_menu', 'wind_theme_options_admin_menu' );

function wind_theme_options_display_page() {
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
?>
    <div class="wrap">
<?php
  		echo "<h2>" . WIND_THEME_NAME .  ' ' . __( 'Theme Options', 'wind') . "</h2>";
		if ( false !== $_REQUEST['settings-updated'] ) { ?>
			<div class="updated fade"><p><strong><?php _e('Options Saved', 'wind'); ?></strong></p></div>
<?php	} ?>
		<p><a class="btn btn-primary" href="<?php _e('http://rewindcreation.com/docs/','wind'); ?>" target="_blank"><strong><?php _e('Documentation','wind'); ?></strong></a>&nbsp;&nbsp;
		<a class="btn btn-success" href="<?php _e('http://rewindcreation.com/support/','wind'); ?>" target="_blank"><strong><?php _e('Support Forum','wind'); ?></strong></a>&nbsp;&nbsp;
		<a class="btn btn-info" href="<?php _e('http://rewindcreation.com/donate/','wind'); ?>" target="_blank"><strong><?php _e('Donate','wind'); ?></strong></a></p>
    <form method="post" action="options.php">
<?php
	settings_fields( WIND_THEME_ID . '_options');
?>
	<div id="wind-wrapper" class="container_12">
	<div class="grid_9 alpha">
	<div id="wind-tabs">
<?php
	global $wind_options;
	
	$wind_options = wind_get_options();

	$tabs = wind_option_tabs();
	foreach ( $tabs as $tab )
		echo '<a>' . $tab['label'] . '</a>';
?>
	</div><!-- wind-tabs -->
<?php
	foreach ( $tabs as $tab_id => $tab )
		wind_option_display_tab( $tab_id, $tab );
?>
<?php
	wind_option_display_tab( 'hidden' );
	$sections = wind_customize_sections();
	foreach ( $sections as $section_id => $section )	
		wind_option_display_section( $section_id );
?>
	<p><input id="save-button-bottom" type="submit" class="button-primary" value="<?php _e( 'Save Options', 'wind' ); ?>" /></p>
	</div>
	<div class="grid_3">
	</div>
	</div><!-- wind-wrapper -->
    </form>
    </div><!-- wrap -->
<?php
}

function wind_option_display_tab( $id, $tab = NULL ) {
	$wind_theme_options = wind_theme_options();
	if ( 'hidden' != $id ) {
		echo '<div class="wind-pane clearfix"><div class="grid_12">';
		if ( ! empty( $tab['desc'] ) )
			echo '<p>' . $tab['desc'] . '</p>';
	}
	foreach ( $wind_theme_options as $theme_option )
		if ( !empty( $theme_option['section'] ) && $theme_option['section'] == $id )
			wind_option_display( $theme_option );
	if ( 'hidden' != $id )	
		echo '</div></div>';
}

function wind_option_display_section( $id ) {
	global $wind_options;
	
	$wind_theme_options = wind_theme_options();
	foreach ( $wind_theme_options as $theme_option )
		if ( !empty( $theme_option['section'] ) && $theme_option['section'] == $id ) {
			$option_name = WIND_THEME_ID . '_options[' . $theme_option['name'] . ']';			
			printf( '<input id="%1$s" name="%2$s" type="hidden" value="%3$s" />',
					$theme_option['name'],
					$option_name,
				 	esc_attr( $wind_options[ $theme_option['name'] ] ) );			
		}
}

function wind_option_display( $theme_option ) {
	global $wind_options;
	
	if ( empty( $theme_option['name'] ) || 'na' == $theme_option['type'] )
		return;
	$name = WIND_THEME_ID . '_options[' . $theme_option['name'] . ']';
	if ( !empty( $theme_option['heading'] ) &&  'hidden' != $theme_option['type'] )
		echo '<h3>' . esc_attr( $theme_option['heading'] ) . '</h3>';
	if ( $theme_option['type'] != 'hidden' && ( empty( $theme_option['group'] ) || ( '1' == $theme_option['group'] ) )  ) {
		if ( isset( $theme_option['grouplabel'] ) ) {
			echo '<div class="grid_3 alpha">';	
			echo '<p><b>' . $theme_option['grouplabel'] . '</b></p></div>';		
		}
		elseif ( isset( $theme_option['label'] ) ) {
			echo '<div class="grid_3 alpha">';	
			echo '<p><b>' . $theme_option['label'] . '</b></p></div>';		
		}
		if ( 'category' == $theme_option['type'] )
			echo '<div class="grid_9">';	
		else
			echo '<div class="grid_9"><p>';	
	}
	switch ( $theme_option['type'] ) {	
		case 'number':
			if ( ! empty( $theme_option['group'] )  && ! empty( $theme_option['label'] ) )
				printf( '<label class="description">%s</label>', esc_attr( $theme_option['label'] ) );
			printf( '<input name="%1$s" type="text" value="%2$s" size="4" />',
					$name,
				 	esc_attr( $wind_options[ $theme_option['name'] ] ) );
			if ( ! empty( $theme_option['desc'] ) )
				printf( '<label class="description"> %s</label>', esc_attr( $theme_option['desc'] ) );
			echo '&nbsp;&nbsp;&nbsp;&nbsp;';
			break;
		case 'radio':
			$choices = $theme_option['choices'];
			foreach ( $choices as $key => $label ) {
				printf( '<input id="%1$s_%2$s" name="%1$s" type="radio" value="%2$s" %3$s />',
					$name,
				 	$key,
				 	checked( $key, $wind_options[$theme_option['name']], false ) );
				printf( '<label class="description" for="%1$s_%2$s"> %3$s</label> ',
					$name,
					$key,
					esc_attr( $label ) );
			}
			break;
		case 'checkbox':
			printf( '<input id="%1$s" name="%1$s" type="checkbox" value="1" %2$s />',
					$name,
				 	checked( '1', $wind_options[$theme_option['name']], false ) );
			printf( '<label class="description" for="%1$s">%2$s </label>',
					$name,
					esc_attr( $theme_option['desc'] )	);
			break;
		case 'textarea':
			printf( '<textarea name="%1$s" cols="84" rows="%2$s">%3$s</textarea>',
					$name,
					$theme_option['row'], 
				 	esc_textarea( $wind_options[ $theme_option['name'] ] ) );
			break;
		case 'image':
			printf( '<input id="%1$s" name="%1$s" class="media-upload-url" type="hidden" value="%2$s" />',
					$name,
				 	esc_attr( $wind_options[$theme_option['name']] ) );
			printf( '<input class="media-upload-btn" type="button" value="%1$s" />', __( 'Choose/Upload Logo', 'wind' ) );
			printf( '<input class="media-upload-del" type="button" value="%1$s" />', __( 'Remove', 'wind' )  );
			printf( '<img src="%1$s" class="media-upload-src">' , esc_attr( $wind_options[$theme_option['name']] ) );

			break;
		case 'select':
			printf( '<select name="%1$s" >', $name );
			$selected_option = $wind_options[ $theme_option['name'] ];
			$choices = $theme_option['choices'];
			
			foreach ( $choices as $key => $label ) {
				printf( '<option value="%1$s" %2$s>%3$s</option>',
					$key,
					selected( $selected_option, $key, false ),
					$label );
			}
			echo '</select>';
			break;
		case 'url':
		case 'text':
			printf( '<input id="%1$s" name="%1$s" type="text" value="%2$s" size="80" />',
					$name,
				 	esc_attr( $wind_options[$theme_option['name']] ) );
			break;
		case 'hidden':
			printf( '<input id="%1$s" name="%2$s" type="hidden" value="%3$s" />',
					$theme_option['name'],
					$name,
				 	esc_attr( $wind_options[ $theme_option['name'] ] ) );
			break;
		case 'category':
			$active_cats = json_decode( $wind_options[$theme_option['name']]  );
			$active_ids = array();
			// Active categores
			echo '<div class="grid_8 alpha">';
			echo '<p><strong>' . __( 'Active', 'wind' ) . '</strong></p>';
			echo '<ul class="category-sortable connected active">';
			if ( !empty( $active_cats ) ) {
				foreach ( $active_cats as $active_cat ) {
					$active_ids[] = $active_cat->id;
					echo '<li id="' . $theme_option['name'] . '_' . $active_cat->id;
					echo '" data-cat-id="' . $active_cat->id . '">';
					echo get_the_category_by_ID( $active_cat->id );
					if ( ! empty( $theme_option['color'] ) && '1' == $theme_option['color'] )
						printf( '<input type="text" value="%1$s" class="color-picker" />', $active_cat->color );
					echo '</li>';					
				}			
			}
			echo '</ul></div>';
			
			// Avavilable categories
			echo '<div class="grid_4 omega">';
			echo '<p><strong>' . __( 'Available', 'wind' ) . '</strong></p>';
			echo '<ul class="category-sortable connected">';
			
			$top_cats = wind_top_categories( apply_filters('wind_category_min_post', 2 ) );
			if ( !empty( $top_cats ) ) {
				foreach ( $top_cats as $top_cat ) {
					if ( empty( $active_ids ) || ! in_array( $top_cat->term_id,  $active_ids) ) {
						echo '<li id="' . $theme_option['name'] . '_' . $top_cat->term_id;
						echo '" data-cat-id="' . $top_cat->term_id . '">';
						echo $top_cat->name;
						if ( ! empty( $theme_option['color'] ) && '1' == $theme_option['color'] )
							printf( '<input type="text" value="%1$s" class="color-picker" />', '' );
						echo '</li>';					
					}
				}
			}
			echo '</ul></div>';
			echo '<div class="clear"></div>';
			// Hidden field to store option
			printf( '<input id="%1$s" name="%1$s" type="hidden" value="%2$s" size="80" class="category-data" />',
					$name,
				 	esc_attr( $wind_options[$theme_option['name']] ) );
			break;
		default:
			echo __( 'Option Type is not supported. ', 'wind' );		
	}
	if ( $theme_option['type'] != 'hidden' && ( empty( $theme_option['group'] ) || ( '3' == $theme_option['group'] ) ) ) {
		if ( 'category' != $theme_option['type'] )
			echo '</p>';
		if ( ! empty( $theme_option['helptext'] ) )
			printf( '<p><label class="helptext">%s</label></p>', $theme_option['helptext']);
		echo '</div><div class="clear"></div>';	
	}
}

function wind_options_validate( $input ) {	
	$theme_options = wind_theme_options();
	foreach ( $theme_options as $theme_option )
 		if ( 'checkbox' == $theme_option['type'] ) {
				$input[$theme_option['name']] = ( ( isset( $input[$theme_option['name']] ) && 1 == $input[$theme_option['name']] ) ? 1 : 0 );
		}
  	foreach( $input as $key => $value ) {
  		if ( isset( $theme_options[ $key ] ) ) {
			switch ( $theme_options[ $key ]['type'] ) {
				case 'text':
				case 'textarea':
					$input[ $key ] = wp_kses_stripslashes( $value );
					break;
				case 'number':	
					$input[ $key ] = intval( $value );	
					break;				
				case 'url':	
				case 'image':
					$input[ $key ] = esc_url_raw( $value );	
					break;
				case 'color':
					$input[ $key ] = sanitize_text_field( $value );	
					break;
			}		
		}
    }
	return $input;
}

function wind_option_css() {	
	global $wind_options;
	$wind_fonts = wind_font_list();

	$css = '';
	if ( 1080 != $wind_options['gridwidth'] ) {
		$css .= '.row, .contain-to-grid .top-bar, .panel-grid {max-width: ' . $wind_options['gridwidth'] . 'px; }' . "\n";
	}
	$font_elements = wind_font_elements();
	
	foreach ( $font_elements as $option_id => $element ) {
		if ( isset( $wind_options[ $option_id ] ) && 'default' != $wind_options[ $option_id ] )
			$css .= $element['selector'] . ' {font-family:' . $wind_fonts[ $wind_options[ $option_id ] ]['family'] . ';}' . "\n";		
	}

	if ( 1 == $wind_options['hidecredit'] ) {
		$css .= '.design-credit {display:none;}' . "\n";
	}

	if ( 0 != $wind_options['slider_height'] &&  '2' == $wind_options['slider_type'] ) {
		$css .= '.fullwidth-slider .slider .columns,' . "\n";
		$css .= '.windSlider > li {height:' . $wind_options['slider_height'] . 'px;}' . "\n";
	}
	if ( 0 != $wind_options['slider_height'] &&  '3' == $wind_options['slider_type'] ) {
		$css .= '.windSlider > li {max-height:' . $wind_options['slider_height'] . 'px;}' . "\n";
	}
	return apply_filters( 'wind_option_css', $css );
}