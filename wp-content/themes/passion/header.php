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
?>
<!DOCTYPE html>
<!--[if lt IE 9]><html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php wp_title('|', true, 'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
 	<header id="masthead" class="site-header clearfix">
		<?php wind_top_menu(); ?>
		<div id="branding" class="row"><div class="large-12 columns">
		<?php 
			wind_header_branding(); //Action Hook
			get_sidebar( 'header' );
			wind_branding(); ?>
		</div></div>
		<?php wind_section_menu( 'before' ); ?>
	</header>
 <?php
	wind_featured_top();
	wind_section_menu( 'after' );
	wind_header_before_main(); //Action Hook
?>
  <div id="main">
<?php 
	if ( ! is_page_template( 'pages/fullwidth.php') && ! is_page_template( 'pages/homewidget.php') 
		&& ! is_page_template( 'pages/homepage.php') ) {
?>
		<div class="row">
<?php
	}