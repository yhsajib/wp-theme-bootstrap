<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_fancy_box_carousel',
        'title' => esc_html__('yhsshu Fancy Box Carousel', 'yhsshu'),
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box_carousel-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box_carousel-2.jpg'
                                ],
                            ],
                        ),
                        
                    ),
                ),
                array(
                    'name' => 'section_boxs',
                    'label' => esc_html__('Box Settings', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'boxs',
                            'label' => esc_html__('', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name'             => 'selected_img',
                                    'label'            => esc_html__( 'Image', 'yhsshu' ),
                                    'type'             => 'media',
                                    'default'          => '',
                                ),
                                array(
                                    'name' => 'title_text',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => esc_html__('This is the heading', 'yhsshu'),
                                    'placeholder' => esc_html__('Enter your title', 'yhsshu'),
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'sub_title_text',
                                    'label' => esc_html__('Sub Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => esc_html__('Sub Title', 'yhsshu'),
                                    'placeholder' => esc_html__('Sub Title', 'yhsshu'),
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'price_text',
                                    'label' => esc_html__('Price', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => esc_html__('20.25$', 'yhsshu'),
                                    'placeholder' => esc_html__('Price', 'yhsshu'),
                                    'description' => esc_html__('Use for Layout 2', 'yhsshu'),
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'description_text',
                                    'label' => esc_html__('Description', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                                    'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'yhsshu'),
                                    'show_label' => false,
                                ),
                                array(
                                    'name'        => 'button_text',
                                    'label'       => esc_html__( 'Button Text', 'yhsshu' ),
                                    'type'        => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name'        => 'link',
                                    'label'       => esc_html__( 'Custom Link', 'yhsshu' ),
                                    'type'        => 'url',
                                    'placeholder' => esc_html__( 'https://your-link.com', 'yhsshu' ),
                                    'default'     => [
                                        'url'         => '#',
                                        'is_external' => 'on'
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ title_text }}}',
                        ),
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Image Size (px)', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 3,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-image img' => 'height: {{SIZE}}{{UNIT}}; width: 100%; object-fit: cover;',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-title',
                        ),
                        array(
                            'name' => 'heading_color',
                            'label' => esc_html__('Heading Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_title_typography',
                            'label' => esc_html__('Sub Title', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-sub-title',
                        ),
                        array(
                            'name' => 'sub_title_color',
                            'label' => esc_html__('Sub Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-sub-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_typography',
                            'label' => esc_html__('Description', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-description',
                        ),
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'background_color',
                            'label' => esc_html__('Background Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-inner .overlay-1, {{WRAPPER}} .yhsshu-fancy-box-carousel .item-inner .overlay-2' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'btn_section',
                    'label' => esc_html__('Button Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'btn_style',
                            'label' => esc_html__('Button Styles', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'yhsshu' ),
                                'btn-white' => esc_html__('White', 'yhsshu' ),
                                'btn-outline' => esc_html__('Out Line', 'yhsshu' ),
                                'btn-outline-secondary' => esc_html__('Out Line Secondary', 'yhsshu' ),
                                'btn-additional-1' => esc_html__('Additional Button 01', 'yhsshu' ),
                                'btn-additional-2' => esc_html__('Additional Button 02', 'yhsshu' ),
                                'btn-additional-3' => esc_html__('Additional Button 03', 'yhsshu' ),
                                'btn-additional-4' => esc_html__('Additional Button 04', 'yhsshu' ),
                                'btn-additional-5' => esc_html__('Additional Button 05', 'yhsshu' ),
                                'btn-additional-6' => esc_html__('Additional Button 06', 'yhsshu' ),
                                'btn-additional-7' => esc_html__('Additional Button 07', 'yhsshu' ),
                                'btn-additional-8' => esc_html__('Additional Button 08', 'yhsshu' ),
                                'btn-additional-9' => esc_html__('Additional Button 09', 'yhsshu' ),
                                'btn-additional-10' => esc_html__('Additional Button 10', 'yhsshu' ),
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_padding',
                            'label' => esc_html__('Padding', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'typography',
                            'label' => esc_html__('Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box-carousel .btn',
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_color',
                            'label' => esc_html__('Text Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .btn' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_color_hover',
                            'label' => esc_html__('Text Color Hover', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .btn:hover' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_color_icon',
                            'label' => esc_html__('Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .btn .yhsshu-button-icon' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_color_icon_hover',
                            'label' => esc_html__('Icon Color Hover', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .btn:hover .yhsshu-button-icon' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_bg_color',
                            'label' => esc_html__('Background Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .btn' => 'background-image: none; background-color: {{VALUE}}; border-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .btn::after' => 'background-image: none; background-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_bg_color_hover',
                            'label' => esc_html__('Background Color Hover', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-inner:hover .btn' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-inner:hover .btn:not(.btn-additional-7):before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-inner:hover .btn.btn-additional-6' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box-carousel .item-inner:hover .btn.btn-additional-7 .yhsshu-button-bg' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                    )
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
                    'name' => 'dot_settings',
                    'label' => esc_html__('Dot Settings', 'yhsshu' ),
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