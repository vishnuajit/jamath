<?php
/**
 * Content template for summary page
 *
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-equalizer-watch>
<?php
	global $more; //WordPress global variable
	global $wind_thumbnail, $wind_display_excerpt, $wind_entry_meta;
	
	if ( ! isset( $wind_display_excerpt ) )
		$wind_display_excerpt = 1;
	if ( ! isset( $wind_thumbnail ) )
		$wind_thumbnail = 'thumbnail';
	if ( ! isset( $wind_entry_meta ) )
		$wind_entry_meta = 1;
	$displayed_thumnnail = 0;
	if ( has_post_thumbnail() && ( 'none' != $wind_thumbnail ) ) {
		$displayed_thumnnail = 1;
?>	
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'passion' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( $wind_thumbnail, array( 'class' => 'post-thumbnail', 'title' => get_the_title() ) ); ?></a>
    <?php
		if ( is_sticky() ) {
			echo '<div class="featured-container">';
			if ( has_action('wind_featured_logo') )
				do_action('wind_featured_logo');
			else
				echo '<p><i class="fa fa-star"></i></p>';
			echo '</div>';
		}	
	}
	?>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'passion' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header>
	<div class="entry-summary clearfix">
<?php 	
		if ( 1 == $wind_display_excerpt ) {
			the_excerpt();
		}
		elseif ( 2 == $wind_display_excerpt ) {
			$more = 0;
			if ( $displayed_thumnnail )
				add_filter( 'the_content', 'wind_remove_images', 100 );
			the_content( '' );		
			if ( $displayed_thumnnail )
				remove_filter( 'the_content', 'wind_remove_images', 100 );
		}
?>
	</div>
<?php
	wind_post_edit();
	wind_meta_summary(); ?>
</article>
