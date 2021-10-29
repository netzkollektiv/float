<?php
/**
 * Enqueue / dequeue assets
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

// De-register Contact Form 7 styles.
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles.
function thb_main_styles() {
	global $post;
	$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
	$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;

	// Enqueue.
	wp_enqueue_style( 'thb-app', esc_url( get_theme_file_uri( 'assets/css/app.css' ) ), null, esc_attr( $thb_theme_version ) );

	if ( ! defined( 'THB_DEMO_SITE' ) ) {
		wp_enqueue_style( 'thb-style', get_stylesheet_uri(), null, esc_attr( $thb_theme_version ) );
	}
	wp_enqueue_style( 'thb-google-fonts', thb_theme_admin()->thb_googlefont_url(), null, esc_attr( $thb_theme_version ) );
	wp_add_inline_style( 'thb-app', thb_selection() );

	if ( $post ) {
		if ( has_shortcode( $post->post_content, 'contact-form-7' ) && function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}

}
add_action( 'wp_enqueue_scripts', 'thb_main_styles' );

// Main Scripts.
function thb_register_js() {
	if ( ! is_admin() ) {
		global $post;
		$thb_dependency          = array( 'jquery' );
		$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
		$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;
		// Register.
		if ( ! defined( 'SCRIPT_DEBUG' ) ) {
			wp_enqueue_script( 'thb-vendor', esc_url( get_theme_file_uri( 'assets/js/vendor.min.js' ) ), array( 'jquery' ), esc_attr( $thb_theme_version ), true );
			$thb_dependency[] = 'thb-vendor';
		} else {
			$thb_js_libraries = array(
				'headroom'            => 'headroom.js',
				'jquery-autocomplete' => 'jquery.autocomplete.js',
				'jquery-headroom'     => 'jquery.headroom.js',
				'jquery-hoverIntent'  => 'jquery.hoverIntent.js',
			);
			foreach ( $thb_js_libraries as $handle => $value ) {
				wp_enqueue_script( $handle, esc_url( get_theme_file_uri( 'assets/js/vendor/' . esc_attr( $value ) ) ), array( 'jquery' ), esc_attr( $thb_theme_version ), true );
			}
		}

		wp_enqueue_script( 'thb-app', esc_url( get_theme_file_uri( 'assets/js/app.min.js' ) ), $thb_dependency, esc_attr( $thb_theme_version ), true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( $post ) {
			if ( has_shortcode( $post->post_content, 'contact-form-7' ) && function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
		}

		wp_localize_script(
			'thb-app',
			'themeajax',
			array(
				'url'      => admin_url( 'admin-ajax.php' ),
				'l10n'     => array(
					/* translators: %curr%: current index */
					'of'               => esc_html__( '%curr% of %total%', 'pure-fashion' ),
					'just_of'          => esc_html__( 'of', 'pure-fashion' ),
					'loading'          => esc_html__( 'Loading', 'pure-fashion' ),
					'lightbox_loading' => esc_html__( 'Loading...', 'pure-fashion' ),
					'nomore'           => esc_html__( 'No More Posts', 'pure-fashion' ),
					'nomore_products'  => esc_html__( 'All Products Loaded', 'pure-fashion' ),
					'loadmore'         => esc_html__( 'Load More', 'pure-fashion' ),
					'adding_to_cart'   => esc_html__( 'Adding to Cart', 'pure-fashion' ),
					'added_to_cart'    => esc_html__( 'Added To Cart', 'pure-fashion' ),
					'has_been_added'   => esc_html__( 'has been added to your cart.', 'pure-fashion' ),
					'no_results'       => esc_html__( 'No Results Found', 'pure-fashion' ),
					'results_found'    => esc_html__( 'Results Found', 'pure-fashion' ),
					'results_all'      => esc_html__( 'View All Results', 'pure-fashion' ),
					'prev'             => esc_html__( 'Prev', 'pure-fashion' ),
					'next'             => esc_html__( 'Next', 'pure-fashion' ),
					'qty'              => esc_html__( 'QTY', 'pure-fashion' ),
				),
				'svg'      => array(
					'prev_arrow'  => thb_load_template_part( 'assets/img/svg/prev_arrow.svg' ),
					'next_arrow'  => thb_load_template_part( 'assets/img/svg/next_arrow.svg' ),
					'close_arrow' => thb_load_template_part( 'assets/svg/arrows_remove.svg' ),
				),
				'nonce'    => array(
					'autocomplete_ajax' => wp_create_nonce( 'thb_autocomplete_ajax' ),
				),
				'settings' => array(
					'site_url'    => get_home_url(),
					'current_url' => get_permalink(),
					'cart_url'    => thb_wc_supported() ? wc_get_cart_url() : false,
					'is_cart'     => thb_wc_supported() ? is_cart() : false,
					'is_checkout' => thb_wc_supported() ? is_checkout() : false,
				),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'thb_register_js' );

// WooCommerce Remove Unnecessary Files.
function thb_remove_wc_gallery_noscript() {
	remove_action( 'wp_head', 'wc_gallery_noscript' );
}
add_action( 'init', 'thb_remove_wc_gallery_noscript' );

function thb_woocommerce_scripts_styles() {
	if ( ! is_admin() ) {
		if ( thb_wc_supported() ) {
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_deregister_style( 'woocommerce_prettyPhoto_css' );

			wp_dequeue_style( 'jquery-selectBox' );
			wp_dequeue_script( 'jquery-selectBox' );

			if ( ! class_exists( 'WC_Checkout_Add_Ons_Loader' ) ) {
				wp_dequeue_style( 'selectWoo' );
				wp_deregister_style( 'selectWoo' );
				wp_dequeue_script( 'selectWoo' );
				wp_deregister_script( 'selectWoo' );
			}

			if ( ! is_checkout() ) {
				wp_dequeue_script( 'jquery-selectBox' );
				wp_dequeue_style( 'selectWoo' );
				wp_dequeue_script( 'selectWoo' );
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'thb_woocommerce_scripts_styles', 10001 );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
