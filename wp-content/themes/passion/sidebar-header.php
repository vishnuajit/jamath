<?php
/**
 * Header
 * 
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
	if ( is_active_sidebar( 'header-widget-area' )  ) { ?>
	  <div class="widget header-widget right">
		<ul class="xoxo">
			<?php dynamic_sidebar( 'header-widget-area' ); ?>
		</ul>
	  </div>
<?php
	}

