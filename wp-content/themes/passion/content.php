<?php
/**
 * The default template for displaying content
 * 
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	global $wind_options;
	
	if ( has_post_format( 'image' ) )
		echo wind_get_image();
	elseif ( has_post_format( 'video' ) )
		echo wind_get_video();
	else
		wind_post_thumbnail( $post->ID );	
?>
	<header class="entry-header">
<?php
		wind_post_title();
		passion_meta_top();
?>
	</header>
	<div class="entry-content clearfix">
<?php
		if ( is_single() && has_excerpt() ) { ?>
			<div class="entry-excerpt clearfix">
				<?php the_excerpt(); ?>
			</div>
<?php	}
		if ( has_post_format( 'image' ) )
			add_filter('the_content', 'wind_remove_images');
		elseif ( has_post_format( 'video' ) )
			add_filter('the_content', 'wind_remove_videos');
		the_content( '' );
		if ( has_post_format( 'image' ) )
			remove_filter('the_content', 'wind_remove_images');
		elseif ( has_post_format( 'video' ) )
			remove_filter('the_content', 'wind_remove_videos');
		wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'passion' ) . '</span>', 'after' => '</div>' ) ); 
?>
	</div>
	<footer class="entry-footer clearfix">
<?php	passion_meta_bottom();
		wind_post_edit();
		wind_author_info();
?>
	</footer>
</article>
