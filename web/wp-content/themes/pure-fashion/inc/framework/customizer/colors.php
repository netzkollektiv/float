<?php

$wp_customize->add_section(
	'purefashion_colors',
	array(
		'title' => esc_html__( 'Color', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);

$wp_customize->add_setting(
	'accent_color',
	array(
		'default' => '',
	)
);
$wp_customize->add_control(
	new THB_Customize_Alpha_Color_Control(
		$wp_customize,
		'accent_color',
		array(
			'type'         => 'color',
			'section'      => 'purefashion_colors',
			'settings'     => 'accent_color',
			'label'        => esc_html__( 'Accent Color', 'pure-fashion' ),
			'show_opacity' => true,
		)
	)
);
