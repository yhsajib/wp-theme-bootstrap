<?php
yhsshu_add_custom_widget(
    [
        'name' => 'yhsshu_image',
        'title' => esc_html__('yhsshu Image', 'yhsshu' ),
        'icon' => 'eicon-image',
        'categories' => ['yhsshutheme-core'],
        'params' => [
            'sections' => [
                [
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Image', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => [
                        [
                            'name' => 'image',
                            'label' => esc_html__( 'Choose Image', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'dynamic' => [
                                'active' => true,
                            ],
                            'default' => [
                                'url' => \Elementor\Utils::get_placeholder_image_src()
                            ],
                        ],
                        [
                            'name' => 'image',
                            'label' => esc_html__( 'Image Size', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',  
                        ],
                        [
                            'name' => 'align',
                            'label' => esc_html__( 'Alignment', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                            ],
                        ],
                        [
                            'name' => 'link_to',
                            'label' => esc_html__( 'Link', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'none',
                            'options' => [
                                'none' => esc_html__( 'None', 'yhsshu' ),
                                'file' => esc_html__( 'Media File', 'yhsshu' ),
                                'custom' => esc_html__( 'Custom URL', 'yhsshu' ),
                            ],
                        ],
                        [
                            'name' => 'link',
                            'label' => esc_html__( 'Link', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::URL,
                            'dynamic' => [
                                'active' => true,
                            ],
                            'placeholder' => esc_html__( 'https://your-link.com', 'yhsshu' ),
                            'condition' => [
                                'link_to' => 'custom',
                            ],
                            'show_label' => false,
                        ],
                        [
                            'name' => 'open_lightbox',
                            'label' => esc_html__( 'Lightbox', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'default',
                            'options' => [
                                'default' => esc_html__( 'Default', 'yhsshu' ),
                                'yes' => esc_html__( 'Yes', 'yhsshu' ),
                                'no' => esc_html__( 'No', 'yhsshu' ),
                            ],
                            'condition' => [
                                'link_to' => 'file',
                            ],
                        ]
                    ],
                ],  
                [
                    'name' => 'caption_section',
                    'label' => esc_html__('Caption Settings', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => [
                        [
                            'name'      => 'show_caption',
                            'label'     => esc_html__('Show Caption', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'false',
                        ],
                        [
                            'name'      => 'caption_align',
                            'label' => esc_html__( 'Caption Alignment', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__( 'Justified', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .widget-image-caption' => 'text-align: {{VALUE}};',
                            ],
                        ],
                        [
                            'name'      => 'caption_text_color',
                            'label' => esc_html__( 'Caption Text Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .widget-image-caption' => 'color: {{VALUE}};',
                            ],
                        ],
                        [
                            'name'      => 'caption_background_color',
                            'label' => esc_html__( 'Caption Background Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .widget-image-caption' => 'background-color: {{VALUE}};',
                            ],
                        ],
                        [
                            'name' => 'caption_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .widget-image-caption',
                        ],
                        [
                            'name' => 'caption_text_shadow',
                            'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .widget-image-caption',
                        ],
                        [
                            'name' => 'caption_space',
                            'label' => esc_html__( 'Caption Spacing', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    ]
                ],
                [
                    'name' => 'parallax_section',
                    'label' => esc_html__('Parallax Settings', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => [
                        [
                            'name' => 'yhsshu_parallax',
                            'label' => esc_html__( 'Parallax Type', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                ''        => esc_html__( 'None', 'yhsshu' ),
                                'y'       => esc_html__( 'Transform Y', 'yhsshu' ),
                                'x'       => esc_html__( 'Transform X', 'yhsshu' ),
                                'z'       => esc_html__( 'Transform Z', 'yhsshu' ),
                                'rotateX' => esc_html__( 'RotateX', 'yhsshu' ),
                                'rotateY' => esc_html__( 'RotateY', 'yhsshu' ),
                                'rotateZ' => esc_html__( 'RotateZ', 'yhsshu' ),
                                'scaleX'  => esc_html__( 'ScaleX', 'yhsshu' ),
                                'scaleY'  => esc_html__( 'ScaleY', 'yhsshu' ),
                                'scaleZ'  => esc_html__( 'ScaleZ', 'yhsshu' ),
                                'scale'   => esc_html__( 'Scale', 'yhsshu' ),
                            ],
                        ],
                        [
                            'name' => 'parallax_value',
                            'label' => esc_html__('Value', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'condition' => [ 'yhsshu_parallax!' => '']  
                        ],
                        [
                            'name' => 'yhsshu_parallax_screen',
                            'label'   => esc_html__( 'Parallax In Screen', 'yhsshu' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'default' => '',
                            'options' => array(
                                '' => esc_html__( 'Default', 'yhsshu' ),
                                'no'   => esc_html__( 'No', 'yhsshu' ),
                            ),
                            'prefix_class' => 'yhsshu-parallax%s-',
                            'condition' => [ 'yhsshu_parallax!' => '']  
                        ]
                        
                    ]
                ],
                [
                    'name'     => 'bg_parallax_section',
                    'label'    => esc_html__('Background Parallax', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        [
                            [
                                'name'    => 'yhsshu_bg_parallax',
                                'label'   => esc_html__( 'Background Parallax Type', 'yhsshu' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    ''                  => esc_html__( 'None', 'yhsshu' ),
                                    'basic'             => esc_html__( 'Basic', 'yhsshu' ),
                                    'rotate'            => esc_html__( 'Rotate', 'yhsshu' ),
                                    'mouse-move'        => esc_html__( 'Mouse Move', 'yhsshu' ),
                                    'mouse-move-rotate' => esc_html__( 'Mouse Move Rotate', 'yhsshu' ),
                                    'transform-mouse-move' => esc_html__( 'Transform Mouse Move', 'yhsshu' ),
                                    'transform' => esc_html__( 'Transform', 'yhsshu' ),
                                ],
                            ],
                            [
                                'name' => 'bg_parallax_width',
                                'label' => esc_html__('Background Width', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'default' => [
                                    'unit' => '%',
                                ],
                                'tablet_default' => [
                                    'unit' => '%',
                                ],
                                'mobile_default' => [
                                    'unit' => '%',
                                ],
                                'size_units' => [ '%', 'px', 'vw' ],
                                'range' => [
                                    '%' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                    'px' => [
                                        'min' => 1,
                                        'max' => 1920,
                                    ],
                                    'vw' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-image-wg' => 'width: {{SIZE}}{{UNIT}};',
                                ],
                                'condition' => [ 'yhsshu_bg_parallax!' => '']  
                            ],
                            [
                                'name' => 'bg_parallax_height',
                                'label' => esc_html__('Background Height', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'default' => [
                                    'unit' => 'px',
                                ],
                                'tablet_default' => [
                                    'unit' => 'px',
                                ],
                                'mobile_default' => [
                                    'unit' => 'px',
                                ],
                                'size_units' => [ 'px', 'vh' ],
                                'range' => [
                                    'px' => [
                                        'min' => 1,
                                        'max' => 1000,
                                    ],
                                    'vh' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-image-wg' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                                'condition' => [ 'yhsshu_bg_parallax!' => '']  
                            ]
                        ],
                        yhsshu_position_option_base([
                                'prefix' => '',
                                'selectors_class' => '.parallax-inner',
                                'condition' => ['yhsshu_bg_parallax' => 'transform']
                            ]
                        ),
                        yhsshu_parallax_effect_option([
                                'prefix' => '',
                                'condition' => ['yhsshu_bg_parallax' => 'transform']
                            ]
                        )
                    )
                ],
                [
                    'name'     => 'style_section',
                    'label'    => esc_html__( 'Style', 'yhsshu' ),
                    'tab'      => 'style',
                    'controls' => [
                        [
                            'name'        => 'width',
                            'label' => esc_html__( 'Width', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'default' => [
                                'unit' => '%',
                            ],
                            'tablet_default' => [
                                'unit' => '%',
                            ],
                            'mobile_default' => [
                                'unit' => '%',
                            ],
                            'size_units' => [ '%', 'px', 'vw' ],
                            'range' => [
                                '%' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                                'px' => [
                                    'min' => 1,
                                    'max' => 1000,
                                ],
                                'vw' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name'        => 'space',
                            'label' => esc_html__( 'Max Width', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'default' => [
                                'unit' => '%',
                            ],
                            'tablet_default' => [
                                'unit' => '%',
                            ],
                            'mobile_default' => [
                                'unit' => '%',
                            ],
                            'size_units' => [ '%', 'px', 'vw' ],
                            'range' => [
                                '%' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                                'px' => [
                                    'min' => 1,
                                    'max' => 1000,
                                ],
                                'vw' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name'        => 'height',
                            'label' => esc_html__( 'Height', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'default' => [
                                'unit' => 'px',
                            ],
                            'tablet_default' => [
                                'unit' => 'px',
                            ],
                            'mobile_default' => [
                                'unit' => 'px',
                            ],
                            'size_units' => [ 'px', 'vh' ],
                            'range' => [
                                'px' => [
                                    'min' => 1,
                                    'max' => 1000,
                                ],
                                'vh' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name'        => 'object-fit',
                            'label' => esc_html__( 'Object Fit', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'condition' => [
                                'height[size]!' => '',
                            ],
                            'options' => [
                                '' => esc_html__( 'Default', 'yhsshu' ),
                                'fill' => esc_html__( 'Fill', 'yhsshu' ),
                                'cover' => esc_html__( 'Cover', 'yhsshu' ),
                                'contain' => esc_html__( 'Contain', 'yhsshu' ),
                            ],
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
                            ],
                        ],
                        [
                            'name'        => 'separator_panel_style',
                            'type' => \Elementor\Controls_Manager::DIVIDER,
                            'style' => 'thick',
                        ],
                        [
                            'name' => 'image_effects',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'normal',
                                    'label' => esc_html__('Normal', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::TAB,
                                    'controls' => [
                                        [
                                            'name'        => 'opacity',
                                            'label' => esc_html__( 'Opacity', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::SLIDER,
                                            'range' => [
                                                'px' => [
                                                    'max' => 1,
                                                    'min' => 0.10,
                                                    'step' => 0.01,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} img' => 'opacity: {{SIZE}};',
                                            ],
                                        ],
                                        [
                                            'name' => 'css_filters',
                                            'label' => esc_html__('CSS Filters', 'yhsshu' ),
                                            'type' => \Elementor\Group_Control_Css_Filter::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} img',
                                        ],       
                                    ],
                                ],
                                [
                                    'name' => 'hover',
                                    'label' => esc_html__('Hover', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::TAB,
                                    'controls' => [
                                        [
                                            'name'        => 'opacity_hover',
                                            'label' => esc_html__( 'Opacity Hover', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::SLIDER,
                                            'range' => [
                                                'px' => [
                                                    'max' => 1,
                                                    'min' => 0.10,
                                                    'step' => 0.01,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}}:hover img' => 'opacity: {{SIZE}};',
                                            ],
                                        ],
                                        [
                                            'name' => 'css_filters_hover',
                                            'label' => esc_html__('CSS Filters Hover', 'yhsshu' ),
                                            'type' => \Elementor\Group_Control_Css_Filter::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}}:hover img',
                                        ],  
                                        [
                                            'name' => 'background_hover_transition',
                                            'label' => esc_html__( 'Transition Duration', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::SLIDER,
                                            'range' => [
                                                'px' => [
                                                    'max' => 3,
                                                    'step' => 0.1,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} img' => 'transition-duration: {{SIZE}}s',
                                            ],
                                        ],
                                        [
                                            'name' => 'hover_animation',
                                            'label' => esc_html__( 'Hover Animation', 'yhsshu' ),
                                            'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                                        ]     
                                    ]
                                ]
                            ],
                        ], 
                        [
                            'name' => 'image_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-image-wg, {{WRAPPER}} .yhsshu-bg-parallax',
                            'separator' => 'before',
                        ],
                        [
                            'name'         => 'image_border_radius',
                            'label'        => esc_html__( 'Border Radius', 'yhsshu' ),
                            'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units'   => [ 'px', '%' ],
                            'selectors'    => [
                                '{{WRAPPER}} .yhsshu-image-wg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-bg-parallax' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name'         => 'image_box_shadow',
                            'label'        => esc_html__( 'Box Shadow', 'yhsshu' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'exclude' => [
                                'box_shadow_position',
                            ],
                            'selector' => '{{WRAPPER}} img',
                        ]   
                    ],
                ],  
                [
                    'name' => 'custom_style_section',
                    'label' => esc_html__('Custom Style', 'yhsshu' ),
                    'tab'      => 'style',
                    'controls' => [
                        [
                            'name' => 'custom_style',
                            'label' => esc_html__( 'Style', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                ''           => esc_html__( 'None', 'yhsshu' ),
                                'yhsshu-transition' => esc_html__( 'Transition', 'yhsshu' ),
                                'draw-from-top' => esc_html__( 'Draw From Top', 'yhsshu' ),
                                'draw-from-left' => esc_html__( 'Draw From Left', 'yhsshu' ),
                                'draw-from-right' => esc_html__( 'Draw From Right', 'yhsshu' ),
                                'move-from-left' => esc_html__( 'Move From Left', 'yhsshu' ),
                                'move-from-right' => esc_html__( 'Move From Right', 'yhsshu' ),
                                'skew-in'         => esc_html__( 'Skew In Left', 'yhsshu' ),
                                'skew-in-right'         => esc_html__( 'Skew In Right', 'yhsshu' ),
                            ],
                        ],
                        [
                            'name'      => 'draw_animation_delay',
                            'label'     => esc_html__( 'Draw Animation Delay (ms)', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::NUMBER,
                            'min'       => 0,
                            'step'      => 100,
                            'condition' => [
                                'custom_style!' => ''
                            ],
                        ],
                        [
                            'name' => 'img_animation',
                            'label' => esc_html__( 'Animation', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => array(
                                'default'=> esc_html__( 'Default', 'yhsshu' ),
                                'up-down-move'   => esc_html__( 'up down move', 'yhsshu' ),
                                'shape-animate1'   => esc_html__( 'shape animate 1', 'yhsshu' ),
                                'shape-animate2'   => esc_html__( 'shape animate 2', 'yhsshu' ),
                                'shape-animate3'   => esc_html__( 'shape animate 3', 'yhsshu' ),
                                'shape-animate4'   => esc_html__( 'shape animate 4', 'yhsshu' ),
                                'shape-animate5'   => esc_html__( 'shape animate 5', 'yhsshu' ),
                                'shape-animate6'   => esc_html__( 'shape animate 6', 'yhsshu' ),
                                'shape-animate7'   => esc_html__( 'shape animate 7', 'yhsshu' ),
                                'fade-in-out-custom'   => esc_html__( 'fade in out custom', 'yhsshu' ),
                                'fade-out-in-custom'   => esc_html__( 'fade out in custom', 'yhsshu' ),
                                'zoom-in-out-custom'   => esc_html__( 'zoom in out custom', 'yhsshu' ),
                                'rotate-animate1'   => esc_html__( 'Rotate Animate', 'yhsshu' ),
                            ),
                            'default'      => 'default',
                        ],
                        [
                            'name'      => 'animation_delay',
                            'label'     => esc_html__( 'Animation Delay (ms)', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::NUMBER,
                            'min'       => 0,
                            'step'      => 100,
                            'selectors'    => [
                                '{{WRAPPER}} .yhsshu-image-wg' => 'animation-delay: {{VALUE}}ms;',
                            ],
                            'condition' => [
                                'img_animation!' => 'default'
                            ],
                        ],
                    ]
                ],
            ], 
        ],
    ],
    yhsshu_get_class_widget_path()
);