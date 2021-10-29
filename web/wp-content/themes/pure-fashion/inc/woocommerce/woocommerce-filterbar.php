<?php
/**
 * WooCommerce Filter bar functions
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */


if ( ! thb_wc_supported() ) {
	return;
}
// Off-Canvas Filters.
function thb_shop_filters() {
	if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
		?>
		<div id="side-filters" class="side-panel thb-side-filters">
			<header class="side-panel-header">
				<a href="#" class="thb-close" title="<?php esc_attr_e( 'Close', 'pure-fashion' ); ?>"><?php esc_html_e( 'Close', 'pure-fashion' ); ?></a>
			</header>
			<div class="side-panel-content custom_scroll">
				<?php
				if ( is_active_sidebar( 'thb-shop-filters' ) ) {
					dynamic_sidebar( 'thb-shop-filters' );
				}
				?>
			</div>
		</div>
		<?php
	}
}
add_action( 'thb_shop_filters', 'thb_shop_filters' );

// Remove/Add Breadcrumbs.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

function thb_wc_breadcrumbs() {
	if ( ! is_product() ) {
		return;
	}
	?>
	<div class="thb-woocommerce-header">
		<div class="row full-width-row">
			<div class="small-12 columns">
				<div class="thb-breadcrumb-bar">
					<?php woocommerce_breadcrumb(); ?>
					<?php do_action( 'thb_product_navigation' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_before_main_content', 'thb_wc_breadcrumbs', 0 );

function thb_shop_description() {
	if ( ! is_product_category() && ! is_product_tag() ) {
		if ( thb_customizer( 'shop_description' ) ) {
			echo '<div class="term-description"><p>' . wp_kses_post( thb_customizer( 'shop_description' ) ) . '</p></div>';
		}
	}
}
add_action( 'woocommerce_archive_description', 'thb_shop_description', 10 );

function thb_filter_bar() {
	if ( is_product() ) {
		return;
	}

	$classes[] = 'thb-filter-bar';
	?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="row align-middle">
			<div class="small-6 small-order-2 large-order-1 large-3 columns">
				<a href="#" id="thb-shop-filters"><?php get_template_part( 'assets/img/svg/filter.svg' ); ?> <?php esc_html_e( 'Filter', 'pure-fashion' ); ?></a>
			</div>
			<div class="small-12 small-order-1 large-order-2 large-6 columns text-center thb-filter-middle-column">
				<?php
				$current_cat_id = get_queried_object_id();
				$parent         = 0 !== is_product_category() ? $current_cat_id : 0;
				$categories     = get_terms(
					'product_cat',
					array(
						'hide_empty' => 0,
						'parent'     => $current_cat_id,
					)
				);
				if ( ! empty( $categories ) ) {
					foreach ( $categories as $cat ) {
						if ( 0 === $cat->count ) {
							continue;
						}
						if ( isset( $current_cat_id ) && $current_cat_id === $cat->term_id ) {
							$item_class[] = 'thb-current-cat';
						}
						$item_class[] = 'thb-category-top-link';
						?>
						<a href="<?php echo esc_url( get_term_link( $cat->slug, 'product_cat' ) ); ?>" class="<?php echo esc_attr( implode( ' ', $item_class ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
						<?php
					}
				}
				?>
			</div>
			<div class="small-6 small-order-3 large-order-3 large-3 columns text-right">
				<?php woocommerce_catalog_ordering(); ?>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_before_main_content', 'thb_filter_bar', 10 );
