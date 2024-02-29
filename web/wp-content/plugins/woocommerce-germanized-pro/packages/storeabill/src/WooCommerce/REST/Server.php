<?php

namespace Vendidero\StoreaBill\WooCommerce\REST;

defined( 'ABSPATH' ) || exit;

/**
 * Class responsible for loading the REST API and all REST API namespaces.
 */
class Server {

	/**
	 * Hook into WordPress ready to init the REST API as needed.
	 */
	public static function init() {
		add_filter( 'woocommerce_rest_api_get_rest_namespaces', array( __CLASS__, 'register_controllers' ), 10 );
		add_filter( 'woocommerce_rest_shop_order_schema', array( __CLASS__, 'order_schema' ), 10 );
	}

	public static function order_schema( $schema ) {
		$item_schema = array();

		/**
		 * Use the cancellations schema which adds additional properties to the invoice endpoint as
		 * the invoice list may return invoices and cancellations.
		 */
		if ( $controller = \Vendidero\StoreaBill\REST\Server::instance()->get_controller( 'cancellations' ) ) {
			$item_schema = $controller->get_public_item_schema();
		}

		$schema['invoices'] = array(
			'description' => _x( 'List of invoices.', 'storeabill-core', 'woocommerce-germanized-pro' ),
			'type'        => 'array',
			'context'     => array( 'view', 'edit' ),
			'readonly'    => true,
			'items'       => $item_schema,
		);

		return $schema;
	}

	public static function register_controllers( $controller ) {
		$controller['wc/v3']['order-invoices'] = 'Vendidero\StoreaBill\WooCommerce\REST\Orders';

		return $controller;
	}
}
