<?php
/**
 * ShippingProvider impl.
 *
 * @package WooCommerce/Blocks
 */
namespace Vendidero\Germanized\GLS\ShippingProvider;

use Vendidero\Germanized\GLS\Package;
use Vendidero\Germanized\Shipments\Shipment;
use Vendidero\Germanized\Shipments\ShippingProvider\Auto;

defined( 'ABSPATH' ) || exit;

class GLS extends Auto {

	protected function get_default_label_minimum_shipment_weight() {
		return 0.01;
	}

	protected function get_default_label_default_shipment_weight() {
		return 0.5;
	}

	public function get_title( $context = 'view' ) {
		return _x( 'GLS', 'gls', 'woocommerce-germanized-pro' );
	}

	public function get_name( $context = 'view' ) {
		return 'gls';
	}

	public function get_description( $context = 'view' ) {
		return _x( 'Create GLS labels and return labels conveniently.', 'gls', 'woocommerce-germanized-pro' );
	}

	public function get_default_tracking_url_placeholder() {
		return 'https://gls-group.eu/track/{tracking_id}';
	}

	public function is_sandbox() {
		return Package::get_api()->is_sandbox();
	}

	public function get_label_classname( $type ) {
		if ( 'return' === $type ) {
			return '\Vendidero\Germanized\GLS\Label\Retoure';
		} else {
			return '\Vendidero\Germanized\GLS\Label\Simple';
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
		$default_args = $this->get_default_label_props( $shipment );
		$default      = $this->get_default_label_product( $shipment );
		$available    = $this->get_available_label_products( $shipment );
		$return_type  = $this->get_shipment_setting( $shipment, 'label_default_return_type' );
		$return_types = Package::get_return_types();

		$settings = array(
			array(
				'id'          => 'product_id',
				'label'       => sprintf( _x( '%s Product', 'shipments', 'woocommerce-germanized-shipments' ), $this->get_title() ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch
				'description' => '',
				'options'     => $this->get_available_label_products( $shipment ),
				'value'       => $default && array_key_exists( $default, $available ) ? $default : '',
				'type'        => 'select',
			),
			array(
				'id'      => 'return_type',
				'label'   => _x( 'Return type', 'gls', 'woocommerce-germanized-pro' ),
				'type'    => 'select',
				'options' => $return_types,
				'value'   => $return_type && array_key_exists( $return_type, $return_types ) ? $return_type : '',
			),
			array(
				'id'                => 'pickup_date',
				'label'             => _x( 'Pickup Date', 'gls', 'woocommerce-germanized-pro' ),
				'description'       => _x( 'Date when parcel should be picked up at customer.', 'gls', 'woocommerce-germanized-pro' ),
				'desc_tip'          => true,
				'type'              => 'date',
				'value'             => isset( $default_args['pickup_date'] ) ? $default_args['pickup_date'] : '',
				'custom_attributes' => array(
					'data-show-if-return_type' => 'pick_and_return',
				),
			),
		);

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
					'id'          => 'shipping_date',
					'label'       => _x( 'Shipping Date', 'gls', 'woocommerce-germanized-pro' ),
					'description' => _x( 'By default the next working day is used.', 'gls', 'woocommerce-germanized-pro' ),
					'desc_tip'    => true,
					'type'        => 'date',
					'value'       => isset( $default_args['shipping_date'] ) ? $default_args['shipping_date'] : '',
				),
			)
		);

		foreach ( Package::get_services() as $service => $service_data ) {
			$new_service = array(
				'id'                => 'service_' . $service,
				'label'             => $service_data['title'],
				'description'       => '',
				'type'              => 'checkbox',
				'value'             => in_array( $service, $default_args['services'], true ) ? 'yes' : 'no',
				'wrapper_class'     => 'form-field-checkbox',
				'custom_attributes' => array(
					'data-products-supported' => strtoupper( $service_data['product'] ),
				),
			);

			if ( ! empty( $service_data['fields'] ) ) {
				$new_service['class']                             = 'checkbox show-if-trigger';
				$new_service['custom_attributes']['data-show-if'] = '.show-if-' . $service;
			}

			$services[] = $new_service;

			if ( ! empty( $service_data['fields'] ) ) {
				$added_column_start = false;

				foreach ( $service_data['fields'] as $field ) {
					if ( ! is_null( $field['value_callback'] ) ) {
						continue;
					}

					$field_value = '';

					if ( ! is_null( $field['default_callback'] ) ) {
						$field_value = Package::get_callback_value( $shipment, $field['default_callback'], $field['formatting_callback'] );
					}

					if ( ! $added_column_start ) {
						$services[] = array(
							'id'    => '',
							'type'  => 'columns',
							'class' => 'show-if show-if-' . $service,
						);

						$added_column_start = true;
					}

					$new_field = array(
						'id'            => $service . '_' . $field['api_name'],
						'label'         => $field['label'],
						'description'   => $field['description'],
						'type'          => $field['type'],
						'class'         => $field['class'],
						'value'         => $field_value,
						'wrapper_class' => 'column col-6',
						'options'       => $field['options'],
					);

					$services[] = $new_field;
				}

				if ( $added_column_start ) {
					$services[] = array(
						'id'   => '',
						'type' => 'columns_end',
					);
				}
			}
		}

