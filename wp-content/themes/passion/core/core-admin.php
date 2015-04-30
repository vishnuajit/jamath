<?php
/**
 * Core Admin Functions
 * 
 * @package	wind
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
if ( ! defined('ABSPATH') ) exit;

function wind_meta_boxes() {
	$prefix = apply_filters( 'wind_meta_box_prefix', '_wind');	
	$meta_boxes = array(
	
	'page' => array( 
		'id' => 'wind-page-meta',
		'title' => __('Template Options', 'wind'), 
		'type' => 'page',
		'context' => 'side',  //normal, advaned, side  
		'priority' => 'low', //high, core, default, low
		'fields' => array(
        	array(
            	'name' => __( 'Post Category :' ,'wind'),
            	'desc' => '',
            	'id' => $prefix . '_category',
            	'type' => 'select',
				'options' => wind_category_choices( 'metaall' ),
        	),
        	array(
            	'name' => __( 'Posts per page :', 'wind' ),
            	'desc' => '',
            	'id' => $prefix . '_postperpage',
            	'type' => 'number',
        	),
			array(
            	'name' => __('Sidebar :', 'wind'),
            	'desc' => __('check to display sidebar','wind'),
            	'id' => $prefix . '_sidebar',
            	'type' => 'checkbox',
        	),
        	array(
            	'name' => __('Layout :', 'wind'),
            	'desc' => __('Columns','wind'),
            	'id' => $prefix . '_column',
            	'type' => 'select',
				'options' => array( 
					'1' => '1',
					'2' => '2',
					'' 	=> '3',	// Default
					'4'	=> '4' ),
        	),
        	array(
            	'name' => __('Image Size : ', 'wind'),
            	'desc' => '',
            	'id' => $prefix . '_thumbnail',
            	'type' => 'select',
				'options' => wind_thumbnail_array(),
        	),
        	array(
            	'name' => __('Intro Text : <br />', 'wind'),
            	'desc' => '',
            	'id' => $prefix . '_intro',
            	'type' => 'radio',
				'options' => array( 
					'' 	=> __('Excerpt','wind'),
					'2' => __('Content','wind'),
					'3'	=> __('None','wind'),
				),
        	),
        	array(
            	'name' => __('Post Meta :', 'wind'),
            	'desc' => __('check to display post meta','wind'),
            	'id' => $prefix . '_disp_meta',
            	'type' => 'checkbox',
        	),
    	),
	),
	'post' => array( 
		'id' => 'wind-post-meta',
		'title' => __('Post Options', 'wind'), 
		'type' => 'post',
		'context' => 'side',  //normal, advaned, side  
		'priority' => 'high', //high, core, default, low
		'fields' => array(
        	array(
            	'name' => __('Layout :', 'wind'),
            	'desc' => '',
            	'id' => $prefix . '_layout',
            	'type' => 'select',
            	'default' => '',
				'options' => array( 
					'' => __( 'Default', 'wind' ),
					'1' => __( 'No Sidebar', 'wind' ),
				),					  
        	),			
        	array(
            	'name' => '',
            	'desc' => __('Featured Post','wind'),
            	'id' => $prefix . '_featured',
            	'type' => 'checkbox',
            	'default' => '',
        	),
        	array(
            	'name' => __('Read More Label :', 'wind'),
            	'desc' => '',
            	'id' => $prefix . '_readmore',
            	'type' => 'text',
            	'default' => '',
        	),
    	)
	) );
	return apply_filters( 'wind_meta_boxes', $meta_boxes );
}

function wind_add_meta_boxes() {
	$meta_boxes = wind_meta_boxes();
	
	foreach ( $meta_boxes as $meta_box )
		$box = new Wind_Meta_Box( $meta_box );
}
add_action( 'admin_menu', 'wind_add_meta_boxes' );

function wind_load_template_scripts( $hooks ) {
	global $post_type;

	$tmp_path = get_template_directory_uri();	
	if ( 'page' == $post_type ) {
		wp_enqueue_script( 'wind-template', $tmp_path . '/core/js/template.js', array( 'jquery') );	
	}
	if ( 'widgets.php' == $hooks ) {
		wp_enqueue_style( 'wind-widgets', $tmp_path . '/core/css/widgets.css', null, '1.0' );	
		wp_enqueue_script( 'wind-widgets', $tmp_path . '/core/js/widgets.js', array( 'jquery-ui-sortable' ) );			
	}
}
add_action( 'admin_enqueue_scripts', 'wind_load_template_scripts' );