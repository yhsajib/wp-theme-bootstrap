<?php
// Register Widget
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_single_info',
        'title'      => esc_html__( 'yhsshu Single Info', 'yhsshu' ),
        'icon' => 'eicon-price-list',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => [],
        'params'     => array(
            'sections' => array(
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content Settings', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'el_style',
                            'label' => esc_html__('Style', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style-1' => esc_html__('Style 1', 'yhsshu'),
                                'style-2' => esc_html__('Style 2', 'yhsshu'),
                            ],
                            'default' => 'style-1'
                        ),
                        array(
                            'name' => 'el_title',
                            'label' => esc_html__('Element Title', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'single_info_items',
                            'label' => esc_html__('List Items', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'info_label',
                                    'label' => esc_html__('Label', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'info_type',
                                    'label'    => esc_html__('Type', 'yhsshu'), 
                                    'type'     => \Elementor\Controls_Manager::SELECT,
                                    'options'  => array(
                                        'text' => esc_html__('Text', 'yhsshu'),
                                        'post_title' => esc_html__('Current Post Title', 'yhsshu'),
                                        'post_categories' => esc_html__('Current Post Categories', 'yhsshu'), 
                                        'post_tags' => esc_html__('Current Post Tags', 'yhsshu'), 
                                        'post_date' => esc_html__('Current Post Date', 'yhsshu'),
                                    ),
                                    'default' => 'text'
                                ),
                                array(
                                    'name' => 'info_text',
                                    'label' => esc_html__('Text', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'condition' => [
                                        'info_type' => 'text'
                                    ]
                                ),
                            ),
                            'title_field' => '{{{ info_label }}}',
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'show_social',
                            'label' => esc_html__('Show Social Share', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true'
                        ),
                    )
                )
            )
        )
    ),
    yhsshu_get_class_widget_path()
);