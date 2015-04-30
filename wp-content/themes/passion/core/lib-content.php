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
if ( ! function_exists( 'wind_top_menu' ) ):
function wind_top_menu( ) {
?>
<div id="topmenu" class="contain-to-grid">
<nav class="top-bar" data-topbar>
	<ul class="title-area">
    	<li class="name">
<?php
	global $wind_options;
	
	if ( empty( $wind_options['brandurl'] ) )
		$homeurl =  home_url( '/' );
	else
		$homeurl = $wind_options['brandurl'];
	if ( empty( $wind_options['logo']) ) {
		if ( empty( $wind_options['brandname']) ) {
?>
			<h3 class="site-title-top"><a href="<?php echo esc_url( $homeurl ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
<?php
		} else { ?>
			<h3 class="site-title-top"><a href="<?php echo esc_url( $homeurl ); ?>"><?php echo esc_attr( $wind_options['brandname'] ); ?></a></h3>	
<?php
		}
	} else {
?>
		<a href="<?php echo esc_url( $homeurl ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_attr( $wind_options['logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="logo"></a>
<?php
	} 
	?>
    	</li>
    	<li class="toggle-topbar menu-icon"><a href="#"></a></li>
 	</ul>
    <section class="top-bar-section">
<?php
	if ( 1 == $wind_options['searchbox']) { ?>
    	<ul class="search-small show-for-small">
			<li class="has-form">
				<?php get_search_form(); ?>	
			</li>
		</ul>
		<ul class="right hide-for-small">
			<li><a class="search-toggle"><i class="fa fa-search"></i></a></li>
		</ul>

<?php
	}
	if ( 1 == $wind_options['social_topbar'])
		wind_social_display( 'social-topbar right' );
	if ( has_nav_menu( 'section' ) ) {
		wp_nav_menu( array(
				'theme_location'  => 'section',		
				'container'       => false,
				'menu_class' => 'show-for-small',
				'fallback_cb'     => false,
				'walker' 		  => new wind_topbar_walker() ));
	}
	wp_nav_menu(array(
			'theme_location' => 'top-bar', // where it's located in the theme
			'container' => false,
			'menu_class' => 'top-bar-menu ' . $wind_options['menupos'],
			'fallback_cb' => 'wind_nav_fb', // fallback function 
			'walker' => new wind_topbar_walker()
	));

?>
	</section>
<?php
	if ( 1 == $wind_options['searchbox']) {
?>
		<div class="search-container hide">
			<?php get_search_form(); ?>
		</div>
<?php
	}
?>
</nav>
</div><!-- #topmenu -->
<?php
}
endif;

//Section Menu
if ( ! function_exists( 'wind_section_menu' ) ):
function wind_section_menu( $location = '' ) {
	global $wind_options;
	if ( has_nav_menu( 'section' ) && $wind_options['sectionmenu'] ==  $location ) {
		echo '<div class="sectionmenu sectionmenu-' . $location .' clearfix"><div class="row"><div class="large-12 columns">';
		echo '<nav class="section-menu hide-for-small">';
		wp_nav_menu( array(
			'theme_location'  => 'section',
			'container'       => false,
			'fallback_cb'     => false,
		));
		echo '</nav>';
		if ( 1 == $wind_options['social_section'])
			wind_social_display( 'sociallink social-section right' );
		echo '</div></div></div>';
	}
}
endif;

if ( ! function_exists( 'wind_post_title' ) ) :
// Display Post Title
function wind_post_title( $link = false ) {
	if ( ! is_single() || $link ) {
		printf('<h2 class="entry-title"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></h2>',
			get_permalink(),
			sprintf( esc_attr__( 'Permalink to %s', 'wind' ), the_title_attribute( 'echo=0' ) ),
			get_the_title()	);
	}
	else {
		printf('<h1 class="entry-title">%1$s</h1>',
			get_the_title()	);		
	}
}
endif;

