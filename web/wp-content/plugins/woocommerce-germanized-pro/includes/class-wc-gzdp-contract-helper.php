<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WC_GZDP_Contract_Helper {

	protected static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_filter( 'woocommerce_email_classes', array( $this, 'add_emails' ), 30 );

		// Add order confirmation meta
		add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'set_order_confirmation_needed' ), 0, 1 );
		add_action( 'woocommerce_before_order_object_save', array( $this, 'set_order_confirmation_needed_3' ), 10, 2 );

		add_filter( 'woocommerce_before_order_object_save', array( $this, 'set_default_order_status' ), 20 );

		// Hide Payment info
		add_action( 'woocommerce_before_template_part', array( $this, 'hide_payment_info' ), 0, 4 );

		// Add Payment link to thankyou page
		add_action( 'woocommerce_before_template_part', array( $this, 'add_payment_link' ), 1, 4 );

		// Remove Payment Method redirect on Checkout
		add_action( 'woocommerce_checkout_order_processed', array( $this, 'maybe_remove_gateway_redirect' ) );
		add_action( 'woocommerce_store_api_checkout_order_processed', array( $this, 'maybe_remove_block_gateway_redirect' ) );

		// This removes Germanized Information (e.g. delivery time etc. as well)
		add_action( 'woocommerce_email_order_details', array( $this, 'remove_email_payment_instructions' ), 0, 4 );

		add_filter( 'woocommerce_gzd_order_confirmation_email_default_text', array( $this, 'order_confirmation_default_text' ), 10, 1 );

		add_filter( 'woocommerce_gzd_show_order_pay_now_button', array( $this, 'show_or_hide_pay_now_button' ), 10, 2 );

		add_filter( 'woocommerce_gzd_is_order_confirmation_email', array( $this, 'register_order_confirmation' ), 10, 2 );

		add_filter( 'woocommerce_gzd_add_force_pay_order_parameter', '__return_true', 10 );

		$this->prevent_transactional_emails();
		$this->admin_hooks();

		add_action( 'woocommerce_before_calculate_totals', array( $this, 'remove_gateway_filter' ), 0 );
		add_action( 'woocommerce_after_calculate_totals', array( $this, 'add_gateway_filter' ), 10000 );
		add_filter( 'woocommerce_available_payment_gateways', array( $this, 'gateway_filter' ), 10000 );
		add_filter( 'woocommerce_payment_gateways', array( $this, 'maybe_register_placeholder_gateways' ), 10000 );

		// Remove placeholder gateway
		add_action( 'woocommerce_checkout_create_order', array( $this, 'remove_gateway_placeholder' ), 0 );
		add_action( 'woocommerce_store_api_checkout_order_processed', array( $this, 'remove_gateway_placeholder' ), 0 );

		// Prevent Woo from marking non-
		add_filter( 'woocommerce_valid_order_statuses_for_payment_complete', array( $this, 'maybe_prevent_payment_complete' ), 10, 2 );

		add_action( 'woocommerce_blocks_payment_method_type_registration', array( $this, 'register_gateway_placeholders' ), 10000 );
	}

	/**
	 * @param \Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry $payment_method_registry
	 *
	 * @return void
	 */
	public function register_gateway_placeholders( $payment_method_registry ) {
		foreach ( $payment_method_registry->get_all_registered() as $gateway ) {
			if ( $this->gateway_needs_placeholder( $gateway->get_name() ) ) {
				if ( \Vendidero\Germanized\Pro\Package::load_blocks() ) {
					$assets = \Vendidero\Germanized\Pro\Package::container()->get( \Vendidero\Germanized\Pro\Blocks\Assets::class );

					/**
					 * Mollie register only one pseudo gateway which bundles all the actual gateways.
					 * As for now there is no other way but use the original available gateways as placeholders.
					 */
					if ( is_a( $gateway, 'Mollie\WooCommerce\Assets\MollieCheckoutBlocksSupport' ) ) {
						$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();

						foreach ( $available_gateways as $key => $t_gateway ) {
							if ( strstr( $key, 'mollie_wc_gateway_' ) ) {
								$placeholder = new \Vendidero\Germanized\Pro\Contract\GatewayBlockPlaceholder( $t_gateway, $assets );
								$payment_method_registry->register( $placeholder );
							}
						}
					} else {
						$placeholder = new \Vendidero\Germanized\Pro\Contract\GatewayBlockPlaceholder( $gateway, $assets );
						$payment_method_registry->register( $placeholder );
					}
				}
			}
		}
	}

	/**
	 * This filter prevents Woo from marking orders as being paid in case the payment method
	 * is a placeholder still.
	 *
	 * @param $statuses
	 * @param WC_Order $order
	 *
	 * @return array
	 */
	public function maybe_prevent_payment_complete( $statuses, $order ) {
		if ( wc_gzdp_order_needs_confirmation( $order ) && $this->gateway_needs_placeholder( $order->get_payment_method() ) ) {
			$statuses = array();
			remove_all_actions( 'woocommerce_payment_complete_order_status_' . $order->get_status() );
		}

		return $statuses;
	}

	/**
	 * @param WC_Order $order
	 *
	 * @return void
	 */
	public function remove_gateway_placeholder( $order ) {
		if ( ! $order ) {
			return;
		}

		if ( $this->payment_method_is_placeholder( $order->get_payment_method() ) ) {
			$order->set_payment_method( str_replace( 'placeholder_', '', $order->get_payment_method() ) );
		}
	}

	protected function payment_method_is_placeholder( $method ) {
		return 'placeholder_' === substr( $method, 0, 12 );
	}

	public function remove_gateway_filter() {
		if ( $this->is_checkout() ) {
			if ( WC()->session && WC()->session->get( 'chosen_payment_method' ) ) {
				if ( $this->payment_method_is_placeholder( WC()->session->get( 'chosen_payment_method' ) ) ) {
					WC()->session->set( 'chosen_payment_method', substr( WC()->session->get( 'chosen_payment_method' ), 12 ) );
				}
			}
		}

		remove_filter( 'woocommerce_available_payment_gateways', array( $this, 'gateway_filter' ), 10000 );
	}

	protected function is_checkout() {
		return ( is_checkout() || has_block( 'woocommerce/checkout' ) || WC()->is_rest_api_request() ) && ! is_checkout_pay_page();
	}

	public function add_gateway_filter() {
		if ( $this->is_checkout() ) {
			if ( WC()->session && WC()->session->get( 'chosen_payment_method' ) ) {
				$gateway = WC()->session->get( 'chosen_payment_method' );

				if ( ! empty( $gateway ) && $this->gateway_needs_placeholder( $gateway ) ) {
					WC()->session->set( 'chosen_payment_method', 'placeholder_' . WC()->session->get( 'chosen_payment_method' ) );
				}
			}
		}

		add_filter( 'woocommerce_available_payment_gateways', array( $this, 'gateway_filter' ), 10000 );
	}

	protected function gateway_needs_placeholder( $method ) {
		$needs_placeholder = true;
		$whitelist         = array(
			'bacs',
			'cod',
			'invoice',
			'direct-debit',
			'cheque',
		);

		if ( in_array( $method, $whitelist, true ) ) {
			$needs_placeholder = false;
		}

		return apply_filters( 'woocommerce_gzdp_manual_contract_gateway_needs_placeholder', $needs_placeholder, $method, $this );
	}

	/**
	 * The checkout route uses WC_Payment_Gateways::get_payment_method_ids() to validate
	 * whether the payment method is available or not. This will not allow us to only
	 * filter the available gateway. Instead we need to add a tweak to register our placeholder
	 * methods on load.
	 *
	 * @param $load_gateways
	 *
	 * @return mixed
	 */
	public function maybe_register_placeholder_gateways( $load_gateways ) {
		if ( WC()->is_rest_api_request() ) {
			foreach ( $load_gateways as $gateway ) {
				if ( is_string( $gateway ) && class_exists( $gateway ) ) {
					$gateway = new $gateway();
				}

				// Gateways need to be valid and extend WC_Payment_Gateway.
				if ( ! is_a( $gateway, 'WC_Payment_Gateway' ) ) {
					continue;
				}

				if ( $this->gateway_needs_placeholder( $gateway->id ) ) {
					$load_gateways[ 'placeholder_' . $gateway->id ] = new \Vendidero\Germanized\Pro\Contract\GatewayPlaceholder( $gateway );
				}
			}
		}

		return $load_gateways;
	}

	public function gateway_filter( $available_gateways ) {
		if ( $this->is_checkout() ) {
			$placeholders = array();

			foreach ( $available_gateways as $method => $available_gateway ) {
				if ( $this->gateway_needs_placeholder( $method ) ) {
					$placeholder                              = new \Vendidero\Germanized\Pro\Contract\GatewayPlaceholder( $available_gateway );
					$placeholders[ 'placeholder_' . $method ] = $placeholder;
				} else {
					$placeholders[ $method ] = $available_gateway;
				}
			}

			return $placeholders;
		}

		return $available_gateways;
	}

	public function register_order_confirmation( $is_confirmation, $email_id ) {
		if ( 'customer_order_confirmation' === $email_id ) {
			$is_confirmation = true;
		}

		return $is_confirmation;
	}

	private function prevent_transactional_emails() {
		// Prevent transactional emails for confirmed orders
		$statuses = array( 'processing', 'pending', 'on-hold' );

		foreach ( $statuses as $status ) {
			add_action( 'woocommerce_order_status_' . $status, array( $this, 'unhook_transactional_emails_confirmed' ), 5, 1 );
		}

		// Prevent transactional emails for unconfirmed orders
		$statuses = array( 'confirmed' );

		foreach ( $statuses as $status ) {
			add_action( 'woocommerce_order_status_' . $status, array( $this, 'unhook_transactional_emails_unconfirmed' ), 10, 1 );
		}
	}

	public function remove_email_payment_instructions( $order, $sent_to_admin, $plain_text, $email ) {
		if ( 'customer_processing_order' === $email->id && wc_gzdp_order_needs_confirmation( $order->get_id() ) ) {
			$gateways = WC()->payment_gateways()->payment_gateways();
			$gateway  = $order->get_payment_method();

			if ( isset( $gateways[ $gateway ] ) ) {
				remove_action( 'woocommerce_email_before_order_table', array( $gateways[ $gateway ], 'email_instructions' ), 10 );

				$gateway_polylang_links = array(
					'bacs'   => 'Hyyan\WPI\Gateways\GatewayBACS',
					'cod'    => 'Hyyan\WPI\Gateways\GatewayCOD',
					'cheque' => 'Hyyan\WPI\Gateways\GatewayCheque',
				);

				if ( isset( $gateway_polylang_links[ $gateway ] ) ) {
					// Polylang Custom Gateway Filter
					wc_gzdp_remove_class_action( 'woocommerce_email_before_order_table', $gateway_polylang_links[ $gateway ], 'email_instructions', 10 );
				}
			}
		}
	}

	public function admin_hooks() {
		// Add Confirm Button to admin
		add_action( 'woocommerce_admin_order_data_after_shipping_address', array( $this, 'admin_order_confirm_button' ), 100, 1 );
		// Admin Column Indicator
		add_action( 'manage_shop_order_posts_custom_column', array( $this, 'admin_order_table_title' ), 3 );
		// Admin Column action
		add_filter( 'woocommerce_admin_order_actions', array( $this, 'admin_order_actions' ), 1500, 2 );
		// Order email actions
		add_filter( 'woocommerce_resend_order_emails_available', array( $this, 'admin_resend_order_emails' ), 1500 );

		// Woo 3.X email resending
		add_filter( 'woocommerce_order_actions', array( $this, 'order_email_actions' ), 10, 1 );
		add_action( 'woocommerce_order_action_order_acceptance', array( $this, 'resend_order_acceptance' ), 10, 1 );

		add_action( 'admin_init', array( $this, 'set_gzd_confirmation_text_hook' ), 20 );

		add_action( 'woocommerce_email_settings_after', array( $this, 'confirmation_text_options' ), 10, 1 );
		add_action( 'woocommerce_update_options_email_customer_processing_order', array( $this, 'save_confirmation_text_option' ), 5 );
		add_action( 'woocommerce_update_options_email_customer_order_confirmation', array( $this, 'save_confirmation_text_option' ), 5 );
	}

	public function set_gzd_confirmation_text_hook() {
		wc_gzdp_remove_class_action( 'woocommerce_email_settings_after', 'WC_GZD_Emails', 'confirmation_text_option', 10 );
	}

	public function show_or_hide_pay_now_button( $show_or_hide, $order_id ) {
		if ( wc_gzdp_order_needs_confirmation( $order_id ) ) {
			return false;
		} else {
			if ( $order = wc_get_order( $order_id ) ) {
				if ( $order->needs_payment() ) {
					return true;
				}
			}
		}

		return $show_or_hide;
	}

	public function save_confirmation_text_option() {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			return;
		}

		if ( isset( $_POST['woocommerce_gzd_email_order_confirmation_text'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_option( 'woocommerce_gzd_email_order_confirmation_text', wp_filter_post_kses( trim( wp_unslash( $_POST['woocommerce_gzd_email_order_confirmation_text'] ) ) ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		} elseif ( isset( $_POST['woocommerce_gzdp_contract_helper_email_order_processing_text'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_option( 'woocommerce_gzdp_contract_helper_email_order_processing_text', wp_filter_post_kses( trim( wp_unslash( $_POST['woocommerce_gzdp_contract_helper_email_order_processing_text'] ) ) ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		}
	}

	public function confirmation_text_options( $object ) {
		if ( 'customer_order_confirmation' === $object->id ) {
			$args = apply_filters(
				'woocommerce_gzd_admin_email_order_confirmation_text_option',
				array(
					'id'                => 'woocommerce_gzd_email_order_confirmation_text',
					'label'             => __( 'Confirmation text', 'woocommerce-germanized-pro' ),
					'placeholder'       => __( 'Your order has been processed. We are glad to confirm the order to you. Your order details are shown below for your reference.', 'woocommerce-germanized-pro' ),
					'desc'              => __( 'This text will be inserted within the order confirmation email. Use {order_number}, {site_title} or {order_date} as placeholder.', 'woocommerce-germanized-pro' ),
					'value'             => get_option( 'woocommerce_gzd_email_order_confirmation_text' ),
					'custom_attributes' => array(),
				)
			);

			include_once WC_GERMANIZED_PRO_ABSPATH . 'includes/admin/views/html-admin-email-text-option.php';
		} elseif ( 'customer_processing_order' === $object->id ) {
			$args = apply_filters(
				'woocommerce_gzd_admin_email_order_confirmation_text_option',
				array(
					'id'                => 'woocommerce_gzdp_contract_helper_email_order_processing_text',
					'label'             => __( 'Processing text', 'woocommerce-germanized-pro' ),
					'placeholder'       => __( 'Thank you for your order. We will now manually check your order and send you another email as soon as your order has been confirmed.', 'woocommerce-germanized-pro' ),
					'desc'              => __( 'This text will be inserted within the order processing email. Use {order_number}, {site_title} or {order_date} as placeholder.', 'woocommerce-germanized-pro' ),
					'value'             => get_option( 'woocommerce_gzdp_contract_helper_email_order_processing_text' ),
					'custom_attributes' => array(),
				)
			);

			include_once WC_GERMANIZED_PRO_ABSPATH . 'includes/admin/views/html-admin-email-text-option.php';
		}
	}

	public function order_confirmation_default_text( $default ) {
		return __( 'Your order has been processed. We are glad to confirm the order to you. Your order details are shown below for your reference.', 'woocommerce-germanized-pro' );
	}

	public function get_processing_order_email_text( $order_id ) {
		$order = is_numeric( $order_id ) ? wc_get_order( $order_id ) : $order_id;
		$plain = apply_filters( 'woocommerce_gzdp_order_processing_email_plain_text', get_option( 'woocommerce_gzdp_contract_helper_email_order_processing_text' ) );

		if ( ! $plain || '' === $plain ) {
			$plain = __( 'Thank you for your order. We will now manually check your order and send you another email as soon as your order has been confirmed.', 'woocommerce-germanized-pro' );
		}

		$placeholders = array(
			'{site_title}'   => wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ),
			'{order_number}' => $order->get_order_number(),
			'{order_date}'   => wc_gzd_get_order_date( $order ),
		);

		foreach ( $placeholders as $placeholder => $value ) {
			$plain = str_replace( $placeholder, $value, $plain );
		}

		return apply_filters( 'woocommerce_gzdp_order_processing_email_text', $plain, $order );
	}

	public function order_email_actions( $actions ) {
		global $theorder, $post;

		// This is used by some callbacks attached to hooks such as woocommerce_order_actions which rely on the global to determine if actions should be displayed for certain orders.
		if ( ! is_object( $theorder ) ) {
			$theorder = wc_get_order( $post->ID );
		}

		if ( ! wc_gzdp_order_needs_confirmation( $theorder->get_id() ) ) {
			$actions['order_acceptance'] = __( 'Resend order acceptance', 'woocommerce-germanized-pro' );
		}

		return $actions;
	}

	public function resend_order_acceptance( $order ) {
		do_action( 'woocommerce_before_resend_order_emails', $order, 'customer_order_confirmation' );

		// Send the customer invoice email.
		WC()->payment_gateways();
		WC()->shipping();

		$mail = WC_germanized()->emails->get_email_instance_by_id( 'customer_order_confirmation' );

		if ( $mail ) {
			$mail->trigger( $order );

			// Note the event.
			$order->add_order_note( __( 'Order accpetance manually sent to customer.', 'woocommerce-germanized-pro' ), false, true );
			do_action( 'woocommerce_germanized_pro_after_resend_order_acceptance_email', $order, 'customer_order_confirmation' );
		}

		do_action( 'woocommerce_after_resend_order_email', $order, 'customer_order_confirmation' );
	}

	public function set_order_confirmation_needed_3( $order, $data_store ) {
		/**
		 * Target new orders only.
		 */
		if ( $order->get_id() <= 0 ) {
			$order->update_meta_data( '_order_needs_confirmation', true );
		}
	}

	public function set_order_confirmation_needed( $order_id ) {
		$order = wc_get_order( $order_id );
		$order->update_meta_data( '_order_needs_confirmation', true );
		$order->save();
	}

	public function unhook_transactional_emails_confirmed( $order_id ) {
		if ( ! wc_gzdp_order_needs_confirmation( $order_id ) ) {
			$hooks = array(
				'woocommerce_order_status_pending_to_processing',
				'woocommerce_order_status_pending_to_completed',
				'woocommerce_order_status_pending_to_on-hold',
				'woocommerce_order_status_on-hold_to_processing',
				'woocommerce_order_status_on-hold_to_completed',
			);

			$emails = array(
				'WC_Email_Customer_Processing_Order',
				'WC_GZDP_Email_Customer_Order_Confirmation',
			);

			// Make sure emails are initted and events are hooked
			WC()->mailer()->emails;

			foreach ( $emails as $email ) {
				foreach ( $hooks as $hook ) {
					wc_gzdp_remove_class_action( $hook . '_notification', $email, 'trigger', 10 );
				}
			}

			// If emails are being deferred
			foreach ( $hooks as $hook ) {
				remove_action( $hook, array( 'WC_Emails', 'queue_transactional_email' ) );
			}
		}
	}

	public function unhook_transactional_emails_unconfirmed( $order_id ) {
		if ( wc_gzdp_order_needs_confirmation( $order_id ) ) {

			$hooks = array(
				'woocommerce_order_status_completed',
			);

			$emails = array(
				'WC_Email_Customer_Processing_Order',
				'WC_GZDP_Email_Customer_Order_Confirmation',
			);

			// Make sure emails are initted and events are hooked
			WC()->mailer()->emails;

			foreach ( $emails as $email ) {
				foreach ( $hooks as $hook ) {
					wc_gzdp_remove_class_action( $hook . '_notification', $email, 'trigger', 10 );
				}
			}

			// If emails are being deferred
			foreach ( $hooks as $hook ) {
				remove_action( $hook, array( 'WC_Emails', 'queue_transactional_email' ) );
			}
		}
	}

	public function unhook_transactional_emails( $order_id ) {

		$hooks = array(
			'woocommerce_order_status_pending_to_processing',
			'woocommerce_order_status_pending_to_completed',
			'woocommerce_order_status_pending_to_cancelled',
			'woocommerce_order_status_pending_to_failed',
			'woocommerce_order_status_pending_to_on-hold',
			'woocommerce_order_status_failed_to_processing',
			'woocommerce_order_status_failed_to_completed',
			'woocommerce_order_status_failed_to_on-hold',
			'woocommerce_order_status_on-hold_to_processing',
			'woocommerce_order_status_on-hold_to_cancelled',
			'woocommerce_order_status_on-hold_to_failed',
			'woocommerce_order_status_completed',
		);

		foreach ( $hooks as $hook ) {
			remove_action( $hook, array( 'WC_Emails', 'queue_transactional_email' ) );
			remove_action( $hook, array( 'WC_Emails', 'send_transactional_email' ) );
			remove_all_actions( $hook . '_notification' );
		}
	}

	public function confirm_order( $order_id ) {
		$order = wc_get_order( $order_id );

		if ( ! wc_gzdp_order_needs_confirmation( $order_id ) ) {
			return false;
		}

		do_action( 'woocommerce_gzdp_before_order_confirm', $order_id );

		$default_status = apply_filters( 'woocommerce_default_order_status', 'pending' );
		$default_status = apply_filters( 'woocommerce_gzdp_order_confirmed_default_status', $default_status, $order_id );

		// Init mailer to remove actions
		$mailer = WC()->mailer();
		$mails  = $mailer->get_emails();

		// Do now allow sending transactional emails
		$statuses = wc_get_order_statuses();

		foreach ( $statuses as $status => $title ) {
			$status = str_replace( 'wc-', '', $status );
			add_action( 'woocommerce_order_status_' . $status, array( $this, 'unhook_transactional_emails' ), 10, 1 );
		}

		// Make sure that stock is not being increased
		remove_action( 'woocommerce_order_status_cancelled', 'wc_maybe_increase_stock_levels' );
		remove_action( 'woocommerce_order_status_pending', 'wc_maybe_increase_stock_levels' );

		// Update to default
		$order->update_status( $default_status );

		// Fallback to ensure no fatal errors while trying to empty cart
		if ( null === WC()->cart ) {
			WC()->cart = new WC_Cart();
		}

		$gateways = WC()->payment_gateways()->payment_gateways();
		$result   = false;

		add_filter( 'woocommerce_can_reduce_order_stock', array( $this, 'maybe_disallow_stock_reducing' ), 10, 2 );
		add_action( 'woocommerce_before_order_object_save', array( $this, 'maybe_prevent_failed_order_status' ), 10, 1 );

		if ( $order->needs_payment() && isset( $gateways[ $order->get_payment_method() ] ) ) {
			$gateway = $gateways[ $order->get_payment_method() ];

			if ( is_object( $gateway ) ) {
				// Stop output
				ob_start();
				try {
					$result = $gateway->process_payment( $order_id );
				} catch ( Exception $e ) {
					$result = false;
				}
				ob_end_clean();
			}

			if ( function_exists( 'wc_clear_notices' ) ) {
				wc_clear_notices();
			}

			// Retrieve a fresh copy as the gateway may adjust the order.
			$order = wc_get_order( $order_id );

			if ( ! $order ) {
				return false;
			}

			if ( isset( $result['result'] ) && 'failure' === $result['result'] ) {
				// Update to default to allow receiving (manual) payments
				$order->update_status( $default_status );
			}
		}

		remove_filter( 'woocommerce_can_reduce_order_stock', array( $this, 'maybe_disallow_stock_reducing' ), 10 );
		remove_action( 'woocommerce_before_order_object_save', array( $this, 'maybe_prevent_failed_order_status' ), 10 );

		// Trigger Mail
		if ( $mail = WC_germanized()->emails->get_email_instance_by_id( 'customer_order_confirmation' ) ) {
			/**
			 * Mark the order as being confirmed
			 */
			$order->delete_meta_data( '_order_needs_confirmation' );
			$order->save();

			$mail->trigger( $order_id );

			do_action( 'woocommerce_gzdp_order_confirmed', $order, $order_id );
		}

		if ( function_exists( 'wc_maybe_increase_stock_levels' ) ) {
			// Readd stock hooks
			add_action( 'woocommerce_order_status_cancelled', 'wc_maybe_increase_stock_levels' );
			add_action( 'woocommerce_order_status_pending', 'wc_maybe_increase_stock_levels' );
		}

		return true;
	}

	/**
	 * @param WC_Order $order
	 */
	public function maybe_prevent_failed_order_status( $order ) {
		if ( $order->has_status( 'failed' ) ) {
			$default_status = apply_filters( 'woocommerce_default_order_status', 'pending' );

			$order->set_status( $default_status );
		}
	}

	/**
	 * @param $is_allowed
	 * @param WC_Order $order
	 *
	 * @return bool
	 */
	public function maybe_disallow_stock_reducing( $is_allowed, $order ) {
		if ( ! $order->get_meta( '_order_stock_reduced', true ) ) {
			return $is_allowed;
		}

		return false;
	}

	/**
	 * @param WC_Order $order
	 *
	 * @return void
	 */
	public function maybe_remove_block_gateway_redirect( $order ) {
		if ( apply_filters( 'woocommerce_gzdp_exclude_order_from_pre_payment_processing', true, $order->get_id(), $order ) ) {
			if ( ! $this->payment_method_is_placeholder( $order->get_payment_method() ) ) {
				add_filter(
					'woocommerce_before_order_object_save',
					function( $order ) {
						$order->set_status( 'on-hold' );
					}
				);
				add_filter( 'woocommerce_order_needs_payment', array( $this, 'needs_payment_filter' ), 1000 );
				add_filter( 'woocommerce_valid_order_statuses_for_payment_complete', array( $this, 'stop_payment_completion' ), 1500 );
			}
		}
	}

	public function maybe_remove_gateway_redirect( $order_id ) {
		$order = wc_get_order( $order_id );

		if ( $order && apply_filters( 'woocommerce_gzdp_exclude_order_from_pre_payment_processing', true, $order_id, $order ) ) {
			if ( ! $this->payment_method_is_placeholder( $order->get_payment_method() ) ) {
				add_filter( 'woocommerce_cart_needs_payment', array( $this, 'needs_payment_filter' ) );
				add_filter( 'woocommerce_valid_order_statuses_for_payment_complete', array( $this, 'stop_payment_completion' ), 1500 );
			}
		}
	}

	public function show_payment_link( $order_id ) {
		WC_GZD_Checkout::instance()->add_payment_link( $order_id );
	}

	public function stop_payment_completion( $statuses ) {
		return array();
	}

	public function needs_payment_filter() {
		return false;
	}

	public function add_payment_link( $template_name, $template_path, $located, $args ) {
		if ( 'checkout/thankyou.php' !== $template_name ) {
			return;
		}

		remove_action( 'woocommerce_thankyou', 'woocommerce_gzd_template_order_pay_now_button', wc_gzd_get_hook_priority( 'order_pay_now_button' ) );

		$show = false;

		if ( isset( $args['order'] ) ) {
			$order = $args['order'];

			if ( $order && ( ! wc_gzdp_order_needs_confirmation( $order ) && $order->needs_payment() ) ) {
				$show = true;
			}
		}

		if ( $show ) {
			add_action( 'woocommerce_thankyou_' . $order->get_payment_method(), array( $this, 'show_payment_link' ), 10, 1 );
		}
	}

	public function hide_payment_info( $template_name, $template_path, $located, $args ) {
		if ( 'checkout/thankyou.php' !== $template_name ) {
			return;
		}

		$hide_info = false;

		if ( isset( $args['order'] ) ) {
			$order = $args['order'];

			if ( ! $order ) {
				$hide_info = true;
			}

			if ( $order && wc_gzdp_order_needs_confirmation( $order ) ) {
				$hide_info = true;
			}
		}

		if ( $hide_info ) {

			foreach ( WC()->payment_gateways()->payment_gateways() as $key => $method ) {
				remove_all_actions( 'woocommerce_thankyou_' . $key );
			}

			remove_all_filters( 'woocommerce_thankyou_order_received_text' );
		}
	}

	/**
	 * @param WC_Order $order
	 */
	public function set_default_order_status( $order ) {
		// Default order status
		add_filter(
			'woocommerce_default_order_status',
			function( $default_status ) use ( $order ) {
				if ( wc_gzdp_order_needs_confirmation( $order ) && apply_filters( 'woocommerce_gzdp_exclude_order_from_pre_payment_processing', true, $order->get_id(), $order ) ) {
					$default_status = 'on-hold';
				}

				return $default_status;
			},
			1500
		);
	}

	public function add_emails( $emails ) {
		if ( ! isset( $emails['WC_Email_Customer_Processing_Order'] ) ) {
			return $emails;
		}

		// Remove default triggers for the old instance initialised in WC_GZD_Email_Customer_Processing_Order
		remove_action( 'woocommerce_order_status_cancelled_to_processing_notification', array( $emails['WC_Email_Customer_Processing_Order'], 'trigger' ), 10 );
		remove_action( 'woocommerce_order_status_failed_to_processing_notification', array( $emails['WC_Email_Customer_Processing_Order'], 'trigger' ), 10 );
		remove_action( 'woocommerce_order_status_on-hold_to_processing_notification', array( $emails['WC_Email_Customer_Processing_Order'], 'trigger' ), 10 );
		remove_action( 'woocommerce_order_status_pending_to_processing_notification', array( $emails['WC_Email_Customer_Processing_Order'], 'trigger' ), 10 );

		// Swap emails to disable automatic order confirmation
		$emails['WC_GZDP_Email_Customer_Order_Confirmation'] = include WC_germanized_pro()->plugin_path() . '/includes/emails/class-wc-gzdp-email-customer-order-confirmation.php';
		$emails['WC_Email_Customer_Processing_Order']        = include WC_germanized_pro()->plugin_path() . '/includes/emails/class-wc-gzdp-email-customer-processing-order.php';

		return $emails;
	}

	public function get_confirmation_url( $order_id, $args = array() ) {
		return esc_url_raw( wp_nonce_url( add_query_arg( $args, admin_url( 'admin-ajax.php?action=woocommerce_gzdp_confirm_order&order_id=' . $order_id ) ), 'woocommerce-gzdp-confirm-order' ) );
	}

	public function admin_order_actions( $actions, $the_order ) {
		if ( wc_gzdp_order_needs_confirmation( $the_order ) ) {
			$actions             = array();
			$actions['complete'] = array(
				'url'    => $this->get_confirmation_url( $the_order->get_id() ),
				'name'   => __( 'Confirm Order', 'woocommerce-germanized-pro' ),
				'action' => 'complete',
			);
		}
		return $actions;
	}

	public function admin_order_table_title( $column ) {

		global $post, $woocommerce, $the_order;

		if ( empty( $the_order ) || (int) $the_order->get_id() !== (int) $post->ID ) {
			$the_order = wc_get_order( $post->ID );
		}

		if ( ! wc_gzdp_order_needs_confirmation( $the_order ) || ( $the_order && $the_order->has_status( 'cancelled' ) ) ) {
			return;
		}

		switch ( $column ) {
			case 'order_number':
				echo '<small class="wc-gzdp-unconfirmed">' . esc_html__( 'Unconfirmed', 'woocommerce-germanized-pro' ) . '</small>';
				break;
		}
	}

	public function admin_order_confirm_button( $order ) {
		if ( ! wc_gzdp_order_needs_confirmation( $order ) ) {
			return;
		}

		echo '<p class="wc-gzdp-submit-wrapper"><a href="' . esc_url( $this->get_confirmation_url( $order->get_id() ) ) . '" id="wc-gzdp-confirm-order-button" class="button button-primary">' . esc_html__( 'Confirm Order', 'woocommerce-germanized-pro' ) . '</a></p>';
	}

	public function admin_resend_order_emails( $emails ) {
		global $theorder;
		if ( isset( $theorder ) && wc_gzdp_order_needs_confirmation( $theorder->get_id() ) ) {
			return array(
				'customer_processing_order',
			);
		} else {
			array_push( $emails, 'customer_order_confirmation' );
		}
		return $emails;
	}
}

return WC_GZDP_Contract_Helper::instance();
