<?php
use Elementor\Icons_Manager;
Icons_Manager::enqueue_shim();
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_team_details',
        'title' => esc_html__('yhsshu Team Details', 'yhsshu'),
        'icon' => 'eicon-person',
        'categories' => array('yhsshutheme-core'),
        'scripts' => [],
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_team_details-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'yhsshu-team-details-layout-',
                        ),
                    ),
                ),
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Image', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Name', 'yhsshu'),
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
                            'name' => 'hi_text',
                            'label' => esc_html__('Hi Text', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name'        => 'item_background',
                            'label'       => esc_html__('Hi Text Background', 'yhsshu'),
                            'type'        => 'media',
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::URL,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'contact_list',
                            'label' => esc_html__('Contact List', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'contact_icon',
                                    'label' => esc_html__('Icon', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                ),
                                array(
                                    'name' => 'contact_info',
                                    'label' => esc_html__('Contact Info', 'yhsshu' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 2,
                                ),
                            ),
                            'title_field' => '<i class="{{ contact_icon }}" aria-hidden="true"></i> {{{ contact_info }}}',
                        ),
                        array(
                            'name' => 'social',
                            'label' => esc_html__( 'Social', 'yhsshu' ),
                            'type' => 'yhsshu_icons',
                        ),
                    )
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-details .item-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'position_color',
                            'label' => esc_html__('Position Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-team-details .item-position' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);