// Prints Post Categories
function wind_meta_category( $list = true ) {
	$html = '';

	$categories = wp_get_post_categories( get_the_ID() , array('fields' => 'ids'));
	if( $categories ) {
 		$sep = ' &bull; ';
 		$cat_ids = implode( ',' , $categories );
 		$cats = wp_list_categories( 'title_li=&style=none&echo=0&include='.$cat_ids);
 		$cats = rtrim( trim( str_replace( '<br />',  $sep, $cats) ), $sep);
 		
 		if ( $list )
			$html .= '<li class="entry-category">';
		else
			$html .= '<span class="entry-category">';

 		$html .=  $cats;
 	 	if ( $list )
			$html .= '</li>';
		else
			$html .= '</span>';

	}
	return apply_filters( 'wind_meta_category', $html );
}

// Display Meta Date
function wind_meta_date( $list = true, $style = 2 ) {
	$html = '';
	if ( 1 == $style ) {
		$html .= '<p class="post-date-2">';
		$html .=  '<span class="month">' . get_the_date('M') . '</span>';
		$html .=  '<span class="day">' . get_the_date('j') . '</span>';
		$html .=  '<span class="year">' . get_the_date('Y') . '</span></p>';
	} elseif ( 2 == $style ) {
 		if ( $list )
			$html .= '<li class="entry-date">';
		else
			$html .= '<span class="entry-date">';

		$html .= sprintf( __( '<time datetime="%1$s">%2$s</time>', 'wind' ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ) );	
 		if ( $list )
			$html .= '</li>';
		else
			$html .= '</span>';			
	}
	return apply_filters( 'wind_meta_post_date', $html );
}

function wind_meta_author( $list = true ) {
	global $wind_options;

	$html = '';	
	if ( 1 == $wind_options['showauthor'] ) {
 		if ( $list )
			$html .= '<li class="by-author">';
		else
			$html .= '<span class="by-author">';		
		$html .= sprintf( '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'wind' ), get_the_author() ) ),
			get_the_author() );
 		if ( $list )
			$html .= '</li>';
		else
			$html .= '</span>';		
	}
	return apply_filters( 'wind_meta_author', $html );
}

// Prints Comments Link
function wind_meta_comment( $list = true ) {
	$html = '';	
	if ( comments_open() && ! post_password_required() ) {
		ob_start();
 		if ( $list )
			echo '<li class="meta-comment">';
		else
			echo '<span class="meta-comment">';
		comments_popup_link( __( 'Comment', 'wind' ), __( '1 Comment', 'wind' ) , __( '% Comments', 'wind' ) );		
 		if ( $list )
			echo '</li>';
		else
			echo '</span>';		
		$html = ob_get_clean();
	}
	return apply_filters( 'wind_meta_comment', $html );
}

// Prints Post Tags
function wind_meta_tag( $list = true ) {
	$html = '';
	$tags_list = get_the_tag_list( '', __( ' &bull; ', 'wind' ) );
	if ( $tags_list ) {
		if ( $list )
			$html .= '<li class="entry-tag">';
		else
			$html .= '<span class="entry-tag">';		
		$html .= sprintf( '%1$s', $tags_list );
 		if ( $list )
			$html .= '</li>';
		else
			$html .= '</span>';		
	}
	return apply_filters( 'wind_meta_tag', $html );
}

if ( ! function_exists( 'wind_post_edit' ) ) :
function wind_post_edit() {
	edit_post_link( '<i class="fa fa-pencil"></i>', '<span class="edit-link">', '</span>' );	
}
endif;

// Post Meta Above Title
if ( ! function_exists( 'wind_meta_top' ) ) :
function wind_meta_top() {
	if ( 'post' == get_post_type() && ! is_single() ) {
		$html = '<ul class="entry-meta entry-meta-top">';		
		if ( is_sticky() ) {
			$html .= sprintf( '<li class="entry-featured">%1$s  &bull;</li>', __( 'Featured', 'wind') );
		}	
		$html .= wind_meta_category();	
		$html .= '</ul>';
		echo apply_filters( 'wind_meta_top', $html );
	}
}
endif;

