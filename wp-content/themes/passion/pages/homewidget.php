<?php
/**
 * Template Name: Home Widgets
 *
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
	get_header();
	
	while ( have_posts() ) {
		the_post();
		
		the_content();
	}
	get_sidebar( 'home' );
	get_footer();
