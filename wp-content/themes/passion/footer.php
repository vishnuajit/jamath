<?php
/**
 * Passion Footer
 * 
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
	if ( ! is_page_template( 'pages/fullwidth.php') && ! is_page_template( 'pages/homewidget.php') 
		&& ! is_page_template( 'pages/homepage.php') ) {
 ?>
 		</div><!-- row -->
 <?php
 	}
 ?>
  </div><!-- main -->
<?php
	get_sidebar( 'footer' );
?>
  <div id="footer">
	<div class="row">
<?php
	global $wind_options;
	if ( 1 == $wind_options['social_footer'])
			wind_social_display( 'sociallink social-footer right' );
	if ( has_nav_menu( 'footer' ) ) {
		wp_nav_menu( array( 'container_class' => 'footer-menu right', 'theme_location' => 'footer' ) );
    }
?>
		<div id="site-info" class="left">
		<?php esc_attr_e('&copy;', 'wind'); ?> <?php _e(date('Y')); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</div>
	</div>
	<div class="design-credit row text-center">
		<a href="<?php echo esc_url( __( 'http://www.rewindcreation.com/', 'passion' ) ); ?>">Passion Theme by RewindCreation</a>
	</div>
	<div class="back-to-top"><a href="#"><span class="fa fa-chevron-up"></span></a></div>
  </div><!-- #footer -->
</div><!-- wrapper -->
<?php wp_footer(); ?>
</body>
</html>