// Post Meta Below Title
if ( ! function_exists( 'wind_meta_middle' ) ) :
function wind_meta_middle() {
	if ( 'post' == get_post_type() ) {
		wind_jetpack_sharing( 'top' );
		$html = '<ul class="entry-meta entry-meta-middle">';
		$html .= wind_meta_date();
		$html .= wind_meta_author();
		if ( is_single() )
			$html .= wind_meta_category();
		$html .= wind_meta_comment();			
		$html .= '</ul>';	
		echo apply_filters( 'wind_meta_middle', $html );
	}	
}
endif;


if ( ! function_exists( 'wind_meta_bottom' ) ) :
// Post Meta Below Content
function wind_meta_bottom() {
	$post_link = '';
	$tag_link = '';
	if ( 'post' == get_post_type() ) {
		if ( ! is_single() ) {
			global $post;
			$readmore = get_post_meta( $post->ID, '_wind_readmore', true );
			if ( empty( $readmore ) )
				$readmore = __( 'Read More', 'wind' );		
			$post_link = sprintf ('<li class="entry-more"><a href="%1$s" title="%2$s">%3$s</a></li>',
				get_permalink(),
				get_the_title(),
				$readmore );	
		}		
		$tag_link = wind_meta_tag();	
	}
	
	$html = '';
	if ( ! empty( $post_link ) || ! empty( $tag_link ) )
		$html .= '<ul class="entry-meta entry-meta-bottom clearfix">' . $post_link . $tag_link . '</ul>';
	echo apply_filters( 'wind_meta_bottom', $html );
	wind_jetpack_sharing( 'bottom' );	
}
endif;

// Post Meta for attachment
if ( ! function_exists( 'wind_meta_attachment' ) ) :
function wind_meta_attachment() {
	global $post;
	
	$html = '<ul class="entry-meta entry-meta-attachment clearfix">';		
	$html .= wind_meta_date();	
	
	$metadata = wp_get_attachment_metadata();	
	// Image Size
	$html .= '<li class="meta-img-size"><a href="' . wp_get_attachment_url();
	$html .= '">' . $metadata['width'] . '&times;' . $metadata['height'] . '</a></li>';
	// Parent-Post		
	$html .= '<li class="meta-parent"><a href="' . get_permalink( $post->post_parent );		
	$html .= '"  rel="gallery">' . get_the_title( $post->post_parent ) . '</a></li>';
											
	$html .= '</ul>';
	echo apply_filters( 'wind_meta_attachment', $html );
}
endif;

if ( ! function_exists( 'wind_meta_summary' ) ) :
// Prints meta info for Post Summary
function wind_meta_summary( $meta_flag = 0 ) {
	global $wind_entry_meta;
	
	$html = '';
	if ( ( $wind_entry_meta || $meta_flag ) && 'post' == get_post_type() ) {
		$html .= '<div class="entry-footer clearfix">';
		$html .= '<ul class="entry-meta entry-meta-summary clearfix">';
		$html .= wind_meta_date();
		$html .= wind_meta_author();
		$html .= wind_meta_category();
		$html .= wind_meta_tag();
		$html .= wind_meta_comment();
		$html .= '</ul></div>';
	}
	echo apply_filters( 'wind_meta_summary', $html );
}
endif;

if ( ! function_exists( 'wind_author_info' ) ) :
/************************************************
Display Author Info on single post view 
 and author has filled out their description
 and showauthor option checked 
************************************************/ 
function wind_author_info() {
	if ( is_single() && get_the_author_meta( 'description' )  ) { ?>
	<div id="author-info">
		<div id="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wind_author_bio_avatar_size', 64 ) ); ?>
		</div><!-- #author-avatar -->
		<div id="author-description">
			<h2><?php printf( __( 'About %s', 'wind' ), get_the_author() ); ?></h2>
			<p><?php the_author_meta( 'description' ); ?></p>
			<div id="author-link">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( __( 'View all posts by %s <span class="meta-nav"></span>', 'wind' ), get_the_author() ); ?></a>
			</div>
		</div>
	</div>
<?php 
	}
}
endif;

