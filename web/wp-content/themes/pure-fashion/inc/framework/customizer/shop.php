<?php

$wp_customize->add_section(
	'purefashion_shop',
	array(
		'title' => esc_html__( 'Shop', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);

$wp_customize->add_setting(
	'shop_products_per_page',
	array(
		'default' => 14,
	)
);
$wp_customize->add_control(
	'shop_products_per_page',
	array(
		'type'        => 'number',
		'section'     => 'purefashion_shop',
		'settings'    => 'shop_products_per_page',
		'label'       => esc_html__( 'Products Per Page', 'pure-fashion' ),
		'description' => esc_html__( 'Set number of products per page.', 'pure-fashion' ),
		'default'     => 14,
		'choices'     => array(
			'min'  => 1,
			'max'  => 99,
			'step' => 1,
		),
	)
);

$wp_customize->add_setting(
	'shop_description',
	array(
		'default' => '',
	)
);
$wp_customize->add_control(
	'shop_description',
	array(
		'type'              => 'textarea',
		'section'           => 'purefashion_shop',
		'settings'          => 'shop_description',
		'label'             => esc_html__( 'Shop Description', 'pure-fashion' ),
		'description'       => esc_html__( 'Displays on main shop page, similar to product category descriptions.', 'pure-fashion' ),
		'sanitize_callback' => 'wp_kses_post',
	)
);

$wp_customize->add_setting(
	'shop_product_doublesize',
	array(
		'default' => 0,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'shop_product_doublesize',
		array(
			'type'        => 'switch',
			'section'     => 'purefashion_shop',
			'settings'    => 'shop_product_doublesize',
			'label'       => esc_html__( 'Show Double Width Images?', 'pure-fashion' ),
			'description' => esc_html__( 'When enabled, some products will be double width.', 'pure-fashion' ),
			'default'     => 0,
		)
	)
);

$wp_customize->add_setting(
	'shop_product_doublesize_index',
	array(
		'default' => '3,8',
	)
);
$wp_customize->add_control(
	'shop_product_doublesize_index',
	array(
		'type'        => 'text',
		'section'     => 'purefashion_shop',
		'settings'    => 'shop_product_doublesize_index',
		'label'       => esc_html__( 'Double Size Image Position', 'pure-fashion' ),
		'description' => esc_html__( 'For example, for third and eighth products to be double-width, enter: 3,8.', 'pure-fashion' ),
		'default'     => '3,8',
	)
);

$wp_customize->add_setting(
	'single_product_ajax',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'single_product_ajax',
		array(
			'type'        => 'switch',
			'section'     => 'purefashion_shop',
			'settings'    => 'single_product_ajax',
			'label'       => esc_html__( 'Single Product Ajax', 'pure-fashion' ),
			'description' => esc_html__( 'When enabled, add to cart functionality will use AJAX on single product pages.', 'pure-fashion' ),
			'default'     => 1,
		)
	)
);
