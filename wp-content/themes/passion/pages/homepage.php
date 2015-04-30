<?php
/**
 * Template Name: Home Template
 *
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
	get_header(); 
	
	global $wind_options;
	if ( 1 == $wind_options['cta_active'] && ( ! empty( $wind_options['headline'] ) || ! empty( $wind_options['tagline'] ) ) ) {
		if ( empty($wind_options['cta_url'] ) )
			$large_col = 12;
		else
			$large_col = 10;	
?>
	<div class="home-cta">
	  <div class="row" data-equalizer>
		<div class="<?php echo wind_grid_columns( $large_col, 12 ); ?>" data-equalizer-watch>
		  <div class="home-cta-content">
<?php		if ( ! empty( $wind_options['headline'] ) )
				echo '<h1 class="headline">' . esc_attr( $wind_options['headline'] ) . '</h1>';
			if ( ! empty( $wind_options['tagline'] ) )
				echo '<h2 class="subheader tagline">' . esc_attr( $wind_options['tagline'] ) . '</h2>';
?>
		  </div>
		</div>
<?php	if ( ! empty( $wind_options['cta_url'] ) ) {
			if ( $large_col < 12 )
				$large_col = 12 - $large_col;
			$cta_label = $wind_options['cta_label'];
			if ( empty( $cta_label ) )
				$cta_label = __( 'Action Now', 'passion');
?>
		<div class="<?php echo wind_grid_columns( $large_col, 12 ); ?>" data-equalizer-watch>
			<a href="<?php echo esc_url( $wind_options['cta_url'] ); ?>" class="btn btn-lg btn-info btn-cta"><strong><?php echo esc_attr( $cta_label ); ?></strong></a>
		</div>
<?php	} ?>
	  </div>
	</div>
<?php		
	} 
	// Page Content 
	if ( have_posts() ) { 
		the_post(); ?>
	<div class="home-intro">
		<div class="row">
			<?php wind_template_intro(); ?>
		</div>
	</div>
<?php
	}
	// Category Index
	if (! empty( $wind_options['home_cat'] ) ) {
		wind_category_index( $wind_options['home_cat'], $wind_options['home_columns'] );
	}
	// Load Home Widget
	if ( 1 == $wind_options['home_widget'] ) {
		get_sidebar( 'home' );
	}
	get_footer();

