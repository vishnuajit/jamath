<?php
/**
 * Template Name: Full Width
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
	get_footer();
