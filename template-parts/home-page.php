<?php
/**
 * Template Name: Homepage Template
 *
 * The front page template file.
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package vigor
 */

get_header(); ?>

	<div id="primary" class="content-area front-page">
		<main id="main" class="site-main" role="main">

			<?php get_template_part( 'template-parts/section', 'hero' ); ?>
			
			<?php get_template_part( 'template-parts/section', 'cta' ); ?>

			<?php get_template_part( 'template-parts/section', 'slideshow' ); ?>

			<?php get_template_part( 'template-parts/section', 'plans' ); ?>

			<?php get_template_part( 'template-parts/section', 'contact' ); ?>

			<?php get_template_part( 'template-parts/section', 'mailinglist' ); ?>

			<?php get_template_part( 'template-parts/section', 'shop' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
