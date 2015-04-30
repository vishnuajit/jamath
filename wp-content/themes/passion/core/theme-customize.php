<?php
/**
 * Wind Customize Functions
 * 
 * @package	wind
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.xinthemes.com/
 */
if ( ! defined('ABSPATH') ) exit;

function wind_customize_register( $wp_customize ){
 	global $wind_options, $wind_theme_options;

    $wind_theme_options = wind_theme_options(); 	
    $sections = wind_customize_sections();
    
    $default_options = wind_default_options();
	
    foreach ( $sections as $section_id => $section ) {
		$current_section = $wp_customize->get_section( $section_id );
		if ( $current_section  ) {
			$current_section->priority = $section['priority'];
		}
		else {
			$wp_customize->add_section(
				$section_id, array(
					'title' => $section['label'],
					'description' => $section['description'],
					'priority' => $section['priority'] ) );
		}

		foreach ( $wind_theme_options as $theme_option )
			if ( ! empty( $theme_option['section'] ) && $theme_option['section'] == $section_id  && 'na' != $theme_option['type']) {
				$option_name = WIND_THEME_ID . '_options[' . $theme_option['name'] . ']';
				
				if ( isset( $theme_option['transport'] ))
					$transport = $theme_option['transport'];
				else
					$transport = 'refresh';
				$wp_customize->add_setting( $option_name, array(
						'type'		=> 'option',
    					'default'	=> $default_options[ $theme_option['name'] ],
    					'transport' => $transport ));
				switch ( $theme_option['type'] ) {
					case 'select':
					case 'font':
						$wp_customize->add_control( $option_name, array(
    						'settings'  => $option_name,
    						'label'     => $theme_option['label'],
    						'section'   => $section_id,
							'type'      => 'select',
							'choices'	=> $theme_option['choices'] ));
						break;	
					case 'radio':
						$wp_customize->add_control( $option_name, array(
    						'settings'  => $option_name,
    						'label'     => $theme_option['label'],
    						'section'   => $section_id,
							'type'      => 'radio',
							'choices'	=> $theme_option['choices'] ));
						break;	
					case 'checkbox':	
						$wp_customize->add_control( $option_name, array(
    						'settings'  => $option_name,
    						'label'     => $theme_option['label'],
    						'section'   => $section_id,
							'type'      => 'checkbox' ));
						break;
				}
			}
	} 
}
add_action('customize_register', 'wind_customize_register');


function wind_customize_preview_js() {
	wp_enqueue_script( 'wind-customize', get_template_directory_uri() . '/js/customize.js', array( 'customize-preview' ), WIND_VERSION, true );
}
add_action( 'customize_preview_init', 'wind_customize_preview_js' );

function wind_customize_section_js() {
	wp_enqueue_script( 'wind-customize-section', get_template_directory_uri() . '/core/js/customize-section.js', array( 'customize-controls' ), WIND_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'wind_customize_section_js' );
