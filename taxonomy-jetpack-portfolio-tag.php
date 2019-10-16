<?php
/**
 * Archive page for JetPack portfolio tags
 *
 * @package vigor
 */

get_header();

?>

	<div id="primary" class="content-area jetpack-portfolio-home">
		<main id="main" class="site-main" role="main">

			<header class="page-header">
				<h1 class="page-title"><?php vigor_portfolio_title(); ?></h1>
				<div class="taxonomy-description"><?php vigor_portfolio_content(); ?></div>
			</header><!-- .page-header -->

			<div id="portfolio-content" class="portfolio-content">

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

<?php get_footer();
