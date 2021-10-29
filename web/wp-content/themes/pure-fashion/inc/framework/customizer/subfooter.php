<?php

$wp_customize->add_section(
	'purefashion_subfooter',
	array(
		'title' => esc_html__( 'Sub-Footer', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);

$wp_customize->add_setting(
	'subfooter',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'subfooter',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_subfooter',
			'settings' => 'subfooter',
			'label'    => esc_html__( 'Display Sub-Footer?', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);

$wp_customize->add_setting(
	'copyright_text',
	array(
		'default' => wp_kses_post( '© 2020 <a href="https://fuelthemes.net" target="_blank" title="Premium WordPress Themes">Premium WordPress Themes</a>' ),
	)
);
$wp_customize->add_control(
	new THB_TinyMCE_Custom_Control(
		$wp_customize,
		'copyright_text',
		array(
			'type'     => 'text',
			'section'  => 'purefashion_subfooter',
			'settings' => 'copyright_text',
			'label'    => esc_html__( 'Copyright Text', 'pure-fashion' ),
			'default'  => wp_kses_post( '© 2020 <a href="https://fuelthemes.net" target="_blank" title="Premium WordPress Themes">Premium WordPress Themes</a>' ),
		)
	)
);

$wp_customize->add_setting(
	'subfooter_right_text',
	array(
		'default' => wp_kses_post( '<a href="https://fuelthemes.net" target="_blank" title="Premium WordPress Themes">Premium WordPress Themes</a>' ),
	)
);
$wp_customize->add_control(
	new THB_TinyMCE_Custom_Control(
		$wp_customize,
		'subfooter_right_text',
		array(
			'type'     => 'editor',
			'section'  => 'purefashion_subfooter',
			'settings' => 'subfooter_right_text',
			'label'    => esc_html__( 'Text on the right', 'pure-fashion' ),
			'default'  => wp_kses_post( '© 2020 <a href="https://fuelthemes.net" target="_blank" title="Premium WordPress Themes">Premium WordPress Themes</a>' ),
		)
	)
);
