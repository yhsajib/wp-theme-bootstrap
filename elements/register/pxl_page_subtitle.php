<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_page_subtitle',
        'title' => esc_html__('yhsshu Page Subtitle', 'yhsshu' ),
        'icon' => 'eicon-t-letter',
        'categories' => array('yhsshutheme-core'),
        'params' => array(
            'sections' => array(
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
                                '{{WRAPPER}} .yhsshu-pt-wrap' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-pt-wrap .sub-title' => 'text-align: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name'  => 'max_width',
                            'label' => esc_html__( 'Max Width (px)', 'yhsshu' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1920,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-pt-wrap .sub-title' => 'max-width: {{SIZE}}{{UNIT}};',
                            ]
                        ),
                        array(
                            'name' => 'sub_title_color',
                            'label' => esc_html__('Sub Title Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .sub-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'pst_typography',
                            'label' => esc_html__('Sub Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .sub-title',
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);