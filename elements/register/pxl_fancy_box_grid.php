<?php
use Elementor\Icons_Manager;
Icons_Manager::enqueue_shim();
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_fancy_box_grid',
        'title' => esc_html__('yhsshu Fancy Box Grid', 'yhsshu'),
        'icon' => 'eicon-info-box',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box_grid-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-fancy-box-grid-layout-',
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
                            'label' => esc_html__('Item', 'yhsshu'),
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
                                    'name' => 'categories',
                                    'label' => esc_html__('Categories', 'yhsshu' ),
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
                                    'selectors' => [
                                        '{{WRAPPER}} .yhsshu-fancy-box-grid {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'parallax_section',
                    'label' => esc_html__('Parallax Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
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
                        ),
                        array(
                            'name' => 'parallax_value',
                            'label' => esc_html__('Value', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'condition' => [ 'yhsshu_parallax!' => '']  
                        ),
                        array(
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
                        )
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
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box-grid .item-inner .item-title',
                        ),
                        array(
                            'name' => 'color_title',
                            'label' => esc_html__('Color Title', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-grid .item-inner .item-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-fancy-box-grid .item-inner .item-title a::after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'categories_typography',
                            'label' => esc_html__('Categories Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-fancy-box-grid .item-inner .item-categories',
                        ),
                        array(
                            'name' => 'color_categories',
                            'label' => esc_html__('Color Categories', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-fancy-box-grid .item-inner .item-categories' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);