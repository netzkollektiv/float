<?php
/**
 * ShippingProvider impl.
 *
 * @package WooCommerce/Blocks
 */
namespace Vendidero\Germanized\DPD\ShippingProvider;

use Vendidero\Germanized\DPD\Package;
use Vendidero\Germanized\Shipments\Admin\ProviderSettings;
use Vendidero\Germanized\Shipments\Shipment;
use Vendidero\Germanized\Shipments\ShippingProvider\Auto;

defined( 'ABSPATH' ) || exit;

class DPD extends Auto {

	protected function get_default_label_minimum_shipment_weight() {
		return 0.01;
	}

	protected function get_default_label_default_shipment_weight() {
		return 0.5;
	}

	public function get_title( $context = 'view' ) {
		return _x( 'DPD', 'dpd', 'woocommerce-germanized-pro' );
	}

	public function get_name( $context = 'view' ) {
		return 'dpd';
	}

	public function get_description( $context = 'view' ) {
		return _x( 'Create DPD labels and return labels conveniently.', 'dpd', 'woocommerce-germanized-pro' );
	}

	public function get_default_tracking_url_placeholder() {
		return 'https://tracking.dpd.de/parcelstatus?query={tracking_id}&locale=de_DE';
	}

	public function is_sandbox() {
		return Package::get_api()->is_sandbox();
	}

	public function get_label_classname( $type ) {
		if ( 'return' === $type ) {
			return '\Vendidero\Germanized\DPD\Label\Retoure';
		} else {
			return '\Vendidero\Germanized\DPD\Label\Simple';
		}
	}

	/**
	 * @param string $label_type
	 * @param false|Shipment $shipment
	 *
	 * @return bool
	 */
	public function supports_labels( $label_type, $shipment = false ) {
		$label_types = array( 'simple', 'return' );

		/**
		 * DPD does not support return labels for third countries
		 */
		if ( $shipment && 'return' === $label_type && $shipment->is_shipping_international() ) {
			return false;
		}

		return in_array( $label_type, $label_types );
	}

	public function supports_customer_return_requests() {
		return true;
	}

	public function hide_return_address() {
		return false;
	}

	public function get_api_username( $context = 'view' ) {
		return $this->get_meta( 'api_username', true, $context );
	}

	public function set_api_username( $username ) {
		$this->update_meta_data( 'api_username', strtolower( $username ) );
	}

	public function get_setting_sections() {
		$sections = parent::get_setting_sections();

		return $sections;
	}

	/**
	 * @param \Vendidero\Germanized\Shipments\Shipment $shipment
	 *
	 * @return array
	 */
	protected function get_return_label_fields( $shipment ) {
		$settings     = parent::get_return_label_fields( $shipment );
		$default_args = $this->get_default_label_props( $shipment );

		return $settings;
	}

	/**
	 * @param \Vendidero\Germanized\Shipments\Shipment $shipment
	 *
	 * @return array
	 */
	protected function get_simple_label_fields( $shipment ) {
		$settings     = parent::get_simple_label_fields( $shipment );
		$default_args = $this->get_default_label_props( $shipment );

		$settings = array_merge( $settings, array(
			array(
				'id'          => 'page_format',
				'label'       => _x( 'Page Format', 'dpd', 'woocommerce-germanized-pro' ),
				'description' => '',
				'type'        => 'select',
				'options'	  => Package::get_api()->get_page_formats(),
				'value'       => isset( $default_args['page_format'] ) ? $default_args['page_format'] : '',
			)
		) );

		$services = array();

		if ( $shipment->is_shipping_international() ) {
			$settings = array_merge( $settings, array(
				array(
					'id'          => 'customs_terms',
					'label'       => _x( 'Customs terms', 'dpd', 'woocommerce-germanized-pro' ),
					'description' => '',
					'type'        => 'select',
					'options'	  => Package::get_api()->get_international_customs_terms(),
					'value'       => isset( $default_args['customs_terms'] ) ? $default_args['customs_terms'] : '',
				),
				array(
					'id'          => 'customs_paper',
					'label'       => _x( 'Customs paper', 'dpd', 'woocommerce-germanized-pro' ),
					'description' => '',
					'type'        => 'multiselect',
					'options'	  => Package::get_api()->get_international_customs_paper(),
					'value'       => isset( $default_args['customs_paper'] ) ? $default_args['customs_paper'] : '',
				)
			) );

			$services = array_merge( $services, array(
				array(
					'id'          		=> 'service_international_guarantee',
					'label'       		=> _x( 'Guarantee', 'dpd', 'woocommerce-germanized-pro' ),
					'description'       => '',
					'type'              => 'checkbox',
					'value'		        => in_array( 'service_international_guarantee', $default_args['services'] ) ? 'yes' : 'no',
					'wrapper_class'     => 'form-field-checkbox',
				)
			) );
		}

		if ( ! empty( $services ) ) {
			$settings[] = array(
				'type'         => 'services_start',
				'id'           => '',
				'hide_default' => true,
			);

			$settings = array_merge( $settings, $services );
		}

		return $settings;
	}

