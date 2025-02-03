<?php
use Elementor\Controls_Manager;
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_media_popup',
        'title' => esc_html__('yhsshu Media Popup', 'yhsshu' ),
        'icon' => 'eicon-play',
        'categories' => array('yhsshutheme-core'),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'icon_section',
                    'label' => esc_html__('Settings', 'yhsshu' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'media_type',
                            'label' => esc_html__('Button Type', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'media-default',
                            'options' => [
                                'media-default' => esc_html__('Default', 'yhsshu' ),
                                'media-circle' => esc_html__('Circle', 'yhsshu' ),
                                'media-wave' => esc_html__('Wave', 'yhsshu' ),
                            ],
                        ),
                        array(
                            'name' => 'icon_style',
                            'label' => esc_html__('Icon Style', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'style-1',
                            'options' => [
                                'style-1' => esc_html__('Style 1', 'yhsshu' ),
                                'style-2' => esc_html__('Style 2', 'yhsshu' ),
                            ],
                        ),
                        array(
                            'name' => 'media_style',
                            'label' => esc_html__('Media Style', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'featured-video',
                            'options' => [
                                'featured-video' => esc_html__('Video', 'yhsshu' ),
                                'featured-audio' => esc_html__('Audio', 'yhsshu' ),
                            ],
                        ),
                        array(
                            'name' => 'media_link',
                            'label' => esc_html__('Media URL', 'yhsshu'),
                            'type' => Controls_Manager::URL,
                            'default' => [
                                'url' => 'https://www.youtube.com/watch?v=MLpWrANjFbI',
                                'is_external' => 'on'
                            ]
                        ),
                        array(
                            'name' => 'description_text',
                            'label' => esc_html__('Description Text', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'default' => "",
                            'rows' => 5,
                            'show_label' => false,
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_button',
                    'label' => esc_html__('Button Style', 'yhsshu' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Alignment', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'flex-start' => [
                                    'title' => esc_html__('Left', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Center', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'flex-end' => [
                                    'title' => esc_html__('Right', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .media-content-inner' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'button_background',
                            'label' => esc_html__('Button Background', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .media-play-button:before' => 'background-color: {{VALUE}}; background-image: none !important;',
                                '{{WRAPPER}} .yhsshu-media-popup .media-play-button.media-wave::after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'hover_background',
                            'label' => esc_html__('Hover Background', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .media-play-button:hover:before' => 'background-color: {{VALUE}}; background-image: none !important;',
                            ],
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Border Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .media-play-button:before' => 'border: 1px solid {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .media-play-button i' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'hover_icon_color',
                            'label' => esc_html__('Hover Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .media-play-button:hover i' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'circle_color',
                            'label' => esc_html__('Circle Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .media-play-button.media-circle:after' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  =>  'button_size',
                            'type'  =>  \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Button Size', 'yhsshu'),
                            'size_units' => ['px'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 50,
                                    'max' => 200,
                                ],
                            ],
                            'default'   => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .media-play-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],

                        ),
                        array(
                            'name'  =>  'icont_font_size',
                            'type'  =>  \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Icon Font Size', 'yhsshu'),
                            'separator' => 'before',
                            'size_units' => ['px'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 80,
                                ],
                            ],
                            'default'   => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .media-play-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],

                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin(px)', 'yhsshu' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .media-play-button i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_description',
                    'label' => esc_html__('Description Style', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'description_color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-media-popup .button-text' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-media-popup .button-text',
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);