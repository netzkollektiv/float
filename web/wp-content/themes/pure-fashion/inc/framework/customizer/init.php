<?php
// Custom Controls
require get_theme_file_path( '/inc/framework/customizer/custom-controls/custom-controls.php' );

// Customizer Sections
function thb_customize_register( $wp_customize ) {

	$wp_customize->add_panel(
		'pure-fashion',
		array(
			'priority'    => 1,
			'title'       => esc_html__( 'Pure Fashion', 'pure-fashion' ),
			'description' => esc_html__( 'Pure Fashion Theme Settings', 'pure-fashion' ),
		)
	);
	$settings_sections = array(
		'subheader',
		'header',
		'header-secondary',
		'blog',
		'article',
		'shop',
		'colors',
		'typography',
		'mobilemenu',
		'footer',
		'subfooter',
	);
	foreach ( $settings_sections as $section ) {
		require_once get_parent_theme_file_path( '/inc/framework/customizer/' . $section . '.php' );
	}
}
add_action( 'customize_register', 'thb_customize_register' );

// Output Customizer
function thb_customizer( $key, $default = false ) {
	$r = get_theme_mod( $key, $default );

	return $r;
}