	protected function get_default_page_format() {
		return 'A6';
	}

	protected function get_default_customs_terms() {
		return '06';
	}

	protected function get_default_customs_paper() {
		return array( 'B', 'G' );
	}

	/**
	 * @param Shipment $shipment
	 * @param $props
	 *
	 * @return \WP_Error|mixed
	 */
	protected function validate_label_request( $shipment, $args = array() ) {
		$args = wp_parse_args( $args, array(
			'page_format'   => $this->get_default_page_format(),
			'product_id'    => 'CL',
			'customs_terms' => $this->get_default_customs_terms(),
			'customs_paper' => $this->get_default_customs_paper()
		) );

		$error = new \WP_Error();

		if ( ! in_array( $args['page_format'], array_keys( Package::get_api()->get_page_formats() ) ) ) {
			$error->add( 'page_format', _x( 'Please choose a valid page format.', 'dpd', 'woocommerce-germanized-pro' ) );
		}

		if ( $shipment->is_shipping_international() ) {
			if ( ! in_array( $args['customs_terms'], array_keys( Package::get_api()->get_international_customs_terms() ) ) ) {
				$error->add( 'customs_terms', _x( 'Please choose a customs term.', 'dpd', 'woocommerce-germanized-pro' ) );
			}
		}

		if (
			( $shipment->is_shipping_domestic() && ! in_array( $args['product_id'], array_keys( Package::get_domestic_products() ) ) ) ||
		    ( $shipment->is_shipping_inner_eu() && ! in_array( $args['product_id'], array_keys( Package::get_eu_products() ) ) ) ||
		    ( $shipment->is_shipping_international() && ! in_array( $args['product_id'], array_keys( Package::get_international_products() ) ) )
		) {
			$error->add( 'product_id', _x( 'Please choose a valid DPD product.', 'dpd', 'woocommerce-germanized-pro' ) );
		}

		if ( wc_gzd_shipment_wp_error_has_errors( $error ) ) {
			return $error;
		}

		return $args;
	}

	/**
	 * @param Shipment $shipment
	 *
	 * @return array
	 */
	protected function get_default_label_props( $shipment ) {
		if ( 'return' === $shipment->get_type() ) {
			$dpd_defaults = $this->get_default_return_label_props( $shipment );
		} else {
			$dpd_defaults = $this->get_default_simple_label_props( $shipment );
		}

		$defaults = parent::get_default_label_props( $shipment );

		return array_replace_recursive( $defaults, $dpd_defaults );
	}

	/**
	 * @param Shipment $shipment
	 *
	 * @return array
	 */
	protected function get_default_return_label_props( $shipment ) {
		$product_id = $this->get_default_label_product( $shipment );

		$defaults = array(
			'services'    => array(),
			'page_format' => $this->get_shipment_setting( $shipment, 'label_default_page_format' ),
		);

		return $defaults;
	}

	/**
	 * @param \Vendidero\Germanized\Shipments\Shipment $shipment
	 */
	public function get_default_label_product( $shipment ) {
		if ( 'simple' === $shipment->get_type() ) {
			if ( $shipment->is_shipping_domestic() ) {
				return $this->get_shipment_setting( $shipment, 'label_default_product_dom' );
			} else {
				return $this->get_shipment_setting( $shipment, 'label_default_product_int' );
			}
		}

		return '';
	}

	/**
	 * @param Shipment $shipment
	 *
	 * @return array
	 */
	protected function get_default_simple_label_props( $shipment ) {
		$product_id = $this->get_default_label_product( $shipment );

		$defaults = array(
			'services'      => array(),
			'page_format'   => $this->get_shipment_setting( $shipment, 'label_default_page_format', $this->get_default_page_format() ),
			'customs_terms' => $this->get_shipment_setting( $shipment, 'label_default_customs_terms', $this->get_default_customs_terms() ),
			'customs_paper' => $this->get_shipment_setting( $shipment, 'label_default_customs_paper', $this->get_default_customs_paper() ),
		);

		return $defaults;
	}

