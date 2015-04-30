<?php
/**
 * The template to display content in the loop
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
	
	if ( is_sticky() || wind_is_featured() || ( ! has_post_thumbnail() && ! wind_get_image() && ! wind_get_video() ) ) {
		if ( has_post_format( 'image' ) )
			echo wind_get_image();
		elseif ( has_post_format( 'video' ) )
			echo wind_get_video();
		elseif ( has_post_thumbnail() )
			wind_post_thumbnail( $post->ID, 'featured-image' ); ?>
		<header class="entry-header">
<?php		wind_post_title(); 
			passion_meta_top(); ?>
		</header>
<?php	if ( is_sticky() || wind_is_featured() || has_post_format( 'aside' ) || has_post_format( 'link' ) || has_post_format( 'quote' ) ){ ?>
			<div class="entry-content clearfix">
<?php			if ( has_post_format( 'image' ) )
					add_filter('the_content', 'wind_remove_images');
				elseif ( has_post_format( 'video' ) )
					add_filter('the_content', 'wind_remove_videos');
				the_content( wind_readmore_link() );
				if ( has_post_format( 'image' ) )
					remove_filter('the_content', 'wind_remove_images');
				elseif ( has_post_format( 'video' ) )
					remove_filter('the_content', 'wind_remove_videos');
?>
			</div>
<?php
		} else { ?>
			<div class="entry-summary clearfix">
				<?php the_excerpt(); ?>
			</div>
<?php	}
	} else { ?>
		<div class="row collapse">
		<div class="medium-4 small-4 columns">
<?php		
			if ( has_post_format( 'image' ) )
				echo wind_get_image();
			elseif ( has_post_format( 'video' ) )
				echo wind_get_video();
			elseif ( has_post_thumbnail() )
				wind_post_thumbnail( $post->ID, 'featured-thumb', 'wind-thumb' );
?>	
		</div>
		<div class="medium-8 small-8 columns entry-intro">
			<header class="entry-header">
<?php			wind_post_title(); 
				passion_meta_top(); ?>
			</header>
			<div class="entry-summary hide-for-small">
				<?php the_excerpt();?>
			</div>
		</div>
		</div>
<?php	
	}
	wind_single_post_link();
	wind_post_edit(); ?>
	<footer class="entry-footer clearfix">
<?php
		wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'passion' ) . '</span>', 'after' => '</div>' ) );	
		passion_meta_bottom();	
?>
	</footer>
</article>
