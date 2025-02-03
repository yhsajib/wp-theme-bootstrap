<?php
//Register Counter Widget
 yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_countdown',
        'title'      => esc_html__('yhsshu Countdown', 'yhsshu'),
        'icon' => 'eicon-countdown',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(
            'yhsshu-countdown',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'yhsshu' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'         => 'layout',
                            'label'        => esc_html__( 'Templates', 'yhsshu' ),
                            'type'         => 'layoutcontrol',
                            'default'      => '1',
                            'options'      => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_countdown-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_countdown-2.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-counter-layout',
                        ) 
                    ),
                ),
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Time to', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'time_to',
                            'label' => esc_html__('Enter the time', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '09/19/2023 00:00 AM',
                            'label_block' => true,
                            'description' => 'Time Format: 09/19/2023 00:00 AM'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_number',
                    'label' => esc_html__('Countdown Number', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'number_typography',
                            'label' => esc_html__('Number Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-countdown .yhsshu-countdown-container .inner-number',
                        ),
                        array(
                            'name' => 'number_color',
                            'label' => esc_html__('Number Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-countdown .yhsshu-countdown-container .inner-number' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_text',
                    'label' => esc_html__('Countdown Text', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'text_typography',
                            'label' => esc_html__('Text Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-countdown .yhsshu-countdown-container .inner-text',
                        ),
                        array(
                            'name' => 'text_color',
                            'label' => esc_html__('Text Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-countdown .yhsshu-countdown-container .inner-text' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            )
        )
    ),
    yhsshu_get_class_widget_path()
);