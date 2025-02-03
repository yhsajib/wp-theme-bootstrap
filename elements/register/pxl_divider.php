<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_divider',
        'title' => esc_html__('yhsshu Divider', 'yhsshu' ),
        'icon' => 'eicon-divider',
        'categories' => array('yhsshutheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Styles', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'style-1',
                            'options' => [
                                'style-1' => esc_html__('Style 1', 'yhsshu' ),
                                'style-2' => esc_html__('Style 2', 'yhsshu' ),
                            ],
                        ),
                        array(
                            'name' => 'width',
                            'label' => esc_html__( 'Width', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'default' => [
                                'size' => 218,
                                'unit' => 'px',
                            ],
                            'tablet_default' => [
                                'unit' => '%',
                            ],
                            'mobile_default' => [
                                'unit' => '%',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-divider' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'fill',
                            'label' => esc_html__( 'Fill', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'default' => [
                                'size' => 103,
                                'unit' => 'px',
                            ],
                            'tablet_default' => [
                                'unit' => '%',
                            ],
                            'mobile_default' => [
                                'unit' => '%',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-divider::before' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => 'style-1'
                            ]
                        ),
                        array(
                            'name' => 'alignment',
                            'label' => esc_html__( 'Alignment', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'prefix_class' => 'yhsshu-divider-align-%s',
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
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'color',
                            'label' => esc_html__( 'Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-divider' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .yhsshu-divider .diamond-icon' => 'border-color: {{VALUE}}',
                                '{{WRAPPER}} .yhsshu-divider .diamond-icon:before' => 'background-color: {{VALUE}}',
                            ],
                        ),
                        array(
                            'name' => 'fill_color',
                            'label' => esc_html__( 'Fill Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-divider:before' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'style' => 'style-1'
                            ],
                        ),
                        array(
                            'name' => 'icon_gap_color',
                            'label' => esc_html__( 'Icon Gap Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-divider .diamond-icon' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'style' => 'style-2'
                            ],
                        ),
                        array(
                            'name' => 'weight',
                            'label' => esc_html__( 'Weight', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'default' => [
                                'size' => 1,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 1,
                                    'max' => 10,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-divider' => 'height: {{SIZE}}{{UNIT}}',
                                '{{WRAPPER}} .yhsshu-divider:before' => 'height: {{SIZE}}{{UNIT}}',
                            ],
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__( 'Gap', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'TOP' => 15,
                                'BOTTOM' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__( 'Border Radius', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-divider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ],
                        ),
                        array(
                            'name'  => 'draw',
                            'label' => esc_html__('Draw Animation', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'separator' => 'before',
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);