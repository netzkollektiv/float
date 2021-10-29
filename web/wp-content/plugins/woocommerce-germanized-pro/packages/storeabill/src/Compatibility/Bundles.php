<?php

namespace Vendidero\StoreaBill\Compatibility;

use Vendidero\StoreaBill\Document\Document;
use Vendidero\StoreaBill\Interfaces\Compatibility;
use Vendidero\StoreaBill\Invoice\Invoice;
use Vendidero\StoreaBill\Invoice\Item;

defined( 'ABSPATH' ) || exit;

class Bundles implements Compatibility {

	public static function is_active() {
		return class_exists( 'WC_Bundles' );
	}

	public static function init() {
		add_action( 'storeabill_before_render_document', array( __CLASS__, 'register_hooks' ), 50 );
		add_action( 'storeabill_after_render_document', array( __CLASS__, 'unregister_hooks' ), 50 );
	}

	public static function unregister_hooks() {
		$document_types = apply_filters( 'storeabill_bundles_compatibility_document_types', array(
			'invoice',
			'invoice_cancellation',
		) );

		foreach( $document_types as $document_type ) {
			remove_filter( "storeabill_{$document_type}_item_table_items", array( __CLASS__, 'hide_bundled_items' ), 10 );
			remove_filter( "storeabill_{$document_type}_item_table_column_classes", array( __CLASS__, 'add_bundle_classes' ), 10 );
			remove_action( "storeabill_{$document_type}_item_table_after_row", array( __CLASS__, 'add_bundle_items' ), 10 );
			remove_action( "storeabill_{$document_type}_item_table_before_row", array( __CLASS__, 'maybe_hide_bundle_container_prices' ), 10 );

			remove_action( "storeabill_{$document_type}_hide_email_details", array( __CLASS__, 'maybe_hide_details' ), 10 );
		}
	}

	public static function register_hooks() {
		$document_types = apply_filters( 'storeabill_bundles_compatibility_document_types', array(
			'invoice',
			'invoice_cancellation',
		) );

		foreach( $document_types as $document_type ) {
			add_filter( "storeabill_{$document_type}_item_table_items", array( __CLASS__, 'hide_bundled_items' ), 10, 2 );
			add_filter( "storeabill_{$document_type}_item_table_column_classes", array( __CLASS__, 'add_bundle_classes' ), 10, 3 );
			add_action( "storeabill_{$document_type}_item_table_after_row", array( __CLASS__, 'add_bundle_items' ), 10, 5 );
			add_action( "storeabill_{$document_type}_item_table_before_row", array( __CLASS__, 'maybe_hide_bundle_container_prices' ), 10, 5 );

			add_action( "storeabill_{$document_type}_hide_email_details", array( __CLASS__, 'maybe_hide_details' ), 10, 2 );
		}
	}

	/**
	 * Hide email document items table in case the invoice contains bundles.
	 *
	 * @param $hide_details
	 * @param Invoice $document
	 */
	public static function maybe_hide_details( $hide_details, $document ) {
		if ( self::document_has_bundle( $document ) ) {
			$hide_details = true;
		}

		return $hide_details;
	}

	/**
	 * @param Document $document
	 */
	protected static function document_has_bundle( $document ) {
		$has_bundle = false;

		if ( function_exists( 'wc_pb_is_bundle_container_order_item' ) ) {
			foreach( $document->get_items() as $item ) {
				if ( $order_item = self::get_document_order_item( $item ) ) {
					$bundle_items = self::get_bundled_items( $order_item, $document );

					if ( ! empty( $bundle_items ) ) {
						$has_bundle = true;
						break;
					}
				}
			}
		}

		return $has_bundle;
	}

	/**
     * @param array $classes
	 * @param Item $item
	 * @param Invoice $document
	 */
	public static function add_bundle_classes( $classes, $item, $document ) {
		if (
			function_exists( 'wc_pb_is_bundle_container_order_item' ) &&
            function_exists( 'wc_pb_is_bundled_order_item' )
        ) {
			if ( $order_item = self::get_document_order_item( $item ) ) {
				if ( wc_pb_is_bundle_container_order_item( $order_item ) ) {
					$classes[] = 'sab-bundle-container-item';
				} elseif( wc_pb_is_bundled_order_item( $order_item, $document->get_order() ) ) {
					$classes[] = 'sab-bundle-child-item';
				}
			}
        }

		return $classes;
    }

	/**
	 * @param Item $item
	 * @param Invoice $document
	 * @param array $columns
	 * @param integer $count
	 * @param integer $item_size
	 */
    public static function maybe_hide_bundle_container_prices( $item, $document, $columns, $count, $item_size ) {
	    if ( function_exists( 'wc_pb_is_bundle_container_order_item' ) ) {
		    if ( $order_item = self::get_document_order_item( $item ) ) {
			    if ( wc_pb_is_bundle_container_order_item( $order_item ) ) {
				    $items = self::get_bundled_items( $order_item, $document );

				    if ( ! empty( $items ) ) {
					    /**
					     * Bundled prices with zero total
					     */
					    $hide_zero_prices = apply_filters( "storeabill_{$document->get_type()}_hide_container_bundle_zero_prices", true, $item, $document );

					    if ( $item->get_total() == 0 && $hide_zero_prices ) {
						    add_filter( 'storeabill_formatted_price', array( __CLASS__, 'hide_price' ), 10 );
						    add_filter( 'storeabill_formatted_tax_rate_percentage', array( __CLASS__, 'hide_tax_rate' ), 10 );
						    add_filter( 'storeabill_formatted_tax_rate_percentage_html', array( __CLASS__, 'hide_tax_rate' ), 10 );
					    }
				    }
			    }
		    }
	    }
    }

