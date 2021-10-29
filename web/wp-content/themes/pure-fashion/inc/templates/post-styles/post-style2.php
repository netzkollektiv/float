<?php
/**
 * Blog Post Style
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

$classes[] = 'post';
$classes[] = 'style2';

$thb_date    = thb_customizer( 'post_meta_date' );
$thb_excerpt = thb_customizer( 'post_meta_excerpt' );
$thb_cat     = thb_customizer( 'post_meta_cat' );

add_filter( 'excerpt_length', 'thb_short_excerpt_length' );
?>
<div <?php post_class( $classes ); ?>>
	<div class="row">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="small-12 large-7 columns">
			<figure class="post-gallery">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'purefashion-rectangle-x2' ); ?>
				</a>
			</figure>
		</div>
		<?php } ?>
		<div class="small-12 large-5 columns">
			<div class="style2-content-container">
				<?php if ( $thb_date || $thb_cat ) { ?>
					<aside class="thb-post-bottom">
						<?php if ( $thb_cat ) { ?>
							<?php do_action( 'thb_categories' ); ?>
						<?php } ?>
						<?php if ( $thb_date ) { ?>
						<div class="post-date"><?php echo get_the_date(); ?></div>
						<?php } ?>
					</aside>
				<?php } ?>
				<div class="post-title"><h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span><?php the_title(); ?></span></a></h3></div>
				<?php if ( $thb_excerpt ) { ?>
					<div class="post-excerpt">
						<?php the_excerpt(); ?>
					</div>
				<?php } ?>
			</div>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="thb-read-more"><?php esc_html_e( 'Read More', 'pure-fashion' ); ?></a>
		</div>
	</div>
</div>
