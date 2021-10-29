<?php

$wp_customize->add_section(
	'purefashion_mobilemenu',
	array(
		'title' => esc_html__( 'Mobile Menu', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);

$wp_customize->add_setting(
	'mobile_menu_search',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'mobile_menu_search',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_mobilemenu',
			'settings' => 'mobile_menu_search',
			'label'    => esc_html__( 'Display Search?', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);

$wp_customize->add_setting(
	'mobile_menu_footer',
	array(
		'default' => false,
	)
);
$wp_customize->add_control(
	new THB_TinyMCE_Custom_Control(
		$wp_customize,
		'pure-fashion',
		array(
			'type'     => 'editor',
			'section'  => 'purefashion_mobilemenu',
			'settings' => 'mobile_menu_footer',
			'label'    => esc_html__( 'Mobile Menu Footer Content', 'pure-fashion' ),
		)
	)
);
