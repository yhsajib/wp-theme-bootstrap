<?php
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_sidebar_tabs',
        'title'      => esc_html__( 'yhsshu Sidebar Tabs', 'yhsshu' ),
        'icon' => 'eicon-nav-menu',
        'categories' => array('yhsshutheme-core'),
        'scripts' => [
          'yhsshu-tabs',
        ],
        'params' => array(
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_sidebar_tabs-1.jpg'
                                ],
                            ],
                        ),
                    )
                ),
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'sb_tabs_links',
                            'label' => esc_html__('Anchor Link Items', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'description' => esc_html__('Anchor Link connect to inner section ID that will show when link active, click.', 'yhsshu' ),
                            'controls' => array(
                                array(
                                    'name' => 'sb_link_text',
                                    'label' => esc_html__('Link Text', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'inner_section_ids',
                                    'label' => esc_html__('Inner Section Ids', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                    'description' => esc_html__('CSS ID of inner section that will connect with Anchor Link, without #, separated by commas. Example: "id1". Note: Please add Class "anchor-inner-item" to all inner section.', 'yhsshu'),
                                ),
                            ),
                            'title_field' => '{{{ sb_link_text }}}',
                        ),
                    ),
                )
            )
        )
    ),
    yhsshu_get_class_widget_path()
);