/******************************
* Pagination for main loop
******************************/
function  wind_content_nav( $nav_id ) {
	global $wp_query;
	wind_content_nav_link( $wp_query->max_num_pages, $nav_id );
}

/******************************
* Pagination
******************************/
function wind_content_nav_link( $num_of_pages, $nav_id ) {
	$html = '';
	if ( $num_of_pages > 1 ) {
		$html .= '<nav id="' . $nav_id . '" class="wind-pagination clearfix">';
		$html .=  '<ul class="pagination">';

		$big = 999999999;
    	if ( get_query_var( 'paged' ) )
	    	$current_page = get_query_var( 'paged' );
		elseif ( get_query_var( 'page' ) ) 
	   	 	$current_page = get_query_var( 'page' );
		else 
			$current_page = 1;
		$links =  paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, $current_page ),
			'total' => $num_of_pages,
			'mid_size' => 3,
			'prev_text'    => '<i class="fa fa-chevron-left"></i>' ,
			'next_text'    => '<i class="fa fa-chevron-right"></i>' ,
			'type' => 'array' ) );
			
		$html .=  '<li><span class="page-label">' . __( 'Page ', 'wind' ) . '</span></li>';
		foreach ( $links as $link )
			$html .= '<li>' . $link . '</li>';
		$html .='</ul></nav>';
	}
	echo apply_filters( 'wind_pagination', $html );
}

if ( ! function_exists( 'wind_template_intro' ) ) :
function wind_template_intro() {
//	global $post;
	if ( ! is_page() )
		return;
	$content = get_the_content();
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	if ( ! empty($content)) {
?>
<article id="post-<?php the_ID(); ?>" class="template-intro clearfix <?php echo wind_grid_full(); ?>">
<?php
		echo '<div class="entry-content clearfix">';
		echo $content;
		echo '</div>';			
?>
</article>
<?php
	}
}
endif;

/**
 * Returns a "Continue Reading" link for excerpts
 */
function wind_readmore_link() {
	global $post;
	
	$readmore_meta = '_wind_readmore';
	$readmore = get_post_meta( $post->ID, $readmore_meta, true );
	if ( empty( $readmore ) )
		$readmore = __( 'read more', 'wind' );
	$link = ' <a class="more-link" href="'. get_permalink() . '">' . $readmore . '</a>';
	return apply_filters( 'wind_readmore_link', $link );
}

/******************************
* Display Featured Image
******************************/
if ( ! function_exists( 'wind_post_thumbnail' ) ) :
function wind_post_thumbnail( $post_id, $class = 'featured-image', $size = 'full', $link = false ) {
	global $wind_options, $wind_layout;
	if ( has_post_thumbnail() ) {
		if ( 2 != $wind_layout )
			echo '<div class="featured-image-wrapper">';
		if ( ! is_single() || $link ) {
			printf ('<a href="%1$s" title="%2$s">', 
				get_permalink(),
				get_the_title()	);	
			the_post_thumbnail( $size, array( 'class'	=> $class, 'title' => get_the_title() ) );
			echo '</a>';
		}
		else {
			if ( 2 == $wind_layout ) // Full Screen		
				the_post_thumbnail( 'full', array( 'class'	=> 'fullscreen-image ' ) );	
			elseif ( 1 == $wind_options['showthumb'] )
				the_post_thumbnail( $size, array( 'class' => $class, 'title' => get_the_title() ) );
		}
		if ( 2 != $wind_layout )
			echo '</div>';
	}
}
endif;

