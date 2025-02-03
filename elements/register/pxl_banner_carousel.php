<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_banner_carousel',
        'title' => esc_html__('yhsshu Banner Carousel', 'yhsshu'),
        'icon' => 'eicon-post-slider',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_banner_carousel-1.jpg'
                                ],
                            ],
                        ),
                        
                    ),
                ),
                array(
                    'name' => 'section_banners',
                    'label' => esc_html__('Banner Settings', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'banners',
                            'label' => esc_html__('', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name'        => 'item_background',
                                    'label'       => esc_html__('Item Background', 'yhsshu'),
                                    'type'        => 'media',
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'title_text',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'default' => esc_html__('This is the heading', 'yhsshu'),
                                    'placeholder' => esc_html__('Enter your title', 'yhsshu'),
                                    'rows' => 3,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'description_text',
                                    'label' => esc_html__('Description', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'default' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'yhsshu'),
                                    'placeholder' => esc_html__('Enter your description', 'yhsshu'),
                                    'rows' => 6,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'button_text',
                                    'label' => esc_html__('Button Text', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
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
                                array(
                                    'name' => 'name_theme',
                                    'label' => esc_html__('Name', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'background_padding',
                                    'label' => esc_html__('Padding', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                    'size_units' => [ 'px' ],
                                    'selectors' => [
                                        '{{WRAPPER}} .yhsshu-banner-carousel .yhsshu-swiper-slide {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                    ],
                                    'control_type' => 'responsive',
                                ),
                            ),
                        ),
                        array(
                            'name' => 'heading_typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-banner-carousel .item-text .item-title',
                        ),
                        array(
                            'name' => 'heading_color',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-banner-carousel .item-text .item-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_typography',
                            'label' => esc_html__('Description Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-banner-carousel .item-description',
                        ),
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-banner-carousel .item-description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'text_btn_color',
                            'label' => esc_html__('Text Button Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-banner-carousel .item-readmore .btn' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'name_typography',
                            'label' => esc_html__('Name Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-banner-carousel .item-name',
                        ),
                        array(
                            'name' => 'name_color',
                            'label' => esc_html__('Name Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-banner-carousel .item-name' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'height_background',
                            'label' => esc_html__('Height Background', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-banner-carousel .banner-item' => 'min-height: {{SIZE}}{{UNIT}};',
                            ],
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
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);