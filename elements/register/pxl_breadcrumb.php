<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_breadcrumb',
        'title' => esc_html__('yhsshu Breadcrumb', 'yhsshu' ),
        'icon' => 'eicon-navigation-horizontal',
        'categories' => array('yhsshutheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'yhsshu' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Templates', 'yhsshu' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-1.jpg'
                                ],
                            ],
                        )
                    )
                ),
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Style', 'yhsshu' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Alignment', 'yhsshu' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Start', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'End', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-breadcrumb' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'brc_color',
                            'label' => esc_html__('Text Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-breadcrumb, .yhsshu-breadcrumb .br-item' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Link Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-breadcrumb a' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__('Link Color Hover', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-breadcrumb a:hover' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Divider Icon', 'yhsshu' ),
                            'type'             => 'icons',
                            'condition'        => [
                                'layout!'       => '2' 
                            ]
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
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-breadcrumb .yhsshui' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                                '{{WRAPPER}} .yhsshu-breadcrumb svg' => 'width: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'condition'        => [
                                'layout'       => '1' 
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'yhsshu' ),
                            'type' => 'color',
                            'condition'        => [
                                'layout!'       => '2' 
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-breadcrumb .br-divider' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'brc_typography',
                            'label' => esc_html__('Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-breadcrumb, {{WRAPPER}} .yhsshu-breadcrumb a, {{WRAPPER}} .yhsshu-breadcrumb .br-item, {{WRAPPER}} .yhsshu-breadcrumb .br-divider, {{WRAPPER}} .yhsshu-breadcrumb .br-item',
                        ),
                        array(
                            'name' => 'btn_padding',
                            'label' => esc_html__('Padding', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-breadcrumb .br-divider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition'        => [
                                'layout'       => '1' 
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);