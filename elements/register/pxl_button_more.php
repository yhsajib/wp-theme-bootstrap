<?php
// Register yhsshu Widget
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_button_more',
        'title'      => esc_html__( 'yhsshu Button More', 'yhsshu' ),
        'icon'       => 'eicon-editor-external-link',
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
                            'label' => esc_html__('Style', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                '' => esc_html__('Style 1', 'yhsshu' ),
                                'style-2' => esc_html__('Style 2', 'yhsshu' ),
                                'style-3' => esc_html__('Style 3', 'yhsshu' ),
                                'style-4' => esc_html__('Style 4', 'yhsshu' ),
                            ],
                        ),
                        array(
                            'name' => 'text',
                            'label' => esc_html__('Button Text', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Read More', 'yhsshu'),
                            'placeholder' => esc_html__('Read More', 'yhsshu'),
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
                        array(
                            'name' => 'text_color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-button-more .btn-more' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Border Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-button-more .btn-more:after' => 'background-color: {{VALUE}};',
                            ],
                            'condition'     => [
                                'style'     => '',
                            ],
                        ),
                        array(
                            'name' => 'text_color_hover',
                            'label' => esc_html__('Color Hover', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-button-more .btn-more:hover' => 'color: {{VALUE}};',
                            ],
                            
                        ),
                        array(
                            'name' => 'border_hover_color',
                            'label' => esc_html__('Border Hover Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-button-more .btn-more:hover:after' => 'background-color: {{VALUE}};',
                            ],
                            'condition'     => [
                                'style'     => '',
                            ],
                        ),
                        array(
                            'name' => 'text_typography',
                            'label' => esc_html__('Text Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '.elementor-widget-container .yhsshu-button-more .btn-more',
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-button-more .btn-more i' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'icon_font_size',
                            'label' => esc_html__('Icon Size', 'yhsshu' ),
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
                                '{{WRAPPER}} .yhsshu-button-more .btn-more i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
            ),
        )
    ),
    yhsshu_get_class_widget_path()
);