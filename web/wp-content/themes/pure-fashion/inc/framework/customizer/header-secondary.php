<?php
$wp_customize->add_section(
	'purefashion_headersecondary',
	array(
		'title' => esc_html__( 'Header - Secondary Area', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);
$wp_customize->add_setting(
	'header_search',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'header_search',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_headersecondary',
			'settings' => 'header_search',
			'label'    => esc_html__( 'Display Search?', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);

$wp_customize->add_setting(
	'header_menu',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'header_menu',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_headersecondary',
			'settings' => 'header_menu',
			'label'    => esc_html__( 'Display Secondary Menu?', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);
