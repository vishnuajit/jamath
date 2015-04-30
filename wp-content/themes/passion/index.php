<?php
/**
 * Main loop
 * 
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
get_header(); ?>

<div id="content" class="<?php echo wind_content_class(); ?>" role="main">
<?php
	if ( have_posts() ) {
		wind_page_title();
		wind_content_nav( 'nav-above' );
		while ( have_posts() ) {
			the_post();
			if ( is_search() )
				get_template_part( 'content', 'summary' );
			else
				get_template_part( 'content', 'loop' );
		}				
		wind_content_nav( 'nav-below' );
	} elseif ( current_user_can( 'edit_posts' ) ) {
		get_template_part( 'content-none', 'index' );
	} ?>						
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
