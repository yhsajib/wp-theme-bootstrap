<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_image_gallery',
        'title' => esc_html__('yhsshu Image Gallery', 'yhsshu'),
        'icon' => 'eicon-gallery-grid',
        'categories' => array('yhsshutheme-core'),
        'scripts' => [
            'imagesloaded',
            'isotope',
            'yhsshu-post-grid',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_gallery-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_gallery-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_gallery-3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 4', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_gallery-4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_gallery-5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__( 'Layout 6', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_gallery-6.jpg'
                                ],
                                '7' => [
                                    'label' => esc_html__( 'Layout 7', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_gallery-7.jpg'
                                ],
                                '8' => [
                                    'label' => esc_html__( 'Layout 8', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_gallery-7.jpg'
                                ],
                                '9' => [
                                    'label' => esc_html__( 'Layout 9', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_gallery-9.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-image-gallery-layout-',
                        ),
                    ),
                ),
                array(
                    'name' => 'grid_section',
                    'label' => esc_html__('Image Gallery', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'wp_gallery',
                                'label' => esc_html__( 'Add Images', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::GALLERY,
                                'show_label' => false,
                                'dynamic' => [
                                    'active' => true,
                                ],
                            ),
                            array(
                                'name'    => 'layout_mode',
                                'label'   => esc_html__( 'Layout Mode', 'yhsshu' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    'fitRows' => esc_html__( 'Basic Grid', 'yhsshu' ),
                                    'masonry' => esc_html__( 'Masonry Grid', 'yhsshu' ),
                                ],
                                'default'   => 'fitRows'
                            ),
                            array(
                                'name' => 'img_size',
                                'label' => esc_html__('Image Size', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'yhsshu')
                            ),
                            array(
                                'name' => 'gallery_rand',
                                'label' => __( 'Order By', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    '' => __( 'Default', 'yhsshu' ),
                                    'rand' => __( 'Random', 'yhsshu' ),
                                ],
                                'default' => '',
                            )
                        ),
                        yhsshu_grid_column_settings(),
                        array(
                            array(
                                'name' => 'grid_custom_items_url',
                                'label'     => esc_html__('Custom Items URL', 'yhsshu'),
                                'type'      => \Elementor\Controls_Manager::REPEATER,
                                'condition' => [
                                    'layout' => ['2', '3', '6']
                                ],
                                'controls' => array_merge(
                                    array(
                                        array(
                                            'name'    => 'item_url',
                                            'label'   => esc_html__( 'Item URL', 'yhsshu' ),
                                            'type'    => \Elementor\Controls_Manager::TEXT,
                                            'label_block'   => true,
                                        ),
                                    ),
                                )
                            )
                        ),
                        array(
                            array(
                                'name'      => 'grid_custom_columns',
                                'label'     => esc_html__('Custom Items Columns', 'yhsshu'),
                                'type'      => \Elementor\Controls_Manager::REPEATER,
                                'condition' => [
                                    'layout_mode' => ['masonry'],
                                ],
                                'controls' => array_merge(
                                    yhsshu_grid_custom_column_settings(),
                                    array(
                                        array(
                                            'name'        => 'img_size_c',
                                            'label'       => esc_html__('Image Size', 'yhsshu' ),
                                            'type'        => \Elementor\Controls_Manager::TEXT,
                                            'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'yhsshu'),
                                        ),
                                    ),
                                    yhsshu_elementor_animation_opts([
                                        'name'  => 'item_c',
                                        'label' => esc_html__('Item', 'yhsshu'),
                                    ])
                                ),
                            ),
                        ),
                        yhsshu_elementor_animation_opts([
                            'name'   => 'item',
                            'label' => esc_html__('Item', 'yhsshu'),
                        ])
                    ),
                ),
                array(
                    'name' => 'gallery_icon_section',
                    'label' => esc_html__('Icon', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'selected_icon',
                            'label' => esc_html__( 'Icon', 'yhsshu' ),
                            'type' => 'icons',
                            'condition' => [
                                'layout!' => ['1', '4']
                            ]
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size (px)', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-image-gallery .up-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'condition' => [
                                'layout' => ['2', '3', '5', '6']
                            ]
                        ),
                        array(
                            'name'  => 'icon_color',
                            'label' => esc_html__( 'Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-image-gallery .up-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-image-gallery .yhsshu-grid-inner .grid-item .item-inner .up-icon .x-line:before,
                                {{WRAPPER}} .yhsshu-image-gallery .yhsshu-grid-inner .grid-item .item-inner .up-icon .x-line:after,
                                {{WRAPPER}} .yhsshu-image-gallery .yhsshu-grid-inner .grid-item .item-inner .up-icon .y-line:before,
                                {{WRAPPER}} .yhsshu-image-gallery .yhsshu-grid-inner .grid-item .item-inner .up-icon .y-line:after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['2', '3', '5', '6', '9']
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'gallery_images_section',
                    'label' => esc_html__('Images', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Image Gap', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'control_type' => 'responsive',
                            'default' => 15,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-grid .yhsshu-grid-inner' => 'margin-left: -{{VALUE}}px; margin-right: -{{VALUE}}px;',
                                '{{WRAPPER}} .yhsshu-grid.layout-5 .yhsshu-grid-inner' => 'margin-left: 0px; margin-right: 0px;',
                                '{{WRAPPER}} .yhsshu-grid:not(.layout-8) .grid-item' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px; margin-top: {{VALUE}}px; margin-bottom: {{VALUE}}px;',
                                '{{WRAPPER}} .yhsshu-grid.layout-5 .grid-item' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px; padding-top: {{VALUE}}px; padding-bottom: {{VALUE}}px; margin-top: 0; margin-bottom: 0;',
                                '{{WRAPPER}} .yhsshu-grid .grid-sizer' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px;',
                            ],
                            'condition' => [
                                'layout!' => '8'
                            ]
                        ),
                        array(
                            'name'         => 'image_border_radius',
                            'label'        => esc_html__( 'Image Radius', 'yhsshu' ),
                            'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units'   => [ 'px', '%' ],
                            'selectors'    => [
                                '{{WRAPPER}} .grid-item .item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                            ],
                        ),
                        array(
                            'name' => 'hover_background',
                            'label' => esc_html__('Hover Background Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-grid .grid-item .item-inner .icon-wrapper, {{WRAPPER}} .yhsshu-image-gallery .yhsshu-grid-inner .grid-item .item-inner:before' => 'background-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => ['2', '4']
                            ]
                        ),
                        array(
                            'name'  => 'blur_img_hover',
                            'label' => esc_html__( 'Hover Image Blur', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-image-gallery .yhsshu-grid-inner .grid-item .item-inner:hover img' => 'filter: blur({{SIZE}}{{UNIT}});',
                            ],
                            'condition' => [
                                'layout' => ['2']
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'caption_section',
                    'label' => esc_html__('Caption', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'gallery_display_caption',
                            'label' => __( 'Display', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'none',
                            'options' => [
                                'none' => __( 'Hide', 'yhsshu' ),
                                '' => __( 'Show', 'yhsshu' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .grid-item .image-caption' => 'display: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'caption_align',
                            'label' => __( 'Alignment', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'default' => 'center',
                            'selectors' => [
                                '{{WRAPPER}} .grid-item .image-caption' => 'text-align: {{VALUE}};',
                            ],
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                        array(
                            'name' => 'caption_color',
                            'label' => __( 'Text Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .grid-item .image-caption' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                        array(
                            'name' => 'caption_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .grid-item .image-caption',
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);