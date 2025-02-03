<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_image_carousel',
        'title' => esc_html__('yhsshu Image Carousel', 'yhsshu'),
        'icon' => 'eicon-posts-carousel',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_carousel-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_carousel-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_carousel-3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 4', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_carousel-4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_carousel-5.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Image Gallery', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'img_gallery',
                                'label' => __('Add Images', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::GALLERY,
                                'show_label' => false,
                                'dynamic' => [
                                    'active' => true,
                                ],
                            ),
                            array(
                                'name' => 'title_image',
                                'label' => esc_html__('Title', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                                'condition' => [
                                    'layout' => ['2']
                                ],
                            ),
                            array(
                                'name' => 'selected_icon',
                                'label' => esc_html__( 'Icon', 'yhsshu' ),
                                'type' => 'icons',
                                'condition' => [
                                    'layout' => ['3']
                                ]
                            ),
                            array(
                                'name'  => 'icon_color',
                                'label' => esc_html__( 'Icon Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-image-carousel .box-icon i' => 'color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-image-carousel .box-icon svg' => 'fill: {{VALUE}};',
                                ],
                                'condition' => [
                                    'layout' => ['3']
                                ]
                            ),
                            array(
                                'name'  => 'icon_hover_color',
                                'label' => esc_html__( 'Icon Hover Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-image-carousel .box-icon:hover i' => 'color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-image-carousel .box-icon:hover svg' => 'fill: {{VALUE}};',
                                ],
                                'condition' => [
                                    'layout' => ['3']
                                ]
                            ),
                            array(
                                'name'  => 'icon_size',
                                'label' => esc_html__( 'Icon Size (px)', 'yhsshu' ),
                                'type'  => 'slider',
                                'range' => [
                                    'px' => [
                                        'min' => 0,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-image-carousel .box-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
                                    '{{WRAPPER}} .yhsshu-image-carousel .box-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                ],
                                'condition' => [
                                    'layout' => ['3']
                                ]
                            ),
                            array(
                                'name' => 'link',
                                'label' => esc_html__('Link', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::URL,
                                'label_block' => true,
                                'condition' => [
                                    'layout' => ['3']
                                ]
                            )
                        ),
                    ),
                ),
                array(
                    'name' => 'section_carousel_settings',
                    'label' => esc_html__('Carousel Settings', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'img_size',
                                'label' => esc_html__('Image Size', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'yhsshu')
                            ),
                            array(
                                'name' => 'image_border_radius',
                                'label' => esc_html__('Image Border Radius', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-swiper-slider.yhsshu-image-carousel .item-inner img, {{WRAPPER}} .yhsshu-swiper-slider.yhsshu-image-carousel .item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'img_width',
                                'label' => esc_html__('Fixed Width (px)', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-swiper-slider.yhsshu-image-carousel .item-inner img' => 'width: {{VALUE}}px; object-fit: cover;',
                                ],
                                'condition' => [
                                    'layout!' => ['4']
                                ]
                            ),
                            array(
                                'name' => 'img_width_odd',
                                'label' => esc_html__('Fixed Width Odd', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'default' => [
                                    'unit' => '%',
                                ],
                                'tablet_default' => [
                                    'unit' => '%',
                                ],
                                'mobile_default' => [
                                    'unit' => '%',
                                ],
                                'size_units' => [ '%', 'px', 'vw' ],
                                'range' => [
                                    '%' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                    'px' => [
                                        'min' => 1,
                                        'max' => 1920,
                                    ],
                                    'vw' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-image-carousel .yhsshu-swiper-slide:nth-child(odd)' => 'min-width: {{SIZE}}{{UNIT}}; object-fit: cover;',
                                ],
                                'condition' => [
                                    'layout' => ['4']
                                ]
                            ),
                            array(
                                'name' => 'img_width_even',
                                'label' => esc_html__('Fixed Width Even', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'default' => [
                                    'unit' => '%',
                                ],
                                'tablet_default' => [
                                    'unit' => '%',
                                ],
                                'mobile_default' => [
                                    'unit' => '%',
                                ],
                                'size_units' => [ '%', 'px', 'vw' ],
                                'range' => [
                                    '%' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                    'px' => [
                                        'min' => 1,
                                        'max' => 1920,
                                    ],
                                    'vw' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-image-carousel .yhsshu-swiper-slide:nth-child(even)' => 'max-width: {{SIZE}}{{UNIT}}; object-fit: cover;',
                                ],
                                'condition' => [
                                    'layout' => ['4']
                                ]
                            ),
                            array(
                                'name' => 'img_height',
                                'label' => esc_html__('Fixed Height (px)', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-swiper-slider.yhsshu-image-carousel .item-inner img' => 'height: {{VALUE}}px; object-fit: cover;',
                                ],
                            ),
                            array(
                                'name'        => 'space_between',
                                'label'       => esc_html__('Space Between', 'yhsshu'),
                                'description' => esc_html__('Distance between slides in px', 'yhsshu'),
                                'type'        => \Elementor\Controls_Manager::NUMBER,
                                'default'     => 30
                            ),
                        ), 
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
                            array(
                                'name' => 'setting_drag',
                                'label' => esc_html__('Show Drag Cursor', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'condition' => ['layout' => '1']
                            ),
                            array(
                                'name' => 'drag_text',
                                'label' => esc_html__('Show Drag', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html('Drag', 'yhsshu'),
                                'condition' => ['layout' => '1']
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