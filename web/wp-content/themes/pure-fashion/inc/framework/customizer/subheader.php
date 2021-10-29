<?php
$wp_customize->add_section(
	'purefashion_subheader',
	array(
		'title' => esc_html__( 'Sub-Header', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);
$wp_customize->add_setting(
	'subheader',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'subheader',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_subheader',
			'settings' => 'subheader',
			'label'    => esc_html__( 'Display Sub-Header?', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);
	$wp_customize->add_setting(
		'subheader_content',
		array(
			'default' => wp_kses_post( 'Free Tracked Shipping Worldwide On Orders Over $30' ),
		)
	);
	$wp_customize->add_control(
		'subheader_content',
		array(
			'type'              => 'text',
			'section'           => 'purefashion_subheader',
			'settings'          => 'subheader_content',
			'label'             => esc_html__( 'Sub-Header Text', 'pure-fashion' ),
			'default'           => wp_kses_post( 'Free Tracked Shipping Worldwide On Orders Over $30' ),
			'sanitize_callback' => 'wp_kses_post',
		)
	);
