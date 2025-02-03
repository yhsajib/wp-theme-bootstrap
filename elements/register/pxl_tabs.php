<?php
$templates = yhsshu_get_templates_option('default', []) ;
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_tabs',
        'title'      => esc_html__( 'yhsshu Tabs', 'yhsshu' ),
        'icon'       => 'eicon-tabs',
        'categories' => array('yhsshutheme-core'),
        'scripts' => [
            'yhsshu-tabs',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'yhsshu' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Layout', 'yhsshu' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 4', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__( 'Layout 6', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-6.jpg'
                                ],
                                '7' => [
                                    'label' => esc_html__( 'Layout 7', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-7.jpg'
                                ],
                                '8' => [
                                    'label' => esc_html__( 'Layout 8', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-8.jpg'
                                ],
                                '9' => [
                                    'label' => esc_html__( 'Layout 9', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-9.jpg'
                                ],
                                '10' => [
                                    'label' => esc_html__( 'Layout 10', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-10.jpg'
                                ],
                                '11' => [
                                    'label' => esc_html__( 'Layout 11', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-11.jpg'
                                ],
                                '12' => [
                                    'label' => esc_html__( 'Layout 12', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-12.jpg'
                                ],
                                '13' => [
                                    'label' => esc_html__( 'Layout 13', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-13.jpg'
                                ],
                                '14' => [
                                    'label' => esc_html__( 'Layout 14', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-14.jpg'
                                ],
                                '15' => [
                                    'label' => esc_html__( 'Layout 15', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-15.jpg'
                                ],
                                '16' => [
                                    'label' => esc_html__( 'Layout 16', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-16.jpg'
                                ],
                                '17' => [
                                    'label' => esc_html__( 'Layout 17', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_tabs-17.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-tabs-layout-',
                        ),
                    )
                ),
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'yhsshu' ),
                            'type'             => 'icons',
                            'default'          => [
                                'library' => 'fa-solid',
                                'value'   => 'fas fa-pizza-slice'
                            ],
                            'condition' => [
                                'layout' => '6'
                            ]
                        ),
                        array(
                            'name' => 'sub_title',
                            'label' => esc_html__('Sub Title', 'yhsshu'),
                            'type' => 'text',
                            'default' => esc_html__('Special Menu', 'yhsshu'),
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'title_layout10',
                            'label' => esc_html__('Title', 'yhsshu'),
                            'type' => 'text',
                            'default' => esc_html__('Categories', 'yhsshu'),
                            'condition' => [
                                'layout' => '10'
                            ]
                        ),
                        array(
                            'name' => 'title_layout10_typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-tabs.layout-10 .tabs-title .box-title',
                            'condition' => [
                                'layout' => '10'
                            ]
                        ),
                        array(
                            'name' => 'title_layout10_color',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs.layout-10 .tabs-title .box-title' => 'color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '10'
                            ]
                        ),
                        array(
                            'name' => 'button_text',
                            'label' => esc_html__('Button Text', 'yhsshu'),
                            'type' => 'text',
                            'default' => esc_html__('View All Menu', 'yhsshu'),
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'button_url',
                            'label' => esc_html__('Button URL', 'yhsshu'),
                            'type' => 'text',
                            'default' => esc_html__('#', 'yhsshu'),
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name'        => 'item_background',
                            'label'       => esc_html__('Background Tab', 'yhsshu'),
                            'type'        => 'media',
                            'label_block' => true,
                            'condition' => [
                                'layout' => '11'
                            ]
                        ),
                        array(
                            'name' => 'link_to_carousel',
                            'label' => esc_html__('ID Link To Carousel', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'layout!' => '14'
                            ]
                        ),
                        array(
                            'name' => 'active_tab',
                            'label' => esc_html__( 'Active Tab', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 1,
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'tabs_list',
                            'label' => esc_html__('Tabs List', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'condition' => [
                                'layout!' => ['14', '15'],
                            ],
                            'controls' => array(
                                array(
                                    'name'             => 'tab_icon',
                                    'label'            => esc_html__( 'Icon', 'yhsshu' ),
                                    'type'             => 'icons',
                                    'default'          => [
                                        'library' => 'fa-solid',
                                        'value'   => 'fas fa-pizza-slice'
                                    ],
                                    'description' => esc_html__('Use for layout 7, 12', 'yhsshu'),
                                ),
                                array(
                                    'name' => 'item_image',
                                    'label' => esc_html__('Image', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'description' => esc_html__('Use for layout 16', 'yhsshu'),
                                ),
                                array(
                                    'name' => 'tab_title',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'content_type',
                                    'label' => esc_html__('Content Type', 'yhsshu'),
                                    'type' => 'select',
                                    'options' => [
                                        'df' => esc_html__( 'Default', 'yhsshu' ),
                                        'template' => esc_html__( 'From Template Builder', 'yhsshu' )
                                    ],
                                    'default' => 'df' 
                                ),
                                array(
                                    'name' => 'content_template',
                                    'label' => esc_html__('Select Templates', 'yhsshu'),
                                    'description'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','yhsshu'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=yhsshu-template' ) ) . '">','</a>'),
                                    'type' => 'select',
                                    'options' => $templates,
                                    'default' => 'df',
                                    'condition' => ['content_type' => 'template'] 
                                ),
                                array(
                                    'name' => 'tab_content',
                                    'label' => esc_html__('Enter Content', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                                    'default' => '',
                                    'condition' => ['content_type' => 'df'] 
                                ),
                            ),
                            'title_field' => '{{{ tab_title }}}',
                        ),
                        array(
                            'name' => 'tabs_list_2',
                            'label' => esc_html__('Tabs List', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'condition' => [
                                'layout' => ['14', '15']
                            ],
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'tab_title_2',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'position',
                                    'label' => esc_html__('Position', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'description',
                                    'label' => esc_html__('Description', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'default' => '',
                                ),
                                array(
                                    'name' => 'is_button',
                                    'label' => esc_html__('Show Button', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::SWITCHER,
                                    'return_value' => 'yes',
                                    'default' => 'no',
                                    'description' => esc_html__('Use For Layout 15', 'yhsshu')
                                ),
                                array(
                                    'name' => 'button_text',
                                    'label' => esc_html__('Button Text', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => '',
                                    'condition' => [
                                        'is_button' => 'yes'
                                    ]
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                    'condition' => [
                                        'is_button' => 'yes'
                                    ]
                                ),
                            ),
                            'title_field' => '{{{ tab_title_2 }}}',
                        ),
                        array(
                            'name' => 'content_padding',
                            'label' => esc_html__('Content Padding', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tabs-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout!' => ['13', '15']
                            ]
                        ),
                        array(
                            'name' => 'content_margin',
                            'label' => esc_html__('Content Margin', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tabs-content, {{WRAPPER}} .yhsshu-tabs.layout-15 .tabs-title .title-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => ['13', '15']
                            ]
                        ),
                        array(
                            'name' => 'title_space',
                            'label' => esc_html__('Title Space', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 60,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tabs-title .title-wrap' => 'column-gap: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-tabs.layout-12 .tabs-title .title-wrap, .yhsshu-tabs.layout-13 .tabs-title .title-wrap' => 'gap: {{SIZE}}{{UNIT}} !important;',
                                '{{WRAPPER}} .yhsshu-tabs.layout-15 .tab-title' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout!' => '14'
                            ]
                        ),
                        array(
                            'name' => 'positions_y_border',
                            'label' => esc_html__('Positions Border', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px','%' ],
                            'range' => [
                                'px' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs.layout-17 .tab-title::before' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '17'
                            ]
                        ),
                        array(
                            'name' => 'image_space',
                            'label' => esc_html__('Image Space', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 60,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tabs-title .image-wrap' => 'column-gap: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-tabs.layout-16 .tab-title' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['14', '16']
                            ]
                        ),
                        array(
                            'name' => 'background_image_spaceX',
                            'label' => esc_html__('Background SpaceX(px)', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => -200,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title .item-image::after' => 'right: calc(-50% - {{SIZE}}{{UNIT}});',
                            ],
                            'condition' => [
                                'layout' => ['16']
                            ]
                        ),
                        array(
                            'name' => 'background_image_spaceY',
                            'label' => esc_html__('Background SpaceY(px)', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => -200,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title .item-image::after' => 'top: calc(-50% - {{SIZE}}{{UNIT}});',
                            ],
                            'condition' => [
                                'layout' => ['16']
                            ]
                        ),
                        array(
                            'name' => 'title_padding',
                            'label' => esc_html__('Title Padding', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tabs-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => '12'
                            ]
                        ),
                        array(
                            'name' => 'tab_background',
                            'label' => esc_html__('Tab Background', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs.layout-4' => 'background-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '4'
                            ]
                        ),
                        array(
                            'name' => 'title_divider_color',
                            'label' => esc_html__('Title Divider Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs.layout-4 .tabs-title:after' => 'border-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '4'
                            ]
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-tabs .tab-title, {{WRAPPER}} .yhsshu-tabs.layout-14 .item-title, {{WRAPPER}} .yhsshu-tabs.layout-15 .tab-title > span',
                        ),
                        array(
                            'name' => 'title_background',
                            'label' => esc_html__('Title Background', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title' => 'background-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout!' => ['10', '14', '15', '16', '17']
                            ]
                        ),
                        array(
                            'name' => 'title_active_background',
                            'label' => esc_html__('Active Background', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title.active' => 'background-color: {{VALUE}}; border-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout!' => ['10', '14', '15', '16', '17']
                            ]
                        ),
                        array(
                            'name' => 'toggle_background',
                            'label' => esc_html__('Toggle Background', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .toggle-slide' => 'background-color: {{VALUE}} !important;'
                            ],
                            'condition' => [
                                'layout!' => ['10','11','12','13', '14', '15', '16', '17']
                            ]
                        ),
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Size', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title .title-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-tabs .tab-title .title-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                            ],
                            'condition' => [
                                'layout' => ['12', '17']
                            ]
                        ),
                        array(
                            'name' => 'icon_space',
                            'label' => esc_html__('Icon Space', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title' => 'gap: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '12'
                            ]
                        ),
                        array(
                            'name' => 'color_icon',
                            'label' => esc_html__('Icon Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title .title-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-tabs .tab-title .title-icon svg' => 'fill: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => ['12','17']
                            ]
                        ),
                        array(
                            'name' => 'icon_active_color',
                            'label' => esc_html__('Active Icon Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title.active .title-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-tabs .tab-title.active .title-icon svg' => 'fill: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '12'
                            ]
                        ),
                        array(
                            'name' => 'bg_color_icon',
                            'label' => esc_html__('Background Icon', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title .title-icon' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '17'
                            ]
                        ),
                        array(
                            'name' => 'bg_active_icon',
                            'label' => esc_html__('Background Active Icon', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title.active .title-icon' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '17'
                            ]
                        ),
                        array(
                            'name' => 'padding_icon',
                            'label' => esc_html__('Padding Icon', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title .title-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => ['17']
                            ]
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .tab-title, {{WRAPPER}} .yhsshu-tabs.layout-14 .item-title, {{WRAPPER}} .yhsshu-tabs.layout-15 .tab-title > span' => 'color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'title_active_color',
                            'label' => esc_html__('Active Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title.active, {{WRAPPER}} .yhsshu-tabs.layout-15 .tab-title.active > span' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-tabs.layout-1 .tab-title:after' => 'border-bottom-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-tabs .tab-title.active span:after' => 'background: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout!' => '14'
                            ]
                        ),
                        array(
                            'name' => 'active_border_color',
                            'label' => esc_html__('Active Border Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tabs-title .tab-title.active::before' => 'border-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['14', '16']
                            ]
                        ),
                        array(
                            'name' => 'position_typography',
                            'label' => esc_html__('Position Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-tabs .item-position, {{WRAPPER}} .yhsshu-tabs.layout-15 .box-content .item-position',
                            'condition' => [
                                'layout' => ['14', '15']
                            ]
                        ),
                        array(
                            'name' => 'position_color',
                            'label' => esc_html__('Position Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .item-position, {{WRAPPER}} .yhsshu-tabs.layout-15 .box-content .item-position' => 'color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => ['14', '15']
                            ]
                        ),
                        array(
                            'name' => 'description_typography',
                            'label' => esc_html__('Description Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-tabs .box-content .item-des',
                            'condition' => [
                                'layout' => '15'
                            ]
                        ),
                        array(
                            'name' => 'description_color',
                            'label' => esc_html__('Description Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .box-content .item-des' => 'color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '15'
                            ]
                        ),
                        array(
                            'name' => 'content_color',
                            'label' => esc_html__('Content Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .tab-content' => 'color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout!' => '15'
                            ]
                        ),
                        array(
                            'name' => 'btn_color',
                            'label' => esc_html__('Button Text Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .tabs-title .btn-wrapper .btn span, {{WRAPPER}} .yhsshu-tabs.layout-15 .box-content .btn-more' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['2', '15']
                            ]
                        ),
                        array(
                            'name' => 'btn_border_color',
                            'label' => esc_html__('Button Border Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .box-content .btn-more::after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['15']
                            ]
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Border Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tabs-title, {{WRAPPER}} .yhsshu-tabs.layout-15 .tab-title' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-tabs.layout-17 .tab-title::before' => 'background-image: linear-gradient(to bottom, {{VALUE}} 80%, transparent 20%);'
                            ],
                            'condition' => [
                                'layout' => ['11', '15', '17']
                            ]
                        ),
                        array(
                            'name' => 'btn_color_hover',
                            'label' => esc_html__('Button Text Color Hover', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .tabs-title .btn-wrapper .btn:hover span' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_bg_color',
                            'label' => esc_html__('Button Background Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .tabs-title .btn-wrapper .btn' => 'background-image: none; background-color: {{VALUE}}; border-color: {{VALUE}};',
                                '{{WRAPPER}} .tabs-title .btn-wrapper .btn::after' => 'background-image: none; background-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_bg_color_hover',
                            'label' => esc_html__('Button Background Color Hover', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .tabs-title .btn-wrapper .btn:hover' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .tabs-title .btn-wrapper .btn:hover::before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name'         => 'title_alignment',
                            'label'        => esc_html__( 'Title Alignment', 'yhsshu' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'yhsshu' ),
                                    'icon'  => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'yhsshu' ),
                                    'icon'  => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'yhsshu' ),
                                    'icon'  => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tabs-title' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-tabs .title-wrap' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-tabs.layout-6 .title-wrap .tab-title' => 'align-items: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout!' => ['14', '15']
                            ]
                        ),
                        array(
                            'name'         => 'image_alignment',
                            'label'        => esc_html__( 'Alignment', 'yhsshu' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'yhsshu' ),
                                    'icon'  => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'yhsshu' ),
                                    'icon'  => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'yhsshu' ),
                                    'icon'  => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tabs-title .image-wrap' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-tabs .tabs-content .tab-content' => 'text-align: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '14'
                            ]
                        ),
                        array(
                            'name' => 'border_height',
                            'label' => esc_html__('Border Height', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 20,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tab-title span:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '8'
                            ]
                        ),
                        array(
                            'name' => 'divider_color',
                            'label' => esc_html__('Divider Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .title-wrap:after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '8'
                            ]
                        ),
                        array(
                            'name' => 'image_size_Width',
                            'label' => esc_html__('Image Size Width(px)', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 500,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-tabs .tabs-title img' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['14', '16']
                            ]
                        ),
                        array(
                            'name' => 'tab_animation',
                            'label' => esc_html__('Active Animation', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'fadeInUp' => esc_html__('Fade In Up', 'yhsshu'),
                                'fadeIn' => esc_html__('Fade In', 'yhsshu'),
                                'zoomIn' => esc_html__('Zoom In', 'yhsshu')
                            ],
                            'default' => 'fadeInUp'
                        ),
                    ),
                )
            )
        )
    ),
    yhsshu_get_class_widget_path()
);