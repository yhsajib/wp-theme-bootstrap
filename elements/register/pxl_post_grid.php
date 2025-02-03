<?php
$pt_supports = ['post','yhsshu-portfolio'];
use Elementor\Controls_Manager;
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_post_grid',
        'title'      => esc_html__('yhsshu Post Grid', 'yhsshu' ),
        'icon'       => 'eicon-posts-grid',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => [
            'imagesloaded',
            'isotope',
            'yhsshu-post-grid',
        ],
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
                        yhsshu_get_post_grid_layout($pt_supports)
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
                        yhsshu_get_grid_term_by_post_type($pt_supports, ['custom_condition' => ['select_post_by' => 'term_selected']]),
                        yhsshu_get_grid_ids_by_post_type($pt_supports, ['custom_condition' => ['select_post_by' => 'post_selected']]),
                        array(
                            array(
                                'name'    => 'orderby',
                                'label'   => esc_html__('Order By', 'yhsshu' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'date',
                                'options' => [
                                    'date'   => esc_html__('Date', 'yhsshu' ),
                                    'ID'     => esc_html__('ID', 'yhsshu' ),
                                    'author' => esc_html__('Author', 'yhsshu' ),
                                    'title'  => esc_html__('Title', 'yhsshu' ),
                                    'rand'   => esc_html__('Random', 'yhsshu' ),
                                ],
                            ),
                            array(
                                'name'    => 'order',
                                'label'   => esc_html__('Sort Order', 'yhsshu' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'desc',
                                'options' => [
                                    'desc' => esc_html__('Descending', 'yhsshu' ),
                                    'asc'  => esc_html__('Ascending', 'yhsshu' ),
                                ],
                            ),
                            array(
                                'name'    => 'limit',
                                'label'   => esc_html__('Total items', 'yhsshu' ),
                                'type'    => \Elementor\Controls_Manager::NUMBER,
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
                                'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'yhsshu')
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
                                    '{{WRAPPER}} .grid-filter-wrap' => 'justify-content: {{VALUE}};'
                                ],
                                'default'      => 'center',
                                'condition' => [
                                    'select_post_by' => 'term_selected',
                                    'filter'         => 'true',
                                ],
                            ),
                            array(
                                'name'    => 'pagination_type',
                                'label'   => esc_html__('Pagination Type', 'yhsshu' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'false',
                                'options' => [
                                    'pagination' => esc_html__('Pagination', 'yhsshu' ),
                                    'loadmore'   => esc_html__('Loadmore', 'yhsshu' ),
                                    'false'      => esc_html__('Disable', 'yhsshu' ),
                                ],
                            ),
                            array(
                                'name'      => 'loadmore_text',
                                'label'     => esc_html__( 'Load More text', 'yhsshu' ),
                                'type'      => \Elementor\Controls_Manager::TEXT,
                                'default'   => esc_html__('Load More','yhsshu'),
                                'condition' => [
                                    'pagination_type' => 'loadmore'
                                ]
                            ),
                            array(
                                'name'             => 'loadmore_icon',
                                'label'            => esc_html__( 'Loadmore Icon', 'yhsshu' ),
                                'type'             => 'icons',
                                'default'          => [],
                                'condition' => [
                                    'pagination_type' => 'loadmore'
                                ]
                            ),
                            array(
                                'name' => 'icon_align',
                                'label' => esc_html__('Icon Position', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => 'right',
                                'options' => [
                                    'right' => esc_html__('After', 'yhsshu' ),
                                    'left' => esc_html__('Before', 'yhsshu' ),
                                ],
                                'condition' => [
                                    'pagination_type' => 'loadmore'
                                ]
                            ),
                            array(
                                'name'         => 'pagination_alignment',
                                'label'        => esc_html__( 'Pagination Alignment', 'yhsshu' ),
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
                                    '{{WRAPPER}} .yhsshu-grid-pagination, {{WRAPPER}} .yhsshu-load-more' => 'justify-content: {{VALUE}};'
                                ],
                                'default'      => 'start',
                                'condition' => [
                                    'pagination_type' => ['pagination', 'loadmore'],
                                ],
                            ),
                            array(
                                'name' => 'item_padding',
                                'label' => esc_html__('Item Padding', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'default' => [
                                    'top' => '15',
                                    'right' => '15',
                                    'bottom' => '15',
                                    'left' => '15'
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-grid-inner' => 'margin-top: -{{TOP}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};',
                                    '{{WRAPPER}} .yhsshu-grid-inner .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                    '{{WRAPPER}} .yhsshu-grid.layout-yhsshu-portfolio-5' => 'padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
         
                            array(
                                'name'         => 'gap_extra',
                                'label'        => esc_html__( 'Item Gap Bottom', 'yhsshu' ),
                                'description'  => esc_html__( 'Add extra space at bottom of each items','yhsshu'),
                                'type'         => \Elementor\Controls_Manager::NUMBER,
                                'default'      => 0,
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-grid-inner .grid-item' => 'margin-bottom: {{VALUE}}px;',
                                ],
                            )
                        ),
                        yhsshu_elementor_animation_opts([
                            'name'   => 'item',
                            'label' => esc_html__('Item', 'yhsshu'),
                        ])
                    )
                ),
                array(
                    'name' => 'grid_section',
                    'label' => esc_html__('Grid Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        yhsshu_grid_column_settings(),
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
                        )
                    ),
                ),
                array(
                    'name' => 'display_section',
                    'label' => esc_html__('Display Options', 'yhsshu' ),
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
                            'name'      => 'show_author',
                            'label'     => esc_html__('Show Author', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                            'condition' => ['post_type' => 'post']
                        ),
                        array(
                            'name'      => 'show_category',
                            'label'     => esc_html__('Show Category / Tags', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                            'condition' => ['post_type' => array('post', 'yhsshu-portfolio')]
                        ),
                        array(
                            'name'      => 'show_divider',
                            'label'     => esc_html__('Show Divider', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                        ),
                        array(
                            'name'      => 'show_comment',
                            'label'     => esc_html__('Show Comment', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                            'condition' => ['post_type' => 'post']
                        ),
                        array(
                            'name'      => 'show_excerpt',
                            'label'     => esc_html__('Show Excerpt', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'true',
                        ),
                        array(
                            'name'      => 'num_words',
                            'label'     => esc_html__('Number of Words', 'yhsshu' ),
                            'type'      => \Elementor\Controls_Manager::NUMBER,
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
                                'show_button' => 'true',
                            ],
                        ),
                        array(
                            'name'      => 'item_radius',
                            'label'     => esc_html__('Item Radius', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-grid .grid-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);