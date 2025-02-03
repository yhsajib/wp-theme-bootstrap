<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_links',
        'title' => esc_html__('yhsshu Links', 'yhsshu'),
        'icon' => 'eicon-editor-link',
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
                                    'image' => get_template_directory_uri() . '/elements/widgets/img-layout/yhsshu_links-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-links-layout-'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'links',
                            'label' => esc_html__('Link items', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'text',
                                    'label' => esc_html__('Text', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ) 
                            ),
                            'default' => [
                                [
                                    'text'     => esc_html__('Our News', 'yhsshu' ),
                                    'link'     => ['url' => '#','is_external' => 'on'],
                                ] 
                            ],
                            'title_field' => '{{{ text }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_link',
                    'label' => esc_html__('Link', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'align',
                            'label' => esc_html__( 'Alignment', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
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
                                '{{WRAPPER}} .yhsshu-links' => 'align-items: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-links a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__('Color Hover', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-links a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_typography',
                            'label' => esc_html__('Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-links a',
                        ),
                        array(
                            'name' => 'bottom_spacer',
                            'label' => esc_html__('Bottom Spacer', 'yhsshu' ),
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
                                '{{WRAPPER}} .yhsshu-links li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['1']
                            ],
                        ),
                    ),
                ),
                
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);