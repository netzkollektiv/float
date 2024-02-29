<?php

class WC_GZDP_Assets {

	public $suffix = '';

	protected $localized_scripts = array();

	public function __construct() {
		$this->suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_assets' ), 15 );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_frontend_scripts' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_frontend_styles' ), 21 );

		add_action( 'wp_print_scripts', array( $this, 'localize_scripts' ), 5 );
		add_action( 'wp_print_footer_scripts', array( $this, 'localize_scripts' ), 5 );
	}

	public function add_frontend_styles() {
		do_action( 'woocommerce_gzdp_frontend_styles', $this );
	}

	public function localize_scripts() {
		if ( wp_script_is( 'wc-gzdp-checkout' ) && ! in_array( 'wc-gzdp-checkout', $this->localized_scripts, true ) ) {
			$this->localized_scripts[] = 'wc-gzdp-checkout';

			wp_localize_script(
				'wc-gzdp-checkout',
				'wc_gzdp_checkout_params',
				apply_filters(
					'wc_gzdp_checkout_params',
					array(
						'ajax_url'                      => admin_url( 'admin-ajax.php' ),
						'vat_id_status_refresh_nonce'   => wp_create_nonce( 'vat-id-status-refresh' ),
						'refresh_vat_id_status'         => 'yes' === get_option( 'woocommerce_gzdp_vat_id_required' ) || 'yes' === get_option( 'woocommerce_gzdp_force_virtual_product_business' ),
						'i18n_vat_id_label_required'    => esc_attr__( 'required', 'woocommerce-germanized-pro' ),
						'i18n_vat_id_label_optional'    => esc_attr__( 'optional', 'woocommerce-germanized-pro' ),
						'vat_exempt_postcodes'          => Vendidero\StoreaBill\Countries::get_eu_vat_postcode_exemptions(),
						'great_britain_supports_vat_id' => wc_bool_to_string( WC_GZDP_VAT_Helper::instance()->country_supports_vat_id( 'GB' ) ),
						'supports_shipping_vat_id'      => apply_filters( 'woocommerce_gzdp_checkout_supports_shipping_vat_id', true ),
					)
				)
			);
		}
	}

	public function add_frontend_scripts() {
		// Checkout general
		wp_register_script( 'wc-gzdp-checkout', WC_germanized_pro()->plugin_url() . '/assets/js/checkout' . $this->suffix . '.js', array( 'wc-checkout' ), WC_GERMANIZED_PRO_VERSION, true );

		if ( is_checkout() && 'yes' === get_option( 'woocommerce_gzdp_enable_vat_check' ) ) {
			wp_enqueue_script( 'wc-gzdp-checkout' );
		}

		do_action( 'woocommerce_gzdp_frontend_scripts', $this );
	}

