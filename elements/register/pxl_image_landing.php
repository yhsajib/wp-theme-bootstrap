<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_image_landing',
        'title' => esc_html__('yhsshu Image Landing', 'yhsshu' ),
        'icon' => 'eicon-image',
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
                            'label'   => esc_html__( 'Layout', 'yhsshu' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_image_landing-1.jpg'
                                ],
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Content', 'yhsshu' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'selected_image',
                            'label' => esc_html__('Image', 'yhsshu' ),
                            'type' => 'media',
                        ),
                        array(
                            'name' => 'title_text',
                            'label' => esc_html__('Title Text', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Homepage', 'yhsshu'),
                        ),
                        array(
                            'name' => 'link_type',
                            'label' => esc_html__('Link Type', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options'       => [
                                'url'   => esc_html__('URL', 'yhsshu'),
                                'page'  => esc_html__('Existing Page', 'yhsshu'),
                            ],
                            'default'       => 'url',
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::URL,
                            'placeholder' => esc_html__('https://your-link.com', 'yhsshu' ),
                            'condition'     => [
                                'link_type'     => 'url',
                            ],
                            'default' => [
                                'url' => '#',
                            ],
                        ),
                        array(
                            'name' => 'page_link',
                            'label' => esc_html__('Existing Page', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SELECT2,
                            'options'       => yhsshu_get_all_page(),
                            'condition'     => [
                                'link_type'     => 'page',
                            ],
                            'multiple'      => false,
                            'label_block'   => true,
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'yhsshu' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Border Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-image-landing .image-wrap' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_hover_color',
                            'label' => esc_html__('Border Hover Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-image-landing:hover .image-wrap' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-image-landing .image-title',
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-image-landing .image-title' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);