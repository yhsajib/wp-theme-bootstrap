<?php
// Register Circle Text Widget
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_circle_text',
        'title'      => esc_html__( 'yhsshu Circle Text', 'yhsshu' ),
        'icon'       => 'eicon-text',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(
            'yhsshu-circle-text'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'title',
                            'label'    => esc_html__('Title', 'yhsshu'),
                            'type'     => 'textarea',
                            'default'  => esc_html__('Your Title', 'yhsshu')
                        ),
                    )
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-circle-text .circle-text',
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-circle-text .circle-text' => 'color: {{VALUE}};',
                            ],
                        ),
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
                            'prefix_class' => 'elementor-align-',
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-circle-text .circle-text' => 'text-align: {{VALUE}};'
                            ],
                        ),
                    ),
                ),
            )
        )
    ),
    yhsshu_get_class_widget_path()
);