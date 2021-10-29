<?php

$wp_customize->add_section(
	'purefashion_article',
	array(
		'title' => esc_html__( 'Article', 'pure-fashion' ),
		'panel' => 'pure-fashion',
	)
);

$wp_customize->add_setting(
	'article_author_name',
	array(
		'default' => 1,
	)
);

$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'article_author_name',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_article',
			'settings' => 'article_author_name',
			'label'    => esc_html__( 'Author Name', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);

$wp_customize->add_setting(
	'article_date',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'article_date',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_article',
			'settings' => 'article_date',
			'label'    => esc_html__( 'Article Date', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);

$wp_customize->add_setting(
	'article_cat',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'article_cat',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_article',
			'settings' => 'article_cat',
			'label'    => esc_html__( 'Article Category', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);

$wp_customize->add_setting(
	'article_nav',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'article_nav',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_article',
			'settings' => 'article_nav',
			'label'    => esc_html__( 'Article Navigation', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);

$wp_customize->add_setting(
	'article_tags',
	array(
		'default' => 1,
	)
);
$wp_customize->add_control(
	new THB_Toggle_Switch_Custom_Control(
		$wp_customize,
		'article_tags',
		array(
			'type'     => 'switch',
			'section'  => 'purefashion_article',
			'settings' => 'article_tags',
			'label'    => esc_html__( 'Article Tags', 'pure-fashion' ),
			'default'  => 1,
		)
	)
);
