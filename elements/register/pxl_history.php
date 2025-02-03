<?php
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_history',
        'title'      => esc_html__('yhsshu History', 'yhsshu'),
        'icon'       => 'eicon-slider-push',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'yhsshu' ),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'yhsshu' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_history-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_history-2.jpg'
                                ]
                            ],
                            'prefix_class' => 'yhsshu-history-layout-'
                        )
                    ),
                ),
                array(
                    'name'     => 'history_list',
                    'label'    => esc_html__('History List', 'yhsshu'),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'history_items',
                            'label'    => esc_html__('Add Item', 'yhsshu'),
                            'type'     => 'repeater',
                            'controls' => array(
                                array(
                                    'name'     => 'title',
                                    'label'    => esc_html__('Title', 'yhsshu'),
                                    'type'     => 'text',
                                    'default'  => esc_html__('first formation.', 'yhsshu'),
                                ),
                                array(
                                    'name'     => 'description',
                                    'label'    => esc_html__('Description', 'yhsshu'),
                                    'type'     => 'textarea',
                                    'rows' => 3,
                                    'default'  => esc_html__('Aliquam erat metus, rutrum ut sagittis eu, viverra volutpat arcu. Mauris fermentum sodales nibh, sed vulputate lacus congue sit amet. Nam at lobortis mi. Nullam sit amet feugiat libero.', 'yhsshu'),
                                ),
                                array(
                                    'name'        => 'year',
                                    'label'       => esc_html__('History Year', 'yhsshu'),
                                    'type'        => 'text',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'history_img',
                                    'label'       => esc_html__('History Image', 'yhsshu'),
                                    'type'        => 'media',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'image_link',
                                    'label'       => esc_html__( 'History Link', 'yhsshu' ),
                                    'type'        => 'url',
                                    'placeholder' => esc_html__( 'https://your-link.com', 'yhsshu' ),
                                    'default'     => [
                                        'url'         => '#',
                                        'is_external' => 'on'
                                    ],
                                ),
                            ),
                            'default' => [],
                            'title_field' => '{{{ year }}}',
                        ),
                        array(
                            'name' => 'icon_background',
                            'label' => esc_html__('Diamond Icon Background', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-history .diamond-icon:before' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .yhsshu-history .diamond-icon:after' => 'background-color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'icon_space',
                            'label' => esc_html__('Diamond Icon Space Color', 'yhsshu' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-history .diamond-icon:before' => 'background-color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            )
        )
    ),
    yhsshu_get_class_widget_path()
);