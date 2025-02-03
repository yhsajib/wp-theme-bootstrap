<?php

use Elementor\Controls_Manager;

$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
$custom_menus = array(
    '' => esc_html__('Default', 'yhsshu')
);
if ( is_array( $menus ) && ! empty( $menus ) ) {
    foreach ( $menus as $single_menu ) {
        if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
            $custom_menus[ $single_menu->slug ] = $single_menu->name;
        }
    }
} else {
    $custom_menus = '';
}

yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_menu',
        'title' => esc_html__('yhsshu Menu', 'yhsshu'),
        'icon' => 'eicon-nav-menu',
        'categories' => array('yhsshutheme-core'),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'yhsshu'),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'type',
                            'label' => esc_html__('Type', 'yhsshu' ),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Primary Menu', 'yhsshu'),
                                '2' => esc_html__('Menu Inner', 'yhsshu'),
                                '3' => esc_html__('Mobile Menu', 'yhsshu'),
                                '4' => esc_html__('Sidebar Menu', 'yhsshu'),
                                '5' => esc_html__('Menu Custom', 'yhsshu'),
                            ],
                            'default' => '1',
                        ),
                        array(
                            'name' => 'el_title',
                            'label' => esc_html__('Sidebar Widget Title', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                            'condition' => [
                                'type' => '4',
                            ],
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Menu Style', 'yhsshu' ),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Underline Top', 'yhsshu'),
                                '2' => esc_html__('Underline Bottom', 'yhsshu'),
                                '3' => esc_html__('Vertical', 'yhsshu'),
                                '4' => esc_html__('Slash Between', 'yhsshu'),
                                '5' => esc_html__('Rounded', 'yhsshu'),
                                '6' => esc_html__('Coffee Bean', 'yhsshu'),
                                '7' => esc_html__('Creams', 'yhsshu'),
                                '8' => esc_html__('Sushi', 'yhsshu'),
                                '9' => esc_html__('Seafood', 'yhsshu'),
                                '10' => esc_html__('Steak', 'yhsshu'),
                                '11' => esc_html__('Chocolate', 'yhsshu'),
                            ],
                            'default' => '1',
                            'condition' => [
                                'type' => ['1','2'],
                            ]
                        ),
                        array(
                            'name' => 'style_custom',
                            'label' => esc_html__('Menu Style', 'yhsshu' ),
                            'type' => 'select',
                            'options' => [
                                'style-1' => esc_html__('Style 1', 'yhsshu'),
                                'style-2' => esc_html__('Style 2', 'yhsshu'),
                                'style-3' => esc_html__('Style 2', 'yhsshu'),
                            ],
                            'default' => '1',
                            'condition' => [
                                'type' => ['5'],
                            ]
                        ),
                        array(
                            'name' => 'menu',
                            'label' => esc_html__('Select Menu', 'yhsshu'),
                            'type' => 'select',
                            'options' => $custom_menus,
                        ),
                        array(
                            'name'         => 'align',
                            'label'        => esc_html__( 'Alignment', 'yhsshu' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'yhsshu' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu.style-3 .menu-item' => 'justify-content: {{VALUE}};',
                            ],
                            'condition' => [
                                'type' => ['1','3'],
                            ]
                        ),
                        array(
                            'name' => 'menu_flex_grow',
                            'label' => esc_html__( 'Flex Grow', 'yhsshu' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                '0' => [
                                    'title' => esc_html__( 'Inherit', 'yhsshu' ),
                                    'icon' => 'eicon-h-align-center',
                                ],
                                '1' => [
                                    'title' => esc_html__( 'Fill available space', 'yhsshu' ),
                                    'icon' => 'eicon-h-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}}' => 'flex-grow: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'first_section',
                    'label' => esc_html__('Style First Level', 'yhsshu'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['1','3','5'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li > a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu > li > a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li .main-menu-toggle:before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu > li .main-menu-toggle:before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu.yhsshu-nav-menu-main.style-8 .yhsshu-primary-menu > li:not(:last-child):after' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-custom-menu > li > a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'color_hover',
                            'label' => esc_html__('Color Hover', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li > a:hover'                      => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li.current-menu-item > a'          => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu:not(.style-6) .yhsshu-primary-menu > li.current-menu-ancestor > a'      => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li:hover:before'                   => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li.current-menu-item:before'       => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li.current-menu-ancestor:before'   => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu > li > a:hover'                       => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li:hover .main-menu-toggle:before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu > li:hover .main-menu-toggle:before'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-custom-menu > li > a:hover'                      => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'underline_color',
                            'label' => esc_html__('Underline Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li:before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li:before, {{WRAPPER}} .yhsshu-nav-menu.yhsshu-nav-menu-main.style-2 .yhsshu-primary-menu > li a:before,
                                {{WRAPPER}} .yhsshu-nav-menu.yhsshu-nav-menu-main.style-10 .yhsshu-primary-menu > li > a:before,
                                {{WRAPPER}} .yhsshu-nav-menu.yhsshu-nav-menu-main.style-11 .yhsshu-primary-menu > li > a:before,
                                {{WRAPPER}} .yhsshu-nav-menu.yhsshu-nav-menu-main.style-11 .yhsshu-primary-menu > li.menu-item-has-children > a > span::before,
                                {{WRAPPER}} .yhsshu-nav-menu.yhsshu-nav-menu-main.style-11 .yhsshu-primary-menu > li.menu-item-has-children > a > span::after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'underline_color_customs',
                            'label' => esc_html__('Underline Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu.yhsshu-nav-menu-custom.style-3 .main-menu-toggle:before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'style_custom' => ['style-3'],
                            ],
                        ),
                        array(
                            'name' => 'typography',
                            'label' => esc_html__('Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu > li > a, {{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu > li > a,{{WRAPPER}} .yhsshu-nav-menu .yhsshu-custom-menu > li > a',
                        ),
                        array(
                            'name'  => 'show_arrow',
                            'label' => esc_html__('Show Arrow', 'yhsshu'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'no',
                            'condition' => [
                                'type' => ['1'],
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name'  => 'show_underline',
                            'label' => esc_html__('Show Underline', 'yhsshu'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'type' => ['1'],
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'item_space',
                            'label' => esc_html__('Item Space', 'yhsshu' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', 'em', '%', 'rem' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-primary-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-mobile-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-nav-menu.style-4 .yhsshu-primary-menu > li:not(:last-child):after' => 'right: calc(({{LEFT}}{{UNIT}} + {{RIGHT}}{{UNIT}}) / 2 * -1);',
                                '{{WRAPPER}} .yhsshu-custom-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'sub_section',
                    'label' => esc_html__('Style Sub Level', 'yhsshu'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['1','3','5'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'submenu_space_top',
                            'label' => esc_html__('Space Top', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' , 'em' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-primary-menu > .menu-item > .sub-menu' => 'top: calc(100% + 20px + {{SIZE}}{{UNIT}});',
                                '{{WRAPPER}} .yhsshu-primary-menu > li.active > .sub-menu, {{WRAPPER}} .yhsshu-primary-menu > li:hover > .sub-menu' => 'top: calc(100% + {{SIZE}}{{UNIT}});'
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'sub_color',
                            'label' => esc_html__('Text Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu li .sub-menu a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu li .sub-menu a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-primary-menu .sub-menu li.menu-item-has-children:after' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-custom-menu li .sub-menu a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu.yhsshu-nav-menu-main.style-9 .yhsshu-primary-menu > li .sub-menu > li > a span::after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_color_hover',
                            'label' => esc_html__('Color Hover/Active', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu .sub-menu .menu-item:hover > a,
                                 {{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu .sub-menu .current-menu-item > a,
                                 {{WRAPPER}} .yhsshu-nav-menu .yhsshu-custom-menu .sub-menu .menu-item:hover > a,
                                 {{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu .sub-menu .current-menu-ancestor > a' => 'color: {{VALUE}};',
                                 '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu li .sub-menu a:hover, {{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu .sub-menu > li.current-menu-item a' => 'color: {{VALUE}};',
                                 '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu li .sub-menu a:hover' => 'color: {{VALUE}};',
                                 '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-custom-menu .sub-menu .menu-item:hover > a::before' => 'background-color: {{VALUE}};',
                                 '{{WRAPPER}} .yhsshu-nav-menu.yhsshu-nav-menu-main .yhsshu-primary-menu > li .sub-menu > li > a span::after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_typography',
                            'label' => esc_html__('Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu li .sub-menu a, {{WRAPPER}} .yhsshu-nav-menu .yhsshu-mobile-menu li .sub-menu a, {{WRAPPER}} .yhsshu-nav-menu .yhsshu-custom-menu li .sub-menu a',
                        ),
                        array(
                            'name' => 'sub_background',
                            'label' => esc_html__('Background Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu .sub-menu' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'divider_type',
                            'label' => esc_html__( 'Divider Type', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'none' => esc_html__( 'None', 'yhsshu' ),
                                'solid' => esc_html__( 'Solid', 'yhsshu' ),
                                'double' => esc_html__( 'Double', 'yhsshu' ),
                                'dotted' => esc_html__( 'Dotted', 'yhsshu' ),
                                'dashed' => esc_html__( 'Dashed', 'yhsshu' ),
                                'groove' => esc_html__( 'Groove', 'yhsshu' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu .sub-menu > li a' => 'border-bottom-style: {{VALUE}};',
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                            'default' => 'solid',
                        ),
                        array(
                            'name' => 'divider_color',
                            'label' => esc_html__('Divider Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu .sub-menu > li a' => 'border-bottom-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name'         => 'box_shadow',
                            'label'        => esc_html__( 'Box Shadow', 'yhsshu' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'exclude' => [
                                'box_shadow_position',
                            ],
                            'selector' => '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu .sub-menu',
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__('Border Radius', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-primary-menu .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'nav_section',
                    'label' => esc_html__('Style', 'yhsshu'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['2'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'nav_color',
                            'label' => esc_html__('Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-nav-inner li' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-nav-inner a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'nav_color_hover',
                            'label' => esc_html__('Color Hover', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-nav-inner a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size(px)', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 5,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-nav-inner a .link-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-nav-inner a .link-icon' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  => 'border_hover',
                            'label' => esc_html__('Border Hover', 'yhsshu'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'yes',
                        ),
                        array(
                            'name' => 'nav_typography',
                            'label' => esc_html__('Typography', 'yhsshu' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-nav-inner a',
                        ),
                        array(
                            'name' => 'nav_item_space',
                            'label' => esc_html__('Item Space', 'yhsshu' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-nav-menu .yhsshu-nav-inner li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);