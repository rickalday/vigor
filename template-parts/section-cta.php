<?php
/**
 * Show Call to Action section
 * @package vigor
 */

// Grab option values.
$vigor_cta_showhide = get_theme_mod( 'vigor_cta_showhide', 'hide' );
$vigor_cta_title = get_theme_mod( 'vigor_cta_title', '' );
$vigor_cta_message = get_theme_mod( 'vigor_cta_message', '' );
$vigor_cta_button_url = get_theme_mod( 'vigor_cta_button_url', '' );
$vigor_cta_button = get_theme_mod( 'vigor_cta_button', '' );

if ( 'show' == $vigor_cta_showhide ) { ?>

	<div class="section-cta">
		<?php if ( ! empty( $vigor_cta_title ) ) { ?><div><h2><?php echo esc_html( $vigor_cta_title ); ?></h2></div><?php } ?>
		<?php if ( ! empty( $vigor_cta_message ) ) { ?><div><?php echo wp_kses_post( $vigor_cta_message ); ?></div><?php } ?>
	</div>

<?php }
