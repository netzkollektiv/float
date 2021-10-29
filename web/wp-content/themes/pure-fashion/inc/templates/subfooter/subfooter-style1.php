<?php
/**
 * Sub-Footer
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

	$subfooter_classes[] = 'subfooter';
	$subfooter_classes[] = 'style1';
?>
<!-- Start subfooter -->
<div class="<?php echo esc_attr( implode( ' ', $subfooter_classes ) ); ?>">
	<div class="row subfooter-row align-middle full-width-row">
		<div class="small-12 medium-6 columns text-center medium-text-left">
			<?php
				echo wp_kses_post( thb_customizer( 'copyright_text', '© 2020 <a href="https://fuelthemes.net" target="_blank" title="Premium WordPress Themes">Premium WordPress Themes</a>' ) );
			?>
		</div>
		<div class="small-12 medium-6 columns text-center medium-text-right">
			<?php
			$subfooter_right_text = thb_customizer( 'subfooter_right_text' );
			if ( $subfooter_right_text ) {
				?>
					<?php echo do_shortcode( $subfooter_right_text ); ?>
			<?php } ?>
		</div>
	</div>
</div>
<!-- End Subfooter -->
