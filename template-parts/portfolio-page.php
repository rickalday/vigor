<?php
/**
 * Template Name: Portfolio Template
 *
 * @package vigor
 */

get_header();

?>

<div id="primary" class="content-area jetpack-portfolio-home">
	<main id="main" class="site-main" role="main">

	<?php
	global $page_value, $post;

	if ( get_query_var( 'paged' ) ) :
		$page_value = get_query_var( 'paged' );
	elseif ( get_query_var( 'page' ) ) :
		$page_value = get_query_var( 'page' );
	else :
		$page_value = 1;
	endif;

	$posts_per_page = get_option( 'jetpack_portfolio_posts_per_page', '9' );

	$args = array(
		'post_type' => 'jetpack-portfolio',
		'ignore_sticky_posts' => true,
		'paged' => $page_value,
		'posts_per_page' => $posts_per_page,
	);

	$project_query = new WP_Query();
	$project_query->query( apply_filters( 'vigor_portfolio_args_filter', $args ) );
	$max_pages = $project_query->max_num_pages;
	?>

		<header class="page-header">
			<?php vigor_portfolio_title( '<h1 class="page-title">', '</h1>' ); ?>

			<?php vigor_portfolio_content( '<div class="taxonomy-description">', '</div>' ); ?>
		</header><!-- .page-header -->

		<div id="portfolio-content" class="portfolio-content">

			<?php
			while ( $project_query->have_posts() ) : $project_query->the_post();

				get_template_part( 'template-parts/content', 'portfolio' );

			endwhile; // End of the loop.	?>

		</div><!-- .portfolio-content -->			

	    <?php
		vigor_paging_nav( $max_pages );
		wp_reset_postdata(); ?>
	    
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
