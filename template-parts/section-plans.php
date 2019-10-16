<?php
/**
 * Show Plans section
 * @package vigor
 */

// Grab option values.
$vigor_plans_showhide = get_theme_mod( 'vigor_plans_showhide', 'hide' );
$vigor_plans_title = get_theme_mod( 'vigor_plans_title', 'Plans' );

$vigor_plans_title1 = get_theme_mod( 'vigor_plans_title1', '' );
$vigor_plans_description1 = get_theme_mod( 'vigor_plans_description1', '' );
$vigor_plans_button1 = get_theme_mod( 'vigor_plans_button1', '' );
$vigor_plans_button_url1 = get_theme_mod( 'vigor_plans_button_url1', '' );

$vigor_plans_title2 = get_theme_mod( 'vigor_plans_title2', '' );
$vigor_plans_description2 = get_theme_mod( 'vigor_plans_description2', '' );
$vigor_plans_button2 = get_theme_mod( 'vigor_plans_button2', '' );
$vigor_plans_button_url2 = get_theme_mod( 'vigor_plans_button_url2', '' );

$vigor_plans_title3 = get_theme_mod( 'vigor_plans_title3', '' );
$vigor_plans_description3 = get_theme_mod( 'vigor_plans_description3', '' );
$vigor_plans_button3 = get_theme_mod( 'vigor_plans_button3', '' );
$vigor_plans_button_url3 = get_theme_mod( 'vigor_plans_button_url3', '' );

?>



<?php if ( 'show' == $vigor_plans_showhide ) { ?>

<div class="section-plans">

	<?php if ( ! empty( $vigor_plans_title ) ) { ?>
		<h2 class="plans-title"><?php echo esc_html( $vigor_plans_title ); ?></h2>
	<?php } ?>
	
	<div class="plan-tables">
		<?php if ( ! empty( $vigor_plans_title1 ) ) { ?>
		<div class="plan-name">
			<?php if ( ! empty( $vigor_plans_title1 ) ) { ?><h3><?php echo esc_html( $vigor_plans_title1 ); ?></h3><?php } ?>
			<?php if ( ! empty( $vigor_plans_description1 ) ) { ?><?php echo wp_kses_post( $vigor_plans_description1 ); ?><?php } ?>
			<?php if ( ! empty( $vigor_plans_button_url1 ) ) { ?><a class="button yellow" href="<?php echo esc_html( $vigor_plans_button_url1 ); ?>"><?php echo esc_html( $vigor_plans_button1 ); ?></a><?php } ?>
		</div>
		<?php } ?>

		<?php if ( ! empty( $vigor_plans_title2 ) ) { ?>
		<div class="plan-name">
			<?php if ( ! empty( $vigor_plans_title2 ) ) { ?><h3><?php echo esc_html( $vigor_plans_title2 ); ?></h3><?php } ?>
			<?php if ( ! empty( $vigor_plans_description2 ) ) { ?><?php echo wp_kses_post( $vigor_plans_description2 ); ?><?php } ?>
			<?php if ( ! empty( $vigor_plans_button_url2 ) ) { ?><a class="button yellow" href="<?php echo esc_html( $vigor_plans_button_url2 ); ?>"><?php echo esc_html( $vigor_plans_button2 ); ?></a><?php } ?>
		</div>
		<?php } ?>

		<?php if ( ! empty( $vigor_plans_title3 ) ) { ?>
		<div class="plan-name">
			<?php if ( ! empty( $vigor_plans_title3 ) ) { ?><h3><?php echo esc_html( $vigor_plans_title3 ); ?></h3><?php } ?>
			<?php if ( ! empty( $vigor_plans_description3 ) ) { ?><?php echo wp_kses_post( $vigor_plans_description3 ); ?><?php } ?>
			<?php if ( ! empty( $vigor_plans_button_url3 ) ) { ?><a class="button yellow" href="<?php echo esc_html( $vigor_plans_button_url3 ); ?>"><?php echo esc_html( $vigor_plans_button3 ); ?></a><?php } ?>
		</div>
		<?php } ?>
	</div>

</div>

<?php }
