<?php
// Register yhsshu Widget
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_button',
        'title'      => esc_html__( 'yhsshu Button', 'yhsshu' ),
        'icon'       => 'eicon-button',
        'categories' => array('yhsshutheme-core'),
        'params'     => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Button Styles', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'yhsshu' ),
                                'btn-white' => esc_html__('White', 'yhsshu' ),
                                'btn-outline' => esc_html__('Out Line', 'yhsshu' ),
                                'btn-outline-secondary' => esc_html__('Out Line Secondary', 'yhsshu' ),
                                'btn-outline-secondary-2' => esc_html__('Out Line Secondary 2', 'yhsshu' ),
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
                                'btn-additional-11' => esc_html__('Additional Button 11', 'yhsshu' ),
                            ],
                        ),
                        array(
                            'name' => 'text',
                            'label' => esc_html__('Button Text', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Click here', 'yhsshu'),
                            'placeholder' => esc_html__('Click here', 'yhsshu'),
                        ),
                        array(
                            'name' => 'button_url_type',
                            'label' => esc_html__('Link Type', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options'       => [
                                'url'   => esc_html__('URL', 'yhsshu'),
                                'page'  => esc_html__('Existing Page', 'yhsshu'),
                            ],
                            'default'       => 'url',
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::URL,
                            'placeholder' => esc_html__('https://your-link.com', 'yhsshu' ),
                            'condition'     => [
                                'button_url_type'     => 'url',
                            ],
                            'default' => [
                                'url' => '#',
                            ],
                        ),
                        array(
                            'name' => 'page_link',
                            'label' => esc_html__('Existing Page', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SELECT2,
                            'options'       => yhsshu_get_all_page(),
                            'condition'     => [
                                'button_url_type'     => 'page',
                            ],
                            'multiple'      => false,
                            'label_block'   => true,
                        ),
                    ),
                ),
                array(
                    'name' => 'icon_section',
                    'label' => esc_html__('Icon Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        
                        array(
                            'name' => 'btn_icon',
                            'label' => esc_html__('Icon', 'yhsshu' ),
                            'type' => 'icons',
                            'label_block' => true,
                            'fa4compatibility' => 'icon',
                        ),
                        array(
                            'name' => 'icon_align',
                            'label' => esc_html__('Icon Position', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'right',
                            'options' => [
                                'right' => esc_html__('After', 'yhsshu' ),
                                'left' => esc_html__('Before', 'yhsshu' ),
                            ],
                        ),
                        array(
                            'name' => 'icon_space_left',
                            'label' => esc_html__('Icon Space Left', 'yhsshu' ),
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
                                '{{WRAPPER}} .yhsshu-button-wrapper .icon-ps-right .yhsshu-button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_align' => ['right'],
                            ],
                        ),
                        array(
                            'name' => 'icon_space_right',
                            'label' => esc_html__('Icon Space Right', 'yhsshu' ),
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
                                '{{WRAPPER}} .yhsshu-button-wrapper .icon-ps-left .yhsshu-button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_align' => ['left'],
                            ],
                        ),
                        array(
                            'name' => 'icon_font_size',
                            'label' => esc_html__('Icon Font Size', 'yhsshu' ),
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
                                '{{WRAPPER}} .yhsshu-button-wrapper .yhsshu-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'animation_section',
                    'label' => esc_html__('Animation Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        array(
                            yhsshu_split_text_option('button_'),
                            array(
                                'name' => 'hover_split_text_anm',
                                'label' => esc_html__('Hover Split Text Animation', 'yhsshu' ),
                                'type' => 'select',
                                'options' => [
                                    ''               => esc_html__( 'None', 'yhsshu' ),
                                    'hover-split-text' => esc_html__( 'Yes', 'yhsshu' ),
                                    'only-hover-split-text' => esc_html__( 'Only for Hover', 'yhsshu' ),
                                ],
                                'default' => '',
                                'condition' => ['button_split_text_anm!' => '']
                            ),
                        )
                    )
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'text_align',
                                'label' => esc_html__('Alignment', 'yhsshu' ),
                                'type' => 'choose',
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
                                'prefix_class' => 'elementor-align-',
                                'default' => '',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper' => 'justify-content: {{VALUE}};'
                                ],
                            ),
                            array(
                                'name' => 'btn_padding',
                                'label' => esc_html__('Padding', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'  => 'is_fullwidth',
                                'label' => esc_html__('Is Fullwidth?', 'yhsshu'),
                                'type'  => \Elementor\Controls_Manager::SWITCHER,
                                'return_value' => 'yes',
                                'default' => 'no',
                            ),
                            array(
                                'name' => 'typography',
                                'label' => esc_html__('Typography', 'yhsshu' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .yhsshu-button-wrapper .btn',
                            ),
                            array(
                                'name' => 'btn_color',
                                'label' => esc_html__('Text Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_color_hover',
                                'label' => esc_html__('Text Color Hover', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn:hover' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_color_icon',
                                'label' => esc_html__('Icon Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn .yhsshu-button-icon' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_color_icon_hover',
                                'label' => esc_html__('Icon Color Hover', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn:hover .yhsshu-button-icon' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_bg_color',
                                'label' => esc_html__('Background Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn' => 'background-image: none; background-color: {{VALUE}}; border-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn::after' => 'background-image: none; background-color: {{VALUE}};'
                                ],
                                'condition' => [
                                    'style!' => ['btn-gradient'],
                                ],
                            ),
                            array(
                                'name' => 'btn_bg_color_hover',
                                'label' => esc_html__('Background Color Hover', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn:hover' => 'border-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn.btn-additional-6:hover, {{WRAPPER}} .yhsshu-button-wrapper .btn.btn-additional-7:hover, {{WRAPPER}} .yhsshu-button-wrapper .btn.btn-additional-5:hover' => 'background-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn:before' => 'background-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn.btn-additional-10::after' => 'border-left-color: {{VALUE}};'
                                ],
                                'condition' => [
                                    'style!' => ['btn-additional-9'],
                                ],
                            ),
                            array(
                                'name' => 'btn_bg_color_hover_style9',
                                'label' => esc_html__('Background Color Hover', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn:before' => 'background-color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => ['btn-additional-9'],
                                ],
                            ),
                        ),
                        array(
                            array(
                                'name' => 'border_type',
                                'label' => esc_html__( 'Border Type', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    '' => esc_html__( 'None', 'yhsshu' ),
                                    'solid' => esc_html__( 'Solid', 'yhsshu' ),
                                    'double' => esc_html__( 'Double', 'yhsshu' ),
                                    'dotted' => esc_html__( 'Dotted', 'yhsshu' ),
                                    'dashed' => esc_html__( 'Dashed', 'yhsshu' ),
                                    'groove' => esc_html__( 'Groove', 'yhsshu' ),
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn' => 'border-style: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'border_width',
                                'label' => esc_html__( 'Border Width', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'responsive' => true,
                            ),
                            array(
                                'name' => 'border_color',
                                'label' => esc_html__( 'Border Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'default' => '',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn' => 'border-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn.btn-additional-7' => 'box-shadow: 3px 3px 0px 0px {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn.btn-additional-7:hover' => 'box-shadow: 0px 0px 0px 0px {{VALUE}};',
                                    '{{WRAPPER}} .btn.btn-outline:after' => 'background-color: {{VALUE}};'
                                ],
                                'condition' => [
                                    'border_type!' => '',
                                ],
                            ),
                            array(
                                'name' => 'border_color_hover',
                                'label' => esc_html__( 'Border Color Hover', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'default' => '',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn:hover' => 'border-color: {{VALUE}};'
                                ],
                                'condition' => [
                                    'border_type!' => '',
                                ],
                            ),
                            array(
                                'name' => 'btn_border_radius',
                                'label' => esc_html__('Border Radius', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'mc_style_input_tabs',
                                'control_type' => 'tab',
                                'tabs' => array(
                                    array(
                                        'name' => 'input_style_normal',
                                        'label' => esc_html__('Normal', 'yhsshu'),
                                        'controls' => array(
                                            array(
                                                'name' => 'button_shadow',
                                                'label'        => esc_html__( 'Box Shadow', 'yhsshu' ),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'exclude' => [
                                                    'box_shadow_position',
                                                ],
                                                'condition' => [
                                                    'style' => ['btn-additional-9'],
                                                ],
                                                'selector' => 
                                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn'
                                            ),
                                        )
                                    ),
                                    array(
                                        'name' => 'input_style_hover',
                                        'label' => esc_html__('Hover', 'yhsshu'),
                                        'controls' => array(
                                            array(
                                                'name' => 'button_hover_shadow',
                                                'label'        => esc_html__( 'Box Shadow', 'yhsshu' ),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'exclude' => [
                                                    'box_shadow_position',
                                                ],
                                                'condition' => [
                                                    'style' => ['btn-additional-9'],
                                                ],
                                                'selector' => 
                                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn:hover'
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        )
                    ),
                ),
            ),
        )
    ),
    yhsshu_get_class_widget_path()
);