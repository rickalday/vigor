<?php
/**
 * Slideshow Section
 */

	if ( ! empty ( get_theme_mod( 'slideshow' ) ) ) : ?>

	<!-- Slideshow -->
		<?php
		// Get Slides
		$slides = get_theme_mod( 'slideshow', 'true' );
		$images = explode( ',', $slides );
        $slideshow_title = get_theme_mod( 'vigor_slideshow_title', '' );
        $slideshow_subtitle = get_theme_mod( 'vigor_slideshow_subtitle', '' );
        $slideshow_button_url = get_theme_mod( 'vigor_slideshow_button_url', '' );
        $slideshow_button = get_theme_mod( 'vigor_slideshow_button', '' );
		$slideshow_overlay = get_theme_mod( 'slideshow_overlay', 'title' );

		?>

		<div class="vigor-slider">
			<ul>

				<?php
				foreach( $images as $id ) :

					$attachment_caption = get_post_field('post_excerpt', $id);
					$attachment_title = get_post_field('post_title', $id);
					//$attachment_url = ( ! empty( get_post_meta( $id, 'slideshow-link-url', true ) ) ) ? get_post_meta( $id, 'slideshow-link-url', true ) : site_url();

					?>
					<li>
						<?php echo wp_get_attachment_image( $id, 'vigor-slideshow', 0 ); ?>
                        <?php if ( 'title' == $slideshow_overlay ) : ?>
                        <div class="slideshow-title">
                            <?php
							if ( ! empty ( $slideshow_title ) )
								echo '<h2 class="title">' . $slideshow_title . '</h2>';
							if ( ! empty ( $slideshow_subtitle ) )
                                echo '<div class="subtitle">' . $slideshow_subtitle . '</div>';
							?>
                        </div>
						<div class="slideshow-caption">
							<?php
							if ( ! empty ( $attachment_title ) )
								echo '<h3 class="slide-title">' . $attachment_title . '</h3>';
							if ( ! empty ( $attachment_caption ) )
                                echo '<div class="slide-caption">' . $attachment_caption . '</div>';
                            if ( ! empty ( $slideshow_button ) )
								echo '<div class="slide-button"><a class="button" href="' . $slideshow_button_url . '">' . $slideshow_button . '</a></div>';
							?>
						</div><!-- slideshow-caption -->
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul><!-- .slides -->
		</div><!-- .vigor-slider -->

	<?php endif;
?>