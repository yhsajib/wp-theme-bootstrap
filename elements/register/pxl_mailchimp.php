<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_mailchimp',
        'title' => esc_html__('yhsshu Mailchimp', 'yhsshu'),
        'icon' => 'eicon-email-field',
        'categories' => array('yhsshutheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_opt',
                    'label' => esc_html__('Options', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style-default' => esc_html__('Default', 'yhsshu' ),
                                'style-2'       => esc_html__('Style 2', 'yhsshu' ),
                                'style-3'       => esc_html__('Style 3', 'yhsshu' ),
                            ],
                            'default' => 'style-default',
                        ),
                        array(
                            'name' => 'hide_icon',
                            'label' => esc_html__('Hide Icon?', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => false,
                        ),
                        array(
                            'name' => 'hide_button_text',
                            'label' => esc_html__('Hide Button Text?', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => false,
                        ),
                        array(
                            'name' => 'hide_lbcb',
                            'label' => esc_html__('Hide Checkbox/Label', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => false,
                        ),
                    ),
                ),
                array(
                    'name' => 'style_input',
                    'label' => esc_html__('Input', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'mc_style_input_tabs',
                            'control_type' => 'tab',
                            'tabs' => array(
                                array(
                                    'name' => 'input_style_normal',
                                    'label' => esc_html__('Normal', 'yhsshu'),
                                    'controls' => array(
                                        array(
                                            'name' => 'input_background',
                                            'label' => esc_html__('Input Background', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp input[type="text"], {{WRAPPER}} .yhsshu-mailchimp input[type="password"], {{WRAPPER}} .yhsshu-mailchimp input[type="email"], {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]' => 'background-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'input_text_color',
                                            'label' => esc_html__('Input Text Color', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp input[type="text"],
                                                 {{WRAPPER}} .yhsshu-mailchimp input[type="password"],
                                                 {{WRAPPER}} .yhsshu-mailchimp input[type="email"],
                                                 {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'input_border_type',
                                            'label' => esc_html__('Input Border Type', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::SELECT,
                                            'separator' => 'before',
                                            'options' => [
                                                '' => esc_html__( 'None', 'yhsshu' ),
                                                'solid' => esc_html__( 'Solid', 'yhsshu' ),
                                                'double' => esc_html__( 'Double', 'yhsshu' ),
                                                'dotted' => esc_html__( 'Dotted', 'yhsshu' ),
                                                'dashed' => esc_html__( 'Dashed', 'yhsshu' ),
                                                'groove' => esc_html__( 'Groove', 'yhsshu' ),
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp input[type="text"], {{WRAPPER}} .yhsshu-mailchimp input[type="password"], {{WRAPPER}} .yhsshu-mailchimp input[type="email"], {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]' => 'border-style: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'input_border_width',
                                            'label' => esc_html__('Input Border Width', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp input[type="text"], {{WRAPPER}} .yhsshu-mailchimp input[type="password"], {{WRAPPER}} .yhsshu-mailchimp input[type="email"], {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                            'responsive' => true,
                                        ),
                                        array(
                                            'name' => 'input_border_color',
                                            'label' => esc_html__('Input Border Color', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp input[type="text"], {{WRAPPER}} .yhsshu-mailchimp input[type="password"], {{WRAPPER}} .yhsshu-mailchimp input[type="email"], {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]' => 'border-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'input_border_radius',
                                            'label' => esc_html__('Input Border Radius', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                            'size_units' => [ 'px', 'em' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp input[type="text"], {{WRAPPER}} .yhsshu-mailchimp input[type="password"], {{WRAPPER}} .yhsshu-mailchimp input[type="email"], {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ),
                                    )
                                ),
                                array(
                                    'name' => 'input_style_hover',
                                    'label' => esc_html__('Hover', 'yhsshu'),
                                    'controls' => array(
                                        array(
                                            'name' => 'input_background_hover',
                                            'label' => esc_html__('Input Background', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp input[type="text"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="password"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="email"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="text"]:hover,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="password"]:hover,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="email"]:hover,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]:hover, 
                                                {{WRAPPER}} .yhsshu-mailchimp input:focus + input[type="submit"],
                                                {{WRAPPER}} .yhsshu-mailchimp input:hover + input[type="submit"],
                                                {{WRAPPER}} .yhsshu-mailchimp input:focus + button,
                                                {{WRAPPER}} .yhsshu-mailchimp input:hover + button' => 'background-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'input_text_hover',
                                            'label' => esc_html__('Input Text Color', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp input[type="text"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="password"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="email"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="text"]:hover,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="password"]:hover,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="email"]:hover,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]:hover' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'input_border_hover',
                                            'label' => esc_html__('Input Border Color', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp input[type="text"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="password"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="email"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]:focus,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="text"]:hover,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="password"]:hover,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="email"]:hover,
                                                {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]:hover, 
                                                {{WRAPPER}} .yhsshu-mailchimp input:focus + input[type="submit"],
                                                {{WRAPPER}} .yhsshu-mailchimp input:hover + input[type="submit"],
                                                {{WRAPPER}} .yhsshu-mailchimp input:focus + button,
                                                {{WRAPPER}} .yhsshu-mailchimp input:hover + button' => 'border-color: {{VALUE}};',
                                            ],
                                        ),
                                    )
                                ),
                            )
                        ),
                    ),
                ),
                array(
                    'name' => 'style_button',
                    'label' => esc_html__('Button', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'style_btn_tabs',
                            'control_type' => 'tab',
                            'tabs' => array(
                                array(
                                    'name' => 'btn_style_normal',
                                    'label' => esc_html__('Normal', 'yhsshu'),
                                    'controls' => array(
                                        array(
                                            'name' => 'typography',
                                            'label' => esc_html__('Button Typography', 'yhsshu' ),
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .yhsshu-mailchimp button, {{WRAPPER}} .yhsshu-mailchimp input[type="submit"]',
                                        ),
                                        array(
                                            'name' => 'btn_background',
                                            'label' => esc_html__('Background Color', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button, {{WRAPPER}} .yhsshu-mailchimp input[type="submit"]' => 'background-color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_color',
                                            'label' => esc_html__('Text Color', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_icon_color',
                                            'label' => esc_html__('Icon Color', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button i' => 'color: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'icon_size',
                                            'label' => esc_html__('Icon Size (px)', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::NUMBER,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button i' => 'font-size: {{VALUE}}px;',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_width',
                                            'label' => esc_html__('Width (px)', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::NUMBER,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button,
                                                 {{WRAPPER}} .yhsshu-mailchimp input[type="submit"]' => 'width: {{VALUE}}px; padding: 0;',
                                                '{{WRAPPER}} .yhsshu-mailchimp input[type="text"], 
                                                 {{WRAPPER}} .yhsshu-mailchimp input[type="email"], 
                                                 {{WRAPPER}} .yhsshu-mailchimp input[type="phone"]' => 'padding-right: calc({{VALUE}}px + 5px);',
                                            ],
                                            'separator' => 'before',
                                            'condition' => [
                                               'style' => ['style-2','style-3']
                                            ]
                                        ),
                                        array(
                                            'name' => 'btn_distance',
                                            'label' => esc_html__('Distance To Input Border (px)', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::NUMBER,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button, {{WRAPPER}} .yhsshu-mailchimp input[type="submit"]' => 'top: {{VALUE}}px; right: {{VALUE}}px; height: calc( var(--input-height) - ({{VALUE}}px * 2) );',
                                            ],
                                            'control_type' => 'responsive',
                                            'condition' => [
                                                'style' => ['style-2','style-3']
                                            ]
                                        ),
                                        array(
                                            'name' => 'border_type',
                                            'label' => esc_html__( 'Border Type', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::SELECT,
                                            'separator' => 'before',
                                            'options' => [
                                                '' => esc_html__( 'None', 'yhsshu' ),
                                                'solid' => esc_html__( 'Solid', 'yhsshu' ),
                                                'double' => esc_html__( 'Double', 'yhsshu' ),
                                                'dotted' => esc_html__( 'Dotted', 'yhsshu' ),
                                                'dashed' => esc_html__( 'Dashed', 'yhsshu' ),
                                                'groove' => esc_html__( 'Groove', 'yhsshu' ),
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button, {{WRAPPER}} .yhsshu-mailchimp input[type="submit"]' => 'border-style: {{VALUE}};',
                                            ],
                                        ),
                                        array(
                                            'name' => 'border_width',
                                            'label' => esc_html__( 'Border Width', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button, {{WRAPPER}} .yhsshu-mailchimp input[type="submit"]' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                            'responsive' => true,
                                        ),
                                        array(
                                            'name' => 'border_color',
                                            'label' => esc_html__( 'Border Color', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'default' => '',
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button, {{WRAPPER}} .yhsshu-mailchimp input[type="submit"]' => 'border-color: {{VALUE}};'
                                            ],
                                            'condition' => [
                                                'border_type!' => '',
                                            ],
                                        ),
                                        array(
                                            'name' => 'btn_border_radius',
                                            'label' => esc_html__('Border Radius', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                            'size_units' => [ 'px' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button, {{WRAPPER}} .yhsshu-mailchimp input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                            'control_type' => 'responsive',
                                        ),
                                    )
                                ),
                                array(
                                    'name' => 'btn_style_hover',
                                    'label' => esc_html__('Hover', 'yhsshu'),
                                    'controls' => array(
                                        array(
                                            'name' => 'btn_hover_background',
                                            'label' => esc_html__('Button Hover Background', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .yhsshu-mailchimp button:hover, {{WRAPPER}} .yhsshu-mailchimp input[type="submit"]:hover' => 'background-color: {{VALUE}};',
                                            ],
                                        ),
                                    )
                                ),
                            )
                        ),
                    ),
                ),
                array(
                    'name' => 'style_checkbox',
                    'label' => esc_html__('Label/CheckBox', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'lb_typography',
                            'label' => esc_html__('Label Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-mailchimp label',
                        ),
                        array(
                            'name' => 'lb_color',
                            'label' => esc_html__('Label Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-mailchimp label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'lb_margin',
                            'label' => esc_html__( 'Label Margin', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-mailchimp label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'responsive' => true
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Link Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-mailchimp label a' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'after'
                        ),
                        array(
                            'name' => 'cb_margin',
                            'label' => esc_html__( 'Checkbox Margin', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-mailchimp input[type="checkbox"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'responsive' => true
                        ),
                        array(
                            'name' => 'cb_color',
                            'label' => esc_html__('Checkbox Checked Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-mailchimp input[type="checkbox"]' => 'accent-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'cb_width',
                            'label' => esc_html__('Checkbox Width (px)', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-mailchimp input[type="checkbox"]' => 'width: {{VALUE}}px;',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);