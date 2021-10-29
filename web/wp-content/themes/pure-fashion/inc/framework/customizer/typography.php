<?php
$wp_customize->add_section(
	'purefashion_typography',
	array(
		'title' => esc_html__( 'Typography', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);

$wp_customize->add_setting(
	'primary_typography',
	array(
		'default' => '{"font":"Cormorant Garamond","regularweight":"regular","italicweight":"italic","boldweight":"500","category":"serif"}',
	)
);
$wp_customize->add_control(
	new THB_Google_Font_Select_Custom_Control(
		$wp_customize,
		'primary_typography',
		array(
			'type'        => 'typography',
			'section'     => 'purefashion_typography',
			'settings'    => 'primary_typography',
			'label'       => esc_html__( 'Primary Font', 'pure-fashion' ),
			'description' => esc_html__( 'Changes primarily heading tags', 'pure-fashion' ),
			'input_attrs' => array(
				'font_count' => 'all',
				'orderby'    => 'alpha',
			),
			'transport'   => 'auto',
		)
	)
);

$wp_customize->add_setting(
	'secondary_typography',
	array(
		'default' => '{"font":"Jost","regularweight":"regular","italicweight":"italic","boldweight":"600","category":"sans-serif"}',
	)
);
$wp_customize->add_control(
	new THB_Google_Font_Select_Custom_Control(
		$wp_customize,
		'secondary_typography',
		array(
			'type'        => 'typography',
			'section'     => 'purefashion_typography',
			'settings'    => 'secondary_typography',
			'label'       => esc_html__( 'Secondary Font', 'pure-fashion' ),
			'description' => esc_html__( 'Changes primarily body text', 'pure-fashion' ),
			'input_attrs' => array(
				'font_count' => 'all',
				'orderby'    => 'alpha',
			),
			'transport'   => 'auto',
		)
	)
);
