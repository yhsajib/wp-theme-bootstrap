<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_team_carousel',
        'title' => esc_html__('yhsshu Team Carousel', 'yhsshu'),
        'icon' => 'eicon-posts-carousel',
        'categories' => array('yhsshutheme-core'),
        'scripts' => array(
            'swiper',
            'yhsshu-swiper',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'yhsshu' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_team_carousel-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_team_carousel-2.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Content', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout!' => ['2']
                    ],
                    'controls' => array(
                        array(
                            'name' => 'content_list',
                            'label' => esc_html__('Team List', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'title',
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
                                    'label' => esc_html__('Description', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 4,
                                ),
                                array(
                                    'name' => 'button_Text',
                                    'label' => esc_html__('Button Text', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                        array(
                            'name' => 'show_icon',
                            'label' => esc_html__('Show Icon', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'condition' => [
                                'layout' => ['1']
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_list_layout2',
                    'label' => esc_html__('Content', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => ['2']
                    ],
                    'controls' => array(
                        array(
                            'name' => 'content_list_layout2',
                            'label' => esc_html__('Team List', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'image_layout2',
                                    'label' => esc_html__('Image', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name'        => 'image_signature',
                                    'label'       => esc_html__('Image second', 'yhsshu'),
                                    'type'        => 'media',
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'sub_title',
                                    'label' => esc_html__('Sub Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'title_layout2',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'description_layout2',
                                    'label' => esc_html__('Description', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ title_layout2 }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_sosial',
                    'label' => esc_html__('Sosial', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => ['2']
                    ],
                    'controls' => array(
                        array(
                            'name' => 'content_sosial',
                            'label' => esc_html__('Item', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'sosial_text',
                                    'label' => esc_html__('Sosial', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'link_sosial',
                                    'label' => esc_html__('Link', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'show_in',
                                    'label' => esc_html__('Show In Item', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => 1,
                                    'description' => 'Example: 1-3-5 corresponds to items 1, 3, 5', 
                                ),
                            ),
                            'title_field' => '{{{ sosial_text }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team .item-title' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['1']
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-team .item-title',
                            'condition' => [
                                'layout' => ['1']
                            ],
                        ),
                        array(
                            'name' => 'position_color',
                            'label' => esc_html__('Position Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team .item-position' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['1']
                            ],
                        ),
                        array(
                            'name' => 'position_typography',
                            'label' => esc_html__('Position Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-team .item-position',
                            'condition' => [
                                'layout' => ['1']
                            ],
                        ),
                        array(
                            'name' => 'des_color',
                            'label' => esc_html__('Description Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-carousel .item-description' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['1']
                            ],
                        ),
                        array(
                            'name' => 'button_color',
                            'label' => esc_html__('Button Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-carousel .btn-text .btn-more' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-team-carousel .btn-text .btn-more::after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['1']
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-carousel .box-icon i' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['1']
                            ],
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
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-carousel .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['1']
                            ],
                        ),
                        array(
                            'name' => 'sub_title_color',
                            'label' => esc_html__('Sub Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-carousel .item-inner .item-content .item-sub-title' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['2']
                            ],
                        ),
                        array(
                            'name' => 'sub_title_typography',
                            'label' => esc_html__('Position Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-team-carousel .item-inner .item-content .item-sub-title',
                            'condition' => [
                                'layout' => ['2']
                            ],
                        ),
                        array(
                            'name' => 'title_color_layout2',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-carousel .item-inner .item-content .item-title' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['2']
                            ],
                        ),
                        array(
                            'name' => 'title_typography_layout2',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-team-carousel .item-inner .item-content .item-title',
                            'condition' => [
                                'layout' => ['2']
                            ],
                        ),
                        array(
                            'name' => 'sosial_color',
                            'label' => esc_html__('Sosial Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-carousel .item-inner .box-sosial a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-team-carousel .item-inner .box-sosial a span:after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['2']
                            ],
                        ),
                        array(
                            'name' => 'sosial_typography',
                            'label' => esc_html__('Sosial Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-team-carousel .item-inner .box-sosial a',
                            'condition' => [
                                'layout' => ['2']
                            ],
                        ),
                        array(
                            'name' => 'size_active',
                            'label' => esc_html__('Size Image Active', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-carousel .swiper-slide-active .item-image img' => 'min-width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['1']
                            ],
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
                                'name' => 'center_slide',
                                'label' => esc_html__('Center Slider', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'default' => false,
                                'condition' =>[
                                    'layout' => ['1']
                                ]
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