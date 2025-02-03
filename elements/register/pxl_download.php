<?php
// Register Widget
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_download',
        'title'      => esc_html__( 'yhsshu Download', 'yhsshu' ),
        'icon' => 'eicon-file-download',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => [],
        'params'     => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'yhsshu' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Layout', 'yhsshu' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_download-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-download-layout-',
                        ),
                    )
                ),
                array(
                    'name'     => 'list_section',
                    'label'    => esc_html__( 'Content Settings', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'el_title',
                            'label' => esc_html__('Element Title', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'download_description',
                            'label' => esc_html__('Description', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'download',
                            'label' => esc_html__('Download Lists', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'file_name',
                                    'label' => esc_html__('File Name', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'file_type_icon',
                                    'label' => esc_html__('File Icon', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-star',
                                        'library' => 'fa-solid',
                                    ],
                                ),
                                array(
                                    'name' => 'file_size',
                                    'label' => esc_html__('File Size', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::URL,
                                ),
                            ),
                            'title_field' => '{{{ file_name }}}',
                        ),
                    )
                )
            )
        )
    ),
    yhsshu_get_class_widget_path()
);