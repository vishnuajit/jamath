<?php
/**
 * Core: Foundation Framework functions
 * 
 * @package	wind
 * @since   1.0
 * @author  XinThemes
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
class wind_topbar_walker extends Walker_Nav_Menu {
 
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$element->has_children = ! empty( $children_elements[ $element->ID ] );
		$element->classes[] = ( $element->current || $element->current_item_ancestor) ? 'active' : '';
		$element->classes[] = ( $element->has_children ) ? 'has-dropdown' : '';
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_html = '';
		parent::start_el( $item_html, $item, $depth, $args );	
		$output .= ( 0 == $depth) ? '<li class="divider"></li>' : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;	
		if( in_array( 'section', $classes ) ) {
			$output .= '<li class="divider"></li>';
			$item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html);
		}
		$output .= $item_html;
	}

	function start_lvl(&$output, $depth = 0, $args = array() ) {
		$output .= "\n<ul class=\"sub-menu dropdown\">\n";
	}
}

function wind_nav_fb() {
	global $wind_options;
	echo '<ul class="' . $wind_options['menupos'] . '">';
	wp_list_pages(array(
			'echo' => 1,
			'title_li'     => '',
			'sort_column' => 'menu_order, post_title',
			'walker' => new wind_page_walker(),
			'post_type' => 'page',
			'post_status' => 'publish'
	));
	echo '</ul>';
}

class wind_page_walker extends Walker_Page {
	
	function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		$item_html = '';
		parent::start_el( $item_html, $page, $depth, $args, $current_page );
		$css_class = array( 'page_item', 'page-item-'.$page->ID );
		if ( $args['has_children'] ) {
			$css_class[] = 'has-dropdown';
		}
		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
		$item_html = '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . apply_filters( 'the_title', $page->post_title, $page->ID ) . '</a>';
		$output .= $item_html;
	}
 
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n<ul class=\"dropdown\">\n";
	}
}

if ( ! function_exists( 'wind_content_class' ) ) :
function wind_content_class() {
    global $wind_options;
	$class = 'large-' . $wind_options['content'] . ' medium-' . $wind_options['content'];
	if ( 2 == $wind_options['sidebarpos'] && ( $wind_options['sidebar1'] > 0 || $wind_options['sidebar2'] > 0 ) ) {
		if ( ( $wind_options['content'] + $wind_options['sidebar1'] + $wind_options['sidebar2'] ) > 12 ) {
			if ($wind_options['sidebar1'] > $wind_options['sidebar2'])
				$push_col = $wind_options['sidebar1']; 
			else
				$push_col = $wind_options['sidebar2'];
		}
		else {
			$push_col = $wind_options['sidebar1'] + $wind_options['sidebar2']; 			
		}
		$class .=  ' push-' . $push_col;
	}
	elseif ( 3 == $wind_options['sidebarpos'] && $wind_options['sidebar1'] > 0 ) {
		$push_col = $wind_options['sidebar1']; 
		$class .= ' push-' . $push_col;		
	}
	$class .= ' columns';
	return $class;
}
endif;

if ( ! function_exists( 'wind_sidebar_class' ) ) :
function wind_sidebar_class( $location ) {
    global $wind_options;
    
	$width = $wind_options['sidebar1'] + $wind_options['sidebar2'];		
	if ( ( $width + $wind_options['content'] ) > 12 ) 
		$width = 12 - $wind_options['content'];
	$class = '';
	if ( 'full' == $location ) {
		$class = 'large-' . $width . ' medium-' . $width;
		if ( 2 == $wind_options['sidebarpos'] )
			$class .= ' pull-' . $wind_options['content'];
		$class .= ' columns';
	}
	elseif ( 'one' == $location ) {
		if ( 3 == $wind_options['sidebarpos'] )
			$width = $wind_options['sidebar1'];
		$class = 'large-' . $wind_options['sidebar1']  . ' medium-' . $width;
		if ( 1 != $wind_options['sidebarpos'] )
			$class .= " pull-" . $wind_options['content'];
		$class .= ' columns';		
	}
	elseif ( 'two' == $location ) {
		if ( 3 == $wind_options['sidebarpos'] )
			$width = $wind_options['sidebar2'];
		$class = 'large-' . $wind_options['sidebar2']  . ' medium-' . $width;
		if ( 2 == $wind_options['sidebarpos'] )
			$class = $class . " pull-" . $wind_options['content'];
		$class .= ' columns';	
	}		
			    
	return $class;
}
endif;

if ( ! function_exists( 'wind_grid_columns' ) ) :
function wind_grid_columns( $large_col, $medium_col = NULL ) {
	if ( !isset( $medium_col ) )
		$medium_col = $large_col;
	return 'large-' . $large_col . ' medium-' . $medium_col . ' columns';
}
endif; 

if ( ! function_exists( 'wind_grid_full' ) ) :
function wind_grid_full() {
	return "large-12 columns";
}
endif;

if ( ! function_exists( 'wind_bbp_class' ) ) :
/** return grid class for bbPress & BuddyPress page */
function wind_bbp_class() {
    global $wind_options;

	$class = "large-" . $wind_options['bbp_column1'] . " medium-" . $wind_options['bbp_column1'] . ' columns ' ;
	if ( 1 == $wind_options['bbp_position'] && $wind_options['bbp_column2'] > 0 ) {
			$push_col = $wind_options['bbp_column2']; 	
		$class = $class . "push-" . $push_col . ' ';
	}
	$class = $class . 'bbp-content';
	return $class;
}
endif;

function wind_add_search_box($items, $args) {
	ob_start();
    get_search_form();
	$searchform = ob_get_contents();
	ob_end_clean();

	$items .= '<li class="has-form">' . $searchform . '</li>';
    return $items;
}

