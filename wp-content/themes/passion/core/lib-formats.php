<?php
/**
 * Functions related to Post Formats
 * 
 * @package	core
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */

// Get image from Image Post
function wind_get_image() {
	global $wind_objects;
	
	if ( ! has_post_format('image') )
		return false;
	$post_id = get_the_ID();
	if( empty( $wind_objects ) )
		$wind_objects = array();
	if( isset( $wind_objects[ $post_id ] ) )
		return $wind_objects[ $post_id ];	
		
	$content = get_the_content();
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	$content = trim($content);
	
	if ( preg_match('/<img[^>]+./' , $content, $match) )
		$wind_objects[ $post_id ] = $match[0];
	else
		$wind_objects[ $post_id ] = false;
	return $wind_objects[ $post_id ];
}
/* Content Filter: Remove images from post */
function wind_remove_images( $content ) {
   $content = preg_replace('/<img[^>]+./', '' , $content);
   return $content;
}

// Get video from Video Post
function wind_get_video() {
	global $wind_objects;
	
	if ( ! has_post_format('video') )
		return false;
	$post_id = get_the_ID();
	if( empty( $wind_objects ) )
		$wind_objects = array();
	if( isset( $wind_objects[ $post_id ] ) )
		return $wind_objects[ $post_id ];	
		
	$content = get_the_content();
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	$content = trim($content);

	if ( preg_match('/<\s*(iframe|object|embed)[^>]+./' , $content, $match) ) {
		$video = $match[0];
		if ( isset( $match[1]) )
			$video = $video . '</' . $match[1] . '>';
		$wind_objects[ $post_id ] = '<div class="' . apply_filters( 'wind_flexvideo_class', 'flex-video' ) . '">' . $video . '</div>';
	}
	else
		$wind_objects[ $post_id ] = false;
	return $wind_objects[ $post_id ];
}

/* Content Filter: Remove videos from post */
function wind_remove_videos( $content ) {
   $content = preg_replace('/<\s*(iframe|object|embed)[^>]+./', '' , $content);
   return $content;
}