	/**
	 * @param \Vendidero\StoreaBill\Document\Item $item
	 */
    protected static function get_document_order_item( $item ) {
	    if ( $ref_item = $item->get_reference() ) {
	    	if ( is_callable( array( $ref_item, 'get_order_item' ) ) ) {
			    $order_item = $ref_item->get_order_item();

			    if ( is_a( $order_item, 'WC_Order_Item_Product' ) ) {
					return $order_item;
			    }
		    }
	    }

	    return false;
    }

	/**
	 * @param Item $item
	 * @param Invoice $document
     * @param array $columns
     * @param integer $count
     * @param integer $item_size
	 */
	public static function add_bundle_items( $item, $document, $columns, $count, $item_size ) {
		if ( function_exists( 'wc_pb_is_bundle_container_order_item' ) ) {
			if ( $order_item = self::get_document_order_item( $item ) ) {
				if ( wc_pb_is_bundle_container_order_item( $order_item ) ) {
					/**
					 * Maybe remove filters set within maybe_hide_bundle_container_prices
					 */
					remove_filter( 'storeabill_formatted_price', array( __CLASS__, 'hide_price' ), 10 );
					remove_filter( 'storeabill_formatted_tax_rate_percentage', array( __CLASS__, 'hide_tax_rate' ), 10 );
					remove_filter( 'storeabill_formatted_tax_rate_percentage_html', array( __CLASS__, 'hide_tax_rate' ), 10 );

					$items = self::get_bundled_items( $order_item, $document );

					if ( ! empty( $items ) ) {
						foreach ( $items as $bundled_item ) {
							/**
							 * Bundled prices with zero total
							 */
							$hide_zero_prices = apply_filters( "storeabill_{$document->get_type()}_hide_bundled_zero_prices", true, $bundled_item, $document );

							if ( $bundled_item->get_total() == 0 && $hide_zero_prices ) {
								add_filter( 'storeabill_formatted_price', array( __CLASS__, 'hide_price' ), 10 );
								add_filter( 'storeabill_formatted_tax_rate_percentage', array( __CLASS__, 'hide_tax_rate' ), 10 );
								add_filter( 'storeabill_formatted_tax_rate_percentage_html', array( __CLASS__, 'hide_tax_rate' ), 10 );
							}

							sab_get_template( 'blocks/item-table/row.php', array(
								'document'  => $document,
								'count'     => $count,
								'item'      => $bundled_item,
								'item_size' => $item_size,
								'columns'   => $columns
							) );

							/**
							 * Bundled prices with zero total
							 */
							if ( $bundled_item->get_total() == 0 && $hide_zero_prices ) {
								remove_filter( 'storeabill_formatted_price', array( __CLASS__, 'hide_price' ), 10 );
								remove_filter( 'storeabill_formatted_tax_rate_percentage', array( __CLASS__, 'hide_tax_rate' ), 10 );
								remove_filter( 'storeabill_formatted_tax_rate_percentage_html', array( __CLASS__, 'hide_tax_rate' ), 10 );
							}
						}
					}
				}
			}
		}
	}

	public static function hide_tax_rate( $tax_rate ) {
		return '-';
	}

	public static function hide_price( $price ) {
		return '-';
	}

	/**
	 * @param \WC_Order_Item_Product $order_item
     * @param Document $document
	 */
	protected static function get_bundled_items( $order_item, $document ) {
	    if ( ! function_exists( 'wc_pb_get_bundled_order_items' ) ) {
	        return array();
        }

		$bundled_items = array();

	    if ( $order = self::get_document_order( $document ) ) {
		    $order_item_ids = wc_pb_get_bundled_order_items( $order_item, $order, true );

		    foreach( $document->get_items( 'product' ) as $item ) {
		    	if ( $ref_item = $item->get_reference() ) {
		    		if ( is_a( $ref_item, '\Vendidero\StoreaBill\WooCommerce\OrderItem' ) ) {
		    			$order_item_id = $ref_item->get_id();
				    } elseif ( is_callable( array( $ref_item, 'get_order_item_id' ) ) ) {
					    $order_item_id = $ref_item->get_order_item_id();
				    }

		    		if ( in_array( $order_item_id, $order_item_ids ) ) {
		    			$bundled_items[] = $item;
				    }
			    }
		    }
	    }

        return $bundled_items;
	}

	/**
	 * @param Document $document
	 */
	protected static function get_document_order( $document ) {
		if ( is_callable( array( $document, 'get_order' ) ) ) {
			if ( $order = $document->get_order() ) {
				if ( is_a( $order, '\Vendidero\StoreaBill\Interfaces\Order' ) ) {
					$order = $order->get_object();
				}

				if ( is_a( $order, 'WC_Order' ) ) {
					return $order;
				}
			}
		}

		return false;
	}

	/**
	 * Remove bundled items from table.
	 *
	 * @param Item[] $items
	 * @param $document
	 *
	 * @return mixed
	 */
	public static function hide_bundled_items( $items, $document ) {
		if ( function_exists( 'wc_pb_is_bundled_order_item' ) ) {
			foreach( $items as $key => $item ) {
				if ( $order_item = self::get_document_order_item( $item ) ) {
					if ( wc_pb_is_bundled_order_item( $order_item, $document->get_order() ) ) {
						unset( $items[ $key ] );
					}
				}
			}
		}

		return $items;
	}
}
