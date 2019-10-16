<?php
/**
 * Show Hero section
 * @package vigor
 */

// Grab option values.
$vigor_shop_showhide = get_theme_mod( 'vigor_shop_showhide', 'hide' );
$vigor_shop_title = get_theme_mod( 'vigor_shop_title', '' );
$vigor_shop_message = get_theme_mod( 'vigor_shop_message', '' );
$vigor_shop_button_url = get_theme_mod( 'vigor_shop_button_url', '' );
$vigor_shop_button = get_theme_mod( 'vigor_shop_button', '' );

if ( 'show' == $vigor_shop_showhide ) { ?>

	

	<section class="section-shop">
		<div class="shop-content">
			<?php if ( ! empty( $vigor_shop_title ) ) { ?><h2><?php echo esc_html( $vigor_shop_title ); ?></h2><?php } ?>
			<?php if ( ! empty( $vigor_shop_message ) ) { ?><p><?php echo esc_html( $vigor_shop_message ); ?></p><?php } ?>
			<div class="shop-buttons">
				<?php if ( ! empty( $vigor_shop_button_url ) ) { ?><a href="<?php echo esc_html( $vigor_shop_button_url ); ?>"><?php echo esc_html( $vigor_shop_button ); ?></a><?php } ?>
			</div>	        
        </div>
        
        <?php
        if ( class_exists( 'woocommerce' ) ) {
            $listings = new WP_Query();
            $listings->query( 'post_type=product&posts_per_page=2');

            if ( $listings->found_posts > 0 ) { ?>
                <div class="home-products">
                    

                    <?php while ( $listings->have_posts() ) {
                        $listings->the_post();

                        get_template_part( 'template-parts/content', 'product' );

                    } ?>

                </div>
                <?php wp_reset_postdata();
            }
        }
        ?>

	</section>

<?php }
