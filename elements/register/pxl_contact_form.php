<?php
// Register Contact Form 7 Widget
if(class_exists('WPCF7')) {
    $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
    $contact_forms = array();
    if ($cf7) {
        foreach ($cf7 as $cform) {
            $contact_forms[$cform->post_name] = $cform->post_title;
        }
    } else {
        $contact_forms[esc_html__('No contact forms found', 'yhsshu')] = 0;
    }

    yhsshu_add_custom_widget(
        array(
            'name'       => 'yhsshu_contact_form',
            'title'      => esc_html__('yhsshu Contact Form 7', 'yhsshu'),
            'icon'       => 'eicon-form-horizontal',
            'categories' => array('yhsshutheme-core'),
            'scripts'    => array(),
            'params'     => array(
                'sections' => array(
                    array(
                        'name' => 'source_section',
                        'label' => esc_html__('Source Settings', 'yhsshu'),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                        'controls' => array(
                            array(
                                'name' => 'ctf7_slug',
                                'label' => esc_html__('Select Form', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => $contact_forms,
                                'default' => array_key_first($contact_forms),
                            ),
                        ),
                    ),
                    array(
                        'name' => 'content_style',
                        'label' => esc_html__('Content Style', 'yhsshu'),
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
                                                    '{{WRAPPER}} .yhsshu-contact-form7 input[type="text"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"], 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 select, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea' => 'background-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_text_color',
                                                'label' => esc_html__('Input Text Color', 'yhsshu' ),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .yhsshu-contact-form7 input[type="text"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"], 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"], 
                                                     {{WRAPPER}} .yhsshu-contact-form7 select, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_border_color',
                                                'label' => esc_html__('Input Border Color', 'yhsshu' ),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .yhsshu-contact-form7 input[type="text"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"], 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"], 
                                                     {{WRAPPER}} .yhsshu-contact-form7 select, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_border_radius',
                                                'label' => esc_html__('Input Border Radius', 'yhsshu' ),
                                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                                'size_units' => [ 'px', 'em' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .yhsshu-contact-form7 input[type="text"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"], 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"], 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"], 
                                                     {{WRAPPER}} .yhsshu-contact-form7 select, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name'      => 'select_style',
                                                'type'      => \Elementor\Controls_Manager::SELECT,
                                                'label'     => esc_html__('Select Dropdown Icon Style', 'yhsshu'),
                                                'options'   => array(
                                                    ''          => esc_html__('Default', 'yhsshu'),
                                                    'select-2'  => esc_html__('Style 2', 'yhsshu'),
                                                    'select-3'  => esc_html__('Style 3', 'yhsshu'),
                                                    'select-4'  => esc_html__('Style 4', 'yhsshu'),
                                                    'select-5'  => esc_html__('Style 5', 'yhsshu'),
                                                    'select-6'  => esc_html__('Style 6', 'yhsshu'),
                                                ),
                                                'default' => ''
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
                                                    '{{WRAPPER}} .yhsshu-contact-form7 input[type="text"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 select:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="text"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:focus + input[type="submit"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:hover + input[type="submit"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:focus + button,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:hover + button' => 'background-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_text_hover',
                                                'label' => esc_html__('Input Text Color', 'yhsshu' ),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .yhsshu-contact-form7 input[type="text"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea:hover
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="text"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea:focus' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_border_hover',
                                                'label' => esc_html__('Input Border Color', 'yhsshu' ),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .yhsshu-contact-form7 input[type="text"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 select:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="text"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:focus + input[type="submit"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:hover + input[type="submit"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:focus + button,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:hover + button' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_hover_shadow',
                                                'label'        => esc_html__( 'Box Shadow', 'yhsshu' ),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'exclude' => [
                                                    'box_shadow_position',
                                                ],
                                                'selector' => 
                                                    '{{WRAPPER}} .yhsshu-contact-form7 input[type="text"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"]:hover, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"]:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 select:hover,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="text"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="password"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="email"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="phone"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="date"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="time"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="tel"]:focus, 
                                                     {{WRAPPER}} .yhsshu-contact-form7 input[type="datetime-local"]:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 textarea:focus,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:focus + input[type="submit"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:hover + input[type="submit"],
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:focus + button,
                                                     {{WRAPPER}} .yhsshu-contact-form7 input:hover + button'
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    array(
                        'name' => 'section_style_button',
                        'label' => esc_html__('Button Style', 'yhsshu' ),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            array(
                                'name' => 'text_align',
                                'label' => esc_html__('Alignment', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::CHOOSE,
                                'control_type' => 'responsive',
                                'options' => [
                                    'left' => [
                                        'title' => esc_html__('Left', 'yhsshu' ),
                                        'icon' => 'eicon-text-align-left',
                                    ],
                                    'center' => [
                                        'title' => esc_html__('Center', 'yhsshu' ),
                                        'icon' => 'eicon-text-align-center',
                                    ],
                                    'right' => [
                                        'title' => esc_html__('Right', 'yhsshu' ),
                                        'icon' => 'eicon-text-align-right',
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-contact-form7' => 'text-align: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'button_style_tabs',
                                'control_type' => 'tab',
                                'tabs' => array(
                                    array(
                                        'name' => 'button_style_normal',
                                        'label' => esc_html__('Normal', 'yhsshu'),
                                        'controls' => array(
                                            array(
                                                'name' => 'button_color',
                                                'label' => esc_html__('Text Color', 'yhsshu'),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .wpcf7-form input[type="submit"], 
                                                     {{WRAPPER}} .wpcf7-form button' => 'color: {{VALUE}};'
                                                ]
                                            ),
                                            array(
                                                'name' => 'button_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types'             => [ 'classic' , 'gradient' ],
                                                'selector' => '{{WRAPPER}} .wpcf7-form input[type="submit"], {{WRAPPER}} .wpcf7-form button',
                                            ),
                                        )
                                    ),
                                    array(
                                        'name' => 'button_style_hover',
                                        'label' => esc_html__('Hover', 'yhsshu'),
                                        'controls' => array(
                                            array(
                                                'name' => 'button_color_hover',
                                                'label' => esc_html__('Text Color', 'yhsshu'),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .wpcf7-form input[type="submit"]:hover,
                                                     {{WRAPPER}} .wpcf7-form button:hover' => 'color:{{VALUE}};'
                                                ]
                                            ),
                                            array(
                                                'name' => 'button_background_hover',
                                                'label' => esc_html__('Background Color', 'yhsshu'),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn:hover' => 'border-color: {{VALUE}};',
                                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn.btn-additional-6:hover, {{WRAPPER}} .yhsshu-button-wrapper .btn.btn-additional-7:hover,
                                                     {{WRAPPER}} .yhsshu-button-wrapper .btn.btn-additional-5:hover, {{WRAPPER}} .yhsshu-button-wrapper .btn.btn-additional-8:hover' => 'background-color: {{VALUE}};',
                                                    '{{WRAPPER}} .yhsshu-button-wrapper .btn:before' => 'background-color: {{VALUE}};'
                                                ],
                                            ),
                                        )
                                    ),
                                )
                            ),
                        ),
                    ),
                    array(
                        'name' => 'textarea_size',
                        'label' => esc_html__('Texarea Size', 'yhsshu'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            array(
                                'name'  =>  'message_height',
                                'type'  =>  \Elementor\Controls_Manager::SLIDER,
                                'label' => esc_html__('Message Height', 'yhsshu'),
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 120,
                                        'max' => 350,
                                    ],
                                ],
                                'default'   => [
                                    'unit' => 'px',
                                    'size' => '',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .wpcf7-form textarea.wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                        ),
                    ),
                ),
            )
        ),
            yhsshu_get_class_widget_path()
    );
}