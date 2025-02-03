<?php
// Register Progress Bar Widget
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_progressbar',
        'title'      => esc_html__( 'yhsshu Progress Bar', 'yhsshu' ),
        'icon'       => 'eicon-skill-bar',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(
            'yhsshu-progressbar',
            'yhsshu-progressbar'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'source_section',
                    'label'    => esc_html__( 'Source Settings', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'progressbar_list',
                            'label'    => esc_html__( 'Progress Bar Lists', 'yhsshu' ),
                            'type'     => 'repeater',
                            'controls' => array_merge(
                                array(
                                    array(
                                        'name'        => 'title',
                                        'label'       => esc_html__( 'Title', 'yhsshu' ),
                                        'type'        => 'text',
                                        'placeholder' => esc_html__( 'Enter your title', 'yhsshu' ),
                                        'default'     => esc_html__( 'My Skill', 'yhsshu' ),
                                        'label_block' => true
                                    ),
                                    array(
                                        'name'    => 'percent',
                                        'label'   => esc_html__( 'Percentage', 'yhsshu' ),
                                        'type'    => 'slider',
                                        'default' => [
                                            'size' => 50,
                                            'unit' => '%',
                                        ],
                                        'label_block' => true
                                    ),
                                    array(
                                        'name' => 'item_bar_color',
                                        'label' => esc_html__( 'Bar Background Color', 'yhsshu' ),
                                        'type' => \Elementor\Controls_Manager::COLOR,
                                        'selectors' => [
                                            '{{WRAPPER}} {{CURRENT_ITEM}} .yhsshu-progress-bar' => 'background-color: {{VALUE}}',
                                        ],
                                    ),
                                )
                            ),
                            'title_field' => '{{title}}'
                        )
                    )
                ),
                array(
                    'name' => 'section_title',
                    'label' => esc_html__( 'Style', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'title_color',
                                'label' => esc_html__( 'Title Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-progressbar .progress-title' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'typography',
                                'label' => esc_html__( 'Title Typography', 'yhsshu' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .yhsshu-progressbar .progress-title',
                            ),
                            array(
                                'name' => 'percent_color',
                                'label' => esc_html__( 'Percentage Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-progressbar .progress-percentage' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'percentage_typography',
                                'label' => esc_html__( 'Percentage Typography', 'yhsshu' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .yhsshu-progressbar .progress-percentage',
                            ),
                            array(
                                'name' => 'bound_color',
                                'label' => esc_html__( 'Bound Background Color', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-progressbar .progress-bound' => 'background-color: {{VALUE}};'
                                ],
                            ),
                        ),
                        yhsshu_elementor_animation_opts([
                            'name'   => 'item',
                            'label' => esc_html__('Item', 'yhsshu'),
                        ])
                    ),
                ),
                
            )
        )
    ),
    yhsshu_get_class_widget_path()
);