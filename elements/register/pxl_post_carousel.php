<?php
$pt_supports = ['post', 'yhsshu-portfolio', 'yhsshu-service', 'yhsshu-food'];
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_post_carousel',
        'title' => esc_html__('yhsshu Post Carousel', 'yhsshu' ),
        'icon' => 'eicon-posts-carousel',
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
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'post_type',
                                'label'    => esc_html__( 'Select Post Type', 'yhsshu' ),
                                'type'     => 'select',
                                'multiple' => true,
                                'options'  => yhsshu_get_post_type_options($pt_supports),
                                'default'  => 'post'
                            )
                        ),
                        yhsshu_get_post_carousel_layout($pt_supports)
                    ),
                ),
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'select_post_by',
                                'label'    => esc_html__( 'Select posts by', 'yhsshu' ),
                                'type'     => 'select',
                                'multiple' => true,
                                'options'  => [
                                    'term_selected' => esc_html__( 'Terms selected', 'yhsshu' ),
                                    'post_selected' => esc_html__( 'Posts selected ', 'yhsshu' ),
                                ],
                                'default'  => 'term_selected'
                            )
                        ),
                        yhsshu_get_carousel_term_by_post_type($pt_supports, ['custom_condition' => ['select_post_by' => 'term_selected']]),
                        yhsshu_get_carousel_ids_by_post_type($pt_supports, ['custom_condition' => ['select_post_by' => 'post_selected']]),
                        array(
                            array(
                                'name' => 'orderby',
                                'label' => esc_html__('Order By', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => 'date',
                                'options' => [
                                    'date' => esc_html__('Date', 'yhsshu' ),
                                    'ID' => esc_html__('ID', 'yhsshu' ),
                                    'author' => esc_html__('Author', 'yhsshu' ),
                                    'title' => esc_html__('Title', 'yhsshu' ),
                                    'rand' => esc_html__('Random', 'yhsshu' ),
                                ],
                            ),
                            array(
                                'name' => 'order',
                                'label' => esc_html__('Sort Order', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => 'desc',
                                'options' => [
                                    'desc' => esc_html__('Descending', 'yhsshu' ),
                                    'asc' => esc_html__('Ascending', 'yhsshu' ),
                                ],
                            ),
                            array(
                                'name' => 'limit',
                                'label' => esc_html__('Total items', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => '6',
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'general_section',
                    'label' => esc_html__('General Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        array(
                            array(
                                'name'        => 'img_size',
                                'label'       => esc_html__('Image Size', 'yhsshu' ),
                                'type'        => \Elementor\Controls_Manager::TEXT,
                                'control_type' => 'responsive',
                                'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'yhsshu')
                            ),
                            array(
                                'name'    => 'filter',
                                'label'   => esc_html__('Term Filter', 'yhsshu' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'false',
                                'options' => [
                                    'true'  => esc_html__('Enable', 'yhsshu' ),
                                    'false' => esc_html__('Disable', 'yhsshu' ),
                                ],
                                'condition' => [
                                    'select_post_by' => 'term_selected',
                                ],
                            ),
                            array(
                                'name'      => 'filter_default_title',
                                'label'     => esc_html__('Filter Default Title', 'yhsshu' ),
                                'type'      => \Elementor\Controls_Manager::TEXT,
                                'default'   => esc_html__('All', 'yhsshu' ),
                                'condition' => [
                                    'select_post_by' => 'term_selected',
                                    'filter'         => 'true',
                                ],
                            ),
                            array(
                                'name'         => 'filter_alignment',
                                'label'        => esc_html__( 'Filter Alignment', 'yhsshu' ),
                                'type'         => 'choose',
                                'control_type' => 'responsive',
                                'options' => [
                                    'start' => [
                                        'title' => esc_html__( 'Start', 'yhsshu' ),
                                        'icon'  => 'eicon-text-align-left',
                                    ],
                                    'center' => [
                                        'title' => esc_html__( 'Center', 'yhsshu' ),
                                        'icon'  => 'eicon-text-align-center',
                                    ],
                                    'end' => [
                                        'title' => esc_html__( 'End', 'yhsshu' ),
                                        'icon'  => 'eicon-text-align-right',
                                    ]
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .swiper-filter-wrap' => 'justify-content: {{VALUE}};'
                                ],
                                'default'      => 'center',
                                'condition' => [
                                    'select_post_by' => 'term_selected',
                                    'filter'         => 'true',
                                ],
                            ),
                        ),
                        yhsshu_elementor_animation_opts([
                            'name'   => 'item',
                            'label' => esc_html__('Item Content', 'yhsshu'),
                        ])
                    )
                ),
                array(
                    'name' => 'display_section',
                    'label' => esc_html__('Display Items Options', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'      => 'show_date',
                            'label'     => esc_html__('Show Date', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                            'condition' => ['post_type' => 'post']
                        ),
                        array(
                            'name'      => 'show_category',
                            'label'     => esc_html__('Show Category', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                        ),
                        array(
                            'name'      => 'show_divider',
                            'label'     => esc_html__('Show Divider', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                        ),
                        array(
                            'name'      => 'show_author',
                            'label'     => esc_html__('Show Author', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                            'condition' => ['post_type' => 'post']
                        ),
                        array(
                            'name'      => 'show_comment',
                            'label'     => esc_html__('Show Comment', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                            'condition' => ['post_type' => 'post']
                        ),
                        array(
                            'name' => 'show_excerpt',
                            'label' => esc_html__('Show Excerpt', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'num_words',
                            'label' => esc_html__('Number of Words', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => '',
                            'condition' => [
                                'show_excerpt' => 'true',
                            ],
                        ),
                        array(
                            'name'      => 'show_button',
                            'label'     => esc_html__('Show Button Readmore', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                        ),
                        array(
                            'name'      => 'button_text',
                            'label'     => esc_html__('Button Text', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'show_button'      => 'true',
                            ],
                        ),
                        array(
                            'name'         => 'alignment_content',
                            'label'        => esc_html__( 'Alignment Content', 'yhsshu' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'yhsshu' ),
                                    'icon'  => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'yhsshu' ),
                                    'icon'  => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'yhsshu' ),
                                    'icon'  => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-post-carousel.layout-post-6 .item-content' => 'display: flex; flex-direction: column; align-items: {{VALUE}}; text-align: {{VALUE}};'
                            ],
                            'condition' => ['layout_post' => 'post-6']
                        ),
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
                                'default'      => 30,
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
                            array(
                                'name' => 'setting_drag',
                                'label' => esc_html__('Show Drag Cursor', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'condition' => [
                                    'post_type' => 'yhsshu-portfolio'
                                ],
                                'default' => "true"
                            ),
                            array(
                                'name' => 'drag_text',
                                'label' => esc_html__('Show Drag', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html('Drag', 'yhsshu'),
                                'condition' => [
                                    'post_type' => 'yhsshu-portfolio'
                                ],
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
                    'label' => esc_html__('Dots Settings', 'yhsshu' ),
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