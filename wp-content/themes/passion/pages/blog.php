<?php
/**
 * Template Name: Blog (Full Posts)
 *
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
get_header();
    
	if ( get_query_var('paged') )
	    $paged = get_query_var('paged');
	elseif ( get_query_var('page') ) 
	    $paged = get_query_var('page');
	else 
		$paged = 1;
	if ( have_posts() && is_page()) {
		the_post();
		$pt_category = get_post_meta($post->ID, '_wind_category', true);
		$postperpage = get_post_meta($post->ID, '_wind_postperpage', true);
		$sidebar = get_post_meta($post->ID, '_wind_sidebar', true);
		
		if ($paged == 1) {
			wind_template_intro();
		}
	}
	else {
		$pt_category = '';
		$sidebar = 1;
		$postperpage = '';
	}
	$blog_args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'paged'	=> $paged,				
						);
	if ($postperpage)
		$blog_args['posts_per_page'] = $postperpage;
	if ($pt_category)
		$blog_args['category__in'] = $pt_category;
	$blog = new WP_Query( $blog_args );	
?>
<div id="content" class="<?php echo $sidebar ? wind_content_class() : wind_grid_full(); ?>" role="main">
<?php 
	global $more;

 	if ( $blog->have_posts() ) :
		wind_content_nav_link( $blog->max_num_pages, 'nav-above' );
		while ( $blog->have_posts() ) :
			$blog->the_post();
			$more = 0;
			get_template_part( 'content', get_post_format() );
		endwhile;				
		wind_content_nav_link( $blog->max_num_pages, 'nav-below' );
	elseif ( current_user_can( 'edit_posts' ) ) :
		get_template_part( 'content-none', 'index' );
	endif;
	wp_reset_postdata();
?>
</div>
<?php if ($sidebar) get_sidebar(); ?>
<?php get_footer(); ?>
