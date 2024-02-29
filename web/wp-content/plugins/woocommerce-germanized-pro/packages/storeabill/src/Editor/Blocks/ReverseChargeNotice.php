<?php
/**
 * All products block.
 *
 * @package WooCommerce\Blocks
 */

namespace Vendidero\StoreaBill\Editor\Blocks;

use Vendidero\StoreaBill\Document\Document;

defined( 'ABSPATH' ) || exit;

/**
 * AllProducts class.
 */
class ReverseChargeNotice extends DynamicBlock {

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'reverse-charge-notice';

	public function get_attributes() {
		return array(
			'align'         => $this->get_schema_align(),
			'virtualNotice' => $this->get_schema_string( _x( 'Tax liability of the recipient of the services.', 'storeabill-core', 'woocommerce-germanized-pro' ) ),
		);
	}

	/**
	 * Append frontend scripts when rendering the Product Categories List block.
	 *
	 * @param array  $attributes Block attributes. Default empty array.
	 * @param string $content    Block content. Default empty string.
	 * @return string Rendered block type output.
	 */
	public function render( $attributes = array(), $content = '' ) {
		self::maybe_setup_document();

		if ( ! isset( $GLOBALS['document'] ) ) {
			return '';
		}

		/**
		 * @var Document $document
		 */
		$document         = $GLOBALS['document'];
		$this->attributes = $this->parse_attributes( $attributes );
		$this->content    = '';

		if ( is_a( $document, 'Vendidero\StoreaBill\Invoice\Invoice' ) ) {
			if ( $document->is_reverse_charge() ) {
				/**
				 * Special case for virtual invoices: Use a separate notice from the block settings.
				 */
				if ( $document->is_virtual() ) {
					$has_updated_dom = false;

					if ( $dom = sab_load_html_dom( $content ) ) {
						$main_node = $dom->getElementsByTagName( 'p' );

						if ( count( $main_node ) > 0 ) {
							$main_node->item( 0 )->nodeValue = wp_kses_post( $this->attributes['virtualNotice'] );

							$content         = $dom->saveXML( $main_node->item( 0 ) );
							$has_updated_dom = true;
						}
					}

					if ( ! $has_updated_dom ) {
						$content = wp_kses_post( $this->attributes['virtualNotice'] );
					}
				}

				$this->content = apply_filters( 'storeabill_invoice_reverse_charge_notice', $content, $document );
			}
		}

		return $this->content;
	}
}
