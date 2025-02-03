<?php
// Register Moving Path Widget
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_moving_path',
        'title'      => esc_html__( 'yhsshu Moving Path', 'yhsshu' ),
        'icon'       => 'eicon-lottie',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(
            'gsMotionPath',
            'yhsshu-moving-path'
            ),
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_moving_path-1.jpg'
                                ],
                            ],
                        )
                    )
                ),
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'             => 'selected_svg',
                            'label'            => esc_html__( 'SVG Path', 'yhsshu' ),
                            'type'             => 'icons',
                            'default'          => [],
                        ),
                        array(
                            'name'             => 'selected_img',
                            'label'            => esc_html__( 'Image Moving', 'yhsshu' ),
                            'type'             => 'media',
                            'default'          => '',
                        ),
                    )
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name'  => 'path_size',
                            'label' => esc_html__( 'Path Size', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-moving-path svg' => 'height: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'path_color',
                            'label' => esc_html__( 'Path Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-moving-path svg path' => 'stroke: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name'      => 'moving_duration',
                            'label'     => esc_html__( 'Moving Duration(s)', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::NUMBER,
                            'min'       => 0,
                            'step'      => 100,
                        )
                    ),
                ),
            )
        )
    ),
    yhsshu_get_class_widget_path()
);