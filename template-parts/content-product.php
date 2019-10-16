<?php
/**
 * Showing WC items.
 *
 * @package vigor
 */

?>

<div class="product-item">
    <div class="product-info">
        <div class="entry-text">
            <h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php esc_attr( the_title_attribute() ); ?>"><?php the_title(); ?></a></h3>
            <?php
            $currency = get_woocommerce_currency_symbol();
            $price = get_post_meta( get_the_ID(), '_regular_price', true);
            echo $currency;
            echo $price;
            ?>
        </div>
        <div class="add-to-cart">
            <a href="#" class="button black">Buy now</a>
        </div>
    </div>
    <div class="product-image">
        <a href="<?php echo esc_url( get_permalink() ); ?>" >
            <?php if ( has_post_thumbnail() ) { ?>
                <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
            <?php } else { ?>
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no-featured-image.png" />
            <?php } ?>
        </a>
    </div>
</div>