<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vigor
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'vigor' ); ?></a>

	<?php do_action( 'before_header' ); ?>

	<header id="masthead" class="site-header" role="banner" <?php vigor_header_image(); ?>>

		<div class="header-container">

			<div class="site-branding">
				
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/logo.png" /></a></h1>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle button" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'vigor' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'main', 'menu_id' => 'primary-menu', 'fallback_cb' => false ) ); ?>
			</nav><!-- #site-navigation -->

		</div>

	</header><!-- #masthead -->

	<?php do_action( 'after_header' ); ?>

	<div id="content" class="site-content">
