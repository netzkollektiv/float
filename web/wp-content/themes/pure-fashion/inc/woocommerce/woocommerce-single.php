<?php
/**
 * WooCommerce Product detail functions
 *
 * @package WordPress
 * @subpackage pure-fashion
 * @since 1.0
 * @version 1.0
 */

if ( ! thb_wc_supported() ) {
	return;
}
// Product Page Structure.
function thb_woocommerce_before_single_product() {
	?>
	<div class="row full-width-row">
		<div class="small-12 columns">
	<?php
}
add_action( 'woocommerce_before_single_product', 'thb_woocommerce_before_single_product', 0 );

function thb_woocommerce_before_single_product_summary() {
	?>
	<div class="row thb-product-main-row">
		<div class="small-12 medium-6 large-7 columns product-gallery-column">
	<?php
}
add_action( 'woocommerce_before_single_product_summary', 'thb_woocommerce_before_single_product_summary', 0 );

function thb_woocommerce_before_single_product_summary_end() {
	?>
		</div>
		<div class="small-12 medium-6 large-5 columns product-information">
	<?php
}
add_action( 'woocommerce_before_single_product_summary', 'thb_woocommerce_before_single_product_summary_end', 99 );

function thb_woocommerce_after_single_product_summary() {
	?>

		</div>
	</div>
	<?php
}
add_action( 'woocommerce_after_single_product_summary', 'thb_woocommerce_after_single_product_summary', 0 );

function thb_woocommerce_after_single_product() {
	?>
		</div>
	</div>
	<?php
}
add_action( 'woocommerce_after_single_product', 'thb_woocommerce_after_single_product', 99 );

// Tab Styles.
add_action(
	'woocommerce_before_single_product',
	function() {
		// Move Rating.
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 8 );
	},
	15
);

// Product Nav.
function thb_product_navigation() {
	global $post;
	$next_post = get_next_post( true, '', 'product_cat' );
	$prev_post = get_previous_post( true, '', 'product_cat' );
	?>
	<ul class="thb-product-nav">
		<?php if ( $prev_post ) { ?>
			<li class="thb-product-nav-button product-nav-prev">
				<a href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>" rel="prev" class="product-nav-link">
					<i class="thb-icon-left-open-mini"></i>
					<div class="thb-product-nav-text">
						<?php esc_attr_e( 'Previous Product', 'pure-fashion' ); ?>
					</div>
				</a>
			</li>
		<?php } ?>
		<?php if ( $next_post ) { ?>
			<li class="thb-product-nav-button product-nav-next">
				<a href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>" rel="next" class="product-nav-link">
					<div class="thb-product-nav-text">
						<?php esc_attr_e( 'Next Product', 'pure-fashion' ); ?>
					</div>
					<i class="thb-icon-right-open-mini"></i>
				</a>
			</li>
		<?php } ?>
	</ul>
	<?php
}
add_action( 'thb_product_navigation', 'thb_product_navigation' );

// Remove Product Description Heading.
function thb_remove_product_description_heading() {
	return '';
}
add_filter( 'woocommerce_product_description_heading', 'thb_remove_product_description_heading' );


// Remove Additional Product Information Heading.
function thb_remove_product_information_heading() {
	return '';
}
add_filter( 'woocommerce_product_additional_information_heading', 'thb_remove_product_information_heading' );

// Remove Sidebar.
function thb_disable_woo_commerce_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}
add_action( 'init', 'thb_disable_woo_commerce_sidebar' );

// Add Sharing.
function thb_product_sharing() {
	if ( wp_doing_ajax() ) {
		return;
	}
	if ( function_exists( 'sharing_display' ) ) {
		?>
		<div class="thb-product-meta-before">
			<div class="thb-share-product">
				<?php sharing_display( '', true ); ?>
			</div>
		</div>
		<?php
	}
}
add_action( 'woocommerce_single_product_summary', 'thb_product_sharing', 50 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Product Page Ajax Add to Cart.
function thb_woocommerce_single_product() {
	if ( ! thb_customizer( 'single_product_ajax' ) ) {
		return;
	}

	function thb_ajax_add_to_cart_redirect_template() {
		$thb_ajax = filter_input( INPUT_GET, 'thb-ajax-add-to-cart', FILTER_VALIDATE_BOOLEAN );

		if ( $thb_ajax ) {
			wc_get_template( 'ajax/add-to-cart-fragments.php' );
			exit;
		}
	}
	add_action( 'wp', 'thb_ajax_add_to_cart_redirect_template', 1000 );
	function thb_woocommerce_after_add_to_cart_button() {
		global $product;
		?>
			<input type="hidden" name="action" value="wc_prod_ajax_to_cart" />
		<?php
		// Make sure we have the add-to-cart avaiable as button name doesn't submit via ajax.
		if ( $product->is_type( 'simple' ) ) {
			?>
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"/>
			<?php
		}
	}
	add_action( 'woocommerce_after_add_to_cart_button', 'thb_woocommerce_after_add_to_cart_button' );
	function thb_woocommerce_display_site_notice() {
		$row_classes[] = 'row full-width-row';
		$row_classes[] = is_singular( 'product' ) ? false : 'no-padding';
		?>
		<div class="<?php echo esc_attr( implode( ' ', $row_classes ) ); ?>">
			<div class="small-12 columns">
				<div class="thb_prod_ajax_to_cart_notices"></div>
			</div>
		</div>
		<?php
	}
	add_action( 'woocommerce_before_main_content', 'thb_woocommerce_display_site_notice', 10 );
}
add_action( 'before_woocommerce_init', 'thb_woocommerce_single_product' );

function thb_product_gallery_thumbnail_size( $size ) {
	return array(
		'width'  => 160,
		'height' => 192,
		'crop'   => 1,
	);
}
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'thb_product_gallery_thumbnail_size' );

// Gallery Support.
function thb_enable_faux_flexslider_support() {
	return true;
}
add_filter( 'woocommerce_single_product_flexslider_enabled', 'thb_enable_faux_flexslider_support' );

// Video Support
function thb_product_video() {
	$thb_product_video = get_post_meta( get_the_ID(), 'thb_product_video', true );

	if ( ! $thb_product_video || '' === $thb_product_video ) {
		return;
	}
	?>
	<div class="flex-video widescreen" id="product-video">
		<?php echo wp_kses_post( wp_oembed_get( $thb_product_video ) ); ?>
	</div>
	<?php
}
add_action( 'woocommerce_product_thumbnails', 'thb_product_video', 999 );

function thb_custom_wpkses_post_tags( $tags, $context ) {
	if ( 'post' === $context ) {
		$tags['iframe'] = array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'allowfullscreen' => true,
		);
	}

	return $tags;
}

add_filter( 'wp_kses_allowed_html', 'thb_custom_wpkses_post_tags', 10, 2 );
