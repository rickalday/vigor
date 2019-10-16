<?php
/**
 * Archive template for JetPack Portfolio custom content type
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package vigor
 */

get_header();

$testimonial_option = get_theme_mod( 'jetpack_testimonials' );

?>

	<div id="primary" class="content-area jetpack-testimonial-home">
		<main id="main" class="site-main" role="main">

			<header class="page-header">
				<h1 class="page-title"><?php echo esc_html( $testimonial_option['page-title'] ); ?></h1>
				<div class="testimonial-description"><?php echo esc_html( $testimonial_option['page-content'] ); ?></div>
			</header><!-- .page-header -->

			<div class="testimonial-content">				

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'testimonial' );

				endwhile; // End of the loop.	?>

			</div><!-- .testimonial-content -->			

			<?php
			the_posts_navigation();
			wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
