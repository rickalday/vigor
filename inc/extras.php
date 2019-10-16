<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package vigor
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function vigor_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( ( is_front_page() && get_header_image() ) || ( is_page_template( 'template-parts/home-page.php' ) && has_post_thumbnail( ) ) ) {
		$classes[] = 'has-header-image';
	}


	if ( is_page_template( 'template-parts/front-page.php' ) ) {
	   	$classes[] .= 'vigor-full-width';
	}

	if ( is_page_template( 'template-parts/page-portfolio-grid.php' ) ) {
	   	$classes[] .= 'vigor-full-width-padding';
	}


	return $classes;
}
add_filter( 'body_class', 'vigor_body_classes' );

/**
 * Custom comments display to move Reply link,
 * used in comments.php
 *
 * @param int   $comment Comment object.
 * @param array	$args Arguments for comments.
 * @param int 	$depth Comment level.
 */
function vigor_comments( $comment, $args, $depth ) {
?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-metadata">
					<span class="comment-author vcard">
						<?php if ( 0 !== $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
						<?php printf( '<b class="fn">%s</b>', get_comment_author_link() ); ?>
					</span>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( '<span class="comment-date">%1$s</span><span class="comment-time screen-reader-text">%2$s</span>', get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<span class="reply">',
						'after'     => '</span>',
					) ) );
					?>
					<?php edit_comment_link( esc_html__( 'Edit', 'vigor' ), '<span class="edit-link">', '</span>' ); ?>

				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'vigor' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

		</article><!-- .comment-body -->
	</li>
<?php
}

/**
 * Show Footer Classes
 */
function vigor_footer_classes() {
	$classes = '';

	if ( has_nav_menu( 'social' ) ) {
		$classes .= ' has-social-menu';
	}

	echo esc_attr( $classes );
}

/**
 * Header image styling
 */
function vigor_header_image() {
	global $post;
	$header_image = "";

	if ( is_post_type_archive( 'jetpack-testimonial' ) ) {
		$jetpack_options = get_theme_mod( 'jetpack_testimonials' );
		$header_image = wp_get_attachment_image_src( ( int ) $jetpack_options['featured-image'], 'large' )[0];
	} else if ( is_page_template( 'template-parts/home-page.php' ) ) {
		return;
	} else {
		return;
	}

	if ( ! empty( $header_image ) ) {
		echo 'style="background-image:url(' . esc_url( $header_image ) . ');"';
	}
}


/**
 * Set a custom Gallery option in Gallery Settings
 */
if ( class_exists( 'Jetpack_Tiled_Gallery' ) ) :
	/**
	 * Set a custom Gallery Type Option in Gallery Settings
	 *
	 * @param array $types Types of Galleries.
	 */
	function vigor_jetpack_gallery_types( $types ) {
		$vigor_jetpack_gallery = new Jetpack_Tiled_Gallery;
		$vigor_gallery_types = $vigor_jetpack_gallery->jetpack_gallery_types( $types );
		$vigor_gallery_types = array_merge( $vigor_gallery_types, array( 'vigor-masonry' => __( 'Vigor Masonry Gallery', 'vigor' ) ) );

		return $vigor_gallery_types;
	}
	add_filter( 'jetpack_gallery_types', 'vigor_jetpack_gallery_types' );
endif;


/**
 * Register our gallery javascript and css
 */
function vigor_gallery_scripts() {

	wp_register_style( 'vigor-masonry-css', get_template_directory_uri() . '/inc/assets/css/masonry.css', array(), '1.0.2' );
	wp_register_script( 'vigor-masonry-init-js', get_template_directory_uri() . '/inc/assets/js/masonry-init.js', array( 'jquery' ), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'vigor_gallery_scripts', 500 );

/**
 * Replace gallery markup with custom class for masonry
 */
function vigor_gallery_class( $content ) {
	global $post;
	global $id;
	static $instance = 0;
	$instance++;
	$selector = "gallery-{$instance}";

	$gallery_div = "<div id='$selector' class='gallery vigor-masonry galleryid-{$id}'>";
	
	return $gallery_div;
}


/**
 * HTML Wrapper - Support for a custom class attribute in the native gallery shortcode
 */
add_filter( 'post_gallery', 'vigor_add_gallery_container', 10, 3 );

function vigor_add_gallery_container( $html, $atts, $instance = '' ) {
	remove_filter( 'gallery_style', 'vigor_gallery_class' );
    if( isset( $atts['type'] ) && 'vigor-masonry' == $atts['type'] ) {
        
        wp_enqueue_style( 'vigor-masonry-css' );
		wp_enqueue_script( 'vigor-masonry-init-js' );	
        add_filter( 'gallery_style', 'vigor_gallery_class' );
    }
}

/**
 * Add Slideshow Link URL to media uploader
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */
function vigor_attachment_fields_to_edit( $form_fields, $post ) {
	$form_fields['slideshow-link-url'] = array(
		'label' => __( 'Slideshow Link URL', 'vigor' ),
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'slideshow-link-url', true ),
		'helps' => __( 'URL that this image links to when included in slideshows', 'vigor' )
	);

	return $form_fields;
}
//add_filter( 'attachment_fields_to_edit', 'vigor_attachment_fields_to_edit', 10, 2 );

/**
 * Save values of Slideshow Link Url in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */
function vigor_attachment_fields_to_save( $post, $attachment ) {
	if ( isset( $attachment['slideshow-link-url'] ) )
		update_post_meta( $post['ID'], 'slideshow-link-url', $attachment['slideshow-link-url'] );
	
	return $post;
}
//add_filter( 'attachment_fields_to_save', 'vigor_attachment_fields_to_save', 10, 2 );

/**
 * Add vigor_panel to query vars
 * @param  $qvars
 * @return $qvars
 */
function vigor_query_vars( $qvars ) {
	$qvars[] = 'vigor_panel';
	return $qvars;
}
add_filter( 'query_vars', 'vigor_query_vars' , 10, 1 );


/**
 * Simple Gallery used for contact section but can be used anywhere else
 * @param  integer $post_id the post id
 * @return html the full gallery markup
 */
function vigor_gallery( $image_id_array ) {
	$image_count = count($image_id_array);
	$counter = 0;
 	$html = '';
	$html .= '<div class="vigor-simple-gallery">';
	if ( $image_id_array) foreach ( $image_id_array as $image_id ) {
		$thumbnail_image = wp_get_attachment_image( $image_id, 'thumbnail' );
		$large_image = wp_get_attachment_image_src( $image_id, 'large' );
		$counter++;
		$html .= '<div class="image_container">';

		$html .= '<a href="' . $large_image[0] . '"> ' . $thumbnail_image;
		if ( $counter === 4 &&  $image_count > 4 ) {
			$remaining_images = $image_count - 4;
			$html .= '<div class="gallery-count">' . $remaining_images . ' more</div>';
		}
		$html .= '</a>';
		$html .= '</div>';
	}
	$html .= '</div>';
	echo $html;
}