if ( ! function_exists( 'wind_single_post_link' ) ) :
/* This function echo the link to single post view for the following:
- Aside Post
- Post without title
------------------------------------------------------------------------- */
function wind_single_post_link() {
	if ( ! is_single() ) {
		if ( has_post_format( 'aside' ) || has_post_format( 'quote' ) || '' == the_title_attribute( 'echo=0' ) ) { 
			printf ('<a class="single-post-link" href="%1$s" title="%1$s"><i class="fa fa-chevron-right"></i></a>',
				get_permalink(),
				get_the_title()	);
		} 
	}
}
endif;

if ( ! function_exists( 'wind_page_title' ) ) :	
function wind_page_title() {
	global $wind_options, $post;
	
	if ( ! have_posts()) return;
	
	$title = '';
	$class="";
	if ( is_search() ) { 
		$title = sprintf( __( 'Search Results for: %s', 'wind' ), '<span>' . get_search_query() . '</span>' );
	} elseif ( is_author() ) {
			the_post();
			$title = sprintf( __( 'Author: %s', 'wind' ), '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>' );
			rewind_posts();		
	}
	elseif ( is_category() ) {
		$category = get_the_category();
		$category_description = $category[0]->description;
		if ( empty( $category_description ) )			
			$title = sprintf( __( 'Category: %s', 'wind' ), '<span>' . single_cat_title( '', false ) . '</span>' );
		else
			$title = $category_description;			
		$class = 'cat-title cat-title-' .  $category[0]->term_id;
		if ( $category[0]->category_parent ) {
			$parent = get_term( $category[0]->term_id, 'category' );
			while ( $parent->parent ) {
				$class = $class . ' cat-title-' . $parent->parent;
				$parent = get_term( $parent->parent , 'category' );				
			}
		}
	}
	elseif ( is_tag() ) {
		$tag_description = tag_description();
		if ( empty( $tag_description ) )				
			$title = sprintf( __( 'Tag: %s', 'wind' ), '<span>' . single_tag_title( '', false ) . '</span>' );
		else
			$title = $tag_description;
	}
	elseif ( is_archive() ) {
		if ( is_day() ) 
			$title = sprintf( __( 'Daily Archives: %s', 'wind' ), '<span>' . get_the_date() . '</span>' );
		elseif ( is_month() )
			$title = sprintf( __( 'Monthly Archives: %s', 'wind' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'wind' ) ) . '</span>' );
		elseif ( is_year() )
			$title = sprintf( __( 'Yearly Archives: %s', 'wind' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'wind' ) ) . '</span>' );
		else
			$title = get_the_title();
	}
	if ( !empty( $title ) ) {
?>
		<div class="titlebar <?php echo $class; ?>">
			<div class="row"><div class="large-12 columns">
				<h3><?php echo $title; ?></h3>
			</div></div>
		</div>
<?php		
	}
}
endif;

if ( ! function_exists( 'wind_blog_title' ) ) :	
function wind_blog_title( $title ) {
	if ( is_search() || is_category() || is_tag() || is_archive() || is_paged() )
		return;
?>
	<div class="titlebar">
		<h3><?php echo apply_filters('wind_blog_title', $title ); ?></h3>
	</div>
<?php	
}
endif;

if ( ! function_exists( 'wind_site_title' ) ) :	
function wind_site_title() {
?>
	<div class="site-title-container">
		<h3 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
		<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
	</div>
<?php
}
endif;

if  ( ! function_exists( 'wind_branding' ) ) :
function wind_branding() {
	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<div class="header-image">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php wind_header_image( $header_image ); ?>
		  </a>
		<div class="site-title-container">
			<h3 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
			<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
		</div>
		</div>
<?php
	} else { ?>
		<div class="site-title-container">
			<h3 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
			<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
		</div>
<?php
	}
}
endif;

