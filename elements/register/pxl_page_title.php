<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_page_title',
        'title' => esc_html__('yhsshu Page Title', 'yhsshu' ),
        'icon' => 'eicon-t-letter',
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
                            'name' => 'style',
                            'label' => esc_html__('Style', 'yhsshu' ),
                            'type' => 'select',
                            'options' => [
                                'style-1' => esc_html__('Style 1', 'yhsshu'),
                                'style-2' => esc_html__('Style 2', 'yhsshu'),
                                'style-3' => esc_html__('Style 3', 'yhsshu'),
                            ],
                            'default' => 'style-1',
                        ),
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
                                '{{WRAPPER}} .yhsshu-pt-wrap' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-pt-wrap .main-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'pt_typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-pt-wrap .main-title',
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);