	/**
	 * @param \Vendidero\Germanized\Shipments\Shipment $shipment
	 */
	public function get_available_label_products( $shipment ) {
		if ( $shipment->is_shipping_domestic() ) {
			return Package::get_domestic_products();
		} elseif ( $shipment->is_shipping_inner_eu() ) {
			return Package::get_eu_products();
		} else {
			$products = Package::get_international_products();

			if ( 'CH' !== $shipment->get_country() && array_key_exists( 'CL', $products ) ) {
				unset( $products['CL'] );
			}

			return $products;
		}
	}

	/**
	 * @param \Vendidero\Germanized\Shipments\Shipment $shipment
	 */
	public function get_available_label_services( $shipment ) {
		$services = array();

		if ( $shipment->is_shipping_international() ) {
			$services = array_merge( $services, array(
				'international_guarantee'
			) );
		}

		return $services;
	}

	protected function get_available_base_countries() {
		return Package::get_supported_countries();
	}

	protected function get_general_settings( $for_shipping_method = false ) {
		$settings = array(
			array( 'title' => '', 'type' => 'title', 'id' => 'dpd_api_options' ),

			array(
				'title'             => _x( 'DPD Cloud User', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'text',
				'desc'              => '<div class="wc-gzd-additional-desc">' . sprintf( _x( 'Please use your DPD Cloud User ID and token to connect your shop to the DPD Web Connect API.', 'dpd', 'woocommerce-germanized-pro' ), 'https://www.dpd.com/de/de/mydpd-anmelden-und-registrieren/' ) . '</div>',
				'id' 		        => 'api_username',
				'default'           => '',
				'value'             => $this->get_setting( 'api_username', '' ),
				'custom_attributes'	=> array( 'autocomplete' => 'new-password' )
			),

			array(
				'title'             => _x( 'DPD Cloud Token', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'password',
				'desc'              => '',
				'id' 		        => 'api_password',
				'value'             => $this->get_setting( 'api_password', '' ),
				'custom_attributes'	=> array( 'autocomplete' => 'new-password' )
			),

			array( 'type' => 'sectionend', 'id' => 'dpd_api_options' ),
		);

		$settings = array_merge( $settings, array(
			array( 'title' => _x( 'Tracking', 'dpd', 'woocommerce-germanized-pro' ), 'type' => 'title', 'id' => 'tracking_options' ),
		) );

		$general_settings = parent::get_general_settings( $for_shipping_method );

		return array_merge( $settings, $general_settings );
	}

	protected function get_label_settings( $for_shipping_method = false ) {
		$select_dpd_product_dom = Package::get_domestic_products();
		$select_dpd_product_int = Package::get_international_products();
		$select_dpd_product_eu  = Package::get_eu_products();
		$select_formats         = Package::get_api()->get_page_formats();

		$settings = array(
			array( 'title' => '', 'title_method' => _x( 'Products', 'dpd', 'woocommerce-germanized-pro' ), 'type' => 'title', 'id' => 'shipping_provider_dpd_label_options', 'allow_override' => true ),

			array(
				'title'             => _x( 'Domestic Default Service', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'select',
				'id'                => 'label_default_product_dom',
				'default'           => 'CL',
				'value'             => $this->get_setting( 'label_default_product_dom', 'CL' ),
				'desc'              => '<div class="wc-gzd-additional-desc">' . _x( 'Please select your default DPD shipping service for domestic shipments that you want to offer to your customers (you can always change this within each individual shipment afterwards).', 'dpd', 'woocommerce-germanized-pro' ) . '</div>',
				'options'           => $select_dpd_product_dom,
				'class'             => 'wc-enhanced-select',
			),

			array(
				'title'             => _x( 'EU Default Service', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'select',
				'default'           => '',
				'value'             => $this->get_setting( 'label_default_product_eu', '' ),
				'id'                => 'label_default_product_eu',
				'desc'              => '<div class="wc-gzd-additional-desc">' . _x( 'Please select your default DPD shipping service for cross-border shipments that you want to offer to your customers (you can always change this within each individual shipment afterwards).', 'dpd', 'woocommerce-germanized-pro' ) . '</div>',
				'options'           => $select_dpd_product_eu,
				'class'             => 'wc-enhanced-select',
			),

			array(
				'title'             => _x( 'Int. Default Service', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'select',
				'default'           => '',
				'value'             => $this->get_setting( 'label_default_product_int', '' ),
				'id'                => 'label_default_product_int',
				'desc'              => '<div class="wc-gzd-additional-desc">' . _x( 'Please select your default DPD shipping service for cross-border shipments that you want to offer to your customers (you can always change this within each individual shipment afterwards).', 'dpd', 'woocommerce-germanized-pro' ) . '</div>',
				'options'           => $select_dpd_product_int,
				'class'             => 'wc-enhanced-select',
			),

			array(
				'title'             => _x( 'Default Customs Terms', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'select',
				'default'           => self::get_default_customs_terms(),
				'id'                => 'label_default_customs_terms',
				'value'             => $this->get_setting( 'label_default_customs_terms', $this->get_default_customs_terms() ),
				'desc'              => _x( 'Please select your default customs terms.', 'dpd', 'woocommerce-germanized-pro' ),
				'desc_tip'          => true,
				'options'           => Package::get_api()->get_international_customs_terms(),
				'class'             => 'wc-enhanced-select',
			),

			array(
				'title'             => _x( 'Default Customs Paper', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'multiselect',
				'default'           => self::get_default_customs_paper(),
				'id'                => 'label_default_customs_paper',
				'value'             => $this->get_setting( 'label_default_customs_paper', $this->get_default_customs_paper() ),
				'desc'              => _x( 'Please select which documents you are attaching to international shipments.', 'dpd', 'woocommerce-germanized-pro' ),
				'desc_tip'          => true,
				'options'           => Package::get_api()->get_international_customs_paper(),
				'class'             => 'wc-enhanced-select',
			),

			array(
				'title' 	        => _x( 'Force email', 'dpd', 'woocommerce-germanized-pro' ),
				'desc' 		        => _x( 'Force transferring customer email to DPD.', 'dpd', 'woocommerce-germanized-pro' ) . '<div class="wc-gzd-additional-desc">' . sprintf( _x( 'By default the customer email address is only transferred in case explicit consent has been given via a checkbox during checkout. You may force to transfer the customer email address during label creation to make sure your customers receive email notifications by DPD. Make sure to check your privacy policy and seek advice by a lawyer in case of doubt.', 'dpd', 'woocommerce-germanized-pro' ) ) . '</div>',
				'id' 		        => 'label_force_email_transfer',
				'value'             => $this->get_setting( 'label_force_email_transfer', 'no' ),
				'default'	        => 'no',
				'allow_override'    => false,
				'type' 		        => 'gzd_toggle',
			),

			array( 'type' => 'sectionend', 'id' => 'shipping_provider_dpd_label_options' )
		);

		$settings = array_merge( $settings, parent::get_label_settings( $for_shipping_method ) );

		$settings = array_merge( $settings, array(

			array( 'title' => _x( 'Default Services', 'dpd', 'woocommerce-germanized-pro' ), 'allow_override' => true, 'type' => 'title', 'id' => 'dpd_label_default_services_options', 'desc' => sprintf( _x(  'Adjust services to be added to your labels by default.', 'dpd', 'woocommerce-germanized-pro' ) ) ),

			array(
				'title' 	        => _x( 'International Guarantee', 'dpd', 'woocommerce-germanized-pro' ),
				'desc' 		        => _x( 'Enable a guarantee for international shipments by default.', 'dpd', 'woocommerce-germanized-pro' ),
				'id' 		        => 'label_service_international_guarantee',
				'value'             => wc_bool_to_string( $this->get_setting( 'label_service_international_guarantee', 'no' ) ),
				'default'	        => 'no',
				'type' 		        => 'gzd_toggle',
			),

			array( 'type' => 'sectionend', 'id' => 'dpd_label_default_services_options' ),

			array( 'title' => _x( 'Printing', 'dpd', 'woocommerce-germanized-pro' ), 'type' => 'title', 'id' => 'dpd_print_options' ),

			array(
				'title'    => _x( 'Default Format', 'dpd', 'woocommerce-germanized-pro' ),
				'id'       => 'label_default_page_format',
				'class'    => 'wc-enhanced-select',
				'type'     => 'select',
				'value'    => $this->get_setting( 'label_default_page_format', $this->get_default_page_format() ),
				'options'  => $select_formats,
				'default'  => $this->get_default_page_format(),
			),

			array( 'type' => 'sectionend', 'id' => 'dpd_print_options' )
		) );

		return $settings;
	}

	public function get_help_link() {
		return 'https://vendidero.de/dokumentation/woocommerce-germanized/versanddienstleister';
	}

	public function get_signup_link() {
		return 'https://www.dpd.com/de/de/versenden/angebot-fuer-geschaeftskunden/';
	}
}
