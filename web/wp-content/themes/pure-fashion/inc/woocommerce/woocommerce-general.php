<?php
/**
 * WooCommerce misc functions
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

if ( ! thb_wc_supported() ) {
	return;
}

// Pagination.
function thb_woocommerce_pagination_args( $defaults ) {
	$defaults['type']      = 'plain';
	$defaults['prev_text'] = '';
	$defaults['next_text'] = '';

	return $defaults;
}
add_filter( 'woocommerce_pagination_args', 'thb_woocommerce_pagination_args' );

// Remove Hooks.
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 15 );

// woocommerce_before_shop_loop_item.
function thb_woocommerce_before_shop_loop_item() {
	?>
	<div class="thb-product-inner-wrapper">
		<figure class="product-thumbnail">
	<?php
}
add_action( 'woocommerce_before_shop_loop_item', 'thb_woocommerce_before_shop_loop_item', 0 );

// woocommerce_before_shop_loop_item_title.
function thb_woocommerce_before_shop_loop_item_title() {
	?>
		</figure>
	<div class="thb-product-inner-content">
	<?php
}
add_action( 'woocommerce_before_shop_loop_item_title', 'thb_woocommerce_before_shop_loop_item_title', 99 );

// woocommerce_after_shop_loop_item.
function thb_woocommerce_after_shop_loop_item() {
	?>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_after_shop_loop_item', 'thb_woocommerce_after_shop_loop_item', 99 );

// Add Custom Notice wrapper.
add_action( 'thb_after_main', 'thb_custom_notice', 10 );
function thb_custom_notice() {
	?>
	<div class="thb-woocommerce-notices-wrapper"></div>
	<?php
}

// Product Classes.
function thb_add_product_classes( $classes, $product ) {
	if ( ! is_single() || ( $product->get_id() !== get_queried_object_id() && is_single() ) ) {
		global $woocommerce_loop;

		// Settings.
		$columns = thb_translate_columns( wc_get_loop_prop( 'columns' ), false );
		$indexes = array_map( 'intval', explode( ',', thb_customizer( 'shop_product_doublesize_index', '3,8' ) ) );

		$classes[] = 'small-6';
		if ( thb_customizer( 'shop_product_doublesize', 0 ) && in_array( $woocommerce_loop['loop'], $indexes, true ) && ! is_single() ) {
			$columns   = thb_translate_columns( wc_get_loop_prop( 'columns' ), true );
			$classes[] = isset( $columns ) ? $columns : 'medium-6';
			$classes[] = 'thb-double-size';
		} else {
			$classes[] = isset( $columns ) ? $columns : 'medium-6';
		}
		$classes[] = 'columns';
		$classes[] = 'thb-listing-index-' . $woocommerce_loop['loop'];
	}
	if ( is_single() && $product->get_id() === get_queried_object_id() ) {
		$classes[] = 'thb-product-detail';
	}
	return $classes;
}
add_filter( 'woocommerce_post_class', 'thb_add_product_classes', 10, 2 );

// Filter Products per page.
function thb_new_loop_shop_per_page( $products_per_page ) {
	$products_per_page = thb_customizer( 'shop_products_per_page', 14 );

	return $products_per_page;
}
add_filter( 'loop_shop_per_page', 'thb_new_loop_shop_per_page', 20 );

// Add Title with Link.
function thb_template_loop_product_title() {
	global $product;
	$product_url = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
	?>
	<h2 class="<?php echo esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ); ?>"><a href="<?php echo esc_url( $product_url ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	<?php
}
add_action( 'woocommerce_shop_loop_item_title', 'thb_template_loop_product_title', 10 );

// Remove Rating Text
function thb_template_loop_product_rating( $html, $rating, $count ) {
	$html = '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"></span>';
	return $html;
}
add_filter( 'woocommerce_get_star_rating_html', 'thb_template_loop_product_rating', 5, 3 );


// Add to Cart Styles
add_action( 'before_woocommerce_init', 'thb_different_add_to_cart', 15 );

function thb_different_add_to_cart() {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15 );
};

// Breadcrumb Delimiter.
function thb_change_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = ' <i>/</i> ';
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'thb_change_breadcrumb_delimiter' );
