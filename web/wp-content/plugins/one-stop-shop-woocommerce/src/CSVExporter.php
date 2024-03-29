<?php
namespace Vendidero\OneStopShop;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WC_CSV_Exporter', false ) ) {
	require_once WC_ABSPATH . 'includes/export/abstract-wc-csv-exporter.php';
}

class CSVExporter extends \WC_CSV_Exporter {

	/**
	 * Type of export used in filter names.
	 *
	 * @var string
	 */
	protected $export_type = 'oss_report';

	/**
	 * Filename to export to.
	 *
	 * @var string
	 */
	protected $filename = 'oss-report.csv';

	/**
	 * Batch limit.
	 *
	 * @var integer
	 */
	protected $limit = 50;

	protected $report = null;

	protected $decimals = 2;

	public function __construct( $id, $decimals ) {
		$this->report       = new Report( $id );
		$this->decimals     = apply_filters( 'oss_woocommerce_csv_export_decimals', $decimals, $this );
		$this->column_names = $this->get_default_column_names();
		$this->filename     = sanitize_file_name( $this->report->get_id() . '.csv' );
	}

	/**
	 * Return an array of columns to export.
	 *
	 * @since 3.1.0
	 * @return array
	 */
	public function get_default_column_names() {
		return apply_filters(
			'one_stop_shop_woocommerce_export_default_columns',
			array(
				'country'      => _x( 'Country code', 'oss', 'one-stop-shop-woocommerce' ),
				'tax_rate'     => _x( 'Tax rate', 'oss', 'one-stop-shop-woocommerce' ),
				'taxable_base' => _x( 'Taxable base', 'oss', 'one-stop-shop-woocommerce' ),
				'amount'       => _x( 'Amount', 'oss', 'one-stop-shop-woocommerce' ),
			)
		);
	}

	public function get_report() {
		return $this->report;
	}

	public function get_decimals() {
		return $this->decimals;
	}

	protected function format_decimal( $value ) {
		return wc_format_decimal( $value, $this->get_decimals() );
	}

	protected function format_country( $country ) {
		return strtoupper( $country );
	}

	protected function get_row_data( $country, $tax_rate ) {
		$row = array();

		foreach ( array_keys( $this->get_column_names() ) as $column_id ) {
			$column_id = strstr( $column_id, ':' ) ? current( explode( ':', $column_id ) ) : $column_id;
			$value     = '';

			if ( 'country' === $column_id ) {
				$value = $this->format_country( $country );
			} elseif ( 'tax_rate' === $column_id ) {
				$value = $this->format_decimal( $tax_rate );
			} elseif ( 'taxable_base' === $column_id ) {
				$value = $this->format_decimal( $this->report->get_country_net_total( $country, $tax_rate, $this->get_decimals() ) );
			} elseif ( 'amount' === $column_id ) {
				$value = $this->format_decimal( $this->report->get_country_tax_total( $country, $tax_rate, $this->get_decimals() ) );
			} elseif ( is_callable( array( $this, "get_column_value_{$column_id}" ) ) ) {
				$value = $this->{"get_column_value_{$column_id}"}( $country, $tax_rate );
			} else {
				$value = apply_filters( "one_stop_shop_woocommerce_export_column_{$column_id}", $value, $country, $tax_rate, $this );
			}

			$row[ $column_id ] = $value;
		}

		return $row;
	}

	/**
	 * Prepare data that will be exported.
	 */
	public function prepare_data_to_export() {
		$countries = $this->report->get_countries();

		if ( ! empty( $countries ) ) {
			foreach ( $countries as $country ) {
				foreach ( $this->report->get_tax_rates_by_country( $country ) as $tax_rate ) {
					$this->row_data[] = apply_filters( 'one_stop_shop_woocommerce_export_row_data', $this->get_row_data( $country, $tax_rate ), $country, $tax_rate, $this );
				}
			}
		}
	}
}
