<?php
/**
 * Functions that support Plugins
 * 
 * @package	wind
 * @since   1.0.7
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
if ( ! defined( 'ABSPATH' )) exit;

// Remove Jetpack Sharing from Excerpt
if ( ! function_exists( 'wind_remove_sharing_filters' ) ) :
function wind_remove_sharing_filters() {
	if (  function_exists( 'sharing_display' ) ) {
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
		remove_filter( 'the_content', 'sharing_display', 19 );
	}
}
add_action('wind_header_before_main','wind_remove_sharing_filters');
endif;

if ( ! function_exists( 'wind_jetpack_sharing' ) ) :
function wind_jetpack_sharing( $pos = 'bottom' ) {
	global $wind_options;

	if ( function_exists( 'sharing_display' ) ) {
		if ( 'top' == $pos && $wind_options['share_top'] )
			echo '<span class="wind-share-top">' . sharing_display() . '</span>';
		elseif ( 'bottom' == $pos && $wind_options['share_bottom'] )
			echo '<span class="wind-share-bottom clearfix">' . sharing_display() . '</span>';
	}
}
endif;
