<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_testimonial_carousel',
        'title' => esc_html__('yhsshu Testimonial Carousel', 'yhsshu'),
        'icon' => 'eicon-blockquote',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 4', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__( 'Layout 6', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-6.jpg'
                                ],
                                '7' => [
                                    'label' => esc_html__( 'Layout 7', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-7.jpg'
                                ],
                                '8' => [
                                    'label' => esc_html__( 'Layout 8', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-8.jpg'
                                ],
                                '9' => [
                                    'label' => esc_html__( 'Layout 9', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-9.jpg'
                                ],
                                '10' => [
                                    'label' => esc_html__( 'Layout 10', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-10.jpg'
                                ],
                                '11' => [
                                    'label' => esc_html__( 'Layout 11', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-11.jpg'
                                ],
                                '12' => [
                                    'label' => esc_html__( 'Layout 12', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-12.jpg'
                                ],
                                '13' => [
                                    'label' => esc_html__( 'Layout 13', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-13.jpg'
                                ],
                                '14' => [
                                    'label' => esc_html__( 'Layout 14', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-14.jpg'
                                ],
                                '15' => [
                                    'label' => esc_html__( 'Layout 15', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-15.jpg'
                                ],
                                '16' => [
                                    'label' => esc_html__( 'Layout 16', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_carousel-16.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-testimonial-carousel-layout-',
                        ),
                        
                    ),
                ),
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Content', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image_layout14',
                            'label' => esc_html__('Image', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => ['layout' => '14'],
                        ),
                        array(
                            'name' => 'content_list',
                            'label' => esc_html__('Testimonial Items', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'description' => esc_html__('Image Not for layout 14', 'yhsshu'),
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Name', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'position',
                                    'label' => esc_html__('Position', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'testimonial_title',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'description',
                                    'label' => esc_html__('Description', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 10,
                                ),
                                array(
                                    'name' => 'rating',
                                    'label' => esc_html__('Rating', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => 'none',
                                    'options' => [
                                        'none' => esc_html__('None', 'yhsshu' ),
                                        'star1' => esc_html__('1 Star', 'yhsshu' ),
                                        'star2' => esc_html__('2 Star', 'yhsshu' ),
                                        'star3' => esc_html__('3 Star', 'yhsshu' ),
                                        'star4' => esc_html__('4 Star', 'yhsshu' ),
                                        'star5' => esc_html__('5 Star', 'yhsshu' ),
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                        array(
                            'name' => 'quote_icon_type',
                            'label' => esc_html__('Select Quote Type', 'yhsshu'),
                            'type' => 'select',
                            'options' => [
                                'text' => esc_html__('Default', 'yhsshu'),
                                'icon' => esc_html__('Icon', 'yhsshu'),
                                'none' => esc_html__('None', 'yhsshu'),
                            ],
                            'condition' => ['layout!' => '13'],
                            'default' => 'text'
                        ),
                        array(
                            'name' => 'selected_icon',
                            'label' => esc_html__('Quote Icon', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'condition' => [
                                'quote_icon_type' => 'icon'
                            ]                            
                        ),
                        array(
                            'name' => 'quote_typography',
                            'label' => esc_html__('Quote Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-testimonial-carousel .item-quote-icon',
                            'condition' => [
                                'quote_icon_type' => 'text',
                                'layout!' => '13'
                            ]
                        ),
                        array(
                            'name' => 'show_button',
                            'label' => esc_html__('Show Button More', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'condition' => [
                                'layout' => ['6', '10']
                            ]
                        ),
                        array(
                            'name'        => 'button_link',
                            'label'       => esc_html__( 'Button More Link', 'yhsshu' ),
                            'type'        => \Elementor\Controls_Manager::URL,
                            'placeholder' => esc_html__( 'https://your-link.com', 'yhsshu' ),
                            'default'     => [
                                'url'         => '#',
                                'is_external' => 'on'
                            ],
                            'condition' => [
                                'layout' => ['6', '10'],
                                'show_button' => 'true'
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
                                'default' => false,
                            ),
                            array(
                                'name' => 'speed',
                                'label' => esc_html__('Animation Speed', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 400,
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'arrow_settings',
                    'label' => esc_html__('Arrow Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        yhsshu_arrow_settings(),
                    ),
                    'condition' => ['layout!' => '14'],
                ),
                array(
                    'name' => 'arrow_settings_layout14',
                    'label' => esc_html__('Arrow Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'arrows_14',
                                'label' => esc_html__('Show Arrows', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'color_arrow',
                                'label' => esc_html__('Arrow Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-testimonial-carousel .yhsshu-swiper-arrows .yhsshu-swiper-arrow' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'color_arrow_active',
                                'label' => esc_html__('Arrow Color Active', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-testimonial-carousel .yhsshu-swiper-arrows .yhsshu-swiper-arrow::after' => 'background-color: {{VALUE}};',
                                ],
                            ),
                        ),
                    ),
                    'condition' => ['layout' => '14'],
                ),
                array(
                    'name' => 'dots_settings',
                    'label' => esc_html__('Dots Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        yhsshu_dots_settings(),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'quote_size',
                            'label' => esc_html__('Quote Size', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-quote-icon' => 'font-size: {{VALUE}}px;',
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .icon-wrapper svg' => 'width: {{VALUE}}; height: {{VALUE}}px;',
                            ],
                            'condition' => ['layout!' => '13'],
                        ),
                        array(
                            'name' => 'quote_color',
                            'label' => esc_html__('Quote Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-quote-icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .icon-wrapper svg' => 'fill: {{VALUE}};',
                            ],
                            'condition' => ['layout!' => '13'],
                        ),
                        array(
                            'name' => 'quote_margin',
                            'label' => esc_html__('Quote Margin', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-inner .item-quote-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => ['layout' => '2'],
                        ),
                        array(
                            'name' => 'bg_color',
                            'label' => esc_html__('Background Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['layout!' => '13'],
                        ),
                        array(
                            'name' => 'title_typography_testimo',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-testimonial-carousel .testimonial-title',
                            'condition' => ['layout' => '14'],
                        ),
                        array(
                            'name' => 'title_testimo_color',
                            'label' => esc_html__('Title', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .testimonial-title, .yhsshu-testimonial-carousel .tes-title' => 'color: {{VALUE}};'
                            ],
                            'condition' => ['layout' => ['14', '16']],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Name Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-testimonial-carousel .item-inner .item-title',
                            'condition' => ['layout' => '2'],
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Name Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-testimonial-carousel.layout-8 .item-title:before,
                                {{WRAPPER}} .yhsshu-testimonial-carousel.layout-8 .item-title:after' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-testimonial-carousel.layout-14 .item-title::before' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'name_margin',
                            'label' => esc_html__('Name Margin', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-inner .item-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => ['layout' => '2'],
                        ),
                        array(
                            'name' => 'bg_des_color',
                            'label' => esc_html__('Box Description Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-desc' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['layout' => '13'],
                        ),
                        array(
                            'name' => 'testimonial_Typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-testimonial-carousel .item-inner .testimonial-title',
                            'condition' => ['layout' => '2'],
                        ),
                        array(
                            'name' => 'testimonial_color',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .testimonial-title' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['2', '3', '4']
                            ]
                        ),
                        array(
                            'name' => 'title_space_bottom',
                            'label' => esc_html__('Title Space Bottom', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => -300,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-inner .testimonial-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['2']
                            ]
                        ),
                        array(
                            'name' => 'position_color',
                            'label' => esc_html__('Position Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-position' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'description_Typography',
                            'label' => esc_html__('Description Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-testimonial-carousel .item-inner .item-desc',
                            'condition' => ['layout' => '2'],
                        ),
                        array(
                            'name' => 'description_color',
                            'label' => esc_html__('Description Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-desc' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'des_space_bottom',
                            'label' => esc_html__('Des Space Bottom', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => -300,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-inner .item-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['2']
                            ]
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Star icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-rating' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'divider_color',
                            'label' => esc_html__('Divider Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .yhsshu-divider::before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['15']
                            ]
                        ),
                        array(
                            'name' => 'testimonial_background',
                            'label' => esc_html__('Background Image', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => ['layout!' => '13', '14'],
                        ),
                        array(
                            'name' => 'max_width',
                            'label' => esc_html__('Description Max Width', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 300,
                                    'max' => 1500,
                                ],
                            ],
                            'condition' => ['layout' => '2'],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-swiper-slider .yhsshu-swiper-slide .item-desc' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'text_alignment',
                            'label'        => esc_html__( 'Text Alignment', 'yhsshu' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-inner' => 'text-align: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .yhsshu-swiper-slide' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-testimonial-carousel .item-inner .item-wrap' => 'justify-content: {{VALUE}};',
                            ],
                            'condition' => ['layout' => ['2', '15']],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);