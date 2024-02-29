<?php
/**
 * Vendidero Functions
 *
 * Functions to enable automatic updates
 *
 * @author      Vendidero
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'vendidero_register_product' ) ) {

	function vendidero_register_product( $file, $product_id ) {
		$plugin             = new stdClass();
		$plugin->file       = $file;
		$plugin->product_id = $product_id;
		return $plugin;
	}
}

if ( ! function_exists( 'vendidero_helper_activated' ) ) {

	function vendidero_helper_activated() {
		if ( is_multisite() ) {
			require_once ABSPATH . '/wp-admin/includes/plugin.php';
		}

		if ( is_multisite() && ! ( is_plugin_active_for_network( 'vendidero-helper/vendidero-helper.php' ) ) ) {
			return false;
		}

		if ( ! is_multisite() && ! in_array( 'vendidero-helper/vendidero-helper.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
			return false;
		}

		return true;
	}
}

if ( ! vendidero_helper_activated() && ! function_exists( 'vendidero_helper_install' ) ) {

	function vendidero_helper_install( $api, $action, $args ) {
		$download_url = 'https://github.com/vendidero/vendidero-helper/releases/download/1.0.0/vendidero-helper.zip';

		if ( 'plugin_information' !== $action ||
			false !== $api ||
			! isset( $args->slug ) ||
			'vendidero-helper' !== $args->slug
		) {
			return $api;
		}

		$api                = new stdClass();
		$api->name          = 'Vendidero Helper';
		$api->version       = '1.0.0';
		$api->download_link = esc_url( $download_url );
		return $api;
	}

	add_filter( 'plugins_api', 'vendidero_helper_install', 30, 3 );
}

if ( ! vendidero_helper_activated() && ! function_exists( 'vendidero_helper_notice' ) ) {

	function vendidero_helper_notice( $inline = false ) {
		$prefix = '';

		if ( is_multisite() && is_network_admin() ) {
			$prefix = 'network/';
		}

		$slug         = 'vendidero-helper';
		$install_url  = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $slug ), 'install-plugin_' . $slug );
		$activate_url = $prefix . 'plugins.php?action=activate&plugin=' . rawurlencode( 'vendidero-helper/vendidero-helper.php' ) . '&plugin_status=all&paged=1&s&_wpnonce=' . rawurlencode( wp_create_nonce( 'activate-plugin_vendidero-helper/vendidero-helper.php' ) );

		$message = wp_kses_post( sprintf( __( '%1$sInstall the vendidero helper plugin%2$s to benefit from easy updates and access to our legal text API.', 'woocommerce-germanized-pro' ), '<a href="' . esc_url( $install_url ) . '">', '</a>' ) );
		$plugins = array_keys( get_plugins() );

		if ( in_array( 'vendidero-helper/vendidero-helper.php', $plugins, true ) ) {
			$message = wp_kses_post( sprintf( __( '%1$sActivate the vendidero helper plugin%2$s to benefit from easy updates and access to our legal text API.', 'woocommerce-germanized-pro' ), '<a href="' . esc_url( admin_url( $activate_url ) ) . '">', '</a>' ) );
		}

		if ( $inline ) {
			return $message;
		}

		echo '<div class="updated fade"><p>' . $message . '</p></div>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	if ( is_multisite() ) {
		add_action( 'network_admin_notices', 'vendidero_helper_notice' );
	} else {
		add_action( 'admin_notices', 'vendidero_helper_notice' );
	}
}

