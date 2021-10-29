<?php
/**
 * Customizer Custom Controls
 *
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	require get_theme_file_path( '/inc/framework/customizer/custom-controls/controls/class-thb-customize-alpha-color-control.php' );
	require get_theme_file_path( '/inc/framework/customizer/custom-controls/controls/class-thb-dropdown-select2-custom-control.php' );
	require get_theme_file_path( '/inc/framework/customizer/custom-controls/controls/class-thb-google-font-select-custom-control.php' );
	require get_theme_file_path( '/inc/framework/customizer/custom-controls/controls/class-thb-image-checkbox-button-custom-control.php' );
	require get_theme_file_path( '/inc/framework/customizer/custom-controls/controls/class-thb-image-radio-button-custom-control.php' );
	require get_theme_file_path( '/inc/framework/customizer/custom-controls/controls/class-thb-simple-notice-custom-control.php' );
	require get_theme_file_path( '/inc/framework/customizer/custom-controls/controls/class-thb-slider-custom-control.php' );
	require get_theme_file_path( '/inc/framework/customizer/custom-controls/controls/class-thb-tinymce-custom-control.php' );
	require get_theme_file_path( '/inc/framework/customizer/custom-controls/controls/class-thb-toggle-switch-custom-control.php' );
}
