<?php
$templates_df = [
    0 => esc_html__('None', 'yhsshu'),
    'cart-dropdown' => esc_html__('Cart Dropdown', 'yhsshu'),
    'cart-page' => esc_html__('Cart Page', 'yhsshu'),
    'url' => esc_html__('URL', 'yhsshu')
];
$templates = $templates_df + yhsshu_get_templates_option('hidden-panel');

yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_anchor_list',
        'title'      => esc_html__( 'yhsshu Anchor List', 'yhsshu' ),
        'icon'       => 'eicon-anchor',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(),
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_banner_carousel-1.jpg'
                                ],
                            ],
                        ),
                        
                    ),
                ),
                array(
                    'name'     => 'icon_section',
                    'label'    => esc_html__( 'Settings', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'anchors',
                            'label' => esc_html__('', 'yhsshu'),
                            'type' => 'repeater',
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'template',
                                    'label' => esc_html__('Select Templates', 'yhsshu'),
                                    'type' => 'select',
                                    'options' => $templates,
                                    'default' => 'df' 
                                ),
                                array(
                                    'name' => 'cart_style',
                                    'label' => esc_html__('Dropdown Layout', 'yhsshu'),
                                    'type' => 'select',
                                    'options' => [
                                        'layout-1' => esc_html__('Layout 1', 'yhsshu'),
                                        'layout-2' => esc_html__('Layout 2', 'yhsshu'),
                                        'layout-3' => esc_html__('Layout 3', 'yhsshu'),
                                        'layout-4' => esc_html__('Layout 4', 'yhsshu'),
                                    ],
                                    'default' => 'layout-1',
                                    'condition' => ['template' => 'cart-dropdown']
                                ),
                                array(
                                    'name'             => 'selected_icon',
                                    'label'            => esc_html__( 'Icon', 'yhsshu' ),
                                    'type'             => 'icons',
                                    'default'          => [
                                        'library' => 'yhsshui',
                                        'value'   => 'yhsshui-search-400'
                                    ],
                                ),
                                array(
                                    'name'  => 'cart_count',
                                    'label' => esc_html__('Show Cart Count', 'yhsshu'),
                                    'type'  => \Elementor\Controls_Manager::SWITCHER,
                                    'default' => 'false',
                                    'condition' => [
                                        'template' => ['cart-dropdown', 'cart-page']
                                    ],
                                ),
                                array(
                                    'name'  => 'anchor_url',
                                    'label' => esc_html__('URL' ,'yhsshu'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                    'condition' => [
                                        'template' => ['url']
                                    ],
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array_merge(
                        array(
                            array(
                                'name'  => 'icon_size',
                                'label' => esc_html__( 'Icon Size(px)', 'yhsshu' ),
                                'type'  => 'slider',
                                'range' => [
                                    'px' => [
                                        'min' => 15,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor' => 'font-size: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} .yhsshu-anchor svg' => 'width: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'icon_color',
                                'label' => esc_html__('Color', 'yhsshu' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor' => 'color: {{VALUE}};'
                                ],
                            ),
                            array(
                                'name' => 'container_background',
                                'label' => esc_html__('Background Hover', 'yhsshu' ),
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => ['classic', 'gradient'],
                                'selector' => '{{WRAPPER}} .yhsshu-anchor-list.layout-1 .yhsshu-anchor-list-wrap',
                            ),
                            array(
                                'name' => 'icon_color_hover',
                                'label' => esc_html__('Icon Hover', 'yhsshu' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor-list.layout-1 .yhsshu-anchor:hover' => 'color: {{VALUE}};',
                                    '{{WRAPPER}} .yhsshu-anchor-list.layout-1 .yhsshu-anchor:hover svg' => 'fill: {{VALUE}};'
                                ],
                                'separator' => 'before'
                            ),
                            array(
                                'name' => 'icon_color_background',
                                'label' => esc_html__('Icon Background Hover', 'yhsshu' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .yhsshu-anchor-list.layout-1 .yhsshu-anchor:before' => 'background-color: {{VALUE}};'
                                ],
                            ),
                        ),
                    ),
                ),
            ),
),
),
yhsshu_get_class_widget_path()
);