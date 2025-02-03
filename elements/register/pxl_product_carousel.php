<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_product_carousel',
        'title' => esc_html__('yhsshu Product Carousel', 'yhsshu' ),
        'icon' => 'eicon-product-categories',
        'categories' => array('yhsshutheme-core'),
        'scripts' => array(
            'swiper',
            'yhsshu-swiper',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 4', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__( 'Layout 6', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-6.jpg'
                                ],
                                '7' => [
                                    'label' => esc_html__( 'Layout 7', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-7.jpg'
                                ],
                                '8' => [
                                    'label' => esc_html__( 'Layout 8', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-8.jpg'
                                ],
                                '9' => [
                                    'label' => esc_html__( 'Layout 9', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-9.jpg'
                                ],
                                '10' => [
                                    'label' => esc_html__( 'Layout 10', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-10.jpg'
                                ],
                                '11' => [
                                    'label' => esc_html__( 'Layout 11', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-11.jpg'
                                ],
                                '12' => [
                                    'label' => esc_html__( 'Layout 12', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_product_carousel-12.jpg'
                                ],
                            ]
                        )
                    )
                ),
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'    => 'query_type',
                            'label'   => esc_html__( 'Select Query Type', 'yhsshu' ),
                            'type'    => 'select',
                            'default' => 'recent_product',
                            'options' => [
                                'recent_product'   => esc_html__( 'Recent Products', 'yhsshu' ),
                                'best_selling'     => esc_html__( 'Best Selling', 'yhsshu' ),
                                'featured_product' => esc_html__( 'Featured Products', 'yhsshu' ),
                                'top_rate'         => esc_html__( 'High Rate', 'yhsshu' ),
                                'on_sale'          => esc_html__( 'On Sale', 'yhsshu' ),
                                'recent_review'    => esc_html__( 'Recent Review', 'yhsshu' ),
                                'deals'            => esc_html__( 'Product Deals', 'yhsshu' ),
                                'separate'         => esc_html__( 'Product separate', 'yhsshu' ),
                            ]
                        ),
                        array(
                            'name'     => 'taxonomies',
                            'label'    => esc_html__( 'Select Term of Product', 'yhsshu' ),
                            'type'     => 'select2',
                            'multiple' => true,
                            'options'  => yhsshu_get_product_grid_term_options()
                        ),
                        array(
                            'name'     => 'product_ids',
                            'label'    => esc_html__( 'Products id (123,124,135...)', 'yhsshu' ),
                            'type'     => 'text',
                            'default'  => '',
                            'condition' => array( 'query_type' => 'separate' )
                        ),
                        array(
                            'name'     => 'post_per_page',
                            'label'    => esc_html__( 'Post per page', 'yhsshu' ),
                            'type'     => 'text',
                            'default'  => '6'
                        )
                    ),
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
                                'name'         => 'gutter',
                                'label'        => esc_html__('Gutter', 'yhsshu' ),
                                'type'         => 'number',
                                'control_type' => 'responsive',
                                'default'      => 30
                            ),
                            array(
                                'name' => 'center_slide',
                                'label' => esc_html__('Center Slider', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'default' => false
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
                array(
                    'name' => 'arrow_settings',
                    'label' => esc_html__('Arrow Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        yhsshu_arrow_settings(),
                    ),
                ),
                array(
                    'name' => 'dots_settings',
                    'label' => esc_html__('Dot Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        yhsshu_dots_settings(),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);