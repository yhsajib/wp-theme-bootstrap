<?php

function yhsshu_product_style_layout_4() {
    $product_layout = yhsshu()->get_theme_opt('product_layout', 'layout-1');
    if ($product_layout == 'layout-4')
        return array(
            'id'          => 'product_layout_style',
            'type'        => 'image_select',
            'title'       => esc_html__( 'Image Style', 'yhsshu' ),
            'description' => esc_html__('Use for Shop Layout 4 Shop Page', 'yhsshu'),
            'options'      => array(
                'style-df' => array(
                    'alt' => 'Style 1',
                    'img' => get_template_directory_uri() . '/assets/images/pizza-layout/pizza-df.jpg'
                ),
                'style-2' => array(
                    'alt' => 'Style 2',
                    'img' => get_template_directory_uri() . '/assets/images/pizza-layout/pizza-style-2.jpg'
                ),
            ),
            'default' => 'style-df'
        );
    return array();
}

add_action( 'yhsshu_post_metabox_register', 'yhsshu_page_options_register' );
function yhsshu_page_options_register( $metabox ) {
	$panels = [
		'post' => [
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'yhsshu' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'post_settings' => [
					'title'  => esc_html__( 'Post Settings', 'yhsshu' ),
					'icon'   => 'el el-refresh',
					'fields' => array_merge(
                        array(
                            array(
                                'id'       => 'single_post_layout',
                                'type'     => 'select',
                                'title'    => esc_html__('Select Post Layout', 'yhsshu'),
                                'options'  => array(
                                    '-1'  => esc_html__('Inherit', 'yhsshu'),
                                    'layout-1' => esc_html__('Layout 1', 'yhsshu'),
                                    'layout-2' => esc_html__('Layout 2', 'yhsshu'),
                                    'layout-3' => esc_html__('Layout 3', 'yhsshu'),
                                    'layout-4' => esc_html__('Layout 4', 'yhsshu'),
                                    'layout-5' => esc_html__('Layout 5', 'yhsshu'),
                                    'layout-6' => esc_html__('Layout 6', 'yhsshu'),
                                    'layout-7' => esc_html__('Layout 7', 'yhsshu'),
                                    'layout-8' => esc_html__('Layout 8', 'yhsshu'),
                                    'layout-9' => esc_html__('Layout 9', 'yhsshu'),
                                    'layout-10' => esc_html__('Layout 10', 'yhsshu'),
                                    'layout-11' => esc_html__('Layout 10', 'yhsshu'),
                                ),
                                'default'  => '-1'
                            ),
                        ),
                        yhsshu_sidebar_pos_opts(['prefix' => 'post_', 'default' => true, 'default_value' => '-1']),
                        yhsshu_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '!=', 'none' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '!=', 'none' )
                            )
                        ),
                        array(
                            array(
                                'id'          => 'post_share_count',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Post Share Number', 'yhsshu' ),
                                'description' => esc_html__( 'Edit post number share. This add 1 when click on post social share button.', 'yhsshu' ),
                                'validate'    => 'numeric',
                                'msg'         => esc_html__('This must be a number!', 'yhsshu'),
                            ),
                        ),
                        array(
                            array(
                                'id'          => 'featured-video-url',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Video URL', 'yhsshu' ),
                                'description' => esc_html__( 'Video will show when set post format is video', 'yhsshu' ),
                                'validate'    => 'url',
                                'msg'         => 'Url error!',
                            ),
                            array(
                                'id'          => 'featured-audio-url',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Audio URL', 'yhsshu' ),
                                'description' => esc_html__( 'Audio that will show when set post format is audio', 'yhsshu' ),
                                'validate'    => 'url',
                                'msg'         => 'Url error!',
                            ),
                            array(
                                'id'        =>'featured-quote-text',
                                'type'      => 'textarea',
                                'title'     => esc_html__('Quote Text', 'yhsshu'),
                                'default'   => '',
                            ),
                            array(
                                'id'          => 'featured-quote-cite',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Quote Cite', 'yhsshu' ),
                                'description' => esc_html__( 'Quote will show when set post format is quote', 'yhsshu' ),
                            ),
                            array(
                                'id'       => 'featured-link-url',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Format Link URL', 'yhsshu' ),
                                'description' => esc_html__( 'Link will show when set post format is link', 'yhsshu' ),
                            ),
                            array(
                                'id'          => 'featured-link-text',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Format Link Text', 'yhsshu' ),
                            ),
                            array(
                                'id'          => 'featured-link-cite',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Format Link Cite', 'yhsshu' ),
                            ),
                        )
                    )
                ]
            ]
        ],
        'page' => [
            'opt_name'            => 'yhsshu_page_options',
            'display_name'        => esc_html__( 'Page Settings', 'yhsshu' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'header' => [
                    'title'  => esc_html__( 'Header', 'yhsshu' ),
                    'icon'   => 'el-icon-website',
                    'fields' => array_merge(
                        yhsshu_header_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'       => 'disable_header',
                                'title'    => esc_html__('Disable Header', 'yhsshu'),
                                'subtitle' => esc_html__('Header will not display.', 'yhsshu'),
                                'type'     => 'button_set',
                                'options'  => array(
                                    '1'  => esc_html__('Yes','yhsshu'),
                                    '0'  => esc_html__('No','yhsshu'),
                                ),
                                'default'  => '0',
                            ),
                        ),
                        array(
                            array(
                                'id'       => 'pd_menu',
                                'type'     => 'select',
                                'title'    => esc_html__( 'Desktop Menu', 'yhsshu' ),
                                'options'  => yhsshu_get_nav_menu_slug(),
                                'default' => '-1',
                            ),
                            array(
                                'id'       => 'pm_menu',
                                'type'     => 'select',
                                'title'    => esc_html__( 'Mobile Menu', 'yhsshu' ),
                                'options'  => yhsshu_get_nav_menu_slug(),
                                'default' => '-1',
                            ),
                        )
                    )
                ],
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'yhsshu' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        yhsshu_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )
                ],
                'content' => [
                    'title'  => esc_html__( 'Content', 'yhsshu' ),
                    'icon'   => 'el-icon-pencil',
                    'fields' => array_merge(
                        yhsshu_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
                        array(
                            array(
                                'id'             => 'content_padding',
                                'type'           => 'spacing',
                                'output'         => array( '#yhsshu-main' ),
                                'right'          => false,
                                'left'           => false,
                                'mode'           => 'padding',
                                'units'          => array( 'px' ),
                                'units_extended' => 'false',
                                'title'          => esc_html__( 'Content Padding', 'yhsshu' ),
                                'default'        => array(
                                   'padding-top'    => '',
                                   'padding-bottom' => '',
                                   'units'          => 'px',
                                )
                            ),
                            array(
                                'id'       => 'content_bg_color',
                                'type'     => 'color_rgba',
                                'title'    => esc_html__( 'Background Color', 'yhsshu' ),
                                'subtitle' => esc_html__( 'Content background color.', 'yhsshu' ),
                                'output'   => array( 'background-color' => 'body' )
                            ),
                        )  
                    )
                ],
               'footer' => [
                   'title'  => esc_html__( 'Footer', 'yhsshu' ),
                   'icon'   => 'el el-website',
                   'fields' => array_merge(
                        yhsshu_footer_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'       => 'disable_footer',
                                'title'    => esc_html__('Disable Footer', 'yhsshu'),
                                'subtitle' => esc_html__('Footer will not display.', 'yhsshu'),
                                'type'     => 'button_set',
                                'options'  => array(
                                    '1'  => esc_html__('Yes','yhsshu'),
                                    '0'  => esc_html__('No','yhsshu'),
                                ),
                                'default'  => '0',
                            ),
                        ),
                    )
               ],
               'colors' => [
                   'title'  => esc_html__( 'Colors', 'yhsshu' ),
                   'icon'   => 'el el-website',
                   'fields' => array(
                        array(
                            'id'          => 'primary_color',
                            'type'        => 'color',
                            'title'       => esc_html__('Primary Color', 'yhsshu'),
                            'transparent' => false,
                            'default'     => ''
                        ), 
                        array(
                            'id'          => 'secondary_color',
                            'type'        => 'color',
                            'title'       => esc_html__('Secondary Color', 'yhsshu'),
                            'transparent' => false,
                            'default'     => ''
                        ),
                    )
                ]
            ]
        ],
		'product' => [ //product
            'opt_name'            => 'yhsshu_product_options',
            'display_name'        => esc_html__( 'Product Settings', 'yhsshu' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'yhsshu' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        yhsshu_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )
                ],
                'general' => [
                    'title'  => esc_html__( 'General', 'yhsshu' ),
                    'icon'   => 'el-icon-website',
                    'fields' => array_merge(
                        array(
                            array(
                                'id'       => 'gallery_layout',
                                'type'     => 'button_set',
                                'title'    => esc_html__('Single Gallery', 'yhsshu'),
                                'options'  => array(
                                    'simple' => esc_html__('Simple', 'yhsshu'),
                                    'horizontal' => esc_html__('Horizontal', 'yhsshu'),
                                    'vertical' => esc_html__('Vertical', 'yhsshu'),
                                ),
                                'default'  => 'simple'
                            ),
                            array(
                                'id'=> 'product_feature_text',
                                'type' => 'text',
                                'title' => esc_html__('Featured Text 01', 'yhsshu'),
                                'default' => '',
                            ),
                            array(
                                'id'          => 'feature_color_01',
                                'type'        => 'color_gradient',
                                'title'       => esc_html__('Featured Color 01', 'yhsshu'),
                                'transparent' => false,
                                'gradient-angle' => true,
                                'default'  => array(
                                    'from' => '#673AB7',
                                    'to'   => '#973BF5',
                                    'gradient-angle' => 180,
                                ),
                                'required' => array( 'product_feature_text', '!=', '' )
                            ),
                            array(
                                'id'=> 'product_feature_text_02',
                                'type' => 'text',
                                'title' => esc_html__('Featured Text 02', 'yhsshu'),
                                'default' => '',
                            ),
                            array(
                                'id'          => 'feature_color_02',
                                'type'        => 'color_gradient',
                                'title'       => esc_html__('Featured Color 02', 'yhsshu'),
                                'transparent' => false,
                                'gradient-angle' => true,
                                'default'  => array(
                                    'from' => '#a90001',
                                    'to'   => '#ed2b2c',
                                    'gradient-angle' => 0,
                                ),
                                'required' => array( 'product_feature_text_02', '!=', '' )
                            ),
                            array(
                                'id'=> 'product_loop_additional_text1',
                                'type' => 'text',
                                'title' => esc_html__('Additional Text', 'yhsshu'),
                                'default' => esc_html('220gr / 600 cal', 'yhsshu'),
                                'description' => esc_html('Use for Shop Layout 3', 'yhsshu')
                            ),
                            yhsshu_product_style_layout_4()
                        )
                    ),
                ],
            ],
        ],
    	'yhsshu-portfolio' => [ //post_type
            'opt_name'            => 'yhsshu_portfolio_options',
            'display_name'        => esc_html__( 'Page Settings', 'yhsshu' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'yhsshu' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        yhsshu_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )
                ],
                'content' => [
                    'title'  => esc_html__( 'Content', 'yhsshu' ),
                    'icon'   => 'el-icon-pencil',
                    'fields' => array_merge(
                        array(
                            array(
                                'id'             => 'content_padding',
                                'type'           => 'spacing',
                                'output'         => array( '#yhsshu-main' ),
                                'right'          => false,
                                'left'           => false,
                                'mode'           => 'padding',
                                'units'          => array( 'px' ),
                                'units_extended' => 'false',
                                'title'          => esc_html__( 'Content Padding', 'yhsshu' ),
                                'default'        => array(
                                    'padding-top'    => '',
                                    'padding-bottom' => '',
                                    'units'          => 'px',
                                )
                            ),
                            array(
                                'id'       => 'title_tag_on',
                                'title'    => esc_html__('Title & Tags', 'yhsshu'),
                                'subtitle' => esc_html__('Display the Title & Tags at top of post.', 'yhsshu'),
                                'type'     => 'switch',
                                'default'  => '0'
                            ),
                        )
                    )
                ],
                'additional_data' => [
                    'title'  => esc_html__( 'Additional Data', 'yhsshu' ),
                    'icon'   => 'el el-list-alt',
                    'fields' => array(
                        array(
                            'id'           => 'custom_text_portfolio',
                            'type'         => 'text',
                            'title'        => esc_html__( 'Custom Text', 'yhsshu' ),
                            'default'      => esc_html__('', 'yhsshu'),
                        ),

                    ),

                ],
            ],
        ],
        'yhsshu-service' => [ //post_type
            'opt_name'            => 'yhsshu_service_options',
            'display_name'        => esc_html__( 'Page Settings', 'yhsshu' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'yhsshu' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        yhsshu_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )
                ],
                'content' => [
                    'title'  => esc_html__( 'Content', 'yhsshu' ),
                    'icon'   => 'el-icon-pencil',
                    'fields' => array_merge(
                        array(
                            array(
                                'id'             => 'content_padding',
                                'type'           => 'spacing',
                                'output'         => array( '#yhsshu-main' ),
                                'right'          => false,
                                'left'           => false,
                                'mode'           => 'padding',
                                'units'          => array( 'px' ),
                                'units_extended' => 'false',
                                'title'          => esc_html__( 'Content Padding', 'yhsshu' ),
                                'default'        => array(
                                    'padding-top'    => '',
                                    'padding-bottom' => '',
                                    'units'          => 'px',
                                )
                            ),
                        )
                    )
                ],
                'additional_data' => [
                    'title'  => esc_html__( 'Additional Data', 'yhsshu' ),
                    'icon'   => 'el el-list-alt',
                    'fields' => array(
                        array(
                            'id'       => 'area_icon_type',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Icon Type', 'yhsshu'),
                            'desc'     => esc_html__( 'This image icon will display in post grid or carousel', 'yhsshu' ),
                            'options'  => array(
                                'icon'  => esc_html__('Icon', 'yhsshu'),
                                'image'  => esc_html__('Image', 'yhsshu'),
                            ),
                            'default'  => 'image'
                        ),
                        array(
                            'id'       => 'area_icon',
                            'type'     => 'yhsshu_iconpicker',
                            'title'    => esc_html__( 'Select Icon', 'yhsshu' ),
                            'default'  => '',
                            'required' => array( 0 => 'area_icon_type', 1 => 'equals', 2 => 'icon' ),
                        ),
                        array(
                            'id'       => 'area_img',
                            'type'     => 'media',
                            'title'    => esc_html__('Select Image', 'yhsshu'),
                            'default' => '',
                            'required' => array( 0 => 'area_icon_type', 1 => 'equals', 2 => 'image' ),
                            'force_output' => true
                        ),
                    ),
                ],
            ],            
        ],
        'yhsshu-food' => [ //post_type
            'opt_name'            => 'yhsshu_food_options',
            'display_name'        => esc_html__( 'Page Settings', 'yhsshu' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'yhsshu' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        yhsshu_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'yhsshu' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'yhsshu' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )
                ],
                'content' => [
                    'title'  => esc_html__( 'Content', 'yhsshu' ),
                    'icon'   => 'el-icon-pencil',
                    'fields' => array_merge(
                        array(
                            array(
                                'id'             => 'content_padding',
                                'type'           => 'spacing',
                                'output'         => array( '#yhsshu-main' ),
                                'right'          => false,
                                'left'           => false,
                                'mode'           => 'padding',
                                'units'          => array( 'px' ),
                                'units_extended' => 'false',
                                'title'          => esc_html__( 'Content Padding', 'yhsshu' ),
                                'default'        => array(
                                    'padding-top'    => '',
                                    'padding-bottom' => '',
                                    'units'          => 'px',
                                )
                            ),
                            array(
                                'id'       => 'title_tag_on',
                                'title'    => esc_html__('Title & Tags', 'yhsshu'),
                                'subtitle' => esc_html__('Display the Title & Tags at top of post.', 'yhsshu'),
                                'type'     => 'switch',
                                'default'  => '0'
                            ),
                        )
                    )
                ],
                'additional_data' => [
                    'title'  => esc_html__( 'Additional Data', 'yhsshu' ),
                    'icon'   => 'el el-list-alt',
                    'fields' => array(
                        array(
                            'id'           => 'custom_text_food',
                            'type'         => 'text',
                            'title'        => esc_html__( 'Custom Text', 'yhsshu' ),
                        ),

                    ),

                ],
            ],
        ],
    	'yhsshu-template' => [ //post_type
            'opt_name'            => 'yhsshu_hidden_template_options',
            'display_name'        => esc_html__( 'Template Settings', 'yhsshu' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'general' => [
                    'title'  => esc_html__( 'General', 'yhsshu' ),
                    'icon'   => 'el-icon-website',
                    'fields' => array(
                        array(
                            'id'    => 'template_type',
                            'type'  => 'select',
                            'title' => esc_html__('Template Type', 'yhsshu'),
                            'options' => [
                                'default'      => esc_html__('Default', 'yhsshu'),
                                'header'       => esc_html__('Header', 'yhsshu'),
                                'header-mobile'       => esc_html__('Header Mobile', 'yhsshu'),
                                'footer'       => esc_html__('Footer', 'yhsshu'),
                                'mega-menu'    => esc_html__('Mega Menu', 'yhsshu'),
                                'page-title'   => esc_html__('Page Title', 'yhsshu'),
                                'hidden-panel' => esc_html__('Hidden Panel', 'yhsshu'),
                            ],
                            'default' => 'default',
                        ),
                        array(
                            'id'       => 'template_position',
                            'type'     => 'select',
                            'title'    => esc_html__('Hidden Panel Position', 'yhsshu'),
                            'options'  => [
                                'full' => esc_html__('Full Screen', 'yhsshu'),
                                'top'   => esc_html__('Top Position', 'yhsshu'),
                                'left'   => esc_html__('Left Position', 'yhsshu'),
                                'long-left'   => esc_html__('Long Left Position', 'yhsshu'),
                                'right'  => esc_html__('Right Position', 'yhsshu'),
                                'center'  => esc_html__('Center Position', 'yhsshu'),
                            ],
                            'default'  => 'full',
                            'required' => [ 'template_type', '=', 'hidden-panel']
                        ),
                        array(
                            'id'      => 'template_close_select',
                            'type'    => 'select',
                            'title'   => esc_html__('Close Button Style', 'yhsshu'),
                            'options'  => array(
                                'theme-opt'         => esc_html('Inherit From Theme Options', 'yhsshu'),
                                'none'      => esc_html('Hidden', 'yhsshu'),
                                'custom'      => esc_html('Custom Style', 'yhsshu'),
                            ),
                            'default' => 'theme-opt'
                        ),
                        array(
                            'id'      => 'template_close_style',
                            'type'    => 'image_select',
                            'title'   => esc_html__('Close Button Style', 'yhsshu'),
                            'options'  => array(
                                'style-df' => get_template_directory_uri() . '/assets/images/close_layout/close-1.jpg',
                                'style-2'  => get_template_directory_uri() . '/assets/images/close_layout/close-2.jpg',
                                'style-3'  => get_template_directory_uri() . '/assets/images/close_layout/close-3.jpg',
                            ),
                            'default' => 'style-df',
                            'required' => [ 'template_close_select', '=', 'custom']
                        ),
                        array(
                            'id'      => 'custom_cls',
                            'type'    => 'text',
                            'title'   => esc_html__('Custom Class', 'yhsshu'),
                        ),
                    ),
                ],
            ]
        ],
    ];

    $metabox->add_meta_data( $panels );
}
