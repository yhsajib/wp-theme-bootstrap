<?php
// Register Fancy Box Widget
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_fancy_box',
        'title'      => esc_html__( 'yhsshu Fancy Box', 'yhsshu' ),
        'icon'       => 'eicon-icon-box',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 4', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__( 'Layout 6', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-6.jpg'
                                ],
                                '7' => [
                                    'label' => esc_html__( 'Layout 7', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-7.jpg'
                                ],
                                '8' => [
                                    'label' => esc_html__( 'Layout 8', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-8.jpg'
                                ],
                                '9' => [
                                    'label' => esc_html__( 'Layout 9', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-9.jpg'
                                ],
                                '10' => [
                                    'label' => esc_html__( 'Layout 10', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-10.jpg'
                                ],
                                '11' => [
                                    'label' => esc_html__( 'Layout 11', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-11.jpg'
                                ],
                                '12' => [
                                    'label' => esc_html__( 'Layout 12', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-12.jpg'
                                ],
                                '13' => [
                                    'label' => esc_html__( 'Layout 13', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-13.jpg'
                                ],
                                '14' => [
                                    'label' => esc_html__( 'Layout 14', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-14.jpg'
                                ],
                                '15' => [
                                    'label' => esc_html__( 'Layout 15', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-15.jpg'
                                ],
                            ]
                        )
                    )
                ),
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'yhsshu' ),
                            'type'             => 'icons',
                            'condition' => ['layout!' => '7']
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
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon > svg' => 'width: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'condition' => ['layout!' => ['9', '14', '15']]
                        ),
                        array(
                            'name'  => 'icon_size_9',
                            'label' => esc_html__( 'Icon Size', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon .yhsshu-icon i, {{WRAPPER}} .yhsshu-fancy-box.layout-14 .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon .yhsshu-icon svg, {{WRAPPER}} .yhsshu-fancy-box.layout-14 .box-icon > svg' => 'width: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'condition' => ['layout' => ['9', '14', '15']],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name'  => 'content_max_width',
                            'label' => esc_html__( 'Max Width', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 150,
                                    'max' => 1200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-inner' => 'max-width: {{SIZE}}{{UNIT}}; margin: 0 auto;',
                            ],
                        ),
                        array(
                            'name' => 'background_img',
                            'label' => esc_html__( 'Background Image', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'dynamic' => [
                                'active' => true,
                            ],
                            'default' => [
                                'url' => \Elementor\Utils::get_placeholder_image_src()
                            ],
                            'condition' => [
                                'layout'    => ['7']
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box.layout-7' => 'background-image: url( {{URL}} );',
                            ],
                        ),
                        array(
                            'name' => 'selected_img',
                            'label' => esc_html__( 'Choose Image', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'dynamic' => [
                                'active' => true,
                            ],
                            'default' => [
                                'url' => \Elementor\Utils::get_placeholder_image_src()
                            ],
                            'condition' => [
                                'layout'    => ['5', '6', '7']
                            ]
                        ),
                        array(
                            'name' => 'img_size',
                            'label' => esc_html__('Image Size', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'yhsshu'),
                            'condition' => [
                                'layout'    => ['5']
                            ]
                        ),
                        array(
                            'name'     => 'subtitle',
                            'label'    => esc_html__('Sub Title', 'yhsshu'),
                            'type'     => 'text',
                            'condition' => [
                                'layout'    => ['9']
                            ]
                        ),
                        array(
                            'name'     => 'title',
                            'label'    => esc_html__('Title', 'yhsshu'),
                            'type'     => 'textarea',
                            'default'  => esc_html__('Your Title', 'yhsshu')
                        ),
                        array(
                            'name'     => 'description',
                            'label'    => esc_html__('Description', 'yhsshu'),
                            'type'     => 'textarea',
                            'default'  => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'yhsshu'),
                            'condition' => [
                                'layout!'    => ['9']
                            ]
                        ),
                        array(
                            'name' => 'boxs_des',
                            'label' => esc_html__('Item', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name'     => 'des_layout9',
                                    'label'    => esc_html__('Description', 'yhsshu'),
                                    'type'     => 'textarea',
                                ),
                            ),
                            'title_field' => '{{{ des_layout9 }}}',
                            'condition' => [
                                'layout'    => ['9']
                            ]
                        ),
                        array(
                            'name' => 'button_text',
                            'label' => esc_html__('Button Text', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'condition' => [
                                'layout'    => ['2', '9', '14']
                            ]
                        ),
                        array(
                            'name'        => 'link',
                            'label'       => esc_html__( 'Button Link', 'yhsshu' ),
                            'type'        => 'url',
                            'placeholder' => esc_html__( 'https://your-link.com', 'yhsshu' ),
                            'default'     => [
                                'url'         => '#',
                                'is_external' => 'on'
                            ],
                            'condition' => [
                                'layout' => ['2', '5', '6', '7', '9','13', '14']
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'icon_background',
                            'label' => esc_html__('Icon Background', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon' => 'background-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout!' => ['9','10','11','12']
                            ]
                        ),
                        array(
                            'name' => 'icon_background_hover',
                            'label' => esc_html__('Icon Background Hover', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon:hover::after' => 'color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => ['13']
                            ]
                        ),
                        array(
                            'name' => 'padding',
                            'label' => esc_html__('Padding Box', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => ['10', '14']
                            ]
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__('Border Radius Box', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => ['10']
                            ]
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__( 'Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'subtitle_color',
                            'label' => esc_html__( 'Sub Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-subtitle' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout!' => ['11','12','15']
                            ]
                        ),
                        array(
                            'name' => 'subtitle_typography',
                            'label' => esc_html__('Sub Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box .box-subtitle',
                            'condition' => [
                                'layout!' => ['11','12','15']
                            ]
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__( 'Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box .box-title a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box .box-title a::after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box .box-title',
                        ),
                        array(
                            'name' => 'title_margin',
                            'label' => esc_html__('Title Margin', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => ['10']
                            ]
                        ),
                        array(
                            'name'  => 'title_max_width',
                            'label' => esc_html__( 'Max Width Title', 'yhsshu' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-title' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['9','10']
                            ]
                        ),
                        array(
                            'name' => 'description_color',
                            'label' => esc_html__( 'Description Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'description_typography',
                            'label' => esc_html__('Description Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box .box-description',
                        ),
                        array(
                            'name' => 'box_background',
                            'label' => esc_html__('Box Background', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-inner' => 'background-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout!' => ['6','11', '15']
                            ]
                        ),
                        array(
                            'name' => 'boxshadow_background',
                            'label' => esc_html__('Boxshadow Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-inner' => 'box-shadow: 0 10px 0 {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '9'
                            ]
                        ),
                        array(
                            'name' => 'border_inner_color',
                            'label' => esc_html__('Border Inner Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box.layout-6 .back-card:before,{{WRAPPER}} .yhsshu-fancy-box.layout-12 .box-inner' => 'border-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout!' => ['6','9','10','11','15']
                            ]
                        ),
                        array(
                            'name' => 'border_hover_color',
                            'label' => esc_html__('Border Hover Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-inner:hover' => 'border-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => ['14']
                            ]
                        ),
                        array(
                            'name' => 'btn_style',
                            'label' => esc_html__('Button Styles', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'yhsshu' ),
                                'btn-gradient' => esc_html__('Gradient', 'yhsshu' ),
                                'btn-white' => esc_html__('White', 'yhsshu' ),
                                'btn-fullwidth' => esc_html__('Full Width', 'yhsshu' ),
                                'btn-outline' => esc_html__('Out Line', 'yhsshu' ),
                                'btn-outline-secondary' => esc_html__('Out Line Secondary', 'yhsshu' ),
                            ],
                            'condition' => [
                                'layout'    => ['2', '9']
                            ]
                        ),
                        array(
                            'name' => 'btn_color',
                            'label' => esc_html__('Button Text Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .btn' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout'    => ['2']
                            ]
                        ),
                        array(
                            'name' => 'btn_color_hover',
                            'label' => esc_html__('Button Text Color Hover', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .btn:hover' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout'    => ['2']
                            ]
                        ),
                        array(
                            'name' => 'btn_bg_color',
                            'label' => esc_html__('Button Background Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .btn' => 'background-image: none; background-color: {{VALUE}}; border-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box .btn::after' => 'background-image: none; background-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '2',
                            ],
                        ),
                        array(
                            'name' => 'btn_bg_color_hover',
                            'label' => esc_html__('Button Background Color Hover', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .btn:hover' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box .btn:hover::before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2',
                            ],
                        ),
                        array(
                            'name' => 'readmore_color',
                            'label' => esc_html__('Button Text Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-readmore' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout'    => ['9']
                            ]
                        ),
                        array(
                            'name' => 'readmore_typography',
                            'label' => esc_html__('Button Text Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box .box-readmore',
                            'condition' => [
                                'layout'    => ['9'],
                                'layout!'    => ['10']
                            ]
                        ),
                        array(
                            'name' => 'icon_rotate',
                            'label' => esc_html__('Rotate Icon (deg)', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['deg'],
                            'control_type' => 'responsive',
                            'range' => [
                                'deg' => [
                                    'min' => 0,
                                    'max' => 360,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon i' => 'transform: rotate({{SIZE}}deg);',
                            ],
                            'condition' => [
                                'layout' => ['11'],
                            ],
                        ),
                        array(
                            'name' => 'location_bg_icon_Y',
                            'label' => esc_html__('Location Background Icon Y (px)', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                           'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon i::after' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['11'],
                            ],
                        ),
                        array(
                            'name' => 'location_bg_icon_X',
                            'label' => esc_html__('Location Background Icon X (px)', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-icon i::after' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['11'],
                            ],
                        ),
                        array(
                            'name' => 'icon_position',
                            'label' => esc_html__( 'Icon Position', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'default'  => esc_html__('', 'yhsshu'),
                            'options' => [
                                '' => esc_html__( 'None', 'yhsshu' ),
                                'row' => esc_html__( 'Row', 'yhsshu' ),
                                'column' => esc_html__( 'Column', 'yhsshu' ),
                                'row-reverse' => esc_html__( 'Row Reverse', 'yhsshu' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box .box-inner' => 'display: flex; flex-direction: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['13'],
                            ],
                        ),
                        array(
                            'name'         => 'vertical_alignment',
                            'label'        => esc_html__( 'Vertical Alignment', 'yhsshu' ),
                            'type'         => 'choose',
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
                                '{{WRAPPER}} .yhsshu-fancy-box .box-inner' => 'align-items: {{VALUE}};',
                            ],
                            'condition' => [
                                'icon_position' => ['row','column','row-reverse'],
                            ],
                        ),
                        array(
                            'name'         => 'text_alignment',
                            'label'        => esc_html__( 'Text Alignment', 'yhsshu' ),
                            'type'         => 'choose',
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
                                '{{WRAPPER}} .yhsshu-fancy-box .box-inner' => 'text-align: {{VALUE}};',
                            ],
                            'condition' => [
                                'icon_position' => ['row','column','row-reverse'],
                            ],
                        ),
                        array(
                            'name'         => 'box_alignment',
                            'label'        => esc_html__( 'Alignment', 'yhsshu' ),
                            'type'         => 'choose',
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
                                '{{WRAPPER}} .yhsshu-fancy-box .box-inner, {{WRAPPER}} .yhsshu-fancy-box .box-content' => 'text-align: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box .box-content' => 'align-items: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => ['14', '15'],
                            ],
                        ),
                    ),
                ),
            )
        )
    ),
    yhsshu_get_class_widget_path()
);