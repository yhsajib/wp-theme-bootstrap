<?php
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
$text_columns = range( 1, 10 );
$text_columns = array_combine( $text_columns, $text_columns );
$text_columns[''] = esc_html__( 'Default', 'yhsshu' );
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_text_editor',
        'title' => esc_html__( 'yhsshu Text Editor', 'yhsshu' ),
        'icon' => 'eicon-text',
        'scripts'    => array(
            'yhsshu-split-text'
        ),
        'categories' => array('yhsshutheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'editor_section',
                    'label' => esc_html__( 'Text Editor', 'yhsshu' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'text_editor',
                            'label' => '',
                            'type' => Controls_Manager::WYSIWYG,
                            'default' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'yhsshu' ),
                        ),
                        array(
                            'name' => 'dropcap',
                            'label' => esc_html__('Dropcap', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'dropcap_color',
                            'label' => esc_html__( 'Dropcap Text Color', 'yhsshu' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'condition' => [
                                'dropcap' => 'true',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-text-editor .yhsshu-dropcap::first-letter, {{WRAPPER}} .yhsshu-text-editor .yhsshu-dropcap > *:first-child::first-letter' => 'color: {{VALUE}};',
                            ],
                        ),
                        yhsshu_split_text_option()
                    ),
                ),
                array(
                    'name' => 'section_style_content',
                    'label' => esc_html__( 'Content Alignment', 'yhsshu' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                    'controls' => array(
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
                                '{{WRAPPER}} .yhsshu-text-editor' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                          'name' => 'align',
                            'label' => esc_html__( 'Alignment', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Left', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'Right', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-text-editor-wrap' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-text-editor' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'hyphens',
                            'label' => esc_html__( 'Hyphens', 'yhsshu' ),
                            'type' => Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'text_color',
                            'label' => esc_html__( 'Text Color', 'yhsshu' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-text-editor' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__( 'Link Color', 'yhsshu' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-text-editor a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-text-editor a.link-underline' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__( 'Link Color Hover', 'yhsshu' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-text-editor a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'typography',
                            'type' => Group_Control_Typography::get_type(),
                            'label' => esc_html__( 'Text Typography', 'yhsshu' ),
                            'selector' => '{{WRAPPER}} .yhsshu-text-editor, {{WRAPPER}} .yhsshu-text-editor h1, {{WRAPPER}} .yhsshu-text-editor h2, {{WRAPPER}} .yhsshu-text-editor h3, {{WRAPPER}} .yhsshu-text-editor h4, {{WRAPPER}} .yhsshu-text-editor h5, {{WRAPPER}} .yhsshu-text-editor h6',
                            'control_type' => 'group',
                        ),
                        array(
                            'name' => 'link_typography',
                            'type' => Group_Control_Typography::get_type(),
                            'label' => esc_html__( 'Link Typography', 'yhsshu' ),
                            'selector' => '{{WRAPPER}} .yhsshu-text-editor a',
                            'control_type' => 'group',
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);