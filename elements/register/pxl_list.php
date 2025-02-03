<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_list',
        'title' => esc_html__('yhsshu List', 'yhsshu' ),
        'icon' => 'eicon-bullet-list',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(),
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-2.jpg'
                                ],
                            ],
                        )
                    )
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__( 'Content', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'list',
                            'label' => esc_html__('Items', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'list_icon',
                                    'label' => esc_html__('List Icon', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-check',
                                        'library' => 'fa-solid',
                                    ],
                                ),
                                array(
                                    'name' => 'content',
                                    'label' => esc_html__('Content', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Item Link', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ content }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style',
                    'label' => esc_html__('Style', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
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
                            'default' => [
                                'size' => 15,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-list-content .yhsshu-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-list-content .yhsshu-list-icon svg' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-list.layout-2 .yhsshu-list-content:hover .yhsshu-list-icon' => 'max-width: calc({{SIZE}}{{UNIT}} + 10px);',
                            ],

                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-list-icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-list-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin(px)', 'yhsshu' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-list-content .yhsshu-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_position',
                            'label' => esc_html__('Icon Position Y', 'yhsshu' ),
                            'description' => esc_html__('Vertical deviation from the original position (Unit: px)', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-list-content .yhsshu-list-icon' => 'bottom: {{VALUE}}px;',
                            ],
                        ),
                        array(
                            'name' => 'content_color',
                            'label' => esc_html__('Content Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-list .yhsshu-list-content' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'content_typography',
                            'label' => esc_html__('Content Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-list .yhsshu-list-content',
                        ),
                        array(
                            'name' => 'content_border_type',
                            'label' => esc_html__( 'Content Border Type', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'none' => esc_html__( 'None', 'yhsshu' ),
                                'solid' => esc_html__( 'Solid', 'yhsshu' ),
                                'double' => esc_html__( 'Double', 'yhsshu' ),
                                'dotted' => esc_html__( 'Dotted', 'yhsshu' ),
                                'dashed' => esc_html__( 'Dashed', 'yhsshu' ),
                                'groove' => esc_html__( 'Groove', 'yhsshu' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-list .yhsshu-list-content + .yhsshu-list-content' => 'border-top-style: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ],
                        ),
                        array(
                            'name' => 'content_border_color',
                            'label' => esc_html__( 'Content Border Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-list .yhsshu-list-content + .yhsshu-list-content' => 'border-top-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'content_border_type!' => 'none',
                                'layout' => '2'
                            ],
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Link Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-list .yhsshu-list-content a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__( 'Link Color Hover', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-list .yhsshu-list-content a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'item_spacing',
                            'label' => esc_html__('Item Space', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-item-list .yhsshu-list-content + .yhsshu-list-content' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'item_alignment',
                            'label'        => esc_html__( 'Item Alignment', 'yhsshu' ),
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
                                '{{WRAPPER}} .yhsshu-list-content' => 'justify-content: {{VALUE}}; text-align: {{VALUE}};'
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);