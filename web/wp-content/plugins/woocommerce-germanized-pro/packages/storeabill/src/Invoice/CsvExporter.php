<?php

namespace Vendidero\StoreaBill\Invoice;

defined( 'ABSPATH' ) || exit;

class CsvExporter extends \Vendidero\StoreaBill\Document\CsvExporter {

	protected $excluded_column_names = array(
		'product_items',
		'tax_items',
		'fee_items',
		'shipping_items',
		'totals',
		'tax_totals',
		'sync',
		'parent_id',
		'order_type',
		'formatted_address',
		'formatted_shipping_address',
		'meta_data',
		'shipping_address'
	);

	protected $date_column_names = array(
		'date_created',
		'date_modified',
		'date_sent',
		'date_paid',
		'date_due',
		'date_of_service',
		'date_of_service_end'
	);

	public function get_document_type() {
		return 'invoice';
	}

	protected function get_additional_query_args() {
		$query_args = array(
			'status' => array( 'closed', 'cancelled' )
		);

		return $query_args;
	}

	protected function get_additional_default_column_names() {
		return array(
			'tax_totals' => _x( 'Tax totals', 'storeabill-core', 'woocommerce-germanized-pro' ),
			'net_totals' => _x( 'Net totals', 'storeabill-core', 'woocommerce-germanized-pro' )
		);
	}

	protected function get_columns_with_extra_handling() {
		return array_merge( parent::get_columns_with_extra_handling(), array( 'net_totals', 'tax_totals' ) );
	}

	protected function prepare_extra_data_for_export( $document, &$row ) {
		if ( $this->is_column_exporting( 'tax_totals' ) ) {
			foreach( $document['tax_totals'] as $rate_merge_key => $tax_total_data ) {
				$column_key = 'tax_totals:' . esc_attr( $tax_total_data['rate']['percent'] );
				$this->column_names[ $column_key ] = sprintf( _x( 'Tax Total: %s', 'storeabill-core', 'woocommerce-germanized-pro' ), $tax_total_data['rate']['percent'] );

				$row[ $column_key ] = $tax_total_data['total_tax'];
			}
		}

		if ( $this->is_column_exporting( 'net_totals' ) ) {
			foreach( $document['tax_totals'] as $rate_merge_key => $tax_total_data ) {
				$column_key = 'net_totals:' . esc_attr( $tax_total_data['rate']['percent'] );
				$this->column_names[ $column_key ] = sprintf( _x( 'Total Net: %s', 'storeabill-core', 'woocommerce-germanized-pro' ), $tax_total_data['rate']['percent'] );

				$row[ $column_key ] = $tax_total_data['total_net'];
			}
		}
	}

	public function get_title() {
		return _x( 'Export invoices as CSV', 'storeabill-core', 'woocommerce-germanized-pro' );
	}

	public function get_description() {
		return _x( 'This tool allows you to generate and download a CSV file containing a list of invoices', 'storeabill-core', 'woocommerce-germanized-pro' );
	}
}
