<?php
/**
 * Display Sidebars
 * 
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
	global $wind_options;

	// Full Sidebar	
	$width = $wind_options['sidebar1'] + $wind_options['sidebar2'];		
	if ( 3 != $wind_options['sidebarpos'] && $width > 0 && is_active_sidebar( 'full-widget-area' ) ) {
?>
		<aside id="sidebar_full" class="<?php echo wind_sidebar_class( 'full' ); ?> widget blog-widget" role="complementary">
			<ul class="xoxo">
<?php			dynamic_sidebar( 'full-widget-area' );	?>
			</ul>
		</aside>
<?php
	}
	// First Sidebar	
	if ( is_active_sidebar( 'first-widget-area' ) && ( $wind_options['sidebar1'] > 0) ) {	
?>	
		<aside id="sidebar_one" class="<?php echo wind_sidebar_class( 'one' ); ?> widget blog-widget" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'first-widget-area' ); ?>
			</ul>
		</aside>
<?php
	}
	// Second Sidebar
	if ( is_active_sidebar( 'second-widget-area' ) && ( $wind_options['sidebar2'] > 0) ) {
?>
		<aside id="sidebar_two" class="<?php echo wind_sidebar_class( 'two' ); ?> widget blog-widget" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'second-widget-area' ); ?>
			</ul>
		</aside>
<?php
	}
?>	
