<?php
/**
 * Archive template for JetPack Portfolio custom content type
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package vigor
 */

get_header();

/* Define Grid Class depending on theme options */
$portfolio_class = 'grid-container';
$image_size = 'large';
$vigor_portfolio_type = get_theme_mod( 'vigor_portfolio_type', 'grid' );

if ( 'masonry' == $vigor_portfolio_type ) {
	$portfolio_class = 'masonry';
	$image_size = 'large';
} else if ( 'tiled' == $vigor_portfolio_type ) {
	$portfolio_class = 'tiled-container';
	$image_size = 'portfolio-landscape';
} else {
	$portfolio_class = 'grid-container';
	$image_size = 'portfolio-landscape';
}
set_query_var( 'image_size', $image_size ); ?>

	<div id="primary" class="content-area jetpack-portfolio-home">
		<main id="main" class="site-main" role="main">

			<header class="page-header">
				<h1 class="page-title"><?php vigor_portfolio_title(); ?></h1>
				<div class="taxonomy-description"><?php vigor_portfolio_content(); ?></div>
			</header><!-- .page-header -->

			<div id="portfolio-content" class="portfolio-content <?php echo $portfolio_class; ?>">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'portfolio' );

				endwhile; // End of the loop.	?>

			</div><!-- .portfolio-content -->			

			<?php
			the_posts_navigation();
			wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
