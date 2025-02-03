<?php
// Register Accordion Widget
$templates = yhsshu_get_templates_option('default', []) ;
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_accordion',
        'title'      => esc_html__( 'yhsshu Accordion', 'yhsshu' ),
        'icon'       => 'eicon-accordion',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(
            'yhsshu-accordion'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'source_section',
                    'label'    => esc_html__( 'Source Settings', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => esc_html__( 'Style 1', 'yhsshu' ),
                                'style2' => esc_html__( 'Style 2', 'yhsshu' ),
                                'style3' => esc_html__( 'Style 3', 'yhsshu' ),
                                'style4' => esc_html__( 'Style 4', 'yhsshu' ),
                                'style5' => esc_html__( 'Style 5', 'yhsshu' ),
                                'style6' => esc_html__( 'Style 6', 'yhsshu' ),
                                'style7' => esc_html__( 'Style 7', 'yhsshu' ),
                                'style8' => esc_html__( 'Style 8', 'yhsshu' ),
                                'style9' => esc_html__( 'Style 9', 'yhsshu' ),
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'active_section',
                            'label' => esc_html__('Active section', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'separator' => 'after',
                            'default' => '1',
                        ),
                        array(
                            'name' => 'ac_items',
                            'label' => esc_html__('Accordion Items', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'ac_title',
                                    'label' => esc_html__('Title', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 3,
                                ),
                                array(
                                    'name' => 'ac_content_type',
                                    'label' => esc_html__( 'Content Type', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => 'text_editor',
                                    'options' => [
                                        'text_editor' => esc_html__( 'Text Editor', 'yhsshu' ),
                                        'template' => esc_html__( 'Template', 'yhsshu' ),
                                    ],
                                ),
                                array(
                                    'name' => 'ac_content',
                                    'label' => esc_html__('Content', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                                    'show_label' => false,
                                    'condition' => [
                                        'ac_content_type' => 'text_editor'
                                    ],
                                ),
                                array(
                                    'name' => 'ac_content_template',
                                    'label' => esc_html__('Select Templates', 'yhsshu'),
                                    'description'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','yhsshu'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=yhsshu-template' ) ) . '">','</a>'),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => '',
                                    'options' => $templates,
                                    'condition' => [
                                        'ac_content_type' => 'template'
                                    ],
                                ),
                                array(
                                    'name' => 'background_color',
                                    'label' => esc_html__('Background Color', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::COLOR,
                                    'selectors' => [
                                        '{{WRAPPER}} .yhsshu-accordion.style8 {{CURRENT_ITEM}} .yhsshu-ac-title' => 'background-color: {{VALUE}};',
                                    ],
                                ),
                                array(
                                    'name' => 'background_color_active',
                                    'label' => esc_html__('Background Color Active', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::COLOR,
                                    'description' => esc_html__('Background Use for Style 8', 'yhsshu'),
                                    'selectors' => [
                                        '{{WRAPPER}} .yhsshu-accordion.style8 {{CURRENT_ITEM}} .yhsshu-ac-title.active' => 'background-color: {{VALUE}};',
                                    ],
                                ),
                            ),
                            'default' => [
                                [
                                    'ac_title'   => esc_html__( 'FAQ Title #1', 'yhsshu' ),
                                    'ac_content' => esc_html__( 'Lorem ipsum dolor sit amet consecte tur adipiscing elit sed do eiu smod tempor incididunt ut labore.', 'yhsshu' ),
                                ],
                                [
                                    'ac_title'   => esc_html__( 'FAQ Title #2', 'yhsshu' ),
                                    'ac_content' => esc_html__( 'Lorem ipsum dolor sit amet consecte tur adipiscing elit sed do eiu smod tempor incididunt ut labore.', 'yhsshu' ),
                                ],
                            ],
                            'title_field' => '{{{ ac_title }}}',
                            'separator' => 'after',
                        ),
                        
                    )
                ),
                array(
                    'name'     => 'style_section',
                    'label'    => esc_html__( 'Style', 'yhsshu' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'title_color',
                                'label' => esc_html__('Title Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-item .yhsshu-ac-title' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'title_typography',
                                'label' => esc_html__('Title Typography', 'yhsshu' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-item .yhsshu-ac-title',
                            ),
                            array(
                                'name' => 'title_color_active',
                                'label' => esc_html__('Title Color Active', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-title.active' => 'color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => 'style8'
                                ]
                            ),
                            array(
                                'name' => 'desc_color',
                                'label' => esc_html__('Description Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-item .yhsshu-ac-desc' => 'color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style!' => 'style8'
                                ]
                            ),
                            array(
                                'name' => 'desc_typography',
                                'label' => esc_html__('Description Typography', 'yhsshu' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-item .yhsshu-ac-content',
                                'condition' => [
                                    'style!' => 'style8'
                                ]
                            ),
                            array(
                                'name' => 'icon_color',
                                'label' => esc_html__('Icon Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-item .yhsshu-ac-title:before,
                                     {{WRAPPER}} .yhsshu-accordion.style9 .yhsshu-ac-title.active > span:before,
                                     {{WRAPPER}} .yhsshu-accordion.style9 .yhsshu-ac-title.active > span:after' => 'color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-item .yhsshu-ac-title:after' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'icon_color_active',
                                'label' => esc_html__('Icon Color Active', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-title.active:after' => 'color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => 'style8'
                                ]
                            ),
                            array(
                                'name' => 'icon_size',
                                'label' => esc_html__('Icon Size', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'condition' => [
                                    'style' => 'style9'
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-accordion.style9 .yhsshu-ac-title.active > span:before, {{WRAPPER}} .yhsshu-accordion.style9 .yhsshu-ac-title.active > span:after'
                                     => 'font-size: {{VALUE}}px;'
                                ],
                            ),
                            array(
                                'name' => 'divider_color',
                                'label' => esc_html__('Divider Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-title' => 'border-bottom-color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-content' => 'border-color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => 'style1'
                                ]
                            ),
                            array(
                                'name' => 'divider_color_active',
                                'label' => esc_html__('Divider Color Active', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-title.active' => 'border-bottom-color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => 'style1'
                                ]
                            ),
                            array(
                                'name' => 'content_padding',
                                'label' => esc_html__('Content Padding', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-accordion .yhsshu-ac-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
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
                                'prefix_class' => 'elementor-align-',
                                'default' => '',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-accordion.style9' => 'text-align: {{VALUE}};'
                                ],
                                'condition' => [
                                    'style' => 'style9'
                                ]
                            ),
                        )
                    ),
                ),
                
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);