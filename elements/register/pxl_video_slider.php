<?php
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_video_slider',
        'title'      => esc_html__('yhsshu Video Slider', 'yhsshu'),
        'icon'       => 'eicon-slider-video',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(
            'swiper',
            'yhsshu-swiper',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'yhsshu' ),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'yhsshu' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_video_slider-1.jpg'
                                ]
                            ],
                        )
                    ),
                ),
                array(
                    'name'     => 'clients_list',
                    'label'    => esc_html__('Clients', 'yhsshu'),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'clients',
                            'label'    => esc_html__('Add Client', 'yhsshu'),
                            'type'     => 'repeater',
                            'controls' => array(
                                array(
                                    'name'        => 'client_img',
                                    'label'       => esc_html__('Client Image', 'yhsshu'),
                                    'type'        => 'media',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'name',
                                    'label'       => esc_html__('Client Name', 'yhsshu'),
                                    'type'        => 'text',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'position',
                                    'label'       => esc_html__('Position', 'yhsshu'),
                                    'type'        => 'text',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'video_link',
                                    'label'       => esc_html__( 'Video Link', 'yhsshu' ),
                                    'type'        => 'url',
                                    'placeholder' => esc_html__( 'https://your-link.com', 'yhsshu' ),
                                    'default'     => [
                                        'url'         => '#',
                                        'is_external' => 'on'
                                    ],
                                ),
                                array(
                                    'name'        => 'video_text',
                                    'label'       => esc_html__('Position', 'yhsshu'),
                                    'type'        => 'text',
                                    'label_block' => true,
                                    'default'     => 'What Video'
                                )
                            ),
                            'default' => [],
                            'title_field' => '{{{ name }}}',
                        ) 
                    )
                ),
                array(
                    'name' => 'carousel_setting',
                    'label' => esc_html__('Carousel Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        yhsshu_carousel_column_settings(),
                        array( 
                            array(
                                'name' => 'slides_to_scroll',
                                'label' => esc_html__('Slides to scroll', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '1',
                                'options' => [
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                    '6' => '6',
                                ],
                            ),
                            array(
                                'name' => 'arrows',
                                'label' => esc_html__('Show Arrows', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'dots',
                                'label' => esc_html__('Show Dots', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'pause_on_hover',
                                'label' => esc_html__('Pause on Hover', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'autoplay',
                                'label' => esc_html__('Autoplay', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'autoplay_speed',
                                'label' => esc_html__('Autoplay Speed', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 5000,
                                'condition' => [
                                    'autoplay' => 'true'
                                ]
                            ),
                            array(
                                'name' => 'infinite',
                                'label' => esc_html__('Infinite Loop', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'speed',
                                'label' => esc_html__('Animation Speed', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 400,
                            ),
                        )
                    ),
                ),
            )
        )
    ),
    yhsshu_get_class_widget_path()
);