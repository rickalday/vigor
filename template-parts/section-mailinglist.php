<?php
/**
 * Show Mailing List section
 * @package vigor
 */

// Grab option values.
$vigor_mailing_showhide = get_theme_mod( 'vigor_mailing_showhide', 'hide' );
$vigor_mailing_title = get_theme_mod( 'vigor_mailing_title', '' );
$vigor_mailing_message = get_theme_mod( 'vigor_mailing_message', '' );
$vigor_mailing_shortcode = get_theme_mod( 'vigor_mailing_shortcode', '' );
$vigor_mailing_footer_message = get_theme_mod( 'vigor_mailing_footer_message', '' );

if ( 'show' == $vigor_mailing_showhide ) { ?>

	<div class="section-mailing">
		<?php if ( ! empty( $vigor_mailing_title ) ) { ?><div><h2><?php echo esc_html( $vigor_mailing_title ); ?></h2></div><?php } ?>
		<?php if ( ! empty( $vigor_mailing_message ) ) { ?><div class="message"><?php echo wp_kses_post( $vigor_mailing_message ); ?></div><?php } ?>
        <?php if ( ! empty( $vigor_mailing_shortcode ) ) { ?><div class="form"><?php echo do_shortcode( $vigor_mailing_shortcode ); ?></div><?php } ?>
        <?php if ( ! empty( $vigor_mailing_footer_message ) ) { ?><div class="footer-message"><?php echo do_shortcode( $vigor_mailing_footer_message ); ?></div><?php } ?>
	</div>

<?php }
