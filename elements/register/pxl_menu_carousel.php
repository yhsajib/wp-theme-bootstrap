<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_menu_carousel',
        'title' => esc_html__('yhsshu Food Menu Carousel', 'yhsshu'),
        'icon' => 'eicon-info-box',
        'categories' => array('yhsshutheme-core'),
        'scripts' => [
            'swiper',
            'yhsshu-swiper',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Layout', 'yhsshu' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-2.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-2.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__( 'Layout 6', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-6.jpg'
                                ],
                                '7' => [
                                    'label' => esc_html__( 'Layout 7', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-7.jpg'
                                ],
                                '8' => [
                                    'label' => esc_html__( 'Layout 8', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-8.jpg'
                                ],
                                '9' => [
                                    'label' => esc_html__( 'Layout 9', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-9.jpg'
                                ],
                                '10' => [
                                    'label' => esc_html__( 'Layout 10', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-10.jpg'
                                ],
                                '11' => [
                                    'label' => esc_html__( 'Layout 11', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-11.jpg'
                                ],
                                '12' => [
                                    'label' => esc_html__( 'Layout 12', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_menu_carousel-12.jpg'
                                ],
                            ],
                        ),
                        
                    ),
                ),
                array(
                    'name' => 'section_boxs',
                    'label' => esc_html__('List Settings', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'list',
                            'label' => esc_html__('', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'condition' =>[
                                'layout!' => ['6', '7', '9', '10', '12']
                            ],
                            'controls' => array(
                                array(
                                    'name'             => 'selected_img',
                                    'label'            => esc_html__( 'Image', 'yhsshu' ),
                                    'type'             => 'media',
                                    'default'          => '',
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                    'default' => esc_html__('This is the heading', 'yhsshu' )
                                ),
                                array(
                                    'name' => 'sub_title',
                                    'label' => esc_html__('Sub Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'description',
                                    'label' => esc_html__('Description', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'price',
                                    'label' => esc_html__('Price', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                    'default' => esc_html__('$25', 'yhsshu' )
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Item Link', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'is_featured',
                                    'label' => esc_html__('Is Featured?', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::SWITCHER,
                                ),
                                array(
                                    'name' => 'featured_text',
                                    'label' => esc_html__('Featured Text', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                    'condition' => [
                                        'is_featured' => 'true'
                                    ]
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                        array(
                            'name' => 'list_food_2',
                            'label' => esc_html__('', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'condition' =>[
                                'layout' => ['6','7', '9', '10', '12']
                            ],
                            'controls' => array(
                                array(
                                    'name'             => 'selected_img_2',
                                    'label'            => esc_html__( 'Image', 'yhsshu' ),
                                    'type'             => 'media',
                                    'default'          => '',
                                ),
                                array(
                                    'name' => 'title_food_2',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                    'default' => esc_html__('This is the heading', 'yhsshu' )
                                ),
                                array(
                                    'name' => 'description_food_2',
                                    'label' => esc_html__('Description', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'button_food',
                                    'label' => esc_html__('Button text', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => esc_html__('read more', 'yhsshu' ),
                                    'description' => esc_html__('Use for layout 6', 'yhsshu' ),
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'link_food_2',
                                    'label' => esc_html__('Item Link', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'description' => esc_html__('Use for layout 6', 'yhsshu' ),
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'width_px',
                                    'label' => esc_html__('Max Width (px)', 'yhsshu' ),
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
                                        '{{WRAPPER}} .yhsshu-menu-carousel {{CURRENT_ITEM}} .item-featured img' => 'max-width: {{SIZE}}{{UNIT}}; object-fit: cover;',
                                    ],
                                    'description' => esc_html__('Use for layout 7', 'yhsshu' ),
                                ),
                            ),
                            'title_field' => '{{{ title_food_2 }}}',
                        ),
                        array(
                            'name'        => 'img_size',
                            'label'       => esc_html__('Image Size', 'yhsshu' ),
                            'type'        => \Elementor\Controls_Manager::TEXT,
                            'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'yhsshu')
                        ),
                        array(
                            'name' => 'heading_color',
                            'label' => esc_html__('Heading Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-menu-carousel .item-inner .menu-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-menu-carousel .item-inner .menu-title a' => 'color: {{VALUE}}; background-image: linear-gradient(transparent calc(100% - 1px), {{VALUE}} 1px);'
                            ],
                        ),
                        array(
                            'name' => 'heading_typography',
                            'label' => esc_html__('Heading Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-menu-carousel .item-inner .menu-title',
                        ),
                        array(
                            'name' => 'sub_heading_color',
                            'label' => esc_html__('Sub Heading Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-menu-carousel .item-inner .menu-sub-title' => 'color: {{VALUE}};',
                            ],
                            'condition' =>[
                                'layout!' => ['6','7', '9', '10', '11', '12']
                            ],
                        ),
                        array(
                            'name' => 'sub_heading_typography',
                            'label' => esc_html__('Sub Heading Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-menu-carousel .item-inner .menu-sub-title',
                            'condition' =>[
                                'layout!' => ['6','7','9','10', '12']
                            ],
                        ),
                        array(
                            'name' => 'price_color',
                            'label' => esc_html__('Price Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-menu-carousel .item-inner .menu-price' => 'color: {{VALUE}};',
                            ],
                            'condition' =>[
                                'layout!' => ['6','7','9','10']
                            ],
                        ),
                        array(
                            'name' => 'price_typography',
                            'label' => esc_html__('Heading Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-menu-carousel .item-inner .menu-price',
                            'condition' =>[
                                'layout!' => ['6','7','9','10','12']
                            ],
                        ),
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-menu-carousel .item-inner .menu-description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_typography',
                            'label' => esc_html__('Description Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-menu-carousel .item-inner .menu-description',
                        ),
                        array(
                            'name' => 'margin_img',
                            'label' => esc_html__('Margin bottom Image (px)', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-menu-carousel .item-featured' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' =>[
                                'layout' => ['7', '9']
                            ]
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Border Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-menu-carousel .yhsshu-swiper-container' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-menu-carousel .yhsshu-swiper-container::before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' =>[
                                'layout' => ['8', '9']
                            ]
                        ),
                        array(
                            'name' => 'padding',
                            'label' => esc_html__('Padding', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-menu-carousel .item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' =>[
                                'layout' => ['8']
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'carousel_setting',
                    'label' => esc_html__('Carousel Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        yhsshu_carousel_column_settings(),
                        array( 
                            array(
                                'name' => 'slides_to_scroll',
                                'label' => esc_html__('Slides to scroll', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '1',
                                'options' => [
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                    '6' => '6',
                                ],
                            ),
                            array(
                                'name' => 'pause_on_hover',
                                'label' => esc_html__('Pause on Hover', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'autoplay',
                                'label' => esc_html__('Autoplay', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'autoplay_speed',
                                'label' => esc_html__('Autoplay Speed', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 5000,
                                'condition' => [
                                    'autoplay' => 'true'
                                ]
                            ),
                            array(
                                'name' => 'infinite',
                                'label' => esc_html__('Infinite Loop', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'speed',
                                'label' => esc_html__('Animation Speed', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 400,
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'arrow_settings',
                    'label' => esc_html__('Arrow Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        yhsshu_arrow_settings(),
                    ),
                ),
                array(
                    'name' => 'dots_settings',
                    'label' => esc_html__('Dots Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        yhsshu_dots_settings(),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);