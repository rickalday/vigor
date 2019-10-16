<?php
/**
 * Showing testimonial items.
 *
 * @package vigor
 */

?>

<div class="testimonial-item">
	<span class="genericon genericon-quote"></span>
	<?php the_content(); ?>
	
	<div class="customer-details">
		<?php if ( has_post_thumbnail() ) { ?>
			<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>
		<?php } else { ?>
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no-featured-image.png" />
		<?php } ?>
		<span class="customer-name"><?php the_title() ?></span>
	</div>
</div>
