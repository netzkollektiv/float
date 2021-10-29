<?php
/**
 * WooCommerce Shop Page related functions
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

// Remove Default Sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Before Shop page content.
function thb_woocommerce_before_main_content() {
	if ( is_product() ) {
		return;
	}
	?>
	<div class="row full-width-row">
		<div class="small-12 columns">
			<div class="thb-shop-content">
	<?php
}
add_action( 'woocommerce_before_main_content', 'thb_woocommerce_before_main_content', 5 );

// After Shop page content.
function thb_woocommerce_after_main_content() {
	if ( is_product() ) {
		return;
	}
	?>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_after_main_content', 'thb_woocommerce_after_main_content', 99 );
