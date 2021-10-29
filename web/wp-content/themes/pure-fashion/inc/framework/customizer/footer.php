<?php

$wp_customize->add_section(
	'purefashion_footer',
	array(
		'title' => esc_html__( 'Footer', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);

$wp_customize->add_setting(
	'footer',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'footer',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_footer',
			'settings' => 'footer',
			'label'    => esc_html__( 'Display Footer?', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);

$wp_customize->add_setting(
	'footer_columns',
	array(
		'default' => 'fivelargeleftcolumns',
	)
);
$wp_customize->add_control(
	new THB_Image_Radio_Button_Custom_Control(
		$wp_customize,
		'footer_columns',
		array(
			'type'     => 'radio-image',
			'settings' => 'footer_columns',
			'label'    => esc_html__( 'Footer Columns', 'pure-fashion' ),
			'section'  => 'purefashion_footer',
			'default'  => 'fivelargeleftcolumns',
			'priority' => 10,
			'choices'  => array(
				'onecolumns'               => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/one-columns.png',
					'name'  => esc_html__( 'One Column', 'pure-fashion' ),
				),
				'twocolumns'               => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/two-columns.png',
					'name'  => esc_html__( 'Two Columns', 'pure-fashion' ),
				),
				'threecolumns'             => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/three-columns.png',
					'name'  => esc_html__( 'Three Columns', 'pure-fashion' ),
				),
				'fourcolumns'              => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/four-columns.png',
					'name'  => esc_html__( 'Four Columns', 'pure-fashion' ),
				),
				'doubleleft'               => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/doubleleft-columns.png',
					'name'  => esc_html__( 'Double Left Columns', 'pure-fashion' ),
				),
				'doubleright'              => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/doubleright-columns.png',
					'name'  => esc_html__( 'Double Right Columns', 'pure-fashion' ),
				),
				'fivecolumns'              => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/five-columns.png',
					'name'  => esc_html__( 'Five Columns', 'pure-fashion' ),
				),
				'sixcolumns'               => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/six-columns.png',
					'name'  => esc_html__( 'Six Columns', 'pure-fashion' ),
				),
				'fivelargerightcolumns'    => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/five-columns-large-right.png',
					'name'  => esc_html__( 'Five / Large Right Columns', 'pure-fashion' ),
				),
				'fivelargeleftcolumns'     => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/five-columns-large-left.png',
					'name'  => esc_html__( 'Five / Large Left Columns', 'pure-fashion' ),
				),
				'fivelargerightcolumnsalt' => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/five-columns-large-right2.png',
					'name'  => esc_html__( 'Five / Large 2 Right Columns', 'pure-fashion' ),
				),
				'fivelargeleftcolumnsalt'  => array(
					'image' => get_template_directory_uri() . '/assets/img/admin/columns/five-columns-large-left2.png',
					'name'  => esc_html__( 'Five / Large 2 Left Columns', 'pure-fashion' ),
				),
			),
		)
	)
);
