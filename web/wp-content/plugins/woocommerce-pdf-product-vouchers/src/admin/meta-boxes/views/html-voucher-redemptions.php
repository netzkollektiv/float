<?php
/**
 * WooCommerce PDF Product Vouchers
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce PDF Product Vouchers to newer
 * versions in the future. If you wish to customize WooCommerce PDF Product Vouchers for your
 * needs please refer to https://docs.woocommerce.com/document/woocommerce-pdf-product-vouchers/ for more information.
 *
 * @author    SkyVerge
 * @copyright Copyright (c) 2012-2021, SkyVerge, Inc. (info@skyverge.com)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

use SkyVerge\WooCommerce\PluginFramework\v5_10_6 as Framework;

/**
 * Voucher redemptions admin template
 *
 * @type \WC_Voucher $voucher current voucher instance
 *
 * @since 3.0.0
 * @version 3.5.0
 */
?>

<tbody id="voucher-redemptions">
<?php
	if ( $voucher->has_redemptions() ) {

		foreach ( $voucher->get_redemptions() as $i => $redemption ) {
			include( 'html-voucher-redemption.php' );
		}

		/**
		 * Triggerd after voucher redemptions have been rendered in admin
		 *
		 * @since 3.0.0
		 * @param \WC_Voucher $voucher
		 */
		do_action( 'wc_pdf_product_vouchers_admin_after_redemptions', $voucher );
	}
?>
</tbody>
