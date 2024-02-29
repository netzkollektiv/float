<?php
/**
 * ShippingProvider impl.
 *
 * @package WooCommerce/Blocks
 */
namespace Vendidero\Germanized\DPD\ShippingProvider;

use Vendidero\Germanized\DPD\Package;
use Vendidero\Germanized\Shipments\Admin\Settings;
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

		return in_array( $label_type, $label_types, true );
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

	public function get_api_type( $context = 'view' ) {
		return $this->get_meta( 'api_type', true, $context );
	}

	public function set_api_username( $username ) {
		$this->update_meta_data( 'api_username', $username );
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

		$settings = array_merge(
			$settings,
			array(
				array(
					'id'          => 'page_format',
					'label'       => _x( 'Page Format', 'dpd', 'woocommerce-germanized-pro' ),
					'description' => '',
					'type'        => 'select',
					'options'     => Package::get_api()->get_page_formats(),
					'value'       => isset( $default_args['page_format'] ) ? $default_args['page_format'] : '',
				),
			)
		);

		if ( 'cloud' === $this->get_api_type() ) {
			$settings = array_merge(
				$settings,
				array(
					array(
						'id'          => 'pickup_date',
						'label'       => _x( 'Pickup date', 'dpd', 'woocommerce-germanized-pro' ),
						'description' => '',
						'type'        => 'date',
						'value'       => isset( $default_args['pickup_date'] ) ? $default_args['pickup_date'] : '',
					),
				)
			);
		}

		$services = array();

		if ( 'web_connect' === $this->get_api_type() ) {
			$services = array_merge(
				$services,
				array(
					array(
						'id'                => 'service_saturday_delivery',
						'label'             => _x( 'Saturday Delivery', 'dpd', 'woocommerce-germanized-pro' ),
						'description'       => '',
						'type'              => 'checkbox',
						'value'             => in_array( 'service_saturday_delivery', $default_args['services'], true ) ? 'yes' : 'no',
						'wrapper_class'     => 'form-field-checkbox',
						'custom_attributes' => array(
							'data-products-supported' => 'E12',
						),
					),
					array(
						'id'                => 'service_higher_insurance',
						'label'             => _x( 'Higher Insurance', 'dpd', 'woocommerce-germanized-pro' ),
						'description'       => '',
						'type'              => 'checkbox',
						'class'             => 'checkbox show-if-trigger',
						'value'             => in_array( 'service_higher_insurance', $default_args['services'], true ) ? 'yes' : 'no',
						'wrapper_class'     => 'form-field-checkbox',
						'custom_attributes' => array(
							'data-show-if' => '.show-if-higher_insurance',
						),
					),
					array(
						'id'    => '',
						'type'  => 'columns',
						'class' => 'show-if show-if-higher_insurance',
					),
					array(
						'id'    => 'higher_insurance_amount',
						'label' => _x( 'Amount', 'dpd', 'woocommerce-germanized-pro' ),
						'type'  => 'text',
						'class' => 'wc_input_decimal',
						'value' => wc_format_localized_decimal( $shipment->get_total() ),
					),
					array(
						'id'                => 'higher_insurance_description',
						'label'             => _x( 'Description', 'dpd', 'woocommerce-germanized-pro' ),
						'type'              => 'text',
						'value'             => '',
						'custom_attributes' => array(
							'maxlength' => 35,
						),
					),
					array(
						'id'   => '',
						'type' => 'columns_end',
					),
				)
			);

			if ( $shipment->is_shipping_international() ) {
				$terms = Package::get_api()->get_international_customs_terms();

				if ( 'GB' === $shipment->get_country() && $shipment->get_total() <= 135 ) {
					$terms = array_intersect_key( $terms, array( '07' => '' ) );
				}

				$settings = array_merge(
					$settings,
					array(
						array(
							'id'          => 'customs_terms',
							'label'       => _x( 'Customs terms', 'dpd', 'woocommerce-germanized-pro' ),
							'description' => '',
							'type'        => 'select',
							'options'     => $terms,
							'value'       => isset( $default_args['customs_terms'] ) ? $default_args['customs_terms'] : '',
						),
						array(
							'id'          => 'customs_paper',
							'label'       => _x( 'Customs paper', 'dpd', 'woocommerce-germanized-pro' ),
							'description' => '',
							'type'        => 'multiselect',
							'options'     => Package::get_api()->get_international_customs_paper(),
							'value'       => isset( $default_args['customs_paper'] ) ? $default_args['customs_paper'] : '',
						),
					)
				);

				$services = array_merge(
					$services,
					array(
						array(
							'id'            => 'service_international_guarantee',
							'label'         => _x( 'Guarantee', 'dpd', 'woocommerce-germanized-pro' ),
							'description'   => '',
							'type'          => 'checkbox',
							'value'         => in_array( 'service_international_guarantee', $default_args['services'], true ) ? 'yes' : 'no',
							'wrapper_class' => 'form-field-checkbox',
						),
					)
				);
			}
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
		return 'web_connect' === $this->get_api_type() ? 'A6' : 'PDF_A6';
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
		$args  = wp_parse_args( $args, 'return' === $shipment->get_type() ? $this->get_default_return_label_props( $shipment ) : $this->get_default_simple_label_props( $shipment ) );
		$error = new \WP_Error();

		if ( ! in_array( $args['page_format'], array_keys( Package::get_api()->get_page_formats() ), true ) ) {
			$error->add( 'page_format', _x( 'Please choose a valid page format.', 'dpd', 'woocommerce-germanized-pro' ) );
		}

		if ( 'web_connect' === $this->get_api_type() && $shipment->is_shipping_international() ) {
			if ( ! in_array( $args['customs_terms'], array_keys( Package::get_api()->get_international_customs_terms() ), true ) ) {
				$error->add( 'customs_terms', _x( 'Please choose a customs term.', 'dpd', 'woocommerce-germanized-pro' ) );
			}
		}

		if ( 'cloud' === $this->get_api_type() ) {
			if ( empty( $args['pickup_date'] ) || ! \Vendidero\Germanized\Shipments\Package::is_valid_datetime( $args['pickup_date'], 'Y-m-d' ) ) {
				$error->add( 500, _x( 'Error while parsing pickup date.', 'dpd', 'woocommerce-germanized-pro' ) );
			}
		}

		if (
			( $shipment->is_shipping_domestic() && ! in_array( $args['product_id'], array_keys( Package::get_api()->get_domestic_products( $shipment ) ), true ) ) ||
			( $shipment->is_shipping_inner_eu() && ! in_array( $args['product_id'], array_keys( Package::get_api()->get_eu_products( $shipment ) ), true ) ) ||
			( $shipment->is_shipping_international() && ! in_array( $args['product_id'], array_keys( Package::get_api()->get_international_products( $shipment ) ), true ) )
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

		if ( 'cloud' === $this->get_api_type() ) {
			if ( $pickup_date = Package::get_api()->get_next_available_pickup_date( $product_id ) ) {
				$defaults = array_merge(
					$defaults,
					array(
						'pickup_date' => $pickup_date->format( 'Y-m-d' ),
					)
				);
			}
		}

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
			'services'    => array(),
			'page_format' => $this->get_shipment_setting( $shipment, 'label_default_page_format', $this->get_default_page_format() ),
		);

		if ( 'web_connect' === $this->get_api_type() ) {
			$defaults = array_merge(
				$defaults,
				array(
					'customs_terms' => $this->get_shipment_setting( $shipment, 'label_default_customs_terms', $this->get_default_customs_terms() ),
					'customs_paper' => $this->get_shipment_setting( $shipment, 'label_default_customs_paper', $this->get_default_customs_paper() ),
				)
			);
		} elseif ( 'cloud' === $this->get_api_type() ) {
			if ( $pickup_date = Package::get_api()->get_next_available_pickup_date( $product_id ) ) {
				$defaults = array_merge(
					$defaults,
					array(
						'pickup_date' => $pickup_date->format( 'Y-m-d' ),
					)
				);
			}
		}

		return $defaults;
	}

	/**
	 * @param \Vendidero\Germanized\Shipments\Shipment $shipment
	 */
	public function get_available_label_products( $shipment ) {
		if ( $shipment->is_shipping_domestic() ) {
			return Package::get_api()->get_domestic_products( $shipment );
		} elseif ( $shipment->is_shipping_inner_eu() ) {
			return Package::get_api()->get_eu_products( $shipment );
		} else {
			$products = Package::get_api()->get_international_products( $shipment );

			return $products;
		}
	}

	/**
	 * @param \Vendidero\Germanized\Shipments\Shipment $shipment
	 */
	public function get_available_label_services( $shipment ) {
		$services = array(
			'higher_insurance',
		);

		if ( $shipment->is_shipping_international() ) {
			$services = array_merge(
				$services,
				array(
					'international_guarantee',
				)
			);
		} elseif ( $shipment->is_shipping_domestic() ) {
			$services = array_merge(
				$services,
				array(
					'saturday_delivery',
				)
			);
		}

		return $services;
	}

	protected function get_available_base_countries() {
		return Package::get_supported_countries();
	}

	protected function get_general_settings( $for_shipping_method = false ) {
		$settings = array(
			array(
				'title' => '',
				'type'  => 'title',
				'id'    => 'dpd_api_options',
			),

			array(
				'title'   => _x( 'API', 'dpd', 'woocommerce-germanized-pro' ),
				'type'    => 'select',
				'id'      => 'api_type',
				'default' => 'cloud',
				'value'   => $this->get_setting( 'api_type', 'cloud' ),
				'desc'    => '<div class="wc-gzd-additional-desc">' . sprintf( _x( 'DPD offers two different API\'s. Many DPD customers may only have access to the Cloud Webservice. <a href="%1$s">Learn more</a>', 'dpd', 'woocommerce-germanized-pro' ), 'https://vendidero.de/dokument/dpd-integration-einrichten#api-typen' ) . '</div>',
				'options' => array(
					'cloud'       => _x( 'Cloud Webservice', 'dpd', 'woocommerce-germanized-pro' ),
					'web_connect' => _x( 'WebConnect', 'dpd', 'woocommerce-germanized-pro' ),
				),
			),

			array(
				'title'             => _x( 'Username (Delis ID)', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'text',
				'desc'              => '<div class="wc-gzd-additional-desc">' . sprintf( _x( 'Please use your WebConnect username (Delis ID) and password to connect your shop to the <a href="%1$s">DPD WebConnect API</a>.', 'dpd', 'woocommerce-germanized-pro' ), 'https://vendidero.de/dokument/dpd-integration-einrichten#dpd-webconnect' ) . '</div>',
				'id'                => 'api_username',
				'default'           => '',
				'value'             => $this->get_setting( 'api_username', '' ),
				'custom_attributes' => array(
					'data-show_if_api_type' => 'web_connect',
					'autocomplete'          => 'new-password',
				),
			),

			array(
				'title'             => _x( 'Password', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'password',
				'desc'              => '',
				'id'                => 'api_password',
				'value'             => $this->get_setting( 'api_password', '' ),
				'custom_attributes' => array(
					'data-show_if_api_type' => 'web_connect',
					'autocomplete'          => 'new-password',
				),
			),

			array(
				'title'             => _x( 'Username (Cloud User ID)', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'text',
				'desc'              => '<div class="wc-gzd-additional-desc">' . sprintf( _x( 'Please use your Cloud User ID and password to connect your shop to the <a href="%1$s">DPD Cloud Webservice</a>.', 'dpd', 'woocommerce-germanized-pro' ), 'https://vendidero.de/dokument/dpd-integration-einrichten#dpd-cloud-webservice' ) . '</div>',
				'id'                => 'cloud_api_username',
				'default'           => '',
				'value'             => $this->get_setting( 'cloud_api_username', '' ),
				'custom_attributes' => array(
					'data-show_if_api_type' => 'cloud',
					'autocomplete'          => 'new-password',
				),
			),

			array(
				'title'             => _x( 'Password (Token)', 'dpd', 'woocommerce-germanized-pro' ),
				'type'              => 'password',
				'desc'              => '',
				'id'                => 'cloud_api_password',
				'value'             => $this->get_setting( 'cloud_api_password', '' ),
				'custom_attributes' => array(
					'data-show_if_api_type' => 'cloud',
					'autocomplete'          => 'new-password',
				),
			),

			array(
				'type' => 'sectionend',
				'id'   => 'dpd_api_options',
			),
		);

		$settings = array_merge(
			$settings,
			array(
				array(
					'title' => _x( 'Tracking', 'dpd', 'woocommerce-germanized-pro' ),
					'type'  => 'title',
					'id'    => 'tracking_options',
				),
			)
		);

		$general_settings = parent::get_general_settings( $for_shipping_method );

		return array_merge( $settings, $general_settings );
	}

	protected function get_label_settings( $for_shipping_method = false ) {
		$select_dpd_product_dom = Package::get_api()->get_domestic_products();
		$select_dpd_product_int = Package::get_api()->get_international_products();
		$select_dpd_product_eu  = Package::get_api()->get_eu_products();
		$select_formats         = Package::get_api()->get_page_formats();

		$settings = array(
			array(
				'title'          => '',
				'title_method'   => _x( 'Products', 'dpd', 'woocommerce-germanized-pro' ),
				'type'           => 'title',
				'id'             => 'shipping_provider_dpd_label_options',
				'allow_override' => true,
			),

			array(
				'title'   => _x( 'Domestic Default Service', 'dpd', 'woocommerce-germanized-pro' ),
				'type'    => 'select',
				'id'      => 'label_default_product_dom',
				'default' => 'CL',
				'value'   => $this->get_setting( 'label_default_product_dom', 'CL' ),
				'desc'    => '<div class="wc-gzd-additional-desc">' . _x( 'Please select your default DPD shipping service for domestic shipments that you want to offer to your customers (you can always change this within each individual shipment afterwards).', 'dpd', 'woocommerce-germanized-pro' ) . '</div>',
				'options' => $select_dpd_product_dom,
				'class'   => 'wc-enhanced-select',
			),

			array(
				'title'   => _x( 'EU Default Service', 'dpd', 'woocommerce-germanized-pro' ),
				'type'    => 'select',
				'default' => '',
				'value'   => $this->get_setting( 'label_default_product_eu', '' ),
				'id'      => 'label_default_product_eu',
				'desc'    => '<div class="wc-gzd-additional-desc">' . _x( 'Please select your default DPD shipping service for cross-border shipments that you want to offer to your customers (you can always change this within each individual shipment afterwards).', 'dpd', 'woocommerce-germanized-pro' ) . '</div>',
				'options' => $select_dpd_product_eu,
				'class'   => 'wc-enhanced-select',
			),

			array(
				'title'   => _x( 'Int. Default Service', 'dpd', 'woocommerce-germanized-pro' ),
				'type'    => 'select',
				'default' => '',
				'value'   => $this->get_setting( 'label_default_product_int', '' ),
				'id'      => 'label_default_product_int',
				'desc'    => '<div class="wc-gzd-additional-desc">' . _x( 'Please select your default DPD shipping service for cross-border shipments that you want to offer to your customers (you can always change this within each individual shipment afterwards).', 'dpd', 'woocommerce-germanized-pro' ) . '</div>',
				'options' => $select_dpd_product_int,
				'class'   => 'wc-enhanced-select',
			),
		);

		if ( 'web_connect' === $this->get_api_type() ) {
			$settings = array_merge(
				$settings,
				array(
					array(
						'title'    => _x( 'Default Customs Terms', 'dpd', 'woocommerce-germanized-pro' ),
						'type'     => 'select',
						'default'  => self::get_default_customs_terms(),
						'id'       => 'label_default_customs_terms',
						'value'    => $this->get_setting( 'label_default_customs_terms', $this->get_default_customs_terms() ),
						'desc'     => _x( 'Please select your default customs terms.', 'dpd', 'woocommerce-germanized-pro' ),
						'desc_tip' => true,
						'options'  => Package::get_api()->get_international_customs_terms(),
						'class'    => 'wc-enhanced-select',
					),

					array(
						'title'    => _x( 'Default Customs Paper', 'dpd', 'woocommerce-germanized-pro' ),
						'type'     => 'multiselect',
						'default'  => self::get_default_customs_paper(),
						'id'       => 'label_default_customs_paper',
						'value'    => $this->get_setting( 'label_default_customs_paper', $this->get_default_customs_paper() ),
						'desc'     => _x( 'Please select which documents you are attaching to international shipments.', 'dpd', 'woocommerce-germanized-pro' ),
						'desc_tip' => true,
						'options'  => Package::get_api()->get_international_customs_paper(),
						'class'    => 'wc-enhanced-select',
					),
				)
			);
		}

		$settings = array_merge(
			$settings,
			array(
				array(
					'title'          => _x( 'Force email', 'dpd', 'woocommerce-germanized-pro' ),
					'desc'           => _x( 'Force transferring customer email to DPD.', 'dpd', 'woocommerce-germanized-pro' ) . '<div class="wc-gzd-additional-desc">' . sprintf( _x( 'By default the customer email address is only transferred in case explicit consent has been given via a checkbox during checkout. You may force to transfer the customer email address during label creation to make sure your customers receive email notifications by DPD. Make sure to check your privacy policy and seek advice by a lawyer in case of doubt.', 'dpd', 'woocommerce-germanized-pro' ) ) . '</div>',
					'id'             => 'label_force_email_transfer',
					'value'          => $this->get_setting( 'label_force_email_transfer', 'no' ),
					'default'        => 'no',
					'allow_override' => false,
					'type'           => 'gzd_toggle',
				),

				array(
					'type' => 'sectionend',
					'id'   => 'shipping_provider_dpd_label_options',
				),
			)
		);

		$settings = array_merge( $settings, parent::get_label_settings( $for_shipping_method ) );

		if ( 'web_connect' === $this->get_api_type() ) {
			$settings = array_merge(
				$settings,
				array(
					array(
						'title'          => _x( 'Default Services', 'dpd', 'woocommerce-germanized-pro' ),
						'allow_override' => true,
						'type'           => 'title',
						'id'             => 'dpd_label_default_services_options',
						'desc'           => sprintf( _x( 'Adjust services to be added to your labels by default.', 'dpd', 'woocommerce-germanized-pro' ) ),
					),

					array(
						'title'   => _x( 'International Guarantee', 'dpd', 'woocommerce-germanized-pro' ),
						'desc'    => _x( 'Enable a guarantee for international shipments by default.', 'dpd', 'woocommerce-germanized-pro' ),
						'id'      => 'label_service_international_guarantee',
						'value'   => wc_bool_to_string( $this->get_setting( 'label_service_international_guarantee', 'no' ) ),
						'default' => 'no',
						'type'    => 'gzd_toggle',
					),

					array(
						'type' => 'sectionend',
						'id'   => 'dpd_label_default_services_options',
					),
				)
			);
		}

		$settings = array_merge(
			$settings,
			array(

				array(
					'title' => _x( 'Printing', 'dpd', 'woocommerce-germanized-pro' ),
					'type'  => 'title',
					'id'    => 'dpd_print_options',
				),

				array(
					'title'   => _x( 'Default Format', 'dpd', 'woocommerce-germanized-pro' ),
					'id'      => 'label_default_page_format',
					'class'   => 'wc-enhanced-select',
					'type'    => 'select',
					'value'   => $this->get_setting( 'label_default_page_format', $this->get_default_page_format() ),
					'options' => $select_formats,
					'default' => $this->get_default_page_format(),
				),

				array(
					'type' => 'sectionend',
					'id'   => 'dpd_print_options',
				),
			)
		);

		return $settings;
	}

	public function update_settings( $section = '', $data = null, $save = true ) {
		$settings_to_save       = Settings::get_sanitized_settings( $this->get_settings( $section ), $data );
		$restore_label_defaults = false;

		if ( isset( $settings_to_save['api_type'] ) && $settings_to_save['api_type'] !== $this->get_api_type( 'edit' ) ) {
			$restore_label_defaults = true;
		}

		/**
		 * Reset pickup details transient when username changes
		 */
		if ( isset( $settings_to_save['cloud_api_username'] ) && $settings_to_save['cloud_api_username'] !== $this->get_setting( 'cloud_api_username' ) ) {
			delete_transient( 'dpd_pickup_details' );
		}

		parent::update_settings( $section, $data, $save );

		/**
		 * In case the API type has changed, make sure to restore defaults to prevent setting mismatches.
		 */
		if ( $restore_label_defaults ) {
			foreach ( $this->get_label_settings() as $setting ) {
				$type    = isset( $setting['type'] ) ? $setting['type'] : 'title';
				$default = isset( $setting['default'] ) ? $setting['default'] : null;

				if ( in_array( $type, array( 'title', 'sectionend', 'html' ), true ) || ! isset( $setting['id'] ) || empty( $setting['id'] ) ) {
					continue;
				}

				$this->update_setting( $setting['id'], $default );
			}

			// Reset shipping method DPD options
			foreach ( \WC_Shipping_Zones::get_zones() as $zone ) {
				foreach ( $zone['shipping_methods'] as $method ) {
					$method->init_instance_settings();

					$instance_settings = $method->instance_settings;
					$did_unset         = false;

					foreach ( $instance_settings as $setting => $value ) {
						if ( 'dpd_' === substr( $setting, 0, 4 ) ) {
							unset( $instance_settings[ $setting ] );

							$did_unset = true;
						}
					}

					if ( $did_unset ) {
						update_option( $method->get_instance_option_key(), apply_filters( 'woocommerce_shipping_' . $method->id . '_instance_settings_values', $instance_settings, $method ), 'yes' );
					}
				}
			}
		}
	}

	public function get_help_link() {
		return 'https://vendidero.de/dokument/dpd-integration-einrichten';
	}

	public function get_signup_link() {
		return 'https://www.dpd.com/de/de/versenden/angebot-fuer-geschaeftskunden/';
	}
}
