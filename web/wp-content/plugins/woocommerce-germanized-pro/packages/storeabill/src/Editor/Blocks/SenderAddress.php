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
class SenderAddress extends DynamicBlock {

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'sender-address';

	public function get_attributes() {
		return array(
			'align'   => $this->get_schema_align(),
			'heading' => $this->get_schema_string(),
		);
	}

	protected function replace_placeholder( $content, $replacement ) {
		if ( empty( $content ) ) {
			$content = '<address class="address-content">{content}</address>';
		}

		return str_replace( '{content}', $replacement, $content );
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
			return $content;
		}

		/**
		 * @var Document $document
		 */
		$document         = $GLOBALS['document'];
		$this->attributes = $this->parse_attributes( $attributes );
		$this->content    = $content;

		if ( is_callable( array( $document, 'get_formatted_sender_address' ) ) ) {
			$output        = $document->get_formatted_sender_address();
			$this->content = $this->replace_placeholder( $content, $output );
		}

		return $this->content;
	}
}
