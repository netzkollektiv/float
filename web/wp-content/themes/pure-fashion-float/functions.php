<?php

/*add_action( 'wp_enqueue_scripts', 'float_enqueue_styles' );
function float_enqueue_styles() {
    $parenthandle = 'thb-app'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/assets/css/app.css',
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'float-app', get_stylesheet_directory_uri() . '/assets/css/app.css',
        array(),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}
*/

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    show_admin_bar(false);
}

/**
 * Enqueue mitdenkt script
 *
 */
function enqueue_mitdenkt_script(){
  wp_enqueue_script( 'mitdenkt-script', '//app.instyler.de/pubi/BKEI' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_mitdenkt_script' );

/**
 * Enqueue custom script
 *
 */
function enqueue_float_custom_script(){
  wp_enqueue_script( 'float-custom-script', get_stylesheet_directory_uri() . '/assets/js/custom.js' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_float_custom_script' );

// Enqueue Adobe fonts
function enqueue_float_styles_fonts() {
	wp_enqueue_style('font-styles', 'https://use.typekit.net/kkt0tgo.css');
}
add_action( 'wp_enqueue_scripts', 'enqueue_float_styles_fonts' );

/**
 * Register sidebars and widgetized areas
 *
 */
function float_widgets_init() {

	register_sidebar( array(
		'name'          => 'Subheader - Social Menu',
		'id'            => 'subheader_social',
		'before_widget' => '<div class="subheader-social">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );

}
add_action( 'widgets_init', 'float_widgets_init' );

/**
 * Adjust Gutenberg color palette
 *
 */
function float_add_custom_gutenberg_color_palette() {
	add_theme_support(
		'editor-color-palette',
		[
			[
				'name'  => esc_html__( 'Blue', 'float' ),
				'slug'  => 'blue',
				'color' => '#012641',
			],
			[
				'name'  => esc_html__( 'Beige', 'float' ),
				'slug'  => 'beige',
				'color' => '#dacdbc',
			],
			[
				'name'  => esc_html__( 'Grey', 'float' ),
				'slug'  => 'grey',
				'color' => '#888888',
			],
			[
				'name'  => esc_html__( 'White', 'float' ),
				'slug'  => 'white',
				'color' => '#fff',
			]

		]
	);
}
add_action( 'after_setup_theme', 'float_add_custom_gutenberg_color_palette' );

/**
 * Set the columns for the PDF voucher post type in the backend
 *
 */
add_filter( 'manage_edit-wc_voucher_columns', 'my_edit_wc_voucher_columns' ) ;
function my_edit_wc_voucher_columns( $columns ) {

	$columns += [ 'seller' => __( 'Verkäufer' ) ];
	$columns += [ 'payment_method' => __( 'Zahlungsart' ) ];

	return $columns;
}
add_action( 'manage_wc_voucher_posts_custom_column', 'my_manage_wc_voucher_columns', 10, 2 );
function my_manage_wc_voucher_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'seller' :
            echo get_field('float_pdf_voucher_seller');
			break;
		case 'payment_method' :
            echo get_field('float_pdf_voucher_payment_method');
			break;

    }
}

/*
 * Add button for appointment booking (mitdenkt) below add to cart button on product page
 */
add_action( 'woocommerce_single_product_summary', 'float_add_content_after_addtocart_button', 25 );
function float_add_content_after_addtocart_button() {
        echo '<a href="?appid=BKEI" class="button alt book-appointment-button">Termin buchen</a><div class="book-appointment-divider"><small>- oder -</small></div>';
}

/*
 * Bugfixing native (plugin-native) German translations
 */
function float_text_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'QTY' :
            return 'Menge';
        case 'Close' :
            return 'Schließen';
        break;
    }
    return $translated_text;
}
add_filter( 'gettext', 'float_text_strings', 20, 3 );
