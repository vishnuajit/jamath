<?php
/**
 * Content Functions
 * 
 * @package	wind
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
if ( ! function_exists( 'wind_featured_top' ) ):
function wind_featured_top( ) {
	global $wind_options;
	
	if ( wind_has_featured_content() ) {
?>
		<div class="featured-content featured-content-<?php echo $wind_options['slider_type']; ?>">
<?php
			if ( '1' == $wind_options['slider_type'] )
				wind_featured_ticker();
			elseif ( '2' == $wind_options['slider_type'] )
				wind_featured_fullwidth();
			elseif ( '3' == $wind_options['slider_type'] )
				wind_featured_gridwidth();
?>
		</div>
<?php
	}
}
endif;

if ( ! function_exists( 'wind_featured' ) ):
function wind_featured( ) {
	global $wind_options, $wind_featured, $post;
	
	if ( wind_has_featured_content() ) {
?>
	<div class="featured-content featured-content-<?php echo $wind_options['slider_type']; ?>">
		<ul class="windSlider">
<?php
			foreach ( $wind_featured as $order => $post ) {
				setup_postdata( $post ); ?>
				<li class="slider slider-<?php echo $post->ID; ?>">
					<?php get_template_part( 'content', 'featured' ); ?>
				</li>
<?php		}
			wp_reset_postdata();
			$sliderOption = array (
				'mode' => $wind_options['slider_mode'],
				'speed' => $wind_options['slider_speed'],
			);
			wp_localize_script( WIND_THEME_ID, 'windSlider', $sliderOption );
?>
		</ul>
		<?php wind_featured_pager(); ?>
	</div>
<?php

	}
}
endif;

if ( ! function_exists( 'wind_featured_pager' ) ):
function wind_featured_pager( ) {
	global $wind_featured, $post;
	
	if (! empty( $wind_featured ) ) {
?>
		<div class="wind-pager">
		<ul class="large-block-grid-<?php echo count($wind_featured) ; ?> medium-block-grid-2 small-block-grid-1" data-equalizer>
<?php
			$count = 0;
			foreach ( $wind_featured as $order => $post ) {
				setup_postdata( $post ); ?>
				<li data-equalizer-watch class=""><a class="<?php echo (0 == $count ? 'active' : ''); ?>" data-slide-index="<?php echo $count; ?>" href="<?php echo get_permalink(); ?>"><?php the_title();?></a></li>
<?php			$count += 1;
			}
			wp_reset_postdata(); ?>
		</ul>
		</div>
<?php	
		wp_reset_postdata();
	}
}
endif;
		
function wind_has_featured_content( ) {
	global $wind_options, $wind_featured;

	if ( ! empty( $wind_featured ) )
		return true;
		
	if ( is_front_page() && ! is_paged() ) {
		if ( 1 == $wind_options['slider_home'] )
			return wind_featured_content();
	}
	elseif ( is_single() ) { //Single Post
		if ( 1 == $wind_options['slider_post'] )
			return wind_featured_content();
	}
	elseif ( is_page() ) { // Page
		if ( ! is_page_template() || is_page_template( 'pages/nosidebar.php' ) ) {
			if ( 1 == $wind_options['slider_page'] )
				return wind_featured_content();
		}
		elseif ( 1 == $wind_options['slider_blog'] )
			return wind_featured_content();
	}
	elseif ( ! is_archive() && ! is_search()  ) {
		if ( 1 == $wind_options['slider_blog'] )
			return wind_featured_content();
	}
	return false;
}

if ( ! function_exists( 'wind_featured_content' ) ):
function wind_featured_content() {
	global $wind_options, $wind_featured;
	
	$featured_args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => $wind_options['fp_posnum'],
						'ignore_sticky_posts' => 1,
						);
	if ( $wind_options['fp_category'] > 0 && 1 == $wind_options['fp_option'] )
		$featured_args['category__in'] = $wind_options['fp_category'];
	elseif (2 == $wind_options['fp_option']) {
	   $featured_args['meta_query'] = array(
       			array(
           			'key' => '_wind_featured',
           			'value' => 1,
          			'compare' => 'IN' ) );
	}
	elseif ( 3 == $wind_options['fp_option'] ) {
		$featured_post_ids = array();
		$jetpack_featured_posts = apply_filters( 'wind_get_featured_posts', false );
		if ( ! empty( $jetpack_featured_posts ) )
			$featured_post_ids = array_map( 'absint', wp_list_pluck( $jetpack_featured_posts, 'ID' ) );	
		if ( empty( $featured_post_ids) )
			return false;
		$featured_args['post__in'] = $featured_post_ids;
	}

	$results = new WP_Query( $featured_args );
	if ( $results->have_posts() ) {
		$wind_featured = $results->posts;
		return true;
	}
	return false;
}
endif;

if ( ! function_exists( 'wind_featured_fullwidth' ) ):
function wind_featured_fullwidth( ) {
	global $wind_options, $wind_featured, $post;

	echo '<ul class="windSlider">';
	foreach ( $wind_featured as $order => $post ) {
		setup_postdata( $post );

		$readmore = get_post_meta( $post->ID, '_wind_readmore', true );
		if ( empty( $readmore ) )
			$readmore = __( 'Learn More', 'wind' );
?>
		<li class="slider slider-<?php echo $post->ID; ?>">
		  <div class="row">
			<div class="large-12 columns">
			  <div class="featured-caption">
				<h3 class="featured-title">
					<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
<?php			if ( has_excerpt()) { ?>
					<div class="featured-excerpt">
						<?php the_excerpt( '' ); ?>
					</div>
<?php			} ?>
				<a class="btn btn-lg btn-info btn-featured" href="<?php echo get_permalink(); ?>"><?php echo $readmore; ?></a>
			  </div>
			</div>
		  </div>
		</li>
<?php
	}
	echo '</ul>';
	$sliderOption = array (
		'mode' => $wind_options['slider_mode'],
		'speed' => $wind_options['slider_speed'],
	);
	wp_localize_script( WIND_THEME_ID, 'windSlider', $sliderOption );
	wp_reset_postdata();
}
endif;

if ( ! function_exists( 'wind_featured_fullwidth_css' ) ):
function wind_featured_fullwidth_css( ) {
	global $wind_options, $wind_featured, $post;

	$inline_css = '';
	foreach ( $wind_featured as $order => $post ) {
		setup_postdata( $post );

		$readmore = get_post_meta( $post->ID, '_wind_readmore', true );
		if ( has_post_thumbnail() ) { //  Featured Images
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
   			$inline_css .= '.slider-' . $post->ID . ' { background-image: url("' . esc_url( $image[0] ) . '");}' . "\n";
		}
	}
	wp_reset_postdata();
	return $inline_css;
}
endif;

if ( ! function_exists( 'wind_featured_gridwidth' ) ):
function wind_featured_gridwidth() {
	global $wind_options, $wind_featured, $post;

	echo '<div class="row"><ul class="windSlider">';
	foreach ( $wind_featured as $order => $post ) {
		setup_postdata( $post );

		$readmore = get_post_meta( $post->ID, '_wind_readmore', true );
		if ( empty( $readmore ) )
			$readmore = __( 'Learn More', 'wind' );
?>
		<li class="slider slider-<?php echo $post->ID; ?>">

<?php
		if ( has_post_thumbnail() ) { //  Featured Images ?>
			<a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail( 'wind-featured', array(  'class' => 'wind-featured', 'title' => get_the_title() ) );?></a>
			<div class="featured-caption">
				<h3 class="featured-title">
					<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
<?php			if ( has_excerpt()) { ?>
					<div class="featured-excerpt">
						<?php the_excerpt( '' ); ?>
					</div>
<?php			} ?>
					<a class="btn btn-lg btn-info btn-featured" href="<?php echo get_permalink(); ?>"><?php echo $readmore; ?></a>
			</div>
<?php	} else { // No Featured Images ?>
			<div class="featured-text">
				<h3 class="entry-title">
					<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<?php the_excerpt( '' ); ?>
					<a class="btn btn-lg btn-info btn-featured" href="<?php echo get_permalink(); ?>"><?php echo $readmore; ?></a>
			</div>
<?php	} ?>
		</li>
<?php
	}
	echo '</ul></div>';

	$sliderOption = array (
		'mode' => $wind_options['slider_mode'],
		'speed' => $wind_options['slider_speed'],
	);
	wp_localize_script( WIND_THEME_ID, 'windSlider', $sliderOption );
	wp_reset_postdata();
}
endif;

if ( ! function_exists( 'wind_featured_ticker' ) ):
function wind_featured_ticker( ) {
	global $wind_options, $wind_featured, $post;
	
	$width = 0;
	echo '<div class="row"><ul class="windTicker">';
	foreach ( $wind_featured as $order => $post ) {
		setup_postdata( $post );
			
		echo '<li><a href="' . get_permalink() . '">';
		if ( has_post_thumbnail() ) { //  Featured Images
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'wind-ticker' );
			if ( $image[1] > $width )
				$width =  $image[1];
					
			the_post_thumbnail( 'wind-ticker', array(  'class' => 'featured-img', 'title' => get_the_title() ) );
			echo '<div class="ticker-caption">' . get_the_title() . '</div>';
		} else { // No Featured Images
			echo '<h3 class="entry-title">';
			the_title();
			echo '</h3>';
		}
		echo '</a></li>';
	}
	echo '</ul></div>';
	if ( 0 == $width )
		$width = 255;
	$tickerOption = array (
			'minSlides' => $wind_options['ticker_min'],
			'maxSlides' => $wind_options['ticker_max'],
			'slideWidth' =>  $width,
			'speed' =>  $wind_options['ticker_speed'],
	);
	wp_localize_script( WIND_THEME_ID, 'windTicker', $tickerOption ); 
	wp_reset_postdata();
}
endif;
