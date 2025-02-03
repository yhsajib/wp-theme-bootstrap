<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_fancy_box_accordion',
        'title' => esc_html__('yhsshu Fancy Box Accordion', 'yhsshu'),
        'icon' => 'eicon-info-box',
        'categories' => array('yhsshutheme-core'),
        'scripts' => [
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Layout', 'yhsshu' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box_accordion-1.jpg'
                                ],
                            ],
                        ),
                        
                    ),
                ),
                array(
                    'name' => 'section_boxs',
                    'label' => esc_html__('Box Settings', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'boxs',
                            'label' => esc_html__('', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'box_image',
                                    'label' => esc_html__('Background Image', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name'             => 'selected_icon',
                                    'label'            => esc_html__( 'Content Icon', 'yhsshu' ),
                                    'type'             => 'icons',
                                    'default'          => [
                                        'library' => 'yhsshui',
                                        'value'   => 'yhsshui-world'
                                    ],
                                ),
                                array(
                                    'name' => 'title_text',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'default' => esc_html__('This is the heading', 'yhsshu'),
                                    'placeholder' => esc_html__('Enter your title', 'yhsshu'),
                                    'rows' => 3,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'description_text',
                                    'label' => esc_html__('Description', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'default' => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'yhsshu'),
                                    'placeholder' => esc_html__('Enter your description', 'yhsshu'),
                                    'rows' => 6,
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'button_text',
                                    'label' => esc_html__('Button Text', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'link',
                                    'label'       => esc_html__( 'Custom Link', 'yhsshu' ),
                                    'type'        => 'url',
                                    'placeholder' => esc_html__( 'https://your-link.com', 'yhsshu' ),
                                    'default'     => [
                                        'url'         => '#',
                                        'is_external' => 'on'
                                    ],
                                ),
                            ),
                        ),
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Icon Size', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 3,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-accordion .item-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-fancy-box-accordion .item-icon svg' => 'width: {{SIZE}}{{UNIT}}; max-height: unset;',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box-accordion .item-title',
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-accordion .item-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box-accordion .item-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_color',
                            'label' => esc_html__('Heading Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-accordion .item-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-accordion .item-description' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);