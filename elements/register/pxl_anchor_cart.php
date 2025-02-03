<?php
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_anchor_cart',
        'title'      => esc_html__( 'yhsshu Cart', 'yhsshu' ),
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
                            'name' => 'layout_type',
                            'label' => esc_html__('Layout Type', 'yhsshu'),
                            'type' => 'select',
                            'options' => [
                                'layout-df' => esc_html__('Default (Icon)', 'yhsshu'),
                                'layout-text' => esc_html__('Text', 'yhsshu'),
                            ],
                            'default' => 'layout-df' 
                        ),
                        array(
                            'name' => 'cart_style',
                            'label' => esc_html__('Dropdown Layout', 'yhsshu'),
                            'type' => 'select',
                            'options' => [
                                'layout-1' => esc_html__('Layout 1', 'yhsshu'),
                                'layout-2' => esc_html__('Layout 2', 'yhsshu'),
                                'layout-3' => esc_html__('Layout 3', 'yhsshu'),
                                'layout-4' => esc_html__('Layout 4', 'yhsshu'),
                                'layout-5' => esc_html__('Layout 5', 'yhsshu'),
                                'layout-6' => esc_html__('Layout 6', 'yhsshu'),
                                'layout-7' => esc_html__('Layout 7', 'yhsshu'),
                            ],
                            'default' => 'layout-1' 
                        ),
                        array(
                            'name' => 'link_target',
                            'label' => esc_html__('Link Target', 'yhsshu'),
                            'type' => 'select',
                            'options' => [
                                'cart-page' => esc_html__('Cart Page', 'yhsshu'),
                                'cart-dropdown' => esc_html__('Cart Dropdown', 'yhsshu'),
                            ],
                            'default' => 'cart_dropdown' 
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'yhsshu' ),
                            'type'             => 'icons',
                            'default'          => [
                                'library' => 'lnil',
                                'value'   => 'lnil lnil-cart'
                            ],
                            'condition' => ['layout_type' => 'layout-df']
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size(px)', 'yhsshu' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-cart.layout-df a.cart-anchor .yhsshu-anchor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-anchor-cart.layout-df a.cart-anchor .yhsshu-anchor-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => ['layout_type' => 'layout-df']
                        ),
                        array(
                            'name'        => 'text_title',
                            'label'       => esc_html__( 'Text Title', 'yhsshu' ),
                            'type'        => 'text',
                            'default'     => 'Basket',
                            'condition'   => ['layout_type' => 'layout-text']
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-anchor',
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
                            'condition' => ['icon_type!' => 'none'],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => 'color',
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor, {{WRAPPER}} .yhsshu-anchor-icon' => 'color: {{VALUE}};',
                            ],
                        ), 
                        array(
                            'name' => 'icon_color_hover',
                            'label' => esc_html__('Hover Color', 'yhsshu' ),
                            'type' => 'color',
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor:hover, {{WRAPPER}} .yhsshu-anchor:hover .yhsshu-anchor-icon' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'cart_count_bg',
                            'label' => esc_html__('Count background', 'yhsshu' ),
                            'type' => 'color',
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-cart a.cart-anchor .mini-cart-count' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['layout_type' => 'layout-df']
                        ),  
                        array(
                            'name' => 'cart_count_color',
                            'label' => esc_html__('Count Color', 'yhsshu' ),
                            'type' => 'color',
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-cart a.cart-anchor .mini-cart-count' => 'color: {{VALUE}};',
                            ],
                        ), 
                        array(
                            'name'         => 'show_cart_totals',
                            'label'        => esc_html__('Show Cart Total', 'yhsshu'),
                            'type'         => 'select',
                            'options'      => [
                                'inline-flex' => esc_html__('Yes','yhsshu'),
                                'none'  => esc_html__('No', 'yhsshu')
                            ], 
                            'default'      => 'inline-flex', 
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-cart a.cart-anchor .mini-cart-total' => 'display: {{VALUE}};',
                            ],
                            'prefix_class' => 'show-cart-totals%s-',
                        ),
                        array(
                            'name' => 'padding_cart',
                            'label' => esc_html__('Padding(px)', 'yhsshu' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
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
                                '{{WRAPPER}} .yhsshu-anchor-cart' => 'border-style: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__( 'Border Width', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-cart' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'responsive' => true,
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__( 'Border Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-cart' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__('Border Radius', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-anchor-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            'prefix_class' => 'anchor-align-'
                        ),
                        array(
                            'name'         => 'dropdown_pos_offset_top',
                            'label'        => esc_html__( 'Dropdown Offset Top', 'yhsshu' ).' (50px) px,%,vh,auto',
                            'type'         => 'text',
                            'default'      => '',
                            'control_type' => 'responsive',
                            'selectors'    => [
                                '{{WRAPPER}} .yhsshu-cart-dropdown' => 'top: {{VALUE}}',
                            ],
                            'condition' => ['link_target' => 'cart-dropdown'] 
                        ),
                        array(
                            'name'         => 'dropdown_pos_offset_right',
                            'label'        => esc_html__( 'Dropdown Offset Right', 'yhsshu' ).' (50px) px,%,vh,auto',
                            'type'         => 'text',
                            'default'      => '',
                            'control_type' => 'responsive',
                            'selectors'    => [
                                '{{WRAPPER}} .yhsshu-cart-dropdown' => 'right: {{VALUE}}',
                            ],
                            'condition' => ['link_target' => 'cart-dropdown'] 
                        ),
                        array(
                            'name'        => 'custom_class',
                            'label'       => esc_html__( 'Custom class', 'yhsshu' ),
                            'type'        => 'text',
                        ),
                    )
                )
            )
        )
    ),
    yhsshu_get_class_widget_path()
);