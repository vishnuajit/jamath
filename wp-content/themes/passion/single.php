<?php
/**
 * The Template for displaying all single posts.
 *
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
global $wind_layout;
$wind_layout = get_post_meta( $post->ID, '_wind_layout', true);

get_header();
?>
	<div id="content" class="<?php echo $wind_layout ? wind_grid_full() : wind_content_class(); ?>" role="main">
<?php	while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() ); ?>

			<nav id="nav-single" class="clearfix">
				<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '<i class="fa fa-chevron-left"></i>', 'Previous post link', 'wind' ) . '</span> %title' ); ?></span>
				<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '<i class="fa fa-chevron-right"></i>', 'Next post link', 'polaris' ) . '</span>' ); ?></span>
			</nav>
<?php		comments_template( '', true );
		} ?>
	</div>
<?php if ( empty( $wind_layout ) ) get_sidebar(); ?>
<?php get_footer(); ?>