		if ( ! empty( $services ) ) {
			$settings[] = array(
				'type'         => 'services_start',
				'id'           => '',
				'hide_default' => ! empty( $default_args['services'] ) ? false : true,
			);

			$settings = array_merge( $settings, $services );
		}

		return $settings;
	}

	/**
	 * @param Shipment $shipment
	 * @param $props
	 *
	 * @return \WP_Error|mixed
	 */
	protected function validate_label_request( $shipment, $args = array() ) {
		if ( 'return' === $shipment->get_type() ) {
			$args = $this->validate_return_label_args( $shipment, $args );
		} else {
			$args = $this->validate_simple_label_args( $shipment, $args );
		}

		return $args;
	}

	/**
	 * @param Shipment $shipment
	 * @param $args
	 *
	 * @return \WP_Error|mixed
	 */
	protected function validate_return_label_args( $shipment, $args = array() ) {
		return $args;
	}

	/**
	 * @param Shipment $shipment
	 * @param $args
	 *
	 * @return \WP_Error|mixed
	 */
	protected function validate_simple_label_args( $shipment, $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'product_id'    => '',
				'shipping_date' => '',
				'services'      => array(),
			)
		);

		$error = new \WP_Error();

		if ( ! empty( $args['shipping_date'] ) && ! \Vendidero\Germanized\Shipments\Package::is_valid_datetime( $args['shipping_date'], 'Y-m-d' ) ) {
			$error->add( 500, _x( 'Error while parsing shipping date.', 'gls', 'woocommerce-germanized-pro' ) );
		}

		// Do only allow valid services
		if ( ! empty( $args['services'] ) ) {
			$args['services'] = array_intersect( $args['services'], $this->get_available_label_services( $shipment ) );
			$args['services'] = array_values( $args['services'] );
		}

		foreach ( $args['services'] as $service ) {
			$service_fields = Package::get_service_fields( $service );

			if ( ! empty( $service_fields ) ) {
				foreach ( $service_fields as $field ) {
					if ( ! is_null( $field['value_callback'] ) ) {
						continue;
					}

					$field_value = '';

					if ( ! is_null( $field['default_callback'] ) ) {
						$field_value = Package::get_callback_value( $shipment, $field['default_callback'], $field['formatting_callback'] );
					}

					if ( isset( $args[ $service . '_' . $field['api_name'] ] ) ) {
						$field_value = $args[ $service . '_' . $field['api_name'] ];
					}

					if ( '' === $field_value && true === $field['mandatory'] ) {
						$error->add( 500, sprintf( esc_html_x( 'Please supply a value for %1$s: %2$s.', 'gls', 'woocommerce-germanized-pro' ), esc_html( Package::get_service_title( $service ) ), esc_html( $field['label'] ) ) );

						$args['services'] = array_diff( $args['services'], array( $service ) );
					}
				}
			}
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
			$gls_defaults = $this->get_default_return_label_props( $shipment );
		} else {
			$gls_defaults = $this->get_default_simple_label_props( $shipment );
		}

		$defaults = parent::get_default_label_props( $shipment );
		$defaults = array_replace_recursive( $defaults, $gls_defaults );

		return $defaults;
	}

	/**
	 * @param Shipment $shipment
	 *
	 * @return array
	 */
	protected function get_default_return_label_props( $shipment ) {
		$product_id = $this->get_default_label_product( $shipment );

		$defaults = array(
			'services' => array(),
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
			'shipping_date' => '',
		);

		foreach ( Package::get_services() as $service_id => $service ) {
			if ( $product_id !== $service['product'] ) {
				continue;
			}

			if ( 'yes' === $this->get_shipment_setting( $shipment, 'label_service_' . $service_id ) ) {
				$defaults['services'][] = $service_id;
			}
		}

		return $defaults;
	}

	/**
	 * @param \Vendidero\Germanized\Shipments\Shipment $shipment
	 */
	public function get_available_label_products( $shipment ) {
		$is_return = $shipment->get_type() === 'return';

		if ( $shipment->is_shipping_domestic() ) {
			return Package::get_domestic_products( $is_return );
		} elseif ( $shipment->is_shipping_inner_eu() ) {
			return Package::get_eu_products( $is_return );
		} else {
			return Package::get_international_products( $is_return );
		}
	}

	/**
	 * @param \Vendidero\Germanized\Shipments\Shipment $shipment
	 */
	public function get_available_label_services( $shipment ) {
		return array_keys( Package::get_services() );
	}

	protected function get_available_base_countries() {
		return Package::get_supported_countries();
	}

	protected function get_general_settings( $for_shipping_method = false ) {
		$settings = array(
			array(
				'title' => '',
				'type'  => 'title',
				'id'    => 'gls_api_options',
			),

			array(
				'title'   => _x( 'Contact ID', 'gls', 'woocommerce-germanized-pro' ),
				'type'    => 'text',
				'desc'    => '<div class="wc-gzd-additional-desc">' . sprintf( _x( 'Enter your GLS ShipIt Contact ID here. You will receive this from your GLS contact person.', 'gls', 'woocommerce-germanized-pro' ) ) . '</div>',
				'id'      => 'api_contact_id',
				'default' => '',
				'value'   => $this->get_setting( 'api_contact_id', '' ),
			),

			array(
				'title'   => _x( 'API URL', 'gls', 'woocommerce-germanized-pro' ),
				'type'    => 'select',
				'options' => Package::get_available_api_urls(),
				'desc'    => '<div class="wc-gzd-additional-desc">' . sprintf( _x( 'API URL pointing to the GLS ShipIT backend.', 'gls', 'woocommerce-germanized-pro' ) ) . '</div>',
				'id'      => 'api_url',
				'default' => 'AT' === Package::get_base_country() ? 'at01' : 'de01',
				'value'   => $this->get_setting( 'api_url', '' ),
			),

			array(
				'title'             => _x( 'Username', 'gls', 'woocommerce-germanized-pro' ),
				'type'              => 'text',
				'id'                => 'api_username',
				'default'           => '',
				'value'             => $this->get_setting( 'api_username', '' ),
				'custom_attributes' => array(
					'autocomplete' => 'new-password',
				),
			),

			array(
				'title'             => _x( 'Password', 'gls', 'woocommerce-germanized-pro' ),
				'type'              => 'password',
				'desc'              => '',
				'id'                => 'api_password',
				'value'             => $this->get_setting( 'api_password', '' ),
				'custom_attributes' => array(
					'autocomplete' => 'new-password',
				),
			),

			array(
				'type' => 'sectionend',
				'id'   => 'gls_api_options',
			),
		);

		$settings = array_merge(
			$settings,
			array(
				array(
					'title' => _x( 'Tracking', 'gls', 'woocommerce-germanized-pro' ),
					'type'  => 'title',
					'id'    => 'tracking_options',
				),
			)
		);

		$general_settings = parent::get_general_settings( $for_shipping_method );

		return array_merge( $settings, $general_settings );
	}

	protected function get_label_settings( $for_shipping_method = false ) {
		$select_product_dom = Package::get_domestic_products();
		$select_product_int = Package::get_international_products();
		$select_product_eu  = Package::get_eu_products();
		$select_formats     = array();

		$settings = array(
			array(
				'title'          => '',
				'title_method'   => _x( 'Products', 'gls', 'woocommerce-germanized-pro' ),
				'type'           => 'title',
				'id'             => 'shipping_provider_gls_label_options',
				'allow_override' => true,
			),

			array(
				'title'   => _x( 'Domestic Default Service', 'gls', 'woocommerce-germanized-pro' ),
				'type'    => 'select',
				'id'      => 'label_default_product_dom',
				'default' => 'PARCEL',
				'value'   => $this->get_setting( 'label_default_product_dom', 'PARCEL' ),
				'desc'    => '<div class="wc-gzd-additional-desc">' . _x( 'Please select your default GLS shipping service for domestic shipments that you want to offer to your customers (you can always change this within each individual shipment afterwards).', 'gls', 'woocommerce-germanized-pro' ) . '</div>',
				'options' => $select_product_dom,
				'class'   => 'wc-enhanced-select',
			),

			array(
				'title'   => _x( 'EU Default Service', 'gls', 'woocommerce-germanized-pro' ),
				'type'    => 'select',
				'default' => '',
				'value'   => $this->get_setting( 'label_default_product_eu', '' ),
				'id'      => 'label_default_product_eu',
				'desc'    => '<div class="wc-gzd-additional-desc">' . _x( 'Please select your default GLS shipping service for cross-border shipments that you want to offer to your customers (you can always change this within each individual shipment afterwards).', 'gls', 'woocommerce-germanized-pro' ) . '</div>',
				'options' => $select_product_eu,
				'class'   => 'wc-enhanced-select',
			),

			array(
				'title'   => _x( 'Int. Default Service', 'gls', 'woocommerce-germanized-pro' ),
				'type'    => 'select',
				'default' => '',
				'value'   => $this->get_setting( 'label_default_product_int', '' ),
				'id'      => 'label_default_product_int',
				'desc'    => '<div class="wc-gzd-additional-desc">' . _x( 'Please select your default GLS shipping service for cross-border shipments that you want to offer to your customers (you can always change this within each individual shipment afterwards).', 'gls', 'woocommerce-germanized-pro' ) . '</div>',
				'options' => $select_product_int,
				'class'   => 'wc-enhanced-select',
			),

			array(
				'title'   => _x( 'Default return option', 'gls', 'woocommerce-germanized-pro' ),
				'type'    => 'select',
				'default' => '',
				'value'   => $this->get_setting( 'label_default_return_type', '' ),
				'id'      => 'label_default_return_type',
				'desc'    => '<div class="wc-gzd-additional-desc">' . _x( 'Please select your default GLS return option (you can always change this within each individual shipment afterwards).', 'gls', 'woocommerce-germanized-pro' ) . '</div>',
				'options' => Package::get_return_types(),
				'class'   => 'wc-enhanced-select',
			),
		);

		$settings = array_merge(
			$settings,
			array(
				array(
					'title'          => _x( 'Force email', 'gls', 'woocommerce-germanized-pro' ),
					'desc'           => _x( 'Force transferring customer email to GLS.', 'gls', 'woocommerce-germanized-pro' ) . '<div class="wc-gzd-additional-desc">' . sprintf( _x( 'By default the customer email address is only transferred in case explicit consent has been given via a checkbox during checkout. You may force to transfer the customer email address during label creation to make sure your customers receive email notifications by GLS. Make sure to check your privacy policy and seek advice by a lawyer in case of doubt.', 'gls', 'woocommerce-germanized-pro' ) ) . '</div>',
					'id'             => 'label_force_email_transfer',
					'value'          => $this->get_setting( 'label_force_email_transfer', 'no' ),
					'default'        => 'no',
					'allow_override' => false,
					'type'           => 'gzd_toggle',
				),

				array(
					'type' => 'sectionend',
					'id'   => 'shipping_provider_gls_label_options',
				),
			)
		);

		$settings = array_merge( $settings, parent::get_label_settings( $for_shipping_method ) );

		$settings = array_merge(
			$settings,
			array(
				array(
					'title'          => _x( 'Default Services', 'gls', 'woocommerce-germanized-pro' ),
					'allow_override' => true,
					'type'           => 'title',
					'id'             => 'gls_label_default_services_options',
					'desc'           => sprintf( _x( 'Adjust services to be added to your labels by default.', 'gls', 'woocommerce-germanized-pro' ) ),
				),
			)
		);

		foreach ( Package::get_services() as $service_id => $service ) {
			$settings = array_merge(
				$settings,
				array(
					array(
						'title'   => $service['title'],
						'desc'    => sprintf( _x( 'Enable the %s Service by default.', 'gls', 'woocommerce-germanized-pro' ), esc_html( $service['title'] ) ),
						'id'      => 'label_service_' . $service_id,
						'value'   => wc_bool_to_string( $this->get_setting( 'label_service_' . $service_id, 'no' ) ),
						'default' => 'no',
						'type'    => 'gzd_toggle',
					),
				)
			);
		}

		$settings = array_merge(
			$settings,
			array(
				array(
					'type' => 'sectionend',
					'id'   => 'gls_label_default_services_options',
				),
			)
		);

		return $settings;
	}

	public function get_help_link() {
		return 'https://vendidero.de/dokument/gls-integration-einrichten';
	}

	public function get_signup_link() {
		return 'https://www.gls-pakete.de/geschaeftlich-versenden/geschaeftskunde-werden';
	}
}
