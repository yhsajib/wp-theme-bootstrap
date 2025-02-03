<?php

$uri = get_template_directory_uri() . '/inc/admin/demo-data/demo-imgs/';
$yhsshu_server_info = apply_filters( 'yhsshu_server_info', ['demo_url' => ''] ) ;
// Demos
$demos = array(
	// Elementor Demos
	'yhsshu-main' => array(
		'title'       => 'Main',
		'description' => '',
		'screenshot'  => $uri . 'main.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'main',
	),
	'yhsshu-luxury' => array(
		'title'       => 'Luxury',
		'description' => '',
		'screenshot'  => $uri . 'luxury.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'luxury',
	),
	'yhsshu-coffee' => array(
		'title'       => 'Coffee',
		'description' => '',
		'screenshot'  => $uri . 'coffee.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'coffee',
	),
	'yhsshu-pizza' => array(
		'title'       => 'Pizza',
		'description' => '',
		'screenshot'  => $uri . 'pizza.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'pizza',
	),
	'yhsshu-fastfood' => array(
		'title'       => 'Fastfood',
		'description' => '',
		'screenshot'  => $uri . 'fastfood.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'fastfood',
	),
	'yhsshu-sushi' => array(
		'title'       => 'Sushi',
		'description' => '',
		'screenshot'  => $uri . 'sushi.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'sushi',
	),
	'yhsshu-cream' => array(
		'title'       => 'Ice Cream',
		'description' => '',
		'screenshot'  => $uri . 'cream.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'icecream',
	),
	'yhsshu-seafood' => array(
		'title'       => 'Seafood',
		'description' => '',
		'screenshot'  => $uri . 'seafood.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'seafood',
	),
	'yhsshu-steak' => array(
		'title'       => 'Steak House',
		'description' => '',
		'screenshot'  => $uri . 'steak.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'steak',
	),
	'yhsshu-chocolate' => array(
		'title'       => 'Chocolate',
		'description' => '',
		'screenshot'  => $uri . 'chocolate.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'chocolate',
	),
	'yhsshu-chinafood' => array(
		'title'       => 'Chinafood',
		'description' => '',
		'screenshot'  => $uri . 'chinafood.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'chinafood',
	),
	'yhsshu-bakery' => array(
		'title'       => 'Bakery',
		'description' => '',
		'screenshot'  => $uri . 'bakery.jpg',
		'preview'     => $yhsshu_server_info['demo_url'] . 'bakery',
	),
);