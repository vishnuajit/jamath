<?php
/**
 * Action Hooks
 * 
 * @package	wind
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
if ( ! defined( 'ABSPATH' )) exit;

function wind_header_before_main() {
	do_action( 'wind_header_before_main' );
}

function wind_header_branding() {
	do_action( 'wind_header_branding' );
}
/**
 * WooCommerce Support
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'wind_woocommerce_content_wrapper', 10);
add_action( 'woocommerce_after_main_content', 'wind_woocommerce_content_wrapper_end', 10);

function wind_woocommerce_content_wrapper() {
  echo '<div id="content" class="' . wind_content_class() . '">';
}
 
function wind_woocommerce_content_wrapper_end() {
  echo '</div><!-- end of #content -->';
}

/**
 * Jigoshop Support
 */
remove_action( 'jigoshop_before_main_content', 'jigoshop_output_content_wrapper', 10 );
remove_action( 'jigoshop_after_main_content', 'jigoshop_output_content_wrapper_end', 10 );

add_action( 'jigoshop_before_main_content', 'wind_jigoshop_content_wrapper', 10 );
add_action( 'jigoshop_after_main_content', 'wind_jigoshop_content_wrapper_end', 10 );

function wind_jigoshop_content_wrapper() {
  echo '<div id="content" class="' . wind_cotent_class() . '">';
}
 
function wind_jigoshop_content_wrapper_end() {
  echo '</div><!-- end of #content -->';
}
