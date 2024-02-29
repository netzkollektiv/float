<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class WC_GZDP_Elementor_Widget_Helper {

	public static function register_controls( $widget ) {
		$widget->add_responsive_control(
			'text_align',
			array(
				'label'     => __( 'Alignment', 'woocommerce-germanized-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'woocommerce-germanized-pro' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'woocommerce-germanized-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'woocommerce-germanized-pro' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}}',
				),
			)
		);

		$widget->add_control(
			'notice_color',
			array(
				'label'     => __( 'Color', 'woocommerce-germanized-pro' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => class_exists( '\Elementor\Core\Schemes\Color' ) ? \Elementor\Core\Schemes\Color::get_type() : \Elementor\Scheme_Color::get_type(),
					'value' => class_exists( '\Elementor\Core\Schemes\Color' ) ? \Elementor\Core\Schemes\Color::COLOR_1 : \Elementor\Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}}' => 'color: {{VALUE}}',
				),
			)
		);

		$widget->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'scheme'   => class_exists( '\Elementor\Core\Schemes\Typography' ) ? \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1 : \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}}',
			)
		);
	}

	public static function render( $product, $widget ) {
		$html = do_shortcode( '[gzd_product_' . $widget->get_postfix() . ']' );

		if ( empty( trim( $html ) ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			if ( is_callable( array( $widget, 'get_preview_content' ) ) ) {
				$html = $widget->get_preview_content();
			}
		}

		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
