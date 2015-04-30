<?php
/**
 * Footer Widget Areas
 * 
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
	global $wind_options;
	if ( ( is_active_sidebar( 'first-footer-widget-area' ) && $wind_options['column_footer1'] > 0 )
		|| ( is_active_sidebar( 'second-footer-widget-area' ) && $wind_options['column_footer2'] > 0 )
		|| ( is_active_sidebar( 'third-footer-widget-area' ) && $wind_options['column_footer3'] > 0 )		
		|| ( is_active_sidebar( 'fourth-footer-widget-area' ) && $wind_options['column_footer4'] > 0 ) )
		$has_widget = true;
	else
		$has_widget = false;
	if ( $has_widget ) {
?>
<div id="footer-widget-area" role="complementary">
	<div class="row">
<?php
	}
	if ( is_active_sidebar( 'first-footer-widget-area' ) && $wind_options['column_footer1'] > 0 ) { ?>
		<div id="first" class="<?php echo wind_grid_columns( $wind_options['column_footer1'] ); ?> widget footer-widget">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( is_active_sidebar( 'second-footer-widget-area' ) && $wind_options['column_footer2'] > 0) { ?>
		<div id="second" class="<?php echo wind_grid_columns( $wind_options['column_footer2'] ); ?> widget footer-widget">	
			<ul class="xoxo">
				<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( is_active_sidebar( 'third-footer-widget-area' ) && $wind_options['column_footer3'] ) { ?>
		<div id="third" class="<?php echo wind_grid_columns( $wind_options['column_footer3'] ); ?> widget footer-widget">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( is_active_sidebar( 'fourth-footer-widget-area' ) && $wind_options['column_footer4'] ) { ?>
		<div id="fourth" class="<?php echo wind_grid_columns( $wind_options['column_footer4'] ); ?> widget footer-widget">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
	if ( $has_widget ) {?>
	</div>
</div>
<?php
	}