<?php

$wp_customize->add_section(
	'purefashion_blog',
	array(
		'title' => esc_html__( 'Blog', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);

$wp_customize->add_setting(
	'post_meta_date',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'post_meta_date',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_blog',
			'settings' => 'post_meta_date',
			'label'    => esc_html__( 'Post Date', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);

$wp_customize->add_setting(
	'post_meta_excerpt',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'post_meta_excerpt',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_blog',
			'settings' => 'post_meta_excerpt',
			'label'    => esc_html__( 'Post Excerpt', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);

$wp_customize->add_setting(
	'post_meta_cat',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'post_meta_cat',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_blog',
			'settings' => 'post_meta_cat',
			'label'    => esc_html__( 'Post Category', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);
