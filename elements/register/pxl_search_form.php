<?php
// Register Search Form Widget
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_search_form',
        'title' => esc_html__('yhsshu Search Form', 'yhsshu' ),
        'icon' => 'eicon-site-search',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_search_form-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_search_form-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_search_form-3.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-search-form-layout-'
                        ),
                        array(
                            'name' => 'search_type',
                            'label' => esc_html__('Search Type', 'yhsshu' ),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Default', 'yhsshu'),
                                '2' => esc_html__('Product', 'yhsshu'),
                            ],
                            'default' => '1',
                        )
                    )
                ),
                array(
                    'name'     => 'text_section',
                    'label'    => esc_html__( 'Setting', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'placeholder',
                            'label'    => esc_html__('Placeholder text', 'yhsshu'),
                            'type'     => 'text',
                            'label_block' => true,
                            'default'  => 'Enter Keywords...'
                        ),
                        array(
                            'name'    => 'search_text_width',
                            'label'   => esc_html__( 'Search text width', 'yhsshu' ),
                            'type'    => 'slider',
                            'control_type' => 'responsive',
                            'size_units'   => [ 'px', '%' ],
                            'default' => [
                                'unit' => 'px',
                                'unit' => '%',
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1200,
                                ],
                                '%' => [
                                    'min' => 5,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-search-form' => 'width: {{SIZE}}{{UNIT}}'
                            ],
                        ),
                        array(
                            'name' => 'input_height',
                            'label' => esc_html__( 'Search Input/Button Height (px)', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-search-wrap .yhsshu-search-field, {{WRAPPER}} .yhsshu-search-wrap .yhsshu-search-submit' => 'height: {{VALUE}}px;',
                            ],
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__( 'Border Width', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-search-wrap .yhsshu-search-field' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__( 'Border Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-search-wrap .yhsshu-search-field' => 'border-color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'search_button_color',
                            'label' => esc_html__( 'Search Button Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-search-wrap .yhsshu-search-submit' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'btn_padding',
                            'label' => esc_html__('Padding', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-search-wrap .yhsshu-search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name'         => 'align',
                            'label'        => esc_html__( 'Alignment', 'yhsshu' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'default'      => '',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-search-wrap' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
                            ],
                        ),
                    )
                ),  
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);