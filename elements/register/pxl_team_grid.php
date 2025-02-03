<?php
use Elementor\Icons_Manager;
Icons_Manager::enqueue_shim();
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_team_grid',
        'title' => esc_html__('yhsshu Team Grid', 'yhsshu'),
        'icon' => 'eicon-person',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_team_grid-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_team_grid-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_team_grid-3.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-team-grid-layout-',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Content', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'content_list',
                            'label' => esc_html__('Team List', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'position',
                                    'label' => esc_html__('Position', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'description',
                                    'label' => esc_html__('Description', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 4,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'background_color',
                                    'label' => esc_html__('Background Color', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::COLOR,
                                    'description' => esc_html__('Background Use for Layout 2', 'yhsshu'),
                                    'selectors' => [
                                        '{{WRAPPER}} .yhsshu-team-grid.layout-2 {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
                                    ],
                                ),
                                array(
                                    'name' => 'social',
                                    'label' => esc_html__( 'Social', 'yhsshu' ),
                                    'type' => 'yhsshu_icons',
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'grid_section',
                    'label' => esc_html__('Grid', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        yhsshu_grid_column_settings(),
                        array(
                            array(
                                'name' => 'img_size',
                                'label' => esc_html__('Image Size', 'yhsshu' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'yhsshu')
                            )
                        ),
                        yhsshu_elementor_animation_opts([
                            'name'   => 'item',
                            'label' => esc_html__('Item', 'yhsshu'),
                        ])
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-grid .item-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-team-grid.layout-2 .item-title a::before' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'position_color',
                            'label' => esc_html__('Position Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-grid .item-position' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-grid .item-social a i' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                               'layout' => ['2', '3']
                            ]
                        ),
                        array(
                            'name' => 'icon_hover_bgcolor',
                            'label' => esc_html__('Icon Hover Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-grid .item-social a::after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                               'layout' => ['2', '3']
                            ]
                        ),
                        array(
                            'name'  => 'box_height',
                            'label' => esc_html__( 'Height (px)', 'yhsshu' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1920,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 423, 
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-grid .item-inner' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                               'layout' => ['2']
                            ]
                        ),
                        array(
                            'name' => 'icon_bg_color',
                            'label' => esc_html__('Background Color Icon', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-grid .item-social' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                               'layout' => ['3']
                            ]
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);