if ( ! function_exists( 'wind_header_image' ) ) :
function wind_header_image( $header_image, $size = 'full' ) {
	$html = '';
	if ( ! empty( $header_image ) ) {
		if( function_exists( 'get_custom_header' ) ) {
			$header_width = get_custom_header() -> width;
			$header_height = get_custom_header() -> height;
		}
		else {
			$header_width = HEADER_IMAGE_WIDTH;
			$header_height = HEADER_IMAGE_HEIGHT;				
		}
		if ( 'full' != $size ) {
			$ratio = $size / $header_height;
			$header_height = (int) $header_height * $ratio;
			$header_width = (int) $header_width  * $ratio;				 
		}
		$html = '<img src="' . $header_image . '" width="';
		$html .= $header_width . '" height="' . $header_height;
		$html .= '" alt="' . get_bloginfo( 'name') . '" />';
	}	
	echo apply_filters( 'wind_header_image', $html );
}
endif;

if ( ! function_exists( 'wind_the_attached_image' ) ) :	
function wind_the_attached_image() {
//Adopted from WP2014
	$post = get_post();

	$attachment_size     = apply_filters( 'wind_attachment_size', array( 1024, 1024 ) );
	$next_attachment_url = wp_get_attachment_url();

	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		} else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'wind_category_index' ) ) :	
function wind_category_index( $categories = '', $column = 4 ) {
	global $wind_options, $post;
	
	$active_cats = json_decode( $categories );
	if ( empty( $active_cats ) )
		return;
	echo '<div class="home-category">';
	$col = 0;
	foreach ( $active_cats as $category ) {
		$div_class = '';
		if ( $col == 0 )
			echo '<div class="row" data-equalizer>';
		if ($column == 2) {
			$div_class = "medium-6 columns";
			$col = $col + 1;
			if ($col == 2)
				$col = 0;
		}
		elseif ($column == 3) {
			$div_class = "medium-4 columns";
			$col = $col + 1;
			if ($col == 3)
				$col = 0;
		}
		elseif ($column == 4) {
			$div_class = "medium-3 columns";
			$col = $col + 1;
			if ($col == 4)
				$col = 0;
		}

		echo '<div class="' . $div_class .'">';
		echo '<div class="box box-catefory box-category-' . $category->id . '" data-equalizer-watch>';
		wind_category_display( $category->id, $wind_options['home_postnum'] );
		echo '</div></div>';				
		if ($col == 0)
			echo '</div>';	
	}
	if ( $col > 0 )
		echo '</div>';
	echo '</div>';
}
endif;

if ( ! function_exists( 'wind_category_display' ) ) :	
function wind_category_display( $category_id, $num_of_posts = 5) {
	global $post;
	
	$cat_name = get_the_category_by_ID( $category_id );
	printf( '<h4 class="category-title"><a href="%1$s" title="%2$s" class="right"><i class="fa fa-angle-double-right"></i></a><a href="%1$s" >%3$s</a></h4>',
		get_category_link( $category_id ) , $cat_name, $cat_name );

	$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $num_of_posts,
			'ignore_sticky_posts' => 1,
			'category__in' => $category_id,
			'no_found_rows' => 1 );
	$results = new WP_Query( $args );
	$first = true;	
	if ( $results->have_posts() ) {
		while ( $results->have_posts() ) {
			$results->the_post();
			if ( $first ) {
				if ( has_post_thumbnail() || wind_get_image() || wind_get_video() ) {
					if ( has_post_format( 'image' ) )
						echo wind_get_image();
					elseif ( has_post_format( 'video' ) )
						echo wind_get_video();
					elseif ( has_post_thumbnail() ) {
						printf ('<a href="%1$s" title="%2$s">', 
							get_permalink(),
							get_the_title()	);	
						the_post_thumbnail( 'wind-thumb', array( 'class'	=> 'wind-featured', 'title' => get_the_title() ) );
						echo '</a>';
					}
					wind_post_title( true );
				}
				else {
					wind_post_title( true );
					echo '<div class="entry-summary">';
					the_excerpt();	
					echo '</div>';
		
				}
				$first = false;
			}
			else {
				wind_post_title( true );
			}
		}
	}	
	wp_reset_postdata();
}
endif;
