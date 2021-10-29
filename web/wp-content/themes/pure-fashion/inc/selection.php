<?php
/**
 * Theme Options Output
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

/**
 * Outputs theme options css
 */
function thb_selection() {
	$logo_height        = thb_customizer( 'logo_height' );
	$logo_height_mobile = thb_customizer( 'logo_height_mobile' );
	$accent_color       = thb_customizer( 'accent_color' );
	ob_start();
	?>

	<?php if ( $accent_color ) { ?>
		.thb-full-menu > .menu-item > a:hover, .thb-full-menu .menu-item.current-menu-item>a, .products .product .woocommerce-loop-product__title a:hover, .wc-block-grid__products .product .woocommerce-loop-product__title a:hover {
			color: <?php echo esc_html( $accent_color ); ?>;
		}
	<?php } ?>

	<?php if ( $logo_height ) { ?>
		.logo-holder .logolink .logoimg {
			max-height: <?php echo esc_html( $logo_height ); ?>;
		}
		.logo-holder .logolink .logoimg[src$=".svg"] {
			max-height: 100%;
			height: <?php echo esc_html( $logo_height ); ?>;
		}
	<?php } ?>
	<?php if ( $logo_height_mobile ) { ?>
		@media screen and (max-width: 1023px) {
			.header .logo-holder .logolink .logoimg {
				max-height: <?php echo esc_html( $logo_height_mobile ); ?>;
			}
			.header .logo-holder .logolink .logoimg[src$=".svg"] {
				max-height: 100%;
				height: <?php echo esc_html( $logo_height_mobile ); ?>;
			}
		}
	<?php } ?>

	<?php
	if ( function_exists( 'wc_get_image_size' ) ) {
		$wc_image_size = wc_get_image_size( 'woocommerce_thumbnail' );
		$aspect        = $wc_image_size['height'] / $wc_image_size['width'];
		$percent       = $aspect * 100;

		?>
		.products .product .product-thumbnail > .woocommerce-LoopProduct-link,
		.wc-block-grid__products .product .product-thumbnail .wc-block-grid__product-link {
			padding-bottom: <?php echo esc_attr( $percent ); ?>%;
		}
		@media only screen and (min-width: 1068px) {
			.products .product.thb-double-size .product-thumbnail > .woocommerce-LoopProduct-link {
				padding-bottom: calc( <?php echo esc_attr( $percent / 2 ); ?>% - 18px );
			}
		}
		<?php
	}

	// Fonts.
	$primary_font   = thb_customizer( 'primary_typography', '{"font":"Cormorant Garamond","regularweight":"regular","italicweight":"italic","boldweight":"500","category":"serif"}' );
	$secondary_font = thb_customizer( 'secondary_typography', '{"font":"Jost","regularweight":"regular","italicweight":"italic","boldweight":"600","category":"sans-serif"}' );

	$primary_font   = json_decode( $primary_font );
	$secondary_font = json_decode( $secondary_font );

	if ( $primary_font ) {
		if ( isset( $primary_font->font ) ) {
			?>
			h1,h2,h3,h4,h5,h6, q, blockquote, .post-content blockquote, .widget .thb-widget-title {
				font-family: <?php echo esc_attr( $primary_font->font ); ?> !important;
			}
			<?php
		}
	}
	if ( $secondary_font ) {
		if ( isset( $secondary_font->font ) ) {
			?>
			body, .post .post-title h3, .post .post-title h1,.shop-general-title, .cart_totals h2, .shop-regular-title, .woocommerce-billing-fields h3, #order_review_heading, .woocommerce-Address-title h3, .woocommerce-MyAccount-content h3, .products-title, .single-product .products > h2, .cross-sells > h2, #ship-to-different-address, blockquote cite, .post-content blockquote cite {
				font-family: <?php echo esc_attr( $secondary_font->font ); ?> !important;
			}
			<?php
		}
	}
	$out = ob_get_clean();
	// Remove comments.
	$out = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out );
	// Remove space after colons.
	$out = str_replace( ': ', ':', $out );
	// Remove whitespace.
	$out = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $out );

	return $out;
}
