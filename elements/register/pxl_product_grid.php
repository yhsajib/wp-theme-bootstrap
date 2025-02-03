<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_product_grid',
        'title' => esc_html__('yhsshu Product Grid', 'yhsshu' ),
        'icon' => 'eicon-products',
        'categories' => array('yhsshutheme-core'),
        'scripts' => array(
            'imagesloaded',
            'isotope',
            'yhsshu-post-grid',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'     => 'product_layout',
                            'label'    => esc_html__('Product Layout', 'yhsshu'),
                            'type'     => 'select',
                            'options'  => [
                                'layout-1'       => esc_html__('Layout 1', 'yhsshu'),
                                'layout-2'       => esc_html__('Layout 2', 'yhsshu'),
                                'layout-3'       => esc_html__('Layout 3', 'yhsshu'),
                                'layout-4'       => esc_html__('Layout 4', 'yhsshu'),
                                'layout-5'       => esc_html__('Layout 5', 'yhsshu'),
                                'layout-6'       => esc_html__('Layout 6', 'yhsshu'),
                                'layout-7'       => esc_html__('Layout 7', 'yhsshu'),
                                'layout-8'       => esc_html__('Layout 8', 'yhsshu'),
                                'layout-9'       => esc_html__('Layout 9', 'yhsshu'),
                                'layout-10'      => esc_html__('Layout 10', 'yhsshu'),
                                'layout-11'      => esc_html__('Layout 11', 'yhsshu'),
                                'layout-12'       => esc_html__('Layout 12', 'yhsshu'),
                            ],
                            'default'  => 'layout-1',
                        ),
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
                    'name' => 'grid_section',
                    'label' => esc_html__('Grid Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        yhsshu_grid_column_settings(true),
                        array(
                            array(
                                'name' => 'item_padding',
                                'label' => esc_html__('Item Padding', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'default' => [],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-grid-inner' => 'margin-top: -{{TOP}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};',
                                    '{{WRAPPER}} .yhsshu-grid-inner .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'    => 'pagination_type',
                                'label'   => esc_html__('Pagination Type', 'yhsshu' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'false',
                                'options' => [
                                    'pagination' => esc_html__('Pagination', 'yhsshu' ),
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
                                ]
                            ),
                        )
                    ),
                ),
            ),
),
),
yhsshu_get_class_widget_path()
);