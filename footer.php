<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vigor
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">


			<div class="footer-widgets">

				<div class="widget-area footer-logo">

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" /></a>

				</div><!-- .widget-area -->

				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>

					<div class="widget-area">

						<?php dynamic_sidebar( 'footer-1' ); ?>

					</div><!-- .widget-area -->

				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>

					<div class="widget-area">

						<?php dynamic_sidebar( 'footer-2' ); ?>

					</div><!-- .widget-area -->

				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>

					<div class="widget-area">

						<?php dynamic_sidebar( 'footer-3' ); ?>

					</div><!-- .widget-area -->

				<?php endif; ?>



			</div><!-- .footer-widgets -->

				
		<div class="site-info">
			<?php echo esc_html( date( 'Y' ) ); ?> Your Company. All rights reserved.
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
