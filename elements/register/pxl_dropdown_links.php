<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_dropdown_links',
        'title' => esc_html__('yhsshu Dropdown Links', 'yhsshu'),
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
                                    'image' => get_template_directory_uri() . '/elements/register/img-layout/yhsshu_dropdown_links-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-dropdown-links-layout-'
                        ),
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'container-label',
                            'label' => esc_html__('First Option', 'yhsshu'),
                            'type' => 'text',
                            'default' => 'Other Websites'
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'yhsshu' ),
                            'type'             => 'icons',
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-dropdown-links .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-dropdown-links .box-icon svg' => 'width: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-dropdown-links i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-dropdown-links svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
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
                                ),
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
                    'name' => 'section_style_container_label',
                    'label' => esc_html__('Container Label', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'label_color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-dropdown-links .container-label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'label_typography',
                            'label' => esc_html__('Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-dropdown-links .container-label',
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-dropdown-links .box-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-dropdown-links .box-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'dropdown_icon_color',
                            'label' => esc_html__('Dropdown Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-dropdown-links .dropdown-icon' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_link',
                    'label' => esc_html__('Links', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'link_position',
                            'label' => esc_html__('Link Position', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'left',
                            'options' => [
                                'left' => esc_html__('Left', 'yhsshu' ),
                                'right' => esc_html__('Right', 'yhsshu' ),
                            ],
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-dropdown-links ul li a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_typography',
                            'label' => esc_html__('Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-dropdown-links ul li a',
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);