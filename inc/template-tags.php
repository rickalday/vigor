<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package vigor
 */

if ( ! function_exists( 'vigor_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function vigor_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'vigor' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'vigor' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'vigor_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function vigor_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'vigor' ) );
			if ( $categories_list && vigor_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'vigor' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'vigor' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'vigor' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'vigor' ), esc_html__( '1 Comment', 'vigor' ), esc_html__( '% Comments', 'vigor' ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'vigor' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function vigor_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'vigor_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'vigor_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so vigor_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so vigor_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'vigor_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous projects in Portfolio page template.
	 *
	 * @param int $max_num_pages Number of pages.
	 * @return void
	 */
	function vigor_paging_nav( $max_num_pages = '' ) {
		// Get max_num_pages if not provided.
		if ( '' == $max_num_pages ) {
			$max_num_pages = $GLOBALS['wp_query']->max_num_pages;
		}
		// Don't print empty markup if there's only one page.
		if ( $max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation posts-navigation clearfix" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'vigor' ); ?></h2>
			<div class="nav-links">

				<?php if ( get_next_posts_link( '', $max_num_pages ) ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( 'Previous', 'vigor' ), $max_num_pages ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link( '', $max_num_pages ) ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Next', 'vigor' ), $max_num_pages ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;


/**
 * Flush out the transients used in vigor_categorized_blog.
 */
function vigor_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'vigor_categories' );
}
add_action( 'edit_category', 'vigor_category_transient_flusher' );
add_action( 'save_post',     'vigor_category_transient_flusher' );
