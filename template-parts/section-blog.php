<?php
/**
 * Show Normal Posts
 * @package vigor
 */

// Grab posts options.
$vigor_posts_showhide = get_theme_mod( 'vigor_posts_showhide', 'hide' );
$vigor_posts_title = get_theme_mod( 'vigor_posts_title', 'Blog' );

$args = array(
	'posts_per_page' => 3,
	'ignore_sticky_posts' => 1,
);

if ( 'show' == $vigor_posts_showhide ) {

	$listings = new WP_Query();
	$listings->query( $args );

	if ( $listings->found_posts > 0 ) { ?>
		<div class="section-blog">
		<?php if ( ! empty( $vigor_posts_title ) ) { ?>
			<h2 class="section-title"><?php echo esc_html( $vigor_posts_title ); ?></h2>
		<?php } ?>

		<?php while ( $listings->have_posts() ) {
			$listings->the_post(); ?>

			<div class="blog-details">
				<div class="blog-image">
					<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php echo get_the_post_thumbnail( $post->ID, 'portfolio-landscape' ); ?>
						<?php } else { ?>
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no-featured-image.png" />
						<?php } ?>
					</a>
				</div>

				<div class="entry-text">
					<h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title() ?></a></h2>
					<div class="entry-meta"><?php vigor_posted_on(); ?></div>
					<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_excerpt(); ?></a>
				</div>
				
			</div>

		<?php }
		echo '</div>';
		wp_reset_postdata();

	}
}