	public function add_admin_assets() {
		$screen    = get_current_screen();
		$screen_id = $screen ? $screen->id : '';

		wp_register_style( 'wc-gzdp-admin', WC_germanized_pro()->plugin_url() . '/assets/css/wc-gzdp-admin' . $this->suffix . '.css', array(), WC_GERMANIZED_PRO_VERSION );
		wp_enqueue_style( 'wc-gzdp-admin' );

		wp_register_style( 'wc-gzdp-admin-setup-wizard', WC_germanized_pro()->plugin_url() . '/assets/css/wc-gzdp-admin-setup-wizard' . $this->suffix . '.css', array( 'wp-admin', 'dashicons', 'install' ), WC_GERMANIZED_PRO_VERSION );

		wp_register_script( 'wc-gzdp-admin-order', WC_germanized_pro()->plugin_url() . '/assets/js/admin-order' . $this->suffix . '.js', array( 'jquery' ), WC_GERMANIZED_PRO_VERSION, true );
		wp_register_script( 'wc-gzdp-admin-settings', WC_germanized_pro()->plugin_url() . '/assets/js/admin-settings' . $this->suffix . '.js', array( 'jquery' ), WC_GERMANIZED_PRO_VERSION, true );
		wp_register_script( 'wc-gzdp-admin-products', WC_germanized_pro()->plugin_url() . '/assets/js/admin-products' . $this->suffix . '.js', array( 'jquery' ), WC_GERMANIZED_PRO_VERSION, true );
		wp_register_script( 'wc-gzdp-admin-meta-boxes-order', WC_germanized_pro()->plugin_url() . '/assets/js/admin-meta-boxes-order' . $this->suffix . '.js', array( 'wc-admin-meta-boxes' ), WC_GERMANIZED_PRO_VERSION ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter

		wp_register_script( 'wc-gzdp-admin-packing-slip', WC_germanized_pro()->plugin_url() . '/assets/js/admin-packing-slip' . $this->suffix . '.js', array( 'wc-gzd-admin-shipments' ), WC_GERMANIZED_PRO_VERSION ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter

		if ( $screen && in_array( str_replace( 'edit-', '', $screen->id ), wc_get_order_types( 'order-meta-boxes' ), true ) ) {
			wp_enqueue_script( 'wc-gzdp-admin-meta-boxes-order' );
		}

		// Orders.
		$is_edit_order = in_array( str_replace( 'edit-', '', $screen_id ), wc_get_order_types( 'order-meta-boxes' ), true );

		if ( $is_edit_order ) {
			wp_enqueue_script( 'wc-gzdp-admin-packing-slip' );

			wp_localize_script(
				'wc-gzdp-admin-packing-slip',
				'wc_gzdp_admin_packing_slip_params',
				array(
					'ajax_url'                          => admin_url( 'admin-ajax.php' ),
					'remove_packing_slip_nonce'         => wp_create_nonce( 'wc-gzdp-remove-packing-slip' ),
					'refresh_packing_slip_nonce'        => wp_create_nonce( 'wc-gzdp-refresh-packing-slip' ),
					'i18n_remove_packing_slip_notice'   => __( 'Do you really want to delete the packing slip?', 'woocommerce-germanized-pro' ),
					'i18n_create_packing_slip_enabled'  => __( 'Create new packing slip', 'woocommerce-germanized-pro' ),
					'i18n_create_packing_slip_disabled' => __( 'Please save the shipment before creating a new packing slip', 'woocommerce-germanized-pro' ),
				)
			);
		}

		if ( in_array( $screen->id, array( 'shop_order', 'edit-shop_order' ), true ) ) {
			// Order JS
			wp_enqueue_script( 'wc-gzdp-admin-order' );
		} elseif ( 'woocommerce_page_wc-settings' === $screen->id ) {
			wp_enqueue_media();
			wp_localize_script(
				'wc-gzdp-admin-settings',
				'wc_gzdp_attachment_field',
				array(
					'title'    => _x( 'Choose Attachment', 'admin-field', 'woocommerce-germanized-pro' ),
					'insert'   => _x( 'Set attachment', 'admin-field', 'woocommerce-germanized-pro' ),
					'unset'    => _x( 'Unset attachment', 'admin-field', 'woocommerce-germanized-pro' ),
					'ajax_url' => admin_url( 'admin-ajax.php' ),
				)
			);

			wp_localize_script(
				'wc-gzdp-admin-settings',
				'wc_gzdp',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
				)
			);

			wp_enqueue_script( 'wc-gzdp-admin-settings' );
		}

		if ( in_array( $screen->id, array( 'product' ), true ) ) {
			wp_enqueue_script( 'wc-gzdp-admin-products' );

			$nutrient_ref_values = array_flip( \Vendidero\Germanized\Pro\Food\Helper::get_nutrient_reference_values() );
			$nutrient_ref_values[ __( '100 g each', 'woocommerce-germanized-pro' ) ]  = '100g';
			$nutrient_ref_values[ __( '100 ml each', 'woocommerce-germanized-pro' ) ] = '100g';

			$nutrient_ref_regexes = array();

			foreach ( $nutrient_ref_values as $nutrient_ref_value => $ref_value ) {
				$nutrient_ref_regexes[ str_replace( array( ' g', ' ml' ), array( '(\s)?g', '(\s)?ml' ), $nutrient_ref_value ) ] = $ref_value;
			}

			$units = WC_germanized()->units->get_units();

			wp_localize_script(
				'wc-gzdp-admin-products',
				'wc_gzdp_admin_products_params',
				array(
					'i18n_nutrient_reference_values'       => $nutrient_ref_regexes,
					'i18n_nutrient_reference_values_regex' => '(' . implode( '|', array_keys( $nutrient_ref_regexes ) ) . ')',
					'i18n_nutrient_units_regex'            => '(' . implode( '|', $units ) . ')',
					'decimal_separator'                    => wc_get_price_decimal_separator(),
				)
			);
		}

		do_action( 'woocommerce_gzdp_admin_assets' );
	}
}

return new WC_GZDP_Assets();
