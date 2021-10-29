<?php
$wp_customize->add_section(
	'purefashion_header',
	array(
		'title' => esc_html__( 'Header', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);

$wp_customize->add_setting(
	'logo_height',
	array(
		'default' => '14px',
	)
);
$wp_customize->add_control(
	'logo_height',
	array(
		'type'     => 'dimension',
		'section'  => 'purefashion_header',
		'settings' => 'logo_height',
		'label'    => esc_html__( 'Logo Height', 'pure-fashion' ),
		'default'  => '14px',
	)
);

$wp_customize->add_setting(
	'logo_height_mobile',
	array(
		'default' => '14px',
	)
);
$wp_customize->add_control(
	'logo_height_mobile',
	array(
		'type'     => 'dimension',
		'section'  => 'purefashion_header',
		'settings' => 'logo_height_mobile',
		'label'    => esc_html__( 'Logo Height - Mobile', 'pure-fashion' ),
		'default'  => '14px',
	)
);

$wp_customize->add_setting(
	'fixed_header_shadow',
	array(
		'default' => 'thb-fixed-shadow-style1',
	)
);
$wp_customize->add_control(
	'pure-fashion',
	array(
		'type'     => 'select',
		'section'  => 'purefashion_header',
		'settings' => 'fixed_header_shadow',
		'label'    => esc_html__( 'Fixed Header - Shadow', 'pure-fashion' ),
		'default'  => 'thb-fixed-shadow-style1',
		'multiple' => 0,
		'choices'  => array(
			'thb-fixed-noshadow'      => 'None',
			'thb-fixed-shadow-style1' => 'Small',
			'thb-fixed-shadow-style2' => 'Medium',
			'thb-fixed-shadow-style3' => 'Large',
		),
	)
);
