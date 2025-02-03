<?php
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_store_list',
        'title' => esc_html__('yhsshu Store List', 'yhsshu' ),
        'icon' => 'eicon-bullet-list',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array('yhsshu-storelist'),
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_fancy_box-1.jpg'
                                ],
                            ],
                        )
                    )
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__( 'Content', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'list',
                            'label' => esc_html__('Items', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'store_icon',
                                    'label' => esc_html__('Store Icon', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-store',
                                        'library' => 'fa-solid',
                                    ],
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Title', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'desc',
                                    'label' => esc_html__('Description', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Button Link', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style',
                    'label' => esc_html__('Style', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'button_style',
                            'label' => esc_html__('Button Styles', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-additional-8',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'yhsshu' ),
                                'btn-white' => esc_html__('White', 'yhsshu' ),
                                'btn-outline' => esc_html__('Out Line', 'yhsshu' ),
                                'btn-outline-secondary' => esc_html__('Out Line Secondary', 'yhsshu' ),
                                'btn-additional-1' => esc_html__('Additional Button 01', 'yhsshu' ),
                                'btn-additional-2' => esc_html__('Additional Button 02', 'yhsshu' ),
                                'btn-additional-3' => esc_html__('Additional Button 03', 'yhsshu' ),
                                'btn-additional-4' => esc_html__('Additional Button 04', 'yhsshu' ),
                                'btn-additional-5' => esc_html__('Additional Button 05', 'yhsshu' ),
                                'btn-additional-6' => esc_html__('Additional Button 06', 'yhsshu' ),
                                'btn-additional-7' => esc_html__('Additional Button 07', 'yhsshu' ),
                                'btn-additional-8' => esc_html__('Additional Button 08', 'yhsshu' ),
                                'btn-additional-9' => esc_html__('Additional Button 09', 'yhsshu' ),
                                'btn-additional-10' => esc_html__('Additional Button 10', 'yhsshu' ),
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);