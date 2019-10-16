<?php
/**
 * Show Hero section
 * @package vigor
 */

// Grab option values.
$vigor_hero_showhide = get_theme_mod( 'vigor_hero_showhide', 'hide' );
$vigor_hero_title = get_theme_mod( 'vigor_hero_title', '' );
$vigor_hero_message = get_theme_mod( 'vigor_hero_message', '' );
$vigor_hero_image = get_theme_mod( 'vigor_hero_image', '' );
$vigor_hero_image_2x = get_theme_mod( 'vigor_hero_image_2x', '' );
$vigor_hero_button_url = get_theme_mod( 'vigor_hero_button_url', '' );
$vigor_hero_button = get_theme_mod( 'vigor_hero_button', '' );
$vigor_hero_button_url_2 = get_theme_mod( 'vigor_hero_button_url_2', '' );
$vigor_hero_button_2 = get_theme_mod( 'vigor_hero_button_2', '' );

if ( 'show' == $vigor_hero_showhide ) { ?>

	

	<section class="section-hero">
		<img src='<?php echo esc_html( $vigor_hero_image ); ?>' srcset='<?php echo esc_html( $vigor_hero_image ); ?>, <?php echo esc_html( $vigor_hero_image ); ?> 2x' alt='<?php echo esc_html( $vigor_hero_title ); ?>'>
		<div class="hero-content">
			<?php if ( ! empty( $vigor_hero_title ) ) { ?><h1><?php echo esc_html( $vigor_hero_title ); ?></h1><?php } ?>
			<?php if ( ! empty( $vigor_hero_message ) ) { ?><h3><?php echo esc_html( $vigor_hero_message ); ?></h3><?php } ?>
			<div class="hero-buttons">
				<?php if ( ! empty( $vigor_hero_button_url ) ) { ?><a class="button yellow" href="<?php echo esc_html( $vigor_hero_button_url ); ?>"><?php echo esc_html( $vigor_hero_button ); ?></a><?php } ?>
				<?php if ( ! empty( $vigor_hero_button_url_2 ) ) { ?><a class="button yellow" href="<?php echo esc_html( $vigor_hero_button_url_2 ); ?>"><?php echo esc_html( $vigor_hero_button_2 ); ?></a><?php } ?>
			</div>	        
		</div>
	</section>

<?php }
