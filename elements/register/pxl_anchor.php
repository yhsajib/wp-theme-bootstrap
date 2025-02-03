<?php
$templates_df = [0 => esc_html__('None', 'yhsshu')];
$templates = $templates_df + yhsshu_get_templates_option('hidden-panel');

yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_anchor',
        'title'      => esc_html__( 'yhsshu Anchor', 'yhsshu' ),
        'icon'       => 'eicon-anchor',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'icon_section',
                    'label'    => esc_html__( 'Settings', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'template',
                            'label' => esc_html__('Select Templates', 'yhsshu'),
                            'type' => 'select',
                            'options' => $templates,
                            'default' => 'df' 
                        ),
                        array(
                            'name' => 'icon_type',
                            'label' => esc_html__('Select Type', 'yhsshu'),
                            'type' => 'select',
                            'options' => [
                                'none' => esc_html__('None', 'yhsshu'),
                                'lib' => esc_html__('Library', 'yhsshu'),
                                'custom' => esc_html__('Custom 1', 'yhsshu'),
                                'custom-2' => esc_html__('Custom 2', 'yhsshu'),
                                'custom-3' => esc_html__('Custom 3', 'yhsshu'),
                                'custom-4' => esc_html__('Custom 4', 'yhsshu'),
                                'custom-5' => esc_html__('Custom 5', 'yhsshu'),
                                'custom-6' => esc_html__('Custom 6', 'yhsshu'),
                                'custom-7' => esc_html__('Custom 7', 'yhsshu'),
                                'select-button' => esc_html__('Select Button', 'yhsshu'),
                            ],
                            'default' => 'lib' 
                        ),
                        array(
                            'name' => 'style_button',
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
                            ],
                            'condition' => ['icon_type' => 'select-button']
                        ),
                        array(
                            'name' => 'text_button',
                            'label' => esc_html__('Button Text', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Click here', 'yhsshu'),
                            'placeholder' => esc_html__('Click here', 'yhsshu'),
                            'condition' => ['icon_type' => 'select-button']
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'yhsshu' ),
                            'type'             => 'icons',
                            'default'          => [
                                'library' => 'yhsshui',
                                'value'   => 'yhsshui-search-400'
                            ],
                            'condition' => ['icon_type' => 'lib']
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size(px)', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'condition' => ['icon_type' => 'lib'],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-anchor-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'  => 'icon_size_custom',
                            'label' => esc_html__( 'Icon Size(px)', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'condition' => ['icon_type' => 'custom-2'],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-icon.custom-2' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'  => 'dot_size_custom',
                            'label' => esc_html__( 'Dot Size(px)', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'condition' => ['icon_type' => 'custom-2'],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-icon.custom-2 span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin(px)', 'yhsshu' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => ['icon_type!' => ['none', 'select-button']],
                        ),
                        array(
                            'name' => 'border_type_cus2',
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
                                '{{WRAPPER}} .yhsshu-anchor-wrap .yhsshu-anchor' => 'border-style: {{VALUE}};',
                            ],
                            'condition' => ['icon_type' => ['custom-2']],
                        ),
                        array(
                            'name' => 'border_width_cus2',
                            'label' => esc_html__( 'Border Width', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-wrap .yhsshu-anchor' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'responsive' => true,
                            'condition' => ['icon_type' => ['custom-2']],
                        ),
                        array(
                            'name' => 'border_color_cus2',
                            'label' => esc_html__( 'Border Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-wrap .yhsshu-anchor' => 'border-color: {{VALUE}};',
                            ],
                            'condition' => ['icon_type' => ['custom-2']],
                        ),
                        array(
                            'name' => 'border_radius_cus2',
                            'label' => esc_html__('Border Radius', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-wrap .yhsshu-anchor' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => ['icon_type' => ['custom-2']],
                        ),
                        array(
                            'name'        => 'title',
                            'label'       => esc_html__( 'Title', 'yhsshu' ),
                            'type'        => 'textarea',
                            'placeholder' => esc_html__( 'Menu', 'yhsshu' ),
                            'condition' => ['icon_type!' => ['select-button']],
                        ),
                        array(
                            'name'         => 'title_typo',
                            'label'        => esc_html__( 'Title Typography', 'yhsshu' ),
                            'type'         => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .anchor-title',
                            'condition'    => ['title!' => '']
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-anchor-wrap .yhsshu-anchor-icon.custom span' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-anchor-wrap .yhsshu-anchor-icon.custom-2 span' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-anchor-icon svg' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-anchor-icon.custom-5 span' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['icon_type!' => ['select-button']],
                        ),
                        array(
                            'name' => 'icon_color_hover',
                            'label' => esc_html__('Hover Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-anchor-wrap .yhsshu-anchor-icon.custom.yhsshu-bars:hover span' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-anchor-wrap .yhsshu-anchor-icon.custom-2.yhsshu-bars:hover span' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-anchor:hover yhsshu-anchor-icon svg' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-anchor-icon.custom-5:hover span' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['icon_type!' => ['select-button']],
                        ),
                        array(
                            'name'  => 'icon_custom_size',
                            'label' => esc_html__( 'Width', 'yhsshu' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'condition' => ['icon_type' => 'custom-5'],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-icon.custom-5 span' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'  => 'icon_custom_height',
                            'label' => esc_html__( 'Height', 'yhsshu' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'condition' => ['icon_type' => 'custom-5'],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-icon.custom-5' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'align',
                            'label'        => esc_html__( 'Alignment', 'yhsshu' ),
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
                                '{{WRAPPER}} .yhsshu-anchor-wrap' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'        => 'custom_class',
                            'label'       => esc_html__( 'Custom class', 'yhsshu' ),
                            'type'        => 'text',
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => ['icon_type' => ['select-button']],
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'btn_padding',
                                'label' => esc_html__('Padding', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                'selector' => '{{WRAPPER}} .yhsshu-anchor .btn',
                            ),
                            array(
                                'name' => 'btn_color',
                                'label' => esc_html__('Text Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor .btn' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_color_hover',
                                'label' => esc_html__('Text Color Hover', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor .btn:hover' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_color_icon',
                                'label' => esc_html__('Icon Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor .btn .yhsshu-button-icon' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_color_icon_hover',
                                'label' => esc_html__('Icon Color Hover', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor .btn:hover .yhsshu-button-icon' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_bg_color',
                                'label' => esc_html__('Background Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor .btn' => 'background-image: none; background-color: {{VALUE}}; border-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-anchor .btn::after' => 'background-image: none; background-color: {{VALUE}};'
                                ],
                                'condition' => [
                                    'style_button!' => ['btn-gradient'],
                                ],
                            ),
                            array(
                                'name' => 'btn_bg_color_hover',
                                'label' => esc_html__('Background Color Hover', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor .btn:hover' => 'border-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-anchor .btn.btn-additional-6:hover, {{WRAPPER}} .yhsshu-anchor .btn.btn-additional-7:hover, {{WRAPPER}} .yhsshu-anchor .btn.btn-additional-5:hover' => 'background-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-anchor .btn:before' => 'background-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-anchor .btn.btn-additional-10::after' => 'border-left-color: {{VALUE}};'
                                ],
                                'condition' => [
                                    'style_button!' => ['btn-additional-9'],
                                ],
                            ),
                            array(
                                'name' => 'btn_bg_color_hover_style9',
                                'label' => esc_html__('Background Color Hover', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor .btn:before' => 'background-color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style_button' => ['btn-additional-9'],
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
                                    '{{WRAPPER}} .yhsshu-anchor .btn' => 'border-style: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'border_width',
                                'label' => esc_html__( 'Border Width', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor .btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'responsive' => true,
                            ),
                            array(
                                'name' => 'border_color',
                                'label' => esc_html__( 'Border Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'default' => '',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor .btn' => 'border-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-anchor .btn.btn-additional-7' => 'box-shadow: 3px 3px 0px 0px {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-anchor .btn.btn-additional-7:hover' => 'box-shadow: 0px 0px 0px 0px {{VALUE}};',
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
                                    '{{WRAPPER}} .yhsshu-anchor .btn:hover' => 'border-color: {{VALUE}};'
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
                                    '{{WRAPPER}} .yhsshu-anchor .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                                    'style_button' => ['btn-additional-9'],
                                                ],
                                                'selector' => 
                                                    '{{WRAPPER}} .yhsshu-anchor .btn'
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
                                                    'style_button' => ['btn-additional-9'],
                                                ],
                                                'selector' => 
                                                    '{{WRAPPER}} .yhsshu-anchor .btn:hover'
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        )
                    ),
                ),
            )
        )
    ),
    yhsshu_get_class_widget_path()
);