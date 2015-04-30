<?php
/** The home widget area
 *
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
	global $wind_options;	 

	if ( ( is_active_sidebar( 'first-home-widget-area' ) && $wind_options['column_home1'] > 0 )
		|| ( is_active_sidebar( 'second-home-widget-area' ) && $wind_options['column_home2'] > 0 )
		|| ( is_active_sidebar( 'third-home-widget-area' ) && $wind_options['column_home3'] > 0 )		
		|| ( is_active_sidebar( 'fourth-home-widget-area' ) && $wind_options['column_home4'] > 0 )
		|| ( is_active_sidebar( 'fifth-home-widget-area' ) && $wind_options['column_home5'] > 0 ) )
		$has_widget = true;
	else
		$has_widget = false;
	if ( $has_widget ) {
?>
<section id="home-widget-area">
	<div class="row">
<?php
	}
	if ( is_active_sidebar( 'first-home-widget-area' ) && $wind_options['column_home1'] > 0 ) { ?>
		<div id="first-home" class="<?php echo wind_grid_columns( $wind_options['column_home1'] ); ?> widget home-widget">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'first-home-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( is_active_sidebar( 'second-home-widget-area' ) && $wind_options['column_home2'] > 0) { ?>
		<div id="second-home" class="<?php echo wind_grid_columns( $wind_options['column_home2'] ); ?> widget home-widget">	
			<ul class="xoxo">
				<?php dynamic_sidebar( 'second-home-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( is_active_sidebar( 'third-home-widget-area' ) && $wind_options['column_home3'] ) { ?>
		<div id="third-home" class="<?php echo wind_grid_columns( $wind_options['column_home3'] ); ?> widget home-widget">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'third-home-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( is_active_sidebar( 'fourth-home-widget-area' ) && $wind_options['column_home4'] ) { ?>
		<div id="fourth-home" class="<?php echo wind_grid_columns( $wind_options['column_home4'] ); ?> widget home-widget">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'fourth-home-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( is_active_sidebar( 'fifth-home-widget-area' ) && $wind_options['column_home5'] ) { ?>
		<div id="fifth-home" class="<?php echo wind_grid_columns( $wind_options['column_home5'] ); ?> widget home-widget">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'fifth-home-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( $has_widget ) {
?>
	</div>
</section>
<?php
	}

