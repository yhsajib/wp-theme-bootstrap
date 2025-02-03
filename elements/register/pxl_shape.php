<?php
// Register Widget
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_shape',
        'title' => esc_html__('yhsshu Shape', 'yhsshu'),
        'icon' => 'eicon-circle',
        'categories' => array('yhsshutheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'yhsshu'),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'yhsshu'),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'yhsshu'),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_shape-1.jpg'
                                ]
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_shape',
                    'label' => esc_html__('Shape Style', 'yhsshu'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Shape Styles', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'default',
                            'options' => [
                                'default' => esc_html__('Default', 'yhsshu' ),
                                'style2' => esc_html__('Style2', 'yhsshu' ),
                                'style3' => esc_html__('Style3', 'yhsshu' ),
                            ],
                        ),
                        array(
                            'name' => 'shape_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .yhsshu-shape',
                        ),
                        array(
                            'name' => 'shape_opacity',
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Opacity', 'yhsshu'),
                            'range' => [
                                'px' => [
                                    'max' => 1,
                                    'min' => 0.10,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-shape' => 'opacity: {{SIZE}};',
                            ],
                        ),
                        array(
                            'name' => 'shape_width',
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Shape Width', 'yhsshu'),
                            'size_units' => ['px'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1000,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 480,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-shape' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'shape_height',
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Shape Height', 'yhsshu'),
                            'size_units' => ['px'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1000,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 340,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-shape' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__( 'Border Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-shape' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__( 'Border Width', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-shape' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'responsive' => true,
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);