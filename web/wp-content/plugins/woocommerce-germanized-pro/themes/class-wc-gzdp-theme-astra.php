<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WC_GZDP_Theme_Astra extends WC_GZDP_Theme {

	protected $payment_wrap_priority = null;

	public function __construct( $template ) {
		parent::__construct( $template );

		add_filter( 'woocommerce_gzd_shopmark_single_product_filters', array( $this, 'single_product_filters' ), 10 );
		add_filter( 'woocommerce_gzd_shopmark_product_loop_filters', array( $this, 'product_loop_filters' ), 10 );

		add_filter( 'woocommerce_gzd_shopmark_product_loop_defaults', array( $this, 'product_loop_defaults' ), 10 );
		add_filter( 'woocommerce_gzd_shopmark_single_product_defaults', array( $this, 'single_product_defaults' ), 10 );

		add_action( 'astra_woo_quick_view_product_summary', array( $this, 'quick_view_summary_hooks' ), 10 );

		add_action( 'wp', array( $this, 'modern_checkout_compatibility' ), 50 );
		add_filter( 'astra_woo_shop_product_structure', array( $this, 'adjust_shop_structure' ), 10 );
	}

	public function adjust_shop_structure( $shop_structure ) {
		if ( is_array( $shop_structure ) && ! empty( $shop_structure ) ) {
			if ( 'no' === get_option( 'woocommerce_gzd_display_listings_add_to_cart' ) ) {
				$shop_structure = array_diff( $shop_structure, array( 'add_cart' ) );
			}
		}

		return $shop_structure;
	}

	protected function get_astra_option( $option_name ) {
		if ( function_exists( 'astra_get_option' ) ) {
			return astra_get_option( $option_name );
		}

		return false;
	}

	public function modern_checkout_compatibility() {
		if ( $this->extension_is_enabled() && ! defined( 'CARTFLOWS_VER' ) && ! wc_gzd_checkout_adjustments_disabled() && 'modern' === $this->get_astra_option( 'checkout-layout-type' ) ) {
			remove_action( 'woocommerce_review_order_before_payment', 'woocommerce_gzd_template_checkout_payment_title' );

			remove_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );
			remove_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 10 );

			remove_action( 'woocommerce_review_order_before_cart_contents', 'woocommerce_gzd_template_checkout_table_content_replacement' );
			remove_action( 'woocommerce_review_order_after_cart_contents', 'woocommerce_gzd_template_checkout_table_product_hide_filter_removal' );

			add_action(
				'woocommerce_checkout_order_review',
				function() {
					if ( ! wc_gzd_checkout_adjustments_disabled() ) {
						if ( doing_action( 'woocommerce_before_checkout_form' ) ) {
							$this->payment_wrap_priority = WC_GZD_Hook_Priorities::instance()->get_priority( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
							remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', $this->payment_wrap_priority );
						} else {
							if ( ! is_null( $this->payment_wrap_priority ) ) {
								add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', $this->payment_wrap_priority );
								$this->payment_wrap_priority = null;
							}
						}
					}
				},
				1
			);
		}
	}

	public function quick_view_summary_hooks() {
		foreach ( wc_gzd_get_single_product_shopmarks() as $shopmark ) {
			$shopmark->execute();
		}
	}

	public function set_single_product_filter( $filter ) {
		return 'astra_woo_single_price_after';
	}

	public function has_custom_shopmarks() {
		return true;
	}

	public function single_product_defaults( $defaults ) {
		$count = 10;

		foreach ( $defaults as $type => $type_data ) {
			$defaults[ $type ]['default_filter']   = 'astra_woo_single_price_after';
			$defaults[ $type ]['default_priority'] = $count++;
		}

		return $defaults;
	}

	public function product_loop_defaults( $defaults ) {
		$count = 10;

		foreach ( $defaults as $type => $type_data ) {
			$defaults[ $type ]['default_filter']   = 'astra_woo_shop_price_after';
			$defaults[ $type ]['default_priority'] = $count++;
		}

		return $defaults;
	}

	public function product_loop_filters( $filters ) {
		$filters['astra_woo_shop_price_after'] = array(
			'title'            => __( 'Astra - After Price', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		$filters['astra_woo_shop_rating_after'] = array(
			'title'            => __( 'Astra - After Rating', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		$filters['astra_woo_shop_short_description_after'] = array(
			'title'            => __( 'Astra - After Short Description', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		$filters['astra_woo_shop_add_to_cart_after'] = array(
			'title'            => __( 'Astra - After Add to Cart', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		$filters['astra_woo_shop_category_after'] = array(
			'title'            => __( 'Astra - After Product Category', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		return $filters;
	}

	public function single_product_filters( $filters ) {
		$filters['astra_woo_single_price_after'] = array(
			'title'            => __( 'Astra - After Price', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		$filters['astra_woo_single_title_after'] = array(
			'title'            => __( 'Astra - After Title', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		$filters['astra_woo_single_short_description_after'] = array(
			'title'            => __( 'Astra - After Short Description', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		$filters['astra_woo_single_add_to_cart_after'] = array(
			'title'            => __( 'Astra - After Add to Cart', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		$filters['astra_woo_single_category_after'] = array(
			'title'            => __( 'Astra - After Meta', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		$filters['astra_woo_single_product_category_after'] = array(
			'title'            => __( 'Astra - After Product Category', 'woocommerce-germanized-pro' ),
			'number_of_params' => 1,
			'is_action'        => true,
		);

		return $filters;
	}

	protected function extension_is_enabled() {
		return is_callable( array( 'Astra_Ext_Extension', 'is_active' ) ) && Astra_Ext_Extension::is_active( 'woocommerce' );
	}
}
