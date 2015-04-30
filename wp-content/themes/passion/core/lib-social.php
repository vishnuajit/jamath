<?php
/**
 * Soicla Link Functions
 * 
 * @package	wind
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
if ( ! defined('ABSPATH') ) exit;

function wind_social_services() {
	$socials = array(
		'facebook' => array(
			'label' => __( 'Facebook', 'wind' ),
			'variants' => array(
				'1' => '<i class="fa fa-facebook"></i>',
				'2' => '<i class="fa fa-facebook-square"></i>',
			),
		),
		'twitter' => array(
			'label' => __( 'Twitter', 'wind' ),
			'variants' => array(
				'1' => '<i class="fa fa-twitter"></i>',
				'2' => '<i class="fa fa-twitter-square"></i>',
			),
		),
		'linkedin' => array(
			'label' => __( 'Linkedin', 'wind' ),
			'variants' => array(
				'1' => '<i class="fa fa-linkedin"></i>',
				'2' => '<i class="fa fa-linkedin-square"></i>',
			),
		),
		'googleplus' => array(
			'label' => __( 'Google+', 'wind' ),
			'variants' => array(
				'1' => '<i class="fa fa-google-plus"></i>',
				'2' => '<i class="fa fa-google-plus-square"></i>',
			),
		),
		'youtube' => array(
			'label' => __( 'YouTube', 'wind' ),
			'variants' => array(
				'1' => '<i class="fa fa-youtube"></i>',
				'2' => '<i class="fa fa-youtube-square"></i>',
			),
		),
		'pinterest' => array(
			'label' => __( 'Pinterest', 'wind' ),
			'variants' => array(
				'1' => '<i class="fa fa-pinterest"></i>',
				'2' => '<i class="fa fa-pinterest-square"></i>',
			),
		),
	);
	return apply_filters('wind_social_services', $socials );
}

function wind_social_option_tabs( $tabs  ) {
	$tabs['social'] = array( 'label' => __( 'Social', 'wind' ), 'priority' => 30 );
	return $tabs;
}
add_filter( 'wind_option_tabs', 'wind_social_option_tabs');

function wind_social_defaults( $defaults ) {	
	$defaults['social_topbar'] = 0;
	$defaults['social_section'] = 0;
	$defaults['social_footer'] = 0;
	$defaults['social_variant'] = 1;

	$services = wind_social_services();
	foreach ($services as $key => $service )
		$defaults[ $key ] = '';
	return 	$defaults;
}
add_filter( 'wind_default_options', 'wind_social_defaults' );

function wind_social_options( $options ) {
	$services = wind_social_services();					
	foreach ($services as $key => $service ) {
		$options[ $key ] = array(
			'name'	=> $key,
			'section'	=> 'social',
			'label'	=> $service['label'],
			'type'	=> 'url',
		);
	}

	$options['social_topbar'] = array(
			'name'	=> 'social_topbar',
			'section'	=> 'social',
			'heading' => __( 'Display Options', 'wind' ),
			'grouplabel' => __( 'Social Link Location', 'wind' ),
			'desc'	=> __( 'Header', 'wind' ),
			'type'	=> 'checkbox',
			'group' => '1' );
	$options['social_section'] = array(
			'name'	=> 'social_section',
			'section'	=> 'social',
			'desc'	=> __( 'Section Menu', 'wind' ),
			'type'	=> 'checkbox',
			'group' => '2' );
	$options['social_footer'] = array(
			'name'	=> 'social_footer',
			'section'	=> 'social',
			'desc'	=> __( 'Footer', 'wind' ),
			'type'	=> 'checkbox',
			'group' => '3' );
	$options['social_variant'] = array(
			'name'  => 'social_variant',
			'section'	=> 'social',
			'label'	=> __( 'Icon Variant', 'wind' ),
			'type'	=> 'radio',
			'choices' => array(
				'1'		=> __( 'Standard', 'wind' ),
				'2'		=> __( 'Saqure', 'wind' ),
			) );
	return 	$options;
}
add_filter( 'wind_theme_options', 'wind_social_options' );

function wind_social_display( $class = 'sociallink right' ) {
	global $wind_options;
	
	$services = wind_social_services();	
	$list = '';
	foreach ($services as $key => $service ) {
		if ( !empty( $wind_options[ $key ] ) ) {
			$list .= '<li><a class="sl-' . $key . ' sl-variant-' . $wind_options['social_variant'] . '" href="';
			$list .= esc_url( $wind_options[ $key ] ) . '" title="';
			$list .= __('Follow us on ', 'wind') .$service['label'] . '">' . $service['variants'][ $wind_options['social_variant'] ];
			$list .= '</a></li>';
		}
	}
	if ( !empty( $list ) ) {
		$list = '<ul class="' . $class . '">' . $list . '</ul>';
	}
	echo apply_filters( 'wind_social_display', $list );
}
